## 🛠️ Aplicación de Servicios - Backend (PHP-Laravel)

Este proyecto es el backend de una aplicación mobile de servicios. El frontend se encuentra desarrollado con *React Native*.
Permite conectar a clientes con profesionales de diversas áreas (electricistas, carpinteros, plomeros, etc.), gestionar perfiles, servicios ofrecidos y turnos (appointments).

Incluye autenticación segura mediante *Laravel Sanctum*, funcionalidades CRUD completas, exportación de reportes y una estructura de datos relacional.

---


### 👥 Equipo

Estudiantes de 2do año de la Tecnicatura Universitaria en Programacion (TUP)
Universidad Tecnologia Nacional - Facultad Regional de Resistencia (UTN FRRe)
🧑‍💻 Luque Encina, Florencia
🧑‍💻 Molo, Cecilia
🧑‍💻 Ranz, Nahuel
🧑‍💻 Silva, Alejandra Aliné
🧑‍💻 Velozo Godoy, Matias

---

### 📁 Estructura del Proyecto

El sistema se compone de las siguientes entidades principales:

* **User**: Usuario base autenticado. Puede tener rol de `cliente` o `profesional`, y opcionalmente ser `premium`.
* **Profile**: Información personal y profesional del usuario (nombre, dirección, experiencia, etc.).
* **Category**:  Área general de servicios (Ej: Hogar, Tecnología, Belleza).
* **Subcategory**: Especialización dentro de una categoría (Ej: Electricista, Plomero).
* **Service**: Servicios específicos publicados por profesionales, con precio, descripción y subcategoría asociada.
* **Appointment**: Turnos solicitados por clientes para contratar un servicio ofrecido por un profesional. Incluyen fecha, hora, ubicación y estado.

---

### 🔐 Autenticación con Laravel Sanctum

El sistema implementa autenticación basada en tokens mediante *Laravel Sanctum*, lo que permite:

* Login con email y contraseña.
* Generación de tokens de acceso.
* Protección de rutas usando `auth:sanctum`.
* Diferenciación de permisos según el rol del usuario.

---

### ✅ Funcionalidades Implementadas

**1. Autenticación y seguridad**

* Registro e inicio de sesión con validaciones.
* Roles de usuario (`cliente`, `profesional`).
* Middleware para proteger rutas sensibles.

**2. Gestión de usuarios y perfiles**

* Asociación entre usuario y perfil.
* CRUD de perfiles.

**3. Gestión de servicios**

* Los profesionales pueden publicar servicios.
* Los servicios se agrupan en categorías y subcategorías.

**4. Turnos (appointments)**

* Los clientes pueden solicitar turnos a profesionales.
* Estado del turno: `pendiente`, `confirmado`, `cancelado`.
* Los turnos incluyen fecha, hora, ubicación y servicio contratado.

**5. Reportes**

* Exportación de datos a *PDF* y *Excel* (servicios y turnos).
* Generación dinámica de reportes con DomPDF y Laravel Excel.

---

### 🧪 Herramientas y tecnologías

* PHP 8+
* Laravel 12+
* Laravel Sanctum
* Laravel Excel
* DomPDF
* Eloquent ORM
* Seeders & Factories
* Middleware y validaciones de Laravel

---

### 🚀 Instalación del proyecto

```bash
git clone https://github.com/LuqueFlorencia/service-app-api.git
cd service-app-api
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

---

### 📌 Rúbrica para el Trabajo Final de Programación III con Laravel
* 1️⃣ Estructura y Modelado de Datos (20 puntos)
* ✔️ Cantidad mínima de tablas: El proyecto debe incluir al menos cinco tablas correctamente estructuradas. (4 puntos)
* ✔️ Relaciones entre entidades: Se deben implementar al menos tres relaciones uno a muchos de manera adecuada. (6 puntos)
* ✔️ Uso de migraciones: Las tablas y relaciones deben ser creadas mediante migraciones de Laravel. (5 puntos)
* ✔️ Integridad referencial: Uso correcto de claves foráneas y restricciones para garantizar la coherencia de los datos. (5 puntos)

* 2️⃣ Funcionalidad y Lógica de Negocio (25 puntos)
* ✔️ Autenticación y seguridad: Implementación de un sistema de autenticación con gestión de roles y permisos. (6 puntos)
* ✔️ Operaciones CRUD: Correcta implementación de las operaciones de creación, lectura, actualización y eliminación. (6 puntos)
* ✔️ Validaciones: Aplicación de reglas de validación en formularios para garantizar la integridad de los datos. (5 puntos)
* ✔️ Manejo de errores y excepciones: Gestión de respuestas adecuadas ante posibles errores del sistema. (4 puntos)
* ✔️ Optimización de consultas: Uso de Eloquent y query builders para mejorar la eficiencia y rendimiento. (4 puntos)

* 3️⃣ Generación de Reportes y Exportaciones (15 puntos)
* ✔️ Exportación de datos: Implementación de funcionalidades para exportar registros a formatos Excel y PDF. (6 puntos)
* ✔️ Reportes dinámicos en PDF: Uso de herramientas como DomPDF para generar informes personalizados. (5 puntos)
* ✔️ Interfaz de descarga: Inclusión de botones o enlaces funcionales para la descarga de reportes. (4 puntos)

* 4️⃣ Interfaz y Usabilidad (15 puntos)
* ✔️ Diseño responsivo: Adaptación a distintos dispositivos mediante el uso de Bootstrap o Tailwind CSS. (5 puntos)
* ✔️ Interfaz intuitiva: Organización clara de las funcionalidades y navegación eficiente. (5 puntos)
* ✔️ Uso de AJAX: Implementación de llamadas asincrónicas para mejorar la experiencia del usuario. (5 puntos)

* 5️⃣ Documentación y Presentación (15 puntos)
* ✔️ Código estructurado y documentado: Uso de comentarios explicativos y buenas prácticas de programación. (5 puntos)
* ✔️ Guía de instalación y uso: Documentación detallada sobre la configuración y despliegue del sistema. (5 puntos)
* ✔️ Presentación del proyecto: Exposición oral con demostración funcional de la aplicación. (5 puntos)

**Total: 100 puntos**
