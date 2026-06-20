<!DOCTYPE html>
<html class="light" lang="es">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Yira Inversiones | Arquitectura y Confort')</title>
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN matching the design spec -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface": "#FCF9F8",
                        "surface-dim": "#ddd9d8",
                        "surface-bright": "#fdf8f8",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#f7f2f2",
                        "surface-container": "#F0EDED",
                        "surface-container-high": "#ece7e7",
                        "surface-container-highest": "#e6e1e1",
                        "on-surface": "#1c1b1b",
                        "on-surface-variant": "#53433f",
                        "inverse-surface": "#313030",
                        "inverse-on-surface": "#f4f0ef",
                        "outline": "#86736e",
                        "outline-variant": "#d8c2bc",
                        "surface-tint": "#8c4d3b",
                        "primary": "#6c3424",
                        "on-primary": "#ffffff",
                        "primary-container": "#894b39",
                        "on-primary-container": "#ffc8b9",
                        "inverse-primary": "#ffb5a0",
                        "secondary": "#705a4c",
                        "on-secondary": "#ffffff",
                        "secondary-container": "#f8dac8",
                        "on-secondary-container": "#745e50",
                        "tertiary": "#47453e",
                        "on-tertiary": "#ffffff",
                        "tertiary-container": "#5f5c55",
                        "on-tertiary-container": "#dad5cc",
                        "error": "#ba1a1a",
                        "on-error": "#ffffff",
                        "error-container": "#ffdad6",
                        "on-error-container": "#93000a",
                        "primary-fixed": "#ffdbd1",
                        "primary-fixed-dim": "#ffb5a0",
                        "on-primary-fixed": "#380d02",
                        "on-primary-fixed-variant": "#6f3726",
                        "secondary-fixed": "#fbddcb",
                        "secondary-fixed-dim": "#dec1b0",
                        "on-secondary-fixed": "#27180d",
                        "on-secondary-fixed-variant": "#574336",
                        "tertiary-fixed": "#e7e2d9",
                        "tertiary-fixed-dim": "#cbc6bd",
                        "on-tertiary-fixed": "#1d1b16",
                        "on-tertiary-fixed-variant": "#494740",
                        "background": "#fdf8f8",
                        "on-background": "#1c1b1b",
                        "surface-variant": "#e6e1e1",
                        "accent-terracotta": "#A6634F",
                        "outline-muted": "#D8C2BC"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.5rem",
                        "sm": "0.25rem",
                        "md": "0.75rem",
                        "lg": "1rem",
                        "xl": "1.5rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "margin-mobile": "20px",
                        "unit": "8px",
                        "gutter": "24px",
                        "container-max": "1280px",
                        "margin-desktop": "64px"
                    },
                    "fontFamily": {
                        "headline-xl": ["Manrope"],
                        "body-md": ["Manrope"],
                        "label-sm": ["Manrope"],
                        "body-lg": ["Manrope"],
                        "headline-lg-mobile": ["Manrope"],
                        "headline-lg": ["Manrope"]
                    },
                    "fontSize": {
                        "headline-xl": ["48px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "500"}],
                        "body-md": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "label-sm": ["14px", {"lineHeight": "1", "letterSpacing": "0.1em", "fontWeight": "600"}],
                        "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "headline-lg-mobile": ["32px", {"lineHeight": "1.2", "letterSpacing": "-0.01em", "fontWeight": "500"}],
                        "headline-lg": ["32px", {"lineHeight": "1.3", "fontWeight": "500"}]
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .hide-scroll::-webkit-scrollbar { display: none; }
        .hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }

        .slider-container { transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1); }

        .grain-texture::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: url("https://www.transparenttextures.com/patterns/natural-paper.png");
            opacity: 0.03;
            pointer-events: none;
            z-index: 0;
        }
    </style>
    @yield('styles')
</head>
<body class="bg-surface text-on-surface font-body-md overflow-x-hidden">

