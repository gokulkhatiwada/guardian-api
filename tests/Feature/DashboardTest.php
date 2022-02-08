<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_see_dashboard()
    {
        $user = User::factory()->create([
            'is_admin'=>true,
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertViewIs('back.dashboard');
    }

    public function test_user_cannot_see_dashboard()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(403);
    }

    public function test_setting_form()
    {
        $user = User::factory()->create([
            'is_admin'=>true,
        ]);

        $response = $this->actingAs($user)->get('/dashboard/settings');

        $response->assertViewIs('back.settings.index');
    }

    public function test_setting_update()
    {
        $user = User::factory()->create([
            'is_admin'=>true,
        ]);
        $response = $this->actingAs($user)->post('/dashboard/settings',[
            'name'=>'name',
            'description'=>'description',
            'metaTitle'=>'title',
            'metaDescription'=>'description',
            'email'=>'email@mail.com',
            'contact'=>'123456789',
            'address'=>'address',
        ]);

        $response->assertRedirect('/dashboard/settings');

        $this->assertDatabaseHas('settings',[
            'id'=>1,
            'name'=>'name',
            'description'=>'description',
            'meta_title'=>'title',
            'meta_description'=>'description',
            'email'=>'email@mail.com',
            'contact'=>'123456789',
            'address'=>'address',
        ]);
    }

    public function test_api_credential_form()
    {
        $user = User::factory()->create([
            'is_admin'=>true,
        ]);
        $response = $this->actingAs($user)->get('/dashboard/api-credentials');

        $response->assertViewIs('back.api-credentials.index');
    }

    public function test_api_update_request()
    {
        $user = User::factory()->create([
            'is_admin'=>true,
        ]);

        $response = $this->actingAs($user)->post('/dashboard/api-credentials',[
            'url'=>'https://example.com',
            'key'=>'asdask-asdsa-dasdas-das'
        ]);

        $response->assertRedirect('/dashboard/api-credentials');
        $this->assertDatabaseHas('guardian_api_credentials',[
            'base_url'=>'https://example.com',
            'api_key'=>'asdask-asdsa-dasdas-das'
        ]);
    }

    public function test_category_form()
    {
        $user = User::factory()->create([
            'is_admin'=>true,
        ]);

        $response = $this->actingAs($user)->get('/dashboard/categories');
        $response->assertViewIs('back.categories.index');
        $response->assertViewHas('categories');
    }

    public function test_category_store()
    {
        $user = User::factory()->create([
            'is_admin'=>true,
        ]);

        $response = $this->actingAs($user)->post('/dashboard/categories/create',[
            'name'=>'test'
        ]);

        $response->assertRedirect('/dashboard/categories');

        $this->assertDatabaseHas('categories',[
            'name'=>'test',
            'slug'=>\Illuminate\Support\Str::slug('test','-'),
            'created_by'=>$user->id
        ]);
    }

    public function test_category_update_form()
    {
        $category = \App\Models\Category::factory()->create();

        $user = User::factory()->create([
            'is_admin'=>true,
        ]);

        $response = $this->actingAs($user)->get('/dashboard/categories/update/'.$category->slug);

        $response->assertViewIs('back.categories.update');

        $response->assertViewHas('category');
    }

    public function test_category_update()
    {
        $category = \App\Models\Category::factory()->create();

        $user = User::factory()->create([
            'is_admin'=>true,
        ]);

        $response = $this->actingAs($user)->post('/dashboard/categories/update/'.$category->slug,[
            'name'=>'new category'
        ]);

        $response->assertRedirect('/dashboard/categories');
        $this->assertDatabaseHas('categories',[
            'name'=>'new category',
            'slug'=>\Illuminate\Support\Str::slug('new category'),
            'updated_by'=>$user->id
        ]);
    }

    public function test_category_destroy()
    {
        $category = \App\Models\Category::factory()->create();

        $user = User::factory()->create([
            'is_admin'=>true,
        ]);

        $response = $this->actingAs($user)->get('/dashboard/categories/delete/'.$category->slug);

        $response->assertRedirect('/dashboard/categories');

        $this->assertDatabaseMissing('categories',[
            'id'=>$category->id
        ]);
    }
}