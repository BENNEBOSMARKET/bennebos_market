<?php

namespace Database\Seeders;

use App\Models\Wallet;
use Illuminate\Database\Seeder;

class WalletTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 54; $i++) {
            Wallet::updateOrCreate([
                'seller_id' => $i,
                'amount' => 0,
            ]);
        }
    }
}
