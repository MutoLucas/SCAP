<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Login;

class SwitchToManutentor extends Seeder
{
    public function run(): void
    {
        $users = Login::get()->all();

        foreach ($users as $user) {
            if(in_array($user->NivelAcesso,['Maneutentor','Manutentor'])){
                $user->NivelAcesso = 'Manutentor';
                $user->save();
            }
        }
    }
}
