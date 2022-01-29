<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;
use Inertia\Testing\Assert;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Index_Category()
    {

     
        $response = $this->get('cockpit/categories');

       


        //check data passed to view

        $response->assertInertia(fn (Assert $page) => $page
        ->component('Admin/Categories/Index')
        ->has('categories'));

        $response->assertStatus(200);
    }


    public function test_Add_Category()
    {

        //Get Page
        $response = $this->get('cockpit/category/add');
        
        

        
        $response->assertInertia(fn (Assert $page) => $page
        ->component('Admin/Categories/Add'));

        $response->assertOk();
        $response->assertStatus(200);



        $category=Category::factory()->make();
        $requestPost = $this->post('cockpit/category/add',$category->toArray());

         $this->assertCount(1,Category::all());
         $requestPost->assertRedirect(route('index_category'))
         ->assertSessionHas(['success']);

    }



    function test_Empty_name_slug(){

     

        $category = Category::factory()->make([
            'name'=>""
        ]);

        
        $requestPost = $this->post('cockpit/category/add',$category->toArray());
       $requestPost->assertSessionHasErrors('name'); 
      $requestPost->assertStatus(302);





    }




    public function test_Update_Category()
    {

        //Get Page
      
        


        $category = Category::factory()->create();




        $requestGet = $this->get('cockpit/category/edit/'.$category->id);
        $requestGet->assertInertia(fn (Assert $page) => $page->component('Admin/Categories/Edit'));   
            $requestGet->assertOk();
            $requestGet->assertStatus(200);


        $categorymake= Category::factory()->make([
            'name'=>'testing'
        ]);

        $requestPost = $this->patch('cockpit/category/edit/'.$category->id,$categorymake->toArray());


         $this->assertEquals('testing',Category::first()->name);

         
         $requestPost->assertRedirect(route('index_category'))
         ->assertSessionHas(['success']);

    }



    public function test_Delete_Category()
    {
        $category = Category::factory()->create();
        $requestGet = $this->delete('cockpit/category/delete/'.$category->id);
     

        $this->assertCount(0,Category::all());
      
        $requestGet->assertRedirect(route('index_category'))
        ->assertSessionHas(['success']);




    }




    public function setUp(): void
    {

        parent::setUp();

        $this->login();

        


    }
}
