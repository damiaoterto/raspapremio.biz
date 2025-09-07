<?php
require_once '../conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $nomeSite; ?> - Jogo Resposável</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Styles -->
    <link rel="stylesheet" href="/assets/style/globalStyles.css?id=<?= time(); ?>">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.8/dist/notiflix-aio-3.2.8.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/notiflix@3.2.8/src/notiflix.min.css" rel="stylesheet">

    <style>
        /* Base Styles from user */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #0a0a0a;
            color: #ffffff;
            overflow-x: hidden;
        }

        /* width */
        ::-webkit-scrollbar {
          width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
          background: transparent !important;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
          background: #22c55e;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
          background: #16a34a;
        }

        .primary-text {
            color: #22c55e;
        }

        /* Header Styles */
        .header {
            background: rgba(10, 10, 10, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(34, 197, 94, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 1rem 0;
        }

        .header-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.5rem;
            font-weight: 800;
            color: #22c55e;
            text-decoration: none;
        }

        .logo-icon {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #22c55e, #16a34a);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 2rem;
            list-style: none;
        }

        .nav-menu a {
            color: #e5e7eb;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-menu a:hover {
            color: #22c55e;
        }

        .nav-menu a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: #22c55e;
            transition: width 0.3s ease;
        }

        .nav-menu a:hover::after {
            width: 100%;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .btn-login {
            color: #e5e7eb;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .btn-login:hover {
            color: #22c55e;
        }

        .btn-register {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            color: white;
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(34, 197, 94, 0.3);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(34, 197, 94, 0.4);
        }

        /* Page Specific Styles */
        .page-container {
            max-width: 900px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            padding: 12rem 2rem 6rem 2rem; /* Adjusted padding */
        }

        .page-container header {
            display: flex;
            flex-direction: column;
            margin-bottom: 3rem;
            align-items: center;
            text-align: center;
        }

        .page-container header h1 {
            font-size: 3rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 0.5rem;
        }

        .page-container header p {
            color: #9ca3af;
        }

        .page-content {
            background: #111111;
            border: 1px solid rgba(34, 197, 94, 0.1);
            border-radius: 16px;
            padding: 2rem;
        }

        .page-content > * + * {
            margin-top: 2.5rem;
        }

        .page-welcome {
            margin-bottom: 3rem;
            font-size: 1.1rem;
            line-height: 1.7;
            color: #e5e7eb;
        }

        .page-section h2 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #22c55e;
            border-bottom: 1px solid rgba(34, 197, 94, 0.2);
            padding-bottom: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .page-section h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #e5e7eb;
            margin-top: 1.5rem;
            margin-bottom: 1rem;
        }

        .page-section p, .page-section li {
            font-size: 1rem;
            color: #d1d5db;
            line-height: 1.8;
        }

        .page-section ul {
            list-style-position: inside;
            padding-left: 1rem;
            margin-top: 1rem;
        }

        .page-section ul li + li {
            margin-top: 0.5rem;
        }

        .page-section a {
            color: #22c55e;
            text-decoration: none;
            font-weight: 500;
        }

        .page-section a:hover {
            text-decoration: underline;
        }

        /* Footer */
        .footer {
            background: #0f0f0f;
            border-top: 1px solid rgba(34, 197, 94, 0.1);
            padding: 3rem 0 2rem;
        }

        .footer-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 3rem;
            margin-bottom: 2rem;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.5rem;
            font-weight: 800;
            color: #22c55e;
            margin-bottom: 1rem;
            text-decoration: none;
        }

        .footer-description {
            color: #9ca3af;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .footer-section h3 {
            color: white;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.5rem;
        }

        .footer-links a {
            color: #9ca3af;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: #22c55e;
        }

        .footer-bottom {
            border-top: 1px solid rgba(34, 197, 94, 0.1);
            padding-top: 2rem;
            text-align: center;
            color: #6b7280;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-menu { display: none; } /* Simplified for this page */
            .footer-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            .page-container {
                padding: 10rem 1rem 4rem 1rem;
            }
            .page-container header h1 {
                font-size: 2.5rem;
            }
            .page-content {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <?php include('../inc/header.php'); ?>

    <!-- Main Content -->
    <main class="page-container">
        <header>
            <h1>Política de Jogo Responsável</h1>
            <p>O seu bem-estar é a nossa prioridade.</p>
        </header>

        <p class="page-welcome">
            No <strong class="primary-text">Raspapremio.biz</strong>, estamos comprometidos em oferecer um ambiente de jogo divertido, justo e, acima de tudo, seguro. Encaramos o jogo responsável como um pilar fundamental da nossa operação e queremos que sua experiência seja sempre positiva e controlada.
        </p>

        <div class="page-content">
            <!-- Seção 1: Nosso Compromisso -->
            <div class="page-section">
                <h2>1. Nosso Compromisso</h2>
                <p>O nosso objetivo é garantir que você jogue de forma consciente. Estamos empenhados em prevenir o jogo compulsivo e o acesso de menores de idade à nossa plataforma. O jogo deve ser uma forma de entretenimento, e não uma fonte de problemas financeiros ou sociais.</p>
            </div>

            <!-- Seção 2: Ferramentas de Jogo Responsável -->
            <div class="page-section">
                <h2>2. Ferramentas de Controle</h2>
                <p>Oferecemos um conjunto de ferramentas para ajudá-lo a gerenciar seu jogo e manter o controle total sobre suas atividades:</p>
                <h3>Limites de Depósito</h3>
                <p>Você pode definir limites diários, semanais ou mensais para o valor que pode depositar em sua conta. Isso ajuda a controlar seus gastos e a garantir que você não jogue mais do que pode.</p>
                <h3>Autoexclusão</h3>
                <p>Se sentir que precisa de uma pausa mais longa, pode optar pela autoexclusão. Este recurso bloqueará o acesso à sua conta por um período definido (de 6 meses a 5 anos) ou permanentemente. Durante este período, você não poderá jogar nem receber materiais promocionais.</p>
                <h3>Pausa na Conta</h3>
                <p>Para pausas mais curtas, a ferramenta de "Pausa" permite que você bloqueie sua conta por um período de 24 horas a 6 semanas.</p>
                 <h3>Histórico de Atividades</h3>
                 <p>Acesse facilmente seu histórico completo de transações, depósitos, saques e resultados de jogos para acompanhar suas atividades na plataforma.</p>
            </div>

            <!-- Seção 3: Identificando o Jogo Problemático -->
            <div class="page-section">
                <h2>3. Sinais de Alerta</h2>
                <p>Se você está preocupado com seus hábitos de jogo, faça a si mesmo as seguintes perguntas:</p>
                 <ul>
                    <li>Você gasta mais dinheiro ou tempo jogando do que pretendia?</li>
                    <li>Você tenta recuperar perdas jogando mais?</li>
                    <li>O jogo já interferiu em suas responsabilidades profissionais ou familiares?</li>
                    <li>Você já mentiu sobre a quantidade de tempo ou dinheiro que gasta com o jogo?</li>
                    <li>Você joga para escapar de preocupações ou problemas?</li>
                </ul>
                <p>Se respondeu "sim" a várias dessas perguntas, pode ser um sinal de que precisa de ajuda.</p>
            </div>

            <!-- Seção 4: Ajuda e Suporte -->
            <div class="page-section">
                <h2>4. Onde Procurar Ajuda</h2>
                <p>Existem organizações profissionais que oferecem suporte gratuito e confidencial para pessoas que enfrentam problemas com o jogo. Se você ou alguém que conhece precisa de ajuda, recomendamos entrar em contato com:</p>
                <ul>
                    <li><strong>Jogadores Anônimos Brasil:</strong> Oferece grupos de apoio em todo o país.</li>
                    <li><strong>Gambling Therapy:</strong> Fornece suporte online e aconselhamento gratuito.</li>
                </ul>
            </div>

            <!-- Seção 5: Proteção de Menores -->
            <div class="page-section">
                <h2>5. Proteção de Menores</h2>
                <p>O registro no Raspapremio.biz é estritamente proibido para menores de 18 anos. Realizamos verificações de idade e identidade para garantir a conformidade. Recomendamos que os pais utilizem softwares de filtragem (como Net Nanny ou CyberPatrol) para impedir que menores de idade acessem sites de jogos.</p>
            </div>

            <!-- Seção 6: Contato -->
            <div class="page-section">
                <h2>6. Fale Conosco</h2>
                <p>Se desejar ativar qualquer uma das nossas ferramentas de jogo responsável ou se tiver alguma dúvida, não hesite em contatar nossa equipe de suporte pelo e-mail: <a href="mailto:suporte@raspapremio.biz">suporte@raspapremio.biz</a>.</p>
            </div>
        </div>
    </main>
    <?php include('../inc/footer.php'); ?>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Add spin animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes spin {
                    0% { transform: rotate(0deg); }
                    100% { transform: rotate(360deg); }
                }
            `;
            document.head.appendChild(style);

            // Focus enhancements
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach(input => {
                input.addEventListener('focus', function () {
                    this.parentElement.style.transform = 'translateY(-2px)';
                });

                input.addEventListener('blur', function () {
                    this.parentElement.style.transform = 'translateY(0)';
                });
            });
        });

        // Notiflix configuration
        Notiflix.Notify.init({
            width: '300px',
            position: 'right-top',
            distance: '20px',
            opacity: 1,
            borderRadius: '12px',
            timeout: 4000,
            success: {
                background: '#22c55e',
                textColor: '#fff',
            },
            failure: {
                background: '#ef4444',
                textColor: '#fff',
            },
            warning: {
                background: '#f59e0b',
                textColor: '#fff',
            }
        });

        // Show messages if any
        <?php if (isset($_SESSION['message'])): ?>
                Notiflix.Notify.<?php echo $_SESSION['message']['type']; ?>('<?php echo $_SESSION['message']['text']; ?>');
                <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        console.log('%c🔐 Página de Login carregada!', 'color: #22c55e; font-size: 16px; font-weight: bold;');
    </script>
</body>

</html>
