<?php

namespace App\Dto;

class UserUpdate
{
    /** @var string */
    public string $username;

    /** @var string */
    public string $description;

    /** @var string */
    public string $country;

    /** @var string */
    public string $image;

    public function __construct(string $username, string $description, string $country, string $image)
    {
        $this->username = $username;
        $this->description = $description;
        $this->country = $country;
        $this->image = $image;
    }
}
