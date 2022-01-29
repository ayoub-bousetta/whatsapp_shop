<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Inertia\Testing\Assert;
use Illuminate\Support\Str;
use Tests\TestCase;

class RolesTest extends TestCase
{


    use RefreshDatabase;
    public $userMan;



    /**
     * A basic feature test example.
     *
     * @return void
     */
   public function test_ShowRolePage()
    {
        

        $this->login();
        $response = $this->get('cockpit/roles');
        $roles=Role::factory()->create();
        $this->assertGreaterThanOrEqual(1,$roles->all()->count());

        //check data passed to view

        $response->assertInertia(fn (Assert $page) => $page
        ->component('Admin/Roles/Index')
        ->has('roles'));

        $response->assertStatus(200);
    }

    public function test_Show_Add_Form_Role(){


        $this->login();

        $this->withoutExceptionHandling();
        $requestGet = $this->get('cockpit/roles/add');


        $requestGet->assertOk();

        $requestGet->assertInertia(fn (Assert $page) => $page
        ->component('Admin/Roles/Add'));

        $requestGet->assertStatus(200);




         //Adding role

       
         $this->login();
         $role = Role::factory()->make();
         $requestPost = $this->post('cockpit/roles/add',$role->toArray());
        
         $this->assertCount(1,Role::all());
  
         $requestPost->assertRedirect(route('index_role'))
         ->assertSessionHas(['success']);
             


    }





    function test_Empty_name_slug(){

        $this->login();

        $role = Role::factory()->make([
            'name'=>""
        ]);

        
        $requestPost = $this->post('cockpit/roles/add',$role->toArray());
       $requestPost->assertSessionHasErrors('name'); 
      $requestPost->assertStatus(302);





    }


    function test_Edit_name_role(){

        $this->login();
        $this->withoutExceptionHandling();

        $role = Role::factory()
        ->create(['name'=>'Hello','slug'=>'hello']);


        $requestGet = $this->get('cockpit/roles/edit/'.$role->id);

       
            $requestGet->assertOK();
            $requestGet->assertStatus(200);


            $requestGet->assertInertia(fn (Assert $page) => $page->component('Admin/Roles/Edit'));  






//Update


    $requestPatch = $this->patch('cockpit/roles/edit/'.$role->id,[
        'name'=>'Testname',
        'slug'=>'testname'
    ]);
        

    $this->assertEquals('Testname',Role::first()->name);
        
    $requestPatch->assertRedirect(route('index_role'))
    ->assertSessionHas(['success']);
        


    }




        function test_Delete_name_role(){

            $this->login();
            $this->withoutExceptionHandling();
    
            $role = Role::factory()->create();

            $this->assertCount(1,Role::all());
            $requestDelete = $this->delete('cockpit/roles/delete/'.$role->id);

            $this->assertCount(0,Role::all());

            $requestDelete->assertRedirect(route('index_role'))
            ->assertSessionHas(['success']);

            
        }



    public function setUp(): void
    {

        parent::setUp();

        


    }










  
}
