@extends('frontend.layouts.app')

@section('title', 'Nosotros | Yira Inversiones')

@section('content')
<!-- Hero Section -->
<section class="relative h-[80vh] w-full overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img alt="Nuestra Historia" class="w-full h-full object-cover grayscale-[0.2] brightness-[0.8]" src="{{ $company->about_hero_image_path ? asset('storage/' . $company->about_hero_image_path) : 'https://lh3.googleusercontent.com/aida/AP1WRLtZwqlaDFmeHVNuGcJB1sbqvhvchPZlxD-DDFulYi-SN4S2FMlXhTnhOzwlaS010vFitglXV7xSXihGqZu6qs0U52hdH2FDR2qJ_vaGU0g57b-07HHVu67JmnPzkFzevD5faVECb2lTy8EoFtFRoSOCwJ9O1pknQZmvwiaWTGT9NTydgvOTtof5C-yztmSbnSNoWqmHtvQC6CySb3AgcbGmwnKgnNjGcbQ0XMWlt-HS59qiz_BvfRbTsfI' }}">
    </div>
    <div class="absolute inset-0 bg-gradient-to-t from-background/90 via-transparent to-transparent z-10"></div>
    <div class="relative z-20 max-w-container-max mx-auto px-margin-desktop h-full flex flex-col justify-end pb-24">
        <div class="max-w-3xl">
            <span class="font-label-sm text-label-sm uppercase tracking-[0.3em] text-primary mb-4 block">{{ $company->about_hero_subtitle ?? 'Legado y Excelencia' }}</span>
            <h1 class="font-headline-xl text-headline-xl text-on-surface mb-6 perspective-text">{!! nl2br(e($company->about_hero_title ?? "Nuestra Historia:\nArquitectura y Confort")) !!}</h1>
            @if($company->about_hero_description)
                <p class="font-body-lg text-body-lg text-secondary max-w-xl">
                    {{ $company->about_hero_description }}
                </p>
            @endif
        </div>
    </div>
</section>

