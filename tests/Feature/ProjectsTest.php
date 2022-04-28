<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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


    public function testUserCanCreateProject()
    {
        $this->withoutExceptionHandling();

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
        $attributes = Project::factory('\App\Project')->raw(['title' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    public function testsProjectRequiresDescription()
    {
        $attributes = Project::factory('\App\Project')->raw(['description' => '']);
        $this->post('/projects', [])->assertSessionHasErrors('description');
    }

    public function testsUserCanViewProject()
    {
//        $this->withoutExceptionHandling();

        $project = Project::factory('\App\Project')->create();

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

}
