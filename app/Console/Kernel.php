<?php

namespace App\Console;

use App\Console\Commands\EnviarCorreoVerificacionComando;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Defino las tareas programadas.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //     ->daily(); // corra diariamente

        // $schedule->command('inspire')
        //     // indico donde se carga los logs, en este caso en el storege/inspire.log
        //     ->sendOutputTo(storage_path('inspire.log'))
        //     ->hourly(); // corre cada hora

        // $schedule->call(function () { echo 'Test'; })
        //     ->everyMinute() //
        //     ->everyFiveMinutes() // ejecuta cada 5 minutos
        //     ->evenInMaintenanceMode(); // corre igualmente si tenemos activo el modo mantenimiento

        // $schedule->command('send:newsletter --schedule')
        //     ->onOneServer()
        //     ->withoutOverlapping()
        //     ->mondays(); // para que corra todo los lunes

        // $schedule->command(EnviarCorreoVerificacionComando::class)
        //     ->onOneServer() // corra en un solo servidor(si es que la aplicaicon esta en varios)
        //     ->withoutOverlapping() // me evita la superposicion de tareas
        //     ->mondays(); // para que corra todo los lunes
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
