<?php
namespace  Test\Unit;

use TestCase;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

use App\Group;

class GroupTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function should_generate_users()
    {
        $group = factory(Group::class)->create();
        $group->setUsers();
        $users = $group->getUsers();

        $this->assertEquals($group->number_of_users, count($users));
    }

}