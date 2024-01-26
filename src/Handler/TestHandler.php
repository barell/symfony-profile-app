<?php

declare(strict_types=1);

namespace App\Handler;

use App\Message\YourMessage;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsMessageHandler]
final class TestHandler
{
    public function __construct(
        private readonly MessageBusInterface $bus,
        private readonly LoggerInterface $logger
    ) {}

    public function __invoke(YourMessage $message): void
    {
        $this->logger->info(\sprintf('Hello %s!', $message->name));

        if ($message->name === 'foo') {
            $this->bus->dispatch(new YourMessage('bar'));
        }
    }
}