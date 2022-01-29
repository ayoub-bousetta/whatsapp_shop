<?php

namespace Tests\Feature;

use App\Models\Horaire;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\Assert;
use Tests\TestCase;

class HoraireTest extends TestCase
{
    public function test_Index_Horaire()
    {

     
        $response = $this->get('clients/horaires');

       


        //check data passed to view

        $response->assertInertia(fn (Assert $page) => $page
        ->component('Auth_Users/Horaires/Index')
        ->has('horaires'));

        $response->assertStatus(200);
    }


    public function test_Add_Horaire()
    {

        //Get Page
        $response = $this->get('clients/horaire/add');
        
        

        
        $response->assertInertia(fn (Assert $page) => $page
        ->component('Auth_Users/Horaires/Add'));

        $response->assertOk();
        $response->assertStatus(200);



        $horaire=Horaire::factory()->make();
    
        $requestPost = $this->post('clients/horaire/add',$horaire->toArray());
     

         $this->assertCount(1,Horaire::all());
         $requestPost->assertRedirect(route('index_horaire'))
         ->assertSessionHas(['sucess']);

    }



    function test_Empty_from_slug(){

     

        $horaire = Horaire::factory()->make([
            'from'=>""
        ]);

        
        $requestPost = $this->post('clients/horaire/add',$horaire->toArray());
       $requestPost->assertSessionHasErrors('from'); 
      $requestPost->assertStatus(302);





    }




    public function test_Update_Horaire()
    {

        //Get Page
      
        


        $horaire = Horaire::factory()->create();




        $requestGet = $this->get('clients/horaire/edit/'.$horaire->id);
        $requestGet->assertInertia(fn (Assert $page) => $page->component('Auth_Users/Horaires/Edit'));   
            $requestGet->assertOk();
            $requestGet->assertStatus(200);


        $horairemake= Horaire::factory()->make([
            'from'=>'11:13:50',
            'to'=>'13:13:50'
        ]);

        $this->withoutExceptionHandling();

        $requestPost = $this->patch('clients/horaire/edit/'.$horaire->id,$horairemake->toArray());


         $this->assertEquals('11:13:50',Horaire::first()->from);
         $this->assertEquals('13:13:50',Horaire::first()->to);
         
         $requestPost->assertRedirect(route('index_horaire'))
         ->assertSessionHas(['sucess']);

    }



    public function test_Delete_Horaire()
    {
        $horaire = Horaire::factory()->create();
        $requestGet = $this->delete('clients/horaire/delete/'.$horaire->id);
     

        $this->assertCount(0,Horaire::all());
      
        $requestGet->assertRedirect(route('index_horaire'))
        ->assertSessionHas(['sucess']);




    }




    public function setUp(): void
    {

        parent::setUp();

        $this->login();

        


    }
}
