@extends('otp::email.layout')

@section('content')
<tr>
    <td align="center">
        <h2 style="color: #333; margin: 0;">Your OTP Code</h2>
        <p style="color: #555; font-size: 14px; margin: 10px 0;">Use the code below to verify your login:</p>
    </td>
</tr>
<tr>
    <td align="center">
        <!-- OTP Code -->
        <table role="presentation" cellspacing="0" cellpadding="10" border="0"
            style="background-color: #f8f8f8; border-radius: 5px; margin: 20px 0;">
            <tr>
                <td align="center" style="font-size: 24px; font-weight: bold; color: #333;">{{ $otp }}</td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td align="center">
        <p style="color: #777; font-size: 14px; margin: 10px 0;">This code will expire in 1 minute.</p>
    </td>
</tr>
<tr>
    <td align="center">
        <p style="color: #777; font-size: 12px; margin: 20px 0;">If you didn't request this, please ignore this email.
        </p>
    </td>
</tr>
@endsection