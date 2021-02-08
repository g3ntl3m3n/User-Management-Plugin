<?php

namespace modul\userModul;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class  userModulServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadViewsFrom(__DIR__ . '/views', 'user');


        $data = [
            'title' => 'Users',
            'url' => '/management/user',
            'is_active' => 1
        ];
        $count = DB::table('modules')->where('Title', 'Users')->count();
        if ($count == 0) {
            DB::table('modules')->insert($data);
        } else {
            return false;
        }



    }

    public function register()
    {

    }
}
