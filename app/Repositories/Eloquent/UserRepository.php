<?php

namespace Quill\Repositories\Eloquent;

use Quill\Events\Auth\UserRegistered;
use Quill\Contracts\Repositories\UserRepositoryContract;

class UserRepository extends AbstractRepository implements UserRepositoryContract
{
    /**
     * The name of the model to build the repository for.
     * 
     * @var string
     */
    protected $model = 'Quill\User';

    /**
     * Creates a user within the database.
     * 
     * @param  array   $data
     * @param  boolean $activate
     * @return object
     */
    public function register(array $data, $activate = false)
    {
        // @TODO Ensure that the key doesn't already exist. Make
        // class out of it, like \Services\ActivationKeyGenerator
        $data['activation_key'] = $activate ? null : str_random(16);
        $data['password'] = bcrypt($data['password']);

        $user = $this->getModel()->create($data);

        event(new UserRegistered($user));

        return $user;
    }
}