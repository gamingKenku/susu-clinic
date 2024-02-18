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

class EventTest extends TestCase
{
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::query()->where('username', '=', 'test')->first();
    }

    public function testEventIndex(): void
    {
        // events= staff check
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
}
