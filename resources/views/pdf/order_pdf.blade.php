<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprobante {{ $order->order_number }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 13px;
            line-height: 1.5;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .header-container {
            width: 100%;
            margin-bottom: 30px;
        }
        .company-details {
            width: 50%;
            float: left;
        }
        .invoice-details {
            width: 45%;
            float: right;
            border: 2px solid #6c3424;
            padding: 15px;
            text-align: center;
            border-radius: 8px;
            background-color: #fcf9f8;
        }
        .invoice-details h2 {
            margin: 0 0 10px 0;
            font-size: 16px;
            color: #6c3424;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .invoice-details p {
            margin: 4px 0;
            font-size: 14px;
            font-weight: bold;
        }
        .clear {
            clear: both;
        }
        .section-title {
            font-size: 14px;
            color: #6c3424;
            border-bottom: 2px solid #6c3424;
            padding-bottom: 4px;
            margin-bottom: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .info-table {
            width: 100%;
            margin-bottom: 25px;
        }
        .info-table td {
            padding: 4px 0;
            vertical-align: top;
        }
        .info-label {
            font-weight: bold;
            color: #555;
            width: 30%;
        }
        .info-value {
            color: #111;
            width: 70%;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .items-table th {
            background-color: #6c3424;
            color: #ffffff;
            padding: 10px;
            text-align: left;
            font-size: 12px;
            text-transform: uppercase;
        }
        .items-table td {
            padding: 10px;
            border-bottom: 1px solid #e0e0e0;
            font-size: 12px;
        }
        .summary-container {
            width: 40%;
            float: right;
            margin-top: 10px;
        }
        .summary-table {
            width: 100%;
            border-collapse: collapse;
        }
        .summary-table td {
            padding: 6px 8px;
            font-size: 13px;
        }
        .summary-label {
            text-align: right;
            color: #666;
        }
        .summary-value {
            text-align: right;
            font-weight: bold;
            width: 45%;
        }
        .total-row {
            background-color: #fcf9f8;
            border-top: 2px solid #6c3424;
            border-bottom: 2px solid #6c3424;
            font-size: 15px !important;
            color: #6c3424;
        }
        .footer {
            margin-top: 60px;
            text-align: center;
            font-size: 11px;
            color: #777;
            border-top: 1px solid #e0e0e0;
            padding-top: 15px;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .badge-pendiente { background-color: #fef3c7; color: #d97706; }
        .badge-espera_pago { background-color: #dbeafe; color: #2563eb; }
        .badge-aprobado { background-color: #dcfce7; color: #16a34a; }
        .badge-embalado { background-color: #f3f4f6; color: #374151; }
        .badge-entregado { background-color: #d1fae5; color: #065f46; }
        .badge-anulado { background-color: #fee2e2; color: #dc2626; }
    </style>
</head>
<body>

    <div class="header-container">
        <!-- Logo and Company Details -->
        <div class="company-details">
            <h1 style="color: #6c3424; margin: 0 0 8px 0; font-size: 24px; font-weight: bold;">YIRA INVERSIONES</h1>
            <p style="margin: 2px 0; color: #555;"><strong>RUC:</strong> 20605389651</p> <!-- Example RUC of the company -->
            <p style="margin: 2px 0; color: #555;">Arquitectura, Diseño y Mobiliario de Alta Calidad</p>
            <p style="margin: 2px 0; color: #555;">Lima, Perú</p>
        </div>

        <!-- Receipt Box Header -->
        <div class="invoice-details">
            <h2>
                @if($order->document_type == 'boleta')
                    Boleta de Venta
                @elseif($order->document_type == 'factura')
                    Factura
                @else
                    Ticket de Control
                @endif
            </h2>
            <p style="font-size: 16px; color: #333; margin: 5px 0;">Nro: {{ $order->order_number }}</p>
            <div style="margin-top: 8px;">
                <span class="badge badge-{{ $order->status }}">
                    @if($order->status == 'pendiente') Pendiente @elseif($order->status == 'espera_pago') Espera de Pago @elseif($order->status == 'aprobado') Aprobado @elseif($order->status == 'embalado') Embalado @elseif($order->status == 'entregado') Entregado @elseif($order->status == 'anulado') Anulado @else {{ ucfirst($order->status) }} @endif
                </span>
            </div>
        </div>
        <div class="clear"></div>
    </div>

    <!-- Customer Information -->
    <div class="section-title">Datos de Facturación</div>
    <table class="info-table">
        <tr>
            <td class="info-label">Señor(es) / Empresa:</td>
            <td class="info-value"><strong>{{ $order->billing_name }}</strong></td>
        </tr>
        <tr>
            <td class="info-label">Documento:</td>
            <td class="info-value">{{ strtoupper($order->document_number) }}</td>
        </tr>
        <tr>
            <td class="info-label">Correo Electrónico:</td>
            <td class="info-value">{{ $order->email }}</td>
        </tr>
        <tr>
            <td class="info-label">Teléfono / Celular:</td>
            <td class="info-value">{{ $order->phone }}</td>
        </tr>
        <tr>
            <td class="info-label">Fecha de Emisión:</td>
            <td class="info-value">{{ $order->created_at->format('d/m/Y H:i') }}</td>
        </tr>
    </table>

    <!-- Shipping Information -->
    <div class="section-title">Detalles de Despacho</div>
    <table class="info-table">
        <tr>
            <td class="info-label">Método de Envío:</td>
            <td class="info-value">
                @if($order->shipping_method == 'recojo_tienda')
                    Recojo en Showroom / Tienda (Sin costo)
                @elseif($order->shipping_method == 'delivery')
                    Despacho a Domicilio (Delivery)
                @elseif($order->shipping_method == 'envio_agencia')
                    Envío por Agencia de Transportes (Provincia)
                @else
                    {{ ucfirst($order->shipping_method) }}
                @endif
            </td>
        </tr>
        @if($order->shipping_method != 'recojo_tienda')
            <tr>
                <td class="info-label">Dirección de Destino:</td>
                <td class="info-value">{{ $order->shipping_address }}</td>
            </tr>
        @endif
    </table>

    <!-- Items list -->
    <div class="section-title">Detalle de Artículos</div>
    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 50%;">Descripción del Producto</th>
                <th style="width: 15%; text-align: center;">Color</th>
                <th style="width: 10%; text-align: center;">Cant.</th>
                <th style="width: 12%; text-align: right;">P. Unitario</th>
                <th style="width: 13%; text-align: right;">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td style="text-align: center; color: #555;">{{ $item->color }}</td>
                    <td style="text-align: center;">{{ $item->quantity }}</td>
                    <td style="text-align: right;">S/. {{ number_format($item->price, 2) }}</td>
                    <td style="text-align: right; font-weight: bold;">S/. {{ number_format($item->subtotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Summary Box -->
    <div class="summary-container">
        <table class="summary-table">
            <tr>
                <td class="summary-label">Subtotal:</td>
                <td class="summary-value">S/. {{ number_format($order->subtotal, 2) }}</td>
            </tr>
            <tr>
                <td class="summary-label">IGV (18%):</td>
                <td class="summary-value">S/. {{ number_format($order->tax, 2) }}</td>
            </tr>
            <tr class="total-row">
                <td class="summary-label" style="font-weight: bold; color: #6c3424; padding: 10px 8px;">TOTAL:</td>
                <td class="summary-value" style="font-size: 15px; padding: 10px 8px;">S/. {{ number_format($order->total, 2) }}</td>
            </tr>
        </table>
    </div>
    <div class="clear"></div>

    <!-- Footer -->
    <div class="footer">
        <p>Gracias por su preferencia en Yira Inversiones.</p>
        <p style="margin-top: 5px; font-size: 10px; color: #999;">Este documento es una copia de control interno de su pedido y despacho. No posee validez fiscal ante SUNAT.</p>
    </div>

</body>
</html>
