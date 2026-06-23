@extends('frontend.layouts.app')

@section('title', 'Su Carrito | Yira Inversiones')

@section('content')
<main class="pt-12 pb-24 max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop min-h-screen">
    <!-- Header -->
    <header class="mb-12">
        <h1 class="font-headline-xl text-headline-xl text-on-surface mb-2">Su Carrito</h1>
        <p class="text-secondary font-body-md">Gestione su selección de mobiliario premium antes de finalizar su cotización o pedido.</p>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12" id="cart-content-wrapper">
        <!-- Product List Section -->
        <section class="lg:col-span-8">
            <div class="hidden md:grid grid-cols-12 border-b border-surface-variant pb-4 mb-8 text-secondary font-label-sm uppercase tracking-widest">
                <div class="col-span-6">Producto</div>
                <div class="col-span-2 text-center">Cantidad</div>
                <div class="col-span-2 text-right">Precio</div>
                <div class="col-span-2 text-right">Total</div>
            </div>

            <div id="cart-items-list" class="space-y-6">
                <!-- Dynamic Items Rendered by JS -->
            </div>

            <!-- Continue Shopping -->
            <div class="mt-8">
                <a class="inline-flex items-center text-secondary font-body-md hover:text-primary transition-colors" href="{{ route('tienda') }}">
                    <span class="material-symbols-outlined mr-2">arrow_back</span>
                    Continuar Comprando
                </a>
            </div>
        </section>

        <!-- Summary Section -->
        <aside class="lg:col-span-4" id="cart-summary-section">
            <div class="bg-surface-container-lowest p-8 shadow-sm rounded-lg sticky top-28 border border-surface-variant/20">
                <h2 class="font-headline-lg text-headline-lg mb-8">Resumen de Pedido</h2>
                <div class="space-y-4 mb-8">
                    <div class="flex justify-between font-body-md">
                        <span class="text-secondary">Subtotal (S/.)</span>
                        <span class="text-on-surface font-semibold" id="cart-subtotal">S/. 0.00</span>
                    </div>
                    <div class="flex justify-between font-body-md">
                        <span class="text-secondary">Impuestos (IGV 18%)</span>
                        <span class="text-on-surface font-semibold" id="cart-tax">S/. 0.00</span>
                    </div>
                </div>
                <div class="pt-6 border-t border-surface-variant mb-8">
                    <div class="flex justify-between items-baseline">
                        <span class="font-headline-lg text-[20px] font-bold">Total</span>
                        <span class="font-headline-xl text-[32px] text-on-surface" id="cart-total">S/. 0.00</span>
                    </div>
                    <p class="text-label-sm text-secondary text-right mt-1 italic">Envío e instalación a cotizar</p>
                </div>
                <div class="flex flex-col gap-3">
                    <a href="{{ route('checkout') }}" class="w-full bg-primary text-white py-5 rounded font-bold font-body-lg hover:bg-primary-container transition-colors shadow-lg flex items-center justify-center gap-2 uppercase tracking-widest text-center cursor-pointer">
                        <span class="material-symbols-outlined">shopping_cart_checkout</span>
                        Procesar Pedido
                    </a>
                    <button onclick="sendWhatsAppCheckout()" class="w-full bg-[#25D366] text-white py-4 rounded font-bold font-body-md hover:bg-[#128C7E] transition-colors shadow-md flex items-center justify-center gap-2 uppercase tracking-widest">
                        <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">chat</span>
                        Pedir por WhatsApp
                    </button>
                    <button onclick="openQuoteModalFromCart()" class="w-full bg-secondary text-white py-4 rounded font-bold font-body-md hover:bg-secondary/90 transition-colors shadow-md flex items-center justify-center gap-2 uppercase tracking-widest">
                        <span class="material-symbols-outlined text-[20px]">description</span>
                        Solicitar Cotización
                    </button>
                </div>
                <div class="flex flex-col gap-4 mt-8 pt-8 border-t border-surface-variant/30">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary">verified_user</span>
                        <span class="text-label-sm text-secondary">Atención y Fabricación Personalizada</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary">local_shipping</span>
                        <span class="text-label-sm text-secondary">Envíos a todo el Perú</span>
                    </div>
                </div>
            </div>
        </aside>
    </div>

    <!-- Empty State -->
    <div id="cart-empty-state" class="hidden text-center py-20 bg-surface-container-low rounded-lg border border-outline/10 max-w-xl mx-auto">
        <span class="material-symbols-outlined text-6xl text-secondary mb-6">shopping_cart_off</span>
        <h2 class="font-headline-lg text-headline-lg text-on-surface mb-2">Su carrito está vacío</h2>
        <p class="text-secondary mb-8">Agregue productos premium de nuestro catálogo para iniciar una cotización.</p>
        <a href="{{ route('tienda') }}" class="inline-block bg-primary text-white px-8 py-4 font-bold rounded uppercase tracking-widest hover:bg-primary-container transition-all">
            Explorar Tienda
        </a>
    </div>

    <!-- Recommended Section -->
    @if(isset($recommendedProducts) && $recommendedProducts->count() > 0)
        <section class="mt-32">
            <div class="flex justify-between items-end mb-10">
                <div>
                    <span class="text-primary font-label-sm uppercase tracking-[0.2em] block mb-2">Completar el espacio</span>
                    <h2 class="font-headline-lg text-headline-lg">Recomendado para usted</h2>
                </div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-gutter">
                @foreach($recommendedProducts as $recommended)
                    @php
                        $recImage = $recommended->hasMedia('products') 
                            ? $recommended->getFirstMediaUrl('products') 
                            : 'https://placehold.co/400x500';
                    @endphp
                    <div class="group cursor-pointer" onclick="window.location.href='{{ route('product.detail', $recommended->slug) }}'">
                        <div class="aspect-[4/5] bg-surface-container-low overflow-hidden rounded-sm relative mb-4 shadow-sm">
                            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105" style="background-image: url('{{ $recImage }}')"></div>
                        </div>
                        <h4 class="font-headline-lg text-[18px] mb-1 group-hover:underline">{{ $recommended->name }}</h4>
                        <p class="text-secondary font-label-sm mb-2 uppercase">{{ $recommended->category->name }}</p>
                        <p class="font-bold text-on-surface">
                            @if($recommended->price)
                                S/. {{ number_format($recommended->price, 2) }}
                            @else
                                Consultar Precio
                            @endif
                        </p>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
