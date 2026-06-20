### Especificación de Requerimientos Funcionales y Estructurales: Sitio Web Yira Inversiones

#### 1\. Visión General del Proyecto y Objetivos Estratégicos

El proyecto de desarrollo para  **Yira Inversiones**  responde a la necesidad estratégica de migrar hacia una plataforma web profesional que consolide la identidad de la marca en el sector mobiliario. El objetivo central es equilibrar una estética visual de "diseño limpio" —evitando la saturación común en sitios de ventas tradicionales— con una robustez técnica que garantice la conversión. La plataforma debe servir como un catálogo interactivo de alta gama para productos de hogar y oficina, diseñado específicamente para reducir la fricción cognitiva en un público objetivo diverso que incluye a clientes de perfiles demográficos senior. La estructura que se detalla a continuación prioriza la usabilidad y el realismo visual como motores de confianza comercial.

#### 2\. Arquitectura de Información y Navegación (Header)

La arquitectura de información se ha diseñado bajo principios de  **Accesibilidad y Usabilidad para Demografías Senior** , asegurando que la jerarquía de navegación sea intuitiva y libre de obstáculos visuales.

* **Elementos del Menú:**  Inicio, Nosotros, Servicios, Tienda, Blog y Contacto.  
* **Diseño de Bajo Impacto Vertical:**  El  *Header*  debe presentar un "minimalist vertical footprint", ajustándose visualmente al banner principal para no ocupar espacio excesivo en la pantalla y mantener la limpieza estética demandada.  
* **Lógica de Interacción:**  El menú debe ser persistente (sticky) o de fácil recuperación, permitiendo que usuarios con menor destreza digital localicen las secciones principales sin necesidad de realizar múltiples desplazamientos (scrolls).Esta navegación simplificada actúa como el marco de contención para el componente visual de mayor impacto: el Banner Principal Administrable.

#### 3\. Configuración del Front-End: Página de Inicio (Landing Page)

La página de inicio es el primer punto de contacto crítico y debe proyectar autoridad de marca de forma inmediata. Se evitará la fatiga visual mediante una organización modular y espacios negativos estratégicos.

* **Banner Principal Administrable:**  Componente de dimensiones medianas (no pantalla completa para evitar saturación). El CMS debe permitir la actualización de banners para campañas estacionales (Navidad, Día de la Madre, Regreso a Clases) con botones de Llamada a la Acción (CTA) integrados.  
* **Requerimientos de Imagen:**  Se establece el estándar de  **Environmental/Lifestyle Photography**  (muebles en contextos reales o generados por IA para dar contraste y realismo) frente a la fotografía simple de producto, elevando la percepción de calidad.  
* **Sección de Categorías Segmentada:**  Acceso directo y legible a las dos líneas de negocio principales:  **Hogar**  y  **Oficina** .  
* **Bloque de Productos Destacados:**  Módulo de selección manual en el backend para mostrar entre 4 y 10 "productos estrella" o inventario de alta rotación.Esta estructura guía al usuario de manera natural hacia la profundidad del catálogo técnico.

#### 4\. Funcionalidades del Módulo de Tienda y Catálogo

En el sector mobiliario, la precisión técnica es el factor determinante para la conversión. El catálogo está diseñado bajo el principio de "navegación por control de usuario" para evitar la desorientación.

* **Visualización y Usabilidad:**  Se prohíbe el auto-scroll. La visualización de productos en la grilla y detalles empleará  **botones de navegación manual (flechas)** , permitiendo a los clientes senior explorar diferentes ángulos del mueble a su propio ritmo.  
* **Ficha Técnica de Producto:**  Imágenes de 1200x1200px, descripción detallada, precios y tiempos de entrega.  
* **Selector de Atributos (Metadata de Color):**  Implementación de una "paletita de colores" mediante círculos seleccionables. Aunque no se requiere cambio dinámico de imagen en la Fase 1, es un  **requerimiento funcional crítico**  que el color seleccionado sea capturado como metadata y enviado automáticamente en la consulta de WhatsApp o registrado en el carrito de compras.  
* **UX de Catálogos Descargables:**  Dos botones independientes para descarga de PDF. Se requiere una segmentación clara entre  **Catálogo Hogar**  y  **Catálogo Oficina**  para evitar la sobrecarga de información y facilitar que el cliente corporativo no se pierda en productos residenciales.

#### 5\. Conversión y Canales de Comunicación

Dada la naturaleza del cliente de Yira Inversiones, el sistema debe ofrecer una transición fluida entre el autoservicio digital y la asesoría personalizada.

