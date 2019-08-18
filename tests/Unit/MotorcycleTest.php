<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Motorcycle;
use App\Brand;
use App\Category;
use App\Spec;
use App\Type;

class MotorcycleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_brand()
    {
        $brand = create(Brand::class);

        $moto = create(Motorcycle::class, [
            'brand_id' => $brand->id
        ]);

        $this->assertEquals($brand->id, $moto->brand->id);
    }

    /** @test */
    public function it_blongs_to_a_category()
    {
        $category = create(Category::class);

        $moto = create(Motorcycle::class, [
            'category_id' => $category->id
        ]);

        $this->assertEquals($category->id, $moto->category->id);
    }

    /** @test */
    public function it_has_specs()
    {
        $motorcycle = create(Motorcycle::class);

        $spec = create(Spec::class, [
            'motorcycle_id' => $motorcycle->id
        ], 5);

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $motorcycle->specs);
    }

    /** @test */
    public function it_can_group_specs_by_type()
    {
        $motorcycle = create(Motorcycle::class);

        $spec = create(Spec::class, [
            'type_id' => function() {
                return create(Type::class, [
                    'name' => 'Engine'
                ]);
            },
            'motorcycle_id' => $motorcycle->id
        ], 2);

        $this->assertEquals('Engine', $motorcycle->specs_grouped->keys()[0]);
    }

    /** @test */
    public function it_can_add_specs()
    {
        $motorcycle = create(Motorcycle::class);

        $motorcycle->addSpecs([
            1 => [
                '1' => 100
            ]
        ]);

        $this->assertEquals(100, $motorcycle->specs->first()->value);
    }

    /** @test */
    public function it_has_a_slug()
    {
        $moto = create(Motorcycle::class, [
            'name' => 'KTM 690 SMC'
        ]);

        $this->assertEquals(str_slug($moto->name), $moto->slug);
    }

    /** @test */
    public function it_can_return_all_route_required_parameters()
    {
        $moto = create(Motorcycle::class, [
            'name' => 'KTM 690 SMC'
        ]);

        $this->assertIsArray($moto->route_parameters);
    }
}