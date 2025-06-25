@extends('layout.body')

@section('content')
<style>
    :root {
        --primary-color: #d4a373;
        --secondary-color: #faedcd;
        --text-color: #333;
        --light-text: #666;
        --white: #fff;
        --selected-overlay: rgba(212, 163, 115, 0.8);
        --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    body {
        background-color: #fefae0;
        color: var(--text-color);
        font-family: 'Montserrat', 'Helvetica Neue', sans-serif;
    }

    .header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .header h1 {
        font-size: 2.5rem;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    }

    .header p {
        font-size: 1.1rem;
        color: var(--light-text);
    }

    /* Filter styles */
    .filter-container {
        background-color: var(--white);
        border-radius: 10px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow);
    }

    .filter-title {
        color: var(--primary-color);
        font-size: 1.2rem;
        margin-bottom: 1rem;
        font-weight: 600;
    }

    .category-filters {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .category-filter {
        background-color: var(--secondary-color);
        color: var(--text-color);
        border: 2px solid transparent;
        border-radius: 20px;
        padding: 0.5rem 1rem;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 0.9rem;
    }

    .category-filter:hover {
        background-color: #f5e5b8;
    }

    .category-filter.active {
        background-color: var(--primary-color);
        color: var(--white);
        border-color: var(--primary-color);
    }

    .filter-reset {
        background: none;
        border: none;
        color: var(--primary-color);
        text-decoration: underline;
        cursor: pointer;
        margin-left: auto;
        font-size: 0.9rem;
    }

    .filter-reset:hover {
        color: #c69c6d;
    }

    /* Existing styles */
    .gifts-container .gift-card {
        background-color: var(--white);
        border-radius: 10px;
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: transform 0.3s ease;
        margin-bottom: 2rem;
        height: 100%;
        display: flex;
        flex-direction: column; /* Organiza o conteúdo em coluna */
    }

    .gifts-container .gift-card:hover:not(.selected) {
        transform: translateY(-5px);
    }

    .gift-image {
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .gift-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
        border: none;
        border-radius: 0;
        box-shadow: none;
    }

    .gift-card:hover:not(.selected) .gift-image img {
        transform: scale(1.05);
    }

    .gift-info {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1; /* Faz com que ocupe todo o espaço disponível */
    }

    .gift-content {
        flex-grow: 1; /* Faz com que o conteúdo ocupe o espaço disponível */
        margin-bottom: 1.5rem; /* Espaço entre o conteúdo e os botões */
    }

    .gift-info h3 {
        font-size: 1.3rem;
        margin-bottom: 0.5rem;
        color: var(--primary-color);
    }

    .gift-info p {
        font-size: 0.9rem;
        color: var(--light-text);
        margin-bottom: 1rem;
    }

    .gift-buttons {
        margin-top: auto; /* Empurra os botões para o final do card */
    }

    .btn-purchase, .btn-selected, .btn-link {
        display: block;
        width: 100%;
        padding: 0.8rem;
        text-align: center;
        border-radius: 5px;
        font-weight: bold;
        transition: all 0.3s ease;
        text-decoration: none;
        margin-bottom: 1rem;
    }

    .btn-options {
        display: block;
        padding: 0.8rem;
        text-align: center;
        border-radius: 5px;
        font-weight: bold;
        transition: all 0.3s ease;
        text-decoration: none;
        margin-bottom: 1rem;
    }

    .btn-purchase, .btn-option {
        background-color: var(--primary-color);
        color: var(--white);
        border: none;
        cursor: pointer;
    }

    .btn-purchase:hover {
        background-color: #c69c6d;
    }

    .btn-link, .btn-option {
        background-color: var(--secondary-color);
        color: var(--primary-color);
        border: 1px solid var(--primary-color);
        cursor: pointer;
    }

    .btn-link:hover, .btn-option:hover {
        background-color: var(--primary-color);
        color: var(--white);
    }

    .admin-actions {
        display: flex;
        gap: 0.5rem;
        justify-content: center; /* Centraliza os botões admin */
    }

    .pagination .page-item.active .page-link {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: var(--white);
    }

    .pagination .page-item.active .page-link {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: var(--white);
    }

    .pagination .page-link {
        color: var(--primary-color);
    }

    /* Estilos melhorados para o modal */
    .modal-content {
        border-radius: 15px;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
        background-color: var(--primary-color);
        color: white;
        border-radius: 15px 15px 0 0;
        padding: 1.5rem;
        border-bottom: none;
    }

    .modal-title {
        color: white;
        font-weight: 600;
        font-size: 1.4rem;
    }

    .modal-body {
        padding: 2rem;
        text-align: center;
    }

    .modal-footer {
        border-top: none;
        padding: 1.5rem;
        display: flex;
        justify-content: center;
        gap: 1rem;
    }

    .modal-footer .btn {
        min-width: 120px;
        padding: 0.8rem 1.5rem;
        border-radius: 5px;
        font-weight: 600;
    }

    .modal-footer .btn-secondary {
        background-color: #e9e9e9;
        color: var(--text-color);
        border: none;
    }

    .modal-footer .btn-secondary:hover {
        background-color: #d4d4d4;
    }

    .modal-footer .btn-purchase {
        margin-bottom: 0;
    }

    /* Centralização do modal */
    .modal-dialog {
        display: flex;
        align-items: center;
        min-height: calc(100% - 3.5rem);
    }

    @media (min-width: 576px) {
        .modal-dialog {
            max-width: 500px;
            margin: 1.75rem auto;
        }
    }

    /* Animação para o modal */
    .modal.fade .modal-dialog {
        transition: transform 0.3s ease-out;
        transform: scale(0.9);
    }

    .modal.show .modal-dialog {
        transform: scale(1);
    }

    /* Destaque para o nome do presente no modal */
    #giftName {
        font-weight: 700;
        color: var(--primary-color);
    }

    .btn-close {
        color: white;
        opacity: 1;
    }

    .read-more-btn, .read-less-btn {
        color: var(--primary-color);
        padding: 0;
        background: none;
        border: none;
        font-size: 0.9rem;
        text-decoration: underline;
        cursor: pointer;
    }

    .selected-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: var(--selected-overlay);
        display: flex;
        justify-content: center;
        align-items: center;
        color: var(--white);
        font-weight: bold;
        font-size: 1.2rem;
    }

    .btn-selected {
        background-color: #e9e9e9;
        color: #999;
        border: none;
        cursor: not-allowed;
    }

    .selected {
        opacity: 0.8;
    }

    /* Estilo para quando não há presentes */
    .no-gifts {
        text-align: center;
        padding: 3rem;
        background-color: var(--white);
        border-radius: 10px;
        box-shadow: var(--shadow);
    }

    .no-gifts h3 {
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .no-gifts p {
        color: var(--light-text);
    }
    .info-modal .modal-content {
        border-radius: 15px;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }
    .info-modal .modal-header {
        background-color: var(--primary-color);
        color: white;
        border-radius: 15px 15px 0 0;
        padding: 1.5rem;
        border-bottom: none;
    }
    .info-field {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 1rem;
    }
    .info-field input {
        flex: 1;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        padding: 0.5rem;
    }
    .copy-btn {
        background-color: var(--secondary-color);
        color: var(--primary-color);
        border: 1px solid var(--primary-color);
        border-radius: 5px;
        padding: 0.5rem 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .copy-btn:hover {
        background-color: var(--primary-color);
        color: white;
    }
    .qr-code-container {
        text-align: center;
        margin-bottom: 2rem;
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;
        align-content: center;
    }
    .qr-code-container img {
        border: 2px solid var(--primary-color);
        border-radius: 10px;
        padding: 10px;
        background-color: white;
    }
</style>

<!-- Modal para adicionar presente -->
<div class="modal fade" id="ModalCreateGift" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Criar presente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('create.gift') }}" method="POST" enctype="multipart/form-data">
                    @csrf  
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>    
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>    
                    <div class="mb-3">
                        <label for="url" class="form-label">URL</label>
                        <input type="url" class="form-control" id="url" name="url" required>
                    </div>
                    <div class="mb-3">
                        <label for="categories" class="form-label">Categoria</label>
                        <select name="categories" id="categories" class="form-select" required>
                            <option value="" disabled selected>Selecione uma categoria</option>
                            @foreach(\App\Models\Gift::getCategorias() as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image_path" class="form-label">Imagem (opcional)</label>
                        <input type="file" class="form-control" id="image_path" name="image_path" accept="image/*">
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary" style="background-color: var(--primary-color); border-color: var(--primary-color);">
                            Criar presente
                        </button>
                    </div>                
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <header class="header">
        <h1>Nossa Lista de Presentes</h1>
        <p>Escolha um presente especial para celebrar nosso casamento</p>
    </header>

    <!-- Filtro por categoria -->
    <div class="filter-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="filter-title mb-0">Filtrar por Categoria</h3>
            <button type="button" class="filter-reset" id="resetFilter">Limpar filtros</button>
        </div>
        <div class="category-filters" id="categoryFilters">
            <!-- Categorias serão carregadas aqui via JavaScript -->
        </div>
    </div>

    <div class="d-flex justify-content-between mb-4">
        <div class="d-flex gap-2">
            @if ($userLogado->is_admin)
            <button class="btn btn-option" data-bs-toggle="modal" data-bs-target="#ModalCreateGift">
                Adicionar Presente
            </button>
            @endif
            
            <button class="btn btn-option" data-bs-toggle="modal" data-bs-target="#ModalDeliveryAddress">
                <i class="fas fa-map-marker-alt me-2"></i>Endereço de Entrega
            </button>

            <button class="btn btn-option" data-bs-toggle="modal" data-bs-target="#ModalPixPayment">
                <i class="fas fa-qrcode me-2"></i>PIX para Presente
            </button>
        </div>
    </div>

    <div class="row gifts-container">
        <!-- Os presentes serão carregados aqui via JavaScript -->
    </div>

    <nav aria-label="Navegação de páginas" class="mt-4">
        <ul class="pagination justify-content-center" id="pagination">
            <!-- Paginação será carregada aqui via JavaScript -->
        </ul>
    </nav>
</div>

<!-- Modal de confirmação com estilo melhorado -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Presente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-2">Você está prestes a escolher:</p>
                <p class="h4 mb-4" id="giftName"></p>
                <p>Ao confirmar, este presente será reservado para você e ele não estará disponível para os outros convidados.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-purchase" id="confirmGiftBtn">Confirmar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

{{-- Novo Modal: Endereço de Entrega --}}
<div class="modal fade info-modal" id="ModalDeliveryAddress" tabindex="-1" aria-labelledby="ModalDeliveryAddressLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalDeliveryAddressLabel">
                    <i class="fas fa-map-marker-alt me-2"></i>Endereço para Entrega
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-4 text-muted">Informações para entrega dos presentes:</p>
                
                <div class="info-field">
                    <label class="form-label mb-0" style="min-width: 80px;">Cidade:</label>
                    <input type="text" class="form-control" value="Governador Valadares" readonly id="delivery-city">
                    <button type="button" class="copy-btn" onclick="copyToClipboard('delivery-city', 'Cidade')">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>

                <div class="info-field">
                    <label class="form-label mb-0" style="min-width: 80px;">CEP:</label>
                    <input type="text" class="form-control" value="35050-320" readonly id="delivery-cep">
                    <button type="button" class="copy-btn" onclick="copyToClipboard('delivery-cep', 'CEP')">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>

                <div class="info-field">
                    <label class="form-label mb-0" style="min-width: 80px;">Rua:</label>
                    <input type="text" class="form-control" value="R. Rosa Maria de Souza, 330" readonly id="delivery-street">
                    <button type="button" class="copy-btn" onclick="copyToClipboard('delivery-street', 'Rua')">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>

                <div class="info-field">
                    <label class="form-label mb-0" style="min-width: 80px;">Bairro:</label>
                    <input type="text" class="form-control" value="Sagrada Família" readonly id="delivery-neighborhood">
                    <button type="button" class="copy-btn" onclick="copyToClipboard('delivery-neighborhood', 'Número')">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Novo Modal: PIX --}}
