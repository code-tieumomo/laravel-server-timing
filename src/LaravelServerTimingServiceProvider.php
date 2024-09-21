<?php

namespace CodeTieumomo\LaravelServerTiming;

use Illuminate\Http\Response;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelServerTimingServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name('laravel-server-timing');
    }

    public function boot()
    {
        Response::macro('serverTiming', function (array $data) {
            return $this->header('Server-Timing', collect($data)->map(function ($value, $key) {
                return $key.';desc="'.$value['desc'].'";dur='.$value['dur'];
            })->implode(','));
        });

        return parent::boot();
    }
}
