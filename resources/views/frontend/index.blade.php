@extends('frontend.layouts.app')

@section('title', 'Yira Inversiones | Arquitectura y Confort')

@section('content')
    <!-- Hero Slider -->
    <section class="relative w-full h-[80vh] overflow-hidden bg-surface-container-low">
        @if ($banners->count() > 0)
            <div class="flex h-full slider-container" id="hero-slider"
                style="width: {{ $banners->count() * 100 }}%; transform: translateX(0%);">
                @foreach ($banners as $banner)
                    <div class="h-full relative flex items-center" style="width: {{ 100 / $banners->count() }}%;">
                        <div class="absolute inset-0 z-0">
                            @if ($banner->mobile_image_path)
                                <!-- Imagen para Móviles (Pantallas menores a 768px) -->
                                <img alt="{{ $banner->title ?? 'Banner' }}" class="w-full h-full object-cover md:hidden"
                                    src="{{ asset('storage/' . $banner->mobile_image_path) }}">
                                <!-- Imagen para Escritorio (Pantallas de 768px a más) -->
                                <img alt="{{ $banner->title ?? 'Banner' }}" class="w-full h-full object-cover hidden md:block"
                                    src="{{ asset('storage/' . $banner->image_path) }}">
                            @else
                                <img alt="{{ $banner->title ?? 'Banner' }}" class="w-full h-full object-cover"
                                    src="{{ asset('storage/' . $banner->image_path) }}">
                            @endif
                            @if ($banner->title || $banner->button_text)
                                <div class="absolute inset-0 bg-gradient-to-r from-surface/60 to-transparent"></div>
                            @endif
                        </div>
                        @if ($banner->title || $banner->button_text)
                            <div class="relative z-10 px-margin-desktop max-w-container-max mx-auto w-full">
                                <div class="max-w-xl animate-fade-in-up">
                                    @if ($banner->title)
                                        <h1 class="font-headline-xl text-headline-xl text-on-surface mb-6">
                                            {{ $banner->title }}</h1>
                                    @endif
                                    @if ($banner->button_text)
                                        <a href="{{ $banner->button_url ?? '#' }}"
                                            class="inline-block bg-secondary px-8 py-4 text-white font-label-sm text-label-sm uppercase tracking-widest hover:bg-primary transition-all duration-300 active:scale-95 rounded">
                                            {{ $banner->button_text }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
            @if ($banners->count() > 1)
                <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex gap-4 z-20">
                    @foreach ($banners as $index => $banner)
                        <button
                            class="slider-dot h-1 transition-all duration-300 {{ $index === 0 ? 'bg-primary w-12' : 'bg-secondary/30 w-8' }}"
                            onclick="moveSlider({{ $index }}, {{ $banners->count() }})"></button>
                    @endforeach
                </div>
            @endif
        @else
            <!-- Fallback static banner matching HTML design if no database records exist -->
            <div class="flex w-[200%] h-full slider-container" id="hero-slider" style="transform: translateX(0%);">
                <div class="w-1/2 h-full relative flex items-center">
                    <div class="absolute inset-0 z-0">
                        <img alt="Ergonomic Office Banner" class="w-full h-full object-cover"
                            src="https://lh3.googleusercontent.com/aida/AP1WRLu7NNfM3MLBq3cembPtwaLermhly3rUbyGMlH8z7ZcLSR5YfwjKr3Urcb5s6yFqzEpWYWMYiuDLlLPk54VVxfkCwZnR3HEkbmJzNOf3LoCoavOCrOGO1ifOSXKsj8YCECEpeOeU1lX06Lon7JH88nK5OASpKSx-XvDGuOnWeBPv5I6qpj4JcAUCXUFXzuBDG68U94cn6Z1ug1dR4wOqgASPOYHJdeAAL2inP6y4QRTzZHUE2KhnKFKPE_M">
                        <div class="absolute inset-0 bg-gradient-to-r from-surface/60 to-transparent"></div>
                    </div>
                    <div class="relative z-10 px-margin-desktop max-w-container-max mx-auto w-full">
                        <div class="max-w-xl animate-fade-in-up">
                            <span
                                class="font-label-sm text-label-sm text-primary uppercase tracking-widest mb-4 block">Colección
                                2026</span>
                            <h1 class="font-headline-xl text-headline-xl text-on-surface mb-6">Regresa a Clases con
                                Ergonomía y Confort</h1>
                            <p class="font-body-lg text-body-lg text-secondary mb-10 max-w-md">Diseños pensados para
                                maximizar tu productividad y bienestar durante las largas jornadas de estudio.</p>
                            <a href="{{ route('tienda', ['type' => 'oficina']) }}"
                                class="inline-block bg-secondary px-8 py-4 text-white font-label-sm text-label-sm uppercase tracking-widest hover:bg-primary transition-all duration-300 active:scale-95 rounded">
                                Ver Colección Oficina
                            </a>
                        </div>
                    </div>
                </div>
                <div class="w-1/2 h-full relative flex items-center">
                    <div class="absolute inset-0 z-0">
                        <img alt="Mother's Day Sofa Promotion" class="w-full h-full object-cover"
                            src="https://lh3.googleusercontent.com/aida/AP1WRLsVyyc4Jv1GKi8g9G_9Xjhl0aVcrm3Bxhs-jzOAL-gLSWPPA3sDpnfX6VQM4cMTwx8COisqBdLuRJ8gfC0smjOTKenhDLpbktyBZNEUzCyP3xlfCXkDtseUYlzYKUagF4LpJVXWHFKugFCe3TreIjbkIB_kd7kYaTu_agUfETR82Plq-tAdMCwhsMX3oPIuLLq5UpP8atAYkZjbmryNzUxv0hvejCAvQwr9NiE1twzEjIfxP08ObdjMcw">
                        <div class="absolute inset-0 bg-gradient-to-l from-surface/40 to-transparent"></div>
                    </div>
                    <div
                        class="relative z-10 px-margin-desktop max-w-container-max mx-auto w-full text-right flex flex-col items-end">
                        <div class="max-w-xl">
                            <span
                                class="font-label-sm text-label-sm text-primary uppercase tracking-widest mb-4 block">Especial
                                Hogar</span>
                            <h2 class="font-headline-xl text-headline-xl text-on-surface mb-6">Un Regalo para el Hogar:
                                Elegancia Atemporal</h2>
                            <p class="font-body-lg text-body-lg text-secondary mb-10 max-w-md ml-auto">Transforma su espacio
                                favorito con piezas de diseño exclusivo y confort inigualable.</p>
                            <a href="{{ route('tienda', ['type' => 'hogar']) }}"
                                class="inline-block bg-secondary px-8 py-4 text-white font-label-sm text-label-sm uppercase tracking-widest hover:bg-primary transition-all duration-300 active:scale-95 rounded">
                                Explorar Sofás
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex gap-4 z-20">
                <button class="slider-dot h-1 transition-all duration-300 bg-primary w-12"
                    onclick="moveSlider(0, 2)"></button>
                <button class="slider-dot h-1 transition-all duration-300 hover:bg-secondary/60 bg-secondary/30 w-8"
                    onclick="moveSlider(1, 2)"></button>
            </div>
        @endif
    </section>

    <!-- Categories Section: Smaller Cards + Horizontal Scroll -->
    <section class="py-16 bg-surface-container-low overflow-hidden">
        <div class="px-margin-desktop max-w-container-max mx-auto mb-8 flex justify-between items-end">
            <div>
                <span
                    class="font-label-sm text-label-sm text-primary uppercase tracking-widest mb-2 block">Categorías</span>
                <h2 class="font-headline-lg text-headline-lg text-on-surface">Explora por Estilo</h2>
            </div>
            <div class="flex gap-2">
                <button class="p-2 rounded-full border border-outline/20 hover:bg-white transition-colors"
                    onclick="scrollCategories(-1)">
                    <span class="material-symbols-outlined">chevron_left</span>
                </button>
                <button class="p-2 rounded-full border border-outline/20 hover:bg-white transition-colors"
                    onclick="scrollCategories(1)">
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>
            </div>
        </div>
        <div class="px-margin-desktop max-w-container-max mx-auto">
            <div class="flex gap-6 overflow-x-auto hide-scroll pb-8 snap-x snap-mandatory" id="category-scroll">
                @if ($categories->count() > 0)
                    @foreach ($categories as $category)
                        <a href="{{ route('tienda', ['category' => $category->slug]) }}"
                            class="flex-shrink-0 w-72 aspect-[3/4] group relative overflow-hidden rounded-lg snap-start block">
                            <img alt="{{ $category->name }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                src="{{ $category->image_path ? asset('storage/' . $category->image_path) : 'https://placehold.co/300x400' }}">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent flex flex-col justify-end p-6 group-hover:from-black/90 group-hover:via-black/40 transition-all duration-500">
                                <span
                                    class="text-white/70 text-xs font-semibold uppercase tracking-wider mb-1 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
                                    {{ ucfirst($category->type) }}
                                </span>
                                <span
                                    class="text-white font-headline-lg text-body-lg font-bold transform translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
                                    {{ $category->name }}
                                </span>
                                {{-- <div
                                    class="flex items-center gap-1.5 text-primary text-xs font-bold opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-500 mt-2">
                                    <span>VER CATEGORÍA</span>
                                    <span class="material-symbols-outlined text-xs font-bold">arrow_forward</span>
                                </div> --}}
                            </div>
                        </a>
                    @endforeach
                @else
                    <!-- Fallback categories -->
                    <a href="{{ route('tienda', ['type' => 'oficina']) }}"
                        class="flex-shrink-0 w-72 aspect-[3/4] group relative overflow-hidden rounded-lg snap-start block">
                        <img alt="Mobiliario Oficina"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            src="https://lh3.googleusercontent.com/aida/AP1WRLtSE3TB-5aqg1Yzq3JRqVyhQ2Em7vlMj7uY5EYUtIlNER-KZFDuZi9a2iVlF5lvoyZByn2m-dA5lwF8MnEo1m4uG_HB8zANArN6awiS6l0M2SdfZOwtRxgMPgEK7K7B3zcsk4lZZoTfZftxgFwvaS2ApJOvJChNB9gKPe9hjlvSGnV2Jj2UCfo3X1G3DK90Dy8Y75tYhyZ3NAaI7NYFaN55fYL9fQq38Z6HChHMS-D4_JBxtOgpUgyRYS4">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent flex flex-col justify-end p-6 group-hover:from-black/90 group-hover:via-black/40 transition-all duration-500">
                            <span
                                class="text-white/70 text-xs font-semibold uppercase tracking-wider mb-1 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
                                Oficina
                            </span>
                            <span
                                class="text-white font-headline-lg text-body-lg font-bold transform translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
                                Oficina Ejecutiva
                            </span>
                            {{-- <div class="flex items-center gap-1.5 text-primary text-xs font-bold opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-500 mt-2">
                                <span>VER CATEGORÍA</span>
                                <span class="material-symbols-outlined text-xs font-bold">arrow_forward</span>
                            </div> --}}
                        </div>
                    </a>
                    <a href="{{ route('tienda', ['type' => 'hogar']) }}"
                        class="flex-shrink-0 w-72 aspect-[3/4] group relative overflow-hidden rounded-lg snap-start block">
                        <img alt="Mobiliario Hogar"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            src="https://lh3.googleusercontent.com/aida/AP1WRLs0NmaJeLTYqrTAhSV2PlT4eh4CEcNjUTjlqDq7iB8TkLlyVno1p9Usn37pVWv2DRZKFl1OgOMik0UOGL_T53whPHK8qIUWom8B6MtvZSMR7y3uYgKVTm1yvISuiNA9HWB2o8NfgORK2CCJgJjaxbv9EqeWDGUZkMdu8EGojxPe3TccgvcQL6xPdkJe9d_H74LIxM6dU9ZiUlCO0KIgTJh3jnK-wsxzvGhXQRy5ymQfdIcQ6PG0OfQZOg">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent flex flex-col justify-end p-6 group-hover:from-black/90 group-hover:via-black/40 transition-all duration-500">
                            <span
                                class="text-white/70 text-xs font-semibold uppercase tracking-wider mb-1 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
                                Hogar
                            </span>
                            <span
                                class="text-white font-headline-lg text-body-lg font-bold transform translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
                                Sala &amp; Confort
                            </span>
                            <div
                                class="flex items-center gap-1.5 text-primary text-xs font-bold opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-500 mt-2">
                                <span>VER CATEGORÍA</span>
                                <span class="material-symbols-outlined text-xs font-bold">arrow_forward</span>
                            </div>
                        </div>
                    </a>
                @endif
            </div>
        </div>
    </section>

    <!-- Shop Preview / Featured Products -->
    <section class="py-24 px-margin-desktop max-w-container-max mx-auto bg-surface grain-texture relative">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mb-16">
            <div>
                <span
                    class="font-label-sm text-label-sm text-primary uppercase tracking-widest mb-4 block">Destacados</span>
                <h2 class="font-headline-lg text-headline-lg text-on-surface">Diseño para el Confort</h2>
            </div>
            <a class="text-secondary hover:text-primary transition-colors font-label-sm text-label-sm underline underline-offset-4 shrink-0"
                href="{{ route('tienda') }}">VER TODO EL CATÁLOGO</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            @if ($featuredProducts->count() > 0)
                @foreach ($featuredProducts as $product)
                    @php
                        $mainImage = $product->hasMedia('products')
                            ? $product->getFirstMediaUrl('products')
                            : 'https://placehold.co/400x500';
                    @endphp
                    <div class="group">
                        <div
                            class="relative aspect-[4/5] bg-white overflow-hidden mb-6 shadow-sm group-hover:shadow-lg transition-shadow">
                            <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                src="{{ $mainImage }}">
                            <div class="absolute top-4 left-4">
                                <span
                                    class="bg-primary text-white text-[10px] px-3 py-1 font-bold uppercase">{{ $product->category->name }}</span>
                            </div>
                            @if ($product->promo_label)
                                <div
                                    class="absolute top-4 right-4 bg-accent-terracotta text-white text-[10px] font-bold px-3 py-1 uppercase rounded z-10">
                                    {{ $product->promo_label }}
                                </div>
                            @endif
                            <button
                                onclick="Cart.addItem({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->promo_price ?? ($product->price ?? 0) }}, '{{ $mainImage }}')"
                                class="absolute bottom-0 left-0 w-full bg-secondary text-white py-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300 flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-[18px]">shopping_cart</span>
                                AÑADIR AL CARRITO
                            </button>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('product.detail', $product->slug) }}"
                                class="font-body-lg text-body-lg text-on-surface font-semibold mb-1 block hover:underline">
                                {{ $product->name }}
                            </a>
                            <p class="text-primary font-bold">
                                @if ($product->promo_price)
                                    S/. {{ number_format($product->promo_price, 2) }}
                                    <span class="text-secondary text-xs line-through ml-2 font-normal">S/.
                                        {{ number_format($product->price, 2) }}</span>
                                @elseif($product->price)
                                    S/. {{ number_format($product->price, 2) }}
                                @else
                                    Consultar Precio
                                @endif
                            </p>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Fallback products -->
                <div class="group text-center py-8 col-span-3">
                    <p class="text-secondary mb-4">No hay productos destacados en la base de datos.</p>
                    <a href="{{ route('tienda') }}" class="inline-block bg-primary text-white px-6 py-2 rounded">Ir a la
                        Tienda</a>
                </div>
            @endif
        </div>
    </section>

    @if (isset($promoProducts) && $promoProducts->count() > 0)
        <!-- Special Promotions Section -->
        <section
            class="py-24 px-margin-desktop max-w-container-max mx-auto bg-surface-container-low relative rounded-lg border border-outline/5 my-12">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mb-16">
                <div>
                    <span
                        class="font-label-sm text-label-sm text-primary uppercase tracking-widest mb-4 block">Promociones</span>
                    <h2 class="font-headline-lg text-headline-lg text-on-surface">Ofertas Especiales de Temporada</h2>
                </div>
                <a class="text-secondary hover:text-primary transition-colors font-label-sm text-label-sm underline underline-offset-4 shrink-0"
                    href="{{ route('tienda') }}">VER TODO EL CATÁLOGO</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($promoProducts as $product)
                    @php
                        $mainImage = $product->hasMedia('products')
                            ? $product->getFirstMediaUrl('products')
                            : 'https://placehold.co/400x500';
                    @endphp
                    <div class="group bg-white p-4 rounded shadow-sm hover:shadow-md transition-shadow">
                        <div class="relative aspect-[4/5] bg-white overflow-hidden mb-6 rounded">
                            <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                src="{{ $mainImage }}">
                            @if ($product->promo_label)
                                <div
                                    class="absolute top-2 right-2 bg-accent-terracotta text-white text-[9px] font-bold px-2 py-1 uppercase rounded z-10">
                                    {{ $product->promo_label }}
                                </div>
                            @endif
                            <button
                                onclick="Cart.addItem({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->promo_price ?? ($product->price ?? 0) }}, '{{ $mainImage }}')"
                                class="absolute bottom-0 left-0 w-full bg-secondary text-white py-3 translate-y-full group-hover:translate-y-0 transition-transform duration-300 flex items-center justify-center gap-2 text-xs font-bold uppercase tracking-wider rounded-b">
                                <span class="material-symbols-outlined text-[16px]">shopping_cart</span>
                                AÑADIR
                            </button>
                        </div>
                        <div class="text-center">
                            <span
                                class="text-secondary text-[10px] uppercase font-bold tracking-widest">{{ $product->category->name }}</span>
                            <a href="{{ route('product.detail', $product->slug) }}"
                                class="font-bold text-body-md text-on-surface mb-1 block hover:underline line-clamp-1 mt-1">
                                {{ $product->name }}
                            </a>
                            <p class="text-primary font-bold">
                                S/. {{ number_format($product->promo_price, 2) }}
                                <span class="text-secondary text-xs line-through ml-2 font-normal">S/.
                                    {{ number_format($product->price, 2) }}</span>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    <!-- Craftsmanship Section -->
    <section class="py-32 bg-white relative overflow-hidden">
        <div class="px-margin-desktop max-w-container-max mx-auto grid grid-cols-1 md:grid-cols-12 items-center gap-16">
            <div class="md:col-span-5 z-10">
                <span class="font-label-sm text-label-sm text-primary uppercase tracking-widest mb-6 block">
                    {{ $company->about_workshop_subtitle ?? 'Nuestra Esencia' }}
                </span>
                <h2 class="font-headline-xl text-headline-xl text-on-surface mb-8">
                    {{ $company->about_workshop_title ?? 'Artesanía que define espacios modernos.' }}
                </h2>
                @if ($company->about_workshop_description_1)
                    <p class="font-body-lg text-body-lg text-secondary mb-8">{{ $company->about_workshop_description_1 }}
                    </p>
                @endif
                @if ($company->about_workshop_description_2)
                    <p class="font-body-lg text-body-lg text-secondary mb-12">{{ $company->about_workshop_description_2 }}
                    </p>
                @endif

                {{-- Stats --}}
                @if ($company->about_workshop_stat_1_value || $company->about_workshop_stat_2_value)
                    <div class="grid grid-cols-2 gap-8 mb-12">
                        @if ($company->about_workshop_stat_1_value)
                            <div>
                                <span
                                    class="block font-headline-xl text-headline-xl text-primary mb-1">{{ $company->about_workshop_stat_1_value }}</span>
                                <span
                                    class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-tighter">{{ $company->about_workshop_stat_1_label ?? 'Años de Excelencia' }}</span>
                            </div>
                        @endif
                        @if ($company->about_workshop_stat_2_value)
                            <div>
                                <span
                                    class="block font-headline-xl text-headline-xl text-primary mb-1">{{ $company->about_workshop_stat_2_value }}</span>
                                <span
                                    class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-tighter">{{ $company->about_workshop_stat_2_label ?? 'Fabricación Propia' }}</span>
                            </div>
                        @endif
                    </div>
                @endif

                <a class="inline-flex items-center gap-4 text-primary font-bold hover:gap-6 transition-all group uppercase text-label-sm"
                    href="{{ route('nosotros') }}">
                    Conoce nuestro taller
                    <span class="material-symbols-outlined">arrow_right_alt</span>
                </a>
            </div>
            <div class="md:col-span-7 relative h-[600px]">
                <div class="absolute top-0 right-0 w-[90%] h-full shadow-2xl rounded-lg overflow-hidden">
                    <img alt="Workshop Craftsmanship" class="w-full h-full object-cover"
                        src="{{ $company->about_workshop_image_path ? asset('storage/' . $company->about_workshop_image_path) : 'https://lh3.googleusercontent.com/aida/AP1WRLuJP25Abvdua39V3C2A_S6RNdTBGMb7k5j9CnJH48jHxZ4DVpKnVrsPaYCsbxrwIQnFQxrww_2CguykGLVMWPXaStIVwFRLTf82qwIq8ytjIrTkrMwhJWCeK3AW0RZbxj26mk6Xtka3QVUuj7ubv4j4dUzpd0su03Dn7NA27R4k_HAlPb_NNVAWnQsiippMe7U3gPvZk1pp1U6rmhIBGci1gw5MlK656y67mfHU1eFC_fAFSM6LWt4xSQ' }}">
                </div>
                @if ($company->about_workshop_quote)
                    <div
                        class="absolute -bottom-8 -left-8 w-72 bg-surface p-8 shadow-xl hidden md:block border-l-4 border-primary border border-outline/10 rounded">
                        <p class="italic text-secondary font-body-md">{{ $company->about_workshop_quote }}</p>
                    </div>
                @else
                    {{-- Fallback badge con stat 1 si no hay cita configurada --}}
                    @if ($company->about_workshop_stat_1_value)
                        <div
                            class="absolute -bottom-8 -left-8 w-64 h-64 bg-surface-container-highest flex items-center justify-center p-8 border-4 border-white shadow-xl rounded">
                            <div class="text-center">
                                <span
                                    class="block font-headline-xl text-headline-xl text-primary mb-2">{{ $company->about_workshop_stat_1_value }}</span>
                                <span
                                    class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-tighter">{{ $company->about_workshop_stat_1_label ?? 'Años de Excelencia' }}</span>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </section>

    <!-- Catalogs Section -->
    <section class="py-24 bg-surface-container-low">
        <div class="px-margin-desktop max-w-container-max mx-auto">
            <div class="text-center mb-12">
                <h2 class="font-headline-lg text-headline-lg text-on-surface mb-2">Descarga nuestros Catálogos</h2>
                <p class="text-secondary font-body-md">Explora las colecciones completas en formato digital de alta
                    resolución.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
                <div
                    class="group relative overflow-hidden bg-white rounded-lg p-12 flex flex-col items-center text-center transition-all duration-500 hover:shadow-lg">
                    <div
                        class="w-20 h-20 mb-6 bg-primary/5 rounded-xl flex items-center justify-center text-primary group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-4xl">picture_as_pdf</span>
                    </div>
                    <h3 class="font-headline-lg text-headline-lg mb-2">Catálogo Hogar</h3>
                    <p class="text-secondary mb-8 max-w-xs">Mobiliario de diseño para salas, dormitorios y comedores con
                        estilo contemporáneo.</p>
                    <a href="{{ $company->catalog_home_path ? asset('storage/' . $company->catalog_home_path) : '#' }}"
                        @if ($company->catalog_home_path) target="_blank" @else onclick="showCustomDialog('El catálogo de Hogar estará disponible muy pronto. Por favor, contáctanos para enviarte información.'); return false;" @endif
                        class="flex items-center gap-2 px-8 py-4 bg-primary text-white font-bold rounded hover:bg-primary-container transition-colors">
                        <span>Descargar PDF</span>
                        <span class="material-symbols-outlined">download</span>
                    </a>
                </div>
                <div
                    class="group relative overflow-hidden bg-on-surface rounded-lg p-12 flex flex-col items-center text-center transition-all duration-500">
                    <div
                        class="w-20 h-20 mb-6 bg-white/10 rounded-xl flex items-center justify-center text-primary-fixed-dim group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-4xl">picture_as_pdf</span>
                    </div>
                    <h3 class="font-headline-lg text-headline-lg text-white mb-2">Catálogo Oficina</h3>
                    <p class="text-surface-variant mb-8 max-w-xs">Soluciones ergonómicas y arquitectura de espacios
                        corporativos de alto rendimiento.</p>
                    <a href="{{ $company->catalog_office_path ? asset('storage/' . $company->catalog_office_path) : '#' }}"
                        @if ($company->catalog_office_path) target="_blank" @else onclick="showCustomDialog('El catálogo de Oficina estará disponible muy pronto. Por favor, contáctanos para enviarte información.'); return false;" @endif
                        class="flex items-center gap-2 px-8 py-4 bg-white text-on-surface font-bold rounded hover:bg-primary hover:text-white transition-all">
                        <span>Descargar PDF</span>
                        <span class="material-symbols-outlined">download</span>
                    </a>
                </div>
                <div
                    class="group relative overflow-hidden bg-white rounded-lg p-12 flex flex-col items-center text-center transition-all duration-500 hover:shadow-lg">
                    <div
                        class="w-20 h-20 mb-6 bg-primary/5 rounded-xl flex items-center justify-center text-primary group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-4xl">picture_as_pdf</span>
                    </div>
                    <h3 class="font-headline-lg text-headline-lg mb-2">Catálogo Negocio</h3>
                    <p class="text-secondary mb-8 max-w-xs">Soluciones de mobiliario y equipamiento para negocios que
                        buscan eficiencia y durabilidad.</p>
                    <a href="{{ $company->catalog_negocio_path ? asset('storage/' . $company->catalog_negocio_path) : '#' }}"
                        @if ($company->catalog_negocio_path) target="_blank" @else onclick="showCustomDialog('El catálogo de Negocio estará disponible muy pronto. Por favor, contáctanos para enviarte información.'); return false;" @endif
                        class="flex items-center gap-2 px-8 py-4 bg-primary text-white font-bold rounded hover:bg-primary-container transition-colors">
                        <span>Descargar PDF</span>
                        <span class="material-symbols-outlined">download</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="py-24 bg-surface">

        <div class="px-margin-desktop max-w-container-max mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                <div>
                    <span
                        class="font-label-sm text-label-sm text-primary uppercase tracking-widest mb-4 block">Contacto</span>
                    <h2 class="font-headline-xl text-headline-xl text-on-surface mb-6">¿Tienes un proyecto?</h2>
                    <p class="text-body-lg text-secondary mb-8">Nuestro equipo de arquitectos y diseñadores está listo para
                        asesorarte en la creación de espacios únicos.</p>
                    <div class="space-y-4">
                        @if ($company->phone)
                            <div class="flex items-center gap-4 text-secondary">
                                <span class="material-symbols-outlined text-primary">call</span>
                                <span>{{ $company->phone }}</span>
                            </div>
                        @endif
                        @if ($company->email)
                            <div class="flex items-center gap-4 text-secondary">
                                <span class="material-symbols-outlined text-primary">mail</span>
                                <span>{{ $company->email }}</span>
                            </div>
                        @endif
                        @if ($company->address)
                            <div class="flex items-center gap-4 text-secondary">
                                <span class="material-symbols-outlined text-primary">location_on</span>
                                <span>Showroom &amp; Planta: {{ $company->address }}</span>
                            </div>
                        @endif
                    </div>
                </div>
                <form id="home-contact-form" class="bg-white p-8 rounded-lg shadow-sm border border-outline/10 space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label
                                class="font-label-sm text-label-sm uppercase tracking-wider text-secondary">Nombre</label>
                            <input name="name" required maxlength="100"
                                class="w-full px-4 py-3 bg-surface border border-outline/20 focus:border-primary focus:ring-0 outline-none rounded transition-all"
                                placeholder="Tu nombre" type="text">
                        </div>
                        <div class="space-y-2">
                            <label
                                class="font-label-sm text-label-sm uppercase tracking-wider text-secondary">Correo</label>
                            <input name="email" required
                                class="w-full px-4 py-3 bg-surface border border-outline/20 focus:border-primary focus:ring-0 outline-none rounded transition-all"
                                placeholder="correo@ejemplo.com" type="email">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="font-label-sm text-label-sm uppercase tracking-wider text-secondary">Teléfono</label>
                        <input name="phone" required maxlength="15"
                            class="w-full px-4 py-3 bg-surface border border-outline/20 focus:border-primary focus:ring-0 outline-none rounded transition-all"
                            placeholder="+51 999 999 999" type="text">
                    </div>
                    <div class="space-y-2">
                        <label class="font-label-sm text-label-sm uppercase tracking-wider text-secondary">Mensaje</label>
                        <textarea name="message" required
                            class="w-full px-4 py-3 bg-surface border border-outline/20 focus:border-primary focus:ring-0 outline-none rounded transition-all h-32"
                            placeholder="Cuéntanos sobre tu proyecto..."></textarea>
                    </div>
                    <button type="submit"
                        class="w-full py-4 bg-primary text-white font-bold rounded uppercase tracking-widest hover:bg-primary-container transition-all active:scale-[0.98]">Enviar
                        Mensaje</button>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        function moveSlider(index, count) {
            const slider = document.getElementById('hero-slider');
            const dots = document.querySelectorAll('.slider-dot');

            slider.style.transform = `translateX(-${index * (100 / count)}%)`;

            dots.forEach((dot, i) => {
                if (i === index) {
                    dot.classList.add('bg-primary', 'w-12');
                    dot.classList.remove('bg-secondary/30', 'w-8');
                } else {
                    dot.classList.remove('bg-primary', 'w-12');
                    dot.classList.add('bg-secondary/30', 'w-8');
                }
            });
        }

        function scrollCategories(direction) {
            const container = document.getElementById('category-scroll');
            const scrollAmount = 300;
            container.scrollBy({
                left: direction * scrollAmount,
                behavior: 'smooth'
            });
        }

        // Auto slide hero if there are sliders
        const slider = document.getElementById('hero-slider');
        if (slider) {
            const slidesCount = slider.children.length;
            if (slidesCount > 1) {
                let currentSlide = 0;
                setInterval(() => {
                    currentSlide = (currentSlide + 1) % slidesCount;
                    moveSlider(currentSlide, slidesCount);
                }, 8000);
            }
        }

        // Handle home contact form submit
        document.getElementById('home-contact-form').addEventListener('submit', function(e) {
            e.preventDefault();

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
                showToast('El número de teléfono no es válido (ingrese entre 7 y 15 dígitos sin letras ni símbolos).', 'warning');
                return;
            }
            if (message.length < 10) {
                showToast('El mensaje debe tener al menos 10 caracteres.', 'warning');
                return;
            }

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
                    showToast(data.message || '¡Mensaje enviado con éxito!', 'success');
                    this.reset();
                })
                .catch(err => {
                    console.error(err);
                    const errMsg = err.message || 'Ocurrió un error al enviar el mensaje. Intente de nuevo.';
                    showToast(errMsg, 'error');
                });
        });

        // Restrict phone input to numbers and +
        const homePhoneInput = document.querySelector('#home-contact-form input[name="phone"]');
        if (homePhoneInput) {
            homePhoneInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9+]/g, '');
            });
        }
    </script>
@endsection
