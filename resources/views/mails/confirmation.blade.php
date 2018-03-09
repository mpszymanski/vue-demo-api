@component('mail::message')
# Receipt Register

Hi, {{ $customer->first_name }}<br>
Your Receipt was Registered!
@component('mail::table')
|               |                          |
| ------------- |:------------------------:|
| Shop Zip      | {{ $receipt->shop_zip }} |
| Code          | {{ $receipt->code }}     |
@endcomponent

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent