<?php
    namespace App\Traits;

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