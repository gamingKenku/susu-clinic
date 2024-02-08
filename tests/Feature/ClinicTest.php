<?php

namespace Tests\Feature;

use App\Models\Clinic;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClinicTest extends TestCase
{
    protected $user, $clinic;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::query()->where('username', '=', 'test')->first();
        $this->clinic = Clinic::query()->latest()->first();
    }

    public function testClinicIndex(): void
    {
        // clinic index check
        $response = $this->actingAs($this->user)->get('/admin/resources/clinics');

        $response->assertOk();
        $response->assertViewHas('clinics');
    }

    public function testClinicCreateGet(): void
    {
        // clinic create get check
        $response = $this->actingAs($this->user)->get('/admin/resources/clinics/create');

        $response->assertOk();
    }

    public function testClinicCreatePost(): void
    {
        // clinic create post check
        $response = $this->actingAs($this->user)->post('/admin/resources/clinics', [
            'name' => 'test name',
            'address' => 'test address',
        ]);

        $response->assertRedirect();
        
        $this->clinic = Clinic::query()->latest()->first();
        $this->assertEquals('test name', $this->clinic->name);
        $this->assertEquals('test address', $this->clinic->address);
    }

    public function testClinicShow(): void
    {
        // clinic show check
        $response = $this->actingAs($this->user)->get('/admin/resources/clinics/' . $this->clinic->id);

        $response->assertOk();
        $this->assertEquals($this->clinic->name, $response['clinic']['name']);
        $this->assertEquals($this->clinic->address, $response['clinic']['address']);
    }

    public function testClinicEditGet(): void
    {
        // clinic edit get check
        $response = $this->actingAs($this->user)->get('/admin/resources/clinics/' . $this->clinic->id . '/edit');

        $response->assertOk();
        $this->assertEquals($this->clinic->name, $response['clinic']['name']);
        $this->assertEquals($this->clinic->address, $response['clinic']['address']);
    }

    public function testClinicEditPost(): void
    {
        // clinic edit post check
        $response = $this->actingAs($this->user)->put('/admin/resources/clinics/' . $this->clinic->id, [
            'name' => 'test name changed',
            'address' => 'test address changed',
        ]);
        
        $response->assertRedirect();
        $this->clinic = Clinic::query()->latest()->first();
        $this->assertEquals('test name changed', $this->clinic->name);
        $this->assertEquals('test address changed', $this->clinic->address);
    }

    public function testClinicDelete(): void
    {
        // clinic delete check
        $response = $this->actingAs($this->user)->delete('/admin/resources/clinics/' . $this->clinic->id);

        $response->assertRedirect();
    }
}
