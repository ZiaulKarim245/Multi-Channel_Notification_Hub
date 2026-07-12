<?php
    namespace App\Abstract;

    /**
     * Unified format for the different notification channels.
     */
    abstract class BaseMessage {
        private string $recipient;
        private string $message;

        public function __construct(string $recipient, string $message) {
            $this->recipient = $recipient;
            $this->message = $message;
        }

        abstract protected function formatMessage(): string;

        protected function getRecipient(): string {
            return $this->recipient;
        }

        protected function getMessage(): string {
            return $this->message;
        }
    }