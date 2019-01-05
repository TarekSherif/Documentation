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
        //
        view()->composer('*', function($view) {
            $view_name=$view->getName();
            $promptPosition= '';
            if(session("lang")=="ar" ){
                $promptPosition= ',{promptPosition:"topLeft"}';
            }
            
            $jtable=true;
            $MenuSettings=RoleMenu('Settings');
            $MenuReports=RoleMenu('Reports');
            $data = array('view_name' => $view_name,
                          'Permission'=>PagePermission($view_name),
                          'jtable'=>  $jtable,
                          'MenuSettings'=>$MenuSettings,
                          'MenuReports'=>$MenuReports,
                          'promptPosition'=> $promptPosition);
            view()->share( $data);
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
