<?php

namespace Tests\Feature\Admin\Attributes;

use Tests\AdminTestCase;
use App\Type;

class ManageTypeTest extends AdminTestCase
{
    /** @test */
    public function type_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $type = create(Type::class, [
            'name' => 'Engin'
        ]);
        
        $this->get(route('admin.types.edit', $type->id))->assertViewHas('type', $type);

        $this->patch(route('admin.types.update', $type->id), $attributes = [
            'name' => 'Engine'
        ])->assertRedirect(route('admin.types.index'));

        $this->assertDatabaseHas('types', $attributes);
    }

    /** @test */
    public function type_can_be_deleted()
    {
        $type = create(Type::class);

        $this->delete(route('admin.types.destroy', $type->id))->assertRedirect(route('admin.types.index'));

        $this->assertDatabaseMissing('types', $type->toArray());
    }
}