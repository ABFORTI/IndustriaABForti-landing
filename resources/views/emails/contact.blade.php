<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Nuevo contacto — {{ $submission['company_label'] }}</title>
</head>
<body style="margin:0; padding:0; background:#f4f4f5; font-family: Arial, Helvetica, sans-serif; color:#17181c;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f5; padding:32px 16px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:560px; background:#ffffff; border-radius:16px; overflow:hidden;">
                    <tr>
                        <td style="background:#17181c; padding:24px 32px;">
                            <span style="color:#ffffff; font-size:12px; font-weight:600; letter-spacing:0.15em; text-transform:uppercase;">
                                Business AB Forti — Nuevo contacto
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:32px;">
                            <p style="margin:0 0 20px; font-size:14px; color:#52525b;">
                                Alguien solicitó información desde el sitio web Business y eligió
                                <strong>{{ $submission['company_label'] }}</strong> como destino.
                            </p>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="font-size:14px;">
                                <tr>
                                    <td style="padding:8px 0; color:#71717a; width:140px;">Nombre completo</td>
                                    <td style="padding:8px 0; font-weight:600;">{{ $submission['name'] }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0; color:#71717a;">Teléfono</td>
                                    <td style="padding:8px 0; font-weight:600;">{{ $submission['phone'] }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0; color:#71717a;">Correo</td>
                                    <td style="padding:8px 0; font-weight:600;">
                                        <a href="mailto:{{ $submission['email'] }}" style="color:#1e3a8a;">{{ $submission['email'] }}</a>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin:24px 0 8px; font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:0.1em; color:#71717a;">
                                Mensaje
                            </p>
                            <p style="margin:0; padding:16px; background:#f4f4f5; border-radius:12px; font-size:14px; line-height:1.6; white-space:pre-line;">{{ $submission['message'] }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:16px 32px; background:#f4f4f5; font-size:11px; color:#a1a1aa;">
                            Enviado automáticamente desde el formulario de contacto de businessabforti.com
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
