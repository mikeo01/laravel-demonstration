<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    /**
     * Test login.
     *
     * @test
     */
    public function it_should_return_redirect_to_login()
    {
        $this->get('/home')
            ->assertRedirect('login');
    }

    /**
     * Test redirect if authenticated
     * 
     * @test
     */
    public function it_should_redirect_to_home()
    {
        $this->actingAs(User::factory()->create());

        $this->get('login')
            ->assertRedirect('home');
    }

    /**
     * Test invalid login
     *
     * @test
     */
    public function it_should_show_errors_upon_incorrect_login()
    {
        $this->post('login', ['email' => 'noop@noop.com', 'password' => 'noop'])
            ->assertRedirect()

            // Errors bag present
            ->assertSessionHasErrors();
    }
}
