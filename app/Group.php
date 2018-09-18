<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UserGenerator\UserGenerator;
use App\Repositories\GroupUsersRepository;

class Group extends Model
{
    protected $fillable = ['number_of_users', 'title'];
    protected $usersRepository = null;
    public const
        INIT_STATUS_CODE = 0,
        DONE_STATUS_CODE = 2;

    protected function setStatusDone()
    {
        $this->status = static::DONE_STATUS_CODE;
    }

    protected function usersRepository(): GroupUsersRepository
    {
        if (!$this->usersRepository) {
            if (!$this->id) {
                throw new \Exception('Save group, before using its repository');
            }

            $this->usersRepository = new GroupUsersRepository(null, $this->id);
        }

        return $this->usersRepository;
    }


    public function setUsers()
    {
        $usersGenerator = new UserGenerator;
        $users = $usersGenerator->generateUsers($this->number_of_users);

        $this->usersRepository()->setUsers($users);

        $this->setStatusDone();
        $this->save();
    }

    public function getUsers() :array
    {
        return $this->usersRepository()->getUsers();
    }

}
