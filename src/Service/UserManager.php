<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserManager
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
        private EntityManagerInterface $entityManager,
        private UserRepository $userRepository,
        private LoggerInterface $logger
    )
    {}

    public function createUser(string $email, string $password, bool $isAdmin = false): bool
    {
        try {
            $user = $this->userRepository->findOneBy(['username' => $email]);
            if($user) {
                throw new InvalidArgumentException('User already exists');
            }

            $user = new User();
            $user->setUsername($email);
            $this->hashUserPassword($user, $password);
            if($isAdmin) {
                $user->addRole('ROLE_ADMIN');
            }

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return true;
        }
        catch (\Exception $exception) {
            $this->logger->error('An error occurred while creating user: ' . $exception->getMessage());

            return false;
        }
    }

    public function updateUserPassword(string $email, string $password): bool
    {
        try {
            $user = $this->userRepository->findOneBy(['username' => $email]);
            if(!$user) {
                throw new EntityNotFoundException('User not found with email "' . $email . '"');
            }

            $this->hashUserPassword($user, $password);

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return true;
        }
        catch (\Exception $exception) {
            $this->logger->error('An error occurred while creating user: ' . $exception->getMessage());

            return false;
        }
    }

    private function hashUserPassword(User $user, string $password) {
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $password
        );
        $user->setPassword($hashedPassword);

        return $user;
    }
}