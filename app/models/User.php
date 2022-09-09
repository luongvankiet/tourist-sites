<?php

namespace App\Models;

use DateTime;

class User extends Model
{
    public string $first_name;
    public string $last_name;
    public string $email;
    public string $password;
    public DateTime $created_at;
    public DateTime $updated_at;

    protected $table = 'users';
    protected $attributes = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    public function save()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        parent::save();
    }
}
