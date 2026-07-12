<?php
    namespace App\Interfaces;

    /**
     * Dispatches the notification through designated channel
     */
    interface NotificationChannelInterface {
        public function send(): bool;
    }
?>