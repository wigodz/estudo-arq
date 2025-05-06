@extends('layout.body')

@section('content')
    <style>
        html, body {
            height: 100%;
            margin: 0;
            font-family: "Montserrat", sans-serif;
            color: #4f0c0f;
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
            padding: 3rem;
            text-align: center;
            color: #4f0c0f;
            font-size: 0.9rem;
            box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.03);
        }
        .image-container {
            display: flex;
            justify-content: space-between;
            margin: 30px 0;
            flex-wrap: wrap;
        }
        .image-section {
            display: flex;
            justify-content: space-between;
            gap: 30px;
            padding: 30px;
        }
        .image-container img {
            width: 100%;
            height: auto;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            border-radius: 12px; /* Bordas arredondadas para suavizar */
            transition: transform 0.3s ease;
        }
        .image-container img:hover {
            transform: scale(1.02); /* Efeito suave ao passar o mouse */
        }
        .image-container .col {
            flex: 1;
            padding: 0 15px;
        }
        .background-container {
            position: relative;
            width: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #4f0c0f;
            text-align: center;
            padding: 40px 20px;
            box-sizing: border-box;
            margin: 20px 0;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
        }
        .background-container h2, .background-container p {
            position: relative;
            margin: 0;
            padding: 15px;
            border-radius: 8px;
            max-width: 100%;
            word-wrap: break-word;
        }
        .background-container h2 {
            font-size: 3.5rem;
            margin-bottom: 15px;
            font-weight: 400;
            color: #4f0c0f;
            text-shadow: 1px 1px 2px rgba(79, 12, 15, 0.1);
            letter-spacing: 1px;
        }
        .background-container p {
            font-size: 2.5rem;
            line-height: 1.5;
            color: #4f0c0f;
        }
        .montserrat-regular {
            font-family: "Montserrat", sans-serif;
            font-weight: 400;
            font-style: normal;
            color: #4f0c0f;
        }
        .balkind-regular {
            font-family: "Balkind";
            font-style: normal;
            color: #4f0c0f;
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
            border-radius: 12px; /* Bordas arredondadas para suavizar */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
        }
        .image-container2 img:hover {
            transform: scale(1.02); /* Efeito suave ao passar o mouse */
        }
        .image-container2.half-width img {
            width: 50%;
        }
        .image-section2 {
            display: flex;
            padding: 30px 0;
            gap: 20px;
        }
        
        /* Botões estilizados */
        .btn-outline {
            border: 2px solid #4f0c0f;
            color: #4f0c0f;
            background-color: transparent;
            border-radius: 50px;
            padding: 12px 35px;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(79, 12, 15, 0.1);
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }
        .btn-outline:hover {
            background-color: rgba(79, 12, 15, 0.1);
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(79, 12, 15, 0.15);
        }
        .btn-outline-light {
            border: 2px solid #4f0c0f;
            color: #4f0c0f;
            background-color: #f9e6d9;
            border-radius: 50px;
            padding: 15px 40px;
            font-size: 2.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(79, 12, 15, 0.1);
            cursor: pointer;
        }
        .btn-outline-light:hover {
            background-color: rgba(79, 12, 15, 0.05);
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(79, 12, 15, 0.15);
        }

        /* Swiper customizado */
        .swiper-container {
            width: 100%;
            height: auto;
            overflow: hidden;
            padding: 30px 0;
            position: relative;
        }
        .swiper-slide {
            transition: transform 0.3s ease;
        }
        .swiper-slide:hover {
            transform: scale(1.02);
        }
        .swiper-slide img {
            width: 100%;
            height: auto;
            object-fit: cover;
            display: block;
            max-width: 100%;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            border-radius: 12px;
        }
        .swiper-pagination-bullet {
            background: #4f0c0f;
            opacity: 0.5;
        }
        .swiper-pagination-bullet-active {
            opacity: 1;
            background: #4f0c0f;
        }
        .swiper-button-next,
        .swiper-button-prev {
            color: #4f0c0f;
            background-color: rgba(249, 230, 217, 0.7);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 18px;
        }

        /* Modal customizado */
        .modal-content {
            background-color: #fff9f5;
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        .modal-header {
            border-bottom: 1px solid #f9e6d9;
            padding: 20px;
        }
        .modal-body {
            padding: 30px;
        }
        .btn-close {
            color: #4f0c0f;
        }

        /* Seção de presença */
        #section_presenca {
            padding: 40px;
            display: flex;
            align-items: center;
            justify-content: space-around;
            height: auto;
            min-height: 500px;
        }
        #section_presenca h2 {
            margin-bottom: 30px;
        }
        #section_presenca p {
            font-size: 1.8rem;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        /* Seção de presentes */
        #section_presentes {
            padding: 20px;
        }
        #section_presentes .balkind-regular {
            font-size: 2rem;
            line-height: 1.5;
        }

        /* Imagem de fundo completa */
        .full-width-image {
            height: 400px;
            overflow: hidden;
            margin: 30px 0;
        }
        .full-width-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .full-width-image:hover img {
            transform: scale(1.05);
        }

        /* Seção de captura de momentos */
        .capture-moments {
            padding: 60px 20px;
            text-align: center;
            margin: 30px 0;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
        }

        @media (max-width: 1279px) {
            .background-container h2 {
                font-size: 2.8rem;
            }
            .background-container p {
                font-size: 2.2rem;
            }
            .btn-outline-light {
                font-size: 2rem;
            }
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .background-container h2 {
                font-size: 2.5rem;
            }
            .background-container p {
                font-size: 1.8rem;
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
                padding: 30px 15px;
            }
            #section_presentes {
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .swiper-container {
                display: flex;
            }
            .swiper-wrapper {
                display: flex;
                flex-wrap: nowrap;
            }
            .swiper-slide {
                width: calc(33.33% - 10px);
                margin-right: 10px;
            }
            .image-container2.half-width {
                display: none;
            }
            .image-container2.full-width img {
                width: 100%;
                height: auto;
            }
            .btn-outline-light {
                font-size: 1.5rem;
                padding: 12px 30px;
            }
            #section_presenca p {
                font-size: 1.5rem;
            }
        }
        
        @media (max-width: 576px) {
            .background-container {
                height: auto;
                padding: 30px 15px;
            }
            .footer {
                padding: 1.5rem;
            }
            .balkind-regular {
                font-size: 1.2rem;
            }
            .background-container h2 {
                font-size: 2rem;
            }
            .background-container p {
                font-size: 1.5rem;
            }
            .btn-outline {
                font-size: 1rem;
                padding: 10px 25px;
            }
            .btn-outline-light {
                font-size: 1.2rem;
                padding: 10px 20px;
            }
        }
    </style>

