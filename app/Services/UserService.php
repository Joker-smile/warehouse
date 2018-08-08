<?php

namespace App\Services;

use App\Contracts\Repositories\Criterias\WhereCriteria;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserService
{
    protected $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    public function operators()
    {
        $this->user->pushCriteria(new WhereCriteria("role", "operator"));

        return $this->user->paginate();
    }

    public function create(array $data)
    {
        $data['role']     = 'operator';
        $data['password'] = bcrypt($data['password']);
        $data['name']     = $data['name'];

        return $this->user->create($data);
    }

    public function find($id)
    {
        return $this->user->find($id);
    }

    public function updatePassword(int $id, string $password)
    {
        $password = bcrypt($password);

        return $this->user->update($id, compact("password"));
    }

    public function delete($id)
    {
        return $this->user->delete($id);
    }

}
