<?php

namespace Quill\Events\Auth;

use Quill\Events\Event;
use Illuminate\Queue\SerializesModels;

class UserRegistered extends Event
{
    use SerializesModels;

    /**
     * @var object
     */
    protected $user;

    /**
     * Create a new event instance.
     *
     * @param  object $user
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }
}
