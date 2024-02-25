<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Feedback;

class FeedbackTest extends TestCase
{
    protected $user, $feedback;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::query()->where('username', '=', 'test')->first();
        $this->feedback = Feedback::query()->latest()->first();
    }

    public function testFeedbackCreate(): void
    {
        $response = $this->get(route('feedbackCreate'));

        $response->assertOk();
    }

    public function testFeedbackStore(): void
    {
        $response = $this->post(route('feedbackStore'),[
            'content' => 'test content',
            'author' => 'test author',
            'rating' => 3,
            'mail' => 'test_mail@test.com',
        ]);

        $response->assertRedirect();

        $feedback = Feedback::query()->latest()->firstOrFail();

        $this->assertEquals('test content', $feedback->content);
        $this->assertEquals('test author', $feedback->author);
        $this->assertEquals(3, $feedback->rating);
        $this->assertEquals('test_mail@test.com', $feedback->mail);
    }

    public function testFeedbackIndexByAdmin(): void
    {
        $response = $this->actingAs($this->user)->get(route('moderationIndex'));

        $response->assertOk();
    }

    public function testFeedbackEdit(): void
    {
        $response = $this->actingAs($this->user)->get(route('moderationEdit', [$this->feedback->id]));
    
        $response->assertOk();
        $response->assertViewHas('feedback');
        $this->assertNotEmpty($response['feedback']);
    }

    public function testFeedbackUpdate(): void
    {
        $response = $this->actingAs($this->user)->put(route('moderationUpdate', [$this->feedback->id]),[
            'moderated' => true,
            'blocked' => false,
            'deleted' => false,
        ]);
    
        $response->assertRedirect();

        $feedback = Feedback::query()->findOrFail($this->feedback->id);

        $this->assertEquals(1, $feedback->moderated);
    }

    public function testFeedbackIndexByUser(): void
    {
        $response = $this->get(route('feedbackIndex'));
        
        $response->assertOk();
        $response->assertViewHas('feedback');
        $this->assertNotEmpty($response['feedback']);
    }

    public function testFeedbackBlock(): void
    {
        $response = $this->actingAs($this->user)->put(route('moderationUpdate', [$this->feedback->id]),[
            'moderated' => true,
            'blocked' => true,
            'deleted' => false,
        ]);

        $response->assertRedirect();

        $response = $this->get(route('feedbackIndex'));
        
        $response->assertOk();
        $response->assertViewHas('feedback');
        $this->assertEmpty($response['feedback']);
    }

    public function testFeedbackDelete(): void
    {
        $this->actingAs($this->user)->put(route('moderationUpdate', [$this->feedback->id]),[
            'moderated' => true,
            'blocked' => true,
            'deleted' => true,
        ]);

        $this->assertNull(Feedback::query()->find($this->feedback->id));
    }
}
