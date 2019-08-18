<?php

namespace Tests\Feature\Motorcycles;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Motorcycle;

class CreateMotorcycleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function motorcycle_can_be_created()
    {
        $this->get(route('motorcycles.create'))->assertSeeText('Add new motorcycle');

        $this->post(route('motorcycles.store', $attributes = raw(Motorcycle::class)))
            ->assertRedirect(route('motorcycles.created', $motorcycle = Motorcycle::where($attributes)->first()));

        $this->get(route('motorcycles.created', $motorcycle->slug))->assertSeeText($attributes['name']);

        $this->assertDatabaseHas('motorcycles', $attributes);
    }
}
