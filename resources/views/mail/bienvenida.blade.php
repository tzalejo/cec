
<div class="flex-center position-ref full-height" id="particles-js">
    <div class="content">
        <h1 style="margin:0px;">Centro de Espcializacion en Computacion y Estudios Comerciales</h1>
        @if($user->esDirector())
        <p>Bienvenido Director {{$user->userNombre}} a Sistema CEC</p>
        @else
        <p>El Director {{$admin->userNombre}} te da la bienvenido {{$user->userNombre}} a Sistema CEC</p>
        @endif
        <p>Su usuario de registro</p>
        <p><u>Usuario:</u><strong> {{$user->email}}</strong></p>
    </div>
</div>
