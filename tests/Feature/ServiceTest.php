<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Service;

class ServiceTest extends TestCase
{
    protected $user, $category, $service, $discounts;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::query()->where('username', '=', 'test')->first();
        $this->category = Category::query()->latest()->first();
        $this->service = Service::query()->latest()->first();
        $this->discounts = Discount::query()->latest()->take(3)->get()->pluck('id')->toArray();
    }

    public function testServiceIndex(): void
    {
        // service index check
        $response = $this->actingAs($this->user)->get('/admin/resources/services');

        $response->assertOk();
        $response->assertViewHas('services');
    }

    public function testServiceCreateGet(): void
    {
        // service create get check
        $response = $this->actingAs($this->user)->get('/admin/resources/services/create');

        $response->assertOk();
        $response->assertViewHas('discounts');
        $response->assertViewHas('categories');
    }

    public function testServiceCreatePost(): void
    {
        // service create post check
        $response = $this->actingAs($this->user)->post('/admin/resources/services', [
            'name' => 'test name',
            'price' => 100.00,
            'category_id' => $this->category->id,
            'discounts' => $this->discounts,
        ]);

        $response->assertRedirect();
        
        $this->service = Service::query()->latest()->first();
        $this->assertEquals('test name', $this->service->name);
        $this->assertEquals($this->category->id, $this->service->category_id);
        $this->assertEquals(100.00, $this->service->price);
        $this->assertEquals($this->discounts, $this->service->discounts()->pluck('id')->toArray());
    }

    public function testServiceShow(): void
    {
        // service show check
        $response = $this->actingAs($this->user)->get('/admin/resources/services/' . $this->service->id);

        $response->assertOk();
        $this->assertEquals($this->service->name, $response['service']['name']);
        $this->assertEquals($this->service->price, $response['service']['price']);
        $this->assertEquals($this->service->category_id, $response['service']['category_id']);
        $discountIds = array_map(function ($discount) {
            return $discount['id'];
        }, $response['service']['discounts']->toArray());
        $this->assertEquals($this->discounts, $discountIds);
    }

    public function testServiceEditGet(): void
    {
        // service edit get check
        $response = $this->actingAs($this->user)->get('/admin/resources/services/' . $this->service->id . '/edit');

        $response->assertOk();
        $this->assertEquals($this->service->name, $response['service']['name']);
        $this->assertEquals($this->service->price, $response['service']['price']);
        $this->assertEquals($this->service->category_id, $response['service']['category_id']);
        $discountIds = array_map(function ($discount) {
            return $discount['id'];
        }, $response['service']['discounts']->toArray());
        $this->assertEquals($this->service->discounts()->pluck('id')->toArray(), $discountIds);
    }

    public function testServiceEditPost(): void
    {
        // service edit post check
        $response = $this->actingAs($this->user)->put('/admin/resources/services/' . $this->service->id, [
            'name' => 'test name changed',
            'price' => 200.00,
            'category_id' => $this->category->id,
            'discounts' => $this->discounts,
        ]);
        
        $response->assertRedirect();
        $this->service = Service::query()->latest()->first();
        $this->assertEquals('test name changed', $this->service->name);
        $this->assertEquals($this->service->category_id, $this->category->id);
        $this->assertEquals($this->service->price, 200.00);
        $this->assertEquals($this->service->discounts()->pluck('id')->toArray(), $this->discounts);
    }

    public function testServiceDelete(): void
    {
        // service delete check
        $response = $this->actingAs($this->user)->delete('/admin/resources/services/' . $this->service->id);

        $response->assertRedirect();
    }
}
