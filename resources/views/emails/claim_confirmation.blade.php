<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Reclamación {{ $claim->claim_number }} Registrada</title>
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'Segoe UI',Arial,sans-serif;background:#f4f4f5;color:#18181b}
        .wrapper{max-width:560px;margin:32px auto;background:#fff;border-radius:10px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.08)}
        .header{background:#7f1d1d;padding:36px;text-align:center}
        .header h1{color:#fff;font-size:20px;font-weight:700}
        .header p{color:rgba(255,255,255,.5);font-size:12px;margin-top:3px}
        .body{padding:36px}
        .greeting{font-size:16px;font-weight:600;margin-bottom:10px}
        .intro{color:#52525b;font-size:14px;line-height:1.6;margin-bottom:22px}
        .claim-card{background:#fee2e2;border:1px solid #fca5a5;border-radius:10px;padding:22px;text-align:center;margin-bottom:22px}
        .claim-card span{font-size:11px;color:#7f1d1d;text-transform:uppercase;letter-spacing:1px;display:block;margin-bottom:5px}
        .claim-card strong{font-size:26px;font-weight:800;color:#7f1d1d;letter-spacing:1px}
        .info{background:#f9f9f9;border-radius:8px;padding:18px;margin-bottom:22px}
        .info p{font-size:13px;color:#52525b;margin-bottom:5px}
        .info p strong{color:#1c1c1e;font-weight:600}
        .desc{background:#fff7f7;border-left:4px solid #b91c1c;padding:14px;border-radius:6px;margin-bottom:22px}
        .desc label{font-size:10px;font-weight:700;text-transform:uppercase;color:#b91c1c;letter-spacing:.8px;display:block;margin-bottom:5px}
        .desc p{font-size:13px;color:#1c1c1e;line-height:1.6;white-space:pre-wrap}
        .note{font-size:12px;color:#71717a;line-height:1.7;text-align:center;padding:14px;background:#f4f4f5;border-radius:6px;margin-bottom:10px}
        .footer{background:#f9f9f9;padding:20px 36px;text-align:center;border-top:1px solid #e4e4e7}
        .footer p{font-size:11px;color:#a1a1aa}
        .footer a{color:#b91c1c;text-decoration:none}
    </style>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <h1>YIRA INVERSIONES</h1>
        <p>Libro de Reclamaciones Digital</p>
    </div>
    <div class="body">
        <p class="greeting">Estimado/a {{ $claim->fullname }},</p>
        <p class="intro">
            Su {{ $claim->type === 'queja' ? 'queja' : 'reclamo' }} ha sido registrado en nuestro Libro de Reclamaciones Digital.
            Atenderemos su caso en el plazo establecido por la normativa peruana (máximo 30 días calendario).
        </p>
        <div class="claim-card">
            <span>Código de {{ ucfirst($claim->type) }}</span>
            <strong>{{ $claim->claim_number }}</strong>
        </div>
        <div class="info">
            <p><strong>Fecha de registro:</strong> {{ $claim->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Tipo:</strong> {{ ucfirst($claim->type) }}</p>
            <p><strong>Documento:</strong> {{ $claim->document_type }} — {{ $claim->document_number }}</p>
            <p><strong>Correo de contacto:</strong> {{ $claim->email }}</p>
        </div>
        <div class="desc">
            <label>Su descripción</label>
            <p>{{ $claim->description }}</p>
        </div>
        <div class="note">
            📌 Guarde su código <strong>{{ $claim->claim_number }}</strong> para hacer seguimiento.<br>
            Para consultas, contáctenos en
            <a href="mailto:{{ config('mail.from.address') }}" style="color:#b91c1c">{{ config('mail.from.address') }}</a>.
        </div>
    </div>
    <div class="footer">
        <p>© {{ date('Y') }} <a href="{{ url('/') }}">{{ config('app.name') }}</a>. Todos los derechos reservados.</p>
    </div>
</div>
</body>
</html>
