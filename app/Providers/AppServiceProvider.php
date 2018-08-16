<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \App\Votation::retrieved(function ($poll){
            if ($poll->setting->auto_start){
                if ($poll->setting->start_time->lte(new \Carbon\Carbon())){
                    $poll->setting->auto_start = false;
                    $poll->status = 'open';
                    $poll->save();
                }
            }
            
            if($poll->setting->auto_end) {
                if ($poll->setting->end_time->lte(new \Carbon\Carbon())){
                    $poll->setting->auto_end = false;
                    $poll->status = 'closed';
                    $poll->save();
                }
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
