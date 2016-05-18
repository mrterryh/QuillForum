<?php

namespace Quill;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'activation_key'
    ];

    /**
     * Appends the given attributes to all collections of the model.
     * 
     * @var array
     */
    protected $appends = ['avatar'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Alias for the avatar() method.
     * 
     * @return string
     */
    public function getAvatarAttribute()
    {
        return $this->avatar();
    }

    /**
     * Returns the Gravatar image for the user.
     * 
     * @param  integer $size
     * @return string
     */
    public function avatar($size = 80)
    {
        $email = md5(strtolower(trim($this->email)));

        return "//www.gravatar.com/avatar/$email?s=$size&d=mm";
    }

    /**
     * Determines whether the user has activated their account.
     * 
     * @return boolean
     */
    public function isActivated()
    {
        return $this->activation_key === null;
    }

    /**
     * Returns the user's received messages.
     * 
     * @return object
     */
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }

    /**
     * Returns the user's sent messages.
     * 
     * @return object
     */
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /**
     * Gets the user's received messages, and sent messages, and merges
     * them into a single collection.
     * 
     * @return object
     */
    public function involvedMessages()
    {
        return $this->receivedMessages->merge($this->sentMessages);
    }
}
