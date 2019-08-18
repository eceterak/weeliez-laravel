<?php

namespace Tests\Feature\Admin\Attributes;

use Tests\AdminTestCase;
use App\Type;

class CreateTypeTest extends AdminTestCase
{
    /** @test */
    public function attribute_can_be_created()
    {
        $this->signInAdmin();

        $this->get(route('admin.types.create'))->assertOk();

        $this->post(route('admin.types.store'), $attributes = raw(Type::class))
            ->assertRedirect(route('admin.types.index'));

        $this->assertDatabaseHas('types', $attributes);
    }  
}
