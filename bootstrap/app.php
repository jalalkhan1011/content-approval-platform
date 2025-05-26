<?php

use App\Http\Middleware\AdminMiddleware;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => AdminMiddleware::class,
        ]);
    })
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('posts:archive-old-pending-posts')
            ->dailyAt('00:00')
            ->withoutOverlapping()
            ->runInBackground();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
