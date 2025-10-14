<?php

namespace Modules\RideShare\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Modules\RideShare\Http\Middleware\AdminRideShareModuleCheckMiddleware;

class RideShareServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'RideShare';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'rideshare';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        app()->make('router')->aliasMiddleware('admin-ride-share-module', AdminRideShareModuleCheckMiddleware::class);
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));


        // require base_path('Modules/RideShare/routes/channels.php');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);

        $this->bindInterfaces($this->moduleName, 'Repository');
        $this->bindInterfaces($this->moduleName, 'Service');
    }


    private function bindInterfaces($moduleName, $fileType) {
        $repositoryFiles = [];
        //root files
        $files = File::files(module_path($moduleName, $fileType));
        foreach ($files as $file) {
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $interfaceName = $filename . 'Interface';
            $repositoryFiles[] = [
                'interfaceClass' => 'Modules\\'. $moduleName .'\\Interface\\' . $interfaceName,
                'class' => 'Modules\\'. $moduleName .'\\'. $fileType . '\\' . $filename,
                'interfaceFile' => module_path($moduleName, 'Interface') . '/' . $interfaceName . '.php',
                'classFile' => module_path($moduleName, $fileType) . '/' . $filename . '.php'
            ];
        }

        //subfolder files
        $subfolders = File::directories(module_path($moduleName, $fileType));
        foreach ($subfolders as $subfolder) {
            $folderName = basename($subfolder);
            $files =  File::files($subfolder);
            foreach ($files as $file) {
                $filename = pathinfo($file, PATHINFO_FILENAME);
                $interfaceName = $filename . 'Interface';
                $repositoryFiles[] = [
                    'interfaceClass' => 'Modules\\'. $moduleName .'\\Interface\\' . $folderName . '\\'. $fileType .'\\' . $interfaceName,
                    'class' => 'Modules\\'. $moduleName .'\\'. $fileType .'\\' . $folderName . '\\' . $filename,
                    'interfaceFile' => module_path($moduleName, 'Interface') . '/' . $folderName . '/'. $fileType .'/' . $interfaceName . '.php',
                    'classFile' => module_path($moduleName, $fileType) . '/' . $folderName . '/' . $filename . '.php'
                ];
            }
        }

        // Bind interfaces to implementations
        foreach ($repositoryFiles as $repositoryFile) {
            if( File::exists($repositoryFile['interfaceFile']) && File::exists($repositoryFile['classFile'])) {
                $this->app->bind(
                    $repositoryFile['interfaceClass'],
                    $repositoryFile['class']
                );
            }
        }
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $this->moduleNameLower = 'ride-share';
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
