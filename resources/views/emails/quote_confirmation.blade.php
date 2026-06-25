<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Recibimos tu mensaje</title>
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'Segoe UI',Arial,sans-serif;background:#f4f4f5;color:#18181b}
        .wrapper{max-width:560px;margin:32px auto;background:#fff;border-radius:10px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.08)}
        .header{background:#1c1c1e;padding:36px;text-align:center}
        .header h1{color:#fff;font-size:20px;font-weight:700}
        .header p{color:rgba(255,255,255,.5);font-size:12px;margin-top:3px}
        .check{font-size:48px;margin-bottom:8px;display:block}
        .body{padding:36px}
        .greeting{font-size:17px;font-weight:600;margin-bottom:10px}
        .intro{color:#52525b;font-size:14px;line-height:1.6;margin-bottom:24px}
        .summary{background:#f4f4f5;border-radius:8px;padding:20px;margin-bottom:24px}
        .summary p{font-size:13px;color:#52525b;margin-bottom:6px}
        .summary p strong{color:#1c1c1e;font-weight:600}
        .msg{background:#fef3c7;border-left:4px solid #f59e0b;padding:14px;border-radius:6px;margin-bottom:24px}
        .msg label{font-size:10px;font-weight:700;text-transform:uppercase;color:#92400e;letter-spacing:.8px;display:block;margin-bottom:5px}
        .msg p{font-size:13px;color:#1c1c1e;line-height:1.6;white-space:pre-wrap}
        .note{font-size:12px;color:#71717a;text-align:center;line-height:1.6;margin-bottom:10px}
        .footer{background:#f9f9f9;padding:20px 36px;text-align:center;border-top:1px solid #e4e4e7}
        .footer p{font-size:11px;color:#a1a1aa}
        .footer a{color:#b91c1c;text-decoration:none}
    </style>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <span class="check">✅</span>
        <h1>YIRA INVERSIONES</h1>
        <p>Tu mensaje ha sido recibido</p>
    </div>
    <div class="body">
        <p class="greeting">Hola, {{ $quote->name }} 👋</p>
        <p class="intro">
            Gracias por contactarnos. Hemos recibido tu solicitud y nuestro equipo se pondrá en contacto contigo
            a la brevedad posible para brindarte la asesoría que necesitas.
        </p>
        <div class="summary">
            <p><strong>Nombre:</strong> {{ $quote->name }}</p>
            <p><strong>Correo:</strong> {{ $quote->email }}</p>
            <p><strong>Teléfono:</strong> {{ $quote->phone }}</p>
            @if($quote->project)<p><strong>Proyecto:</strong> {{ $quote->project }}</p>@endif
        </div>
        <div class="msg">
            <label>Tu mensaje</label>
            <p>{{ $quote->message }}</p>
        </div>
        <p class="note">
            Si tienes alguna duda adicional, escríbenos a
            <a href="mailto:{{ config('mail.from.address') }}" style="color:#b91c1c">{{ config('mail.from.address') }}</a>
            o al WhatsApp <strong>{{ \App\Models\Setting::first()?->whatsapp_phone ?? \App\Models\Setting::first()?->phone ?? '' }}</strong>.
        </p>
    </div>
    <div class="footer">
        <p>© {{ date('Y') }} <a href="{{ url('/') }}">{{ config('app.name') }}</a>. Todos los derechos reservados.</p>
    </div>
</div>
</body>
</html>
