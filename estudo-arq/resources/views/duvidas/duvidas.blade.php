@extends('layout.body')

@section('content')
<style>
    :root {
        --primary-color: #d4a373;
        --secondary-color: #faedcd;
        --text-color: #333;
        --light-text: #666;
        --white: #fff;
        --burgundy-dark: #7A1F1F;
        --terracotta: #CD853F;
        --peach: #DEB887;
        --sage: #9CAF88;
        --selected-overlay: rgba(212, 163, 115, 0.8);
        --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        --soft-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    }

    body {
        background-color: #fefae0;
        color: var(--text-color);
        font-family: 'Montserrat', 'Helvetica Neue', sans-serif;
        line-height: 1.6;
    }

    .container {
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    .header {
        text-align: center;
        margin-bottom: 3rem;
        padding: 2rem 0;
    }

    .header h1 {
        font-size: 2.8rem;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
        font-weight: 600;
        position: relative;
    }

    .header h1::after {
        content: '';
        position: absolute;
        bottom: -15px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, var(--terracotta), var(--peach));
        border-radius: 2px;
    }

    .header p {
        font-size: 1.2rem;
        color: var(--light-text);
        margin-top: 1.5rem;
        font-weight: 300;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .faq-container {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: var(--shadow);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(212, 163, 115, 0.1);
    }

    .faq-item {
        margin-bottom: 1.5rem;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: var(--soft-shadow);
        background: var(--white);
    }

    .faq-item:last-child {
        margin-bottom: 0;
    }

    .faq-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(122, 31, 31, 0.15);
    }

    .faq-question {
        background: linear-gradient(135deg, var(--sage) 0%, rgba(156, 175, 136, 0.9) 100%);
        padding: 1.8rem 2rem;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }

    .faq-question::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--terracotta) 0%, var(--peach) 100%);
        transition: left 0.4s ease;
        z-index: 1;
    }

    .faq-question:hover::before {
        left: 0;
    }

    .faq-question h3 {
        font-size: 1.3rem;
        font-weight: 600;
        color: white;
        margin: 0;
        flex: 1;
        position: relative;
        z-index: 2;
        transition: all 0.3s ease;
    }

    .faq-icon {
        width: 32px;
        height: 32px;
        border: 2px solid white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.4s ease;
        margin-left: 1.5rem;
        flex-shrink: 0;
        position: relative;
        z-index: 2;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(5px);
    }

    .faq-icon::before {
        content: '+';
        color: white;
        font-size: 1.4rem;
        font-weight: bold;
        transition: all 0.4s ease;
    }

    .faq-item.active .faq-question {
        background: linear-gradient(135deg, var(--terracotta) 0%, var(--peach) 100%);
    }

    .faq-item.active .faq-question::before {
        left: 0;
    }

    .faq-item.active .faq-icon {
        transform: rotate(45deg);
        background: rgba(255, 255, 255, 0.2);
    }

    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: all 0.5s ease;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(250, 237, 205, 0.3) 100%);
        border-top: 1px solid rgba(212, 163, 115, 0.2);
    }

    .faq-item.active .faq-answer {
        max-height: 400px;
        padding: 2rem;
    }

    .faq-answer-content {
        color: var(--text-color);
        font-size: 1.05rem;
        line-height: 1.8;
        margin: 0;
    }

    .faq-answer-content strong {
        color: var(--burgundy-dark);
        font-weight: 600;
    }

    .faq-answer-content .highlight {
        background: linear-gradient(120deg, var(--secondary-color) 0%, transparent 100%);
        padding: 0.2rem 0.5rem;
        border-radius: 4px;
        font-weight: 500;
    }

    /* Elementos decorativos */
    .decorative-element {
        position: absolute;
        border-radius: 50%;
        opacity: 0.08;
        z-index: -1;
        pointer-events: none;
    }

    .decorative-element:nth-child(1) {
        width: 120px;
        height: 120px;
        background: linear-gradient(45deg, var(--peach), var(--terracotta));
        top: 15%;
        right: 8%;
        animation: float 8s ease-in-out infinite;
    }

    .decorative-element:nth-child(2) {
        width: 80px;
        height: 80px;
        background: linear-gradient(45deg, var(--sage), var(--secondary-color));
        bottom: 25%;
        left: 5%;
        animation: float 10s ease-in-out infinite reverse;
    }

    .decorative-element:nth-child(3) {
        width: 60px;
        height: 60px;
        background: linear-gradient(45deg, var(--primary-color), var(--peach));
        top: 60%;
        right: 15%;
        animation: float 12s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { 
            transform: translateY(0px) rotate(0deg); 
        }
        33% { 
            transform: translateY(-15px) rotate(120deg); 
        }
        66% { 
            transform: translateY(-8px) rotate(240deg); 
        }
    }

    /* Botão de voltar */
    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: linear-gradient(135deg, var(--sage) 0%, rgba(156, 175, 136, 0.9) 100%);
        color: white;
        padding: 0.8rem 1.5rem;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        margin-bottom: 2rem;
        box-shadow: var(--soft-shadow);
    }

    .back-button:hover {
        background: linear-gradient(135deg, var(--terracotta) 0%, var(--peach) 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(122, 31, 31, 0.2);
        color: white;
        text-decoration: none;
    }

    /* Responsividade */
    @media (max-width: 768px) {
        .container {
            padding: 1rem;
        }

        .header h1 {
            font-size: 2.2rem;
        }

        .header p {
            font-size: 1rem;
        }

        .faq-container {
            padding: 1.5rem;
            border-radius: 15px;
        }

        .faq-question {
            padding: 1.5rem;
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .faq-question h3 {
            font-size: 1.1rem;
            text-align: left;
        }

        .faq-icon {
            align-self: flex-end;
            margin-left: 0;
        }

        .faq-item.active .faq-answer {
            padding: 1.5rem;
        }

        .decorative-element {
            display: none;
        }
    }

    @media (max-width: 480px) {
        .header h1 {
            font-size: 1.8rem;
        }

        .faq-question {
            padding: 1.2rem;
        }

        .faq-question h3 {
            font-size: 1rem;
        }
    }
</style>

<div class="decorative-element"></div>
<div class="decorative-element"></div>
<div class="decorative-element"></div>

<div class="container">
    <a href="{{ route('presentes.index') }}" class="back-button">
        <i class="fas fa-arrow-left"></i>
        Voltar para Presentes
    </a>

    <header class="header">
        <h1>Dúvidas Frequentes</h1>
        <p>Encontre aqui as respostas para as principais dúvidas sobre nosso grande dia especial</p>
    </header>

    <div class="faq-container">
        
        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <h3>Onde é a cerimônia?</h3>
                <div class="faq-icon"></div>
            </div>
            <div class="faq-answer">
                <div class="faq-answer-content">
                    <p>Nossa cerimônia será realizada em um local muito especial para nós:</p>
                    <p><strong>Cerimônia Religiosa:</strong><br>
                    <span class="highlight">Igreja Sagrada Família</span><br>
                    Rua João Denizar, 60 - Jardim Pérola.</p>
                </div>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <h3>Qual o horário?</h3>
                <div class="faq-icon"></div>
            </div>
            <div class="faq-answer">
                <div class="faq-answer-content">
                    <p>Organizamos nosso dia especial com os seguintes horários:</p>
                    <p><strong>Cerimônia Religiosa:</strong><br>
                    <span class="highlight">16h00</span> - Pedimos que cheguem com 30 minutos de antecedência</p>
                    <p>Será um dia inesquecível e esperamos vocês para celebrar conosco este momento único! 💕</p>
                </div>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <h3>Tem roupa específica?</h3>
                <div class="faq-icon"></div>
            </div>
            <div class="faq-answer">
                <div class="faq-answer-content">
                    <p>O dress code é <strong class="highlight">social elegante</strong>. Aqui estão nossas sugestões:</p>
                    <p><strong>Para os Homens:</strong><br>
                    Terno completo ou blazer com calça social, camisa e gravata opcional</p>
                    <p><strong>Para as Mulheres:</strong><br>
                    Vestido elegante, conjunto social ou saia/blusa sofisticada</p>
                    <p><strong>Cores a evitar:</strong><br>
                    • Branco, off-white ou tons muito claros (reservados para a noiva)<br>
                    <p><strong>Cores bem-vindas:</strong><br>
                    Tons terrosos, azul marinho, vinho, verde musgo - cores que harmonizam com nossa paleta! 🌿</p>
                </div>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <h3>Para onde mandar o presente?</h3>
                <div class="faq-icon"></div>
            </div>
            <div class="faq-answer">
                <div class="faq-answer-content">
                    <p>Você pode enviar os presentes para o nosso endereço residencial:</p>
                    <p><strong class="highlight">Rua Rosa Maria de Souza, 330 - Sagrada Família<br>
                    Governador Valadares - MG<br>
                    CEP: 35050-320</strong></p>
                    <p>Também temos uma <strong>lista de presentes </strong> disponível na area de presentes. Para mais facilidade, você pode usar nosso <strong>PIX</strong> disponível na página de presentes. Qualquer dúvida, entre em contato conosco!</p>
                </div>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <h3>Preferem dinheiro ou presente?</h3>
                <div class="faq-icon"></div>
            </div>
            <div class="faq-answer">
                <div class="faq-answer-content">
                    <p><strong>Sua presença já é o maior presente!</strong> 💝</p>
                    <p>Mas se desejarem nos presentear, tanto <span class="highlight">dinheiro quanto presentes físicos</span> serão recebidos com muito carinho e gratidão.</p>
                    <p><strong>Opções disponíveis:</strong><br>
                    • <strong>Lista de presentes:</strong> Disponível na página de presentes do site<br>
                    • <strong>PIX:</strong> Chave disponível na página de presentes<br>
                    • <strong>Presentes físicos:</strong> Podem ser entregues no endereço informado</p>
                    • <strong>Dica:</strong> Ao optar por comprar um presente, dê preferência aos escolhidos pelo casal na aba de presentes. </p>
                    <p>Qualquer contribuição nos ajudará muito a começar nossa nova vida juntos. O importante é celebrarmos este momento especial com vocês! ❤️</p>
                </div>
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <h3>Outras duvidas!</h3>
                <div class="faq-icon"></div>
            </div>
            <div class="faq-answer">
                <div class="faq-answer-content">
                    <p>Entre em contato com nossa cerimonialista:</p>
                    <p><strong>Nome:</strong> Magda Breguez<br>
                    <p><strong>contato:</strong> (33) 8809-1903<br>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleFaq(element) {
        const faqItem = element.parentElement;
        const isActive = faqItem.classList.contains('active');

        document.querySelectorAll('.faq-item').forEach(item => {
            if (item !== faqItem && item.classList.contains('active')) {
                item.classList.remove('active');
            }
        });

        if (isActive) {
            faqItem.classList.remove('active');
        } else {
            faqItem.classList.add('active');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const faqItems = document.querySelectorAll('.faq-item');

        faqItems.forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(30px)';
            
            setTimeout(() => {
                item.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
                item.style.opacity = '1';
                item.style.transform = 'translateY(0)';
            }, index * 150);
        });

        const header = document.querySelector('.header');
        header.style.opacity = '0';
        header.style.transform = 'translateY(-20px)';
        
        setTimeout(() => {
            header.style.transition = 'opacity 1s ease, transform 1s ease';
            header.style.opacity = '1';
            header.style.transform = 'translateY(0)';
        }, 200);
    });

    document.querySelectorAll('.faq-item').forEach(item => {
        item.addEventListener('mouseenter', function() {
            if (!this.classList.contains('active')) {
                this.style.transform = 'translateY(-3px)';
            }
        });
        
        item.addEventListener('mouseleave', function() {
            if (!this.classList.contains('active')) {
                this.style.transform = 'translateY(0)';
            }
        });
    });
</script>

@endsection
