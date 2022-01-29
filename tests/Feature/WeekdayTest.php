<?php

namespace Tests\Feature;

use App\Models\Weekday;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\Assert;
use Tests\TestCase;

class WeekdayTest extends TestCase
{
    public function test_Index_Weekday()
    {

     
        $response = $this->get('cockpit/weekdays');

       


        //check data passed to view

        $response->assertInertia(fn (Assert $page) => $page
        ->component('Admin/Weekdays/Index')
        ->has('weekdays'));

        $response->assertStatus(200);
    }


    public function test_Add_Weekday()
    {

        //Get Page
        $response = $this->get('cockpit/weekday/add');
        
        

        
        $response->assertInertia(fn (Assert $page) => $page
        ->component('Admin/Weekdays/Add'));

        $response->assertOk();
        $response->assertStatus(200);



        $weekday=Weekday::factory()->make();
        $this->withoutExceptionHandling();
        $requestPost = $this->post('cockpit/weekday/add',$weekday->toArray());
     

         $this->assertCount(1,Weekday::all());
         $requestPost->assertRedirect(route('index_weekday'))
         ->assertSessionHas(['sucess']);

    }



    function test_Empty_name_slug(){

     

        $weekday = Weekday::factory()->make([
            'name'=>""
        ]);

        
        $requestPost = $this->post('cockpit/weekday/add',$weekday->toArray());
       $requestPost->assertSessionHasErrors('name'); 
      $requestPost->assertStatus(302);





    }




    public function test_Update_Weekday()
    {

        //Get Page
      
        


        $weekday = Weekday::factory()->create();




        $requestGet = $this->get('cockpit/weekday/edit/'.$weekday->id);
        $requestGet->assertInertia(fn (Assert $page) => $page->component('Admin/Weekdays/Edit'));   
            $requestGet->assertOk();
            $requestGet->assertStatus(200);


        $weekdaymake= Weekday::factory()->make([
            'name'=>'testing'
        ]);

        $requestPost = $this->patch('cockpit/weekday/edit/'.$weekday->id,$weekdaymake->toArray());


         $this->assertEquals('testing',Weekday::first()->name);

         
         $requestPost->assertRedirect(route('index_weekday'))
         ->assertSessionHas(['sucess']);

    }



    public function test_Delete_Weekday()
    {
        $weekday = Weekday::factory()->create();
        $requestGet = $this->delete('cockpit/weekday/delete/'.$weekday->id);
     

        $this->assertCount(0,Weekday::all());
      
        $requestGet->assertRedirect(route('index_weekday'))
        ->assertSessionHas(['sucess']);




    }




    public function setUp(): void
    {

        parent::setUp();

        $this->login();

        


    }
}
