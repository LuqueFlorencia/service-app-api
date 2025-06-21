<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Backend - Dilo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .section-title {
            border-bottom: 2px solid #50B0DA;
            padding-bottom: 0.5rem;
            margin-top: 2rem;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container py-5">
        <h1 class="text-center text-primary mb-4">🛠️ Backend - Aplicación de Servicios ("Dilo")</h1>

        <p class="lead text-center">
            Este proyecto es el backend desarrollado en <strong>Laravel</strong> de una app mobile desarrollada con <strong>React Native</strong>. 
            Permite conectar clientes con profesionales.
        </p>

        <div class="alert alert-info mt-4">
            Laravel 12 + Sanctum + Eloquent + Reportes PDF/Excel + Autenticación por Roles
        </div>

        <h2 class="section-title">👥 Equipo de Desarrollo</h2>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">🧑‍💻 Luque Encina, Florencia</li>
            <li class="list-group-item">🧑‍💻 Molo, Cecilia</li>
            <li class="list-group-item">🧑‍💻 Ranz, Nahuel</li>
            <li class="list-group-item">🧑‍💻 Silva, Alejandra Aliné</li>
            <li class="list-group-item">🧑‍💻 Velozo Godoy, Matías</li>
        </ul>

        <h2 class="section-title">🚀 Instalación</h2>
        <a href="https://github.com/alinesilmer/services-app-project" class="btn btn-link" target="_blank">
            🔗 Ver repositorio en GitHub del FRONTEND
        </a>
        <a href="https://github.com/LuqueFlorencia/service-app-api" class="btn btn-link" target="_blank">
            🔗 Ver repositorio en GitHub del BACKEND
        </a>

        <pre class="bg-dark text-white p-3 rounded">
    ## Clonar el repositorio y configurar el entorno
            git clone https://github.com/LuqueFlorencia/service-app-api.git

    ## Entrar al directorio del proyecto
            cd service-app-api

    ## Instalar dependencias de Composer
            composer install

    ## Configurar la base de datos en .env
            cp .env.example .env

    ## Generar la clave de aplicación
            php artisan key:generate

    ## Migrar la base de datos y sembrar datos iniciales
            php artisan migrate --seed

    ## Iniciar el servidor de desarrollo
            php artisan serve
        </pre>

        <h2 class="section-title mt-5">✅ Funcionalidades Implementadas</h2>

        <div class="accordion" id="funcionalidadesAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                        1. Autenticación y seguridad
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#funcionalidadesAccordion">
                    <div class="accordion-body">
                        <ul>
                            <li>Registro e inicio de sesión con validaciones.</li>
                            <li>Roles de usuario: <code>cliente</code> y <code>profesional</code>.</li>
                            <li>Middleware para proteger rutas sensibles.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                        2. Gestión de usuarios y perfiles
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#funcionalidadesAccordion">
                    <div class="accordion-body">
                        <ul>
                            <li>Asociación entre usuario y perfil.</li>
                            <li>CRUD completo de perfiles.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                        3. Gestión de servicios
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#funcionalidadesAccordion">
                    <div class="accordion-body">
                        <ul>
                            <li>Profesionales pueden publicar servicios.</li>
                            <li>Servicios organizados por categoría y subcategoría.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                        4. Turnos (appointments)
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#funcionalidadesAccordion">
                    <div class="accordion-body">
                        <ul>
                            <li>Clientes pueden solicitar turnos a profesionales.</li>
                            <li>Estados del turno: <code>pendiente</code>, <code>confirmado</code>, <code>cancelado</code>.</li>
                            <li>Incluyen fecha, hora, ubicación y servicio contratado.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive">
                        5. Reportes
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#funcionalidadesAccordion">
                    <div class="accordion-body">
                        <ul>
                            <li>Exportación de datos a formatos: <code>PDF</code> y <code>Excel</code>.</li>
                            <li>Reportes dinámicos generados con DomPDF y Laravel Excel.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <h2 class="section-title">📁 Entidades del Sistema</h2>
        <ul>
            <li><strong>User</strong>: Usuario autenticado. Puede tener rol de <code>cliente</code> o <code>profesional</code>, y ser <code>premium</code> opcionalmente.</li>
            <li><strong>Profile</strong>: Información personal y profesional del usuario (nombre, dirección, experiencia, etc.).</li>
            <li><strong>Category</strong>: Área general de servicios (Ej: Hogar, Tecnología, Belleza).</li>
            <li><strong>Subcategory</strong>: Especialización dentro de una categoría (Ej: Electricista, Plomeria, Peluqueria).</li>
            <li><strong>Service</strong>: Servicios específicos publicados por profesionales, con precio, descripción y subcategoría asociada.</li>
            <li><strong>Appointment</strong>: Turnos solicitados por clientes para contratar un servicio ofrecido por un profesional. Incluyen fecha, hora, ubicación y estado.</li>
        </ul>

        <h2 class="section-title">🧭 Relación entre entidades</h2>
        <div class="text-center">
            <img src="{{ asset('images/diagrama_entidades.png') }}" class="img-fluid" alt="Diagrama de entidades">
        </div>

        <h2 class="section-title mt-5">📄 Generación de Reportes y Exportaciones</h2>
        <p>El sistema permite exportar datos de servicios y turnos en distintos formatos, cumpliendo con los requisitos del trabajo final:</p>

        <div class="d-flex gap-3 mt-3">
            <a href="{{ route('reports.services.pdf') }}" class="btn btn-outline-danger">
                📄 Descargar Servicios (PDF)
            </a>

            <a href="{{ route('reports.services.excel') }}" class="btn btn-outline-success">
                📊 Descargar Servicios (Excel)
            </a>

            <a href="{{ route('reports.appointments.pdf') }}" class="btn btn-outline-danger">
                📄 Descargar Turnos (PDF)
            </a>

            <a href="{{ route('reports.appointments.excel') }}" class="btn btn-outline-success">
                📊 Descargar Turnos (Excel)
            </a>
        </div>


        <footer class="text-center mt-5 text-muted">
            <small>&copy; 2025 - Proyecto Final UTN FRRe - Programación III</small>
        </footer>
    </div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

