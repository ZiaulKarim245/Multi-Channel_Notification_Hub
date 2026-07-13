<?php
    namespace App\Concretes;

    use App\Abstracts\BaseMessage;
    use App\Interfaces\NotificationChannelInterface;
    use App\Traits\Loggable;
    use App\Validators\NotificationValidator;

    /**
     * Firebase Web Push Notification Channel execution.
     */

    class PushMessage extends BaseMessage implements NotificationChannelInterface {
        use Loggable;

        private string $firebaseToken;

        public function __construct(string $recipient, string $message, string $firebaseToken) {
            NotificationValidator::validateMessage($message);
            NotificationValidator::validateCredential($apikey, 'Firebase Token');
            parent::__construct($recipient, $message);

            $this->firebaseToken = $firebaseToken;
        }

        public function setFirebaseToken(string $firebaseToken): void {
            $this->firebaseToken = $firebaseToken;
        }

        protected function formatMessage(): string {
            return "Token: $this->firebaseToken\nMessage: " . $this->getMessage();
        }

        public function send(): bool {
            $result = true;
            $this->logDelivery("Firebase Push", $this->getRecipient(), $result);
            return $result;
        }

        public function __toString(): string {
            return "Push Notification successfully formatted for ". $this->getRecipient();
        }
    }