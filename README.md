# Enviam - Preservando tus Recuerdos en Calidad Original

**Curso:** 2º DAW  
**Proyecto del Ciclo:** Desarrollo de Aplicaciones Web  
**Alumno:** Francisco Carlos Beltran Arsene

Enviam es una plataforma web diseñada para compartir fotos en su calidad original, abordando la necesidad de preservar la integridad de las imágenes y sus metadatos al compartirlas en línea.

## Características Principales

- **Preservación de la Calidad Original:** Enviam permite subir y compartir fotos sin pérdida de calidad, a diferencia de plataformas que comprimen las imágenes.
- **Metadatos Intactos:** Conserva los metadatos de las fotos (fecha, ubicación, cámara, etc.), enriqueciendo la información asociada a cada recuerdo.
- **Facilidad de Uso:** Interfaz intuitiva para crear enlaces ("Momentos") donde otros pueden subir y descargar fotos fácilmente.
- **Privacidad del Usuario:** Enviam se preocupa por la privacidad del usuario y no requiere registro para subir o descargar fotos.
- **Seguridad:** Implementa medidas de seguridad para proteger los datos de los usuarios.

## Tecnologías Utilizadas

- **Backend:** PHP, Laravel
- **Frontend:** JavaScript, Tailwind CSS, Flowbite (biblioteca de componentes)
- **Base de Datos:** MySQL/MariaDB

## Instalación y Configuración (para desarrolladores)

1. Clonar el repositorio:
   ```bash
   git clone https://github.com/cuantocarlos/Enviam.git
    cd Enviam
    ```
2. Instalar dependencias:
    ```bash
    composer install
    npm install
    ```
3. Crear archivo de configuración `.env` y configurar la base de datos.
4. Generar clave de aplicación:
    ```bash
    php artisan key:generate
    ```
5. Ejecutar migraciones y semillas:
    ```bash
    php artisan migrate --seed
    ```
## Contribuciones

Las contribuciones son bienvenidas. Puedes informar de problemas o sugerir mejoras a través de la sección de "Issues" en GitHub.

## Licencia

Este proyecto se distribuye bajo la Licencia AGPL.

## Contacto

fco.carlos@pm.me
