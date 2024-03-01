<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testLoginGet()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
    }

    public function testLoginPost()
    {
        $response = $this->post(route('login'), [
            'username' => 'test',
            'password'=> '12345',
        ]);

        $response->assertRedirectToRoute('dashboard');
    }
}
