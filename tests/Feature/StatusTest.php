<?php

namespace Tests\Feature;

use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\Assert;
use Tests\TestCase;

class StatusTest extends TestCase
{
    
    public function test_Index_Status()
    {
        $response = $this->get('cockpit/status');

        $response->assertInertia(fn (Assert $page) => $page
        ->component('Admin/Status/Index')
        ->has('status'));

        $response->assertStatus(200);
    }



    public function test_Add_Status()
    {

    
        //Get Page
        $response = $this->get('cockpit/status/add');
        
        
       
        
        $response->assertInertia(fn (Assert $page) => $page
        ->component('Admin/Status/Add'));
       
        $response->assertOk();
        
        $response->assertStatus(200);


        $statuss=Status::factory()->make();
        
        $requestPost = $this->post('cockpit/status/add',$statuss->toArray());

        
        $this->withoutExceptionHandling();
       
         $this->assertCount(1,Status::all());
         $requestPost->assertRedirect(route('index_status'))
         ->assertSessionHas(['success']);


        }




        function test_Empty_name_slug_Status(){

     

            $statuss = Status::factory()->make([
                'name'=>""
            ]);
    
            
            $requestPost = $this->post('cockpit/status/add',$statuss->toArray());
           $requestPost->assertSessionHasErrors('name'); 
          $requestPost->assertStatus(302);
    
    
    
    
    
        }








        public function test_Update_Status()
        {
    
            //Get Page
          
            
    
    
            $status = Status::factory()->create();
    
    
    
    
            $requestGet = $this->get('cockpit/status/edit/'.$status->id);
            $requestGet->assertInertia(fn (Assert $page) => $page->component('Admin/Status/Edit'));   
                $requestGet->assertOk();
                $requestGet->assertStatus(200);
    
    
            $statusmake= Status::factory()->make([
                'name'=>'testing'
            ]);
    
            $requestPost = $this->patch('cockpit/status/edit/'.$status->id,$statusmake->toArray());
    
    
             $this->assertEquals('testing',Status::first()->name);
    
             
             $requestPost->assertRedirect(route('index_status'))
             ->assertSessionHas(['success']);
    
        }
    
    
    
        public function test_Delete_Status()
        {
            $status = Status::factory()->create();
            $requestGet = $this->delete('cockpit/status/delete/'.$status->id);
         
    
            $this->assertCount(0,Status::all());
          
            $requestGet->assertRedirect(route('index_status'))
            ->assertSessionHas(['success']);
    
    
    
    
        }
    











       
    public function setUp(): void
    {

        parent::setUp();

        $this->login();


        


    }
}
