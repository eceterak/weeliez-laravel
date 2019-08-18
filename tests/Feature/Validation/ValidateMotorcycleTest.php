<?php

namespace Tests\Feature\Validation;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ValidateMotorcycleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_requires_a_name()
    {
        $this->post(route('motorcycles.store'), [])->assertSessionHasErrors('name');
    }

    /** @test */
    public function it_requires_a_brand()
    {
        $this->post(route('motorcycles.store'), [])->assertSessionHasErrors('brand_id');
    }

    /** @test */
    public function it_requires_a_category()
    {
        $this->post(route('motorcycles.store'), [])->assertSessionHasErrors('category_id');
    }

    /** @test */
    public function it_requires_a_year_start()
    {
        $this->post(route('motorcycles.store'), [])->assertSessionHasErrors('year_start');
    }
    
    /** @test */
    public function valid_brand_must_be_provided()
    {
        $this->post(route('motorcycles.store'), [
            'brand_id' => 1234
        ])->assertSessionHasErrors('brand_id');
    }

    /** @test */
    public function valid_category_must_be_provided()
    {
        $this->post(route('motorcycles.store'), [
            'category_id' => 122
        ])->assertSessionHasErrors('category_id');
    }

    /** @test */
    public function year_start_must_be_numeric()
    {
        $this->post(route('motorcycles.store'), [
            'year_start' => 'asd'
        ])->assertSessionHasErrors('year_start');
    }
}
