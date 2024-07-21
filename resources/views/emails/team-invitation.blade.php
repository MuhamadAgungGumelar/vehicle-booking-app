@component('mail::message')
# Team Invitation

You have been invited to join our team!

@component('mail::button', ['url' => $acceptUrl])
Accept Invitation
@endcomponent

If you did not expect to receive this invitation, you can ignore this email.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
