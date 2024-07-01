<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{

    public function test_register_loads(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_login_loads(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
}
