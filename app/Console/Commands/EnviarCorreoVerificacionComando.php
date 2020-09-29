<?php

namespace App\Console\Commands;

use App\User;
use App\Notifications\nuevaInformacionNotificacion;
use Illuminate\Console\Command;

class EnviarCorreoVerificacionComando extends Command
{
    /**
     * Este representa la firma del comando.
     *
     * @var string
     */
    protected $signature = 'enviar:usuarioNoAutenticado {emails?*}';

    /**
     * Una descripcion que ayuda a lo que hace el comando.
     *
     * @var string
     */
    protected $description = 'Envia un correo electronico a los usuarios que no han verificado su cuenta';

    /**
     * Ademas, consta de un constructor para pasarle parametros.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * El handle ejecuta la logica del negocio.
     *
     * @return mixed
     */
    public function handle()
    {
        # obtengo el valor del argumento del comando
        $emails = $this->argument('emails');
        # creo una query
        $builder = User::query();

        if ($emails) {
            # compara si los emails de los usuarios con el email del argumento
            $builder->whereIn('email', $emails);
        }

        # veo si tengo usuarios
        $cuantos = $builder->count();


        if ($cuantos) {
            # creo la barra de progreso en la consola..
            # $this->output->progressStart($cuantos);

            # si hay usuario sin autenticar el correo..
            $builder
                ->whereNull('email_verified_at')
                # como laravel me devuelve una coleccion
                ->each(function  (User $user) {
                    # usamos las notificaciones
                    # equivalente
                    $user->notify(new nuevaInformacionNotificacion());
                    # $user->nuevaInformacionNotificacion();
                    #$this->output->progressAdvance( ); # para aumentar el proceso d la barra
                });
            $this->info("Se enviarion {$cuantos} correos");
            #$this->output->progressFinish(); # para finalizar la barra
            return ;
        }
        $this->info('No se enviaron ningun correo');
        return ;

    }
}
