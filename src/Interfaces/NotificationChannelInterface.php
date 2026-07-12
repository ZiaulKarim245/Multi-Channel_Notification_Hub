<?php
    namespace App\Interface;

    /**
     * Dispatches the notification through designated channel
     */
    interface NotificationChannelInterface {
        public function send(): bool;
    }
?>