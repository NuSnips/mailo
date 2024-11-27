<?php

namespace Domain\Subscriber\DataTransferObjects;

use Spatie\LaravelData\Data;

class   TagDTO extends Data
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $title
    ) {}
}
