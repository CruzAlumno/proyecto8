<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="theme-color" content="#000000"/>
    <meta name="description" content="Notificacion Por Correo Via Laravel Mailtrap"/>
    <meta name="keywords" content="HTML5, CSS, JavaScript, PHP, Laravel, React, Mail, Notification, Ecomaps"/>
    <meta name="author" content="KavX"/>
    <title>Notificacion Ecomaps</title>
</head>
<body>
    <main>
        <!-- Header -->
        @include('emails.mail-header')
        <!-- Content -->
        <section class="bg-red">
            @yield('content')
        </section>
    </main>
    <!-- Footer -->
    @include('emails.mail-footer')
</body>
</html>
