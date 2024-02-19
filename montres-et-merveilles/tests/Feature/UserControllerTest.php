<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_register(): void
    {
        $response = $this->get(route("user.register"));

        $response->assertStatus(200);
        $response->assertViewIs("register");
    }

    public function test_do_register_success(): void
    {
        $user = new User([
            "firstname" => "Prénom",
            "lastname" => "Nom de famille",
            "email" => "maxi@mili.en",
            "password" => "testing"
        ]);

        $this->assertDatabaseCount("users", 0);

        $response = $this->followingRedirects()->post(route("user.register"), [
            "firstname" => $user["firstname"],
            "lastname" => $user["lastname"],
            "email" => $user["email"],
            "password" => $user["password"],
            "password_confirmation" => $user["password"],
        ]);

        $response->assertStatus(200);
        $response->assertViewIs("accueil");
        $this->assertDatabaseHas("users", ["firstname" => $user["firstname"]]);
        $this->assertDatabaseCount("users", 1);
    }

    public function test_do_register_email_unique(): void
    {
        $user = new User([
            "firstname" => "Prénom",
            "lastname" => "Nom de famille",
            "email" => "maxi@mili.en",
            "password" => "testing"
        ]);

        $user->save();

        $this->assertDatabaseCount("users", 1);

        $response = $this->followingRedirects()->post(route("user.register"), [
            "firstname" => $user["firstname"],
            "lastname" => $user["lastname"],
            "email" => $user["email"],
            "password" => $user["password"],
            "password_confirmation" => $user["password"],
        ]);

        $response->assertStatus(200);
        $response->assertViewIs("accueil");
        $this->assertDatabaseCount("users", 1);
    }

    public function test_do_register_invalid_data()
    {
        $user = new User([
            "firstname" => "",
            "lastname" => "Nom de famille",
            "email" => "maxi@mili.en",
            "password" => "testing"
        ]);

        $this->assertDatabaseCount("users", 0);

        $response = $this->followingRedirects()->post(route("user.register"), [
            "firstname" => $user["firstname"],
            "lastname" => $user["lastname"],
            "email" => $user["email"],
            "password" => $user["password"],
            "password_confirmation" => $user["password"],
        ]);

        $response->assertStatus(200);
        $response->assertViewIs("accueil");
        $this->assertDatabaseCount("users", 0);
    }

    public function test_login(): void
    {
        $response = $this->get(route("user.login"));

        $response->assertStatus(200);
        $response->assertViewIs("login");
    }

    public function test_do_login_invalid_data(): void
    {
        $user = User::factory();
        $user->password = Hash::make("password");

        $user = $user->create();

        $response = $this->followingRedirects()->post(route("user.login"), [
            "email" => $user["email"],
            "password" => "",
        ]);

        $response->assertStatus(200);
        $response->assertViewIs("accueil");
        $this->assertGuest();
    }

    public function test_do_login_success(): void
    {
        $user = User::factory();
        $user->password = Hash::make("password");

        $user = $user->create();

        $response = $this->followingRedirects()->post(route("user.login"), [
            "email" => $user["email"],
            "password" => "password",
        ]);

        $response->assertStatus(200);
        $response->assertViewIs("accueil");
        $this->assertAuthenticatedAs($user);
    }

    public function test_do_login_wrong_credentials(): void
    {
        $user = User::factory();
        $user->password = Hash::make("password");

        $user = $user->create();

        $response = $this->followingRedirects()->post(route("user.login"), [
            "email" => $user["email"],
            "password" => "passworde",
        ]);

        $response->assertStatus(200);
        $this->assertGuest();
    }

    public function test_do_logout(): void
    {
        $user = User::factory()->create();
        Auth::login($user);

        $response = $this->followingRedirects()->post(route("user.logout"));

        $response->assertStatus(200);
        $response->assertViewIs("accueil");
        $this->assertGuest();
    }

    public function test_profile(): void
    {
        $user = User::factory()->create();
        Auth::login($user);

        $response = $this->get(route("user.profile"));

        $response->assertStatus(200);
        $response->assertSee($user["firstname"]);
    }

    public function test_update_success()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $response = $this->followingRedirects()->put(route("user.profile"), [
            "firstname" => $user["firstname"],
            "lastname" => "newLastName123",
            "password" => "password",
            "password_confirmation" => "password",
        ]);

        $user = User::find($user["id"]);

        $response->assertStatus(200);
        $response->assertViewIs("profile");
        $response->assertSee($user->firstname);
        $this->assertEquals("newLastName123", $user->lastname);
    }

    public function test_update_invalid_data()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $response = $this->followingRedirects()->put(route("user.profile"), [
            "firstname" => $user["firstname"],
            "lastname" => "",
            "password" => "password",
            "password_confirmation" => "password",
        ]);

        $user = User::find($user["id"]);

        $response->assertStatus(200);
        $response->assertViewIs("accueil");
        $this->assertNotEquals("", $user->firstname);
    }

    public function test_destroy()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $response = $this->followingRedirects()->delete(route("user.profile"));

        $response->assertStatus(200);
        $response->assertViewIs("accueil");
        $this->assertDatabaseCount("users", 0);
        $this->assertGuest();
    }
}
