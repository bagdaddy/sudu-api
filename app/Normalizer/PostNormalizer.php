<?php

namespace App\Normalizer;

use App\Dto\PostDTO;

class PostNormalizer implements NormalizerInterface
{

    /**
     * @param array $data
     * @return PostDTO
     */
    public function normalize(iterable $data): object
    {
        return new PostDTO(
            $data['body'],
            $data['latitude'] ?? null,
            $data['longitude'] ?? null
        );
    }
}
