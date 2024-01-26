<?php

declare(strict_types=1);

namespace App\CLI;

use App\Message\YourMessage;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand('test-command')]
final class TestCommand extends Command
{
    public function __construct(
        private readonly MessageBusInterface $bus,
    ) {
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');

        $question = new Question('What is your name?');

        $name = $helper->ask($input, $output, $question);

        $this->bus->dispatch(new YourMessage($name));

        return Command::SUCCESS;
    }
}