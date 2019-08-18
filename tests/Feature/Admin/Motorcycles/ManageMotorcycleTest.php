<?php

namespace Tests\Feature\Admin\Motorcycles;

use Tests\AdminTestCase;
use App\Motorcycle;

class ManageMotorcycleTest extends AdminTestCase
{
    /** @test */
    public function motorcycle_can_be_updated()
    {
        $motorcycle = create(Motorcycle::class, [
            'name' => 'KATEM 690'
        ]);

        $this->get(route('admin.motorcycles.edit', $motorcycle->slug))->assertViewHas('motorcycle', $motorcycle);

        $this->patch(route('admin.motorcycles.update', $motorcycle->slug), $attributes = raw(Motorcycle::class, [
            'name' => 'KATEM 690',
            'brand_id' => $motorcycle->brand->id,
            'category_id' => $motorcycle->category->id
        ]))->assertRedirect(route('admin.motorcycles.index'));

        $this->assertDatabaseHas('motorcycles', $attributes);
    }

    /** @test */
    public function motorcycle_can_be_deleted()
    {
        $motorcycle = create(Motorcycle::class);

        $this->delete(route('admin.motorcycles.destroy', $motorcycle->slug))->assertRedirect(route('admin.motorcycles.index'));

        $this->assertDatabaseMissing('motorcycles', $motorcycle->only('name'));
    }
}