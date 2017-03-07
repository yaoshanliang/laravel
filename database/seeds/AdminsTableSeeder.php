<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultAdmin = 'admin';
        $defaultPassword = 'admin';
        $data = [
            'account' => $defaultAdmin,
            'password' => bcrypt($defaultPassword),
            'status' => 0,
        ];

        if (Admin::where('account', $defaultAdmin)->exists()) {
            Admin::where('account', $defaultAdmin)->update($data);
        } else {
            Admin::create($data);
        }
    }
}
