<?php

namespace Tests\Feature\Motorcycles;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Motorcycle;

class DisplayMotorcycleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_list_all_motorcycles()
    {
        $motorcycle = create(Motorcycle::class);

        $this->get(route('motorcycles.index'))->assertSeeText($motorcycle->name);
    }

    /** @test */
    public function a_user_can_show_single_motorcycle()
    {
        $motorcycle = create(Motorcycle::class);

        $this->get(route('motorcycles.show', $motorcycle->route_parameters))->assertSeeText($motorcycle->name);
    }
}