<?php

namespace Tests\Feature\Admin\Brands;

use Tests\AdminTestCase;
use App\Brand;

class CreateBrandTest extends AdminTestCase
{
    /** @test */
    public function brand_can_be_created()
    {
        $this->get(route('admin.brands.create'))->assertOk();

        $this->post(route('admin.brands.store'), $attributes = raw(Brand::class))
            ->assertRedirect(route('admin.brands.index'));

        $this->assertDatabaseHas('brands', $attributes);
    }
}