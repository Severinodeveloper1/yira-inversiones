{{--
  Partial: _page_hero.blade.php
  Variables:
    $pageBanners    → Collection<PageBanner> (desde la BD, puede ser vacía)
    $fallbackBg     → string|null  (URL de imagen de respaldo si no hay banners)
    $defaultTitle   → string|null  (título por defecto en el fallback)
    $defaultSubtitle → string|null (subtítulo por defecto en el fallback)
--}}
@php
    $pageBanners   = $pageBanners ?? collect();
    $bannerCount   = $pageBanners->count();
    $hasFallback   = filled($fallbackBg ?? '') || filled($defaultTitle ?? '') || filled($defaultSubtitle ?? '');
    $heroId        = 'page-hero-' . Str::random(6);
    $sliderId      = 'slider-' . Str::random(6);
@endphp

@if($bannerCount === 0 && !$hasFallback)
    {{-- Sin nada configurado: no se renderiza nada --}}
@else
<section class="relative h-[40vh] sm:h-[45vh] md:h-[50vh] w-full overflow-hidden bg-on-surface" id="{{ $heroId }}">

    @if($bannerCount > 0)
        {{-- ─── SLIDER / BANNER DESDE BD ─────────────────────────────── --}}
        <div class="flex h-full" id="{{ $sliderId }}"
             style="width: {{ $bannerCount * 100 }}%; transition: transform 0.6s cubic-bezier(0.25,0.46,0.45,0.94);">
            @foreach($pageBanners as $banner)
                <div class="h-full relative flex-shrink-0" style="width: {{ 100 / $bannerCount }}%;">
                    {{-- Imagen --}}
                    @if($banner->image_path)
                        <img
                            src="{{ asset('storage/' . $banner->image_path) }}"
                            alt="{{ $banner->title ?? 'Banner' }}"
                            class="absolute inset-0 w-full h-full object-cover object-center"
                            loading="lazy"
                        >
                    @else
                        <div class="absolute inset-0 bg-gradient-to-br from-on-surface via-surface-container to-on-surface-variant"></div>
                    @endif

                    {{-- Overlay + texto solo si hay contenido --}}
                    @if($banner->hasText())
                        <div class="absolute inset-0 bg-on-surface/55"></div>
                        <div class="relative h-full max-w-container-max mx-auto px-4 sm:px-8 md:px-margin-desktop flex flex-col justify-center items-start">
                            @if($banner->subtitle)
                                <span class="inline-block px-3 md:px-4 py-1 mb-3 md:mb-5 bg-primary text-white text-[10px] sm:text-xs font-semibold tracking-widest uppercase rounded-sm">
                                    {{ $banner->subtitle }}
                                </span>
                            @endif
                            @if($banner->title)
                                <h1 class="text-xl sm:text-2xl md:font-headline-xl md:text-headline-xl text-white max-w-xs sm:max-w-md md:max-w-2xl leading-tight font-bold">
                                    {{ $banner->title }}
                                </h1>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        @if($bannerCount > 1)
            {{-- Flechas de navegación --}}
            <button
                class="absolute left-3 md:left-6 top-1/2 -translate-y-1/2 z-20 w-9 h-9 md:w-11 md:h-11 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white hover:bg-white/40 active:scale-95 transition-all"
                onclick="movePageHeroRel('{{ $sliderId }}', '{{ $heroId }}', -1, {{ $bannerCount }})"
                aria-label="Anterior"
            >
                <span class="material-symbols-outlined text-[20px]">chevron_left</span>
            </button>
            <button
                class="absolute right-3 md:right-6 top-1/2 -translate-y-1/2 z-20 w-9 h-9 md:w-11 md:h-11 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white hover:bg-white/40 active:scale-95 transition-all"
                onclick="movePageHeroRel('{{ $sliderId }}', '{{ $heroId }}', 1, {{ $bannerCount }})"
                aria-label="Siguiente"
            >
                <span class="material-symbols-outlined text-[20px]">chevron_right</span>
            </button>

            {{-- Dots de navegación --}}
            <div class="absolute bottom-4 md:bottom-6 left-1/2 -translate-x-1/2 flex gap-2 md:gap-3 z-20">
                @foreach($pageBanners as $idx => $banner)
                    <button
                        class="page-hero-dot-{{ $heroId }} h-[3px] rounded-full transition-all duration-300 {{ $idx === 0 ? 'bg-primary w-8 md:w-10' : 'bg-white/40 w-5 md:w-6' }}"
                        onclick="movePageHero('{{ $sliderId }}', '{{ $heroId }}', {{ $idx }}, {{ $bannerCount }})"
                        aria-label="Ir al banner {{ $idx + 1 }}"
                    ></button>
                @endforeach
            </div>
        @endif

    @else
        {{-- ─── FALLBACK ESTÁTICO ─────────────────────────────────────── --}}
        @if(filled($fallbackBg ?? ''))
            <img
                src="{{ $fallbackBg }}"
                alt="{{ $defaultTitle ?? 'Banner' }}"
                class="absolute inset-0 w-full h-full object-cover object-center"
                loading="lazy"
            >
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-on-surface via-surface-container to-on-surface-variant"></div>
        @endif

        @if(filled($defaultTitle ?? '') || filled($defaultSubtitle ?? ''))
            <div class="absolute inset-0 bg-on-surface/55"></div>
            <div class="relative h-full max-w-container-max mx-auto px-4 sm:px-8 md:px-margin-desktop flex flex-col justify-center items-start">
                @if(filled($defaultSubtitle ?? ''))
                    <span class="inline-block px-3 md:px-4 py-1 mb-3 md:mb-5 bg-primary text-white text-[10px] sm:text-xs font-semibold tracking-widest uppercase rounded-sm">
                        {{ $defaultSubtitle }}
                    </span>
                @endif
                @if(filled($defaultTitle ?? ''))
                    <h1 class="text-xl sm:text-2xl md:font-headline-xl md:text-headline-xl text-white max-w-xs sm:max-w-md md:max-w-2xl leading-tight font-bold">
                        {{ $defaultTitle }}
                    </h1>
                @endif
            </div>
        @endif
    @endif
