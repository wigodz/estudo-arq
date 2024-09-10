@extends('layout.body')

@section('content')
    <style>
        /* Estilos para ocupar a altura total da página */
        html, body {
            height: 100%;
            margin: 0;
        }
        .container-fill {
            height: 33.33%; /* Cada container ocupa um terço da altura */
        }
        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Garante que o wrapper ocupe pelo menos a altura total da tela */
        }
        .footer {
            background-color: #f8f9fa; /* Cor de fundo para o rodapé */
            padding:3rem; /* Padding para o rodapé */
            text-align: center; /* Centraliza o texto no rodapé */
        }
        .bg-peixe-relogio {
            background-color: #edcb9c;
        }
        
    </style>
<div class="wrapper bg-peixe-relogio">
    <div class="container-fill d-flex align-items-center justify-content-center position-relative mt-10">
        <div class="container">
            <div class="row">
                <!-- Bloco Esquerdo: Imagem -->
                <div class="col-md-6 d-flex align-items-center justify-content-center mt-9">
                    <img src="{{ asset('storage/images/Foto-casal-1.png') }}" class="img-fluid" alt="Imagem" style="max-height: 80%;">
                </div>

                <!-- Bloco Direito: Caixas de Texto -->
                <div class="col-md-6 d-flex align-items-center">
                    <form class="w-100">
                        <div class="form-group">
                            <label for="exampleInput1">Texto 1</label>
                            <h2>texto sobre o casal</h2>
                        </div>
                        <div class="form-group">
                            <label for="exampleInput2">Texto 2</label>
                            <input type="text" class="form-control" id="exampleInput2" placeholder="Texto 2">
                        </div>
                        <div class="form-group">
                            <label for="exampleInput3">Texto 3</label>
                            <input type="text" class="form-control" id="exampleInput3" placeholder="Texto 3">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <h3>Bloco 1</h3>
    </div>

    <div class="container-fill d-flex align-items-center justify-content-center bg-danger">
        <div class="container">
            <div class="row">
                <!-- Bloco Direito: Caixas de Texto -->
                <div class="col-md-6 d-flex align-items-center">
                    <form class="w-100">
                        <div class="form-group">
                            <label for="exampleInput1">Texto 1</label>
                            <input type="text" class="form-control" id="exampleInput1" placeholder="Texto 1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInput2">Texto 2</label>
                            <input type="text" class="form-control" id="exampleInput2" placeholder="Texto 2">
                        </div>
                        <div class="form-group">
                            <label for="exampleInput3">Texto 3</label>
                            <input type="text" class="form-control" id="exampleInput3" placeholder="Texto 3">
                        </div>
                    </form>
                </div>
                <!-- Bloco Esquerdo: Imagem -->
                <div class="col-md-6 d-flex align-items-center justify-content-center">
                    <img src="{{ asset('storage/images/Foto-casal-1.png') }}" class="img-fluid" alt="Imagem" style="max-height: 80%;">
                </div>
            </div>
        </div>
        <h3>Bloco 2</h3>
    </div>

    <div class="container-fill d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row">
                <!-- Bloco Esquerdo: Imagem -->
                <div class="col-md-6 d-flex align-items-center justify-content-center">
                    <img src="{{ asset('storage/images/Foto-casal-1.png') }}" class="img-fluid" alt="Imagem" style="max-height: 80%;">
                </div>

                <!-- Bloco Direito: Caixas de Texto -->
                <div class="col-md-6 d-flex align-items-center">
                    <form class="w-100">
                        <div class="form-group">
                            <label for="exampleInput1">Texto 1</label>
                            <input type="text" class="form-control" id="exampleInput1" placeholder="Texto 1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInput2">Texto 2</label>
                            <input type="text" class="form-control" id="exampleInput2" placeholder="Texto 2">
                        </div>
                        <div class="form-group">
                            <label for="exampleInput3">Texto 3</label>
                            <input type="text" class="form-control" id="exampleInput3" placeholder="Texto 3">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <h3>Bloco 3</h3>
    </div>
</div>
<footer class="footer bg-peixe-relogio">
    <p>&copy; 2024 Seu Nome. Todos os direitos reservados.</p>
</footer>
@endsection