<?php

namespace Tests\Feature\Validation;

use Tests\AdminTestCase;
use App\Category;

class ValidateCategoryTest extends AdminTestCase
{
    /** @test */
    public function it_requires_a_name()
    {
        $this->post(route('admin.categories.store'), [])->assertSessionHasErrors('name');

        $this->post(route('admin.categories.update', create(Category::class)->slug), [])->assertSessionHasErrors('name');
    }

    /** @test */
    public function name_must_be_unique()
    {
        create(Category::class, [
            'name' => 'Supermoto'
        ]);

        $this->post(route('admin.categories.store'), [
            'name' => 'Supermoto'
        ])->assertSessionHasErrors('name');

        $differentCategory = create(Category::class, [
            'name' => 'Sport'
        ]);

        $this->patch(route('admin.categories.update', $differentCategory->slug), [
            'name' => 'Supermoto'
        ])->assertSessionHasErrors('name');
    }

    /** @test */
    public function name_must_be_at_least_2_characters_long()
    {
        $this->post(route('admin.categories.store'), [
            'name' => 'A'
        ])->assertSessionHasErrors('name');

        $this->post(route('admin.categories.update', create(Category::class)->slug), [
            'name' => 'A'
        ])->assertSessionHasErrors('name');
    }
}