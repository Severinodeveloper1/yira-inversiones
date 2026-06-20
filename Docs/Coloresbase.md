---
name: Artesano Moderno
colors:
  surface: '#FCF9F8'
  surface-dim: '#ddd9d8'
  surface-bright: '#fdf8f8'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f7f2f2'
  surface-container: '#F0EDED'
  surface-container-high: '#ece7e7'
  surface-container-highest: '#e6e1e1'
  on-surface: '#1c1b1b'
  on-surface-variant: '#53433f'
  inverse-surface: '#313030'
  inverse-on-surface: '#f4f0ef'
  outline: '#86736e'
  outline-variant: '#d8c2bc'
  surface-tint: '#8c4d3b'
  primary: '#6c3424'
  on-primary: '#ffffff'
  primary-container: '#894b39'
  on-primary-container: '#ffc8b9'
  inverse-primary: '#ffb5a0'
  secondary: '#705a4c'
  on-secondary: '#ffffff'
  secondary-container: '#f8dac8'
  on-secondary-container: '#745e50'
  tertiary: '#47453e'
  on-tertiary: '#ffffff'
  tertiary-container: '#5f5c55'
  on-tertiary-container: '#dad5cc'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#ffdbd1'
  primary-fixed-dim: '#ffb5a0'
  on-primary-fixed: '#380d02'
  on-primary-fixed-variant: '#6f3726'
  secondary-fixed: '#fbddcb'
  secondary-fixed-dim: '#dec1b0'
  on-secondary-fixed: '#27180d'
  on-secondary-fixed-variant: '#574336'
  tertiary-fixed: '#e7e2d9'
  tertiary-fixed-dim: '#cbc6bd'
  on-tertiary-fixed: '#1d1b16'
  on-tertiary-fixed-variant: '#494740'
  background: '#fdf8f8'
  on-background: '#1c1b1b'
  surface-variant: '#e6e1e1'
  accent-terracotta: '#A6634F'
  outline-muted: '#D8C2BC'
typography:
  headline-xl:
    fontFamily: Manrope
    fontSize: 48px
    fontWeight: '500'
    lineHeight: '1.2'
    letterSpacing: -0.02em
  headline-xl-mobile:
    fontFamily: Manrope
    fontSize: 32px
    fontWeight: '500'
    lineHeight: '1.2'
    letterSpacing: -0.01em
  headline-lg:
    fontFamily: Manrope
    fontSize: 32px
    fontWeight: '500'
    lineHeight: '1.3'
  headline-md:
    fontFamily: Manrope
    fontSize: 24px
    fontWeight: '600'
    lineHeight: '1.4'
  body-lg:
    fontFamily: Manrope
    fontSize: 18px
    fontWeight: '400'
    lineHeight: '1.6'
  body-md:
    fontFamily: Manrope
    fontSize: 16px
    fontWeight: '400'
    lineHeight: '1.6'
  label-caps:
    fontFamily: Manrope
    fontSize: 14px
    fontWeight: '600'
    lineHeight: '1.0'
    letterSpacing: 0.1em
  button:
    fontFamily: Manrope
    fontSize: 14px
    fontWeight: '500'
    lineHeight: '1.0'
    letterSpacing: 0.05em
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  section-gap: 80px
  grid-gutter: 24px
  container-margin: 64px
  container-margin-mobile: 20px
  base-unit: 8px
---

## Brand & Style
Artesano Moderno is a design system that blends **high-end architectural precision** with **warm, artisanal craftsmanship**. It targets a sophisticated audience seeking a balance between corporate reliability and domestic comfort. 

The style is **Modern Minimalist with Tactile Accents**, characterized by generous whitespace, a refined earth-toned palette, and subtle organic textures (like natural paper grains) that prevent the interface from feeling cold. The visual language conveys maturity, quality, and timelessness, utilizing high-quality imagery and a structured editorial layout to elevate the product as an object of art.

## Colors
The palette is rooted in **Terracotta and Earth tones**, reflecting natural materials like clay, wood, and stone. 

- **Primary (#894B39):** A muted terracotta used for key CTAs and branding.
- **Surface (#FCF9F8):** An off-white, warm "paper" base that reduces eye strain and feels more premium than pure white.
- **Neutral (#1C1B1B):** A "soft black" used for high-contrast typography to maintain readability while appearing more natural.
- **Accents:** A secondary palette of warm greys and browns is used for structural elements like borders and backgrounds to create soft tonal shifts rather than harsh divisions.

## Typography
The system uses **Manrope** exclusively, a modern geometric sans-serif that balances functional efficiency with elegant proportions. 

- **Hierarchy:** Established through significant scale shifts and the use of **all-caps labels** for metadata and secondary headers to create an architectural rhythm.
- **Headlines:** Use tighter letter spacing and optical kerning to appear as solid blocks of text.
- **Body:** Generous line heights (1.6) ensure long-form readability, essential for storytelling around craftsmanship.
- **Navigation:** Buttons and links use a slightly increased letter spacing (0.05em) to improve clarity in lowercase and uppercase treatments.

## Layout & Spacing
The layout follows a **Fixed-Width Centered Grid** for desktop (max-width: 1280px) and a fluid, single-column layout for mobile. 

- **Rhythm:** A base-8 spacing system is used for internal component padding, while large-scale "Section Gaps" (80px) provide the "breathing room" required for a minimalist aesthetic.
- **Grid:** A 12-column grid is standard for desktop, but many components (like Product Cards) operate on a 3 or 4-column span to maintain high visibility of product imagery.
- **Safe Areas:** Mobile views utilize a 20px side margin, while desktop scales up to a 64px margin to frame the content.

## Elevation & Depth
Elevation is handled through **Tonal Layering** and **Subtle Materiality** rather than aggressive shadows.

- **Surfaces:** Depth is created by placing white (lowest) or light-grey surfaces against the warm-off-white background. 
- **Shadows:** When used (e.g., product cards on hover), shadows are extremely diffused (`shadow-xl`), low-opacity, and tinted with a hint of the secondary brown to maintain a "natural" light feel.
- **Backdrop Blur:** The navigation bar uses a `90%` opacity background with a blur filter to suggest a physical layer of glass moving over the content.
- **Texture:** A global grain overlay (5% opacity) is applied to sections to simulate a high-quality paper or matte texture.

## Shapes
The shape language is **Softly Structured**. 

- **Corners:** A base roundedness of `0.5rem` (8px) is applied to buttons, cards, and input fields. This softens the rigid grid layout, making the brand feel more approachable and less "corporate cold."
- **Pills:** Full-rounded shapes (9999px) are reserved specifically for badges (like notification counts) and slider indicators to draw contrast against the larger rectangular containers.
- **Images:** Always feature consistent corner radii to match the container they inhabit.

## Components
- **Buttons:** Primary buttons are large (16px+ padding), use the terracotta primary color, and feature all-caps text with letter spacing. They should include a subtle scale-down effect on active state.
- **Input Fields:** Use a white background with a light `outline-muted` border. Focus states transition the border to the primary terracotta.
- **Cards:** Product cards are borderless with a clean background. On hover, they reveal an "Add to Cart" action bar that slides up from the bottom, minimizing visual noise during the browsing phase.
- **Chips/Badges:** Small, high-contrast rectangles with 2px corner radii for "New" or "Limited Edition" tags.
- **Icons:** Use the *Material Symbols Outlined* set with a consistent weight of 400. Icons should be used sparingly as supporting visual cues.
- **Navigation:** Persistent top bar with high-blur background. Links feature a 2px bottom border on the active state for clear orientation.