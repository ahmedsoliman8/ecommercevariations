<?php

namespace App\Models;

use App\Models\Presenters\OrderPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    public $fillable = [
        'email',
        'subtotal',
        'placed_at',
        'packaged_at',
        'shipped_at'
    ];

    public $timestamps = [
        'placed_at',
        'packaged_at',
        'shipped_at'
    ];

    public $statuses = [
        'placed_at',
        'packaged_at',
        'shipped_at'

    ];

    protected $casts = [
        'placed_at' => 'datetime',
        'packaged_at' => 'datetime',
        'shipped_at' => 'datetime'

    ];

    protected static function booted()
    {
        static::creating(function (Order $order) {
            $order->placed_at = now();
            $order->uuid = (string)Str::uuid();
        });
    }

    public function status()
    {

        return collect($this->statuses)
            ->last(fn($status) => filled($this->{$status}));
    }


    public function formattedSubtotal()
    {
        return \money($this->subtotal);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shippingType()
    {
        return $this->belongsTo(ShippingType::class);
    }

    public function shippingAddress()
    {
        return $this->belongsTo(ShippingAddress::class);
    }

    public function variations()
    {
        return $this->belongsToMany(Variation::class)
            ->withPivot(['quantity'])
            ->withTimestamps();
    }

    public function presenter()
    {
        return new  OrderPresenter($this);
    }
}
