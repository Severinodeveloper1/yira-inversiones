@extends('frontend.layouts.app')

@section('title', 'Políticas Generales y Términos | Yira Inversiones')

@section('content')
<main class="pt-12 pb-24 max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
    <!-- Breadcrumb -->
    <nav class="mb-12 flex items-center gap-2 text-secondary font-label-sm text-label-sm uppercase tracking-widest">
        <a class="hover:text-primary transition-colors" href="{{ route('home') }}">Inicio</a>
        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
        <span class="text-on-surface">Políticas y Términos</span>
    </nav>

    <header class="mb-16">
        <span class="text-primary font-label-sm uppercase tracking-[0.2em] block mb-2">Transparencia</span>
        <h1 class="font-headline-xl text-headline-xl text-on-surface">Políticas y Condiciones Generales</h1>
        <p class="text-secondary font-body-md mt-2">Conozca las normativas sobre envíos, garantías y devoluciones de nuestro mobiliario de alta gama.</p>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
        <!-- Sidebar Navigation -->
        <aside class="lg:col-span-4">
            <div class="bg-surface-container-low p-6 rounded-lg border border-outline/10 sticky top-28 space-y-2">
                @if($policies->isNotEmpty())
                    @foreach($policies as $policy)
                        <button onclick="scrollToPolicy('{{ $policy->key }}')" class="w-full text-left px-4 py-3 font-semibold text-secondary hover:text-primary hover:bg-white rounded transition-all flex items-center gap-3">
                            <span class="material-symbols-outlined text-[18px]">policy</span>
                            {{ $policy->title }}
                        </button>
                    @endforeach
                @else
                    <button onclick="scrollToPolicy('envios')" class="w-full text-left px-4 py-3 font-semibold text-secondary hover:text-primary hover:bg-white rounded transition-all flex items-center gap-3">
                        <span class="material-symbols-outlined text-[18px]">local_shipping</span>
                        Política de Envíos
                    </button>
                    <button onclick="scrollToPolicy('devoluciones')" class="w-full text-left px-4 py-3 font-semibold text-secondary hover:text-primary hover:bg-white rounded transition-all flex items-center gap-3">
                        <span class="material-symbols-outlined text-[18px]">assignment_return</span>
                        Devoluciones y Cambios
                    </button>
                    <button onclick="scrollToPolicy('garantias')" class="w-full text-left px-4 py-3 font-semibold text-secondary hover:text-primary hover:bg-white rounded transition-all flex items-center gap-3">
                        <span class="material-symbols-outlined text-[18px]">verified</span>
                        Garantía del Mobiliario
                    </button>
                    <button onclick="scrollToPolicy('terminos')" class="w-full text-left px-4 py-3 font-semibold text-secondary hover:text-primary hover:bg-white rounded transition-all flex items-center gap-3">
                        <span class="material-symbols-outlined text-[18px]">gavel</span>
                        Términos de Servicio
                    </button>
                @endif
            </div>
        </aside>

        <!-- Policies Content -->
        <section class="lg:col-span-8 space-y-16">
            @if($policies->isNotEmpty())
                @foreach($policies as $policy)
                <div id="policy-{{ $policy->key }}" class="space-y-6 scroll-mt-28">
                    <div class="flex items-center gap-4 border-b border-outline/10 pb-4">
                        <span class="material-symbols-outlined text-primary text-3xl">policy</span>
                        <h2 class="font-headline-lg text-headline-lg text-on-surface">{{ $loop->iteration }}. {{ $policy->title }}</h2>
                    </div>
                    <div class="prose text-secondary text-body-md leading-relaxed space-y-4">
                        {!! $policy->content !!}
                    </div>
                </div>
                @endforeach
            @else
                <!-- Fallback defaults -->
                <!-- 1. Envíos -->
                <div id="policy-envios" class="space-y-6 scroll-mt-28">
                    <div class="flex items-center gap-4 border-b border-outline/10 pb-4">
                        <span class="material-symbols-outlined text-primary text-3xl">local_shipping</span>
                        <h2 class="font-headline-lg text-headline-lg text-on-surface">1. Política de Envíos y Despacho</h2>
                    </div>
                    <div class="prose text-secondary text-body-md leading-relaxed space-y-4">
                        <p>En Yira Inversiones realizamos despachos a nivel nacional. Los costos y tiempos de entrega varían según la ubicación geográfica y la complejidad de instalación del mobiliario solicitado.</p>
                        <ul class="list-disc pl-6 space-y-2">
                            <li><strong>Despacho local (Lima Metropolitana):</strong> Los plazos oscilan entre 5 a 15 días hábiles, sujeto a disponibilidad de stock y tiempos de fabricación de cada pieza.</li>
                            <li><strong>Envíos a Provincias:</strong> Se realizan a través de agencias de transporte autorizadas previa coordinación con el comprador. El flete y el seguro son asumidos por el cliente final.</li>
                            <li><strong>Instalación:</strong> Nuestro personal calificado se encarga de la instalación del mobiliario de oficina y del hogar en Lima Metropolitana para garantizar el correcto montaje ergonómico.</li>
                        </ul>
                    </div>
                </div>

                <!-- 2. Devoluciones -->
                <div id="policy-devoluciones" class="space-y-6 scroll-mt-28">
                    <div class="flex items-center gap-4 border-b border-outline/10 pb-4">
                        <span class="material-symbols-outlined text-primary text-3xl">assignment_return</span>
                        <h2 class="font-headline-lg text-headline-lg text-on-surface">2. Cambios y Devoluciones</h2>
                    </div>
                    <div class="prose text-secondary text-body-md leading-relaxed space-y-4">
                        <p>Al tratarse de mobiliario de fabricación personalizada y bajo pedido, las devoluciones se gestionan bajo condiciones específicas para proteger el diseño exclusivo.</p>
                        <ul class="list-disc pl-6 space-y-2">
                            <li><strong>Errores de Fabricación:</strong> Si el producto presenta diferencias estructurales o de materialidad respecto a lo cotizado y aprobado, el cliente podrá solicitar el cambio o reparación sin costo alguno en un plazo máximo de 7 días calendario posteriores a la entrega.</li>
                            <li><strong>Cancelaciones:</strong> Una vez aprobada la orden e iniciado el proceso de ebanistería o corte, no se admiten cancelaciones ni reembolsos de adelantos por retiro voluntario del comprador.</li>
                        </ul>
                    </div>
                </div>

                <!-- 3. Garantía -->
                <div id="policy-garantias" class="space-y-6 scroll-mt-28">
                    <div class="flex items-center gap-4 border-b border-outline/10 pb-4">
                        <span class="material-symbols-outlined text-primary text-3xl">verified</span>
                        <h2 class="font-headline-lg text-headline-lg text-on-surface">3. Garantía y Calidad del Mobiliario</h2>
                    </div>
                    <div class="prose text-secondary text-body-md leading-relaxed space-y-4">
                        <p>Todas nuestras colecciones de autor cuentan con un firme respaldo de garantía de calidad debido a la rigurosidad de nuestra selección de madera y tapicería.</p>
                        <ul class="list-disc pl-6 space-y-2">
                            <li><strong>Estructura de madera:</strong> Garantía de hasta 5 años contra carcoma, deformaciones estructurales graves o fallos en las uniones de ebanistería bajo uso normal.</li>
                            <li><strong>Mecanismos y Pistones:</strong> 2 años de garantía en mecanismos de reclinación, pistones hidráulicos de sillas ejecutivas y ruedas de soporte.</li>
                            <li><strong>Excepciones:</strong> La garantía no cubre el desgaste natural del cuero, cortes accidentales en textiles, ni decoloración provocada por exposición directa a la radiación solar extrema.</li>
                        </ul>
                    </div>
                </div>

                <!-- 4. Términos y Condiciones -->
                <div id="policy-terminos" class="space-y-6 scroll-mt-28">
                    <div class="flex items-center gap-4 border-b border-outline/10 pb-4">
                        <span class="material-symbols-outlined text-primary text-3xl">gavel</span>
                        <h2 class="font-headline-lg text-headline-lg text-on-surface">4. Términos de Servicio</h2>
                    </div>
                    <div class="prose text-secondary text-body-md leading-relaxed space-y-4">
                        <p>Bienvenido al catálogo digital de Yira Inversiones. Al navegar por este sitio y generar solicitudes de cotización, usted acepta los siguientes términos:</p>
                        <ul class="list-disc pl-6 space-y-2">
                            <li>Las imágenes mostradas son referenciales. Cada producto de madera natural cuenta con vetas y tonos únicos imposibles de duplicar exactamente.</li>
                            <li>Las cotizaciones emitidas a través de la web o WhatsApp tienen una vigencia estándar de 15 días calendario debido a la fluctuación de los precios de maderas importadas.</li>
                            <li>Los precios indicados en el catálogo son netos e incluyen IGV.</li>
                        </ul>
                    </div>
                </div>
            @endif
        </section>
    </div>
</main>
@endsection

@section('scripts')
<script>
    function scrollToPolicy(id) {
        const el = document.getElementById(`policy-${id}`);
        if (el) {
            el.scrollIntoView({ behavior: 'smooth' });
        }
    }
</script>
@endsection
