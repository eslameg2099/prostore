<?php


namespace App\Traits;


use Illuminate\Support\Facades\Notification;
use App\Broadcasting\PusherChannel;
use App\Models\Notification as NotificationModel;
use App\Notifications\CustomNotification;
use Laraeast\LaravelSettings\Facades\Settings;
use App\Models\User;


trait NotificationsTrait
{

  public static function sendformadmin(user $user,$title,$body,$type)
  {
    Notification::send($user, new CustomNotification([
      'via' => ['database', PusherChannel::class],
      'database' => [
          
          'title' => $title,
          'body' => $body,
          'trans' => 'اشعار من الادارة',
          'user_id' => $user->id,
          'type' =>$type,

      ],
      'fcm' => [
          'title' => $title,
          'body' => $body,
          'type' => NotificationModel::ADMIN_TYPE,
          'data' => [
              'id' => $user->id,
            
          ],
      ],
    ]));

  }


  public static function send(user $user,$title,$body,$type,$opration_id)
  {
    Notification::send($user, new CustomNotification([
      'via' => ['database', PusherChannel::class],
      'database' => [
          
          'title' => $title,
          'body' => $body,
          'trans' => $title,
          'user_id' => $user->id,
          'type' =>$type,
          'order_id'=>$opration_id,

      ],
      'fcm' => [
          'title' => $title,
          'body' => $body.$opration_id,
          'type' => $type,
          'data' => [
              'id' => $user->id,
              'order_id'=>$opration_id,

          ],
      ],
      ]));

  }



}
