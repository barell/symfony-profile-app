<?php

declare(strict_types=1);

namespace App\Message;

final class YourMessage
{
    public function __construct(
        public readonly string $name,
    ) {}
}