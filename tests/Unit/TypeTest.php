<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Type;
use App\Attribute;

class TypeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp() :void
    {
        parent::setUp();

        $this->signInAdmin();
    }

    /** @test */
    public function it_requires_a_name()
    {
        $this->post(route('admin.types.store'), [])->assertSessionHasErrors('name');

        $this->post(route('admin.types.update', create(Type::class)->id), [])->assertSessionHasErrors('name');
    }

    /** @test */
    public function name_must_be_unique()
    {
        create(Type::class, [
            'name' => 'Engine'
        ]);

        $this->post(route('admin.types.store'), [
            'name' => 'Engine'
        ])->assertSessionHasErrors('name');

        $differentType = create(Type::class, [
            'name' => 'Chassis'
        ]);

        $this->patch(route('admin.types.update', $differentType->id), [
            'name' => 'Engine'
        ])->assertSessionHasErrors('name');
    }

    /** @test */
    public function it_has_a_attributes()
    {
        $this->withoutExceptionHandling();

        $type = create(Type::class);
        
        $attribute = create(Attribute::class, [
            'type_id' => $type->id
        ]);

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $type->attributes);
    }
}