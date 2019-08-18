<?php

namespace Tests\Feature\Admin\Brands;

use Tests\AdminTestCase;
use App\Brand;

class DisplayBrandTest extends AdminTestCase
{
    /** @test */
    public function all_available_brands_can_be_fetch_as_json()
    {
        $brand = create(Brand::class);

        $response = $this->json('GET', route('admin.brands.index'))->decodeResponseJson();

        $this->assertEquals([$brand->name], array_column($response, 'name'));
    }
}