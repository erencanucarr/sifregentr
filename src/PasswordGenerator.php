<?php

class PasswordGenerator {
    private int $length;
    private bool $useUppercase;
    private bool $useNumbers;
    private bool $useSymbols;
    private bool $useLowercase = true;

    public function __construct(
        int $length = 16,
        bool $useUppercase = true,
        bool $useNumbers = true,
        bool $useSymbols = true,
        bool $useLowercase = true
    ) {
        $this->length = $length;
        $this->useUppercase = $useUppercase;
        $this->useNumbers = $useNumbers;
        $this->useSymbols = $useSymbols;
        $this->useLowercase = $useLowercase;
    }

    public function generate(): string {
        $chars = '';
        if ($this->useLowercase) $chars .= 'abcdefghijklmnopqrstuvwxyz';
        if ($this->useUppercase) $chars .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if ($this->useNumbers) $chars .= '0123456789';
        if ($this->useSymbols) $chars .= '!@#$%^&*()_+-=[]{}|;:,.<>?';

        $password = '';
        $length = strlen($chars);

        for ($i = 0; $i < $this->length; $i++) {
            $password .= $chars[random_int(0, $length - 1)];
        }

        return $password;
    }

    public function getStrength(string $password): array {
        $strength = 0;
        $feedback = [];

        // Length check
        if (strlen($password) >= 12) {
            $strength += 25;
            $feedback[] = 'Good length';
        }

        // Character variety checks
        if (preg_match('/[A-Z]/', $password)) {
            $strength += 25;
            $feedback[] = 'Contains uppercase letters';
        }
        if (preg_match('/[0-9]/', $password)) {
            $strength += 25;
            $feedback[] = 'Contains numbers';
        }
        if (preg_match('/[^A-Za-z0-9]/', $password)) {
            $strength += 25;
            $feedback[] = 'Contains special characters';
        }

        return [
            'strength' => $strength,
            'feedback' => $feedback
        ];
    }
}
