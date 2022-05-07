@component('mail::message')
# The status of  order (#{{$order->id}}) has been changed

The body of your message.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
