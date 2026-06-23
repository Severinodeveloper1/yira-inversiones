@extends('frontend.layouts.app')

@section('title', 'Finalizar Pedido | Yira Inversiones')

@section('content')
<main class="pt-12 pb-24 max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop min-h-screen">
    <!-- Header -->
    <header class="mb-12">
        <h1 class="font-headline-xl text-headline-xl text-on-surface mb-2">Finalizar Pedido</h1>
        <p class="text-secondary font-body-md">Complete los datos de facturación y despacho para generar su comprobante de compra.</p>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12" id="checkout-container">
        <!-- Forms Section -->
        <section class="lg:col-span-7 space-y-8">
            <form id="checkout-form" class="space-y-8">
                @csrf
                <!-- Comprobante Selector -->
                <div class="bg-surface-container-lowest p-8 shadow-sm rounded-lg border border-surface-variant/20">
                    <h2 class="font-headline-lg text-[22px] mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">receipt_long</span>
                        1. Tipo de Comprobante
                    </h2>
                    <div class="grid grid-cols-3 gap-4">
                        <label class="flex flex-col items-center justify-center p-4 border border-outline-variant rounded-md cursor-pointer hover:border-primary hover:bg-surface-container-low transition-all" id="label-boleta">
                            <input type="radio" name="document_type" value="boleta" checked class="sr-only" onchange="toggleDocType('boleta')">
                            <span class="font-bold text-on-surface">Boleta</span>
                            <span class="text-xs text-secondary mt-1">Uso Personal</span>
                        </label>
                        <label class="flex flex-col items-center justify-center p-4 border border-outline-variant rounded-md cursor-pointer hover:border-primary hover:bg-surface-container-low transition-all" id="label-factura">
                            <input type="radio" name="document_type" value="factura" class="sr-only" onchange="toggleDocType('factura')">
                            <span class="font-bold text-on-surface">Factura</span>
                            <span class="text-xs text-secondary mt-1">Con RUC/Empresas</span>
                        </label>
                        <label class="flex flex-col items-center justify-center p-4 border border-outline-variant rounded-md cursor-pointer hover:border-primary hover:bg-surface-container-low transition-all" id="label-ticket">
                            <input type="radio" name="document_type" value="ticket" class="sr-only" onchange="toggleDocType('ticket')">
                            <span class="font-bold text-on-surface">Ticket</span>
                            <span class="text-xs text-secondary mt-1">Control Interno</span>
                        </label>
                    </div>
                </div>

                <!-- Billing Information -->
                <div class="bg-surface-container-lowest p-8 shadow-sm rounded-lg border border-surface-variant/20">
                    <h2 class="font-headline-lg text-[22px] mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">badge</span>
                        2. Datos de Facturación
                    </h2>
                    <div class="space-y-4">
                        <div>
                            <label class="font-label-sm text-label-xs uppercase tracking-wider text-secondary block mb-1" id="billing-name-label">Nombre Completo *</label>
                            <input type="text" name="billing_name" value="{{ $customer?->name }}" required class="w-full px-4 py-3 bg-surface border border-outline/20 focus:border-primary focus:ring-0 outline-none rounded transition-all">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="font-label-sm text-label-xs uppercase tracking-wider text-secondary block mb-1">Tipo de Documento *</label>
                                <select name="doc_type_select" id="doc_type_select" class="w-full px-4 py-3 bg-surface border border-outline/20 focus:border-primary focus:ring-0 outline-none rounded transition-all" onchange="updateDocFieldLabel()">
                                    <option value="DNI" {{ $customer?->document_type == 'DNI' ? 'selected' : '' }}>DNI</option>
                                    <option value="RUC" {{ $customer?->document_type == 'RUC' ? 'selected' : '' }}>RUC</option>
                                    <option value="CE" {{ $customer?->document_type == 'CE' ? 'selected' : '' }}>Carnet de Extranjería</option>
                                    <option value="PASAPORTE" {{ $customer?->document_type == 'PASAPORTE' ? 'selected' : '' }}>Pasaporte</option>
                                </select>
                            </div>
                            <div>
                                <label class="font-label-sm text-label-xs uppercase tracking-wider text-secondary block mb-1" id="doc-number-label">Número de Documento *</label>
                                <input type="text" name="document_number" value="{{ $customer?->document_number }}" required class="w-full px-4 py-3 bg-surface border border-outline/20 focus:border-primary focus:ring-0 outline-none rounded transition-all">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="font-label-sm text-label-xs uppercase tracking-wider text-secondary block mb-1">Teléfono de Contacto *</label>
                                <input type="text" name="phone" value="{{ $customer?->phone }}" required class="w-full px-4 py-3 bg-surface border border-outline/20 focus:border-primary focus:ring-0 outline-none rounded transition-all">
                            </div>
                            <div>
                                <label class="font-label-sm text-label-xs uppercase tracking-wider text-secondary block mb-1">Correo Electrónico *</label>
                                <input type="email" name="email" value="{{ $customer?->email }}" required class="w-full px-4 py-3 bg-surface border border-outline/20 focus:border-primary focus:ring-0 outline-none rounded transition-all">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shipping Method -->
                <div class="bg-surface-container-lowest p-8 shadow-sm rounded-lg border border-surface-variant/20">
                    <h2 class="font-headline-lg text-[22px] mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">local_shipping</span>
                        3. Método de Despacho
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <label class="flex flex-col items-center justify-center p-4 border border-outline-variant rounded-md cursor-pointer hover:border-primary hover:bg-surface-container-low transition-all" id="label-recojo">
                            <input type="radio" name="shipping_method" value="recojo_tienda" checked class="sr-only" onchange="toggleShipping('recojo_tienda')">
                            <span class="material-symbols-outlined text-secondary">storefront</span>
                            <span class="font-bold text-on-surface mt-2 text-sm">Recojo en Tienda</span>
                            <span class="text-[10px] text-secondary mt-1">Sin costo</span>
                        </label>
                        <label class="flex flex-col items-center justify-center p-4 border border-outline-variant rounded-md cursor-pointer hover:border-primary hover:bg-surface-container-low transition-all" id="label-delivery">
                            <input type="radio" name="shipping_method" value="delivery" class="sr-only" onchange="toggleShipping('delivery')">
                            <span class="material-symbols-outlined text-secondary">home_delivery</span>
                            <span class="font-bold text-on-surface mt-2 text-sm">Despacho Delivery</span>
                            <span class="text-[10px] text-secondary mt-1">Costo según distrito</span>
                        </label>
                        <label class="flex flex-col items-center justify-center p-4 border border-outline-variant rounded-md cursor-pointer hover:border-primary hover:bg-surface-container-low transition-all" id="label-agencia">
                            <input type="radio" name="shipping_method" value="envio_agencia" class="sr-only" onchange="toggleShipping('envio_agencia')">
                            <span class="material-symbols-outlined text-secondary">local_post_office</span>
                            <span class="font-bold text-on-surface mt-2 text-sm">Envío por Agencia</span>
                            <span class="text-[10px] text-secondary mt-1">Para Provincias</span>
                        </label>
                    </div>

                    <!-- Shipping Address Container -->
                    <div id="shipping-address-container" class="hidden transition-all duration-300">
                        <label class="font-label-sm text-label-xs uppercase tracking-wider text-secondary block mb-1">Dirección de Envío y Agencia *</label>
                        <textarea name="shipping_address" id="shipping_address" class="w-full px-4 py-3 bg-surface border border-outline/20 focus:border-primary focus:ring-0 outline-none rounded transition-all h-28" placeholder="Ingrese la dirección completa. Para agencias, especifique el nombre de la agencia (ej. Flores, Shalom, Olva Courier) y departamento de destino..."></textarea>
                    </div>
                </div>

                <!-- Submit Button Container -->
                <button type="submit" id="submit-btn" class="w-full bg-primary text-white py-5 rounded font-bold font-body-lg hover:bg-primary-container transition-colors shadow-lg flex items-center justify-center gap-2 uppercase tracking-widest active:scale-[0.98]">
                    <span class="material-symbols-outlined">shopping_cart_checkout</span>
                    Registrar Pedido y Comprobante
                </button>
            </form>
        </section>

        <!-- Summary Section -->
        <aside class="lg:col-span-5">
            <div class="bg-surface-container-lowest p-8 shadow-sm rounded-lg sticky top-28 border border-surface-variant/20 space-y-6">
                <h2 class="font-headline-lg text-[22px]">Resumen del Pedido</h2>
                
                <!-- Items list review -->
                <div id="checkout-items-list" class="max-h-72 overflow-y-auto divide-y divide-surface-variant/40 pr-2 hide-scroll">
                    <!-- Dynamic review items -->
                </div>

                <div class="space-y-4 pt-4 border-t border-surface-variant/50">
                    <div class="flex justify-between font-body-md text-sm">
                        <span class="text-secondary">Subtotal (S/.)</span>
                        <span class="text-on-surface font-semibold" id="checkout-subtotal">S/. 0.00</span>
                    </div>
                    <div class="flex justify-between font-body-md text-sm">
                        <span class="text-secondary">Impuestos (IGV 18% incluido)</span>
                        <span class="text-on-surface font-semibold" id="checkout-tax">S/. 0.00</span>
                    </div>
                </div>

                <div class="pt-6 border-t border-surface-variant">
                    <div class="flex justify-between items-baseline">
                        <span class="font-bold text-lg">Total Compra</span>
                        <span class="font-headline-xl text-3xl text-primary font-bold" id="checkout-total">S/. 0.00</span>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</main>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        validateCart();
        renderCheckoutSummary();
        toggleDocType('boleta'); // Default
        toggleShipping('recojo_tienda'); // Default
    });

    function validateCart() {
        const items = Cart.getItems();
        if (items.length === 0) {
            alert('Su carrito está vacío. Será redirigido al catálogo.');
            window.location.href = '{{ route("tienda") }}';
        }
    }

    function renderCheckoutSummary() {
        const items = Cart.getItems();
        const container = document.getElementById('checkout-items-list');
        let subtotal = 0;
        
        container.innerHTML = '';
        items.forEach(item => {
            const itemSubtotal = item.price * item.quantity;
            subtotal += itemSubtotal;
            
            const html = `
                <div class="py-4 flex gap-4 items-center">
                    <div class="w-16 h-16 bg-surface-container-low overflow-hidden rounded shadow-sm flex-shrink-0">
                        <img src="${item.image}" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="font-bold text-sm truncate text-on-surface">${item.name}</h4>
                        <p class="text-xs text-secondary">Cant: ${item.quantity} | Color: ${item.color}</p>
                    </div>
                    <div class="text-right">
                        <span class="text-sm font-semibold">${item.price > 0 ? 'S/. ' + itemSubtotal.toFixed(2) : 'A cotizar'}</span>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        });

        const subtotalWithoutTax = subtotal / 1.18;
        const tax = subtotal - subtotalWithoutTax;

        document.getElementById('checkout-subtotal').textContent = `S/. ${subtotalWithoutTax.toFixed(2)}`;
        document.getElementById('checkout-tax').textContent = `S/. ${tax.toFixed(2)}`;
        document.getElementById('checkout-total').textContent = `S/. ${subtotal.toFixed(2)}`;
    }

    // Toggle border highlighting for custom radios
    function toggleDocType(type) {
        // Reset classes
        ['boleta', 'factura', 'ticket'].forEach(t => {
            const lbl = document.getElementById('label-' + t);
            if (lbl) {
                lbl.classList.remove('border-primary', 'bg-surface-container-low');
                lbl.classList.add('border-outline-variant');
            }
        });

        // Set active class
        const activeLbl = document.getElementById('label-' + type);
        if (activeLbl) {
            activeLbl.classList.remove('border-outline-variant');
            activeLbl.classList.add('border-primary', 'bg-surface-container-low');
        }

        // Adjust document types dropdown and billing label
        const docSelect = document.getElementById('doc_type_select');
        const docInput = document.querySelector('input[name="document_number"]');
        const nameLabel = document.getElementById('billing-name-label');

        if (type === 'factura') {
            docSelect.value = 'RUC';
            docSelect.disabled = true;
            nameLabel.textContent = 'Razón Social *';
            updateDocFieldLabel();
        } else {
            docSelect.disabled = false;
            nameLabel.textContent = 'Nombre Completo *';
            if (type === 'boleta' && docSelect.value === 'RUC') {
                docSelect.value = 'DNI';
            }
            updateDocFieldLabel();
        }
    }

    function updateDocFieldLabel() {
        const docSelect = document.getElementById('doc_type_select');
        const label = document.getElementById('doc-number-label');
        label.textContent = `Número de Documento (${docSelect.value}) *`;
    }

    function toggleShipping(method) {
        // Reset labels
        ['recojo', 'delivery', 'agencia'].forEach(m => {
            const lbl = document.getElementById('label-' + m);
            if (lbl) {
                lbl.classList.remove('border-primary', 'bg-surface-container-low');
                lbl.classList.add('border-outline-variant');
            }
        });

        // Set active class
        const mapped = method === 'recojo_tienda' ? 'recojo' : (method === 'delivery' ? 'delivery' : 'agencia');
        const activeLbl = document.getElementById('label-' + mapped);
        if (activeLbl) {
            activeLbl.classList.remove('border-outline-variant');
            activeLbl.classList.add('border-primary', 'bg-surface-container-low');
        }

        const addressContainer = document.getElementById('shipping-address-container');
        const addressTextarea = document.getElementById('shipping_address');

        if (method === 'recojo_tienda') {
            addressContainer.classList.add('hidden');
            addressTextarea.removeAttribute('required');
        } else {
            addressContainer.classList.remove('hidden');
            addressTextarea.setAttribute('required', 'required');
            addressTextarea.focus();
        }
    }

    // Form Submission
    document.getElementById('checkout-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const submitBtn = document.getElementById('submit-btn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = `<span class="animate-spin material-symbols-outlined">sync</span> REGISTRANDO PEDIDO...`;

        const formData = new FormData(this);
        
        // Ensure disabled field value (doc_type_select if Factura) is added
        const docSelect = document.getElementById('doc_type_select');
        formData.append('document_type', document.querySelector('input[name="document_type"]:checked').value);
        formData.append('document_type_detail', docSelect.value);

        // Validation for RUC
        const docNumber = formData.get('document_number').trim();
        if (docSelect.value === 'RUC' && docNumber.length !== 11) {
            alert('El RUC debe tener exactamente 11 dígitos.');
            submitBtn.disabled = false;
            submitBtn.innerHTML = `<span class="material-symbols-outlined">shopping_cart_checkout</span> Registrar Pedido y Comprobante`;
            return;
        }

        // Attach cart items
        const cartItems = Cart.getItems();
        cartItems.forEach((item, index) => {
            formData.append(`items[${index}][id]`, item.id);
            formData.append(`items[${index}][quantity]`, item.quantity);
            formData.append(`items[${index}][color]`, item.color);
        });

        fetch('{{ route("checkout.process") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                // Clear cart locally
                Cart.clear();
                alert(data.message);
                window.location.href = data.redirect_url;
            } else {
                alert(data.message || 'Ocurrió un error al procesar la compra.');
                submitBtn.disabled = false;
                submitBtn.innerHTML = `<span class="material-symbols-outlined">shopping_cart_checkout</span> Registrar Pedido y Comprobante`;
            }
        })
        .catch(err => {
            console.error(err);
            alert('Error en el servidor. Intente de nuevo.');
            submitBtn.disabled = false;
            submitBtn.innerHTML = `<span class="material-symbols-outlined">shopping_cart_checkout</span> Registrar Pedido y Comprobante`;
        });
    });
</script>
@endsection
