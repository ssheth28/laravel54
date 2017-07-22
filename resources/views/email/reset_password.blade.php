Hi {{ $userName }},
</br></br>
You are receiving this email because we received a password reset request for your account.
</br></br>
Click the following link to reset your password
</br></br>
<a href="{{ url('password/reset?email='.$email, $token) }}">Reset password</a>