<?php

namespace App\Dto;

class PostDTO
{
    /** @var string */
    private string $body;

    /** @var float|null */
    private ?float $latitude;

    /** @var float|null */
    private ?float $longitude;

    public function __construct(string $body, ?float $latitude = null, ?float $longitude = null)
    {
        $this->body = $body;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getCoordinates(): array
    {
        return [
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}
