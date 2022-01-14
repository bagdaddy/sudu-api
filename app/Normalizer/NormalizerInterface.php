<?php

namespace App\Normalizer;

interface NormalizerInterface
{
    public function normalize(iterable $data): object;
}
