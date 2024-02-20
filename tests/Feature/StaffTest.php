<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Staff;
use App\Models\WorkingHours;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\StorageAttributes;

class StaffTest extends TestCase
{
    protected $user, $staff, $positions, $working_hours;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::query()->where('username', '=', 'test')->first();
        $this->staff = Staff::query()->latest()->first();
        $this->working_hours = WorkingHours::query()->latest()->take(3)->pluck('id')->toArray();
        $this->positions = Position::query()->latest()->take(3)->pluck('id')->toArray();
    }

    public function testStaffIndex(): void
    {
        // staff staff check
        $response = $this->actingAs($this->user)->get('/admin/resources/staff');

        $response->assertOk();
        $response->assertViewHas('staff');
    }

    public function testStaffCreateGet(): void
    {
        // staff create get check
        $response = $this->actingAs($this->user)->get('/admin/resources/staff/create');

        $response->assertOk();
        $response->assertViewHas('positions');
    }

    public function testStaffCreatePost(): void
    {
        // staff create post check
        $file = UploadedFile::fake()->image("staff{$this->staff->id}.jpg");

        $staff_type = Arr::random(['doctor', 'nurse', 'administrator']);

        $response = $this->actingAs($this->user)->post('/admin/resources/staff', [
            'first_name' => 'test first name',
            'last_name' => 'test last name',
            'patronym' => 'test patronym',
            'experience' => '2024-01-01 00:00:00',
            'specialities' => 'test specialities',
            'photo_path' => $file,
            'staff_type' => $staff_type,
            'positions' => $this->positions,
        ]);

        $response->assertRedirect();

        $this->staff = Staff::query()->latest()->first();
        $this->assertEquals('test first name', $this->staff->first_name);
        $this->assertEquals('test last name', $this->staff->last_name);
        $this->assertEquals('test patronym', $this->staff->patronym);
        $this->assertEquals('2024-01-01 00:00:00', $this->staff->experience);
        $this->assertEquals($staff_type, $this->staff->staff_type);
        $this->assertEquals($this->positions, $this->staff->positions()->pluck('id')->toArray());
        $this->assertEquals($this->staff->photo_path, "staff_photos/staff{$this->staff->id}.tmp");

        Storage::assertExists($this->staff->photo_path);
    }

    public function testStaffShow(): void
    {
        // staff show check
        $response = $this->actingAs($this->user)->get('/admin/resources/staff/' . $this->staff->id);

        $response->assertOk();
        
        $this->assertEquals($this->staff->first_name, $response['staff']['first_name']);
        $this->assertEquals($this->staff->last_name, $response['staff']['last_name']);
        $this->assertEquals($this->staff->patronym, $response['staff']['patronym']);
        $this->assertEquals($this->staff->experience, $response['staff']['experience']);
        $this->assertEquals($this->staff->photo_path, $response['staff']['photo_path']);
        $this->assertEquals($this->staff->staff_type, $response['staff']['staff_type']);
        $positionsIds = array_map(function ($position) {
            return $position['id'];
        }, $response['staff']['positions']->toArray());
        $this->assertEquals($this->staff->positions()->pluck('id')->toArray(), $positionsIds);
    }

    public function testStaffEditGet(): void
    {
        // staff edit get check
        $response = $this->actingAs($this->user)->get('/admin/resources/staff/' . $this->staff->id . '/edit');

        $response->assertOk();
        $this->assertEquals($this->staff->first_name, $response['staff']['first_name']);
        $this->assertEquals($this->staff->last_name, $response['staff']['last_name']);
        $this->assertEquals($this->staff->patronym, $response['staff']['patronym']);
        $this->assertEquals($this->staff->experience, $response['staff']['experience']);
        $this->assertEquals($this->staff->photo_path, $response['staff']['photo_path']);
        $this->assertEquals($this->staff->staff_type, $response['staff']['staff_type']);
        $positionsIds = array_map(function ($position) {
            return $position['id'];
        }, $response['staff']['positions']->toArray());
        $this->assertEquals($this->staff->positions()->pluck('id')->toArray(), $positionsIds);
    }

    public function testStaffEditPost(): void
    {
        // staff edit post check
        $file = UploadedFile::fake()->image("staff{$this->staff->id}.jpg");

        $staff_type = Arr::random(['doctor', 'nurse', 'administrator']);

        $response = $this->actingAs($this->user)->put('/admin/resources/staff/' . $this->staff->id, [
            'first_name' => 'test first name changed',
            'last_name' => 'test last name changed',
            'patronym' => 'test patronym changed',
            'specialities' => 'test specialities',
            'experience' => '2024-01-02 00:00:00',
            'photo_path' => $file,
            'staff_type' => $staff_type,
            'positions' => $this->positions,
        ]);
        
        $response->assertRedirect();

        $this->staff = Staff::query()->latest()->first();
        $this->assertEquals('test first name changed', $this->staff->first_name);
        $this->assertEquals('test last name changed', $this->staff->last_name);
        $this->assertEquals('test patronym changed', $this->staff->patronym);
        $this->assertEquals('2024-01-02 00:00:00', $this->staff->experience);
        $this->assertEquals($staff_type, $this->staff->staff_type);
        $this->assertEquals($this->positions, $this->staff->positions()->pluck('id')->toArray());
        $this->assertEquals($this->staff->photo_path, "staff_photos/staff{$this->staff->id}.tmp");
    
        Storage::assertExists($this->staff->photo_path);
    }

    public function testStaffDelete(): void
    {
        // staff delete check
        $response = $this->actingAs($this->user)->delete('/admin/resources/staff/' . $this->staff->id);

        $response->assertRedirect();
    }
}
