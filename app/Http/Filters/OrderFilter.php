<?php

namespace App\Http\Filters;

use App\Models\Order;

class OrderFilter extends BaseFilters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [
        'status',
        'id',
        'tab',
        'today',
        'selected_id',
        'date',
        'to',
    ];

    /**
     * Filter the query by a given status.
     *
     * @param string|int $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function status($value)
    {
        if ($value) {
            return $this->builder->where('status', $value);
        }

        return $this->builder;
    }

    /**
     * Filter the query by a given id.
     *
     * @param string|int $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function id($value)
    {
        if ($value) {
            return $this->builder->where('id', $value);
        }

        return $this->builder;
    }

    /**
     * Filter the query by a given status.
     *
     * @param string|int $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function tab($value)
    {
        $exceptedStatuses = [
            Order::PENDING_STATUS,
            Order::IN_PROGRESS_STATUS,
            Order::WAITING_DELIVER_STATUS,
            Order::ASSIGNED_TO_DELEGATE_STATUS,
            Order::DELIVERED_TO_DELEGATE,
            Order::DELIVERING_TO_DELEGATE,
            Order::DELIVERING_STATUS,
        ];

        switch ($value) {
            case 'working':
                return $this->builder
                    ->where('status', '<',Order::ASSIGNED_TO_DELEGATE_STATUS);
               
            case 'done':
                return $this->builder
                ->where('status', '>',Order::WAITING_DELIVER_STATUS);
               
                break;
        }


        return $this->builder;
    }

    /**
     * Sorting results by the given id.
     *
     * @param $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function selectedId($value)
    {
        if ($value) {
            $this->builder->sortingByIds($value);
        }

        return $this->builder;
    }

    /**
     * Filter the query to include only orders created today.
     *
     * @param $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function today($value)
    {
        if ($value == 1) {
            $this->builder->whereDate('created_at', today());
        }

        return $this->builder;
    }

    protected function date($value)
    {
        $from =  $value[0];

        $to =  $value[1];

        return $this->builder
            ->where('created_at', '>=', $from)
            ->where('created_at', '<=', $to);
    }
}
