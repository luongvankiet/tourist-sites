<?php

namespace App\Models;

class Site extends Model
{
    public ?int $id = null;
    public ?string $site_name = null;
    public ?string $location = null;
    public ?string $feature = null;
    public ?string $contact = null;
    public ?float $price_from = null;

    protected $table = 'sites';
    protected $primaryKey = 'id';

    protected $attributes = [
        'site_name',
        'location',
        'feature',
        'contact',
        'price_from',
    ];

    public static function getInstance(): self
    {
        return new self;
    }
}
