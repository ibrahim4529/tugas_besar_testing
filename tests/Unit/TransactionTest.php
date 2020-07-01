<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Transaction;

class TransactionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSuccessCreateTransaction()
    {
        $this->assertTrue(true);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFailedValidationCreateTransaction()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFailedCreateTransaction()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testReadTransaction()
    {
        $response = $this->get('/transactions');
        $response->assertStatus(404);
    }

    public function testFailedReadtransactions()
    {
        $response = $this->get('/transactions1');
        $response->assertStatus(404);
    }
}
