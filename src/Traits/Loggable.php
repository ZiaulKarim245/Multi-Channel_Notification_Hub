<?php
    namespace App\Traits;

    trait Loggable {

        /** 
         * Implement Delivery Log for the Notification System.
         */
        public function logDelivery(string $channel, string $recipient, bool $status): void {
            $timestamp = date('Y-m-d H:i:s');
            $result = $status ? "SUCCESS" : "FAILED";
            echo "[{$timestamp}] [LOG] Channel: {$channel} | Recipient: {$recipient} | Status: {$result}\n";
        }
    }
?>