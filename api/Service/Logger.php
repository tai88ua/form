<?php

namespace App\Service;

use Psr\Log\LoggerInterface;

class Logger implements LoggerInterface
{
    private string $filePath = '';

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function emergency(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement emergency() method.
    }

    public function alert(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement alert() method.
    }

    public function critical(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement critical() method.
    }

    public function error(\Stringable|string $message, array $context = []): void
    {
        $this->write($message, 'ERROR');
    }

    public function warning(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement warning() method.
    }

    public function notice(\Stringable|string $message, array $context = []): void
    {
        $this->write($message, 'NOTICE');
    }

    public function info(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement info() method.
    }

    public function debug(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement debug() method.
    }

    public function log($level, \Stringable|string $message, array $context = []): void
    {
        // TODO: Implement log() method.
    }

    private function write($message, $type): void
    {
        file_put_contents($this->filePath, "{$type}: $message\n", FILE_APPEND | LOCK_EX);
    }
}