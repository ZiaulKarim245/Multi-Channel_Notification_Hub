<!DOCTYPE html>
<html>
    <head>
        <title>Notification Service</title>
    </head>
    <body>
        <pre><?php
                require 'vendor/autoload.php';

                use App\Concretes\EmailMessage;
                use App\Concretes\PushMessage;
                use App\Concretes\SmsMessage;
                use App\Services\NotificationService;
                use App\Exceptions\ValidationException;

                /**
                 * Entry Point for the Notification Service.
                 */

                $service = new NotificationService();

                $notifications = [
                    [
                        'type'      => 'email',
                        'recipient' => 'xyx@gmail.com',
                        'subject'   => 'Greeting',
                        'message'   => "Welcome!\nThank you for signing up."
                    ],
                    [
                        'type'      => 'email',
                        'recipient' => 'invalid-email-string', // Will throw ValidationException
                        'subject'   => 'Security Alert',
                        'message'   => 'Someone accessed your account.'
                    ],
                    [
                        'type'      => 'push',
                        'recipient' => 'user@domain.com',
                        'message'   => 'Click to see what is new.',
                        'token'     => 'device_token_xyz123'
                    ],
                    [
                        'type'      => 'sms',
                        'recipient' => '+880128394729',
                        'message'   => 'Your OTP Code is 1234',
                        'api_key'   => 'abcd1234'
                    ]
                ];

                foreach ($notifications as $notification) {
                    try {
                        switch ($notification['type']) {
                            case 'email':
                                $message = new EmailMessage($notification['recipient'], $notification['subject'], $notification['message']);
                                break;
                            case 'push':
                                $message = new PushMessage($notification['recipient'], $notification['message'], $notification['token']);
                                break;
                            case 'sms':
                                $message = new SmsMessage($notification['recipient'], $notification['message'], $notification['api_key']);
                                break;
                            default:
                                throw new \Exception("Unsupported notification channel: " . $notification['type']);
                        }
                        $service->addToQueue($message);
                        echo "[QUEUE] is ready to send to: " . $notification['recipient'] . "\n\n";
                    } catch (ValidationException $e) {
                        echo "[VALIDATION SKIP] ". $e->getMessage() . "\n\n";
                    } catch (\Exception $e) {
                        echo "[SYSTEM FAULT] " . $e->getMessage() . "\n\n";
                    }
                }

                $service->dispatchQueue();
                
                echo "Total message dispatch: ". NotificationService::getTotalSent();
            ?></pre>
    </body>
</html>
