<?php

namespace Tests\Unit;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Transaction;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TransactionTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;
    public function testloadTransactionPageTanpaLogin()
    {
        $this->get('/transactions')->assertRedirect('/login');
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSuccessCreateValidTransaction()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $products = factory(Product::class,2 )->create();
        foreach($products as $product){
            $product['final_price'] = 1;
        }
        $data = [
            'note'=> 'Makanan',
            'final_price' => 1000,
            'invoice' => 10,
            'user_id' => $user->id,
            'list_barang' => $products->toJson()
        ];
        $message_json = [
            'message' => 'Berhasil Menambahkan Transaksi'
        ];
        $this->post(route('transactions.store', $data))->assertStatus(201);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFailedValidationCreateTransaction()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $products = factory(Product::class,2 )->create();
        foreach($products as $product){
            $product['final_price'] = 1;
        }
        $data = [
            'note'=> 'Makanan',
            'final_price' => 1000,
            'invoice' => '',
            'user_id' => $user->id,
            'list_barang' => $products->toJson()
        ];

        $this->post(route('transactions.store', $data))->assertSessionHasErrors();

    }

}
