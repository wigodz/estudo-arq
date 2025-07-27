@extends('layout.body')

@section('content')
<style>
    .footer {
            padding: 3rem;
            text-align: center;
            color: #4f0c0f;
            font-size: 0.9rem;
            box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.03);
        }
    @media (max-width: 576px) {
            .footer {
                padding: 1.5rem;
            }
        }
</style>
<div class="container text-center mt-5">
    <h2>Escaneie o QR Code para conectar o WhatsApp</h2>
    <p class="text-muted">Use a câmera do seu WhatsApp para escanear o código abaixo.</p>

    <div class="mt-4" id="qr-container">
        <img id="qrImage" src="{{ url('/qr-proxy') }}" alt="QR Code do WhatsApp" style="max-width: 100%; height: auto; border: 2px solid #ccc; padding: 10px;">
    </div>

    <div class="mt-3">
        <button onclick="refreshQR()" class="btn btn-primary">Atualizar QR Code</button>
    </div>

    <hr class="my-5">

    <div class="mt-5 text-start">
        <h4>Mensagem personalizada</h4>
        <p class="text-muted">Use <code>#nome</code>, <code>#email</code> e <code>#senha</code> como variáveis na mensagem.</p>

        <form id="massMessageForm" method="POST" action="{{ route('enviar.mensagem.massa') }}">
            @csrf
            <div class="form-group mb-3">
                <textarea name="mensagem" class="form-control" rows="5" placeholder="Ex: Olá #nome, seu acesso é #email com a senha #senha." required></textarea>
            </div>

            <button type="submit" class="btn btn-success">
                Enviar Mensagem em Massa
            </button>
        </form>
    </div>
</div>

<footer class="footer bg-peixe-relogio">
    <p>&copy; 2024 Wigo Amaral. Todos os direitos reservados.</p>
</footer>

<script>
function refreshQR() {
    const img = document.getElementById('qrImage');
    img.src = 'http://67.205.128.65:3000/qr?ts=' + new Date().getTime();
}
</script>
@endsection