<!-- TopNavBar -->
<nav class="fixed top-0 w-full z-50 bg-surface/80 backdrop-blur-md shadow-sm border-b border-outline/10">
    <div class="flex justify-between items-center h-20 px-margin-desktop max-w-container-max mx-auto">
        <div class="flex items-center gap-12">
            <a class="cursor-pointer active:scale-95 duration-200" href="{{ route('home') }}">
                @if($company->logo_path)
                    <img src="{{ asset('storage/' . $company->logo_path) }}" alt="{{ $company->name }}" class="h-10 object-contain">
                @else
                    <span class="font-headline-lg text-primary font-bold tracking-tight">{{ $company->name }}</span>
                @endif
            </a>
            <div class="hidden md:flex gap-4 items-center">
                <a class="font-body-md text-body-md px-3 py-1 transition-colors cursor-pointer active:scale-95 duration-200 {{ Route::is('home') ? 'text-primary border-b-2 border-primary' : 'text-secondary hover:text-primary' }}" href="{{ route('home') }}">Inicio</a>
                {{-- <a class="font-body-md text-body-md px-3 py-1 transition-colors cursor-pointer active:scale-95 duration-200 {{ Request::get('type') === 'hogar' ? 'text-primary border-b-2 border-primary' : 'text-secondary hover:text-primary' }}" href="{{ route('tienda', ['type' => 'hogar']) }}">Hogar</a>
                <a class="font-body-md text-body-md px-3 py-1 transition-colors cursor-pointer active:scale-95 duration-200 {{ Request::get('type') === 'oficina' ? 'text-primary border-b-2 border-primary' : 'text-secondary hover:text-primary' }}" href="{{ route('tienda', ['type' => 'oficina']) }}">Oficina</a> --}}
                <a class="font-body-md text-body-md px-3 py-1 transition-colors cursor-pointer active:scale-95 duration-200 {{ Route::is('tienda') && !Request::has('type') ? 'text-primary border-b-2 border-primary' : 'text-secondary hover:text-primary' }}" href="{{ route('tienda') }}">Tienda</a>
                <a class="font-body-md text-body-md px-3 py-1 transition-colors cursor-pointer active:scale-95 duration-200 {{ Route::is('nosotros') ? 'text-primary border-b-2 border-primary' : 'text-secondary hover:text-primary' }}" href="{{ route('nosotros') }}">Nosotros</a>
                <a class="font-body-md text-body-md px-3 py-1 transition-colors cursor-pointer active:scale-95 duration-200 {{ Route::is('blog*') ? 'text-primary border-b-2 border-primary' : 'text-secondary hover:text-primary' }}" href="{{ route('blog') }}">Blog</a>
                <a class="font-body-md text-body-md px-3 py-1 transition-colors cursor-pointer active:scale-95 duration-200 {{ Route::is('contact') ? 'text-primary border-b-2 border-primary' : 'text-secondary hover:text-primary' }}" href="{{ route('contact') }}">Contacto</a>
            </div>
        </div>
        <div class="flex items-center gap-6">
            <a href="{{ route('tienda') }}" class="material-symbols-outlined text-secondary hover:text-primary transition-colors cursor-pointer active:scale-95 duration-200">search</a>
            <a href="/admin" class="material-symbols-outlined text-secondary hover:text-primary transition-colors cursor-pointer active:scale-95 duration-200">person</a>
            <a href="{{ route('cart') }}" class="material-symbols-outlined text-secondary hover:text-primary transition-colors cursor-pointer active:scale-95 duration-200 relative">
                shopping_cart
                <span id="cart-badge" class="absolute -top-2 -right-2 bg-primary text-white text-[10px] rounded-full w-4 h-4 flex items-center justify-center font-bold hidden">0</span>
            </a>
        </div>
    </div>
</nav>

<main class="pt-20 min-h-screen">
    @yield('content')
</main>

