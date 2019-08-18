<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class AdminAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_with_admin_privileges_can_login_to_admin_panel()
    {
        $admin = create(User::class, [
            'role' => 1,
            'password' => bcrypt($password = 'test1234')
        ]);

        $this->get(route('admin.login'))->assertViewIs('admin.auth.login');

        $this->post(route('admin.login'), [
            'email' => $admin->email,
            'password' => $password
        ])->assertRedirect(route('admin.dashboard'));
    }

    /** @test */
    public function user_without_admin_privileges_should_not_be_able_to_login_to_admin_panel()
    {
        $admin = create(User::class, [
            'role' => 0,
            'password' => bcrypt($password = 'test1234')
        ]);

        $this->post(route('admin.login'), [
            'email' => $admin->email,
            'password' => $password
        ])->assertRedirect(route('home'));
    }

    /** @test */
    public function authenticated_user_is_redirected_home_if_tries_to_enter_admin_page_without_admin_privileges()
    {
        $this->signIn();

        $this->get(route('admin.brands.index'))->assertRedirect(route('home'));
    }
}