<div class="modal fade info-modal" id="ModalPixPayment" tabindex="-1" aria-labelledby="ModalPixPaymentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalPixPaymentLabel">
                    <i class="fas fa-qrcode me-2"></i>Presentes via PIX
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-4 text-muted">Use o QR Code ou a chave PIX para nos presentear:</p>
                
                <div class="qr-code-container">
                    <img src="{{ asset('storage/images/pix.jpg') }}" alt="QR Code PIX" width="200" height="200">
                </div>

                <div class="info-field">
                    <label class="form-label mb-0" style="min-width: 100px;">Chave PIX:</label>
                    <input type="text" class="form-control" value="33e78200-e17d-44dd-a592-4519c51f9f39" readonly id="pix-key">
                    <button type="button" class="copy-btn" onclick="copyToClipboard('pix-key', 'Chave PIX')">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const choseGiftUrl = "{{ route('chose.gift') }}";
    const categoryMap = {
        "Cozinha": 1,
        "Sala de Estar": 2,
        "Quarto": 3,
        "Banheiro": 4,
        "Lavanderia": 5,
        "Área Externa": 6
    };
</script>

<script>
    let currentPage = 1;
    let selectedGiftId = null;
    let selectedGiftUrl = null;
    let selectedCategory = null;
    let categories = [];

    // Função para carregar as categorias
    function loadCategories() {
        fetch("{{ route('categories.get') }}")
            .then(response => response.json())
            .then(data => {
                categories = data;
                renderCategoryFilters();
            })
            .catch(error => console.error('Erro ao carregar categorias:', error));
    }

    // Função para renderizar os filtros de categoria
    function renderCategoryFilters() {
        const filterContainer = document.getElementById('categoryFilters');
        filterContainer.innerHTML = '<button type="button" class="category-filter active" data-category="all">Todos</button>';
        
        Object.entries(categories).forEach(([id, nome]) => {
            filterContainer.innerHTML += `<button type="button" class="category-filter" data-category="${id}">${nome}</button>`;
        });

        // Adicionar event listeners aos botões de filtro
        document.querySelectorAll('.category-filter').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.category-filter').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                selectedCategory = this.getAttribute('data-category');
                if (selectedCategory === 'all') {
                    selectedCategory = null;
                }
                
                fetchGifts(1);
            });
        });

        // Event listener para o botão de reset
        document.getElementById('resetFilter').addEventListener('click', function() {
            document.querySelector('.category-filter[data-category="all"]').classList.add('active');
            document.querySelectorAll('.category-filter:not([data-category="all"])').forEach(btn => btn.classList.remove('active'));
            selectedCategory = null;
            fetchGifts(1);
        });
    }

    function fetchGifts(page = 1) {
        var currentPage = page;
        if (page !== currentPage) {
            scrollToTop();
        }

        let url = `{{ route('presentes.get') }}?page=${page}`;
        
        if (selectedCategory) {
            url += `&category=${selectedCategory}`;
        }
        
        fetch(url)
            .then(response => response.json())
            .then(data => {
                let giftsContainer = document.querySelector('.gifts-container');
                giftsContainer.innerHTML = '';

                if (data.data.length === 0) {
                    giftsContainer.innerHTML = `
                        <div class="col-12">
                            <div class="no-gifts">
                                <h3>Nenhum presente encontrado</h3>
                                <p>Não encontramos presentes com os filtros selecionados.</p>
                            </div>
                        </div>
                    `;
                    document.getElementById('pagination').style.display = 'none';
                    return;
                }

                document.getElementById('pagination').style.display = 'flex';

                data.data.forEach(gift => {
                    // Verificar se o presente já foi escolhido
                    const isSelected = !gift.avaliable || false;
                    const qtdPresentes = {{ $presentesEscolhidos }};
                    
                    let giftElement = `
                        <div class="col-md-3 mb-4">
                            <div class="gift-card ${isSelected ? 'selected' : ''}">
                                <div class="gift-image">
                                    <img src="${gift.image_path ? '{{ asset('storage/') }}' + '/' + gift.image_path : '/placeholder.svg?height=200&width=300'}" alt="${gift.name}">
                                    ${isSelected ? '<div class="selected-overlay"><span>Presente Escolhido</span></div>' : ''}
                                </div>
                                <div class="gift-info">
                                    <div class="gift-content">
                                        <h3>${gift.name}</h3>
                                        <p id="short-description-${gift.id}">
                                            ${gift.description.length > 100 ? gift.description.substring(0, 100) + '...' : gift.description}
                                            ${gift.description.length > 100 ? `<button type="button" class="read-more-btn" onclick="showFullDescription(${gift.id})">Leia mais</button>` : ''}
                                        </p>
                                        <p id="full-description-${gift.id}" style="display: none;">
                                            ${gift.description}
                                            <button type="button" class="read-less-btn" onclick="hideFullDescription(${gift.id})">Mostrar menos</button>
                                        </p>
                                    </div>
                                    
                                    <div class="gift-buttons">
                                        ${!isSelected && qtdPresentes <= 3 ? 
                                            `<button onclick="selectGift(${gift.id}, '${gift.name}', '${gift.url}')" class="btn-purchase">Presentear</button>` : 
                                            `<button disabled class="btn-selected">Já Escolhido</button>`
                                        }
                                        
                                        <!-- Botão de Link de Compra -->
                                        <a href="${gift.url}" target="_blank" class="btn-link">Link de Compra</a>
                                        
                                        @if ($userLogado->is_admin)
                                        <div class="admin-actions">
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#ModalEditGift${gift.id}">Editar</button>
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="deleteGift(${gift.id})">
                                                    <i class="fas fa-trash"></i> Deletar
                                            </button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal para edição do presente -->
                        <div class="modal fade" id="ModalEditGift${gift.id}" tabindex="-1" aria-labelledby="ModalEditGiftLabel${gift.id}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ModalEditGiftLabel${gift.id}">Editar Presente</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('update.gift', ':id') }}".replace(':id', gift.id) method="POST" enctype="multipart/form-data">
                                            @csrf  
                                            <input type="hidden" name="id" value="${gift.id}">

                                            <div class="mb-3">
                                                <label for="name${gift.id}" class="form-label">Nome</label>
                                                <input type="text" class="form-control" id="name${gift.id}" name="name" value="${gift.name}" required>
                                            </div>    
                                            <div class="mb-3">
                                                <label for="description${gift.id}" class="form-label">Descrição</label>
                                                <textarea class="form-control" id="description${gift.id}" name="description" rows="3" required>${gift.description}</textarea>
                                            </div>    
                                            <div class="mb-3">
                                                <label for="url${gift.id}" class="form-label">URL</label>
                                                <input type="url" class="form-control" id="url${gift.id}" name="url" value="${gift.url}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="categories${gift.id}" class="form-label">Categoria</label>
                                                <select name="categories" id="categories${gift.id}" class="form-select" required>
                                                    @foreach(\App\Models\Gift::getCategorias() as $key => $label)
                                                        <option value="{{ $key }}" ${gift.categories == "{{ $key }}" ? 'selected' : ''}>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="image_path${gift.id}" class="form-label">Nova Imagem (opcional)</label>
                                                <input type="file" class="form-control" id="image_path${gift.id}" name="image_path" accept="image/*">
                                            </div>
                                            <button type="submit" class="btn btn-primary" style="background-color: var(--primary-color); border-color: var(--primary-color);">Salvar Alterações</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    giftsContainer.innerHTML += giftElement;
                });

                updatePagination(data);
            })
            .catch(error => console.error('Erro ao buscar presentes:', error));
    }

    function updatePagination(data) {
        let paginationContainer = document.getElementById('pagination');
        paginationContainer.innerHTML = '';

        paginationContainer.innerHTML += `<li class="page-item ${data.current_page === 1 ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="fetchGifts(${data.current_page - 1}); scrollToTop(); return false;">&laquo;</a>
        </li>`;

        for (let i = 1; i <= data.last_page; i++) {
            paginationContainer.innerHTML += `<li class="page-item ${data.current_page === i ? 'active' : ''}">
                <a class="page-link" href="#" onclick="fetchGifts(${i});  scrollToTop(); return false;">${i}</a>
            </li>`;
        }

        paginationContainer.innerHTML += `<li class="page-item ${data.current_page === data.last_page ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="fetchGifts(${data.current_page + 1});  scrollToTop(); return false;">&raquo;</a>
        </li>`;
    }

    function showFullDescription(giftId) {
        document.getElementById(`short-description-${giftId}`).style.display = 'none';
        document.getElementById(`full-description-${giftId}`).style.display = 'block';
    }

    function hideFullDescription(giftId) {
        document.getElementById(`short-description-${giftId}`).style.display = 'block';
        document.getElementById(`full-description-${giftId}`).style.display = 'none';
    }

    function selectGift(giftId, giftName, giftUrl) {
        selectedGiftId = giftId;
        selectedGiftUrl = giftUrl;
        document.getElementById('giftName').textContent = giftName;
        
        // Usando Bootstrap 5 para mostrar o modal
        var confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
        confirmationModal.show();
    }

    function deleteGift(giftId) {
        let url = "{{ route('delete.gift', ':id') }}".replace(':id', giftId);
        
        Swal.fire({
            title: "Deseja realmente deletar este presente?",
            showCancelButton: true,
            confirmButtonText: "Deletar Presente",
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(url, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    if (response.data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: response.data.message,
                            showConfirmButton: true
                        });
                        fetchGifts(currentPage);
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro ao deletar',
                        text: 'Algo deu errado.'
                    });
                });
            }
        });
    }

    document.getElementById('confirmGiftBtn').addEventListener('click', function () {
        if (selectedGiftId) {
            var request = { id: selectedGiftId };

            axios.post(choseGiftUrl, request, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                const data = response.data;

                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Boa Escolha!',
                        text: 'Presente separado para você.',
                        showConfirmButton: true
                    });
                    bootstrap.Modal.getInstance(document.getElementById('confirmationModal')).hide();
                }

                fetchGifts(currentPage);
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Algo deu Errado',
                    text: 'Ocorreu um erro ao separar o presente.'
                });
            });
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        loadCategories();
        fetchGifts();
    });
</script>

<script>
    function copyToClipboard(elementId, label) {
        const element = document.getElementById(elementId);
        const text = element.value;
        
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(text).then(function() {
                showCopySuccess(label);
            }).catch(function(err) {
                fallbackCopyTextToClipboard(text, label);
            });
        } else {
            fallbackCopyTextToClipboard(text, label);
        }
    }

    function fallbackCopyTextToClipboard(text, label) {
        const textArea = document.createElement("textarea");
        textArea.value = text;
        textArea.style.top = "0";
        textArea.style.left = "0";
        textArea.style.position = "fixed";
        
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        
        try {
            const successful = document.execCommand('copy');
            if (successful) {
                showCopySuccess(label);
            } else {
                showCopyError();
            }
        } catch (err) {
            showCopyError();
        }
        
        document.body.removeChild(textArea);
    }

    function showCopySuccess(label) {
        Swal.fire({
            icon: 'success',
            title: 'Copiado!',
            text: `${label} copiado para a área de transferência.`,
            timer: 2000,
            showConfirmButton: false
        });
    }

    function showCopyError() {
        Swal.fire({
            icon: 'error',
            title: 'Erro',
            text: 'Não foi possível copiar o texto.',
            timer: 2000,
            showConfirmButton: false
        });
    }

    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth',
        });
    }
</script>

@endsection