<!-- Footer -->
<footer class="bg-surface-container py-16 border-t border-outline/10">
    <div class="flex flex-col md:flex-row justify-between items-start px-margin-desktop max-w-container-max mx-auto gap-gutter">
        <div class="flex-1">
            <h4 class="font-headline-lg text-headline-lg text-on-surface mb-6">{{ $company->name }}</h4>
            <p class="text-secondary max-w-xs mb-8">Arquitectura y Confort para espacios que inspiran grandeza. Calidad artesanal con visión moderna.</p>
            <div class="flex gap-4">
                @if($company->facebook_url)
                    <a class="w-10 h-10 flex items-center justify-center rounded-full bg-surface-container-highest text-secondary hover:text-primary transition-all" href="{{ $company->facebook_url }}" target="_blank" title="Facebook">
                        <span class="material-symbols-outlined text-xl">link</span>
                    </a>
                @endif
                @if($company->instagram_url)
                    <a class="w-10 h-10 flex items-center justify-center rounded-full bg-surface-container-highest text-secondary hover:text-primary transition-all" href="{{ $company->instagram_url }}" target="_blank" title="Instagram">
                        <span class="material-symbols-outlined text-xl">photo_camera</span>
                    </a>
                @endif
                @if($company->tiktok_url)
                    <a class="w-10 h-10 flex items-center justify-center rounded-full bg-surface-container-highest text-secondary hover:text-primary transition-all" href="{{ $company->tiktok_url }}" target="_blank" title="TikTok">
                        <span class="material-symbols-outlined text-xl">music_note</span>
                    </a>
                @endif
                @if($company->youtube_url)
                    <a class="w-10 h-10 flex items-center justify-center rounded-full bg-surface-container-highest text-secondary hover:text-primary transition-all" href="{{ $company->youtube_url }}" target="_blank" title="YouTube">
                        <span class="material-symbols-outlined text-xl">play_circle</span>
                    </a>
                @endif
            </div>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-12 flex-[2]">
            <div>
                <h5 class="font-label-sm text-label-sm text-on-surface uppercase mb-6 tracking-widest">Catálogo</h5>
                <ul class="space-y-4">
                    <li><a class="text-secondary hover:text-primary underline transition-all font-body-md text-body-md" href="{{ route('tienda', ['type' => 'oficina']) }}">Mobiliario Oficina</a></li>
                    <li><a class="text-secondary hover:text-primary underline transition-all font-body-md text-body-md" href="{{ route('tienda', ['type' => 'hogar']) }}">Sofás &amp; Estar</a></li>
                    <li><a class="text-secondary hover:text-primary underline transition-all font-body-md text-body-md" href="{{ route('tienda') }}">Todo el Catálogo</a></li>
                </ul>
            </div>
            <div>
                <h5 class="font-label-sm text-label-sm text-on-surface uppercase mb-6 tracking-widest">Accesos Rápidos</h5>
                <ul class="space-y-4">
                    <li><a class="text-secondary hover:text-primary underline transition-all font-body-md text-body-md" href="{{ route('home') }}">Inicio</a></li>
                    <li><a class="text-secondary hover:text-primary underline transition-all font-body-md text-body-md" href="{{ route('nosotros') }}">Sobre Nosotros</a></li>
                    <li><a class="text-secondary hover:text-primary underline transition-all font-body-md text-body-md" href="{{ route('policies') }}">Políticas de Garantía y Envíos</a></li>
                    <li><a class="text-secondary hover:text-primary underline transition-all font-body-md text-body-md" href="#" onclick="openQuoteModal()">Solicitar Cotización</a></li>
                </ul>
            </div>
            <div>
                <h5 class="font-label-sm text-label-sm text-on-surface uppercase mb-6 tracking-widest">Contacto</h5>
                <ul class="space-y-4 text-secondary font-body-md">
                    @if($company->address)
                        <li><span class="block text-on-surface font-semibold">Taller y Showroom:</span> {{ $company->address }}</li>
                    @endif
                    @if($company->phone)
                        <li><span class="block text-on-surface font-semibold">WhatsApp / Teléfono:</span> {{ $company->phone }}</li>
                    @endif
                    @if($company->email)
                        <li><span class="block text-on-surface font-semibold">Email:</span> {{ $company->email }}</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <div class="max-w-container-max mx-auto px-margin-desktop mt-16 pt-8 border-t border-outline/10 flex flex-col md:flex-row justify-between items-center gap-4">
        <p class="text-secondary font-body-md text-body-md text-center md:text-left">© {{ date('Y') }} {{ $company->name }}. Todos los derechos reservados.</p>
        <div class="flex gap-4">
            <a href="{{ route('policies') }}" class="text-xs text-secondary hover:text-primary underline">Políticas</a>
            <a href="#" onclick="openClaimModal()" class="text-xs text-secondary hover:text-primary underline font-bold flex items-center gap-1">
                <span class="material-symbols-outlined text-xs">edit_document</span>
                Libro de Reclamaciones
            </a>
        </div>
    </div>
</footer>

