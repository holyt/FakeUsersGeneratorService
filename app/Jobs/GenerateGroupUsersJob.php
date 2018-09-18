<?php

namespace App\Jobs;

use App\Group;
class GenerateGroupUsersJob extends Job
{
    protected $group;

    /**
     * Create a new job instance.
     *
     * @param Group $group
     */
    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->group->setUsers();
    }
}
