<?php
require_once '../conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $nomeSite; ?> - Política de privacidade</title>

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
            <h1>Política de Privacidade</h1>
            <p>Última atualização: 07 de Setembro de 2025</p>
        </header>

        <p class="page-welcome">
            A sua privacidade é de extrema importância para o <strong class="primary-text">Raspapremio.biz</strong>. Esta Política de Privacidade descreve como coletamos, usamos, protegemos e compartilhamos suas informações pessoais quando você utiliza nossos serviços.
        </p>

        <div class="page-content">
            <!-- Seção 1: Informações que Coletamos -->
            <div class="page-section">
                <h2>1. Informações que Coletamos</h2>
                <p>Podemos coletar diferentes tipos de informações para fornecer e melhorar nossos serviços para você:</p>
                <h3>Dados Pessoais</h3>
                <ul>
                    <li><strong>Informações de Registro:</strong> Nome, endereço de e-mail, data de nascimento e outras informações que você fornece ao criar uma conta.</li>
                    <li><strong>Informações de Verificação:</strong> Documentos de identidade ou comprovante de endereço, quando necessário para cumprir com as regulamentações.</li>
                    <li><strong>Informações Financeiras:</strong> Detalhes de métodos de pagamento utilizados para depósitos e saques.</li>
                </ul>
                 <h3>Dados de Uso</h3>
                 <ul>
                    <li><strong>Dados de Acesso:</strong> Endereço IP, tipo e versão do navegador, localização, sistema operacional e outras informações técnicas sobre seu dispositivo.</li>
                    <li><strong>Dados de Atividade:</strong> Informações sobre como você usa o site, como jogos jogados, páginas visitadas e tempo gasto na plataforma.</li>
                </ul>
            </div>

            <!-- Seção 2: Como Usamos Suas Informações -->
            <div class="page-section">
                <h2>2. Como Usamos Suas Informações</h2>
                <p>As informações coletadas são utilizadas para os seguintes propósitos:</p>
                <ul>
                    <li>Para operar, manter e gerenciar sua conta.</li>
                    <li>Para processar suas transações financeiras de forma segura.</li>
                    <li>Para verificar sua identidade e idade, garantindo a conformidade legal.</li>
                    <li>Para nos comunicarmos com você sobre sua conta, promoções e atualizações (você pode optar por não receber comunicações de marketing).</li>
                    <li>Para monitorar e analisar o uso do site a fim de melhorar a experiência do usuário.</li>
                    <li>Para prevenir fraudes e garantir a segurança da nossa plataforma.</li>
                </ul>
            </div>

            <!-- Seção 3: Compartilhamento de Informações -->
            <div class="page-section">
                <h2>3. Compartilhamento de Informações</h2>
                <p>Nós não vendemos suas informações pessoais. Podemos compartilhar suas informações com terceiros apenas nas seguintes circunstâncias:</p>
                 <ul>
                    <li><strong>Provedores de Serviço:</strong> Com empresas que nos auxiliam a operar, como processadores de pagamento e serviços de verificação de identidade.</li>
                    <li><strong>Obrigações Legais:</strong> Se exigido por lei, regulamentação ou processo legal, podemos divulgar suas informações a autoridades competentes.</li>
                </ul>
            </div>

            <!-- Seção 4: Segurança dos Dados -->
            <div class="page-section">
                <h2>4. Segurança dos Dados</h2>
                <p>Implementamos medidas de segurança técnicas e organizacionais para proteger suas informações pessoais contra acesso não autorizado, alteração, divulgação ou destruição. Isso inclui o uso de criptografia SSL para proteger os dados em trânsito. No entanto, nenhum método de transmissão pela internet é 100% seguro.</p>
            </div>

            <!-- Seção 5: Cookies -->
            <div class="page-section">
                <h2>5. Cookies</h2>
                <p>Utilizamos cookies e tecnologias semelhantes para melhorar sua experiência em nosso site. Os cookies nos ajudam a lembrar suas preferências, entender como você interage com a plataforma e personalizar o conteúdo. Você pode gerenciar suas preferências de cookies através das configurações do seu navegador.</p>
            </div>

            <!-- Seção 6: Seus Direitos -->
            <div class="page-section">
                <h2>6. Seus Direitos de Privacidade</h2>
                <p>Você tem o direito de acessar, corrigir ou solicitar a exclusão de suas informações pessoais. Para exercer esses direitos, entre em contato conosco através dos canais fornecidos abaixo.</p>
            </div>

            <!-- Seção 7: Alterações nesta Política -->
            <div class="page-section">
                <h2>7. Alterações nesta Política</h2>
                <p>Podemos atualizar nossa Política de Privacidade periodicamente. Notificaremos sobre quaisquer alterações publicando a nova política nesta página e atualizando a data da "Última atualização".</p>
            </div>

            <!-- Seção 8: Contato -->
            <div class="page-section">
                <h2>8. Contato</h2>
                <p>Se você tiver alguma dúvida sobre esta Política de Privacidade, entre em contato conosco pelo e-mail: <a href="mailto:contato@raspapremio.biz">contato@raspapremio.biz</a>.</p>
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