</section>

@if($bannerCount > 1)
<script>
(function() {
    const sliderId  = '{{ $sliderId }}';
    const heroId    = '{{ $heroId }}';
    const count     = {{ $bannerCount }};
    let currentIdx  = 0;
    let autoTimer   = null;

    function movePageHero(sId, hId, idx, n) {
        currentIdx = ((idx % n) + n) % n;
        const slider = document.getElementById(sId);
        if (slider) slider.style.transform = `translateX(-${currentIdx * (100 / n)}%)`;

        document.querySelectorAll(`.page-hero-dot-${hId}`).forEach((dot, i) => {
            const active = i === currentIdx;
            dot.classList.toggle('bg-primary', active);
            dot.classList.toggle('bg-white/40', !active);
            dot.style.width = active ? (window.innerWidth >= 768 ? '40px' : '32px') : (window.innerWidth >= 768 ? '24px' : '20px');
        });
    }

    function movePageHeroRel(sId, hId, dir, n) {
        movePageHero(sId, hId, currentIdx + dir, n);
        resetAutoSlide();
    }

    function resetAutoSlide() {
        clearInterval(autoTimer);
        autoTimer = setInterval(() => movePageHero(sliderId, heroId, currentIdx + 1, count), 5000);
    }

    // Exponer globalmente para los onclick inline
    window.movePageHero    = window.movePageHero    || {};
    window.movePageHeroRel = window.movePageHeroRel || {};
    window.movePageHero    = movePageHero;
    window.movePageHeroRel = movePageHeroRel;

    // Touch/swipe
    (function initSwipe() {
        const section = document.getElementById(heroId);
        if (!section) return;
        let startX = 0;
        section.addEventListener('touchstart', e => { startX = e.touches[0].clientX; }, { passive: true });
        section.addEventListener('touchend', e => {
            const diff = startX - e.changedTouches[0].clientX;
            if (Math.abs(diff) > 50) {
                movePageHeroRel(sliderId, heroId, diff > 0 ? 1 : -1, count);
            }
        }, { passive: true });
    })();

    resetAutoSlide();
})();
</script>
@endif
@endif
