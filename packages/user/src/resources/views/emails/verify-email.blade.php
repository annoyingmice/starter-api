@extends('user::emails.layout')

@section('content')
<tr>
    <td align="center">
        <h2 style="color: #333; margin: 0;">Hello,</h2>
        <p style="color: #555; font-size: 14px; margin: 10px 0;">Please click the button below to verify your email
            address.</p>
    </td>
</tr>
<tr>
    <td align="center">
        <!-- Verify button -->
        <table role="presentation" cellspacing="0" cellpadding="10" border="0">
            <tr>
                <td align="center" style="padding: 20px 0;">
                    <a href="{{ $url }}"
                        style="background-color: #333; color: #fff; font-size: 16px; font-weight: bold; padding: 12px 24px; border-radius: 5px; text-decoration: none; box-shadow: 0 3px 6px rgba(255, 255, 255, 0.2); display: inline-block;">
                        Verify Now
                    </a>
                </td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td align="left">
        <p style="color: #777; font-size: 14px; margin: 10px 0;">If you did not create an account, no further action is
            required.</p>
    </td>
</tr>
<tr>
    <td align="left">
        <p style="color: #777; font-size: 12px; margin: 20px 0;">
            Regards, <br />
            Your Team
        </p>
    </td>
</tr>
@endsection