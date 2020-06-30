<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLoadUser()
    {
        $response = $this->get('http://127.0.0.1:8000/login');

        $response->assertStatus(200);
    }
}
