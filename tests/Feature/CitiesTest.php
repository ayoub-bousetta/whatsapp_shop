<?php

namespace Tests\Feature;

use App\Models\City;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Inertia\Testing\Assert;
class CitiesTest extends TestCase
{


    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Index_Cities()
    {

     
        $response = $this->get('cockpit/cities');


        //check data passed to view

        $response->assertInertia(fn (Assert $page) => $page
        ->component('Admin/Cities/Index')
        ->has('cities'));

        $response->assertStatus(200);
    }


    public function test_Add_Cities()
    {

        //Get Page
        $response = $this->get('cockpit/cities/add');
        

        $this->withoutExceptionHandling();

        
        $response->assertInertia(fn (Assert $page) => $page
        ->component('Admin/Cities/Add'));

        $response->assertOk();
        $response->assertStatus(200);



        $cities=City::factory()->make();
        
        $requestPost = $this->post('cockpit/cities/add',$cities->toArray());

         $this->assertCount(1,City::all());
         $requestPost->assertRedirect(route('index_city'))
         ->assertSessionHas(['success']);

    }



    function test_Empty_name_slug(){

     

        $cities = City::factory()->make([
            'name'=>""
        ]);

        
        $requestPost = $this->post('cockpit/roles/add',$cities->toArray());
       $requestPost->assertSessionHasErrors('name'); 
      $requestPost->assertStatus(302);





    }




    public function test_Update_Cities()
    {

        //Get Page
      
        


        $cities = City::factory()->create();




        $requestGet = $this->get('cockpit/cities/edit/'.$cities->id);
        $requestGet->assertInertia(fn (Assert $page) => $page->component('Admin/Cities/Edit'));   
            $requestGet->assertOk();
            $requestGet->assertStatus(200);


        $citiesmake= City::factory()->make([
            'name'=>'testing'
        ]);

        $requestPost = $this->patch('cockpit/cities/edit/'.$cities->id,$citiesmake->toArray());


         $this->assertEquals('testing',City::first()->name);

         
         $requestPost->assertRedirect(route('index_city'))
         ->assertSessionHas(['success']);

    }



    public function test_Delete_Cities()
    {
        $cities = City::factory()->create();
        $requestGet = $this->delete('cockpit/cities/delete/'.$cities->id);

        $this->assertCount(0,City::all());
      
        $requestGet->assertRedirect(route('index_city'))
        ->assertSessionHas(['success']);




    }




    public function setUp(): void
    {

        parent::setUp();

        $this->login();

        


    }
}
