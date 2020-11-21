<?php

namespace Tests\Feature;

use Tests\TestCase;

class RequestCommandTest extends TestCase
{
    /** @test  */

    public function test_droid_navigate_command()
    {
        $this->artisan('droid:navigate', ['name' => 'James','path'=>'lf'])
             ->expectsOutput('{"message":"Lost contact.","map":"## *x ###\n## *  ###","code":410,"path":"lf"}')
             ->assertExitCode(0);
    }
}
