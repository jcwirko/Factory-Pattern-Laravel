<?php

namespace App\Repositories;

use App\Models\User;

class FileUploaderService
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function store($file, string $folder)
    {
        $first = $this->model->where('first_name', $name);

        return $this->model->where('last_name', $name)
            ->union($first)
            ->get();
    }

    public function delete()
    {

    }
}
