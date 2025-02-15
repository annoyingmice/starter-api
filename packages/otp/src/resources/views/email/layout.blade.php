<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>OTP Verification</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f4; text-align: center; font-family: Arial, sans-serif;">

    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #f4f4f4; padding: 20px;">
        <tr>
            <td align="center">
                <!-- Main Container -->
                <table role="presentation" width="400px" cellspacing="0" cellpadding="0" border="0" style="background-color: #ffffff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                    @include("otp::email.header")

                    <!-- Content here -->
                    @yield("content")
                    
                    <!-- Footer -->
                    @include("otp::email.footer")
                </table>
                <!-- End Main Container -->
            </td>
        </tr>
    </table>

</body>
</html>