</main>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        renderCart();
        
        // Listen to cart-updated event to re-render
        window.addEventListener('cart-updated', renderCart);
    });

    function renderCart() {
        const items = Cart.getItems();
        const listContainer = document.getElementById('cart-items-list');
        const contentWrapper = document.getElementById('cart-content-wrapper');
        const emptyState = document.getElementById('cart-empty-state');
        
        if (items.length === 0) {
            contentWrapper.classList.add('hidden');
            emptyState.classList.remove('hidden');
            return;
        } else {
            contentWrapper.classList.remove('hidden');
            emptyState.classList.add('hidden');
        }
        
        listContainer.innerHTML = '';
        let subtotal = 0;
        let hasCustomPrice = false;
        
        items.forEach(item => {
            const itemSubtotal = item.price * item.quantity;
            subtotal += itemSubtotal;
            if (item.price <= 0) {
                hasCustomPrice = true;
            }
            
            const itemHtml = `
                <div class="cart-item grid grid-cols-1 md:grid-cols-12 gap-6 items-center border-b border-surface-variant/50 py-8 group transition-colors hover:bg-surface-container-low/30 px-2">
                    <div class="col-span-6 flex gap-6 items-center">
                        <div class="w-24 h-24 md:w-32 md:h-32 flex-shrink-0 bg-surface-container-low overflow-hidden rounded shadow-sm">
                            <img alt="${item.name}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="${item.image}"/>
                        </div>
                        <div>
                            <h3 class="font-headline-lg text-[18px] md:text-[20px] font-semibold text-on-surface mb-1">${item.name}</h3>
                            <p class="text-secondary font-body-md mb-2">Acabado/Color: <span class="text-on-surface-variant font-medium">${item.color}</span></p>
                            <button onclick="removeItem('${item.id}', '${item.color}')" class="flex items-center text-error font-label-sm hover:underline transition-all">
                                <span class="material-symbols-outlined text-[16px] mr-1">delete</span>
                                ELIMINAR
                            </button>
                        </div>
                    </div>
                    <div class="col-span-2 flex justify-center items-center">
                        <div class="flex items-center border border-outline/30 rounded px-1">
                            <button onclick="updateQty('${item.id}', '${item.color}', ${item.quantity - 1})" class="w-8 h-10 flex items-center justify-center hover:text-primary transition-colors"><span class="material-symbols-outlined">remove</span></button>
                            <span class="w-8 text-center font-semibold">${item.quantity}</span>
                            <button onclick="updateQty('${item.id}', '${item.color}', ${item.quantity + 1})" class="w-8 h-10 flex items-center justify-center hover:text-primary transition-colors"><span class="material-symbols-outlined">add</span></button>
                        </div>
                    </div>
                    <div class="col-span-2 text-right">
                        <span class="font-body-md text-secondary">${item.price > 0 ? 'S/. ' + parseFloat(item.price).toFixed(2) : 'A cotizar'}</span>
                    </div>
                    <div class="col-span-2 text-right">
                        <span class="font-headline-lg text-[18px] md:text-[20px] font-bold text-on-surface">${item.price > 0 ? 'S/. ' + itemSubtotal.toFixed(2) : 'A cotizar'}</span>
                    </div>
                </div>
            `;
            listContainer.insertAdjacentHTML('beforeend', itemHtml);
        });
        
        // Calculate tax and totals (assuming IGV is 18% included or added, here we show subtotal and tax calculation)
        const subtotalWithoutTax = subtotal / 1.18;
        const tax = subtotal - subtotalWithoutTax;
        
        document.getElementById('cart-subtotal').textContent = hasCustomPrice && subtotal === 0 ? 'A cotizar' : `S/. ${subtotalWithoutTax.toFixed(2)}`;
        document.getElementById('cart-tax').textContent = hasCustomPrice && subtotal === 0 ? 'A cotizar' : `S/. ${tax.toFixed(2)}`;
        document.getElementById('cart-total').textContent = hasCustomPrice && subtotal === 0 ? 'A cotizar' : `S/. ${subtotal.toFixed(2)}`;
    }

    function removeItem(id, color) {
        Cart.removeItem(parseInt(id), color);
        renderCart();
    }

    function updateQty(id, color, newQty) {
        Cart.updateQuantity(parseInt(id), color, newQty);
        renderCart();
    }

    // WhatsApp Checkout Flow
    function sendWhatsAppCheckout() {
        const items = Cart.getItems();
        if (items.length === 0) return;
        
        let text = "Hola {{ addslashes($company->name) }}, deseo solicitar la cotización de los siguientes productos de mi carrito:\n\n";
        let total = 0;
        let hasConsult = false;
        
        items.forEach((item, index) => {
            const priceText = item.price > 0 ? `(Subtotal: S/. ${(item.price * item.quantity).toFixed(2)})` : '(A cotizar)';
            text += `${index + 1}. ${item.quantity}x ${item.name} - Color: ${item.color} ${priceText}\n`;
            if (item.price > 0) {
                total += item.price * item.quantity;
            } else {
                hasConsult = true;
            }
        });
        
        if (total > 0) {
            text += `\nTotal Estimado: S/. ${total.toFixed(2)}`;
            if (hasConsult) {
                text += " + items a cotizar";
            }
        } else {
            text += "\nTotal: A cotizar";
        }
        
        const whatsappUrl = `https://wa.me/{{ $company->whatsapp_phone ?? '51987654321' }}?text=${encodeURIComponent(text)}`;
        window.open(whatsappUrl, '_blank');
    }

    // Quote Modal from Cart
    function openQuoteModalFromCart() {
        const items = Cart.getItems();
        if (items.length === 0) return;
        
        let text = "Hola {{ addslashes($company->name) }}, deseo solicitar la cotización de los siguientes productos:\n";
        items.forEach((item) => {
            text += `- ${item.quantity}x ${item.name} (Color: ${item.color})\n`;
        });
        
        openQuoteModal(text);
    }
</script>
@endsection
