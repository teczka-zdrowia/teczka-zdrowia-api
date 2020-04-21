@component('mail::message')
# Cześć!

Otrzymujesz ten e-mail, ponieważ specjalista właśnie utworzył twoje konto.
Po zalogowaniu się pamiętaj o **zmianie tymczasowego hasła**.

@component('mail::button', ['url' => 'https://teczkazdrowia.pl/auth'])
Zaloguj się
@endcomponent

Twoje dane logowania to:<br>
**E-mail:** {{ $user->email }}<br>
**Hasło:** {{ $userPassword }}

Pozdrawiamy,<br>
{{ config('app.name') }}
@endcomponent
