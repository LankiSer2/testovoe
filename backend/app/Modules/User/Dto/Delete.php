<?php

namespace App\Modules\User\Dto;

final class Delete
{
    public function __construct(
        public readonly int $id,
    ) {
    }

    public static function fromId(int $id): self
    {
        return new self(id: $id);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
        ];
    }
}
