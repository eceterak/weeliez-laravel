<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Spec;

class SpecTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_attribute()
    {
        $spec = create(Spec::class);

        $this->assertInstanceOf('App\Attribute', $spec->attribute);
    }

    /** @test */
    public function it_belongs_to_a_type()
    {
        $spec = create(Spec::class);

        $this->assertInstanceOf('App\Type', $spec->type);
    }
}