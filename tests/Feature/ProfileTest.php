<?php

namespace Tests\Feature;

use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\Assert;
use Tests\TestCase;

class ProfileTest extends TestCase
{   

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Index_profile()
    {
       $response = $this->get('/clients/profile');
        $response->assertOk();



        $response->assertInertia(fn (Assert $page) => $page
        ->component('Auth_Users/Profile/Index')
        ->has('profile'));
        $response->assertStatus(200);
    }





    public function test_Add_profile()
    {
       $responseGet = $this->get('/clients/profile/add');
        $responseGet->assertOk();
        $responseGet->assertInertia(fn (Assert $page) => $page
        ->component('Auth_Users/Profile/Add'));
        $responseGet->assertStatus(200);


        

        $makeProfile= Profile::factory()->make();
        $responsePost = $this->post('/clients/profile/add',$makeProfile->toArray());
        $this->assertCount(1,Profile::all());
       
              
        $responsePost->assertRedirect(route('index_profile'))
        ->assertSessionHas(['sucess']);








    }



    public function test_empty_profile(){

        $makeProfile= Profile::factory()->make([
            'name'=>""
        ]);

        $responsePost = $this->post('/clients/profile/add',$makeProfile->toArray());


        
      $responsePost->assertSessionHasErrors('name'); 
      $responsePost->assertStatus(302);

    }

 


    public function test_Update_profile()
    {

        $profile= Profile::factory()->create();
       $responseGet = $this->get('/clients/profile/edit/'.$profile->id);
        $responseGet->assertOk();
        $responseGet->assertInertia(fn (Assert $page) => $page
        ->component('Auth_Users/Profile/Edit'));
        $responseGet->assertStatus(200);


        

        $makeProfile= Profile::factory()->make([
            'name'=>'mama'
        ]);
        $responsePost = $this->patch('/clients/profile/edit/'.$profile->id,$makeProfile->toArray());
      

        $this->assertEquals('mama',Profile::first()->name);
       
              
        $responsePost->assertRedirect(route('index_profile'))
        ->assertSessionHas(['sucess']);








    }


  public function test_Delete_profile(){

        $profile= Profile::factory()->create();
        $responseDelete = $this->delete('/clients/profile/delete/'.$profile->id);
        
        $this->assertCount(0,Profile::all());
       
              
        $responseDelete->assertRedirect(route('index_profile'))
        ->assertSessionHas(['sucess']);

    }




    public function setUp(): void
    {

        parent::setUp();

        $this->login();

        


    }
}
