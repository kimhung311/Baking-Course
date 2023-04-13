<?php

namespace App\Repositories\Users;

use App\Models\User\User;
use App\Repositories\EloquentRepository;

class UserRepository extends EloquentRepository
{
    public function getModel()
    {
        return User::class;
    }

    /**
     * GetListUsers
     *
     * @param  integer $paged Page
     *
     * @return Users
     */
    public function getListUsers($paged = 20)
    {
        $select = ['users.*'];
        return $this->model->whereNull('users.deleted_at')
                ->filterForm()
                ->handleSort()
                ->select($select)
                ->orderBy('users.id', 'desc')
                ->paginate($paged)
                ->appends(request()->query());
    }
}
