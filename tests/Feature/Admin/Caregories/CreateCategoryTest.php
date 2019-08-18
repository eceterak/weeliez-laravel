<?php

namespace Tests\Feature\Admin\Categories;

use Tests\AdminTestCase;
use App\Category;

class CreateCategoryTest extends AdminTestCase
{
    /** @test */
    public function category_can_be_created()
    {
        $this->get(route('admin.categories.create'))->assertOk();

        $this->post(route('admin.categories.store'), $attributes = raw(Category::class))
            ->assertRedirect(route('admin.categories.index'));

        $this->assertDatabaseHas('categories', $attributes);
    }
}
