<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Nueva Consulta — {{ $quote->name }}</title>
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'Segoe UI',Arial,sans-serif;background:#f4f4f5;color:#18181b}
        .wrapper{max-width:580px;margin:32px auto;background:#fff;border-radius:10px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.08)}
        .header{background:#1c1c1e;padding:32px 36px;text-align:center}
        .header h1{color:#fff;font-size:20px;font-weight:700}
        .header p{color:rgba(255,255,255,.5);font-size:12px;margin-top:3px}
        .badge{display:inline-block;background:#f59e0b;color:#1c1c1e;font-size:11px;font-weight:800;padding:4px 14px;border-radius:3px;letter-spacing:1px;text-transform:uppercase;margin-top:12px}
        .body{padding:32px 36px}
        .row{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:20px}
        .box{background:#f9f9f9;border-radius:6px;padding:14px}
        .box label{font-size:10px;font-weight:700;text-transform:uppercase;color:#a1a1aa;letter-spacing:.8px;display:block;margin-bottom:3px}
        .box p{font-size:13px;font-weight:500;color:#1c1c1e}
        .msg-box{background:#fef9ec;border-left:4px solid #f59e0b;border-radius:6px;padding:16px;margin-bottom:24px}
        .msg-box label{font-size:10px;font-weight:700;text-transform:uppercase;color:#92400e;letter-spacing:.8px;display:block;margin-bottom:6px}
        .msg-box p{font-size:14px;color:#1c1c1e;line-height:1.6;white-space:pre-wrap}
        .cta{text-align:center;margin:24px 0}
        .cta a{display:inline-block;background:#1c1c1e;color:#fff;text-decoration:none;font-weight:700;font-size:13px;padding:12px 28px;border-radius:7px}
        .footer{background:#f9f9f9;padding:20px 36px;text-align:center;border-top:1px solid #e4e4e7}
        .footer p{font-size:11px;color:#a1a1aa}
        @media(max-width:480px){.row{grid-template-columns:1fr}.body{padding:24px 20px}}
    </style>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <h1>YIRA INVERSIONES</h1>
        <p>Notificación Interna</p>
        <div class="badge">📩 Nueva Consulta / Cotización</div>
    </div>
    <div class="body">
        <div class="row">
            <div class="box"><label>Nombre</label><p>{{ $quote->name }}</p></div>
            <div class="box"><label>Correo</label><p><a href="mailto:{{ $quote->email }}" style="color:#b91c1c;text-decoration:none">{{ $quote->email }}</a></p></div>
            <div class="box"><label>Teléfono</label><p><a href="tel:{{ $quote->phone }}" style="color:#b91c1c;text-decoration:none">{{ $quote->phone }}</a></p></div>
            <div class="box"><label>Proyecto / Asunto</label><p>{{ $quote->project ?: '—' }}</p></div>
        </div>
        <div class="msg-box">
            <label>Mensaje / Detalle</label>
            <p>{{ $quote->message }}</p>
        </div>
        <div class="cta">
            <a href="{{ url('/admin/quotes') }}">Ver en el Panel Admin</a>
        </div>
        <p style="font-size:12px;color:#71717a;text-align:center">Recibido el {{ $quote->created_at->format('d/m/Y') }} a las {{ $quote->created_at->format('H:i') }}</p>
    </div>
    <div class="footer"><p>© {{ date('Y') }} {{ config('app.name') }} — Uso interno</p></div>
</div>
</body>
</html>
