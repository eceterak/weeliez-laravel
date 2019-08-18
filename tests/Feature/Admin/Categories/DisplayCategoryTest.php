<?php

namespace Tests\Feature\Admin\Categories;

use Tests\AdminTestCase;
use App\Category;

class DisplayCategoryTest extends AdminTestCase
{
    /** @test */
    public function all_available_categories_can_be_fetch_as_json()
    {
        $category = create(Category::class);

        $response = $this->json('GET', route('admin.categories.index'))->decodeResponseJson();

        $this->assertEquals([$category->name], array_column($response, 'name'));
    }
}