<?php

namespace App\Models;

use App\Models\Users\User;
use App\Models\Orders\Order;
use App\Models\Orders\OrderOffer;
use App\Support\Payment\Models\Transaction;
use Illuminate\Notifications\DatabaseNotification;

class Notification extends DatabaseNotification
{
    /**
     * @var int
     */
    const PROCESSING_TYPE = 1;
    const Assign_Delegete_TYPE = 2;
    const FINSH_ORDER_TYPE = 3;
    const ADMIN_TYPE = 4;


    /**
     * Get the user that associated the notification.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    /**
     * Get the order that associated the notification.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * Get the offer that associated the notification.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function offer()
    {
        return $this->belongsTo(OrderOffer::class, 'offer_id');
    }

    /**
     * Get the shop that associated the notification.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
  

    /**
     * Get the transaction that associated the notification.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
}
