<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Brand;

class BrandTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_slug()
    {
        $brand = create(Brand::class, [
            'name' => 'suzuki stuki puki'
        ]);

        $this->assertEquals(str_slug($brand->name), $brand->slug);
    }
}