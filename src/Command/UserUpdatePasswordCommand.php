<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand('app:user:update-password', 'Update password for specific user', ['a:u:up'])]
class UserUpdatePasswordCommand extends AbstractUserCommand
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->handleParameters($input);
        $console = new SymfonyStyle($input, $output);

        $success = $this->userManager->updateUserPassword($this->email, $this->password);
        if ($success) {
            $console->success('User has been updated successfully');

            return Command::SUCCESS;
        }

        $console->error('Failed to update user');

        return Command::FAILURE;
    }
}