<div class="wrapper">
    <div class="background-container">
        <div> 
            <h2 class="montserrat-regular">Bem vindos ao nosso casamento</h2>
            <p class="balkind-regular"> O grande dia está marcado: No dia <strong>20 de setembro de 2025</strong>, às <strong>15:30h</strong>.
                O casamento será realizado na igreja <strong>Sagrada Família</strong>, localizada na <strong>R. João Denizar, 60 - Jardim Pérola</strong>.
            </p>
            <p class="balkind-regular"> Contamos com a sua presença para tornar esse momento ainda mais especial! </p>
        </div>
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
            <h2 class="montserrat-regular">Um amor construído...</h2>
            <p class="balkind-regular">
                Desde a escola, quem poderia imaginar? Eles provavelmente não...
                duas crianças que se conheceram no ensino médio, que unidos a
                tantos anos aprenderam a partilhar e evoluir em sintonia.
                Construindo a cada dia o amor, respeito e carinho que os trouxeram
                até aqui. 
            </p>
            <p class="balkind-regular">
                Onze anos depois, um pedido, um anel e um sonho de ficarem pra
                sempre juntos . Eles decidiram se casar e esperam que você possa
                participar deste dia tão especial.
            </p>
        </div>
    </div>

    <section class="image-section2">
        <div class="image-container2 full-width">
            <img src="{{ asset('storage/images/foto-conjunto-1.jpg') }}" alt="Imagem 1" >
        </div>
        <div class="image-container2 half-width image-to-hide">
            <img src="{{ asset('storage/images/foto-conjunto-2.jpg') }}" alt="Imagem 2" >
        </div>
    </section>

    <div class="background-container" id="section_presenca">
        <div> 
            <h2 class="montserrat-regular">Confirme sua Presença</h2>
        </div>
        <div>
            <p class="balkind-regular"> Ligue para: (33) 8809-1903 ou <br>
                mande e-mail para: <br>
                magdabreguez.cerimonial@gmail.com <br>
                Até o dia 10/08.
            </p>
            <a href="/presenca" class="btn btn-outline">
                Confirmar presença
            </a>
        </div>        
    </div>

    <div class="col-md-6 d-flex align-items-center justify-content-center mt-9 w-100 bg-peixe-relogio">
        <img src="{{ asset('storage/images/foto-presentes.jpg') }}" class="img-fluid" alt="Imagem" style="max-height: 80%; border-radius: 12px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);">
    </div>

    <div class="background-container d-flex flex-column" style="min-height: 500px">
        <div> 
            <h2 class="montserrat-regular">Se deseja nos presentear...</h2>
        </div>
        <div class="d-flex justify-content-between" id="section_presentes" style="width: 100%;">
            <div style="width: 60%;">
                <p class="balkind-regular">Clique no botão para ir até a nossa lista...</p>
            </div>
            <div style="width: 40%; display: flex; justify-content: center; align-items: center;">
                <a href="/presentes" class="btn btn-outline" style="font-size: 1.8rem;">
                    Presentear
                </a>
            </div>
        </div>
    </div>

    <div class="full-width-image">
        <img src="{{ asset('storage/images/foto-4.jpg') }}" class="img-fluid" alt="Imagem">
    </div>

    <div class="capture-moments">       
        <div class="d-flex justify-content-center align-items-center" style="width: 100%;">
            <div style="width: 100%">
                <button 
                    class="btn btn-outline-light balkind-regular" 
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
                    <h5 class="modal-title" id="imageModalLabel">Capture Momentos Especiais</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('storage/images/QR-cod-pasta.png') }}" class="img-fluid" alt="Imagem Ampliada" style="border-radius: 8px;">
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
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            769: {
                slidesPerView: 3,
            },
        },
        effect: 'coverflow',
        coverflowEffect: {
            rotate: 5,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: false,
        },
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
@endsection