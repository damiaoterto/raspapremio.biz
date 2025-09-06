<?php
header('HTTP/1.1 503 Service Temporarily Unavailable');
header('Status: 503 Service Temporarily Unavailable');
header('Retry-After: 3600');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site em Manutenção</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');

        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #000000;
            color: #E0E0E0;
            font-family: 'Inter', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .container {
            max-width: 600px;
            padding: 20px;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #FFFFFF;
            margin-bottom: 1rem;
        }

        p {
            font-size: 1.2rem;
            line-height: 1.6;
        }

        .icon {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            color: #FFFFFF;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
              <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413-1.4-2.397 0-2.81l.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.858 2.929 2.929 0 0 1 0 5.858z"/>
            </svg>
        </div>
        <h1>Estamos em Manutenção</h1>
        <p>
            Nosso site está passando por uma manutenção programada para melhorar sua experiência.
            Voltaremos em breve. Agradecemos a sua paciência!
        </p>
    </div>

</body>
</html>
