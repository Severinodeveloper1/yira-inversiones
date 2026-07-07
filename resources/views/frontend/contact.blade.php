@extends('frontend.layouts.app')

@section('title', 'Contacto y Preguntas Frecuentes | Yira Inversiones')

@section('content')
@include('frontend.partials._page_hero', [
    'pageBanners'     => $pageBanners ?? collect(),
    'fallbackBg'      => 'https://lh3.googleusercontent.com/aida/AP1WRLuJP25Abvdua39V3C2A_S6RNdTBGMb7k5j9CnJH48jHxZ4DVpKnVrsPaYCsbxrwIQnFQxrww_2CguykGLVMWPXaStIVwFRLTf82qwIq8ytjIrTkrMwhJWCeK3AW0RZbxj26mk6Xtka3QVUuj7ubv4j4dUzpd0su03Dn7NA27R4k_HAlPb_NNVAWnQsiippMe7U3gPvZk1pp1U6rmhIBGci1gw5MlK656y67mfHU1eFC_fAFSM6LWt4xSQ',
    'defaultSubtitle' => 'Atención Personalizada',
    'defaultTitle'    => 'Contacto & Soporte',
])

<!-- Contact Form & Info Section -->
<section class="py-16 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
        <!-- Info Column -->
        <div class="lg:col-span-4 space-y-12">
            <div>
                <h3 class="font-headline-lg text-primary mb-6">Atención Personalizada</h3>
                <p class="text-secondary body-lg leading-relaxed">
                    Estamos aquí para asesorar sus proyectos corporativos y residenciales con la excelencia que nos caracteriza.
                </p>
            </div>
            <div class="space-y-8">
                @if($company->address)
                    <div class="flex items-start gap-4">
                        <span class="material-symbols-outlined text-primary mt-1">location_on</span>
                        <div>
                            <p class="font-bold text-on-surface mb-1">Showroom &amp; Taller</p>
                            <p class="text-secondary">{{ $company->address }}</p>
                        </div>
                    </div>
                @endif
                @if($company->phone)
                    <div class="flex items-start gap-4">
                        <span class="material-symbols-outlined text-primary mt-1">call</span>
                        <div>
                            <p class="font-bold text-on-surface mb-1">WhatsApp &amp; Celular</p>
                            <p class="text-secondary">{{ $company->phone }}</p>
                        </div>
                    </div>
                @endif
                @if($company->email)
                    <div class="flex items-start gap-4">
                        <span class="material-symbols-outlined text-primary mt-1">mail</span>
                        <div>
                            <p class="font-bold text-on-surface mb-1">Correo Electrónico</p>
                            <p class="text-secondary">{{ $company->email }}</p>
                        </div>
                    </div>
                @endif
            </div>
            <!-- Workshop CTA Box -->
            <div class="bg-surface-container p-8 border-l-4 border-primary">
                <p class="font-headline-lg text-[20px] mb-2">Visite nuestro Taller</p>
                <p class="text-secondary font-body-md mb-6">Conozca de cerca la maestría artesanal y la tecnología detrás de cada una de nuestras piezas.</p>
                <button onclick="openQuoteModal('Hola, deseo programar una visita al taller para cotizar mis muebles.')" class="w-full py-3 bg-primary text-white font-semibold tracking-wider hover:bg-primary-container transition-all">PROGRAMAR VISITA</button>
            </div>
        </div>
        
        <!-- Form Column -->
        <div class="lg:col-span-8 bg-white p-8 md:p-12 shadow-sm rounded-lg border border-outline/10">
            <h3 class="font-headline-lg text-headline-lg text-on-surface mb-8">Envíenos un mensaje</h3>
            <form class="space-y-8" id="contact-page-form">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="text-label-sm uppercase tracking-widest text-secondary" for="name">Nombre Completo *</label>
                        <input name="name" maxlength="100" class="w-full bg-transparent border-0 border-b border-outline/30 focus:ring-0 focus:border-primary transition-all py-3 px-0 font-body-md" id="name" placeholder="Juan Pérez" required type="text">
                    </div>
                    <div class="space-y-2">
                        <label class="text-label-sm uppercase tracking-widest text-secondary" for="email">Email *</label>
                        <input name="email" class="w-full bg-transparent border-0 border-b border-outline/30 focus:ring-0 focus:border-primary transition-all py-3 px-0 font-body-md" id="email" placeholder="juan.perez@empresa.com" required type="email">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="text-label-sm uppercase tracking-widest text-secondary" for="phone">Teléfono / WhatsApp *</label>
                        <input name="phone" maxlength="15" class="w-full bg-transparent border-0 border-b border-outline/30 focus:ring-0 focus:border-primary transition-all py-3 px-0 font-body-md" id="phone" placeholder="+51 999 999 999" required type="text">
                    </div>
                    <div class="space-y-2">
                        <label class="text-label-sm uppercase tracking-widest text-secondary" for="project">Proyecto / Asunto (Opcional)</label>
                        <input name="project" class="w-full bg-transparent border-0 border-b border-outline/30 focus:ring-0 focus:border-primary transition-all py-3 px-0 font-body-md" id="project" placeholder="Ej: Amoblado de Oficina Corporativa" type="text">
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-label-sm uppercase tracking-widest text-secondary" for="message">Mensaje *</label>
                    <textarea name="message" class="w-full bg-transparent border-0 border-b border-outline/30 focus:ring-0 focus:border-primary transition-all py-3 px-0 font-body-md resize-none" id="message" placeholder="Cuéntenos sobre su requerimiento..." required rows="4"></textarea>
                </div>
                <button class="w-full md:w-auto px-12 py-4 bg-primary text-white font-semibold tracking-widest hover:bg-primary-container transition-colors active:scale-95 duration-200 uppercase rounded" type="submit">
                    Enviar Mensaje
                </button>
            </form>
        </div>
    </div>
