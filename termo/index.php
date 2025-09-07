<?php
require_once '../conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $nomeSite; ?> - Termo de responsabilidade</title>

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

        /* Terms Page Specific Styles */
        .term-container {
            max-width: 900px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            padding: 12rem 2rem 6rem 2rem; /* Adjusted padding */
        }

        .term-container header {
            display: flex;
            flex-direction: column;
            margin-bottom: 3rem;
            align-items: center;
            text-align: center;
        }

        .term-container header h1 {
            font-size: 3rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 0.5rem;
        }

        .term-container header p {
            color: #9ca3af;
        }

        .term-content {
            background: #111111;
            border: 1px solid rgba(34, 197, 94, 0.1);
            border-radius: 16px;
            padding: 2rem;
        }

        .term-content > * + * {
            margin-top: 2.5rem;
        }

        .term-welcome {
            margin-bottom: 3rem;
            font-size: 1.1rem;
            line-height: 1.7;
            color: #e5e7eb;
        }

        .term-section h2 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #22c55e;
            border-bottom: 1px solid rgba(34, 197, 94, 0.2);
            padding-bottom: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .term-section p, .term-section li {
            font-size: 1rem;
            color: #d1d5db;
            line-height: 1.8;
        }

        .term-section ul {
            list-style-position: inside;
            padding-left: 1rem;
            margin-top: 1rem;
        }

        .term-section ul li + li {
            margin-top: 0.5rem;
        }

        .term-section a {
            color: #22c55e;
            text-decoration: none;
            font-weight: 500;
        }

        .term-section a:hover {
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
            .term-container {
                padding: 10rem 1rem 4rem 1rem;
            }
            .term-container header h1 {
                font-size: 2.5rem;
            }
            .term-content {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <?php include('../inc/header.php'); ?>

     <!-- Main Content -->
    <main class="term-container">
        <header>
            <h1>Termos e Condições de Uso</h1>
            <p>Última atualização: 07 de Setembro de 2025</p>
        </header>

        <p class="term-welcome">
            Bem-vindo ao <strong class="primary-text">Raspapremio.biz</strong>! Ao acessar e utilizar nosso site e nossos serviços, você concorda em cumprir e estar vinculado aos seguintes termos e condições. Por favor, leia-os com atenção.
        </p>

        <div class="term-content">
            <!-- Seção 1: Aceitação dos Termos -->
            <div class="term-section">
                <h2>1. Aceitação dos Termos</h2>
                <p>Ao se registrar ou jogar em nossa plataforma, você confirma que leu, entendeu e concorda em estar legalmente vinculado a estes Termos de Uso e à nossa Política de Privacidade. Se você não concordar com qualquer parte destes termos, não deverá usar o site.</p>
            </div>

            <!-- Seção 2: Elegibilidade -->
            <div class="term-section">
                <h2>2. Elegibilidade</h2>
                <p>Para criar uma conta e participar dos jogos no Raspapremio.biz, você deve:</p>
                <ul>
                    <li>Ter 18 anos de idade ou mais.</li>
                    <li>Residir em uma jurisdição onde a participação em jogos online é permitida por lei.</li>
                    <li>Fornecer informações de registro verdadeiras, precisas e completas.</li>
                </ul>
                <p>Reservamo-nos o direito de solicitar comprovação de idade e identidade a qualquer momento.</p>
            </div>

            <!-- Seção 3: Conta do Usuário -->
            <div class="term-section">
                <h2>3. Conta do Usuário</h2>
                <p>Você é o único responsável por manter a confidencialidade de sua senha e conta. Todas as atividades que ocorrem sob sua conta são de sua responsabilidade. Você concorda em notificar imediatamente o Raspapremio.biz sobre qualquer uso não autorizado de sua conta.</p>
            </div>

            <!-- Seção 4: Regras de Conduta -->
            <div class="term-section">
                <h2>4. Regras de Conduta</h2>
                <p>É estritamente proibido o uso de qualquer software, técnica ou dispositivo para fraudar, manipular resultados ou obter uma vantagem injusta. Qualquer atividade fraudulenta, incluindo o uso de contas múltiplas para contornar limites, resultará na suspensão imediata da conta e na perda de quaisquer prêmios.</p>
            </div>

            <!-- Seção 5: Prêmios e Pagamentos -->
            <div class="term-section">
                <h2>5. Prêmios e Pagamentos</h2>
                <p>Todos os prêmios são creditados na sua conta de usuário. Os saques estão sujeitos a verificações de segurança e podem exigir documentação adicional. O Raspapremio.biz processará os pagamentos de acordo com os métodos e prazos especificados na seção de saques do site. Quaisquer impostos aplicáveis sobre os prêmios são de responsabilidade exclusiva do jogador.</p>
            </div>

            <!-- Seção 6: Propriedade Intelectual -->
            <div class="term-section">
                <h2>6. Propriedade Intelectual</h2>
                <p>Todo o conteúdo do site, incluindo, mas não se limitando a, textos, gráficos, logotipos, jogos e software, é propriedade do Raspapremio.biz ou de seus licenciadores e é protegido por leis de direitos autorais e propriedade intelectual.</p>
            </div>

            <!-- Seção 7: Limitação de Responsabilidade -->
            <div class="term-section">
                <h2>7. Limitação de Responsabilidade</h2>
                <p>O Raspapremio.biz não se responsabiliza por quaisquer perdas ou danos decorrentes do uso do site, falhas técnicas, erros de jogo ou qualquer outra eventualidade. O uso do nosso serviço é por sua conta e risco.</p>
            </div>

            <!-- Seção 8: Alterações nos Termos -->
            <div class="term-section">
                <h2>8. Alterações nos Termos</h2>
                <p>Reservamo-nos o direito de modificar estes Termos de Uso a qualquer momento. Notificaremos sobre alterações significativas, mas é sua responsabilidade revisar esta página periodicamente. O uso continuado do site após quaisquer alterações constitui sua aceitação dos novos termos.</p>
            </div>

            <!-- Seção 9: Contato -->
            <div class="term-section">
                <h2>9. Contato</h2>
                <p>Se você tiver alguma dúvida sobre estes Termos de Uso, entre em contato conosco através do e-mail: <a href="mailto:contato@raspapremio.biz">contato@raspapremio.biz</a>.</p>
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