<!-- Modal de Cotización (Emergente) -->
<div id="quote-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden backdrop-blur-sm">
    <div class="bg-white w-full max-w-lg p-8 rounded-lg shadow-xl border border-outline/10 relative mx-4">
        <button onclick="closeQuoteModal()" class="absolute top-4 right-4 text-secondary hover:text-primary transition-all">
            <span class="material-symbols-outlined text-2xl">close</span>
        </button>
        <span class="font-label-sm text-label-sm text-primary uppercase tracking-widest mb-2 block">Cotización</span>
        <h3 class="font-headline-lg text-headline-lg text-on-surface mb-6">Solicitud de Cotización</h3>
        <form id="quote-form" class="space-y-4">
            @csrf
            <div>
                <label class="font-label-sm text-label-xs uppercase tracking-wider text-secondary block mb-1">Nombre Completo *</label>
                <input name="name" required class="w-full px-4 py-2 bg-surface border border-outline/20 focus:border-primary focus:ring-0 outline-none rounded transition-all" placeholder="Tu nombre" type="text">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="font-label-sm text-label-xs uppercase tracking-wider text-secondary block mb-1">Correo Electrónico *</label>
                    <input name="email" required class="w-full px-4 py-2 bg-surface border border-outline/20 focus:border-primary focus:ring-0 outline-none rounded transition-all" placeholder="correo@ejemplo.com" type="email">
                </div>
                <div>
                    <label class="font-label-sm text-label-xs uppercase tracking-wider text-secondary block mb-1">Teléfono / WhatsApp *</label>
                    <input name="phone" required class="w-full px-4 py-2 bg-surface border border-outline/20 focus:border-primary focus:ring-0 outline-none rounded transition-all" placeholder="+51 999 999 999" type="text">
                </div>
            </div>
            <div>
                <label class="font-label-sm text-label-xs uppercase tracking-wider text-secondary block mb-1">Proyecto (Opcional)</label>
                <input name="project" class="w-full px-4 py-2 bg-surface border border-outline/20 focus:border-primary focus:ring-0 outline-none rounded transition-all" placeholder="Ej: Amoblado de Sala, Oficina Corporativa" type="text">
            </div>
            <div>
                <label class="font-label-sm text-label-xs uppercase tracking-wider text-secondary block mb-1">Mensaje o Detalles del Pedido *</label>
                <textarea name="message" required class="w-full px-4 py-2 bg-surface border border-outline/20 focus:border-primary focus:ring-0 outline-none rounded transition-all h-24" placeholder="Detalle los productos o requerimientos de su cotización..."></textarea>
            </div>
            <button type="submit" class="w-full py-3 bg-primary text-white font-bold rounded uppercase tracking-widest hover:bg-primary-container transition-all active:scale-[0.98]">Enviar Solicitud</button>
        </form>
    </div>
</div>

<!-- Modal de Libro de Reclamaciones (Normativo) -->
<div id="claim-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden backdrop-blur-sm">
    <div class="bg-white w-full max-w-2xl p-8 rounded-lg shadow-xl border border-outline/10 relative mx-4 max-h-[90vh] overflow-y-auto">
        <button onclick="closeClaimModal()" class="absolute top-4 right-4 text-secondary hover:text-primary transition-all">
            <span class="material-symbols-outlined text-2xl">close</span>
        </button>
        <span class="font-label-sm text-label-sm text-primary uppercase tracking-widest mb-2 block">Libro de Reclamaciones</span>
        <h3 class="font-headline-lg text-headline-lg text-on-surface mb-6">Hoja de Reclamación Digital</h3>
        <form id="claim-form" class="space-y-4">
            @csrf
            <div>
                <label class="font-label-sm text-label-xs uppercase tracking-wider text-secondary block mb-1">Nombre Completo *</label>
                <input name="fullname" required class="w-full px-4 py-2 bg-surface border border-outline/20 focus:border-primary focus:ring-0 outline-none rounded transition-all" placeholder="Nombre completo" type="text">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="font-label-sm text-label-xs uppercase tracking-wider text-secondary block mb-1">Tipo de Documento *</label>
                    <select name="document_type" required class="w-full px-4 py-2 bg-surface border border-outline/20 focus:border-primary focus:ring-0 outline-none rounded transition-all">
                        <option value="DNI">DNI (Documento Nacional de Identidad)</option>
                        <option value="RUC">RUC</option>
                        <option value="CE">Carnet de Extranjería</option>
                        <option value="Pasaporte">Pasaporte</option>
                    </select>
                </div>
                <div>
                    <label class="font-label-sm text-label-xs uppercase tracking-wider text-secondary block mb-1">Número de Documento *</label>
                    <input name="document_number" required class="w-full px-4 py-2 bg-surface border border-outline/20 focus:border-primary focus:ring-0 outline-none rounded transition-all" placeholder="12345678" type="text">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="font-label-sm text-label-xs uppercase tracking-wider text-secondary block mb-1">Correo Electrónico *</label>
                    <input name="email" required class="w-full px-4 py-2 bg-surface border border-outline/20 focus:border-primary focus:ring-0 outline-none rounded transition-all" placeholder="correo@ejemplo.com" type="email">
                </div>
                <div>
                    <label class="font-label-sm text-label-xs uppercase tracking-wider text-secondary block mb-1">Teléfono / Celular *</label>
                    <input name="phone" required class="w-full px-4 py-2 bg-surface border border-outline/20 focus:border-primary focus:ring-0 outline-none rounded transition-all" placeholder="999888777" type="text">
                </div>
            </div>
            <div>
                <label class="font-label-sm text-label-xs uppercase tracking-wider text-secondary block mb-1">Tipo de Reclamación *</label>
                <div class="flex gap-6 mt-1">
                    <label class="flex items-center gap-2 text-secondary">
                        <input type="radio" name="type" value="reclamo" checked class="text-primary focus:ring-0"> Reclamo (Disconformidad relacionada a los bienes o servicios)
                    </label>
                    <label class="flex items-center gap-2 text-secondary">
                        <input type="radio" name="type" value="queja" class="text-primary focus:ring-0"> Queja (Disconformidad no relacionada a bienes, ej: atención)
                    </label>
                </div>
            </div>
            <div>
                <label class="font-label-sm text-label-xs uppercase tracking-wider text-secondary block mb-1">Detalle del Reclamo o Queja *</label>
                <textarea name="description" required class="w-full px-4 py-2 bg-surface border border-outline/20 focus:border-primary focus:ring-0 outline-none rounded transition-all h-24" placeholder="Describa de manera detallada lo ocurrido..."></textarea>
            </div>
            <p class="text-[11px] text-secondary">Al enviar este formulario declaro ser el titular del documento indicado y doy mi consentimiento para el tratamiento de mis datos de conformidad con la ley de protección de datos personales.</p>
            <button type="submit" class="w-full py-3 bg-primary text-white font-bold rounded uppercase tracking-widest hover:bg-primary-container transition-all active:scale-[0.98]">Enviar Reclamación</button>
        </form>
    </div>
