<?php

namespace App\Models\Presenters;

use App\Models\Order;

class  OrderPresenter
{

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function status()
    {
        return match ($this->order->status()) {
            'placed_at' => 'Order placed',
            'packaged_at' => 'Order packaged',
            'shipped_at' => 'Order shipped',
            default => ''
        };
    }
}
