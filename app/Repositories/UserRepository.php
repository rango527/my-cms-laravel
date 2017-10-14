<?php

namespace App\Repositories;

class UserRepository extends Repository
{
    /**
     * Ecommerce-CMS
     *
     * Copyright (C) 2014 - 2015  Tihomir Blazhev.
     *
     * Repository Class for model User, extends base Repository Class.
     * Simple implementation without scopes and Criteria
     * specific queries is placed here.
     *
     * @package ecommerce-cms
     * @category Repository Class
     * @author Tihomir Blazhev <raylight75@gmail.com>
     * @link https://raylight75@bitbucket.org/raylight75/ecommerce-cms.git
     */

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'App\User';
    }

    /**
     * Paginate table user.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function userWithPaginate()
    {
        return $this->model->with('role')
            ->paginate(10);
    }

    /**
     * Users role
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function userWithRole()
    {
        return $this->model->with('role')->get();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function attachRole()
    {
        if (auth()->user()->is_activated == '1') {
            if (auth()->user()->hasRole('admin')) {
                return redirect()->to('/welcome');
            }
            //Demo user role
            $role = $this->find(auth()->id());
            $role->role()->sync(array(auth()->id() => 2)); //2 for Demo users
            //End add Demo User
        }
    }
}