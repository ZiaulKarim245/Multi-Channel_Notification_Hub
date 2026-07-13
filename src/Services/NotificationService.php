<?php
    namespace App\Services;

    use App\Interfaces\NotificationChannelInterface;

    /**
     * Notification Service execution.
     */
    class NotificationService {
        private static int $totalSent = 0;
        private array $queue = [];

        public function dispatch(NotificationChannelInterface $channel): bool {

            echo $channel . "\n";

            if ($channel->send()) {
                self::$totalSent++;
                return true;
            }
            return false;
        }

        public function addToQueue(NotificationChannelInterface $channel): void {
            $this->queue[] = $channel;
        }

        public function dispatchQueue(): void {
            foreach($this->queue as $key => $channel) {
                try {
                    $this->dispatch($channel);
                    unset($this->queue[$key]);  # throw will break loop
                } catch (\Exception $e){
                    echo "[BATCH ERROR] Delivery failed for an item: " . $e->getMessage() . "\n\n";
                }
            }
        }

        public static function getTotalSent(): int {
            return self::$totalSent;
        }
    }