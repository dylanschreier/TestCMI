<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand('app:user:create', 'Create a specific user', ['a:u:c'])]
class UserCreateCommand extends AbstractUserCommand
{
    private bool $isAdmin;

    protected function configure(): void
    {
        parent::configure();
        $this->addOption('admin');
    }

    protected function handleParameters(InputInterface $input): void
    {
        parent::handleParameters($input);
        $this->isAdmin = (bool) $input->getOption('admin');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->handleParameters($input);
        $console = new SymfonyStyle($input, $output);

        $success = $this->userManager->createUser($this->email, $this->password, $this->isAdmin);
        if ($success) {
            $console->success('User has been created successfully');

            return Command::SUCCESS;
        }

        $console->error('Failed to create user');

        return Command::FAILURE;
    }
}