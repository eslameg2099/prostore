<?php

namespace App\Broadcasting;
use App\Models\User;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Arr;
use Pusher\PushNotifications\PushNotifications;

class PusherChannel
{
    /**
     * Send the given notification.
     *
     * @param $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     * @throws \Exception
     */
    public function send($notifiable, Notification $notification)
    {
        if (! method_exists($notification, 'toPusher')) {
            throw new \Exception('method "toPusher" not found in "'.get_class($notification).'"');
        }

        $data = $notification->toPusher($notifiable) ;

        $this->getPushNotifications($notifiable->type)
            ->publishToUsers($this->getInterests($notifiable, $notifiable), [
                "fcm" => [
                    "notification" => $data,
                    "data" => $data,
                ],
                "apns" => [
                    "aps" => [
                        "alert" => $data,
                        "sound" => 'default',

                    ]
                ],
            ]);
    }

    /**
     * Get the interests of the notification.
     *
     * @param $notifiable
     * @param $notification
     * @return \Illuminate\Support\Collection|mixed|string[]
     */
    protected function getInterests($notifiable, $notification)
    {
        $interests = collect(Arr::wrap($notifiable->routeNotificationFor('PusherNotification')))
            ->map(function ($interest) {
                return (string) $interest;
            })->toArray();

        return method_exists($notification, 'pusherInterests')
            ? $notification->pusherInterests($notifiable)
            : ($interests ?: ["{$notifiable->id}"]);
    }

    /**
     * Create PushNotification instance.
     *
     * @throws \Exception
     * @return \Pusher\PushNotifications\PushNotifications
     */
    protected function getPushNotifications($type): PushNotifications
    {
        $config = config('services.pusher');
        switch ($type)
        {
            case User::CUSTOMER_TYPE:
                return new PushNotifications([
                    'instanceId' => 'f74f2b0d-31bd-4a36-8f90-c8223a0ecb01',
                    'secretKey' => '51561B7DC2A2D94437980B4DDC10AC5DCFF2AB2B7478DEA372A92A715800C906',
                ]);

               

        }


     
    }
}
