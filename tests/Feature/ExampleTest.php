<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_user_can_see_login_form()
    {
        $response = $this->get('/auth/login');
        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    public function test_user_cannot_see_login_when_logged_in()
    {
        $user = User::factory()->make();
        $response = $this->actingAs($user)->get('/auth/login');
        $response->assertRedirect('/');
    }

    public function test_user_can_login()
    {
        $user = User::factory()->create([
            'name'=>'John Doe',
            'email'=>'john@mail.com',
            'password'=>Hash::make('hello123')
        ]);
        $response = $this->post('/auth/login',[
            'email'=>'john@mail.com',
            'password'=>'hello123'
        ]);
        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
    }


    public function test_make_admin_command()
    {
        $this->artisan('make:admin')
            ->expectsQuestion(PHP_EOL.'What is your admin name?','John Doe')
            ->expectsQuestion(PHP_EOL.'What is your admin email?','john@mail.com')
            ->expectsQuestion(PHP_EOL.'What is your admin password?','hello123')
            ->expectsOutput(PHP_EOL.'Admin created successfully.')
            ->assertExitCode(0);

        $this->assertDatabaseHas('users',[
            'email'=>'john@mail.com',
            'name'=>'John Doe',
            'is_admin'=>true
        ]);
    }


}
