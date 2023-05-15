<?php

namespace App\Service;

use App\Dto\Form;
use App\Entity\User;
use App\Repository\UserRepository;
use Psr\Log\LoggerInterface;

class Registration
{
    public const MSG_ERROR_EMAIL = 'Email is invalidate';
    public const MSG_ERROR_PASSWORD = 'Password must be eq';
    public const MSG_ERROR_EMPTY_FIRST_NAME = 'Empty First Name';
    public const MSG_ERROR_EMPTY_SECOND_NAME = 'Empty Second Name';
    public const MSG_ERROR_EMPTY_PASSWORD = 'Empty Password';
    public const MSG_ERROR_EMAIL_USED = 'This email used';
    public const MSG_OK = 'User successfully added';

    private UserRepository $userRepository;
    private LoggerInterface $logger;

    public function __construct(UserRepository $userRepository, LoggerInterface $logger)
    {
        $this->userRepository = $userRepository;
        $this->logger = $logger;
    }

    /**
     * @throws \Exception
     */
    public function addUser(Form $form): bool
    {
        $this->validate($form);

        $userEntity = new User();
        $userEntity->setName($form->getFirstName() . ' ' . $form->getSecondName());
        $userEntity->setEmail($form->getEmail());
        $userEntity->setPassword(md5($form->getPassword()));

        $this->userRepository->save($userEntity);
        $this->logger->notice("User with email: {$form->getEmail()}, successfully added");
        return true;
    }

    /**
     * @throws \Exception
     */
    protected function validate(Form $form): bool
    {
        if (empty($form->getFirstName())) {
            $this->logger->error(self::MSG_ERROR_EMPTY_FIRST_NAME);
            throw new \Exception(self::MSG_ERROR_EMPTY_FIRST_NAME);
        }

        if (empty($form->getSecondName())) {
            $this->logger->error(self::MSG_ERROR_EMPTY_SECOND_NAME);
            throw new \Exception(self::MSG_ERROR_EMPTY_SECOND_NAME);
        }

        if (empty($form->getPassword())) {
            $this->logger->error(self::MSG_ERROR_EMPTY_PASSWORD);
            throw new \Exception(self::MSG_ERROR_EMPTY_PASSWORD);
        }

        if (!filter_var($form->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $this->logger->error(self::MSG_ERROR_EMAIL);
            throw new \Exception(self::MSG_ERROR_EMAIL);
        }

        if ($form->getPassword() != $form->getPasswordRepeat()) {
            $this->logger->error(self::MSG_ERROR_PASSWORD);
            throw new \Exception(self::MSG_ERROR_PASSWORD);
        }

        if ($this->userRepository->isEmailUsed($form->getEmail())) {
            $this->logger->error('Email: '. $form->getEmail() . ' is used ');
            throw new \Exception(self::MSG_ERROR_EMAIL_USED);
        }

        return true;
    }
}
