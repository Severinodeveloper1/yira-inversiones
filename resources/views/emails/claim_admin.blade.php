<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Nueva Reclamación {{ $claim->claim_number }}</title>
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'Segoe UI',Arial,sans-serif;background:#f4f4f5;color:#18181b}
        .wrapper{max-width:580px;margin:32px auto;background:#fff;border-radius:10px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.08)}
        .header{background:#7f1d1d;padding:32px 36px;text-align:center}
        .header h1{color:#fff;font-size:20px;font-weight:700}
        .header p{color:rgba(255,255,255,.55);font-size:12px;margin-top:3px}
        .badge{display:inline-block;background:#fca5a5;color:#7f1d1d;font-size:11px;font-weight:800;padding:4px 14px;border-radius:3px;letter-spacing:1px;text-transform:uppercase;margin-top:12px}
        .body{padding:32px 36px}
        .claim-num{background:#fee2e2;border:1px solid #fca5a5;border-radius:8px;padding:16px 20px;margin-bottom:20px;text-align:center}
        .claim-num span{font-size:11px;color:#7f1d1d;text-transform:uppercase;letter-spacing:1px;display:block}
        .claim-num strong{font-size:22px;font-weight:800;color:#7f1d1d}
        .row{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:20px}
        .box{background:#f9f9f9;border-radius:6px;padding:14px}
        .box label{font-size:10px;font-weight:700;text-transform:uppercase;color:#a1a1aa;letter-spacing:.8px;display:block;margin-bottom:3px}
        .box p{font-size:13px;font-weight:500;color:#1c1c1e}
        .type-badge{display:inline-block;padding:3px 10px;border-radius:4px;font-size:11px;font-weight:700;text-transform:uppercase}
        .type-reclamo{background:#fee2e2;color:#7f1d1d}
        .type-queja{background:#fef3c7;color:#92400e}
        .desc{background:#fef2f2;border-left:4px solid #b91c1c;border-radius:6px;padding:16px;margin-bottom:20px}
        .desc label{font-size:10px;font-weight:700;text-transform:uppercase;color:#b91c1c;letter-spacing:.8px;display:block;margin-bottom:6px}
        .desc p{font-size:13px;color:#1c1c1e;line-height:1.6;white-space:pre-wrap}
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
        <p>Libro de Reclamaciones — Notificación Interna</p>
        <div class="badge">⚠️ Nueva Reclamación</div>
    </div>
    <div class="body">
        <div class="claim-num">
            <span>Código de Reclamación</span>
            <strong>{{ $claim->claim_number }}</strong>
        </div>
        <div class="row">
            <div class="box"><label>Nombre Completo</label><p>{{ $claim->fullname }}</p></div>
            <div class="box"><label>Tipo</label><p><span class="type-badge type-{{ $claim->type }}">{{ ucfirst($claim->type) }}</span></p></div>
            <div class="box"><label>Documento</label><p>{{ $claim->document_type }} — {{ $claim->document_number }}</p></div>
            <div class="box"><label>Correo</label><p><a href="mailto:{{ $claim->email }}" style="color:#b91c1c;text-decoration:none">{{ $claim->email }}</a></p></div>
            <div class="box"><label>Teléfono</label><p><a href="tel:{{ $claim->phone }}" style="color:#b91c1c;text-decoration:none">{{ $claim->phone }}</a></p></div>
            <div class="box"><label>Estado</label><p>{{ ucfirst($claim->status) }}</p></div>
        </div>
        <div class="desc">
            <label>Descripción del {{ ucfirst($claim->type) }}</label>
            <p>{{ $claim->description }}</p>
        </div>
        <div class="cta">
            <a href="{{ url('/admin/claims') }}">Ver en el Panel Admin</a>
        </div>
        <p style="font-size:12px;color:#71717a;text-align:center">Registrado el {{ $claim->created_at->format('d/m/Y') }} a las {{ $claim->created_at->format('H:i') }}</p>
    </div>
    <div class="footer"><p>© {{ date('Y') }} {{ config('app.name') }} — Uso interno</p></div>
</div>
</body>
</html>
