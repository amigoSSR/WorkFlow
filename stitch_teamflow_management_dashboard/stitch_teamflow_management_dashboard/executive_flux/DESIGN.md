---
name: Executive Flux
colors:
  surface: '#f8f9ff'
  surface-dim: '#cbdbf5'
  surface-bright: '#f8f9ff'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#eff4ff'
  surface-container: '#e5eeff'
  surface-container-high: '#dce9ff'
  surface-container-highest: '#d3e4fe'
  on-surface: '#0b1c30'
  on-surface-variant: '#3e4949'
  inverse-surface: '#213145'
  inverse-on-surface: '#eaf1ff'
  outline: '#6e7979'
  outline-variant: '#bdc9c8'
  surface-tint: '#006a6a'
  primary: '#006565'
  on-primary: '#ffffff'
  primary-container: '#008080'
  on-primary-container: '#e3fffe'
  inverse-primary: '#76d6d5'
  secondary: '#455f88'
  on-secondary: '#ffffff'
  secondary-container: '#b6d0ff'
  on-secondary-container: '#3f5882'
  tertiary: '#8b4823'
  on-tertiary: '#ffffff'
  tertiary-container: '#a96039'
  on-tertiary-container: '#fff9f7'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#93f2f2'
  primary-fixed-dim: '#76d6d5'
  on-primary-fixed: '#002020'
  on-primary-fixed-variant: '#004f4f'
  secondary-fixed: '#d6e3ff'
  secondary-fixed-dim: '#adc7f7'
  on-secondary-fixed: '#001b3c'
  on-secondary-fixed-variant: '#2d476f'
  tertiary-fixed: '#ffdbcb'
  tertiary-fixed-dim: '#ffb692'
  on-tertiary-fixed: '#341100'
  on-tertiary-fixed-variant: '#733512'
  background: '#f8f9ff'
  on-background: '#0b1c30'
  surface-variant: '#d3e4fe'
typography:
  headline-xl:
    fontFamily: Inter
    fontSize: 32px
    fontWeight: '700'
    lineHeight: 40px
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Inter
    fontSize: 24px
    fontWeight: '600'
    lineHeight: 32px
    letterSpacing: -0.01em
  headline-md:
    fontFamily: Inter
    fontSize: 20px
    fontWeight: '600'
    lineHeight: 28px
  body-lg:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  body-md:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '400'
    lineHeight: 20px
  label-md:
    fontFamily: Inter
    fontSize: 12px
    fontWeight: '600'
    lineHeight: 16px
    letterSpacing: 0.05em
  headline-lg-mobile:
    fontFamily: Inter
    fontSize: 20px
    fontWeight: '600'
    lineHeight: 28px
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  unit: 4px
  container-padding: 24px
  gutter: 16px
  sidebar-width: 260px
  card-gap: 20px
---

## Brand & Style

This design system is engineered for high-stakes operational environments where clarity, speed of thought, and reliability are paramount. The brand personality is **authoritative yet unobtrusive**, positioning itself as a silent partner in team productivity. It targets enterprise project managers, DevOps engineers, and executive stakeholders who require a "single source of truth" without cognitive overload.

The design style is **Corporate Modern**, leaning heavily into high-functional minimalism. It utilizes a structured "Information First" hierarchy, where decorative elements are stripped away in favor of data-driven aesthetics. The emotional response is one of **composed control**—users should feel that complex datasets are organized, manageable, and actionable.

## Colors

The palette is anchored by **Productive Teal (#008080)**, used strategically for primary actions and "active" status indicators, providing a calming yet energetic focus point. **Deep Blue (#1A365D)** serves as the grounding force, utilized for navigation backgrounds and high-level headings to convey institutional stability.

Supporting neutrals are pulled from a cool-grey spectrum to maintain a crisp, clinical feel. 
- **Surface:** White (#FFFFFF) for primary content cards to maximize contrast.
- **App Background:** Light Grey (#F8FAFC) to provide a soft containment for white cards.
- **Success/Warning/Error:** Use semantic variations of the teal (success), amber (warning), and a muted crimson (error) to maintain the professional tone.

## Typography

The design system exclusively employs **Inter** to leverage its exceptional legibility in data-heavy interfaces. The typographic scale follows a strict 4px baseline grid. 

- **Headlining:** Use `headline-xl` only for main dashboard titles. `headline-lg` and `md` are reserved for card titles and section headers.
- **Body Text:** `body-md` is the workhorse for all table data and descriptive text. 
- **Labels:** Small caps and increased letter spacing are applied to `label-md` for use in table headers and small metadata tags to distinguish them from actionable content.
- **Weights:** Limit usage to 400 (Regular), 600 (Semi-bold), and 700 (Bold) to maintain a clean, rhythmic appearance.

## Layout & Spacing

This design system uses a **Fixed-Fluid Hybrid** model. The sidebar remains at a fixed width of 260px, while the main content area utilizes a fluid 12-column grid.

- **Breakpoints:** Desktop (1280px+), Tablet (768px - 1279px), Mobile (up to 767px).
- **Margins:** 24px outer margins on desktop; 16px on mobile.
- **Guttering:** 16px or 20px consistently between data cards to ensure "breathing room" in dense information environments.
- **Alignment:** All elements must align to the 4px baseline. Vertical spacing between related items (e.g., a label and its input) should be 8px, while unrelated sections should be separated by at least 32px.

## Elevation & Depth

Visual hierarchy is achieved through **Tonal Layering** and **Ambient Shadows**. 

- **Level 0 (Background):** #F8FAFC (Light Grey). No shadows.
- **Level 1 (Cards/Sidebar):** #FFFFFF. Use a very soft, diffused shadow: `0px 1px 3px rgba(0,0,0,0.05), 0px 4px 6px rgba(0,0,0,0.02)`. This creates a subtle lift without looking "heavy."
- **Level 2 (Dropdowns/Modals):** High-contrast lift. Use a more pronounced shadow: `0px 10px 15px rgba(0,0,0,0.1)`.
- **Interactions:** On hover, cards should not lift higher but may receive a subtle 1px border stroke of the Primary Teal color to indicate focus.

## Shapes

The shape language is **Balanced and Professional**. A standard radius of 8px (`rounded`) is used for the majority of UI components including cards, buttons, and input fields. 

- **Standard (8px):** Primary container units.
- **Large (16px):** Used sparingly for large "hero" data visualizations or empty-state containers.
- **Full (Pill):** Reserved exclusively for status chips (e.g., "Online", "Completed") to differentiate them from actionable buttons.

## Components

- **Sidebar Navigation:** Use the Deep Blue (#1A365D) for the background. Active states should be indicated by a Teal (#008080) vertical bar on the left edge and a subtle background tint.
- **Data Cards:** Pure white background with 8px corner radius and Level 1 shadow. Title should be `headline-md`.
- **Buttons:** 
    - *Primary:* Solid Teal with white text. 
    - *Secondary:* Ghost style with Deep Blue border and text.
- **Interactive Tables:** Row height of 48px. Use a 1px border-bottom (#F1F5F9). On hover, the entire row should take a #F8FAFC tint.
- **Input Fields:** 1px solid border (#E2E8F0). Focus state uses 1px Primary Teal border with a 2px soft teal glow (20% opacity).
- **Activity Charts:** Use a palette of Teal, Blue, and Cool Grey. Avoid "vibrant" colors; keep data visualizations grounded and professional.
- **Status Chips:** High-contrast text on a low-opacity background of the same color (e.g., Teal text on 10% Teal background).