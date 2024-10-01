@extends('layout.body')

@section('content')
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        .container-fill {
            height: 33.33%;
        }
        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 3rem;
            text-align: center;
        }
        .bg-peixe-relogio {
            background-color: #edcb9c;
        }
        .image-container {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
            flex-wrap: wrap;
        }
        .image-section {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 20px;
        }
        .image-container img {
            width: 100%;
            height: auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .image-container .col {
            flex: 1;
            padding: 0 10px;
        }
        .background-container {
            position: relative;
            width: 100%;
            height: 900px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-align: center;
            padding: 20px;
            box-sizing: border-box;
        }
        .background-container h2, .background-container p {
            position: relative;
            margin: 0;
            padding: 10px;
            border-radius: 8px;
            max-width: 100%;
            word-wrap: break-word;
        }
        .background-container h2 {
            font-size: 8rem;
            margin-bottom: 10px;
        }
        .background-container p {
            font-size: 4rem;
        }
        .tangerine-regular {
            font-family: "Tangerine", cursive;
            font-weight: 400;
            font-style: normal;
            color: #4f0c0f
        }
        .tangerine-bold {
            font-family: "Tangerine", cursive;
            font-weight: 700;
            font-style: normal;
            color: #4f0c0f
        }
        .image-container2.full-width {
            flex: 1;
        }
        .image-container2.half-width {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .image-container2 img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
        .image-container2.half-width img {
            width: 50%;
        }
        .image-section2 {
            display: flex;
        }

        @media (max-width: 1279px) {
            .background-container h2 {
            font-size: 6rem;
        }
        .background-container p {
            font-size: 3rem;
        }

        }

        /* Responsividade */
        @media (max-width: 768px) {
            .background-container h2 {
                font-size: 4rem;
            }
            .background-container p {
                font-size: 2rem;
            }
            .image-container {
                flex-direction: column;
            }
            .image-container2.half-width img {
                width: 100%;
            }
            #section_presenca {
                display: flex;
                flex-direction: column;
            }
            #section_presentes {
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .swiper-container {
                display: flex; /* Para mostrar as imagens lado a lado */
            }
            .swiper-wrapper {
                display: flex; /* Garante que os slides estejam lado a lado */
                flex-wrap: nowrap; /* Não permite quebra de linha */
            }
            .swiper-slide {
                width: calc(33.33% - 10px); /* Cada slide ocupará 1/3 do espaço */
                margin-right: 10px; /* Espaçamento entre as imagens */
            }
            .image-container2.half-width {
                display: none; /* Oculta a segunda div e a imagem correspondente */
            }

            .image-container2.full-width img {
                width: 100%; /* Garante que a imagem ocupe toda a div */
                height: auto;
            }
            
        }
        @media (max-width: 576px) {
            .background-container {
                height: auto;
                padding: 40px 20px;
            }
            .footer {
                padding: 1rem;
            }
            .tangerine-bold {
                font-size: 1.2rem;
            }
        }
        .swiper-container {
            width: 100%;
            height: auto; /* Ajuste para manter a altura automática conforme a imagem */
            overflow: hidden; /* Garante que a imagem não escape do container */
        }
        .swiper-container {
            position: relative; /* Para permitir o posicionamento absoluto da paginação */
        }

        /* As imagens serão responsivas e ajustadas para caber no container */
        .swiper-slide img {
            width: 100%;
            height: auto;
            object-fit: cover; /* Mantém a proporção da imagem dentro do container */
            display: block;
            max-width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .swiper-pagination {
            position: absolute; /* Posiciona a paginação abaixo do carrossel */
            bottom: 10px; /* Distância do fundo */
            left: 50%; /* Centraliza horizontalmente */
            
            z-index: 10; /* Coloca acima das imagens */
        }

        /* Estilos para as setas de navegação */
        .swiper-button-next,
        .swiper-button-prev {
            color: #000; /* Ajuste a cor conforme necessário */
        }
    </style>

<div class="wrapper">
    <div class="col-md-6 d-flex align-items-center justify-content-center mt-9 w-100 bg-peixe-relogio">
        <img src="{{ asset('storage/images/home.png') }}" class="img-fluid w-100" alt="Imagem" style="max-height: 80%;">
    </div>

    <div class="container mt-1">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="{{ asset('storage/images/foto-1.jpg') }}" alt="Image 1">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('storage/images/foto-2.jpg') }}" alt="Image 2">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('storage/images/foto-3.jpg') }}" alt="Image 3">
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <div class="background-container">
        <div> 
            <h2 class="tangerine-regular">Um amor construído...</h2>
            <p class="tangerine-bold">
                Desde a escola, quem poderia imaginar? Eles provavelmente não...
                duas crianças que se conheceram no ensino médio, que unidos a
                tantos anos aprenderam a partilhar e evoluir em sintonia.
                Construindo a cada dia o amor, respeito e carinho que os trouxeram
                até aqui. 
            </p>
            <p class="tangerine-bold">
                Onze anos depois, um pedido, um anel e um sonho de ficarem pra
                sempre juntos . Eles decidiram se casar e esperam que você possa
                participar deste dia tão especial.
            </p>
        </div>
    </div>

    <section class="image-section2">
        <div class="image-container2 full-width">
            <img src="{{ asset('storage/images/foto-1.jpg') }}" alt="Imagem 1" >
        </div>
        <div class="image-container2 half-width image-to-hide">
            <img src="{{ asset('storage/images/foto-1.jpg') }}" alt="Imagem 2" >
        </div>
    </section>

    <div class="background-container" id="section_presenca" style="height: 650px">
        <div> 
            <h2 class="tangerine-regular">Confirme sua Presença</h2>
        </div>
        <div>
            <p class="tangerine-bold"> Ligue para: (33) 8809-1903 ou <br>
                mande e-mail para: <br>
                magdabreguez.cerimonial@gmail.com <br>
                Até o dia 10/08.
            </p>
            <a href="/presenca" class="btn btn-outline" style="border-color: #4f0c0f; color: #4f0c0f; background-color: transparent; border-radius: 50px; padding: 10px 30px; font-size: 20px;">
                Confirmar presença
            </a>
        </div>        
    </div>

    <div class="col-md-6 d-flex align-items-center justify-content-center mt-9 w-100 bg-peixe-relogio">
        <img src="{{ asset('storage/images/foto-4.jpg') }}" class="img-fluid" alt="Imagem" style="max-height: 80%;">
    </div>

    <div class="background-container d-flex flex-column" style="height: 600px">
        <div> 
            <h2 class="tangerine-regular">Se deseja nos presentear...</h2>
        </div>
        <div class="d-flex justify-content-between" id="section_presentes" style="width: 100%;">
            <div style="width: 60%;">
                <p class="tangerine-bold">Clique no botão para ir até a nossa lista...</p>
            </div>
            <div style="width: 40%; display: flex; justify-content: center; align-items: center;">
                <a href="/presentes" class="btn btn-outline" style="border-color: #4f0c0f; color: #4f0c0f; background-color: transparent; border-radius: 50px; padding: 10px 30px; font-size: 35px;">
                    Presentear
                </a>
            </div>
        </div>
    </div>

    <div style="height: 400px; overflow: hidden;">
        <img src="{{ asset('storage/images/foto-4.jpg') }}" class="img-fluid" alt="Imagem" style="width: 100%; height: 100%; object-fit: cover;">
    </div>

    <div class="d-flex justify-content-center align-items-center text-center text-white p-3">       
        <div class="d-flex justify-content-between align-items-center" style="width: 100%; height: 60%;">
            <div style="width: 100%">
                <button 
                    class="btn btn-outline-light tangerine-bold" 
                    style="font-size: 4rem; border-radius: 50px;" 
                    data-bs-toggle="modal" 
                    data-bs-target="#imageModal">
                    Clique aqui e capture momentos conosco
                </button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('storage/images/QR-cod-pasta.png') }}" class="img-fluid" alt="Imagem Ampliada">
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="footer bg-peixe-relogio">
    <p>&copy; 2024 Seu Nome. Todos os direitos reservados.</p>
</footer>
<script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,  // Mostra uma imagem por vez em telas menores
        spaceBetween: 10,  // Espaçamento entre as imagens
        loop: true,        // Ativa o loop para repetir o carrossel
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            769: {  // Quando a largura for maior ou igual a 769px
                slidesPerView: 3,  // Mostra três imagens por vez
            },
        },
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
@endsection
