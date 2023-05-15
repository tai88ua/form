<?php

use PHPUnit\Framework\TestCase;
use App\Service\Registration;
use App\Repository\UserRepository;
use Psr\Log\LoggerInterface;

class RegistrationTest extends TestCase
{
    protected UserRepository $userRepositoryMock;
    protected LoggerInterface $loggerMock;

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    protected function setUp(): void
    {
        $this->userRepositoryMock = $this->createMock(UserRepository::class);
        $this->loggerMock = $this->createMock(LoggerInterface::class);
    }

    public function testExceptionErrorFirstName()
    {
        $this->expectException(\Exception::class, Registration::MSG_ERROR_EMPTY_FIRST_NAME);
        $form = new \App\Dto\Form();
        $service = new App\Service\Registration($this->userRepositoryMock, $this->loggerMock);
        $service->addUser($form);
    }

    public function testExceptionErrorSecondName()
    {
        $this->expectException(\Exception::class, Registration::MSG_ERROR_EMPTY_SECOND_NAME);
        $form = new \App\Dto\Form();
        $form->setFirstName("Test First Name");
        $service = new App\Service\Registration($this->userRepositoryMock, $this->loggerMock);
        $service->addUser($form);
    }

    public function testExceptionErrorEmail()
    {
        $this->expectException(\Exception::class, Registration::MSG_ERROR_EMAIL);
        $form = new \App\Dto\Form();
        $form->setFirstName("Test First Name");
        $form->setFirstName("Test Second Name");
        $service = new App\Service\Registration($this->userRepositoryMock, $this->loggerMock);
        $service->addUser($form);
        $form->setEmail('lololo@mail.com');
        $service->addUser($form);
    }

    public function testExceptionErrorEmailNotValid()
    {
        $this->expectException(\Exception::class, Registration::MSG_ERROR_EMAIL);
        $form = new \App\Dto\Form();
        $form->setFirstName("Test First Name");
        $form->setFirstName("Test Second Name");
        $form->setEmail('lololomail.com');
        $service = new App\Service\Registration($this->userRepositoryMock, $this->loggerMock);
        $service->addUser($form);
    }

    public function testExceptionErrorEmptyPass()
    {
        $this->expectException(\Exception::class, Registration::MSG_ERROR_EMAIL);
        $form = new \App\Dto\Form();
        $form->setFirstName("Test First Name");
        $form->setFirstName("Test Second Name");
        $form->setEmail('lololo@mail.com');
        $service = new App\Service\Registration($this->userRepositoryMock, $this->loggerMock);
        $service->addUser($form);
    }

    public function testExceptionErrorPassNotEq()
    {
        $this->expectException(\Exception::class, Registration::MSG_ERROR_EMAIL);
        $form = new \App\Dto\Form();
        $form->setFirstName("Test First Name");
        $form->setFirstName("Test Second Name");
        $form->setEmail('lololo@mail.com');
        $service = new App\Service\Registration($this->userRepositoryMock, $this->loggerMock);
        $form->setPassword("12345");
        $form->setPasswordRepeat("12347");
        $service->addUser($form);
    }

    public function testOK()
    {
        $this->expectException(\Exception::class, Registration::MSG_ERROR_EMAIL);
        $form = new \App\Dto\Form();
        $form->setFirstName("Test First Name");
        $form->setFirstName("Test Second Name");
        $form->setEmail('lololo@mail.com');
        $service = new App\Service\Registration($this->userRepositoryMock, $this->loggerMock);
        $form->setPassword("12345");
        $form->setPasswordRepeat("12345");
        $this->assertTrue($service->addUser($form));
    }
}
