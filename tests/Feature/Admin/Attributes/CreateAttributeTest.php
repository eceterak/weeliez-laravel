<?php

namespace Tests\Feature\Admin\Attributes;

use Tests\AdminTestCase;
use App\Attribute;
use App\Type;

class CreateAttributeTest extends AdminTestCase
{
    /** @test */
    public function attribute_can_be_created()
    {
        $type = create(Type::class);

        $this->get(route('admin.attributes.create', $type->id))->assertOk();

        $this->post(route('admin.attributes.store', $type->id), $attributes = raw(Attribute::class, [
            'type_id' => $type->id
        ]))->assertRedirect(route('admin.types.edit', $type->id));

        $this->assertDatabaseHas('attributes', $attributes);
    }   
}