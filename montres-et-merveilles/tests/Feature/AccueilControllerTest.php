<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AccueilControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_accueil_returns_a_successful_response(): void
    {
        $response = $this->get(route("accueil.index"));

        $response->assertStatus(200);
    }
}
