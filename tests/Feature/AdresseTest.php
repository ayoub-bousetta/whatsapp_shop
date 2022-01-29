<?php

namespace Tests\Feature;

use App\Models\Adresse;
use App\Models\Adressetype;
use App\Models\Location;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\Assert;
use Tests\TestCase;

class AdresseTest extends TestCase
{
    
    
    
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Index_Adresse()
    {

     
        $response = $this->get('clients/adresses');

       


        //check data passed to view

        $response->assertInertia(fn (Assert $page) => $page
        ->component('Auth_Users/Adresses/Index')
        ->has('adresses'));

        $response->assertStatus(200);
    }


    public function test_Adding_Adresse()
    {

       
        //Get Page
        $response = $this->get('clients/adresse/add');
        
        

        
        $response->assertInertia(fn (Assert $page) => $page
        ->component('Auth_Users/Adresses/Add'));

        $response->assertOk();
        $response->assertStatus(200);


     
        $adresse=Adresse::factory()->make();

        $requestPost = $this->post('clients/adresse/add',$adresse->toArray());
        
       
        
        $this->assertCount(1,$adresse::all());
         $requestPost->assertRedirect(route('index_adresse'))
         ->assertSessionHas(['success']);

    }



    function test_Empty_Adress_name_slug(){

     

        $adresse = Adresse::factory()->make([
            'adresse'=>""
        ]);

        
        $requestPost = $this->post('clients/adresse/add',$adresse->toArray());
       $requestPost->assertSessionHasErrors('adresse'); 
      $requestPost->assertStatus(302);





    }




    public function test_Update_this_Adresse()
    {

        //Get Page
      
        


        $adresse = Adresse::factory()->create();




        $requestGet = $this->get('clients/adresse/edit/'.$adresse->id);
        $requestGet->assertInertia(fn (Assert $page) => $page->component('Auth_Users/Adresses/Edit'));   
            $requestGet->assertOk();
            $requestGet->assertStatus(200);



          


            $adressenew = Adresse::factory()->make([
                'adresse'=>"testing"
            ]);


 
        
       
      
        
        $requestPost = $this->patch('clients/adresse/edit/'.$adresse->id,
        $adressenew->toArray());


        
        $this->assertEquals('testing',Adresse::first()->adresse);

         
         $requestPost->assertRedirect(route('index_adresse'))
         ->assertSessionHas(['success']);

    }



    public function test_Delete_this_Adresse()
    {
        $adresse = Adresse::factory()->create();
        $requestGet = $this->delete('clients/adresse/delete/'.$adresse->id);
     

        $this->assertCount(0,Adresse::all());
      
        $requestGet->assertRedirect(route('index_adresse'))
        ->assertSessionHas(['success']);




    }




    public function setUp(): void
    {

        parent::setUp();

        $this->login();

        


    }








}
