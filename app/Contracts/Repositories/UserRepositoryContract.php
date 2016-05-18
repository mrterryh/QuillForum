<?php

namespace Quill\Contracts\Repositories;

interface UserRepositoryContract
{
    /**
     * Creates a user within the database.
     * 
     * @param  array   $data
     * @param  boolean $activate
     * @return object
     */
    public function register(array $data, $activate = false);
}