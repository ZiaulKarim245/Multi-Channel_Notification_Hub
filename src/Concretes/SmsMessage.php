<?php
    namespace App\Concretes;

    use App\Abstracts\BaseMessage;
    use App\Interfaces\NotificationChannelInterface;
    use App\Traits\Loggable;

    /**
     * SMS notification channel execution.
     */

    class SmsMessage extends BaseMessage implements NotificationChannelInterface {
        use Loggable;

        private string $apikey;

        public function __construct(string $recipient, string $message, string $apikey) {
            parent::__construct($recipient, $message);
            $this->apikey = $apikey;
        }

        public function setApiKey(string $apikey): void {
            $this->apikey = $apikey;
        }

        protected function formatMessage(): string {
            return "To: " . $this->getRecipient() . "\nKey: [" . substr($this->apikey,0,4) . ".....]\nMessage: " . $this->getMessage();
        }

        public function send(): bool {
            $result = true;
            $this->logDelivery("SMS", $this->getRecipient(), $result);
            return $result;
        }

        public function __toString(): string {
            return "SMS successfully sent to " . $this->getRecipient();
        }
    }