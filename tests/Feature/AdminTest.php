<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;
use App\Models\User;
use App\Models\Clinic;
use Illuminate\Support\Testing\Fakes\Fake;

use function Laravel\Prompts\error;

class AdminTest extends TestCase
{
    public function test_login(): void 
    {
        $response = $this->post('/admin/login', [
            'username' => 'test',
            'password' => '12345',
            'email' => 'test@mail.ru',
            'first_name' => 'first_name',
            'last_name' => 'last_name',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/admin');
        $this->assertAuthenticated($guard = null);
    }
}
