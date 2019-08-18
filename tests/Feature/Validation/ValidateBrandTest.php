<?php

namespace Tests\Feature\Validation;

use Tests\AdminTestCase;
use App\Brand;

class ValidateBrandTest extends AdminTestCase
{
    /** @test */
    public function it_requires_a_name()
    {
        $this->post(route('admin.brands.store'), [])->assertSessionHasErrors('name');

        $this->post(route('admin.brands.update', create(Brand::class)->slug), [])->assertSessionHasErrors('name');
    }

    /** @test */
    public function name_must_be_unique()
    {
        create(Brand::class, [
            'name' => 'Suzuki'
        ]);

        $this->post(route('admin.brands.store'), [
            'name' => 'Suzuki'
        ])->assertSessionHasErrors('name');

        $differentBrand = create(Brand::class, [
            'name' => 'KTM'
        ]);

        $this->patch(route('admin.brands.update', $differentBrand->slug), [
            'name' => 'Suzuki'
        ])->assertSessionHasErrors('name');
    }

    /** @test */
    public function name_must_be_at_least_2_characters_long()
    {
        $this->post(route('admin.brands.store'), [
            'name' => 'A'
        ])->assertSessionHasErrors('name');

        $this->post(route('admin.brands.update', create(Brand::class)->slug), [
            'name' => 'A'
        ])->assertSessionHasErrors('name');
    }
}