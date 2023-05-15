<?php

namespace App\Dto;

class Form
{
    private ?string $firstName = null;
    private ?string $secondName = null;
    private ?string $email = null;
    private ?string $password = null;
    private ?string $passwordRepeat = null;

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string|null $firstName
     */
    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string|null
     */
    public function getSecondName(): ?string
    {
        return $this->secondName;
    }

    /**
     * @param string|null $secondName
     */
    public function setSecondName(?string $secondName): void
    {
        $this->secondName = $secondName;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getPasswordRepeat(): ?string
    {
        return $this->passwordRepeat;
    }

    /**
     * @param string|null $passwordRepeat
     */
    public function setPasswordRepeat(?string $passwordRepeat): void
    {
        $this->passwordRepeat = $passwordRepeat;
    }
}
