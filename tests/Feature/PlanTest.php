<?php

namespace Tests\Feature;

use App\Models\Plan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\Assert;
use Tests\TestCase;

class PlanTest extends TestCase
{
   
    
    public function test_Index_Plan()
    {
        $response = $this->get('cockpit/plans');

        $response->assertInertia(fn (Assert $page) => $page
        ->component('Admin/Plans/Index')
        ->has('plans'));

        $response->assertStatus(200);
    }



    public function test_Add_Plan()
    {

    
        //Get Page
        $response = $this->get('cockpit/plan/add');
        
        

        
        $response->assertInertia(fn (Assert $page) => $page
        ->component('Admin/Plans/Add'));

        $response->assertOk();
        
        $response->assertStatus(200);



        $plans=Plan::factory()->make();
        $this->withoutExceptionHandling();
        $requestPost = $this->post('cockpit/plan/add',$plans->toArray());
       
         $this->assertCount(1,Plan::all());
         $requestPost->assertRedirect(route('index_plan'))
         ->assertSessionHas(['success']);


        }




        function test_Empty_name_slug_Plan(){

     

            $plans = Plan::factory()->make([
                'name'=>""
            ]);
    
            
            $requestPost = $this->post('cockpit/plan/add',$plans->toArray());
           $requestPost->assertSessionHasErrors('name'); 
          $requestPost->assertStatus(302);
    
    
    
    
    
        }








        public function test_Update_Plan()
        {
    
            //Get Page
          
            
    
    
            $plan = Plan::factory()->create();
    
    
    
    
            $requestGet = $this->get('cockpit/plan/edit/'.$plan->id);
            $requestGet->assertInertia(fn (Assert $page) => $page->component('Admin/Plans/Edit'));   
                $requestGet->assertOk();
                $requestGet->assertStatus(200);
    
    
            $planmake= Plan::factory()->make([
                'name'=>'testing'
            ]);
    
            $requestPost = $this->patch('cockpit/plan/edit/'.$plan->id,$planmake->toArray());
    
    
             $this->assertEquals('testing',Plan::first()->name);
    
             
             $requestPost->assertRedirect(route('index_plan'))
             ->assertSessionHas(['success']);
    
        }
    
    
    
        public function test_Delete_Plan()
        {
            $plan = Plan::factory()->create();
            $requestGet = $this->delete('cockpit/plan/delete/'.$plan->id);
         
    
            $this->assertCount(0,Plan::all());
          
            $requestGet->assertRedirect(route('index_plan'))
            ->assertSessionHas(['success']);
    
    
    
    
        }
    











       
    public function setUp(): void
    {

        parent::setUp();

        $this->login();


        


    }
}
