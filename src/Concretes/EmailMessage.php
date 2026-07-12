<?php
    namespace App\Concretes;

    use App\Abstracts\BaseMessage;
    use App\Interfaces\NotificationChannelInterface;
    use App\Traits\Loggable;

    /**
     * Email notification channel execution.
     */
    class EmailMessage extends BaseMessage implements NotificationChannelInterface{
        use Loggable;

        private string $subject;

        public function __construct(string $recipient, string $subject, string $message) {
            parent::__construct($recipient,$message);
            $this->subject = $subject;
        }

        protected function formatMessage(): string {
            return "To: {$this->getRecipient()} \nSubject: {$this->subject} \nBody: {$this->getMessage()}";
        }

        public function send(): bool {
            $formatted = $this->formatMessage();
            $result = true; # pretend it works because of not having real service provider

            // $response = file_get_contents("https://sendgrid.com...", $formatted);
            // $result = ($response === "200 OK"); // True only if the internet server says yes

            $this->logDelivery("Email", $this->getRecipient(), $result);
            return $result;
        }

        public function __toString(): string {
            return "Email successfully formatted for " . $this->getRecipient();
        }
    }