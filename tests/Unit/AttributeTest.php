<?php

namespace Tests\Unit;

use Tests\AdminTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Attribute;

class AttributeTest extends AdminTestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_type()
    {   
        $attribute = create(Attribute::class);

        $this->assertInstanceOf('App\Type', $attribute->type);
    }

    /** @test */
    public function it_requires_a_name()
    {
        $attribute = create(Attribute::class);

        $this->post(route('admin.attributes.store', $attribute->type->id), [])->assertSessionHasErrors('name');

        $this->post(route('admin.attributes.update', $attribute->id), [])->assertSessionHasErrors('name');
    }
}