<!-- The Workshop Section (El Taller) -->
<section class="py-24 bg-surface-container-lowest">
    <div class="max-w-container-max mx-auto px-margin-desktop">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="reveal-on-scroll">
                <span class="font-label-sm text-label-sm uppercase tracking-widest text-primary mb-2 block">{{ $company->about_workshop_subtitle ?? 'El Corazón de la Creación' }}</span>
                <h2 class="font-headline-lg text-headline-lg text-on-surface mb-8">{{ $company->about_workshop_title ?? 'Artesanía de Precisión' }}</h2>
                <div class="space-y-6">
                    @if($company->about_workshop_description_1)
                        <p class="font-body-md text-body-md text-secondary">
                            {{ $company->about_workshop_description_1 }}
                        </p>
                    @endif
                    @if($company->about_workshop_description_2)
                        <p class="font-body-md text-body-md text-secondary">
                            {{ $company->about_workshop_description_2 }}
                        </p>
                    @endif
                    <div class="grid grid-cols-2 gap-8 pt-6">
                        @if($company->about_workshop_stat_1_value)
                            <div>
                                <div class="text-primary font-bold text-headline-lg mb-1">{{ $company->about_workshop_stat_1_value }}</div>
                                <div class="font-label-sm text-label-sm text-secondary uppercase tracking-tighter">{{ $company->about_workshop_stat_1_label ?? 'Años de Maestría' }}</div>
                            </div>
                        @endif
                        @if($company->about_workshop_stat_2_value)
                            <div>
                                <div class="text-primary font-bold text-headline-lg mb-1">{{ $company->about_workshop_stat_2_value }}</div>
                                <div class="font-label-sm text-label-sm text-secondary uppercase tracking-tighter">{{ $company->about_workshop_stat_2_label ?? 'Fabricación Propia' }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="relative reveal-on-scroll">
                <div class="aspect-[4/5] overflow-hidden shadow-2xl">
                    <img alt="Taller Artesanal" class="w-full h-full object-cover transform transition-transform duration-1000 hover:scale-105" src="{{ $company->about_workshop_image_path ? asset('storage/' . $company->about_workshop_image_path) : 'https://lh3.googleusercontent.com/aida/AP1WRLuJP25Abvdua39V3C2A_S6RNdTBGMb7k5j9CnJH48jHxZ4DVpKnVrsPaYCsbxrwIQnFQxrww_2CguykGLVMWPXaStIVwFRLTf82qwIq8ytjIrTkrMwhJWCeK3AW0RZbxj26mk6Xtka3QVUuj7ubv4j4dUzpd0su03Dn7NA27R4k_HAlPb_NNVAWnQsiippMe7U3gPvZk1pp1U6rmhIBGci1gw5MlK656y67mfHU1eFC_fAFSM6LWt4xSQ' }}">
                </div>
                @if($company->about_workshop_quote)
                    <div class="absolute -bottom-8 -left-8 bg-surface p-8 shadow-xl hidden md:block border-l-4 border-primary border border-outline/10">
                        <p class="italic text-secondary font-body-md">{{ $company->about_workshop_quote }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Our Values Section -->
<section class="py-32 bg-surface">
    <div class="max-w-container-max mx-auto px-margin-desktop text-center mb-16">
        <h2 class="font-headline-lg text-headline-lg text-on-surface inline-block relative">
            Nuestros Pilares
            <span class="absolute -bottom-4 left-1/2 -translate-x-1/2 w-12 h-1 bg-primary"></span>
        </h2>
    </div>
    <div class="max-w-container-max mx-auto px-margin-desktop grid grid-cols-1 md:grid-cols-3 gap-12">
        <!-- Value 1 -->
        <div class="group p-10 bg-surface-container-low transition-all duration-300 hover:bg-surface-container-lowest hover:shadow-xl reveal-on-scroll">
            <div class="mb-6 inline-flex items-center justify-center w-16 h-16 bg-primary/5 text-primary">
                <span class="material-symbols-outlined text-[32px]">{{ $company->about_pilar_1_icon ?? 'verified' }}</span>
            </div>
            <h3 class="font-headline-lg text-[22px] text-on-surface mb-4">{{ $company->about_pilar_1_title ?? 'Calidad Institucional' }}</h3>
            <p class="font-body-md text-body-md text-secondary">
                {{ $company->about_pilar_1_desc ?? 'Materiales certificados y procesos rigurosos que garantizan una vida útil prolongada bajo uso intensivo.' }}
            </p>
        </div>
        <!-- Value 2 -->
        <div class="group p-10 bg-surface-container-low transition-all duration-300 hover:bg-surface-container-lowest hover:shadow-xl reveal-on-scroll" style="transition-delay: 100ms;">
            <div class="mb-6 inline-flex items-center justify-center w-16 h-16 bg-primary/5 text-primary">
                <span class="material-symbols-outlined text-[32px]">{{ $company->about_pilar_2_icon ?? 'chair_alt' }}</span>
            </div>
            <h3 class="font-headline-lg text-[22px] text-on-surface mb-4">{{ $company->about_pilar_2_title ?? 'Diseño Ergonómico' }}</h3>
            <p class="font-body-md text-body-md text-secondary">
                {{ $company->about_pilar_2_desc ?? 'Priorizamos la salud y el bienestar del usuario, diseñando piezas que se adaptan a la anatomía humana.' }}
            </p>
        </div>
        <!-- Value 3 -->
        <div class="group p-10 bg-surface-container-low transition-all duration-300 hover:bg-surface-container-lowest hover:shadow-xl reveal-on-scroll" style="transition-delay: 200ms;">
            <div class="mb-6 inline-flex items-center justify-center w-16 h-16 bg-primary/5 text-primary">
                <span class="material-symbols-outlined text-[32px]">{{ $company->about_pilar_3_icon ?? 'eco' }}</span>
            </div>
            <h3 class="font-headline-lg text-[22px] text-on-surface mb-4">{{ $company->about_pilar_3_title ?? 'Compromiso Sostenible' }}</h3>
            <p class="font-body-md text-body-md text-secondary">
                {{ $company->about_pilar_3_desc ?? 'Uso responsable de recursos, maderas de bosques gestionados y acabados libres de químicos volátiles.' }}
            </p>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    // Simple scroll reveal animation
    const observerOptions = {
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, observerOptions);

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.reveal-on-scroll').forEach(el => observer.observe(el));
    });
</script>
@endsection

@section('styles')
<style>
    .reveal-on-scroll {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);
    }
    .reveal-on-scroll.active {
        opacity: 1;
        transform: translateY(0);
    }
</style>
@endsection
