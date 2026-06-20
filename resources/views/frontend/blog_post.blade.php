@extends('frontend.layouts.app')

@section('title', $post->title . ' | Blog Yira Inversiones')

@section('content')
<main class="pt-12 pb-24 max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
    <!-- Breadcrumb -->
    <nav class="mb-12 flex items-center gap-2 text-secondary font-label-sm text-label-sm uppercase tracking-widest">
        <a class="hover:text-primary transition-colors" href="{{ route('home') }}">Inicio</a>
        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
        <a class="hover:text-primary transition-colors" href="{{ route('blog') }}">Blog</a>
        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
        <span class="text-on-surface truncate max-w-xs">{{ $post->title }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
        <!-- Main Article Content -->
        <article class="lg:col-span-8 space-y-8">
            <header class="space-y-4">
                <span class="inline-block px-3 py-1 bg-primary/10 text-primary font-label-sm text-label-sm tracking-widest uppercase rounded">Artículo</span>
                <h1 class="font-headline-xl text-headline-xl text-on-surface leading-tight">{{ $post->title }}</h1>
                <div class="flex items-center gap-4 text-secondary font-label-sm text-label-sm uppercase tracking-wider">
                    <time>
                        {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->translatedFormat('d F, Y') : $post->created_at->translatedFormat('d F, Y') }}
                    </time>
                    <span>•</span>
                    <span>Por Yira Inversiones</span>
                </div>
            </header>

            @if($post->image_path)
                <div class="w-full aspect-[16/9] bg-surface-container overflow-hidden rounded shadow-sm">
                    <img class="w-full h-full object-cover" alt="{{ $post->title }}" src="{{ asset('storage/' . $post->image_path) }}">
                </div>
            @endif

            <div class="prose max-w-none text-secondary text-body-lg leading-relaxed space-y-6">
                {!! $post->content !!}
            </div>
            
            <div class="pt-8 border-t border-surface-variant flex justify-between items-center">
                <a href="{{ route('blog') }}" class="inline-flex items-center gap-2 text-secondary hover:text-primary transition-colors font-label-sm text-label-sm uppercase tracking-widest">
                    <span class="material-symbols-outlined">arrow_back</span>
                    Volver al Blog
                </a>
            </div>
        </article>

        <!-- Sidebar / Recent Posts -->
        <aside class="lg:col-span-4 space-y-12">
            @if($recentPosts->count() > 0)
                <div class="bg-surface-container-low p-8 rounded border border-outline/10">
                    <h3 class="font-headline-lg text-[22px] text-on-surface mb-6 border-b border-outline/10 pb-4">Otros Artículos</h3>
                    <div class="space-y-8">
                        @foreach($recentPosts as $recent)
                            @php
                                $recentImg = $recent->image_path 
                                    ? asset('storage/' . $recent->image_path) 
                                    : 'https://placehold.co/150x150?text=Yira';
                            @endphp
                            <div class="flex gap-4 cursor-pointer group" onclick="window.location.href='{{ route('blog.detail', $recent->slug) }}'">
                                <div class="w-20 h-20 flex-shrink-0 bg-surface-container overflow-hidden rounded">
                                    <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" alt="{{ $recent->title }}" src="{{ $recentImg }}">
                                </div>
                                <div class="flex flex-col justify-center">
                                    <time class="text-[11px] text-secondary tracking-widest uppercase">
                                        {{ $recent->published_at ? \Carbon\Carbon::parse($recent->published_at)->translatedFormat('d M, Y') : $recent->created_at->translatedFormat('d M, Y') }}
                                    </time>
                                    <h4 class="font-bold text-on-surface text-[14px] leading-snug group-hover:text-primary transition-colors line-clamp-2 mt-1">
                                        {{ $recent->title }}
                                    </h4>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </aside>
    </div>
</main>
@endsection
