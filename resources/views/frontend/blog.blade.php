@extends('frontend.layouts.app')

@section('title', 'Blog | Yira Inversiones')

@section('content')
<!-- Hero Section -->
<section class="relative h-[50vh] w-full overflow-hidden bg-on-surface">
    <div class="absolute inset-0 bg-cover bg-center opacity-60" style="background-image: url('https://lh3.googleusercontent.com/aida/AP1WRLtZwqlaDFmeHVNuGcJB1sbqvhvchPZlxD-DDFulYi-SN4S2FMlXhTnhOzwlaS010vFitglXV7xSXihGqZu6qs0U52hdH2FDR2qJ_vaGU0g57b-07HHVu67JmnPzkFzevD5faVECb2lTy8EoFtFRoSOCwJ9O1pknQZmvwiaWTGT9NTydgvOTtof5C-yztmSbnSNoWqmHtvQC6CySb3AgcbGmwnKgnNjGcbQ0XMWlt-HS59qiz_BvfRbTsfI');"></div>
    <div class="relative h-full max-w-container-max mx-auto px-margin-desktop flex flex-col justify-center items-start">
        <span class="inline-block px-4 py-1 mb-6 bg-primary text-white font-label-sm text-label-sm tracking-widest uppercase">Editorial</span>
        <h1 class="font-headline-xl text-headline-xl text-white max-w-2xl leading-none">Inspiración y Diseño</h1>
        <p class="mt-6 text-white/90 font-body-lg text-body-lg max-w-lg">
            Descubra las últimas tendencias en espacios corporativos, donde la ergonomía y la estética se encuentran para inspirar su trabajo.
        </p>
    </div>
</section>

<!-- Divider -->
<div class="max-w-container-max mx-auto px-margin-desktop">
    <hr class="border-t border-outline-variant/30 my-10">
</div>

<!-- Blog Grid Section -->
<section class="max-w-container-max mx-auto px-margin-desktop py-12">
    <div class="flex flex-col md:flex-row justify-between items-baseline mb-16 gap-4">
        <h2 class="font-headline-lg text-headline-lg text-on-surface border-l-4 border-primary pl-6">Artículos Recientes</h2>
    </div>

    @if($posts->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
            @foreach($posts as $post)
                @php
                    $postImage = $post->image_path 
                        ? asset('storage/' . $post->image_path) 
                        : 'https://placehold.co/400x500?text=Yira+Inversiones';
                @endphp
                <article class="group cursor-pointer" onclick="window.location.href='{{ route('blog.detail', $post->slug) }}'">
                    <div class="relative overflow-hidden aspect-[4/5] bg-surface-container mb-6 rounded shadow-sm">
                        <img class="object-cover w-full h-full transition-transform duration-700 group-hover:scale-105" alt="{{ $post->title }}" src="{{ $postImage }}">
                        <div class="absolute top-4 left-4">
                            <span class="bg-white px-3 py-1 font-label-sm text-label-sm text-secondary uppercase tracking-wider rounded-sm">Artículo</span>
                        </div>
                    </div>
                    <time class="font-label-sm text-label-sm text-secondary tracking-widest uppercase">
                        {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->translatedFormat('d F, Y') : $post->created_at->translatedFormat('d F, Y') }}
                    </time>
                    <h3 class="font-headline-lg text-headline-lg mt-3 mb-4 group-hover:text-primary transition-colors leading-tight">
                        {{ $post->title }}
                    </h3>
                    <p class="font-body-md text-body-md text-secondary line-clamp-3 mb-6">
                        {{ strip_tags($post->content) }}
                    </p>
                    <a href="{{ route('blog.detail', $post->slug) }}" class="inline-flex items-center gap-2 font-label-sm text-label-sm text-primary group-hover:gap-4 transition-all uppercase tracking-wider">
                        Leer más <span class="material-symbols-outlined">arrow_right_alt</span>
                    </a>
                </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-16">
            {{ $posts->links() }}
        </div>
    @else
        <div class="text-center py-20 bg-surface-container-low rounded border border-outline/10 max-w-xl mx-auto">
            <span class="material-symbols-outlined text-6xl text-secondary mb-6">article</span>
            <h3 class="font-headline-lg text-headline-lg text-on-surface mb-2">No hay publicaciones</h3>
            <p class="text-secondary">Próximamente compartiremos artículos sobre diseño y tendencias.</p>
        </div>
    @endif
</section>
@endsection

@section('scripts')
<script>
    // Intersection Observer for fade-in animations on scroll
    document.addEventListener('DOMContentLoaded', () => {
        const observerOptions = {
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('opacity-100', 'translate-y-0');
                    entry.target.classList.remove('opacity-0', 'translate-y-10');
                }
            });
        }, observerOptions);

        document.querySelectorAll('article').forEach(el => {
            el.classList.add('opacity-0', 'translate-y-10', 'transition-all', 'duration-700');
            observer.observe(el);
        });
    });
</script>
@endsection
