@extends('frontend.layouts.app')

@section('title', $product->name . ' | Yira Inversiones')

@section('content')
<main class="pt-12 pb-24 max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
    <!-- Breadcrumb -->
    <nav class="mb-12 flex items-center gap-2 text-secondary font-label-sm text-label-sm uppercase tracking-widest">
        <a class="hover:text-primary transition-colors" href="{{ route('home') }}">Inicio</a>
        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
        <a class="hover:text-primary transition-colors" href="{{ route('tienda') }}">Tienda</a>
        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
        <a class="hover:text-primary transition-colors" href="{{ route('tienda', ['category' => $product->category->slug]) }}">{{ $product->category->name }}</a>
        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
        <span class="text-on-surface">{{ $product->name }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
        <!-- Left: Product Gallery -->
        <div class="lg:col-span-7 space-y-6">
            @php
                $mediaItems = $product->getMedia('products');
                $hasImages = $mediaItems->count() > 0;
                $firstImageUrl = $hasImages ? $mediaItems[0]->getUrl() : 'https://placehold.co/800x600?text=Sin+Imagen';
            @endphp
            <div class="relative group aspect-[4/3] bg-surface-container-low overflow-hidden rounded shadow-sm">
                <!-- Navigation Arrows -->
                @if($hasImages && $mediaItems->count() > 1)
                    <button onclick="prevImage()" class="absolute left-4 top-1/2 -translate-y-1/2 z-10 bg-white/90 p-3 rounded-full shadow-md hover:bg-white transition-all opacity-0 group-hover:opacity-100 active:scale-90">
                        <span class="material-symbols-outlined text-on-surface">arrow_back</span>
                    </button>
                    <button onclick="nextImage()" class="absolute right-4 top-1/2 -translate-y-1/2 z-10 bg-white/90 p-3 rounded-full shadow-md hover:bg-white transition-all opacity-0 group-hover:opacity-100 active:scale-90">
                        <span class="material-symbols-outlined text-on-surface">arrow_forward</span>
                    </button>
                @endif
                <!-- Main Image -->
                <div id="main-image" class="w-full h-full bg-cover bg-center transition-transform duration-700 hover:scale-105" style="background-image: url('{{ $firstImageUrl }}')">
                </div>
                <!-- Pagination Indicators -->
                @if($hasImages && $mediaItems->count() > 1)
                    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-3">
                        @foreach($mediaItems as $index => $media)
                            <div class="gallery-dot w-2 h-2 rounded-full {{ $index === 0 ? 'bg-primary' : 'bg-white/60' }}"></div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Thumbnails -->
            @if($hasImages && $mediaItems->count() > 1)
                <div class="flex gap-4 overflow-x-auto hide-scroll pb-2">
                    @foreach($mediaItems as $index => $media)
                        <div onclick="updateGallery({{ $index }})" class="thumb-btn flex-shrink-0 w-24 h-24 bg-cover bg-center rounded cursor-pointer hover:opacity-80 transition-opacity {{ $index === 0 ? 'active-thumb' : '' }}" style="background-image: url('{{ $media->getUrl() }}')"></div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Right: Product Info -->
        <div class="lg:col-span-5 flex flex-col">
            <div class="mb-2">
                <span class="font-label-sm text-label-sm text-primary tracking-widest uppercase">{{ $product->category->name }} ({{ ucfirst($product->category->type) }})</span>
            </div>
            <h1 class="font-headline-xl text-headline-xl text-on-surface mb-4">{{ $product->name }}</h1>
            <p class="font-headline-lg text-headline-lg text-primary mb-8">
                @if($product->promo_price)
                    S/. {{ number_format($product->promo_price, 2) }}
                    <span class="text-secondary text-body-md line-through ml-2 font-normal">S/. {{ number_format($product->price, 2) }}</span>
                    @if($product->promo_label)
                        <span class="bg-primary text-white text-[10px] px-2 py-1 font-bold uppercase ml-2 rounded">{{ $product->promo_label }}</span>
                    @endif
                @elseif($product->price)
                    S/. {{ number_format($product->price, 2) }}
                @else
                    Consultar Precio
                @endif
            </p>
            <div class="space-y-6 mb-10">
                <div class="font-body-lg text-body-lg text-secondary leading-relaxed">
                    {!! $product->description !!}
                </div>
                
                @if($product->delivery_time)
                    <div class="flex items-center gap-4 py-4 border-y border-surface-container">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-[20px]">local_shipping</span>
                            <span class="font-label-sm text-label-sm text-on-surface">Entrega: {{ $product->delivery_time }}</span>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Color Selector -->
            @if(!empty($product->colors) && is_array($product->colors))
                <div class="mb-10">
                    <span class="font-label-sm text-label-sm text-on-surface uppercase tracking-wider mb-4 block">Acabado / Color Seleccionado</span>
                    <div class="flex flex-wrap gap-4">
                        @foreach($product->colors as $index => $color)
                            <button onclick="selectColor('{{ $color['name'] }}', this)" 
                                    class="color-selector-btn w-10 h-10 rounded-full border border-outline-variant transition-all {{ $index === 0 ? 'ring-2 ring-primary ring-offset-2' : 'hover:ring-2 hover:ring-outline hover:ring-offset-2' }}" 
                                    style="background-color: {{ $color['hex'] }};" 
                                    title="{{ $color['name'] }}">
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Conversion Buttons -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-12">
                <button onclick="addToCart()" class="flex items-center justify-center gap-3 py-5 px-6 bg-secondary text-on-primary font-bold rounded-lg hover:bg-on-background transition-all active:scale-95 shadow-md">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    Agregar al Carrito
                </button>
                <button onclick="consultWhatsApp()" class="flex items-center justify-center gap-3 py-5 px-6 bg-[#25D366] text-white font-bold rounded-lg hover:bg-[#128C7E] transition-all active:scale-95 shadow-md">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">chat</span>
                    Consulta WhatsApp
                </button>
            </div>

            <!-- Tabs/Details Accordion -->
            <div class="border-t border-surface-container">
                <details class="group py-6 border-b border-surface-container" open>
                    <summary class="flex justify-between items-center cursor-pointer list-none">
                        <span class="font-body-md text-body-md font-bold text-on-surface uppercase tracking-wide">Especificaciones Técnicas</span>
                        <span class="material-symbols-outlined group-open:rotate-180 transition-transform">expand_more</span>
                    </summary>
                    <div class="mt-4 space-y-2 text-body-md text-secondary">
                        <p>Para detalles específicos de fabricación o dimensiones personalizadas, contáctese directamente con un asesor.</p>
                    </div>
                </details>
                <details class="group py-6 border-b border-surface-container">
                    <summary class="flex justify-between items-center cursor-pointer list-none">
                        <span class="font-body-md text-body-md font-bold text-on-surface uppercase tracking-wide">Garantía y Calidad</span>
                        <span class="material-symbols-outlined group-open:rotate-180 transition-transform">expand_more</span>
                    </summary>
                    <p class="mt-4 text-body-md text-secondary leading-relaxed">
                        Todos nuestros productos cuentan con garantía contra defectos de fabricación. Usamos madera seleccionada con certificación y acabados de alta resistencia al tráfico.
                    </p>
                </details>
                <details class="group py-6 border-b border-surface-container">
                    <summary class="flex justify-between items-center cursor-pointer list-none">
                        <span class="font-body-md text-body-md font-bold text-on-surface uppercase tracking-wide">Envío e Instalación</span>
                        <span class="material-symbols-outlined group-open:rotate-180 transition-transform">expand_more</span>
                    </summary>
                    <p class="mt-4 text-body-md text-secondary leading-relaxed">
                        El tiempo de entrega estimado es el indicado en la ficha técnica del producto. Hacemos envíos e instalación a domicilio previa coordinación.
                    </p>
                </details>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <section class="mt-32">
            <h2 class="font-headline-lg text-headline-lg text-on-surface mb-12">Complete su Espacio</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-gutter">
                @foreach($relatedProducts as $related)
                    @php
                        $relatedImage = $related->hasMedia('products') 
                            ? $related->getFirstMediaUrl('products') 
                            : 'https://placehold.co/400x500';
                    @endphp
                    <div class="group cursor-pointer" onclick="window.location.href='{{ route('product.detail', $related->slug) }}'">
                        <div class="aspect-square bg-surface-container mb-6 overflow-hidden relative rounded shadow-sm">
                            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110" style="background-image: url('{{ $relatedImage }}')"></div>
                        </div>
                        <h3 class="font-body-md text-body-md font-bold text-on-surface group-hover:underline">{{ $related->name }}</h3>
                        <p class="font-body-md text-body-md text-secondary">
                            @if($related->price)
                                S/. {{ number_format($related->price, 2) }}
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

@section('styles')
<style>
    .active-thumb {
        outline: 2px solid #6c3424;
        outline-offset: 2px;
    }
</style>
@endsection

@section('scripts')
<script>
    // Gallery State & Navigation
    const images = @json($mediaItems->map(fn($m) => $m->getUrl())->toArray());
    if (images.length === 0) {
        images.push('https://placehold.co/800x600?text=Sin+Imagen');
    }
    
    let currentImageIndex = 0;
    
    function updateGallery(index) {
        currentImageIndex = index;
        const mainImage = document.getElementById('main-image');
        mainImage.style.backgroundImage = `url('${images[currentImageIndex]}')`;
        
        // Thumbnails active state
        const thumbs = document.querySelectorAll('.thumb-btn');
        thumbs.forEach((thumb, idx) => {
            if (idx === currentImageIndex) {
                thumb.classList.add('active-thumb');
            } else {
                thumb.classList.remove('active-thumb');
            }
        });
        
        // Dots active state
        const dots = document.querySelectorAll('.gallery-dot');
        dots.forEach((dot, idx) => {
            if (idx === currentImageIndex) {
                dot.classList.remove('bg-white/60');
                dot.classList.add('bg-primary');
            } else {
                dot.classList.remove('bg-primary');
                dot.classList.add('bg-white/60');
            }
        });
    }
    
    function nextImage() {
        let nextIndex = (currentImageIndex + 1) % images.length;
        updateGallery(nextIndex);
    }
    
    function prevImage() {
        let prevIndex = (currentImageIndex - 1 + images.length) % images.length;
        updateGallery(prevIndex);
    }

    // Details Accordion Behavior (Only one open at a time)
    document.querySelectorAll('details').forEach((detail) => {
        detail.addEventListener('click', (e) => {
            if (detail.hasAttribute('open')) return;
            document.querySelectorAll('details').forEach((other) => {
                if (other !== detail) other.removeAttribute('open');
            });
        });
    });

    // Color Selector State
    @if(!empty($product->colors) && is_array($product->colors))
        let selectedColor = "{{ $product->colors[0]['name'] ?? 'Estándar' }}";
    @else
        let selectedColor = "Estándar";
    @endif

    function selectColor(colorName, btn) {
        selectedColor = colorName;
        const buttons = document.querySelectorAll('.color-selector-btn');
        buttons.forEach(b => {
            b.classList.remove('ring-2', 'ring-primary', 'ring-offset-2');
        });
        btn.classList.add('ring-2', 'ring-primary', 'ring-offset-2');
    }

    // Add to Cart
    function addToCart() {
        const id = {{ $product->id }};
        const name = "{{ addslashes($product->name) }}";
        const price = {{ $product->promo_price ?? $product->price ?? 0 }};
        const mainImage = "{{ $firstImageUrl }}";
        
        Cart.addItem(id, name, price, mainImage, selectedColor);
    }

    // Consult WhatsApp with Color Metadata
    function consultWhatsApp() {
        const productName = "{{ rawurlencode($product->name) }}";
        const colorText = encodeURIComponent(selectedColor);
        const message = `Hola {{ addslashes($company->name) }}, deseo consultar por el producto ${productName} en color ${colorText}.`;
        const whatsappUrl = `https://wa.me/{{ $company->whatsapp_phone ?? '51987654321' }}?text=${encodeURIComponent(message)}`;
        window.open(whatsappUrl, '_blank');
    }
</script>
@endsection
