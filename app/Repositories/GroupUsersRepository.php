<?php

namespace App\Repositories;

class GroupUsersRepository
{
    protected const PREFIX = 'fake_user_group';
    protected $redis, $groupId;

    public function __construct($redis = null, int $groupId)
    {
        if (!$redis) {
            $redis = app('redis');
        }
        $this->redis = $redis;
        $this->groupId = $groupId;
    }

    public function getUsers(): array
    {
        $usersJsons = $this->redis->command('LRANGE', [$this->key(), 0 , -1]);

        $users = collect($usersJsons)->map(function($userJson) {
            return json_decode($userJson, true);
        })->toArray();

        return $users;
    }

    public function setUsers(array $users)
    {
        $arguments = collect($users)->map(function($user) {
            return json_encode($user);
        })->toArray();
        array_unshift($arguments, $this->key());

        $this->clearUsers();

        $this->redis->command('RPUSH', $arguments);
    }

    protected function clearUsers()
    {
        $this->redis->command('DEL', [$this->key()]);
    }

    protected function key(): string
    {
        return static::PREFIX . ":{$this->groupId}";
    }
}