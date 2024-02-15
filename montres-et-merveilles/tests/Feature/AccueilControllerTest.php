<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccueilControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_accueil_returns_a_successful_response(): void
    {
        $response = $this->get(route("acceuil.index"));

        $response->assertStatus(200);
    }
}