</div>

<!-- Global scripts for modal controls and shopping cart management -->
<script>
    // Modal controls
    function openQuoteModal(defaultMessage = '') {
        document.getElementById('quote-modal').classList.remove('hidden');
        if (defaultMessage) {
            document.querySelector('#quote-form textarea[name="message"]').value = defaultMessage;
        }
    }
    function closeQuoteModal() {
        document.getElementById('quote-modal').classList.add('hidden');
        document.getElementById('quote-form').reset();
    }

    function openClaimModal() {
        document.getElementById('claim-modal').classList.remove('hidden');
    }
    function closeClaimModal() {
        document.getElementById('claim-modal').classList.add('hidden');
        document.getElementById('claim-form').reset();
    }

    // Modal forms submission via Fetch AJAX
    document.getElementById('quote-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        fetch('{{ route("quote.store") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.json())
        .then(data => {
            alert(data.message);
            closeQuoteModal();
        })
        .catch(err => {
            console.error(err);
            alert('Ocurrió un error al enviar la solicitud. Intente de nuevo.');
        });
    });

    document.getElementById('claim-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        fetch('{{ route("claim.store") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.json())
        .then(data => {
            alert(data.message);
            closeClaimModal();
        })
        .catch(err => {
            console.error(err);
            alert('Ocurrió un error al registrar su reclamación. Intente de nuevo.');
        });
    });

    // LocalStorage based shopping cart functions
    const Cart = {
        getItems() {
            try {
                return JSON.parse(localStorage.getItem('yira_cart')) || [];
            } catch (e) {
                return [];
            }
        },
        saveItems(items) {
            localStorage.setItem('yira_cart', JSON.stringify(items));
            this.updateBadge();
            // Dispatch dynamic event for views listening
            window.dispatchEvent(new CustomEvent('cart-updated'));
        },
        addItem(id, name, price, image, color = 'Estándar', quantity = 1) {
            let items = this.getItems();
            // Identify unique combination of item ID and color
            let existing = items.find(item => item.id === id && item.color === color);
            if (existing) {
                existing.quantity += quantity;
            } else {
                items.push({ id, name, price, image, color, quantity });
            }
            this.saveItems(items);
            alert('¡Producto añadido al carrito!');
        },
        removeItem(id, color) {
            let items = this.getItems().filter(item => !(item.id === id && item.color === color));
            this.saveItems(items);
        },
        updateQuantity(id, color, quantity) {
            let items = this.getItems();
            let item = items.find(i => i.id === id && i.color === color);
            if (item) {
                item.quantity = Math.max(1, parseInt(quantity) || 1);
                this.saveItems(items);
            }
        },
        clear() {
            this.saveItems([]);
        },
        updateBadge() {
            const count = this.getItems().reduce((sum, item) => sum + item.quantity, 0);
            const badge = document.getElementById('cart-badge');
            if (badge) {
                if (count > 0) {
                    badge.textContent = count;
                    badge.classList.remove('hidden');
                } else {
                    badge.classList.add('hidden');
                }
            }
        }
    };

    // Initialize cart badge
    document.addEventListener('DOMContentLoaded', () => {
        Cart.updateBadge();
    });
</script>
@yield('scripts')
</body>
</html>
