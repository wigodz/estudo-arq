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
            min-height: 100vh;
        }

        .container {
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        .header {
            text-align: center;
            margin-bottom: 3rem;
            padding: 2rem 0;
            opacity: 0;
            transform: translateY(-20px);
            animation: fadeInUp 1s ease forwards 0.2s;
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

        .form-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: var(--shadow);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(212, 163, 115, 0.1);
            max-width: 800px;
            margin: 0 auto;
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.8s ease forwards 0.5s;
        }

        .form-group {
            margin-bottom: 2rem;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.6s ease forwards;
        }

        .form-group:nth-child(1) { animation-delay: 0.7s; }
        .form-group:nth-child(2) { animation-delay: 0.9s; }
        .form-group:nth-child(3) { animation-delay: 1.1s; }
        .form-group:nth-child(4) { animation-delay: 1.3s; }
        .form-group:nth-child(5) { animation-delay: 1.5s; }

        .form-label {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 0.8rem;
            display: block;
        }

        .form-control {
            height: 3.5rem;
            font-size: 1.1rem;
            border: 2px solid var(--sage);
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
            padding: 0.75rem 1.25rem;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(212, 163, 115, 0.25);
            transform: translateY(-2px);
            background: var(--white);
        }

        .form-control:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(156, 175, 136, 0.2);
        }

        .password-info {
            background: linear-gradient(135deg, var(--secondary-color) 0%, rgba(250, 237, 205, 0.3) 100%);
            border: 1px solid var(--primary-color);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .password-info p {
            margin: 0;
            color: var(--burgundy-dark);
            font-weight: 500;
        }

        .password-info strong {
            color: var(--burgundy-dark);
            font-weight: 600;
        }

        .submit-btn {
            background: linear-gradient(135deg, var(--sage) 0%, rgba(156, 175, 136, 0.9) 100%);
            border: none;
            color: white;
            font-size: 1.2rem;
            font-weight: 600;
            padding: 1rem 2rem;
            border-radius: 12px;
            width: 100%;
            height: 3.5rem;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .submit-btn::before {
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

        .submit-btn:hover::before {
            left: 0;
        }

        .submit-btn span {
            position: relative;
            z-index: 2;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(122, 31, 31, 0.2);
        }

        .submit-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
            margin-right: 0.5rem;
        }

        .success-message {
            background: linear-gradient(135deg, var(--secondary-color) 0%, rgba(250, 237, 205, 0.3) 100%);
            border: 1px solid var(--primary-color);
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            margin-top: 1.5rem;
            color: var(--burgundy-dark);
            font-weight: 600;
            font-size: 1.1rem;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s ease;
        }

        .success-message.show {
            opacity: 1;
            transform: translateY(0);
        }

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

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
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

            .form-container {
                padding: 1.5rem;
                border-radius: 15px;
            }

            .form-control {
                height: 3rem;
                font-size: 1rem;
            }

            .submit-btn {
                height: 3rem;
                font-size: 1.1rem;
            }

            .decorative-element {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .header h1 {
                font-size: 1.8rem;
            }

            .form-container {
                padding: 1.2rem;
            }
        }
    </style>

    <div class="decorative-element"></div>
    <div class="decorative-element"></div>
    <div class="decorative-element"></div>

    <div class="container">
        <!-- Botão de voltar (opcional - você pode ajustar o link) -->
        <a href="#" class="back-button">
            <i class="fas fa-arrow-left"></i>
            Voltar
        </a>

        <header class="header">
            <h1>Criar Usuário</h1>
            <p>Preencha os dados abaixo para criar sua conta em nosso sistema</p>
        </header>

        <div class="form-container">
            <form id="registrationForm" method="POST" action="#">
                <!-- Campo Nome -->
                <div class="form-group">
                    <label for="name" class="form-label">Nome Completo</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="name" 
                        name="name" 
                        placeholder="Digite seu nome completo"
                        required
                    >
                </div>

                <!-- Campo Email -->
                <div class="form-group">
                    <label for="email" class="form-label">E-mail</label>
                    <input 
                        type="email" 
                        class="form-control" 
                        id="email" 
                        name="email" 
                        placeholder="Digite seu e-mail"
                        required
                    >
                </div>

                <!-- Campo Telefone -->
                <div class="form-group">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input 
                        type="tel" 
                        class="form-control" 
                        id="telefone" 
                        name="telefone" 
                        placeholder="(00) 00000-0000"
                        required
                    >
                </div>

                <!-- Informação sobre senha -->
                <div class="password-info">
                    <p><strong>Senha padrão:</strong> A senha será definida automaticamente como "casamento"</p>
                </div>

                <!-- Campo oculto para senha -->
                <input type="hidden" name="password" value="casamento">

                <!-- Botão de envio -->
                <button type="submit" class="submit-btn" id="submitBtn">
                    <span id="btnText">Criar Usuário</span>
                </button>

                <!-- Mensagem de sucesso -->
                <div id="successMessage" class="success-message">
                    <i class="fas fa-check-circle"></i>
                    Usuário criado com sucesso!
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registrationForm');
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const successMessage = document.getElementById('successMessage');
            const telefoneInput = document.getElementById('telefone');

            // Máscara para telefone
            telefoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                
                if (value.length <= 11) {
                    if (value.length <= 10) {
                        value = value.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
                    } else {
                        value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
                    }
                }
                
                e.target.value = value;
            });

            // Validação e envio do formulário
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Validação básica
                const name = document.getElementById('name').value.trim();
                const email = document.getElementById('email').value.trim();
                const telefone = document.getElementById('telefone').value.trim();

                if (!name || !email || !telefone) {
                    alert('Por favor, preencha todos os campos obrigatórios.');
                    return;
                }

                // Validação de email
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    alert('Por favor, insira um e-mail válido.');
                    return;
                }

                // Validação de telefone
                const telefoneClean = telefone.replace(/\D/g, '');
                if (telefoneClean.length < 10) {
                    alert('Por favor, insira um telefone válido.');
                    return;
                }

                // Simular envio (loading)
                submitBtn.disabled = true;
                btnText.innerHTML = '<span class="loading-spinner"></span>Criando usuário...';

                var formulario = {
                    name: name,
                    email: email,
                    telefone: telefone,
                    password: 'casamento'
                }

                let url = "{{ route('admin.store') }}";

                axios.post(url, formulario, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    if (response.data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'usuario criado',
                            showConfirmButton: true
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro ao criar usuario',
                        text: 'Algo deu errado.'
                    });
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    btnText.innerHTML = 'Criar Usuário';
                    form.reset();
                });

                // // Aqui você faria a requisição real para o servidor
                // // Para demonstração, vamos simular um delay
                // setTimeout(function() {
                //     // Resetar botão
                //     submitBtn.disabled = false;
                //     btnText.innerHTML = 'Criar Usuário';

                //     // Mostrar mensagem de sucesso
                //     successMessage.classList.add('show');

                //     // Limpar formulário
                //     form.reset();

                //     // Esconder mensagem após 5 segundos
                //     setTimeout(function() {
                //         successMessage.classList.remove('show');
                //     }, 5000);

                //     // Aqui você pode redirecionar ou fazer outras ações
                //     console.log('Dados do formulário:', {
                //         name: name,
                //         email: email,
                //         telefone: telefone,
                //         password: 'casamento'
                //     });

                // }, 2000);
            });

            // Efeitos de hover nos inputs
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'translateY(-2px)';
                });

                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
@endsection