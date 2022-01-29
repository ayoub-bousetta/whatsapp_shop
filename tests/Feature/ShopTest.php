<?php

namespace Tests\Feature;

use App\Http\Requests\ShopRequest;
use App\Models\Currency;
use App\Models\Shop;
use Database\Seeders\ShopSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Inertia\Testing\Assert;
class ShopTest extends TestCase
{
    

    use RefreshDatabase;


    public function test_All_shops()
    {



        $response = $this->get('/clients/shops');
        $response->assertOk();





        $response->assertInertia(fn (Assert $page) => $page
        ->component('Auth_Users/Shops/Index')
        ->has('shops'));

        
     $response->assertStatus(200);





       
    }




    public function test_Add_shops(){


        $responseGet=$this->get('clients/shops/add');
        $responseGet->assertOk();
        $responseGet->assertInertia(fn (Assert $page) => $page
        ->component('Auth_Users/Shops/Add'));


        //POst
        $retaurants = Shop::factory()->make();

        $this->withoutExceptionHandling();
        $responsePost=$this->post('clients/shops/add',$retaurants->toArray());

        $this->assertCount(1,Shop::all());
        $responsePost->assertRedirect(route('index_shop'))
        ->assertSessionHas(['sucess']);





    }


    public function test_empty_shops_name(){

        $retaurants = Shop::factory()->make([
            'name'=>''
        ]);

        $responsePost=$this->post('clients/shops/add',$retaurants->toArray());
        $responsePost->assertSessionHasErrors('name'); 
        $this->assertCount(0,Shop::all());
        



    }



    public function test_Edit_shops(){



        $retaurants = Shop::factory()->create();
        $responseGet=$this->get('clients/shops/edit/'.$retaurants->id);
        $responseGet->assertOk();
        $responseGet->assertInertia(fn (Assert $page) => $page
        ->component('Auth_Users/Shops/Edit'));


        //POst
        $retaurantsdata = Shop::factory()->make([
            'name'=> 'mama'
        ]);

        $responsePost=$this->patch('clients/shops/edit/'.$retaurants->id,$retaurantsdata->toArray());




        $this->assertCount(1,Shop::all());
        $responsePost->assertRedirect(route('index_shop'))
        ->assertSessionHas(['sucess']);

     

    }


    public function test_delete_shops(){

        $retaurantsdata = Shop::factory()->create();
        $requestGet = $this->delete('clients/shops/delete/'.$retaurantsdata->id);

        $this->assertCount(0,Shop::all());
      
        $requestGet->assertRedirect(route('index_shop'))
        ->assertSessionHas(['sucess']);

    }









    public function setUp(): void
    {

        parent::setUp();

        $this->login();


        


    }
}
