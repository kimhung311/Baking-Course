<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User\User;

class CreateAccount extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=100;$i++) {
            $users[] = [
                'id'                        => $i,
                'name'                      => 'van tu ' . $i,
                'phone'                     => 0 . rand(3111111111, 99999999999),
                'email'                     => 'tunv20.12.98'.$i.'@gmail.com',
                'address'                   => 'van tu ' . $i,
                'password'                  => $i,
            ];
        }
        User::insert($users);
    }
}
