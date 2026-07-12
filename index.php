<!DOCTYPE html>
<html>
    <head>
        <title>Notification Service</title>
    </head>
    <body>
        <?php
            require 'vendor/autoload.php';

            use App\Concretes\EmailMessage;
            use App\Concretes\PushMessage;
            use App\Concretes\SmsMessage;
            use App\Services\NotificationService;

            /**
             * Entry Point for the Notification Service.
             */

            $service = new NotificationService();

            $notifications = [
                new EmailMessage('xyx@gmail.com', 'Greeting', "Welcome!\nThank you for signing up."),
                new PushMessage('user@domain.com', 'Click to see what is new.', 'device_token_xyz123'),
                new SmsMessage('+880128394729', 'Your OPT Code is 1234', 'abcd1234')
            ];

            foreach ($notifications as $message) {
                $service->dispatch($message);
            }

            echo "Total message dispatch: ". NotificationService::getTotalSent();
        ?>
    </body>
</html>
