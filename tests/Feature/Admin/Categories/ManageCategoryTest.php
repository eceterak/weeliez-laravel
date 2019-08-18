<?php

namespace Tests\Feature\Admin\Categories;

use Tests\AdminTestCase;
use App\Category;

class ManageCategoryTest extends AdminTestCase
{
    /** @test */
    public function category_can_be_updated()
    {
        $category = create(Category::class, [
            'name' => 'suprmoto'
        ]);

        $this->get(route('admin.categories.edit', $category->slug))->assertViewHas('category', $category);

        $this->patch(route('admin.categories.update', $category->slug), $attributes = [
            'name' => 'Supermoto'
        ])->assertRedirect(route('admin.categories.index'));

        $this->assertDatabaseHas('categories', $attributes);
    }

    /** @test */
    public function category_can_be_deleted()
    {
        $category = create(Category::class);

        $this->delete(route('admin.categories.destroy', $category->slug))->assertRedirect(route('admin.categories.index'));

        $this->assertDatabaseMissing('categories', $category->toArray());
    }
}