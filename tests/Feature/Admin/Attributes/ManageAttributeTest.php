<?php

namespace Tests\Feature\Admin\Attributes;

use Tests\AdminTestCase;
use App\Attribute;

class ManageAttributeTest extends AdminTestCase
{
    /** @test */
    public function attribute_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $attribute = create(Attribute::class, [
            'name' => 'Capacit'
        ]);
        
        $this->get(route('admin.attributes.edit', $attribute->id))->assertViewHas('attribute', $attribute);

        $this->patch(route('admin.attributes.update', $attribute->id), $attributes = [
            'name' => 'Capacity'
        ])->assertRedirect(route('admin.types.edit', $attribute->type->id));

        $this->assertDatabaseHas('attributes', $attributes);
    }

    /** @test */
    public function attribute_can_be_deleted()
    {
        $attribute = create(Attribute::class);

        $this->delete(route('admin.attributes.destroy', $attribute->id))->assertRedirect(route('admin.types.edit', $attribute->type->id));

        $this->assertDatabaseMissing('attributes', $attribute->only('name'));
    }
}