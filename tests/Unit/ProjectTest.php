<?php

namespace Tests\Unit;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testItHasPath()
    {
        $project = Project::factory('\App\Project')->create();

        $this->assertEquals('/projects/' . $project->id, $project->path());
    }
}
