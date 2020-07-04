<?php

namespace Tests\Unit;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProductTest extends TestCase
{
    use DatabaseMigrations;

    public function invalidCreateProductData($data, $name)
    {
        $user = factory(User::class)->make();
        $this->actingAs($user);
        $this->post(route('products.store', $data))->assertStatus(302)->assertSessionHasErrors($name);
    }

    public function invalidUpdateProductData($data, $name)
    {
        $user = factory(User::class)->make();
        $this->actingAs($user);
        factory(Product::class)->create();
        $this->post(route('products.store', $data))->assertStatus(302)->assertSessionHasErrors($name);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testVisitProductPageWithAuth()
    {
        $user = factory(User::class)->make();
        $this->actingAs($user);
        $response  = $this->get('/products');
        $response->assertStatus(200);
    }

    public function testVisitProductPageWithotAuth()
    {
        $response  = $this->get('/products');
        $response->assertRedirect('/login');
    }

    public function testCreateProductWithValidData()
    {
        $user = factory(User::class)->make();
        $this->actingAs($user);
        $data = [
            'name'=> 'Makanan',
            'price' => 1000,
            'qty' => 10
        ];
        $message_json = [
            'message' => $data['name']." Berhasil Dibuat"
        ];
        $this->post(route('products.store', $data))->assertStatus(201)->assertJson($message_json);
    }

    public function testCreateProductWithInvalidDataName()
    {
        $data = [
            'name'=> '',
            'price' => 100,
            'qty' => 10
        ];
        $this->invalidCreateProductData($data, 'name');
    }

    public function testCreateProductWithInvalidDataPriceWhenLessThenZero()
    {
        $data = [
            'name'=> 'Valid name',
            'price' => -1,
            'qty' => 10
        ];
        $this->invalidCreateProductData($data, 'price');
    }

    public function testCreateProductWithInvalidDataPriceWhenNull()
    {
        $data = [
            'name'=> 'Valid name',
            'price' => '',
            'qty' => 10
        ];
        $this->invalidCreateProductData($data, 'price');
    }


    public function testCreateProductWithInvalidDataQtyWhenLessThenZero()
    {
        $data = [
            'name'=> 'Valid name',
            'price' => 10,
            'qty' => -1
        ];
        $this->invalidCreateProductData($data, 'qty');
    }

    public function testCreateProductWithInvalidDataQtyWhenNull()
    {
        $data = [
            'name'=> 'Valid name',
            'price' => 1,
            'qty' => ''
        ];
        $this->invalidCreateProductData($data, 'qty');
    }

    public function testUpdateProductWithValidData()
    {
        $user = factory(User::class)->make();
        $this->actingAs($user);
        $product_before_update = factory(Product::class)->create();
        $data = [
            'name'=> 'Valid name',
            'price' => 1,
            'qty' => 10
        ];
        $message_json = ['message' => 'Data '.$product_before_update['name'].' Berhasil diperbarui'];
        $this->put(route('products.update', 1), $data)->assertStatus(201)->assertJson($message_json);
    }

    public function testUpadateProductWithInvalidDataName()
    {
        $data = [
            'name'=> '',
            'price' => 100,
            'qty' => 10
        ];
        $this->invalidCreateProductData($data, 'name');
    }

    public function testUpdateProductWithInvalidDataPriceWhenLessThenZero()
    {
        $data = [
            'name'=> 'Valid name',
            'price' => -1,
            'qty' => 10
        ];
        $this->invalidUpdateProductData($data, 'price');
    }

    public function testUpdateProductWithInvalidDataPriceWhenNull()
    {
        $data = [
            'name'=> 'Valid name',
            'price' => '',
            'qty' => 10
        ];
        $this->invalidUpdateProductData($data, 'price');
    }


    public function testUpdateProductWithInvalidDataQtyWhenLessThenZero()
    {
        $data = [
            'name'=> 'Valid name',
            'price' => 10,
            'qty' => -1
        ];
        $this->invalidUpdateProductData($data, 'qty');
    }

    public function testUpdateProductWithInvalidDataQtyWhenNull()
    {
        $data = [
            'name'=> 'Valid name',
            'price' => 1,
            'qty' => ''
        ];
        $this->invalidUpdateProductData($data, 'qty');
    }

    public function testDeleteProductWhenAvailable()
    {
        $user = factory(User::class)->make();
        $this->actingAs($user);
        $product = factory(Product::class)->create();

        $this->post(route('products.destroy', $product->id))->assertStatus(200);
    }

    // public function testDeleteProductWhenNotAvailable()
    // {
    //     $user = factory(User::class)->make();
    //     $this->actingAs($user);
    //     $product = factory(Product::class)->create();
    //     $this->post(route('products.destroy', 4))->assertStatus(405);
    // }
}
