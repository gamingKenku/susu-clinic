<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;
use App\Models\User;
use App\Models\Clinic;
use App\Models\Discount;

class CategoryTest extends TestCase
{
    protected $user, $category, $clinic, $discounts;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::query()->where('username', '=', 'test')->first();
        $this->category = Category::query()->latest()->first();
        $this->clinic = Clinic::query()->latest()->first();
    }

    public function testCategoryIndex(): void
    {
        // category index check
        $response = $this->actingAs($this->user)->get('/admin/resources/categories');

        $response->assertOk();
        $response->assertViewHas('categories');
    }

    public function testCategoryCreateGet(): void
    {
        // category create get check
        $response = $this->actingAs($this->user)->get('/admin/resources/categories/create');

        $response->assertOk();
        $response->assertViewHas('clinics');
    }

    public function testCategoryCreatePost(): void
    {
        // category create post check
        $response = $this->actingAs($this->user)->post('/admin/resources/categories', [
            'name' => 'test name',
            'clinic_id' => $this->clinic->id,
        ]);

        $response->assertRedirect();
        
        $this->category = Category::query()->latest()->first();
        $this->assertEquals('test name', $this->category->name);
        $this->assertEquals($this->clinic->id, $this->category->clinic_id);
    }

    public function testCategoryShow(): void
    {
        // category show check
        $response = $this->actingAs($this->user)->get('/admin/resources/categories/' . $this->category->id);

        $response->assertOk();
        $this->assertEquals($this->category->name, $response['category']['name']);
        $this->assertEquals($this->category->clinic_id, $response['category']['clinic_id']);
    }

    public function testCategoryEditGet(): void
    {
        // category edit get check
        $response = $this->actingAs($this->user)->get('/admin/resources/categories/' . $this->category->id . '/edit');

        $response->assertOk();
        $this->assertEquals($this->category->name, $response['category']['name']);
        $this->assertEquals($this->category->clinic_id, $response['category']['clinic_id']);
    }

    public function testCategoryEditPost(): void
    {
        // category edit post check
        $response = $this->actingAs($this->user)->put('/admin/resources/categories/' . $this->category->id, [
            'name' => 'test name changed',
            'clinic_id' => $this->clinic->id,
        ]);
        
        $response->assertRedirect();
        $this->category = Category::query()->latest()->first();
        $this->assertEquals('test name changed', $this->category->name);
        $this->assertEquals($this->category->clinic_id, $this->clinic->id);
    }

    public function testCategoryDelete(): void
    {
        // category delete check
        $response = $this->actingAs($this->user)->delete('/admin/resources/categories/' . $this->category->id);

        $response->assertRedirect();
    }
}
