<?php

namespace Modules\Gateway\Database\Seeders;

use Illuminate\Database\Seeder;

class GatewaysTableWithoutDummyDataSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('gateways')->delete();

        \DB::table('gateways')->insert(array(
            0 =>
            array(
                'id' => 1,
                'alias' => 'cashondelivery',
                'name' => 'CashOnDelivery',
                'sandbox' => 0,
                'data' => '{"status":"1","instruction":"Kindly verify your order, and make cash payment in full (as mentioned on order invoice or shipping label) when the delivery agent arrives at your doorstep with your order."}',
                'instruction' => 'Kindly verify your order, and make cash payment in full (as mentioned on order invoice or shipping label) when the delivery agent arrives at your doorstep with your order.',
                'image' => 'thumbnail.png',
                'status' => 1,
            ),
        ));
    }
}
