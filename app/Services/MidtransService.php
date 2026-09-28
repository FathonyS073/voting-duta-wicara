<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;

class MidtransService
{

    public function __construct()
    {

        Config::$serverKey = config('midtrans.server_key');

        Config::$clientKey = config('midtrans.client_key');

        Config::$isProduction = config('midtrans.is_production');

        Config::$isSanitized = true;

        Config::$is3ds = true;

    }



    public function createTransaction($transaction)
    {

        $params = [

            'transaction_details' => [

                'order_id' => $transaction->invoice_number,

                'gross_amount' => $transaction->total_amount,

            ],


            'item_details' => [

                [

                    'id' => $transaction->candidate_id,

                    'price' => $transaction->category->vote_price,

                    'quantity' => $transaction->vote_amount,

                    'name' => 'Vote ' . $transaction->candidate->name,

                ]

            ],


        ];


        return Snap::getSnapToken($params);

    }


}