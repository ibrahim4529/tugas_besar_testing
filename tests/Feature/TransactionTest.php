<?php

namespace Tests\Feature;

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
        $response = $this->get('/');
        $transaction = Transaction::create([
            ''
        ]);
        $this->assertTrue($transaction);
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
}
