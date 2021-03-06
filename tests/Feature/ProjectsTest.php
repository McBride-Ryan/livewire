<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
   use WithFaker, RefreshDatabase;



    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testsProjectRequiresOwner()
    {
        // $this->withoutExceptionHandling();

        $attributes = Project::factory()->raw();

        $this->post('/projects', $attributes)->assertRedirect('login');
    }

    public function testUserCanBeRegister()
    {
        $attributes = [
            'email' => $this->faker->email
        ];

        $this->post('/register', $attributes);

        $this->assertDatabaseMissing('users', $attributes);
    }


    public function testUserCanBeRegisteredWithLivewire()
    {
        Livewire::test('auth.register')
            ->set('email', 'ryan@test.com')
            ->set('password', 'secret')
            ->set('passwordConfirmation', 'secret')
            ->call('register')
            ->assertRedirect('/register');

        $this->assertTrue(User::whereEmail('ryan@test.com')->exists());

        $this->assertEquals('ryan@test.com', auth()->user()->email);

    }

    public function testEmailHasNotAlreadyBeenTakenWhileUserTypes()
    {
        User::create([
            'email' => 'ryan@test.com',
            'password' => Hash::make('password')
        ]);

        Livewire::test('auth.register')
            ->set('email', 'rya@test.com')
            ->assertHasNoErrors()
            ->set('email', 'ryan@test.com')
            ->assertHasErrors();
    }

    public function testUserCanCreateProject()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(User::factory()->create());

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];

        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);

    }

    public function testsProjectRequiresTitle()
    {
        $this->actingAs(User::factory()->create());

        $attributes = Project::factory('\App\Project')->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    public function testsProjectRequiresDescription()
    {
        $this->actingAs(User::factory()->create());

        $attributes = Project::factory('\App\Project')->raw(['description' => '']);

        $this->post('/projects', [])->assertSessionHasErrors('description');
    }

    public function testsUserCanViewProject()
    {
        $this->be(User::factory()->create());

        $this->withoutExceptionHandling();

        $project = Project::factory('\App\Project')->create();

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }


    public function testsGuestsCannotCreateProjects()
    {
        $attributes=Project::factory()->raw();

        $this->post('/projects', $attributes)->assertRedirect('login');
    }

    public function testsGuestsCannotViewProjects()
    {
        $attributes=Project::factory()->raw();

        $this->get('/projects', $attributes)->assertRedirect('login');
    }

    public function testsGuestsCannotViewSingleProjects()
    {
        $project = Project::factory()->create();

        $this->get($project->path())->assertRedirect('login');
    }

    public function testsAuthUserCannotViewProjectOfOthers()
    {

        $this->be(User::factory()->create());

//        $this->withoutExceptionHandling();

        $project = Project::factory()->create();

        $this->get($project->path())->assertStatus(403);


    }

}