</section>

<!-- FAQs Section -->
@if($faqs->count() > 0)
<section class="py-20 bg-surface-container-low border-t border-b border-outline/10">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
        <div class="text-center mb-16">
            <span class="text-primary font-label-sm uppercase tracking-[0.2em] block mb-2">FAQ</span>
            <h2 class="font-headline-lg text-headline-lg text-on-surface">Preguntas Frecuentes</h2>
            <p class="text-secondary font-body-md mt-2">Respuestas rápidas a sus consultas sobre entrega, personalización y garantías.</p>
        </div>
        
        <div class="max-w-3xl mx-auto bg-white rounded-lg p-6 shadow-sm border border-outline/10 space-y-4">
            @foreach($faqs as $index => $faq)
                <details class="group py-6 border-b border-surface-container last:border-b-0" {{ $index === 0 ? 'open' : '' }}>
                    <summary class="flex justify-between items-center cursor-pointer list-none">
                        <span class="font-body-md text-body-md font-bold text-on-surface uppercase tracking-wide">{{ $faq->question }}</span>
                        <span class="material-symbols-outlined group-open:rotate-180 transition-transform">expand_more</span>
                    </summary>
                    <p class="mt-4 text-body-md text-secondary leading-relaxed">
                        {{ $faq->answer }}
                    </p>
                </details>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Full-Width Map Section -->
@if($company->maps_iframe)
<section class="w-full h-[450px] relative bg-surface-container overflow-hidden">
    <iframe class="w-full h-full grayscale contrast-125 opacity-90 hover:grayscale-0 transition-all" 
        src="{{ $company->maps_iframe }}" 
        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    <div class="absolute top-12 left-12 bg-white/95 backdrop-blur-sm p-8 shadow-2xl border-l-4 border-primary hidden md:block rounded">
        <p class="font-headline-lg text-[20px] mb-1 font-bold">Nuestra Planta &amp; Oficina</p>
        <p class="text-secondary font-body-md">{{ $company->address }}</p>
        <a class="mt-4 inline-flex items-center gap-2 text-primary font-bold text-sm hover:underline" href="https://maps.google.com" target="_blank">
            VER EN GOOGLE MAPS
            <span class="material-symbols-outlined text-sm">open_in_new</span>
        </a>
    </div>
</section>
@endif
@endsection

@section('scripts')
<script>
    // Handle form submission via fetch
    document.getElementById('contact-page-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerText;
        submitBtn.innerText = 'Enviando...';
        submitBtn.disabled = true;

        const name = this.querySelector('input[name="name"]').value.trim();
        const email = this.querySelector('input[name="email"]').value.trim();
        const phone = this.querySelector('input[name="phone"]').value.trim();
        const message = this.querySelector('textarea[name="message"]').value.trim();

        if (name.length < 5) {
            showToast('Por favor, ingrese su nombre completo (mínimo 5 caracteres).', 'warning');
            submitBtn.innerText = originalText;
            submitBtn.disabled = false;
            return;
        }
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            showToast('El correo electrónico no es válido.', 'warning');
            submitBtn.innerText = originalText;
            submitBtn.disabled = false;
            return;
        }
        if (!/^\+?[0-9]{7,15}$/.test(phone)) {
            showToast('El número de teléfono no es válido (ingrese entre 7 y 15 dígitos sin letras ni símbolos).', 'warning');
            submitBtn.innerText = originalText;
            submitBtn.disabled = false;
            return;
        }
        if (message.length < 10) {
            showToast('El mensaje debe tener al menos 10 caracteres.', 'warning');
            submitBtn.innerText = originalText;
            submitBtn.disabled = false;
            return;
        }
        
        const formData = new FormData(this);
        fetch('{{ route("quote.store") }}', {
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
            submitBtn.innerText = '¡Mensaje Enviado!';
            submitBtn.classList.replace('bg-primary', 'bg-green-700');
            setTimeout(() => {
                submitBtn.innerText = originalText;
                submitBtn.classList.replace('bg-green-700', 'bg-primary');
                submitBtn.disabled = false;
            }, 3000);
        })
        .catch(err => {
            console.error(err);
            const errMsg = err.message || 'Ocurrió un error al enviar el mensaje. Intente de nuevo.';
            showToast(errMsg, 'error');
            submitBtn.innerText = originalText;
            submitBtn.disabled = false;
        });
    });

    // Restrict phone input to numbers and +
    const contactPhoneInput = document.getElementById('phone');
    if (contactPhoneInput) {
        contactPhoneInput.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9+]/g, '');
        });
    }

    // FAQs Accordion Behavior
    document.querySelectorAll('details').forEach((detail) => {
        detail.addEventListener('click', (e) => {
            if (detail.hasAttribute('open')) return;
            document.querySelectorAll('details').forEach((other) => {
                if (other !== detail) other.removeAttribute('open');
            });
        });
    });
</script>
@endsection
