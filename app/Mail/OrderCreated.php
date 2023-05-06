<?php

namespace App\Mail;

use App\Classes\Basket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCreated extends Mailable
{
    use Queueable, SerializesModels;

    protected $placeName;
    protected $orderSum;
    protected $order;

    /**
     * @param $placeName
     * @param $orderSum
     */
    public function __construct($placeName, $orderSum, $order)
    {
        $this->placeName = $placeName;
        $this->orderSum = $orderSum;
        $this->order = $order;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.order_created', ['name' => $this->placeName, 'orderSum' => $this->orderSum, 'order' => $this->order]);
    }
}
