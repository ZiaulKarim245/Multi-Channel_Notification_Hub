<?php
    namespace App\Interface;

    interface NotificationChannelInterface {

        # Dispatches the notification through designated channel

        public function send(): bool;
    }
?>