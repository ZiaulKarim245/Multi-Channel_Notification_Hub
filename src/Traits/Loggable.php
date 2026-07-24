<?php
    namespace App\Traits;

    // use App\Exceptions\ValidationException;

    trait Loggable {

        /** 
         * Implement Delivery Log for the Notification System.
         */
        protected function logDelivery(string $channel, string $recipient, bool $status): void {
            $timestamp = date('Y-m-d H:i:s');
            $result = $status ? "SUCCESS" : "FAILED";
            echo "[{$timestamp}] [LOG]\nChannel: {$channel}\nRecipient: {$recipient}\nStatus: {$result}\n\n";
        }
    }

    /*trait Validatable {
        public function validateEmail(string $recipient): void {
            if(!filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
                throw new ValidationException("Invalid email format: '$recipient'");
            }
        }
    } */