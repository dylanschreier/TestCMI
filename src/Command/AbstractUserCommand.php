<?php

namespace App\Command;

use App\Service\UserManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;

abstract class AbstractUserCommand extends Command
{
    protected string $email;
    protected string $password;

    public function __construct(protected UserManager $userManager)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED)
            ->addArgument('password', InputArgument::REQUIRED)
        ;
    }

    protected function handleParameters(InputInterface $input): void
    {
        $this->email = $input->getArgument('email');
        $this->password = $input->getArgument('password');
    }
}