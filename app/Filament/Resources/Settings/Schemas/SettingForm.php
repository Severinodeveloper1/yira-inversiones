<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Ajustes')
                    ->tabs([
                        Tab::make('General y Contacto')
                            ->icon('heroicon-o-home')
                            ->schema([
                                Section::make('Información General')
                                    ->description('Nombre y Logo corporativo de la empresa.')
                                    ->schema([
                                        TextInput::make('name')
                                            ->label('Nombre Comercial')
                                            ->required()
                                            ->maxLength(255),
                                        FileUpload::make('logo_path')
                                            ->label('Logotipo de la Empresa')
                                            ->image()
                                            ->directory('company')
                                            ->helperText('Formato recomendado: PNG transparente o SVG, tamaño máximo 2MB.'),
                                    ])
                                    ->columns(2),

                                Section::make('Datos de Contacto')
                                    ->description('Canales oficiales de comunicación para los clientes.')
                                    ->schema([
                                        TextInput::make('phone')
                                            ->label('Teléfono de Contacto')
                                            ->maxLength(255)
                                            ->placeholder('Ej: +51 987 654 321'),
                                        TextInput::make('whatsapp_phone')
                                            ->label('Número de WhatsApp para Enlaces (Solo Números con Código de País)')
                                            ->maxLength(255)
                                            ->placeholder('Ej: 51987654321')
                                            ->helperText('No incluir espacios ni signos +. Ej: Para Perú (51) y número (987654321), colocar: 51987654321'),
                                        TextInput::make('email')
                                            ->label('Correo Electrónico oficial')
                                            ->email()
                                            ->maxLength(255)
                                            ->placeholder('Ej: ventas@jiraventas.com'),
                                        TextInput::make('address')
                                            ->label('Dirección Showroom / Taller')
                                            ->maxLength(255)
                                            ->placeholder('Ej: Zona Industrial, Lima, Perú'),
                                    ])
                                    ->columns(2),

                                Section::make('Ubicación Geográfica (Mapa)')
                                    ->schema([
                                        Textarea::make('maps_iframe')
                                            ->label('Código Embebido de Google Maps (URL / iframe)')
                                            ->rows(4)
                                            ->placeholder('Pegue aquí el iframe de inserción de Google Maps o la URL del mapa.')
                                            ->helperText('Ejemplo: https://www.google.com/maps/embed?...'),
                                    ]),

                                Section::make('Redes Sociales')
                                    ->description('Enlaces a los perfiles oficiales de la empresa.')
                                    ->schema([
                                        TextInput::make('facebook_url')
                                            ->label('Enlace de Facebook')
                                            ->url()
                                            ->maxLength(255),
                                        TextInput::make('instagram_url')
                                            ->label('Enlace de Instagram')
                                            ->url()
                                            ->maxLength(255),
                                        TextInput::make('tiktok_url')
                                            ->label('Enlace de TikTok')
                                            ->url()
                                            ->maxLength(255),
                                        TextInput::make('youtube_url')
                                            ->label('Enlace de YouTube')
                                            ->url()
                                            ->maxLength(255),
                                    ])
                                    ->columns(2),
                            ]),

                        Tab::make('Catálogos PDF')
                            ->icon('heroicon-o-document-arrow-down')
                            ->schema([
                                Section::make('Catálogos de la Empresa')
                                    ->description('Suba los catálogos en formato PDF para descarga pública en la web.')
                                    ->schema([
                                        FileUpload::make('catalog_home_path')
                                            ->label('Catálogo Hogar (PDF)')
                                            ->acceptedFileTypes(['application/pdf'])
                                            ->directory('catalogs')
                                            ->helperText('Solo archivos PDF. Tamaño máximo recomendado: 10MB.'),
                                        FileUpload::make('catalog_office_path')
                                            ->label('Catálogo Oficina (PDF)')
                                            ->acceptedFileTypes(['application/pdf'])
                                            ->directory('catalogs')
                                            ->helperText('Solo archivos PDF. Tamaño máximo recomendado: 10MB.'),
                                    ])
                                    ->columns(2),
                            ]),

                        Tab::make('Sección Nosotros')
                            ->icon('heroicon-o-user-group')
                            ->schema([
                                Section::make('Nosotros - Hero')
                                    ->description('Personalice la sección de cabecera de la página Quiénes Somos.')
                                    ->schema([
                                        FileUpload::make('about_hero_image_path')
                                            ->label('Imagen de Fondo (Hero)')
                                            ->image()
                                            ->directory('about')
                                            ->helperText('Formato recomendado: JPG/PNG/WEBP de alta resolución, tamaño máximo 2MB.'),
                                        TextInput::make('about_hero_subtitle')
                                            ->label('Subtítulo')
                                            ->required()
                                            ->maxLength(255),
                                        TextInput::make('about_hero_title')
                                            ->label('Título Principal')
                                            ->required()
                                            ->maxLength(255),
                                        Textarea::make('about_hero_description')
                                            ->label('Descripción / Párrafo principal')
                                            ->rows(3),
                                    ])
                                    ->columns(2),

                                Section::make('Nosotros - El Taller')
                                    ->description('Personalice el contenido de la sección del Taller Artesanal.')
                                    ->schema([
                                        TextInput::make('about_workshop_subtitle')
                                            ->label('Subtítulo')
                                            ->required()
                                            ->maxLength(255),
                                        TextInput::make('about_workshop_title')
                                            ->label('Título')
                                            ->required()
                                            ->maxLength(255),
                                        Textarea::make('about_workshop_description_1')
                                            ->label('Párrafo 1')
                                            ->rows(3),
                                        Textarea::make('about_workshop_description_2')
                                            ->label('Párrafo 2')
                                            ->rows(3),
                                        TextInput::make('about_workshop_stat_1_value')
                                            ->label('Estadística 1 - Valor')
                                            ->placeholder('Ej: 25+')
                                            ->maxLength(50),
                                        TextInput::make('about_workshop_stat_1_label')
                                            ->label('Estadística 1 - Etiqueta')
                                            ->placeholder('Ej: Años de Maestría')
                                            ->maxLength(255),
                                        TextInput::make('about_workshop_stat_2_value')
                                            ->label('Estadística 2 - Valor')
                                            ->placeholder('Ej: 100%')
                                            ->maxLength(50),
                                        TextInput::make('about_workshop_stat_2_label')
                                            ->label('Estadística 2 - Etiqueta')
                                            ->placeholder('Ej: Fabricación Propia')
                                            ->maxLength(255),
                                        FileUpload::make('about_workshop_image_path')
                                            ->label('Imagen del Taller')
                                            ->image()
                                            ->directory('about')
                                            ->helperText('Imagen de la sección derecha.'),
                                        Textarea::make('about_workshop_quote')
                                            ->label('Frase Destacada (Cita)')
                                            ->rows(2)
                                            ->helperText('Frase que aparece sobre fondo blanco en la imagen.'),
                                    ])
                                    ->columns(2),

                                Section::make('Nosotros - Nuestros Pilares')
                                    ->description('Personalice los tres pilares institucionales que aparecen abajo.')
                                    ->schema([
                                        // Pilar 1
                                        TextInput::make('about_pilar_1_icon')
                                            ->label('Pilar 1 - Icono (Material Symbol)')
                                            ->helperText('Nombre del icono de Google Material Symbols. Ej: verified, chair_alt, eco'),
                                        TextInput::make('about_pilar_1_title')
                                            ->label('Pilar 1 - Título'),
                                        Textarea::make('about_pilar_1_desc')
                                            ->label('Pilar 1 - Descripción')
                                            ->rows(2),

                                        // Pilar 2
                                        TextInput::make('about_pilar_2_icon')
                                            ->label('Pilar 2 - Icono (Material Symbol)'),
                                        TextInput::make('about_pilar_2_title')
                                            ->label('Pilar 2 - Título'),
                                        Textarea::make('about_pilar_2_desc')
                                            ->label('Pilar 2 - Descripción')
                                            ->rows(2),

                                        // Pilar 3
                                        TextInput::make('about_pilar_3_icon')
                                            ->label('Pilar 3 - Icono (Material Symbol)'),
                                        TextInput::make('about_pilar_3_title')
                                            ->label('Pilar 3 - Título'),
                                        Textarea::make('about_pilar_3_desc')
                                            ->label('Pilar 3 - Descripción')
                                            ->rows(2),
                                    ])
                                    ->columns(3),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
