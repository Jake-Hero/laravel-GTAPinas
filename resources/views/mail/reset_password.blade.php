<x-mail::message>
![RGRP Logo]({{ $image }})

---

# Hi {{ $name }}!

You are receiving this email because we received a password reset request for your account.

Click the button below to proceed on resetting your password.

<x-mail::button :url="$resetLink">
Reset Password
</x-mail::button>

##### If you didn't request this email, You can safely ignore this email. 

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
