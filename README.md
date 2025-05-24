
# Club Deportivo de Ajedrez Los Navalucillos

## UX/UI Theme Design & Proyecto Web

Bienvenido al repositorio del desarrollo web para el Club Deportivo de Ajedrez Los Navalucillos. Este documento resume el análisis UX/UI, la paleta de colores, las fuentes recomendadas, la estructura del proyecto y mejores prácticas para crear un sitio profesional, escalable y visualmente atractivo.

---

## 1. Paleta de Colores

| Color     | HEX      | Uso                        |
|-----------|----------|---------------------------|
| Verde     | #30853D  | Color primario, botones   |
| Blanco    | #FFFFFF  | Fondo principal           |
| Negro     | #212121  | Texto principal           |
| Oro       | #E7C046  | Detalles, trofeos         |
| Rojo      | #BC2530  | Detalles menores/corona   |
| Gris      | #F4F5F7  | Fondos secundarios        |

---

## 2. Tipografías

- **Headers:** Montserrat Bold, 36-48px
- **Subheaders:** Montserrat SemiBold, 28-32px
- **Texto:** Open Sans / Roboto, 18-20px

> Todas disponibles en Google Fonts.

---

## 3. Estructura de Carpetas del Proyecto

```plaintext
/club-navalucillos/
- assets/
  - images/
  - icons/
  - banners/
  - backgrounds/
- src/
  - components/
  - pages/
  - styles/
  - widgets/
- public/
  - favicon.ico
  - logo.svg
  - robots.txt
- docs/
  - UX-UI-Navalucillos.md
  - prompts-sora.md
- lichess/
  - api/
  - ranking/
- ecommerce/
  - tienda/
- config/
  - wordpress/
- README.md
```

---

## 4. Secciones y Navegación Web

- **Home / Landing Page:** Banner, llamada a la acción, últimas noticias.
- **Quiénes Somos:** Historia, valores, equipo, fotos.
- **Actividades y Clases:** Horarios, edades, beneficios, instructores.
- **Torneos y Eventos:** Calendario, resultados, galería.
- **Ranking del Club:** Tabla de jugadores (puede integrarse con Lichess vía API).
- **Galería:** Imágenes, trofeos, eventos.
- **Contacto:** Formulario, teléfonos, WhatsApp.
- **Enlaces:** Acceso directo a la sala Lichess y redes sociales.
- **Tienda/E-commerce:** Camisetas, tableros, merchandising (opcional).

---

## 5. Recursos Visuales: Medidas y Resoluciones

| Elemento           | Resolución recomendada |
|--------------------|-----------------------|
| Banner principal   | 1920x600 px           |
| Banner sección     | 1200x500 px           |
| Iconos             | 128x128 px (PNG/SVG)  |
| Cards/infografías  | 600x400 px / SVG      |
| Fondos             | 1920x1080 px          |

---

## 6. Prompts para Imágenes (Sora/Inkscape)

```plaintext
A vibrant chess club hero banner for a website. Community and learning theme, children and adults playing chess, green and white palette, with local trophies and club logo. 1920x600 px.
```

---

## 7. Ejemplo de Fragmento CSS de Theme

```css
:root {
  --primary-green: #30853D;
  --primary-white: #FFFFFF;
  --text-black: #212121;
  --accent-gold: #E7C046;
  --accent-red: #BC2530;
  --bg-grey: #F4F5F7;
}

body {
  background-color: var(--primary-white);
  color: var(--text-black);
  font-family: 'Open Sans', Arial, sans-serif;
}
.header {
  background: var(--primary-green);
  color: var(--primary-white);
}
.button-primary {
  background: var(--primary-green);
  color: var(--primary-white);
  border-radius: 4px;
  padding: 10px 30px;
  font-weight: bold;
  transition: background 0.3s;
}
.button-primary:hover {
  background: var(--accent-gold);
  color: var(--text-black);
}
```

---

## 8. Integraciones Recomendadas

- **Widget Lichess:** Puedes usar la [API de Lichess](https://lichess.org/api) para mostrar ranking o enlaces directos al club.
- **Calendario de torneos:** Integración con Google Calendar o plugin compatible WordPress.
- **Formulario de contacto:** WPForms, Contact Form 7 o integración personalizada.

---

## 9. Buenas Prácticas y Inspiración

- Diseño responsivo y mobile-first.
- Menú de navegación claro y fijo.
- Imágenes originales del club.
- Accesibilidad: textos alternativos, buen contraste, fuentes legibles.
- Inspiración: revisa [Club Ajedrez La Dama](https://www.ajedrezladama.com), [Alcobendas](https://ajedrezalcobendas.com/), [Barcelona](https://www.escacsclubbarcelona.com/).

---

## 10. Próximos Pasos

1. Estructurar prototipo navegable en Figma (base desktop 1440px).
2. Cargar paleta y tipografías en Figma/WordPress.
3. Generar imágenes con Sora/Inkscape siguiendo los prompts.
4. Desarrollar Home + Hero Banner.
5. Avanzar sección por sección.
6. Documentar cambios en el repositorio y mantener este README actualizado.

---

> Documento generado por CarlosLH, 2025 — Licencia libre, uso comunitario.
