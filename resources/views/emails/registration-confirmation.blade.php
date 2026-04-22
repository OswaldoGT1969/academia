<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirma tu registro</title>
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #0f172a;
            color: #f8fafc;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            mid-width: 320px;
            margin: 40px auto;
            background-color: #1e293b;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
            border: 1px solid #334155;
        }
        .header {
            background-color: #0f172a;
            padding: 30px;
            text-align: center;
        }
        .header img {
            max-height: 50px;
            border-radius: 8px;
        }
        .content {
            padding: 40px;
        }
        h1 {
            color: #ffffff;
            font-size: 24px;
            font-weight: 700;
            margin-top: 0;
            margin-bottom: 20px;
            text-align: center;
        }
        p {
            margin-bottom: 24px;
            color: #cbd5e1;
        }
        .button-container {
            text-align: center;
            margin-bottom: 30px;
        }
        .button {
            display: inline-block;
            background-color: #FF6600;
            color: #ffffff !important;
            padding: 14px 28px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.2s;
        }
        .button:hover {
            background-color: #E65C00;
        }
        .footer {
            padding: 20px 40px;
            background-color: #0f172a;
            font-size: 13px;
            color: #64748b;
            text-align: center;
        }
        .link {
            word-break: break-all;
            color: #FF6600;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <!-- Asumiendo que existe el logo, si no se mostrará el nombre de la app -->
            <img src="{{ asset('images/logo-buenfil.jpg') }}" alt="{{ config('app.name') }}">
        </div>
        <div class="content">
            <h1>¡Hola, {{ $pendingRegistration->name }}!</h1>
            <p>Gracias por registrarte en <strong>{{ config('app.name') }}</strong>. Para activar tu cuenta y comenzar a aprender, por favor confirma tu correo electrónico haciendo clic en el siguiente botón:</p>
            
            <div class="button-container">
                <a href="{{ $url }}" class="button">Confirmar mi cuenta</a>
            </div>
            
            <p>Si el botón no funciona, puedes copiar y pegar el siguiente enlace en tu navegador:</p>
            <p class="link">{{ $url }}</p>
            
            <p>Si no creaste esta cuenta, puedes ignorar este mensaje.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>
