<?php

namespace Tests\Feature;

use App\Models\Currency;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\Assert;
use Tests\TestCase;

class CurrencyTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_Currency()
    {
        $response = $this->get('cockpit/currencies');

    
        //check data passed to view

        $response->assertInertia(fn (Assert $page) => $page
        ->component('Admin/Currencies/Index')
        ->has('currencies'));

        $response->assertStatus(200);
    }


    public function test_Add_Currency()
    {

        //Get Page
        $response = $this->get('cockpit/currency/add');
        
        
       
        
        $response->assertInertia(fn (Assert $page) => $page
        ->component('Admin/Currencies/Add'));

        $response->assertOk();
        $response->assertStatus(200);



        $currency=Currency::factory()->make();
        $requestPost = $this->post('cockpit/currency/add',$currency->toArray());

         $this->assertCount(1,Currency::all());
         $requestPost->assertRedirect(route('index_currency'))
         ->assertSessionHas(['sucess']);

    }






    function test_Empty_code(){

     

        $currency = Currency::factory()->make([
            'code'=>""
        ]);

        
        $requestPost = $this->post('cockpit/currency/add',$currency->toArray());
       $requestPost->assertSessionHasErrors('code'); 
      $requestPost->assertStatus(302);





    }



    public function test_Update_Currency()
    {

        //Get Page
      
        


        $currency = Currency::factory()->create();




        $requestGet = $this->get('cockpit/currency/edit/'.$currency->id);
        $requestGet->assertInertia(fn (Assert $page) => $page->component('Admin/Currencies/Edit'));   
            $requestGet->assertOk();
            $requestGet->assertStatus(200);


        $currencymake= Currency::factory()->make([
            'name'=>'testing'
        ]);

        $requestPost = $this->patch('cockpit/currency/edit/'.$currency->id,$currencymake->toArray());


         $this->assertEquals('testing',Currency::first()->name);

         
         $requestPost->assertRedirect(route('index_currency'))
         ->assertSessionHas(['sucess']);

    }



    public function test_Delete_Currency()
    {
        $currency = Currency::factory()->create();
        $requestGet = $this->delete('cockpit/currency/delete/'.$currency->id);
     

        $this->assertCount(0,Currency::all());
      
        $requestGet->assertRedirect(route('index_currency'))
        ->assertSessionHas(['sucess']);




    }



    
    public function setUp(): void
    {

        parent::setUp();

        $this->login();

        


    }
}
