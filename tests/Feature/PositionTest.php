<?php

namespace Tests\Feature;

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

class PositionTest extends TestCase
{
    protected $user, $staff, $position;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::query()->where('username', '=', 'test')->first();
        $this->staff = Staff::query()->latest()->take(3)->pluck('id')->toArray();
        $this->position = Position::query()->latest()->first();
    }

    public function testPositionIndex(): void
    {
        // position staff check
        $response = $this->actingAs($this->user)->get('/admin/resources/positions');

        $response->assertOk();
        $response->assertViewHas('positions');
    }

    public function testPositionCreateGet(): void
    {
        // position create get check
        $response = $this->actingAs($this->user)->get('/admin/resources/positions/create');

        $response->assertOk();
        $response->assertViewHas('staff');
    }

    public function testPositionCreatePost(): void
    {
        // position create post check

        $response = $this->actingAs($this->user)->post('/admin/resources/positions', [
            'name' => 'test name',
            'description' => 'test description',
            'responsibilities' => 'test responsibilities',
            'requirements' => 'test requirements',
            'conditions' => 'test conditions',
            'has_vacancy' => true,
            'staff' => $this->staff,
        ]);

        $response->assertRedirect();

        $this->position = Position::query()->latest()->first();
        $this->assertEquals('test name', $this->position->name);
        $this->assertEquals('test description', $this->position->description);
        $this->assertEquals('test responsibilities', $this->position->responsibilities);
        $this->assertEquals('test requirements', $this->position->requirements);
        $this->assertEquals('test conditions', $this->position->conditions);
        $this->assertEquals(true, $this->position->has_vacancy);
        $this->assertEquals($this->staff, $this->position->staff()->pluck('id')->toArray());
    }

    public function testPositionShow(): void
    {
        // positions show check
        $response = $this->actingAs($this->user)->get('/admin/resources/positions/' . $this->position->id);

        $response->assertOk();
        
        $this->assertEquals($this->position->name, $response['position']['name']);
        $this->assertEquals($this->position->description, $response['position']['description']);
        $this->assertEquals($this->position->responsibilities, $response['position']['responsibilities']);
        $this->assertEquals($this->position->requirements, $response['position']['requirements']);
        $this->assertEquals($this->position->conditions, $response['position']['conditions']);
        
        $staffIds = array_map(function ($staff) {
            return $staff['id'];
        }, $response['position']['staff']->toArray());

        $this->assertEquals($this->position->staff()->pluck('id')->toArray(), $staffIds);
    }

    public function testPositionEditPost(): void
    {
        // position edit post check

        $response = $this->actingAs($this->user)->put('/admin/resources/positions/' . $this->position->id, [
            'name' => 'test name changed',
            'description' => 'test description changed',
            'responsibilities' => 'test responsibilities changed',
            'requirements' => 'test requirements changed',
            'conditions' => 'test conditions changed',
            'has_vacancy' => false,
            'staff' => $this->staff,
        ]);
        
        $response->assertRedirect();

        $this->position = Position::query()->latest()->first();
        $this->assertEquals('test name changed', $this->position->name);
        $this->assertEquals('test description changed', $this->position->description);
        $this->assertEquals('test responsibilities changed', $this->position->responsibilities);
        $this->assertEquals('test requirements changed', $this->position->requirements);
        $this->assertEquals('test conditions changed', $this->position->conditions);
        $this->assertEquals(false, $this->position->has_vacancy);
        $this->assertEquals($this->staff, $this->position->staff()->pluck('id')->toArray());
    }

    public function testPositionDelete(): void
    {
        // position delete check
        $response = $this->actingAs($this->user)->delete('/admin/resources/positions/' . $this->position->id);

        $response->assertRedirect();
    }
}