* **Pasarela de Pago Unificada:**  Integración con  **Culqi**  como pasarela principal, capaz de procesar tanto tarjetas de crédito/débito como billeteras digitales en un solo flujo de pago.  
* **Botón de WhatsApp Contextual:**  Enlace de consulta directa que debe incluir el nombre del producto y el atributo de color seleccionado previamente.  
* **Formulario de Cotización Modal (Popup):**  Para optimizar la retención, las solicitudes de cotización se realizarán mediante una ventana modal que se abre sobre la página actual (sin redirecciones). Campos requeridos: Nombre, Email, Teléfono, Proyecto, Asunto y Mensaje.

#### 6\. Módulos de Identidad, Blog y Credibilidad

La construcción de confianza se apoya en la transparencia de los procesos de fabricación y la validación de terceros.

* **Sección "Nosotros" (Taller de Fabricación):**  Es un requerimiento funcional para la construcción de confianza incluir una galería o punto focal de "Fabricación y Artesanía" con fotografías reales del taller propio, subrayando la condición de fabricantes.  
* **Grilla de Validación de Experiencia:**  Sección de testimonios y clientes corporativos estructurada en un formato de tres puntos:  **Logo de la Empresa \+ Descripción del Proyecto \+ Foto de Evidencia del Trabajo Realizado** .  
* **Eficiencia Operativa (Blog y FAQ):**  Módulo administrable de artículos para SEO y una sección de Preguntas Frecuentes (FAQ) diseñada específicamente para reducir el volumen de consultas repetitivas sobre logística y garantías.

#### 7\. Requerimientos de Administración y Analítica (Backend)

El sistema debe otorgar autonomía total al cliente a través de un panel de control robusto y herramientas de medición de KPIs.

* **CMS con Capacidades CRUD:**  El Panel Administrable debe proporcionar capacidades granulares de creación, lectura, actualización y eliminación (CRUD) para todas las entidades dinámicas: Productos, Categorías, Banners, Blogs y Documentos de Políticas.  
* **Capa de Datos y Analítica:**  Integración nativa con  **Google Analytics**  para el monitoreo de flujos de visitantes, conversiones y tasas de rebote.  
* **Gestión Digital de Reclamaciones:**  Formulario de Libro de Reclamaciones conforme a ley, con almacenamiento en base de datos y acceso administrativo para la gestión de incidencias.

#### 8\. Infraestructura Técnica y Aspectos Legales

Se garantiza la propiedad absoluta de los activos digitales y la seguridad de la información del usuario final.| Componente | Especificación Técnica || \------ | \------ || **Dominio Primario** | jiraventas.com (Tentativo \- Propiedad de la empresa) || **Hosting y Seguridad** | Servidor con soporte para protocolo HTTPS y Certificado SSL activo || **Protocolo de Seguridad** | Encriptación de datos para transacciones y formularios || **Documentación Legal** | Secciones editables para Políticas de Envío, Devolución, Pago y Entrega || **Libro de Reclamaciones** | Implementación digital normativa con acceso de backend |  
El equipo de desarrollo procederá al prototipado basándose en estos requerimientos, priorizando la nitidez visual y la accesibilidad para el usuario final.  

#### 9\. Estructura de Pedidos (Carrito vs. WhatsApp)
Respecto a cómo el cliente final realizará el pedido, se acordó implementar un sistema híbrido:
•	Doble funcionalidad: La cliente indicó que desea tener ambas opciones: el carrito de compras y la consulta directa.
•	Botón de WhatsApp: Se incluirá un botón para "Consultar al WhatsApp" directamente desde la ficha del producto.
•	Carrito de compras: Se utilizará para que el usuario pueda seleccionar un grupo de productos (por ejemplo, una silla, una mesa y un estante) y generar una solicitud de cotización o un pedido formal.
•	Ventana emergente (Popup) de Cotización: Para facilitar el proceso a personas mayores y evitar que se pierdan navegando entre pestañas, se implementará una ventana pequeña que se abre sobre la misma página para rellenar datos de contacto y solicitar cotizaciones.
#### 10\. Entrega de Mercadería e Información del Producto
En cuanto a la mercadería y su logística, se especificaron los siguientes puntos:
•	Detalles en la ficha: Cada producto mostrará información sobre tiempos de entrega y características técnicas.
•	Gestión de políticas: El panel administrativo permitirá a la empresa gestionar y modificar las políticas de entrega, envío y devolución.
•	Seguimiento de pedidos: El equipo técnico mencionó que, a través del sistema de pedidos/carrito, la empresa se encargaría de visualizar y coordinar la entrega de cada uno de los productos solicitados.
