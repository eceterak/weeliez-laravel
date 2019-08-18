<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_have_admin_privileges()
    {
        $user = create(User::class, [
            'role' => 1
        ]);

        $this->assertTrue($user->isAdmin);
    }
}
