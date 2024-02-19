<?php

namespace Tests\Feature;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Staff;
use App\Models\WorkingHours;
use App\Models\Position;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\StorageAttributes;

class EventTest extends TestCase
{
    protected $user, $event;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::query()->where('username', '=', 'test')->first();
        $this->event = Event::query()->latest()->first();
    }

    public function testEventIndex(): void
    {
        // event staff check
        $response = $this->actingAs($this->user)->get('/admin/resources/events');

        $response->assertOk();
        $response->assertViewHas('events');
    }

    public function testEventCreateGet(): void
    {
        // event create get check
        $response = $this->actingAs($this->user)->get('/admin/resources/events/create');

        $response->assertOk();
    }

    public function testEventCreatePost(): void
    {
        // event create post check
        $file = UploadedFile::fake()->image("event{$this->event->id}.jpg");

        $response = $this->actingAs($this->user)->post('/admin/resources/events', [
            'header' => 'test header',
            'content' => 'test content',
            'picture_path' => $file,
        ]);

        $response->assertRedirect();

        $this->event = Event::query()->latest()->first();
        
        $this->assertEquals('test header', $this->event->header);
        $this->assertEquals('test content', $this->event->content);
        $this->assertEquals($this->event->picture_path, "event_pictures/event{$this->event->id}.tmp");

        Storage::assertExists($this->event->picture_path);
    }

    public function testEventShow(): void
    {
        // event show check
        $response = $this->actingAs($this->user)->get('/admin/resources/events/' . $this->event->id);

        $response->assertOk();
        
        $this->assertEquals($this->event->header, $response['event']['header']);
        $this->assertEquals($this->event->content, $response['event']['content']);
        $this->assertEquals($this->event->picture_path, $response['event']['picture_path']);
    }

    public function testEventEditGet(): void
    {
        // event edit get check
        $response = $this->actingAs($this->user)->get('/admin/resources/events/' . $this->event->id . '/edit');

        $response->assertOk();
        $this->assertEquals($this->event->header, $response['event']['header']);
        $this->assertEquals($this->event->content, $response['event']['content']);
        $this->assertEquals($this->event->picture_path, $response['event']['picture_path']);
    }

    public function testEventEditPost(): void
    {
        // event edit post check
        $file = UploadedFile::fake()->image("event{$this->event->id}.jpg");

        $response = $this->actingAs($this->user)->put('/admin/resources/events/' . $this->event->id, [
            'header' => 'test header changed',
            'content' => 'test content changed',
            'picture_path' => $file,
        ]);
        
        $response->assertRedirect();

        $this->event = Event::query()->latest()->first();
        $this->assertEquals('test header changed', $this->event->header);
        $this->assertEquals('test content changed', $this->event->content);
        $this->assertEquals($this->event->picture_path, "event_pictures/event{$this->event->id}.tmp");

        Storage::assertExists($this->event->picture_path);
    }

    public function testEventDelete(): void
    {
        // event delete check
        $response = $this->actingAs($this->user)->delete('/admin/resources/events/' . $this->event->id);

        $response->assertRedirect();
    }
}
