@component('mail::message')
# Introduction

Here is your password reset link

@component('mail::button', ['url' =>  route('user.forgetpassword', ['token' => $email_verification_code['verification_string']])])
Activate account
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
