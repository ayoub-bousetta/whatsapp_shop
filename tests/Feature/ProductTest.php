<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\Assert;
use Tests\TestCase;

class ProductTest extends TestCase
{







    // $table->string('name');
    // $table->string('slug')->unique();
    // $table->foreignId('category_id')->constrained('categories');
    // $table->float('unit_price');
    // $table->boolean('available');
    // $table->string('sku');










    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Index_Product()
    {
        $response = $this->get('clients/products');

        $response->assertInertia(fn (Assert $page) => $page
        ->component('Auth_Users/Product/Index')
        ->has('products'));

        $response->assertStatus(200);
    }


    public function test_Add_Product()
    {
        $response = $this->get('clients/product/add');

        $response->assertInertia(fn (Assert $page) => $page
        ->component('Auth_Users/Product/Add'));

        $response->assertOk();

        $product=Product::factory()->make();

        $this->withoutExceptionHandling();
        $responsePost = $this->post('clients/product/add',$product->toArray());
        $this->assertCount(1,Product::all());
        $responsePost->assertRedirect(route('index_product'))
        ->assertSessionHas(['sucess']);

    }



  
    //Edit


    
    public function test_Edit_Product()
    {

        $oldproduct=Product::factory()->create();

        $response = $this->get('clients/product/edit/'.$oldproduct->id);

        $response->assertInertia(fn (Assert $page) => $page
        ->component('Auth_Users/Product/Edit'));

        $response->assertOk();


        $product=Product::factory()->make([
            'name'=>'testing'
        ]);

        $this->withoutExceptionHandling();
        $responsePost = $this->patch('clients/product/edit/'.$oldproduct->id,$product->toArray());
       
       
        $this->assertEquals('testing',Product::first()->name);
        $responsePost->assertRedirect(route('index_product'))
        ->assertSessionHas(['sucess']);

    }
    



    public function test_Delete_Product()
    {
        
        $product=Product::factory()->create();
        $responsePost = $this->delete('clients/product/delete/'.$product->id);
        $this->assertCount(0,Product::all());
        $responsePost->assertRedirect(route('index_product'))
        ->assertSessionHas(['sucess']);

    }






    
    public function setUp(): void
    {

        parent::setUp();

        $this->login();


        


    }
}
