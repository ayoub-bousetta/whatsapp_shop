<?php

namespace Tests\Feature;

use App\Models\Adressetype;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\Assert;
use Tests\TestCase;

class AdressetypeTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Index_Adresstype()
    {

     
        $response = $this->get('cockpit/adressetypes');

       


        //check data passed to view

        $response->assertInertia(fn (Assert $page) => $page
        ->component('Admin/Adressetypes/Index')
        ->has('adressetypes'));

        $response->assertStatus(200);
    }


    public function test_Add_Adressetype()
    {

        $this->withoutExceptionHandling();
        //Get Page
        $response = $this->get('cockpit/adressetype/add');
        
        

        
        $response->assertInertia(fn (Assert $page) => $page
        ->component('Admin/Adressetypes/Add'));

        $response->assertOk();
        $response->assertStatus(200);



        $adressetype=Adressetype::factory()->make();
        $requestPost = $this->post('cockpit/adressetype/add',$adressetype->toArray());

         $this->assertCount(1,$adressetype::all());
         $requestPost->assertRedirect(route('index_adressetype'))
         ->assertSessionHas(['success']);

    }



    function test_Empty_name_slug(){

     

        $adressetype = Adressetype::factory()->make([
            'name'=>""
        ]);

        
        $requestPost = $this->post('cockpit/adressetype/add',$adressetype->toArray());
       $requestPost->assertSessionHasErrors('name'); 
      $requestPost->assertStatus(302);





    }




    public function test_Update_Adressetype()
    {

        //Get Page
      
        


        $adressetype = Adressetype::factory()->create();




        $requestGet = $this->get('cockpit/adressetype/edit/'.$adressetype->id);
        $requestGet->assertInertia(fn (Assert $page) => $page->component('Admin/Adressetypes/Edit'));   
            $requestGet->assertOk();
            $requestGet->assertStatus(200);


        $adressetypemake= Adressetype::factory()->make([
            'name'=>'testing'
        ]);

        $requestPost = $this->patch('cockpit/adressetype/edit/'.$adressetype->id,$adressetypemake->toArray());


         $this->assertEquals('testing',Adressetype::first()->name);

         
         $requestPost->assertRedirect(route('index_adressetype'))
         ->assertSessionHas(['success']);

    }



    public function test_Delete_Adressetype()
    {
        $adressetype = Adressetype::factory()->create();
        $requestGet = $this->delete('cockpit/adressetype/delete/'.$adressetype->id);
     

        $this->assertCount(0,Adressetype::all());
      
        $requestGet->assertRedirect(route('index_adressetype'))
        ->assertSessionHas(['success']);




    }




    public function setUp(): void
    {

        parent::setUp();

        $this->login();

        


    }
}
