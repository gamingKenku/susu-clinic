<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Service;

class DiscountTest extends TestCase
{
    protected $user, $services, $discount;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::query()->where('username', '=', 'test')->first();
        $this->discount = Discount::query()->latest()->first();
        $this->services = Service::query()->latest()->take(3)->get()->pluck('id')->toArray();
    }

    public function testDiscountIndex(): void
    {
        // discount index check
        $response = $this->actingAs($this->user)->get('/admin/resources/discounts');

        $response->assertOk();
        $response->assertViewHas('discounts');
    }

    public function testDiscountCreateGet(): void
    {
        // discount create get check
        $response = $this->actingAs($this->user)->get('/admin/resources/discounts/create');

        $response->assertOk();
        $response->assertViewHas('services');
    }

    public function testDiscountsCreatePost(): void
    {
        // discount create post check
        $response = $this->actingAs($this->user)->post('/admin/resources/discounts', [
            'header' => 'test header',
            'markup' => 'test markup',
            'start_date' => '2024-01-01 00:00:00',
            'end_date' => '2024-01-02 00:00:00',
            'services' => $this->services,
        ]);

        $response->assertRedirect();
        
        $this->discount = Discount::query()->latest()->first();
        $this->assertEquals('test header', $this->discount->header);
        $this->assertEquals('test markup', $this->discount->markup);
        $this->assertEquals('2024-01-01 00:00:00', $this->discount->start_date);
        $this->assertEquals('2024-01-02 00:00:00', $this->discount->end_date);
        $this->assertEquals($this->services, $this->discount->services()->pluck('id')->toArray());
    }

    public function testDiscountShow(): void
    {
        // discount show check
        $response = $this->actingAs($this->user)->get('/admin/resources/discounts/' . $this->discount->id);

        $response->assertOk();
        $this->assertEquals($this->discount->header, $response['discount']['header']);
        $this->assertEquals($this->discount->markup, $response['discount']['markup']);
        $this->assertEquals($this->discount->start_date, $response['discount']['start_date']);
        $this->assertEquals($this->discount->end_date, $response['discount']['end_date']);
        $servicesIds = array_map(function ($service) {
            return $service['id'];
        }, $response['discount']['services']->toArray());
        $this->assertEquals($this->services, $servicesIds);
    }

    public function testDiscountEditGet(): void
    {
        // discount edit get check
        $response = $this->actingAs($this->user)->get('/admin/resources/discounts/' . $this->discount->id . '/edit');

        $response->assertOk();
        $this->assertEquals($this->discount->header, $response['discount']['header']);
        $this->assertEquals($this->discount->markup, $response['discount']['markup']);
        $this->assertEquals($this->discount->start_date, $response['discount']['start_date']);
        $this->assertEquals($this->discount->end_date, $response['discount']['end_date']);
        $servicesIds = array_map(function ($service) {
            return $service['id'];
        }, $response['discount']['services']->toArray());
        $this->assertEquals($this->services, $servicesIds);
    }

    public function testDiscountEditPost(): void
    {
        // discount edit post check
        $response = $this->actingAs($this->user)->put('/admin/resources/discounts/' . $this->discount->id, [
            'header' => 'test header changed',
            'markup' => 'test markup changed',
            'start_date' => '2024-01-06 00:00:00',
            'end_date' => '2024-01-07 00:00:00',
            'services' => $this->services,
        ]);
        
        $response->assertRedirect();
        
        $this->discount = Discount::query()->latest()->first();
        $this->assertEquals('test header changed', $this->discount->header);
        $this->assertEquals('test markup changed', $this->discount->markup);
        $this->assertEquals('2024-01-06 00:00:00', $this->discount->start_date);
        $this->assertEquals('2024-01-07 00:00:00', $this->discount->end_date);
        $this->assertEquals($this->services, $this->discount->services()->pluck('id')->toArray());
    }

    public function testDiscountDelete(): void
    {
        // discount delete check
        $response = $this->actingAs($this->user)->delete('/admin/resources/discounts/' . $this->discount->id);

        $response->assertRedirect();
    }
}
