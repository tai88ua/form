<?php

namespace App\Repository;

use App\Entity\User;

class UserRepository
{
    private string $pathDB = '';
    private ?array $data = null;
    public function __construct(string $path)
    {
        $this->pathDB = $path;
    }

    public function save(User $user): void
    {
        $this->initData();
        $email = $user->getEmail();
        $maxId = $this->getMaxId();

        $item = [
            'id' => $maxId + 1,
            'name' => $user->getName(),
            'email' => $email,
            'password' => $user->getPassword(),
        ];

        $this->data[$email] = $item;
        $this->saveData();
    }

    public function isEmailUsed(string $email): bool
    {
        $this->initData();
        return isset($this->data[$email]);
    }

    protected function getMaxId(): int
    {
        $this->initData();
        if (empty($this->data)) {
            return 0;
        }

        $data = array_column($this->data, 'id');
        return max($data);
    }

    protected function initData(): void
    {
        if (!$this->data) {
            if (file_exists($this->pathDB)) {
                $str = file_get_contents($this->pathDB);
                $this->data = json_decode($str, true);
                if (!$this->data) {
                    $this->data = [];
                }
            } else {
                $this->data = [];
            }
        }
    }

    protected function saveData(): void
    {
        file_put_contents($this->pathDB, json_encode($this->data));
    }
}