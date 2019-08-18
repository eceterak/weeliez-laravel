<?php

namespace Tests\Feature\Admin\Motorcycles;

use Tests\AdminTestCase;
use App\Motorcycle;
use App\Attribute;

class CreateMotorcycleTest extends AdminTestCase
{
    /** @test */
    public function motorcycle_can_be_created()
    {
        $this->get(route('admin.motorcycles.create'))->assertOk();

        $this->post(route('admin.motorcycles.store'), $attributes = raw(Motorcycle::class))
            ->assertRedirect();

        $this->assertDatabaseHas('motorcycles', $attributes);   
    }

    /** @test */
    public function attributes_can_be_added_to_a_motorcycle()
    {
        $this->withoutExceptionHandling();

        $motorcycle = create(Motorcycle::class);

        $attribute = create(Attribute::class, [
            'name' => 'Displacement'
        ]);

        $this->patch(route('admin.motorcycles.update', $motorcycle->slug), $attributes = raw(Motorcycle::class, [
            'name' => 'KATEM 690',
            'brand_id' => $motorcycle->brand->id,
            'category_id' => $motorcycle->category->id,
            'specs' => [
                $attribute->type->id => [
                    $attribute->id => 999
                ]
            ]
        ]))->assertRedirect(route('admin.motorcycles.index'));

        $this->assertCount(1, $motorcycle->specs);
    }
}