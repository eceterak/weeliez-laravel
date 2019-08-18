<?php

namespace Tests\Feature\Admin\Attributes;

use Tests\AdminTestCase;
use App\Attribute;
use App\Motorcycle;

class DisplayAttributeTest extends AdminTestCase
{
    /** @test */
    public function all_available_attributes_can_be_fetch_as_json()
    {
        $attribute = create(Attribute::class, [
            'name' => 'Displacement'
        ]);

        $motorcycle = create(Motorcycle::class);

        $response = $this->json('GET', route('admin.attributes.index', $motorcycle->slug))->decodeResponseJson();

        $this->assertContains($attribute->name, array_column($response[$attribute->type->name], 'name'));
    }

    /** @test */
    public function attributes_are_grouped_by_type()
    {
        $attribute = create(Attribute::class, [
            'name' => 'Displacement'
        ]);

        $motorcycle = create(Motorcycle::class);

        $response = $this->json('GET', route('admin.attributes.index', $motorcycle->slug))->decodeResponseJson();

        $this->assertEquals($attribute->type->name, array_keys($response)[0]);
    }
    
    /** @test */
    public function attributes_already_added_added_to_a_bike_wont_be_fetched_with_json()
    {
        $used = create(Attribute::class, [
            'name' => 'Displacement'
        ]);

        $notUsed = create(Attribute::class, [
            'name' => 'Horse Power',
            'type_id' => $used->type->id
        ]);

        $motorcycle = create(Motorcycle::class);

        $motorcycle->addSpecs([
            $used->type->id => [
                $used->id => 999
            ]
        ]);

        $response = $this->json('GET', route('admin.attributes.index', $motorcycle->slug))->decodeResponseJson();

        $this->assertNotContains($used->name, array_column($response[$used->type->name], 'name'));
        $this->assertContains($notUsed->name, array_column($response[$notUsed->type->name], 'name'));
    }
}