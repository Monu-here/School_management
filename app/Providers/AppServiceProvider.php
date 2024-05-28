<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $datePath = storage_path('logs' . '/' . date("Y/m/d"));
        File::ensureDirectoryExists($datePath);

        DB::listen(function ($query) use ($datePath) {
            $sql = trim($query->sql, " \t\n\r\0\x0B()");
            $op = strtolower(strtok($sql, " "));

            if (!in_array($op, ["select", "with", 'SELECT', "SELECT\r\n", "select\r\n"])) {
                try {
                    $fp = fopen($datePath . '/data.txt', 'a');
                    fwrite($fp, json_encode([$op, date("Y,m,d h:i:s"), $sql, $query->bindings, $query->time, Auth::id()]) . PHP_EOL);
                    fclose($fp);
                } catch (\Throwable $th) {
                }
            } else {
                 
                    $fp = fopen($datePath . '/select.txt', 'a');
                    fwrite($fp, json_encode([$op, date("Y,m,d h:i:s"), $sql, $query->bindings, $query->time, str_replace('/', '->', request()->path())]) . PHP_EOL);
                    fclose($fp);
                
            }
        });
    }
}
