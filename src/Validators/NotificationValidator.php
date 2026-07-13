<?php
    namespace App\Validators;

    use App\Exceptions\ValidationException;

    class NotificationValidation {
        public static function validateEmail(string $recipient): void {
            if(!filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
                throw new ValidationException("Invalid email format: '$recipient'");
            }
        }

        public static function validateNumber(string $recipient): void {
            if(!preg_match('/^\+?[0-9]{10,15}$/', $recipient)) {
                throw new ValidationException("Invalid phone number format: '$recipient'");
            }
        }

        public static function validateMessage(string $message): void {
            if(empty(trim($message))) {
                throw new ValidationException("Message can't be empty.");
            }
        }

        public static function validateCredential(string $credential, string $type): void {
            if(empty(trim($credential)) || strlen($credential) < 8) {
                throw new ValidationException("Invalid $type: Must be at least 8 characters long.");
            }
        }
    }