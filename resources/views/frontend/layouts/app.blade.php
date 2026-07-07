<!DOCTYPE html>
<html class="light" lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ asset('img/ICON_ROJO.png') }}">

    <title>@yield('title', 'Yira Inversiones | Arquitectura y Confort')</title>
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
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
                        "headline-xl": ["48px", {
                            "lineHeight": "1.2",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "500"
                        }],
                        "body-md": ["16px", {
                            "lineHeight": "1.6",
                            "fontWeight": "400"
                        }],
                        "label-sm": ["14px", {
                            "lineHeight": "1",
                            "letterSpacing": "0.1em",
                            "fontWeight": "600"
                        }],
                        "body-lg": ["18px", {
                            "lineHeight": "1.6",
                            "fontWeight": "400"
                        }],
                        "headline-lg-mobile": ["32px", {
                            "lineHeight": "1.2",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "500"
                        }],
                        "headline-lg": ["32px", {
                            "lineHeight": "1.3",
                            "fontWeight": "500"
                        }]
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .hide-scroll::-webkit-scrollbar {
            display: none;
        }

        .hide-scroll {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .slider-container {
            transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

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
                    @if ($company->logo_path)
                        <img src="{{ asset('storage/' . $company->logo_path) }}" alt="{{ $company->name }}"
                            class="h-10 object-contain">
                    @else
                        <span class="font-headline-lg text-primary font-bold tracking-tight">{{ $company->name }}</span>
                    @endif
                </a>
                <div class="hidden md:flex gap-4 items-center">
                    <a class="font-body-md text-body-md px-3 py-1 transition-colors cursor-pointer active:scale-95 duration-200 {{ Route::is('home') ? 'text-primary border-b-2 border-primary' : 'text-secondary hover:text-primary' }}"
                        href="{{ route('home') }}">Inicio</a>
                    {{-- <a class="font-body-md text-body-md px-3 py-1 transition-colors cursor-pointer active:scale-95 duration-200 {{ Request::get('type') === 'hogar' ? 'text-primary border-b-2 border-primary' : 'text-secondary hover:text-primary' }}" href="{{ route('tienda', ['type' => 'hogar']) }}">Hogar</a>
                <a class="font-body-md text-body-md px-3 py-1 transition-colors cursor-pointer active:scale-95 duration-200 {{ Request::get('type') === 'oficina' ? 'text-primary border-b-2 border-primary' : 'text-secondary hover:text-primary' }}" href="{{ route('tienda', ['type' => 'oficina']) }}">Oficina</a> --}}
                    <a class="font-body-md text-body-md px-3 py-1 transition-colors cursor-pointer active:scale-95 duration-200 {{ Route::is('tienda') && !Request::has('type') ? 'text-primary border-b-2 border-primary' : 'text-secondary hover:text-primary' }}"
                        href="{{ route('tienda') }}">Tienda</a>
                    <a class="font-body-md text-body-md px-3 py-1 transition-colors cursor-pointer active:scale-95 duration-200 {{ Route::is('nosotros') ? 'text-primary border-b-2 border-primary' : 'text-secondary hover:text-primary' }}"
                        href="{{ route('nosotros') }}">Nosotros</a>
                    <a class="font-body-md text-body-md px-3 py-1 transition-colors cursor-pointer active:scale-95 duration-200 {{ Route::is('blog*') ? 'text-primary border-b-2 border-primary' : 'text-secondary hover:text-primary' }}"
                        href="{{ route('blog') }}">Blog</a>
                    <a class="font-body-md text-body-md px-3 py-1 transition-colors cursor-pointer active:scale-95 duration-200 {{ Route::is('contact') ? 'text-primary border-b-2 border-primary' : 'text-secondary hover:text-primary' }}"
                        href="{{ route('contact') }}">Contacto</a>
                </div>
            </div>
            <div class="flex items-center gap-4 md:gap-6">
                {{-- <a href="{{ route('tienda') }}"
                    class="material-symbols-outlined text-secondary hover:text-primary transition-colors cursor-pointer active:scale-95 duration-200">search</a> --}}
                @if (auth('customers')->check())
                    <div class="relative group">
                        <button
                            class="flex items-center gap-1 text-secondary hover:text-primary transition-colors cursor-pointer duration-200 focus:outline-none"
                            type="button">
                            <span class="material-symbols-outlined">person</span>
                            <span
                                class="text-sm font-semibold max-w-[120px] truncate hidden md:inline">{{ auth('customers')->user()->name }}</span>
                        </button>
                        <!-- Dropdown -->
                        <div class="absolute right-0 top-full pt-2 w-48 hidden group-hover:block z-50">
                            <div class="bg-white border border-outline/10 rounded shadow-lg py-2">
                                <a href="/clientes"
                                    class="block px-4 py-2 text-sm text-secondary hover:bg-surface-container-low hover:text-primary">Mi
                                    Panel</a>
                                <a href="/clientes/profile"
                                    class="block px-4 py-2 text-sm text-secondary hover:bg-surface-container-low hover:text-primary">Mi
                                    Perfil</a>
                                <hr class="border-outline/10 my-1">
                                <form action="{{ route('clientes.logout') }}" method="POST" class="block w-full">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-error hover:bg-surface-container-low">Cerrar
                                        Sesión</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="/clientes/login"
                        class="material-symbols-outlined text-secondary hover:text-primary transition-colors cursor-pointer active:scale-95 duration-200"
                        title="Iniciar Sesión / Registrarse">person</a>
                @endif
                <a href="{{ route('cart') }}"
                    class="material-symbols-outlined text-secondary hover:text-primary transition-colors cursor-pointer active:scale-95 duration-200 relative">
                    shopping_cart
                    <span id="cart-badge"
                        class="absolute -top-2 -right-2 bg-primary text-white text-[10px] rounded-full w-4 h-4 flex items-center justify-center font-bold hidden">0</span>
                </a>

                <!-- Hamburger Menu Button (Mobile) -->
                <button
                    class="md:hidden material-symbols-outlined text-secondary hover:text-primary transition-colors cursor-pointer active:scale-95 duration-200"
                    onclick="toggleMobileMenu(true)">
                    menu
                </button>
            </div>
        </div>
    </nav>

    <main class="pt-20 min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-surface-container py-16 border-t border-outline/10">
        <div
            class="flex flex-col md:flex-row justify-between items-start px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto gap-gutter">
            <div class="flex-1 w-full">
                <h4 class="font-headline-lg text-headline-lg text-on-surface mb-6">{{ $company->name }}</h4>
                <p class="text-secondary max-w-xs mb-8">Arquitectura y Confort para espacios que inspiran grandeza.
                    Calidad artesanal con visión moderna.</p>
                <div class="flex gap-4">
                    @if ($company->facebook_url)
                        <a class="w-10 h-10 flex items-center justify-center rounded-full bg-surface-container-highest text-secondary hover:text-primary transition-all"
                            href="{{ $company->facebook_url }}" target="_blank" title="Facebook">
                            <span class="material-symbols-outlined text-xl">link</span>
                        </a>
                    @endif
                    @if ($company->instagram_url)
                        <a class="w-10 h-10 flex items-center justify-center rounded-full bg-surface-container-highest text-secondary hover:text-primary transition-all"
                            href="{{ $company->instagram_url }}" target="_blank" title="Instagram">
                            <span class="material-symbols-outlined text-xl">photo_camera</span>
                        </a>
                    @endif
                    @if ($company->tiktok_url)
                        <a class="w-10 h-10 flex items-center justify-center rounded-full bg-surface-container-highest text-secondary hover:text-primary transition-all"
                            href="{{ $company->tiktok_url }}" target="_blank" title="TikTok">
                            <span class="material-symbols-outlined text-xl">music_note</span>
                        </a>
                    @endif
                    @if ($company->youtube_url)
                        <a class="w-10 h-10 flex items-center justify-center rounded-full bg-surface-container-highest text-secondary hover:text-primary transition-all"
                            href="{{ $company->youtube_url }}" target="_blank" title="YouTube">
                            <span class="material-symbols-outlined text-xl">play_circle</span>
                        </a>
                    @endif
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-10 md:gap-12 flex-[2] w-full">
                <div>
                    <h5 class="font-label-sm text-label-sm text-on-surface uppercase mb-6 tracking-widest">Catálogo</h5>
                    <ul class="space-y-4">
                        <li><a class="text-secondary hover:text-primary underline transition-all font-body-md text-body-md"
                                href="{{ route('tienda', ['type' => 'oficina']) }}">Mobiliario Oficina</a></li>
                        <li><a class="text-secondary hover:text-primary underline transition-all font-body-md text-body-md"
                                href="{{ route('tienda', ['type' => 'hogar']) }}">Sofás &amp; Estar</a></li>
                        <li><a class="text-secondary hover:text-primary underline transition-all font-body-md text-body-md"
                                href="{{ route('tienda') }}">Todo el Catálogo</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="font-label-sm text-label-sm text-on-surface uppercase mb-6 tracking-widest">Accesos
                        Rápidos</h5>
                    <ul class="space-y-4">
                        <li><a class="text-secondary hover:text-primary underline transition-all font-body-md text-body-md"
                                href="{{ route('home') }}">Inicio</a></li>
                        <li><a class="text-secondary hover:text-primary underline transition-all font-body-md text-body-md"
                                href="{{ route('nosotros') }}">Sobre Nosotros</a></li>
                        <li><a class="text-secondary hover:text-primary underline transition-all font-body-md text-body-md"
                                href="{{ route('policies') }}">Políticas de Garantía y Envíos</a></li>
                        <li><a class="text-secondary hover:text-primary underline transition-all font-body-md text-body-md"
                                href="#" onclick="openQuoteModal()">Solicitar Cotización</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="font-label-sm text-label-sm text-on-surface uppercase mb-6 tracking-widest">Contacto
                    </h5>
                    <ul class="space-y-4 text-secondary font-body-md">
                        @if ($company->address)
                            <li><span class="block text-on-surface font-semibold">Dirección:</span>
                                {{ $company->address }}</li>
                        @endif
                        @if ($company->phone)
                            <li><span class="block text-on-surface font-semibold">WhatsApp / Teléfono:</span>
                                {{ $company->phone }}</li>
                        @endif
                        @if ($company->email)
                            <li><span class="block text-on-surface font-semibold">Email:</span> {{ $company->email }}
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div
            class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mt-16 pt-8 border-t border-outline/10 flex flex-col md:flex-row justify-between items-center gap-4 w-full">
            <p class="text-secondary font-body-md text-body-md text-center md:text-left">© {{ date('Y') }}
                {{ $company->name }}. Todos los derechos reservados.</p>
            <div class="flex gap-4">
                <a href="{{ route('policies') }}"
                    class="text-xs text-secondary hover:text-primary underline">Políticas</a>
                <a href="#" onclick="openClaimModal()"
                    class="text-xs text-secondary hover:text-primary underline font-bold flex items-center gap-1">
                    <span class="material-symbols-outlined text-xs">edit_document</span>
                    Libro de Reclamaciones
                </a>
            </div>
        </div>
    </footer>

    <!-- Custom Dialog Modal -->
    <div id="custom-dialog-modal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeCustomDialog()"></div>
        <!-- Modal Content -->
        <div class="relative bg-white rounded-lg shadow-xl max-w-md w-full p-6 border border-outline/10 text-left">
            <h4 id="custom-dialog-title" class="font-headline-md text-lg font-bold text-on-surface mb-3">Atención</h4>
            <p id="custom-dialog-message" class="text-secondary font-body-md text-body-md mb-6 leading-relaxed"></p>
            <div class="flex justify-end">
                <button id="custom-dialog-ok-btn" class="bg-primary text-white px-6 py-2.5 rounded font-label-sm text-label-sm uppercase tracking-wider hover:opacity-90 active:scale-95 transition-all">
                    Aceptar
                </button>
            </div>
        </div>
    </div>

    <!-- Floating WhatsApp Button -->
    @if ($company->phone)
        @php
            $whatsappNumber = preg_replace('/[^0-9]/', '', $company->phone);
            $whatsappUrl =
                'https://wa.me/' . $whatsappNumber . '?text=' . urlencode('Hola, me gustaría recibir más información.');
        @endphp
        <a href="{{ $whatsappUrl }}" target="_blank"
            class="fixed bottom-6 right-6 z-40 flex items-center justify-center w-14 h-14 bg-[#25D366] text-white rounded-full shadow-lg hover:scale-110 transition-transform duration-300 focus:outline-none focus:ring-4 focus:ring-green-300"
            aria-label="Chat on WhatsApp">
            {{-- WhatsApp Official SVG Icon --}}
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="28" height="28"
                fill="currentColor">
                <path
                    d="M12.031 21.172l-3.181-.85-3.18.85.85-3.18-1.558-2.698A9.972 9.972 0 013 10c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10a9.96 9.96 0 01-5.111-1.398l-2.698-1.558-.85 3.18-.85-3.181 3.18.85 3.181-.85z"
                    fill="none" />
                <path
                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.888-.788-1.487-1.761-1.66-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.198 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z" />
            </svg>
            <span class="absolute flex h-full w-full pointer-events-none">
                <span
                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#25D366] opacity-40"></span>
            </span>
        </a>
    @endif

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu-overlay"
        class="fixed inset-0 bg-on-surface/20 backdrop-blur-sm z-[60] hidden transition-opacity duration-300 opacity-0"
        onclick="toggleMobileMenu(false)"></div>

    <!-- Mobile Menu Drawer -->
    <div id="mobile-menu-drawer"
        class="fixed top-0 left-0 h-full w-[80%] max-w-sm bg-surface shadow-xl z-[70] -translate-x-full transition-transform duration-300 flex flex-col border-r border-outline/10">
        <div class="p-6 border-b border-outline/10 flex justify-between items-center">
            @if ($company->logo_path)
                <img src="{{ asset('storage/' . $company->logo_path) }}" alt="{{ $company->name }}"
                    class="h-8 object-contain">
            @else
                <span class="font-headline-lg text-primary font-bold tracking-tight">{{ $company->name }}</span>
            @endif
            <button onclick="toggleMobileMenu(false)"
                class="material-symbols-outlined text-secondary hover:text-primary transition-colors">close</button>
        </div>
        <div class="flex flex-col py-4 overflow-y-auto">
            <a href="{{ route('home') }}"
                class="px-6 py-4 text-body-lg text-secondary hover:bg-surface-container-low hover:text-primary border-b border-outline/5 {{ Route::is('home') ? 'text-primary font-bold' : '' }}">Inicio</a>
            <a href="{{ route('tienda') }}"
                class="px-6 py-4 text-body-lg text-secondary hover:bg-surface-container-low hover:text-primary border-b border-outline/5 {{ Route::is('tienda') ? 'text-primary font-bold' : '' }}">Tienda</a>
            <a href="{{ route('nosotros') }}"
                class="px-6 py-4 text-body-lg text-secondary hover:bg-surface-container-low hover:text-primary border-b border-outline/5 {{ Route::is('nosotros') ? 'text-primary font-bold' : '' }}">Nosotros</a>
            <a href="{{ route('blog') }}"
                class="px-6 py-4 text-body-lg text-secondary hover:bg-surface-container-low hover:text-primary border-b border-outline/5 {{ Route::is('blog') ? 'text-primary font-bold' : '' }}">Blog</a>
            <a href="{{ route('contact') }}"
                class="px-6 py-4 text-body-lg text-secondary hover:bg-surface-container-low hover:text-primary border-b border-outline/5 {{ Route::is('contact') ? 'text-primary font-bold' : '' }}">Contacto</a>
        </div>
        <div class="p-6 mt-auto border-t border-outline/10">
            <button onclick="openQuoteModal(); toggleMobileMenu(false);"
                class="w-full py-3 bg-primary text-white font-bold rounded uppercase tracking-widest text-xs">Solicitar
                Cotización</button>
        </div>
    </div>

    <!-- Modal de Cotización (Emergente) -->
    <div id="quote-modal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden backdrop-blur-sm">
        <div class="bg-white w-full max-w-lg p-8 rounded-lg shadow-xl border border-outline/10 relative mx-4">
            <button onclick="closeQuoteModal()"
                class="absolute top-4 right-4 text-secondary hover:text-primary transition-all">
                <span class="material-symbols-outlined text-2xl">close</span>
            </button>
            <span
                class="font-label-sm text-label-sm text-primary uppercase tracking-widest mb-2 block">Cotización</span>
            <h3 class="font-headline-lg text-headline-lg text-on-surface mb-6">Solicitud de Cotización</h3>
            <form id="quote-form" class="space-y-4">
                @csrf
                <div>
                    <label
                        class="font-label-sm text-label-xs uppercase tracking-wider text-secondary block mb-1">Nombre
                        Completo *</label>
                    <input name="name" required maxlength="100"
                        class="w-full px-4 py-2 bg-surface border border-outline/20 focus:border-primary focus:ring-0 outline-none rounded transition-all"
                        placeholder="Tu nombre" type="text">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label
                            class="font-label-sm text-label-xs uppercase tracking-wider text-secondary block mb-1">Correo
                            Electrónico *</label>
                        <input name="email" required
                            class="w-full px-4 py-2 bg-surface border border-outline/20 focus:border-primary focus:ring-0 outline-none rounded transition-all"
                            placeholder="correo@ejemplo.com" type="email">
                    </div>
                    <div>
                        <label
                            class="font-label-sm text-label-xs uppercase tracking-wider text-secondary block mb-1">Teléfono
                            / WhatsApp *</label>
                        <input name="phone" required
                            class="w-full px-4 py-2 bg-surface border border-outline/20 focus:border-primary focus:ring-0 outline-none rounded transition-all"
                            placeholder="+51 999 999 999" type="text">
                    </div>
                </div>
                <div>
                    <label
                        class="font-label-sm text-label-xs uppercase tracking-wider text-secondary block mb-1">Proyecto
                        (Opcional)</label>
                    <input name="project"
                        class="w-full px-4 py-2 bg-surface border border-outline/20 focus:border-primary focus:ring-0 outline-none rounded transition-all"
                        placeholder="Ej: Amoblado de Sala, Oficina Corporativa" type="text">
                </div>
                <div>
                    <label
                        class="font-label-sm text-label-xs uppercase tracking-wider text-secondary block mb-1">Mensaje
                        o Detalles del Pedido *</label>
                    <textarea name="message" required
                        class="w-full px-4 py-2 bg-surface border border-outline/20 focus:border-primary focus:ring-0 outline-none rounded transition-all h-24"
                        placeholder="Detalle los productos o requerimientos de su cotización..."></textarea>
                </div>
                <button type="submit" id="quote-submit-btn"
                    class="w-full py-3 bg-primary text-white font-bold rounded uppercase tracking-widest hover:bg-primary-container transition-all active:scale-[0.98] disabled:opacity-60 disabled:cursor-not-allowed flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">send</span>
                    Enviar Solicitud
                </button>
            </form>
        </div>
    </div>

    <!-- Modal de Libro de Reclamaciones (Normativo) -->
    <div id="claim-modal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden backdrop-blur-sm">
        <div
            class="bg-white w-full max-w-2xl p-8 rounded-lg shadow-xl border border-outline/10 relative mx-4 max-h-[90vh] overflow-y-auto">
            <button onclick="closeClaimModal()"
                class="absolute top-4 right-4 text-secondary hover:text-primary transition-all">
                <span class="material-symbols-outlined text-2xl">close</span>
            </button>
            <span class="font-label-sm text-label-sm text-primary uppercase tracking-widest mb-2 block">Libro de
                Reclamaciones</span>
            <h3 class="font-headline-lg text-headline-lg text-on-surface mb-6">Hoja de Reclamación Digital</h3>
            <form id="claim-form" class="space-y-4">
                @csrf
                <div>
                    <label
                        class="font-label-sm text-label-xs uppercase tracking-wider text-secondary block mb-1">Nombre
                        Completo *</label>
                    <input name="fullname" required maxlength="100"
                        class="w-full px-4 py-2 bg-surface border border-outline/20 focus:border-primary focus:ring-0 outline-none rounded transition-all"
                        placeholder="Nombre completo" type="text">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label
                            class="font-label-sm text-label-xs uppercase tracking-wider text-secondary block mb-1">Tipo
                            de Documento *</label>
                        <select name="document_type" required
                            class="w-full px-4 py-2 bg-surface border border-outline/20 focus:border-primary focus:ring-0 outline-none rounded transition-all">
                            <option value="" disabled selected>Seleccione tipo...</option>
                            <option value="DNI">DNI (Documento Nacional de Identidad)</option>
                            <option value="RUC">RUC</option>
                            <option value="CE">Carnet de Extranjería</option>
                            <option value="Pasaporte">Pasaporte</option>
                        </select>
                    </div>
                    <div>
                        <label
                            class="font-label-sm text-label-xs uppercase tracking-wider text-secondary block mb-1">Número
                            de Documento *</label>
                        <input name="document_number" required disabled
                            class="w-full px-4 py-2 bg-surface border border-outline/20 focus:border-primary focus:ring-0 outline-none rounded transition-all disabled:opacity-60 disabled:cursor-not-allowed"
                            placeholder="Seleccione tipo de documento primero" type="text">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label
                            class="font-label-sm text-label-xs uppercase tracking-wider text-secondary block mb-1">Correo
                            Electrónico *</label>
                        <input name="email" required
                            class="w-full px-4 py-2 bg-surface border border-outline/20 focus:border-primary focus:ring-0 outline-none rounded transition-all"
                            placeholder="correo@ejemplo.com" type="email">
                    </div>
                    <div>
                        <label
                            class="font-label-sm text-label-xs uppercase tracking-wider text-secondary block mb-1">Teléfono
                            / Celular *</label>
                        <input name="phone" required
                            class="w-full px-4 py-2 bg-surface border border-outline/20 focus:border-primary focus:ring-0 outline-none rounded transition-all"
                            placeholder="999888777" type="text">
                    </div>
                </div>
                <div>
                    <label class="font-label-sm text-label-xs uppercase tracking-wider text-secondary block mb-1">Tipo
                        de Reclamación *</label>
                    <div class="flex gap-6 mt-1">
                        <label class="flex items-center gap-2 text-secondary">
                            <input type="radio" name="type" value="reclamo" checked
                                class="text-primary focus:ring-0"> Reclamo (Disconformidad relacionada a los bienes o
                            servicios)
                        </label>
                        <label class="flex items-center gap-2 text-secondary">
                            <input type="radio" name="type" value="queja" class="text-primary focus:ring-0">
                            Queja (Disconformidad no relacionada a bienes, ej: atención)
                        </label>
                    </div>
                </div>
                <div>
                    <label
                        class="font-label-sm text-label-xs uppercase tracking-wider text-secondary block mb-1">Detalle
                        del Reclamo o Queja *</label>
                    <textarea name="description" required
                        class="w-full px-4 py-2 bg-surface border border-outline/20 focus:border-primary focus:ring-0 outline-none rounded transition-all h-24"
                        placeholder="Describa de manera detallada lo ocurrido..."></textarea>
                </div>
                <p class="text-[11px] text-secondary">Al enviar este formulario declaro ser el titular del documento
                    indicado y doy mi consentimiento para el tratamiento de mis datos de conformidad con la ley de
                    protección de datos personales.</p>
                <button type="submit" id="claim-submit-btn"
                    class="w-full py-3 bg-primary text-white font-bold rounded uppercase tracking-widest hover:bg-primary-container transition-all active:scale-[0.98] disabled:opacity-60 disabled:cursor-not-allowed flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">gavel</span>
                    Enviar Reclamación
                </button>
            </form>
        </div>
    </div>

    <!-- Global scripts for modal controls and shopping cart management -->
    <script>
        // Custom dynamic Toast Notification
        function showToast(message, type = 'success') {
            let container = document.getElementById('toast-container');
            if (!container) {
                container = document.createElement('div');
                container.id = 'toast-container';
                container.className = 'fixed bottom-6 right-6 z-[9999] flex flex-col gap-3 pointer-events-none max-w-sm w-full px-4';
                document.body.appendChild(container);
            }
            
            const toast = document.createElement('div');
            toast.className = 'p-4 rounded-lg shadow-lg text-white pointer-events-auto flex items-center justify-between gap-3 transition-all duration-300 transform translate-y-2 opacity-0';
            
            if (type === 'success') {
                toast.classList.add('bg-primary');
            } else if (type === 'error') {
                toast.classList.add('bg-red-600');
            } else if (type === 'warning') {
                toast.classList.add('bg-amber-600');
            } else {
                toast.classList.add('bg-slate-800');
            }
            
            let icon = 'info';
            if (type === 'success') icon = 'check_circle';
            if (type === 'error') icon = 'error';
            if (type === 'warning') icon = 'warning';
            
            toast.innerHTML = `
                <div class="flex items-center gap-2.5">
                    <span class="material-symbols-outlined notranslate" translate="no">${icon}</span>
                    <span class="text-sm font-semibold">${message}</span>
                </div>
                <button class="text-white/80 hover:text-white transition-colors shrink-0" onclick="this.parentElement.remove()">
                    <span class="material-symbols-outlined text-sm notranslate" translate="no">close</span>
                </button>
            `;
            
            container.appendChild(toast);
            
            // Force reflow
            toast.offsetHeight;
            
            toast.classList.remove('translate-y-2', 'opacity-0');
            
            setTimeout(() => {
                toast.classList.add('opacity-0', 'translate-y-2');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }, 4000);
        }

        // Custom Dialog Modal controls
        let customDialogCallback = null;

        function showCustomDialog(message, title = 'Atención', callback = null) {
            document.getElementById('custom-dialog-title').innerText = title;
            document.getElementById('custom-dialog-message').innerText = message;
            
            const modal = document.getElementById('custom-dialog-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            customDialogCallback = callback;
            
            const okBtn = document.getElementById('custom-dialog-ok-btn');
            if (okBtn) okBtn.focus();
        }

        function closeCustomDialog() {
            const modal = document.getElementById('custom-dialog-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            
            if (customDialogCallback && typeof customDialogCallback === 'function') {
                customDialogCallback();
                customDialogCallback = null;
            }
        }

        // Modal controls
        function toggleMobileMenu(open) {
            const overlay = document.getElementById('mobile-menu-overlay');
            const drawer = document.getElementById('mobile-menu-drawer');

            if (open) {
                overlay.classList.remove('hidden');
                drawer.classList.remove('-translate-x-full');
                setTimeout(() => {
                    overlay.classList.add('opacity-100');
                    overlay.classList.remove('opacity-0');
                }, 10);
            } else {
                overlay.classList.add('opacity-0');
                overlay.classList.remove('opacity-100');
                drawer.classList.add('-translate-x-full');
                setTimeout(() => {
                    overlay.classList.add('hidden');
                }, 300);
            }
        }

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
        function setButtonLoading(btn, isLoading, icon, label) {
            btn.disabled = isLoading;
            btn.innerHTML = isLoading ?
                `<span class="material-symbols-outlined text-[18px] animate-spin">sync</span> <span>${label}</span>` :
                `<span class="material-symbols-outlined text-[18px]">${icon}</span> <span>${label}</span>`;
        }

        document.getElementById('quote-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = document.getElementById('quote-submit-btn');

            const name = this.querySelector('input[name="name"]').value.trim();
            const email = this.querySelector('input[name="email"]').value.trim();
            const phone = this.querySelector('input[name="phone"]').value.trim();
            const message = this.querySelector('textarea[name="message"]').value.trim();

            if (name.length < 5) {
                showToast('Por favor, ingrese su nombre completo (mínimo 5 caracteres).', 'warning');
                return;
            }
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                showToast('El correo electrónico no es válido.', 'warning');
                return;
            }
            if (!/^\+?[0-9]{7,15}$/.test(phone)) {
                showToast('El número de teléfono no es válido (ingrese entre 7 y 15 dígitos sin espacios ni guiones).', 'warning');
                return;
            }
            if (message.length < 10) {
                showToast('El mensaje o detalles deben tener al menos 10 caracteres.', 'warning');
                return;
            }

            setButtonLoading(btn, true, 'send', 'Enviando...');
            const formData = new FormData(this);
            fetch('{{ route('quote.store') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => {
                    if (!res.ok) {
                        return res.json().then(err => { throw err; });
                    }
                    return res.json();
                })
                .then(data => {
                    // Estado de éxito
                    btn.disabled = true;
                    btn.classList.replace('bg-primary', 'bg-green-700');
                    btn.innerHTML =
                        `<span class="material-symbols-outlined text-[18px]">check_circle</span> <span>¡Mensaje Enviado!</span>`;
                    setTimeout(() => {
                        closeQuoteModal();
                        btn.classList.replace('bg-green-700', 'bg-primary');
                        setButtonLoading(btn, false, 'send', 'Enviar Solicitud');
                    }, 2000);
                })
                .catch(err => {
                    console.error(err);
                    const errMsg = err.message || 'Ocurrió un error al enviar la solicitud. Intente de nuevo.';
                    showToast(errMsg, 'error');
                    setButtonLoading(btn, false, 'send', 'Enviar Solicitud');
                });
        });

        document.getElementById('claim-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = document.getElementById('claim-submit-btn');

            const fullname = this.querySelector('input[name="fullname"]').value.trim();
            const docType = this.querySelector('select[name="document_type"]').value;
            const docNum = this.querySelector('input[name="document_number"]').value.trim();
            const phone = this.querySelector('input[name="phone"]').value.trim();
            const email = this.querySelector('input[name="email"]').value.trim();
            const description = this.querySelector('textarea[name="description"]').value.trim();

            if (fullname.length < 5) {
                showToast('Por favor, ingrese su nombre completo (mínimo 5 caracteres).', 'warning');
                return;
            }
            if (!docType) {
                showToast('Debe seleccionar el tipo de documento.', 'warning');
                return;
            }
            if (docType === 'DNI' && docNum.length !== 8) {
                showToast('El DNI debe tener exactamente 8 dígitos.', 'warning');
                return;
            }
            if (docType === 'RUC' && docNum.length !== 11) {
                showToast('El RUC debe tener exactamente 11 dígitos.', 'warning');
                return;
            }
            if (docType === 'CE' && (docNum.length < 8 || docNum.length > 12)) {
                showToast('El Carnet de Extranjería debe tener entre 8 y 12 caracteres.', 'warning');
                return;
            }
            if (docType === 'Pasaporte' && (docNum.length < 6 || docNum.length > 15)) {
                showToast('El Pasaporte debe tener entre 6 y 15 caracteres.', 'warning');
                return;
            }
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                showToast('El correo electrónico no es válido.', 'warning');
                return;
            }
            if (!/^\+?[0-9]{7,15}$/.test(phone)) {
                showToast('El número de celular no es válido (ingrese entre 7 y 15 dígitos).', 'warning');
                return;
            }
            if (description.length < 15) {
                showToast('El detalle del reclamo o queja debe tener al menos 15 caracteres.', 'warning');
                return;
            }

            setButtonLoading(btn, true, 'gavel', 'Registrando...');
            const formData = new FormData(this);
            fetch('{{ route('claim.store') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => {
                    if (!res.ok) {
                        return res.json().then(err => { throw err; });
                    }
                    return res.json();
                })
                .then(data => {
                    // Mostrar código de reclamación y estado de éxito
                    btn.disabled = true;
                    btn.classList.replace('bg-primary', 'bg-green-700');
                    btn.innerHTML =
                        `<span class="material-symbols-outlined text-[18px]">check_circle</span> <span>${data.message || '¡Reclamación Registrada!'}</span>`;
                    setTimeout(() => {
                        closeClaimModal();
                        btn.classList.replace('bg-green-700', 'bg-primary');
                        setButtonLoading(btn, false, 'gavel', 'Enviar Reclamación');
                    }, 3000);
                })
                .catch(err => {
                    console.error(err);
                    const errMsg = err.message || 'Ocurrió un error al registrar su reclamación. Intente de nuevo.';
                    showToast(errMsg, 'error');
                    setButtonLoading(btn, false, 'gavel', 'Enviar Reclamación');
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
                    items.push({
                        id,
                        name,
                        price,
                        image,
                        color,
                        quantity
                    });
                }
                this.saveItems(items);
                showToast('¡Producto añadido al carrito!', 'success');
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

        // Initialize cart badge and document validations
        document.addEventListener('DOMContentLoaded', () => {
            Cart.updateBadge();

            // Claim form document type and number logic
            const claimDocType = document.querySelector('#claim-form select[name="document_type"]');
            const claimDocNumber = document.querySelector('#claim-form input[name="document_number"]');

            if (claimDocType && claimDocNumber) {
                claimDocType.addEventListener('change', function() {
                    const val = this.value;
                    claimDocNumber.value = "";
                    if (val) {
                        claimDocNumber.disabled = false;
                        if (val === 'DNI') {
                            claimDocNumber.placeholder = "8 dígitos (solo números)";
                            claimDocNumber.maxLength = 8;
                        } else if (val === 'RUC') {
                            claimDocNumber.placeholder = "11 dígitos (solo números)";
                            claimDocNumber.maxLength = 11;
                        } else if (val === 'CE') {
                            claimDocNumber.placeholder = "Alfanumérico (8 a 12 caracteres)";
                            claimDocNumber.maxLength = 12;
                        } else {
                            claimDocNumber.placeholder = "Pasaporte (hasta 15 caracteres)";
                            claimDocNumber.maxLength = 15;
                        }
                    } else {
                        claimDocNumber.disabled = true;
                        claimDocNumber.placeholder = "Seleccione tipo de documento primero";
                    }
                });

                claimDocNumber.addEventListener('input', function(e) {
                    const valType = claimDocType.value;
                    if (valType === 'DNI' || valType === 'RUC') {
                        this.value = this.value.replace(/\D/g, '');
                    } else if (valType === 'CE' || valType === 'Pasaporte') {
                        this.value = this.value.replace(/[^a-zA-Z0-9]/g, '');
                    }
                });
            }

            // Proteger íconos de Material Symbols de la traducción del navegador.
            // Los traductores (Google Translate, etc.) convierten "picture_as_pdf" → "imagen_como_pdf"
            // rompiendo la fuente de íconos. translate="no" evita esto globalmente.
            document.querySelectorAll('.material-symbols-outlined, .material-icons').forEach(el => {
                el.setAttribute('translate', 'no');
                el.classList.add('notranslate');
            });
        });
    </script>
    @yield('scripts')
</body>

</html>
