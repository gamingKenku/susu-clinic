<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Auth;
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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\StorageAttributes;

class UserTest extends TestCase
{
    protected $user, $test_user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::query()->where('username', '=', 'test')->first();
        $this->test_user = User::query()->where('username', '!=', 'test')->latest()->first();
    }

    public function testUsersIndex(): void
    {
        // user staff check
        $response = $this->actingAs($this->user)->get('/admin/resources/users');

        $response->assertOk();
        $response->assertViewHas('users');
    }

    public function testUserCreateGet(): void
    {
        // user create get check
        $response = $this->actingAs($this->user)->get('/admin/resources/users/create');

        $response->assertOk();
    }

    public function testUserCreatePost(): void
    {
        // user create post check

        $response = $this->actingAs($this->user)->post('/admin/resources/users', [
            'username' => 'test username',
            'password' => 'test_password',
            'password_confirmation' => 'test_password',
            'email' => 'test_email@test.com',
            'first_name' => 'test first name',
            'last_name' => 'test last name',
            'patronym' => 'test patronym',
        ]);

        $response->assertRedirect();

        $this->test_user = User::query()->where('username', '!=', 'test')->latest()->first();
        
        $this->assertEquals('test username', $this->test_user->username);
        $this->assertEquals('test_email@test.com', $this->test_user->email);
        $this->assertEquals('test first name', $this->test_user->first_name);
        $this->assertEquals('test last name', $this->test_user->last_name);
        $this->assertEquals('test patronym', $this->test_user->patronym);

        $this->assertEquals(true, Auth::attempt([
            'username' => 'test username',
            'password' => 'test_password'
        ]));
    }

    public function testUserShow(): void
    {
        // user show check
        $response = $this->actingAs($this->user)->get('/admin/resources/users/' . $this->test_user->id);

        $response->assertOk();
        
        $this->assertEquals($this->test_user->username, $response['user']['username']);
        $this->assertEquals($this->test_user->email, $response['user']['email']);
    }

    public function testUserEditGet(): void
    {
        // user edit get check
        $response = $this->actingAs($this->user)->get('/admin/resources/users/' . $this->test_user->id . '/edit');

        $response->assertOk();
        $this->assertEquals($this->test_user->username, $response['user']['username']);
        $this->assertEquals($this->test_user->email, $response['user']['email']);
    }

    public function testUserEditPost(): void
    {
        // user edit post check

        $response = $this->actingAs($this->user)->put('/admin/resources/users/' . $this->test_user->id, [
            'username' => 'test username changed',
            'password' => 'test_password_changed',
            'password_confirmation' => 'test_password_changed',
            'email' => 'test_email_changed@test.com',
            'first_name' => 'test first name changed',
            'last_name' => 'test last name changed',
            'patronym' => 'test patronym changed',
        ]);
        
        $response->assertRedirect();

        $this->test_user = User::query()->latest()->first();
        $this->assertEquals('test username changed', $this->test_user->username);
        $this->assertEquals('test_email_changed@test.com', $this->test_user->email);
        $this->assertEquals('test first name changed', $this->test_user->first_name);
        $this->assertEquals('test last name changed', $this->test_user->last_name);
        $this->assertEquals('test patronym changed', $this->test_user->patronym);

        $this->assertEquals(true, Auth::attempt([
            'username' => 'test username changed',
            'password' => 'test_password_changed'
        ]));
    }

    public function testUserDelete(): void
    {
        // user delete check
        $response = $this->actingAs($this->user)->delete('/admin/resources/users/' . $this->test_user->id);

        $response->assertRedirect();
    }
}
