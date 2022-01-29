<?php

namespace Tests\Feature;

use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Inertia\Testing\Assert;
class CountryTest extends TestCase
{
   

    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Index_Country()
    {

     
        $response = $this->get('cockpit/countries');

       


        //check data passed to view

        $response->assertInertia(fn (Assert $page) => $page
        ->component('Admin/Country/Index')
        ->has('countries'));

        $response->assertStatus(200);
    }


    public function test_Add_Country()
    {

        //Get Page
        $response = $this->get('cockpit/country/add');
        
        $this->withoutExceptionHandling();

        
        $response->assertInertia(fn (Assert $page) => $page
        ->component('Admin/Country/Add'));

        $response->assertOk();
        $response->assertStatus(200);



        $country=Country::factory()->make();
        $requestPost = $this->post('cockpit/country/add',$country->toArray());

         $this->assertCount(1,$country::all());
         $requestPost->assertRedirect(route('index_country'))
         ->assertSessionHas(['success']);

    }



    function test_Empty_name_slug(){

     

        $country = Country::factory()->make([
            'name'=>""
        ]);

        
        $requestPost = $this->post('cockpit/roles/add',$country->toArray());
       $requestPost->assertSessionHasErrors('name'); 
      $requestPost->assertStatus(302);





    }




    public function test_Update_Country()
    {

        //Get Page
      
        


        $country = Country::factory()->create();




        $requestGet = $this->get('cockpit/country/edit/'.$country->id);
        $requestGet->assertInertia(fn (Assert $page) => $page->component('Admin/Country/Edit'));   
            $requestGet->assertOk();
            $requestGet->assertStatus(200);


        $countrymake= Country::factory()->make([
            'name'=>'testing'
        ]);

        $requestPost = $this->patch('cockpit/country/edit/'.$country->id,$countrymake->toArray());

         $this->assertEquals('testing',Country::first()->name);

         
         $requestPost->assertRedirect(route('index_country'))
         ->assertSessionHas(['success']);

    }



    public function test_Delete_Country()
    {
        $country = Country::factory()->create();
        $requestGet = $this->delete('cockpit/country/delete/'.$country->id);

        $this->assertCount(0,Country::all());
      
        $requestGet->assertRedirect(route('index_country'))
        ->assertSessionHas(['success']);




    }




    public function setUp(): void
    {

        parent::setUp();

        $this->login();

        


    }
}
