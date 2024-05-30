<x-mail::message>
![RGRP Logo]({{ $image }})

---

# Hi {{ $name }}!

Please click the button below to verify your account, This email expires in **20 minutes**

<x-mail::button :url="$verificationUrl">
Click Here
</x-mail::button>

##### If you didn't request this email, You can safely ignore this email. 

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
