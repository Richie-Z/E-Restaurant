<?php

use App\Status_order;
use Illuminate\Database\Seeder;

class Status extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = array('Belum di cek', 'Sudah di cek', 'Sudah dibayar', 'Dibatalkan', 'Sudah di terima');
        foreach ($arr as $val) {
            Status_order::create([
                'name' => $val,
            ]);
        }
    }
}
