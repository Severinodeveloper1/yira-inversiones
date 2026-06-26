@extends('frontend.layouts.app')

@section('title', 'Tienda y Catálogos | Yira Inversiones')

@section('content')
    @include('frontend.partials._page_hero', [
        'pageBanners' => $pageBanners ?? collect(),
        'fallbackBg' => null,
        'defaultSubtitle' => 'Catálogo',
        'defaultTitle' => 'Tienda y Catálogos',
    ])

    <main class="py-12 pb-24 max-w-container-max mx-auto px-margin-desktop">
        <!-- Page Header -->
        <header class="mb-12">
            <nav class="flex text-label-sm font-label-sm text-secondary mb-4">
                <a class="hover:text-primary" href="{{ route('home') }}">Inicio</a>
                <span class="mx-2">/</span>
                <span class="text-on-surface-variant">Tienda</span>
            </nav>
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <button onclick="toggleDrawer(true)"
                        class="flex items-center gap-2 px-4 py-2 bg-surface-container-highest hover:bg-surface-variant rounded-lg transition-colors active:scale-95 border border-outline/10">
                        <span class="material-symbols-outlined text-primary">tune</span>
                        <span class="font-label-sm uppercase tracking-widest text-[11px]">Filtros</span>
                    </button>
                    <h1 class="font-headline-xl text-headline-lg md:text-headline-xl text-on-surface">Tienda y Catálogos
                    </h1>
                </div>

                <!-- Search bar -->
                <form action="{{ route('tienda') }}" method="GET"
                    class="flex border border-outline/20 rounded-lg overflow-hidden bg-white max-w-md w-full">
                    @if (request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if (request('type'))
                        <input type="hidden" name="type" value="{{ request('type') }}">
                    @endif
                    <input name="search" value="{{ request('search') }}"
                        class="bg-transparent border-none px-4 py-2 focus:ring-0 text-body-md w-full outline-none"
                        placeholder="Buscar productos..." type="text">
                    <button type="submit"
                        class="material-symbols-outlined text-secondary hover:text-primary px-4">search</button>
                </form>
            </div>

            <!-- Filter labels summary -->
            @if (request('category') || request('type') || request('search'))
                <div class="flex flex-wrap gap-2 mt-4 items-center">
                    <span class="text-xs text-secondary">Filtros activos:</span>
                    @if (request('type'))
                        <span
                            class="bg-primary/5 text-primary text-xs px-3 py-1 rounded-full border border-primary/20 flex items-center gap-1 font-semibold">
                            Línea: {{ ucfirst(request('type')) }}
                            <a href="{{ route('tienda', request()->except('type')) }}"
                                class="hover:text-red-500 font-bold">×</a>
                        </span>
                    @endif
                    @if (request('category'))
                        @php $catName = $categories->where('slug', request('category'))->first()?->name ?? request('category'); @endphp
                        <span
                            class="bg-primary/5 text-primary text-xs px-3 py-1 rounded-full border border-primary/20 flex items-center gap-1 font-semibold">
                            Categoría: {{ $catName }}
                            <a href="{{ route('tienda', request()->except('category')) }}"
                                class="hover:text-red-500 font-bold">×</a>
                        </span>
                    @endif
                    @if (request('search'))
                        <span
                            class="bg-primary/5 text-primary text-xs px-3 py-1 rounded-full border border-primary/20 flex items-center gap-1 font-semibold">
                            Búsqueda: "{{ request('search') }}"
                            <a href="{{ route('tienda', request()->except('search')) }}"
                                class="hover:text-red-500 font-bold">×</a>
                        </span>
                    @endif
                    <a href="{{ route('tienda') }}"
                        class="text-xs text-secondary hover:text-primary underline ml-2">Limpiar todos</a>
                </div>
            @endif
        </header>

        <div class="flex flex-col md:flex-row gap-gutter">
            <!-- Right Main Grid -->
            <div class="flex-grow">
                @if ($products->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-gutter">
                        @foreach ($products as $product)
                            @php
                                $images = $product->getMedia('products');
                                $hasMultipleImages = $images->count() > 1;
                                $mainImage =
                                    $images->count() > 0 ? $images->first()->getUrl() : 'https://placehold.co/400x500';
                            @endphp
                            <article
                                class="product-card bg-surface-container-lowest rounded-lg overflow-hidden shadow-[0_2px_15px_rgba(0,0,0,0.03)] hover:shadow-[0_8px_30px_rgba(0,0,0,0.05)] transition-all duration-500 border border-outline/5 flex flex-col justify-between">
                                <div class="relative group aspect-[4/5] bg-surface-container overflow-hidden">
                                    <div class="absolute inset-0 flex transition-transform duration-500 h-full w-full"
                                        id="carousel-{{ $product->id }}"
                                        style="width: {{ max(1, $images->count()) * 100 }}%">
                                        @if ($images->count() > 0)
                                            @foreach ($images as $media)
                                                <div class="h-full bg-cover bg-center"
                                                    style="width: {{ 100 / $images->count() }}%; background-image: url('{{ $media->getUrl() }}')">
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="w-full h-full bg-cover bg-center"
                                                style="background-image: url('https://placehold.co/400x500')"></div>
                                        @endif
                                    </div>

                                    @if ($hasMultipleImages)
                                        <button
                                            class="product-carousel-btn absolute left-4 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-white/90 shadow-sm flex items-center justify-center text-on-surface hover:bg-primary hover:text-white transition-all z-10"
                                            onclick="rotateCarousel('carousel-{{ $product->id }}', -1)">
                                            <span class="material-symbols-outlined text-sm">chevron_left</span>
                                        </button>
                                        <button
                                            class="product-carousel-btn absolute right-4 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-white/90 shadow-sm flex items-center justify-center text-on-surface hover:bg-primary hover:text-white transition-all z-10"
                                            onclick="rotateCarousel('carousel-{{ $product->id }}', 1)">
                                            <span class="material-symbols-outlined text-sm">chevron_right</span>
                                        </button>
                                    @endif

                                    <div
                                        class="absolute top-4 left-4 bg-primary text-white text-[10px] font-bold px-2 py-1 uppercase tracking-tighter rounded z-10">
                                        {{ $product->category->name }}
                                    </div>
                                    @if ($product->promo_label)
                                        <div
                                            class="absolute top-4 right-4 bg-accent-terracotta text-white text-[10px] font-bold px-2 py-1 uppercase tracking-tighter rounded z-10">
                                            {{ $product->promo_label }}
                                        </div>
                                    @endif
                                </div>
                                <div class="p-6 flex flex-col justify-between flex-grow">
                                    <div class="mb-4">
                                        <div class="flex justify-between items-start gap-2 mb-1">
                                            <h3 class="font-headline-lg text-body-md font-bold leading-tight">
                                                <a href="{{ route('product.detail', $product->slug) }}"
                                                    class="hover:text-primary transition-colors">{{ $product->name }}</a>
                                            </h3>
                                            <span class="text-primary font-bold text-body-md whitespace-nowrap">
                                                @if ($product->promo_price)
                                                    S/. {{ number_format($product->promo_price, 0) }}
                                                    <span class="text-secondary text-xs line-through ml-1 font-normal">S/.
                                                        {{ number_format($product->price, 0) }}</span>
                                                @elseif($product->price)
                                                    S/. {{ number_format($product->price, 0) }}
                                                @else
                                                    Cotizar
                                                @endif
                                            </span>
                                        </div>
                                        <p class="text-secondary text-xs">
                                            Línea: {{ ucfirst($product->category->type) }} •
                                            {{ $product->delivery_time ?? 'Entrega rápida' }}
                                        </p>
                                    </div>
                                    <a href="{{ route('product.detail', $product->slug) }}"
                                        class="w-full py-3 bg-on-surface text-white font-bold text-[11px] uppercase tracking-widest hover:bg-primary transition-colors duration-300 rounded text-center block">Ver
                                        Detalles</a>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <!-- Pagination links -->
                    <div class="mt-16 flex justify-center">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="text-center py-20 bg-white rounded-lg border border-outline/10">
                        <span class="material-symbols-outlined text-5xl text-secondary mb-4">search_off</span>
                        <h3 class="font-headline-lg text-body-lg font-bold mb-2">No se encontraron productos</h3>
                        <p class="text-secondary mb-6 max-w-sm mx-auto">Intente cambiar los filtros o el término de
                            búsqueda.</p>
                        <a href="{{ route('tienda') }}"
                            class="inline-block bg-primary text-white px-6 py-3 rounded uppercase font-bold text-xs tracking-widest hover:bg-primary-container">Mostrar
                            Todo</a>
                    </div>
                @endif
            </div>
        </div>
    </main>

    <!-- Catalog Section -->
    <section class="py-16 bg-surface-container-low border-t border-outline/10">
        <div class="max-w-container-max mx-auto px-margin-desktop">
            <div class="text-center mb-12">
                <h2 class="font-headline-lg text-headline-lg text-on-surface mb-2">Descarga nuestros Catálogos</h2>
                <p class="text-secondary font-body-md">Explora las colecciones completas en formato digital de alta
                    resolución.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
                <div
                    class="group relative overflow-hidden bg-white rounded-lg p-8 md:p-12 flex flex-col items-center text-center transition-all duration-500 hover:shadow-lg border border-outline/5">
                    <div
                        class="w-16 h-16 mb-6 bg-primary/5 rounded-xl flex items-center justify-center text-primary group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-3xl">picture_as_pdf</span>
                    </div>
                    <h3 class="font-headline-lg text-headline-lg mb-2">Catálogo Hogar</h3>
                    <p class="text-secondary mb-8 max-w-xs text-sm">Mobiliario de diseño para salas, dormitorios y comedores
                        con estilo contemporáneo.</p>
                    <a href="{{ $company->catalog_home_path ? asset('storage/' . $company->catalog_home_path) : '#' }}"
                        @if ($company->catalog_home_path) target="_blank" @else onclick="alert('El catálogo de Hogar estará disponible muy pronto. Por favor, contáctanos para enviarte información.'); return false;" @endif
                        class="flex items-center gap-2 px-8 py-3 bg-primary text-white font-bold rounded text-xs uppercase tracking-widest hover:bg-primary-container transition-colors">
                        <span>Descargar PDF</span>
                        <span class="material-symbols-outlined text-sm">download</span>
                    </a>
                </div>
                <div
                    class="group relative overflow-hidden bg-on-surface rounded-lg p-8 md:p-12 flex flex-col items-center text-center transition-all duration-500">
                    <div
                        class="w-16 h-16 mb-6 bg-white/10 rounded-xl flex items-center justify-center text-primary-fixed-dim group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-3xl text-white">picture_as_pdf</span>
                    </div>
                    <h3 class="font-headline-lg text-headline-lg text-white mb-2">Catálogo Oficina</h3>
                    <p class="text-surface-variant mb-8 max-w-xs text-sm">Soluciones ergonómicas y arquitectura de espacios
                        corporativos de alto rendimiento.</p>
                    <a href="{{ $company->catalog_office_path ? asset('storage/' . $company->catalog_office_path) : '#' }}"
                        @if ($company->catalog_office_path) target="_blank" @else onclick="alert('El catálogo de Oficina estará disponible muy pronto. Por favor, contáctanos para enviarte información.'); return false;" @endif
                        class="flex items-center gap-2 px-8 py-3 bg-white text-on-surface font-bold rounded text-xs uppercase tracking-widest hover:bg-primary hover:text-white transition-all">
                        <span>Descargar PDF</span>
                        <span class="material-symbols-outlined text-sm">download</span>
                    </a>
                </div>

                <div
                    class="group relative overflow-hidden bg-white rounded-lg p-8 md:p-12 flex flex-col items-center text-center transition-all duration-500 hover:shadow-lg border border-outline/5">
                    <div
                        class="w-16 h-16 mb-6 bg-primary/5 rounded-xl flex items-center justify-center text-primary group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-3xl">picture_as_pdf</span>
                    </div>
                    <h3 class="font-headline-lg text-headline-lg mb-2">Catálogo Negocio</h3>
                    <p class="text-secondary mb-8 max-w-xs text-sm">Soluciones de mobiliario y equipamiento para
                        negocios que
                        buscan eficiencia y durabilidad.</p>
                    <a href="{{ $company->catalog_negocio_path ? asset('storage/' . $company->catalog_negocio_path) : '#' }}"
                        @if ($company->catalog_negocio_path) target="_blank" @else onclick="alert('El catálogo de Negocio estará disponible muy pronto. Por favor, contáctanos para enviarte información.'); return false;" @endif
                        class="flex items-center gap-2 px-8 py-3 bg-primary text-white font-bold rounded text-xs uppercase tracking-widest hover:bg-primary-container transition-colors">
                        <span>Descargar PDF</span>
                        <span class="material-symbols-outlined text-sm">download</span>
                    </a>
                </div>
            </div>
    </section>

    <!-- Filter Drawer Overlay -->
    <div id="drawer-overlay"
        class="fixed inset-0 bg-on-surface/20 backdrop-blur-sm z-[60] hidden transition-opacity duration-300 opacity-0"
        onclick="toggleDrawer(false)"></div>

    <!-- Filter Drawer -->
    <div id="filter-drawer"
        class="fixed top-0 right-0 h-full w-full md:w-96 bg-surface shadow-xl z-[70] translate-x-full transition-transform duration-300 overflow-y-auto custom-scrollbar border-l border-outline/10">
        <div class="p-8">
            <div class="flex justify-between items-center mb-12">
                <h2 class="font-headline-lg text-headline-lg">Filtros</h2>
                <button onclick="toggleDrawer(false)"
                    class="material-symbols-outlined text-secondary hover:text-primary transition-colors">close</button>
            </div>

            <form action="{{ route('tienda') }}" method="GET" class="space-y-10">
                @if (request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif

                <!-- Type Filter -->
                <div class="space-y-4">
                    <span class="text-label-sm uppercase tracking-widest text-secondary block">Línea de Negocio</span>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input name="type" type="radio" value="" {{ !request('type') ? 'checked' : '' }}
                                class="w-5 h-5 border-outline rounded-full text-primary focus:ring-primary">
                            <span class="text-body-md group-hover:text-primary transition-colors">Todas las líneas</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input name="type" type="radio" value="hogar"
                                {{ request('type') === 'hogar' ? 'checked' : '' }}
                                class="w-5 h-5 border-outline rounded-full text-primary focus:ring-primary">
                            <span class="text-body-md group-hover:text-primary transition-colors">Hogar</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input name="type" type="radio" value="oficina"
                                {{ request('type') === 'oficina' ? 'checked' : '' }}
                                class="w-5 h-5 border-outline rounded-full text-primary focus:ring-primary">
                            <span class="text-body-md group-hover:text-primary transition-colors">Oficina</span>
                        </label>
                    </div>
                </div>

                <!-- Category Filter -->
                <div class="space-y-4">
                    <span class="text-label-sm uppercase tracking-widest text-secondary block">Categorías</span>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input name="category" type="radio" value=""
                                {{ !request('category') ? 'checked' : '' }}
                                class="w-5 h-5 border-outline rounded-full text-primary focus:ring-primary">
                            <span class="text-body-md group-hover:text-primary transition-colors">Todas las
                                categorías</span>
                        </label>
                        @foreach ($categories as $category)
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input name="category" type="radio" value="{{ $category->slug }}"
                                    {{ request('category') === $category->slug ? 'checked' : '' }}
                                    class="w-5 h-5 border-outline rounded-full text-primary focus:ring-primary">
                                <span
                                    class="text-body-md group-hover:text-primary transition-colors">{{ $category->name }}
                                    ({{ ucfirst($category->type) }})
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="pt-8 border-t border-surface-variant">
                    <button type="submit"
                        class="w-full py-4 bg-primary text-white font-bold text-label-sm uppercase tracking-widest hover:bg-on-surface transition-colors rounded">Aplicar
                        Filtros</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function rotateCarousel(id, direction) {
            const container = document.getElementById(id);
            if (!container) return;
            const slides = container.children.length;

            let currentIndex = parseInt(container.getAttribute('data-index') || 0);
            currentIndex += direction;

            if (currentIndex < 0) currentIndex = slides - 1;
            if (currentIndex >= slides) currentIndex = 0;

            container.setAttribute('data-index', currentIndex);
            container.style.transform = `translateX(-${currentIndex * (100 / slides)}%)`;
        }

        // Drawer triggers
        function toggleDrawer(open) {
            const overlay = document.getElementById('drawer-overlay');
            const drawer = document.getElementById('filter-drawer');

            if (open) {
                overlay.classList.remove('hidden');
                drawer.classList.remove('translate-x-full');
                setTimeout(() => {
                    overlay.classList.add('opacity-100');
                    overlay.classList.remove('opacity-0');
                }, 50);
            } else {
                overlay.classList.add('opacity-0');
                overlay.classList.remove('opacity-100');
                drawer.classList.add('translate-x-full');
                setTimeout(() => {
                    overlay.classList.add('hidden');
                }, 300);
            }
        }
    </script>
@endsection

@section('styles')
    <style>
        .product-carousel-btn {
            opacity: 0;
            transition: opacity 0.3s;
        }

        .product-card:hover .product-carousel-btn {
            opacity: 1;
        }
    </style>
@endsection
