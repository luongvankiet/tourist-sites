<?php

namespace App\Models;

use DateTime;

class User extends Model
{
    public ?int $id = null;
    public ?string $first_name = null;
    public ?string $last_name = null;
    public ?string $email = null;
    public ?string $password = null;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $attributes = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    public static function getInstance(): self
    {
        return new self;
    }

    public function save()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        parent::save();
    }
}
