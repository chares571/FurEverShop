<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Database\Seeders\ProductSeeder;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('products:restore-backup', function () {
    $this->call('db:seed', ['--class' => ProductSeeder::class, '--force' => true]);
    $this->info('Products restored from the local backup file.');
})->purpose('Restore products from the local catalog backup file');
