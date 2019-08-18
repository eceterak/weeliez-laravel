<?php

namespace Tests\Feature\Admin\Brands;

use Tests\AdminTestCase;
use App\Brand;

class ManageBrandTest extends AdminTestCase
{
    /** @test */
    public function brand_can_be_updated()
    {
        $brand = create(Brand::class, [
            'name' => 'Szki'
        ]);
        
        $this->get(route('admin.brands.edit', $brand->slug))->assertViewHas('brand', $brand);

        $this->patch(route('admin.brands.update', $brand->slug), $attributes = [
            'name' => 'Suzuki'
        ])->assertRedirect(route('admin.brands.index'));

        $this->assertDatabaseHas('brands', $attributes);
    }

    /** @test */
    public function brand_can_be_deleted()
    {
        $brand = create(Brand::class);

        $this->delete(route('admin.brands.destroy', $brand->slug))->assertRedirect(route('admin.brands.index'));

        $this->assertDatabaseMissing('brands', $brand->toArray());
    }
}