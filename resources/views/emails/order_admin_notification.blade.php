<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Pedido {{ $order->order_number }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f4f4f5; color: #18181b; }
        .wrapper { max-width: 600px; margin: 32px auto; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
        .header { background: #1c1c1e; padding: 36px 40px; text-align: center; }
        .header h1 { color: #fff; font-size: 22px; font-weight: 700; }
        .header p { color: rgba(255,255,255,0.55); font-size: 13px; margin-top: 4px; }
        .alert-badge { display: inline-block; background: #f59e0b; color: #1c1c1e; font-size: 12px; font-weight: 800; padding: 5px 16px; border-radius: 4px; letter-spacing: 1px; text-transform: uppercase; margin-top: 14px; }
        .body { padding: 36px 40px; }
        .order-header { background: #fef3c7; border: 1px solid #f59e0b; border-radius: 8px; padding: 20px 24px; margin-bottom: 28px; display: flex; justify-content: space-between; align-items: center; }
        .order-header .order-num { font-size: 20px; font-weight: 800; color: #1c1c1e; }
        .order-header .order-date { font-size: 12px; color: #78716c; }
        .status { display: inline-block; background: #fde68a; color: #92400e; font-size: 11px; font-weight: 700; padding: 3px 10px; border-radius: 3px; text-transform: uppercase; }
        .section-title { font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.2px; color: #71717a; margin-bottom: 12px; border-bottom: 1px solid #e4e4e7; padding-bottom: 8px; }
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 24px; }
        .info-box { background: #f9f9f9; border-radius: 6px; padding: 14px 16px; }
        .info-box label { font-size: 10px; font-weight: 700; text-transform: uppercase; color: #a1a1aa; letter-spacing: 0.8px; display: block; margin-bottom: 3px; }
        .info-box p { font-size: 13px; color: #1c1c1e; font-weight: 500; }
        table.items { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table.items th { text-align: left; font-size: 11px; font-weight: 700; color: #71717a; padding: 8px 0; border-bottom: 2px solid #e4e4e7; text-transform: uppercase; letter-spacing: 0.5px; }
        table.items td { padding: 10px 0; border-bottom: 1px solid #f4f4f5; font-size: 13px; vertical-align: top; }
        table.items td.right { text-align: right; font-weight: 600; }
        .totals { width: 100%; margin-bottom: 24px; }
        .totals tr td { padding: 5px 0; font-size: 14px; color: #52525b; }
        .totals tr td:last-child { text-align: right; }
        .totals tr.grand-total td { font-size: 17px; font-weight: 800; color: #1c1c1e; border-top: 2px solid #1c1c1e; padding-top: 10px; }
        .cta { text-align: center; margin: 28px 0; }
        .cta a { display: inline-block; background: #1c1c1e; color: #fff; text-decoration: none; font-weight: 700; font-size: 14px; padding: 14px 32px; border-radius: 8px; }
        .footer { background: #f9f9f9; padding: 20px 40px; text-align: center; border-top: 1px solid #e4e4e7; }
        .footer p { font-size: 12px; color: #a1a1aa; }
        @media (max-width: 480px) {
            .body { padding: 24px 20px; }
            .info-grid { grid-template-columns: 1fr; }
            .order-header { flex-direction: column; gap: 8px; }
        }
    </style>
</head>
<body>
<div class="wrapper">
    <!-- HEADER -->
    <div class="header">
        <h1>YIRA INVERSIONES</h1>
        <p>Panel de Administración — Notificación Interna</p>
        <div class="alert-badge">🛒 Nuevo Pedido Recibido</div>
    </div>

    <!-- BODY -->
    <div class="body">
        <!-- ORDER HEADER -->
        <div class="order-header">
            <div>
                <div class="order-date">Recibido el {{ $order->created_at->format('d/m/Y') }} a las {{ $order->created_at->format('H:i') }}</div>
                <div class="order-num">{{ $order->order_number }}</div>
            </div>
            <span class="status">{{ ucfirst($order->status) }}</span>
        </div>

        <!-- DATOS DEL CLIENTE -->
        <p class="section-title">Datos del Cliente</p>
        <div class="info-grid">
            <div class="info-box">
                <label>Nombre / Razón Social</label>
                <p>{{ $order->billing_name }}</p>
            </div>
            <div class="info-box">
                <label>Correo</label>
                <p><a href="mailto:{{ $order->email }}" style="color:#b91c1c;text-decoration:none;">{{ $order->email }}</a></p>
            </div>
            <div class="info-box">
                <label>Teléfono</label>
                <p><a href="tel:{{ $order->phone }}" style="color:#b91c1c;text-decoration:none;">{{ $order->phone }}</a></p>
            </div>
            <div class="info-box">
                <label>Comprobante</label>
                <p>{{ ucfirst($order->document_type) }} — {{ $order->document_number }}</p>
            </div>
        </div>

        <!-- DESPACHO -->
        <p class="section-title">Entrega</p>
        <div class="info-grid" style="margin-bottom:24px;">
            <div class="info-box">
                <label>Método</label>
                <p>
                    @php
                        $shippingLabels = [
                            'recojo_tienda'  => '📍 Recojo en Tienda',
                            'delivery'       => '🚚 Delivery',
                            'envio_agencia'  => '📦 Envío por Agencia',
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
        <p class="section-title">Productos Pedidos</p>
        <table class="items">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th style="text-align:center;">Cant.</th>
                    <th style="text-align:right;">P. Unit.</th>
                    <th style="text-align:right;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>
                        <strong>{{ $item->product_name }}</strong>
                        @if($item->color)
                        <br><span style="font-size:11px;color:#71717a;">Color: {{ $item->color }}</span>
                        @endif
                    </td>
                    <td class="right" style="text-align:center;">{{ $item->quantity }}</td>
                    <td class="right">S/ {{ number_format($item->price, 2) }}</td>
                    <td class="right">S/ {{ number_format($item->subtotal, 2) }}</td>
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
            <tr class="grand-total">
                <td>TOTAL</td>
                <td>S/ {{ number_format($order->total, 2) }}</td>
            </tr>
        </table>

        <!-- CTA IR AL PANEL -->
        <div class="cta">
            <a href="{{ url('/admin/orders') }}">Ver Pedido en el Panel Administrativo</a>
        </div>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        <p>Este correo es de uso interno. Generado automáticamente por {{ config('app.name') }}.</p>
    </div>
</div>
</body>
</html>
