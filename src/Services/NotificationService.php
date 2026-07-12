<?php
    namespace App\Services;

    use App\Interfaces\NotificationChannelInterface;

    /**
     * Notification Service execution.
     */
    class NotificationService {
        private static int $totalSent = 0;

        public function dispatch(NotificationChannelInterface $channel): bool {

            echo $channel;

            if ($channel->send()) {
                self::$totalSent++;
                return true;
            }
            return false;
        }

        public static function getTotalSent(): int {
            return self::$totalSent;
        }
    }