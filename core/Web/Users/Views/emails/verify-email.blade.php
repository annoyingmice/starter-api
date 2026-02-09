@extends('shared::emails.layouts.default')

@section('content')
<tr>
    <td align="center" style="padding: 20px 0;">
        {{-- Use Lang for easy translation later --}}
        <h2 style="color: #333; margin: 0;">{{ __('Hello!') }}</h2>
        <p style="color: #555; font-size: 16px; line-height: 1.5; margin: 10px 0;">
            {{ __('Please click the button below to verify your email address.') }}
        </p>
    </td>
</tr>

<tr>
    <td align="center">
        <table role="presentation" cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td align="center" bgcolor="#333333" style="border-radius: 5px;">
                    <a href="{{ $url }}"
                        target="_blank"
                        style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; border-radius: 5px; padding: 12px 24px; border: 1px solid #333333; display: inline-block; font-weight: bold;">
                        {{ __('Verify Email Address') }}
                    </a>
                </td>
            </tr>
        </table>
    </td>
</tr>

<tr>
    <td align="left" style="padding-top: 30px;">
        <p style="color: #777; font-size: 14px; line-height: 1.5;">
            {{ __('If you did not create an account, no further action is required.') }}
        </p>
        <p style="color: #777; font-size: 14px; margin-top: 20px;">
            {{ __('Regards,') }}<br>
            <strong>{{ config('app.name') }}</strong>
        </p>
    </td>
</tr>

{{-- Subcopy: For mail clients that don't show buttons well --}}
<tr>
    <td align="left" style="padding-top: 20px; border-top: 1px solid #EDEFF2;">
        <p style="color: #777; font-size: 12px;">
            {{ __("If you're having trouble clicking the \":actionText\" button, copy and paste the URL below into your web browser:", ['actionText' => __('Verify Email Address')]) }}
            <br>
            <span style="word-break: break-all; color: #3869D4;">{{ $url }}</span>
        </p>
    </td>
</tr>
@endsection
