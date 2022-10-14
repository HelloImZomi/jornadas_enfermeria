@component('mail::message')
# ¡Hola {{ $details['name'] }}!

Hemos recibido tu solicitud de registro a **{{ $details['convocation_title'] }}** de la Universidad de Navojoa. Dentro
de unos momentos revisaremos tu solicitud para posteriormente compartirte el acceso.

@component('mail::button', ['url' => $details['url']])
Revisar mi inscripción
@endcomponent


> Cualquier duda, favor de contactarnos por email a jornadasenfermeria@unav.edu.mx o al número 00000000.

Gracias,

{{ config('app.name') }}
@endcomponent
