<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Cria uma quantidade de registros exemplos no banco para testes
        // php artisan db:seed --class=UsersTableSeeder
        factory(User::class, 10)->create();

        /*
        User::create([
            'name' => 'Jhonata',
            'email' => 'jhonata@gmail.com',
            'password' => bcrypt('123456')
        ]);
        */
        
    }
}
