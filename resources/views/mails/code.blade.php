@component('mail::message')
# Receipt Register

Hi, {{ $customer->first_name }}<br>
Your Receipt was Confirmed!<br>

<h3>Here is your Code:</h3>
<h1>{{ $discount->code }}</h1>

Have a nice shopping!<br>
{{ config('app.name') }} Team
@endcomponent