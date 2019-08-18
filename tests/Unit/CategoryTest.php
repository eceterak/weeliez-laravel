<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Category;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_slug()
    {
        $category = create(Category::class, [
            'name' => 'Bloto supermoto'
        ]);

        $this->assertEquals(str_slug($category->name), $category->slug);
    }
}