<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Pedido {{ $order->order_number }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f4f4f5; color: #18181b; }
        .wrapper { max-width: 600px; margin: 32px auto; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
        .header { background: #1c1c1e; padding: 36px 40px; text-align: center; }
        .header img { height: 48px; margin-bottom: 16px; }
        .header h1 { color: #fff; font-size: 22px; font-weight: 700; letter-spacing: -0.3px; }
        .header p { color: rgba(255,255,255,0.6); font-size: 13px; margin-top: 4px; }
        .badge { display: inline-block; background: #b91c1c; color: #fff; font-size: 12px; font-weight: 700; padding: 4px 14px; border-radius: 4px; letter-spacing: 1px; text-transform: uppercase; margin-top: 14px; }
        .body { padding: 36px 40px; }
        .greeting { font-size: 17px; font-weight: 600; margin-bottom: 10px; }
        .intro { color: #52525b; font-size: 14px; line-height: 1.6; margin-bottom: 28px; }
        .order-number { background: #f4f4f5; border-left: 4px solid #b91c1c; padding: 16px 20px; border-radius: 6px; margin-bottom: 28px; }
        .order-number span { font-size: 12px; color: #71717a; text-transform: uppercase; letter-spacing: 1px; }
        .order-number strong { display: block; font-size: 20px; font-weight: 700; color: #1c1c1e; letter-spacing: 0.5px; }
        .section-title { font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.2px; color: #71717a; margin-bottom: 14px; border-bottom: 1px solid #e4e4e7; padding-bottom: 8px; }
        table.items { width: 100%; border-collapse: collapse; margin-bottom: 28px; }
        table.items th { text-align: left; font-size: 12px; font-weight: 600; color: #71717a; padding: 8px 0; border-bottom: 1px solid #e4e4e7; }
        table.items td { padding: 12px 0; border-bottom: 1px solid #f4f4f5; font-size: 14px; vertical-align: top; }
        table.items td.qty { color: #71717a; font-size: 13px; }
        table.items td.price { text-align: right; font-weight: 600; white-space: nowrap; }
        .totals { width: 100%; margin-bottom: 28px; }
        .totals tr td { padding: 4px 0; font-size: 14px; color: #52525b; }
        .totals tr td:last-child { text-align: right; }
        .totals tr.total td { font-size: 16px; font-weight: 700; color: #1c1c1e; border-top: 2px solid #1c1c1e; padding-top: 10px; margin-top: 6px; }
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 28px; }
        .info-box { background: #f9f9f9; border-radius: 8px; padding: 16px; }
        .info-box label { font-size: 11px; font-weight: 700; text-transform: uppercase; color: #a1a1aa; letter-spacing: 0.8px; display: block; margin-bottom: 4px; }
        .info-box p { font-size: 13px; color: #1c1c1e; font-weight: 500; }
        .cta { text-align: center; margin: 32px 0; }
        .cta a { display: inline-block; background: #b91c1c; color: #fff; text-decoration: none; font-weight: 700; font-size: 14px; padding: 14px 32px; border-radius: 8px; letter-spacing: 0.3px; }
        .footer { background: #f9f9f9; padding: 24px 40px; text-align: center; border-top: 1px solid #e4e4e7; }
        .footer p { font-size: 12px; color: #a1a1aa; line-height: 1.6; }
        .footer a { color: #b91c1c; text-decoration: none; }
        @media (max-width: 480px) {
            .body { padding: 24px 20px; }
            .header { padding: 28px 20px; }
            .info-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
<div class="wrapper">
    <!-- HEADER -->
    <div class="header">
        <h1>YIRA INVERSIONES</h1>
        <p>Muebles de calidad para tu hogar y oficina</p>
        <div class="badge">Confirmación de Pedido</div>
    </div>

    <!-- BODY -->
    <div class="body">
        <p class="greeting">Hola, {{ $order->billing_name }} 👋</p>
        <p class="intro">
            Tu pedido ha sido registrado con éxito. A continuación encontrarás el resumen
            de tu compra. Nos pondremos en contacto contigo pronto para coordinar la entrega.
        </p>

        <!-- ORDER NUMBER -->
        <div class="order-number">
            <span>Número de Pedido</span>
            <strong>{{ $order->order_number }}</strong>
        </div>

        <!-- DATOS DEL CLIENTE -->
        <p class="section-title">Datos de Facturación</p>
        <div class="info-grid">
            <div class="info-box">
                <label>Nombre / Razón Social</label>
                <p>{{ $order->billing_name }}</p>
            </div>
            <div class="info-box">
                <label>Comprobante</label>
                <p>{{ ucfirst($order->document_type) }} — {{ $order->document_number }}</p>
            </div>
            <div class="info-box">
                <label>Correo Electrónico</label>
                <p>{{ $order->email }}</p>
            </div>
            <div class="info-box">
                <label>Teléfono</label>
                <p>{{ $order->phone }}</p>
            </div>
        </div>

        <!-- ENVÍO -->
        <p class="section-title">Método de Entrega</p>
        <div class="info-grid" style="margin-bottom:28px;">
            <div class="info-box">
                <label>Modalidad</label>
                <p>
                    @php
                        $shippingLabels = [
                            'recojo_tienda'  => 'Recojo en Tienda',
                            'delivery'       => 'Delivery',
                            'envio_agencia'  => 'Envío por Agencia',
                        ];
                    @endphp
                    {{ $shippingLabels[$order->shipping_method] ?? ucfirst($order->shipping_method) }}
                </p>
            </div>
            @if($order->shipping_address)
            <div class="info-box">
                <label>Dirección</label>
                <p>{{ $order->shipping_address }}</p>
            </div>
            @endif
        </div>

        <!-- PRODUCTOS -->
        <p class="section-title">Detalle del Pedido</p>
        <table class="items">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th style="text-align:center;">Cant.</th>
                    <th style="text-align:right;">Precio</th>
                    <th style="text-align:right;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>
                        <strong style="display:block;">{{ $item->product_name }}</strong>
                        @if($item->color)
                        <span style="font-size:12px;color:#71717a;">Color: {{ $item->color }}</span>
                        @endif
                    </td>
                    <td class="qty" style="text-align:center;">× {{ $item->quantity }}</td>
                    <td class="price">S/ {{ number_format($item->price, 2) }}</td>
                    <td class="price">S/ {{ number_format($item->subtotal, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- TOTALES -->
        <table class="totals">
            <tr>
                <td>Subtotal (sin IGV)</td>
                <td>S/ {{ number_format($order->subtotal, 2) }}</td>
            </tr>
            <tr>
                <td>IGV (18%)</td>
                <td>S/ {{ number_format($order->tax, 2) }}</td>
            </tr>
            <tr class="total">
                <td>TOTAL</td>
                <td>S/ {{ number_format($order->total, 2) }}</td>
            </tr>
        </table>

        <!-- CTA -->
        <div class="cta">
            <a href="{{ url('/tienda') }}">Explorar más productos</a>
        </div>

        <p style="font-size:13px;color:#71717a;text-align:center;line-height:1.6;">
            Si tienes alguna duda, escríbenos a
            <a href="mailto:{{ config('mail.from.address') }}" style="color:#b91c1c;">{{ config('mail.from.address') }}</a>
            o llámanos al <strong>{{ \App\Models\Setting::first()?->phone ?? '' }}</strong>.
        </p>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        <p>
            © {{ date('Y') }} Yira Inversiones. Todos los derechos reservados.<br>
            <a href="{{ url('/') }}">yiraespacios.com</a>
        </p>
    </div>
</div>
</body>
</html>
