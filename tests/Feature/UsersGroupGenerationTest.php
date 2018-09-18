<?php
namespace  Test\Feature;

use TestCase;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

use App\Jobs\GenerateGroupUsersJob;
use App\Group;

class UsersGroupGenerationTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;


    /** @test */
    public function will_create_users_group()
    {
        $groupParams = ['number_of_users' => rand(2, 100)];
        $this->expectsJobs(GenerateGroupUsersJob::class);

        $response = $this->json('post', '/groups', $groupParams);

        $response->assertResponseStatus(201);
        $response->seeJsonStructure(['group_id']);
        $responseBody = $this->getResponseBody($response);
        $group = Group::find($responseBody  ['group_id']);
        $this->assertNotNull($group);
        $this->assertEquals($groupParams['number_of_users'], $group->number_of_users);
    }

    /** @test */
    public function will_return_users()
    {
        $group = factory(Group::class)->create();
        $group->setUsers();

        $response = $this->json('get', "/groups/{$group->id}/users");
        $response->assertResponseStatus(200);

        $responseBody = $this->getResponseBody($response);
        $this->assertEquals($group->number_of_users, count($responseBody));
    }

}