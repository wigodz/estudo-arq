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

    .btn-purchase, .btn-selected {
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

    .btn-purchase {
        background-color: var(--primary-color);
        color: var(--white);
        border: none;
        cursor: pointer;
    }

    .btn-purchase:hover {
        background-color: #c69c6d;
    }

    .admin-actions {
        display: flex;
        gap: 0.5rem;
        justify-content: center; /* Centraliza os botões admin */
    }

    .pagination .page-item.active .page-link {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .pagination .page-link {
        color: var(--primary-color);
    }

    .modal-content {
        border-radius: 10px;
    }

    .modal-header {
        background-color: var(--primary-color);
        color: white;
        border-radius: 10px 10px 0 0;
    }

    .modal-title {
        color: white;
    }

    .btn-close {
        color: white;
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
                        <label for="image_path" class="form-label">Imagem (opcional)</label>
                        <input type="file" class="form-control" id="image_path" name="image_path" accept="image/*">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary" style="background-color: var(--primary-color); border-color: var(--primary-color);">Criar presente</button>
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

    @if ($userLogado->is_admin)
    <div class="d-flex justify-content-end mb-4">
        <button class="btn btn-purchase" data-bs-toggle="modal" data-bs-target="#ModalCreateGift">Adicionar Presente</button>
    </div>
    @endif

    <div class="row gifts-container">
        <!-- Os presentes serão carregados aqui via JavaScript -->
    </div>

    <nav aria-label="Navegação de páginas" class="mt-4">
        <ul class="pagination justify-content-center" id="pagination">
            <!-- Paginação será carregada aqui via JavaScript -->
        </ul>
    </nav>
</div>

<!-- Modal de confirmação -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Presente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Você está prestes a escolher <span id="giftName"></span>.</p>
                <p>Deseja continuar?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-purchase" id="confirmGiftBtn">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<script>
    let currentPage = 1;
    let selectedGiftId = null;
    let selectedGiftUrl = null;

    function fetchGifts(page = 1) {
        currentPage = page;
        fetch(`{{ route('presentes.get') }}?page=${page}`)
            .then(response => response.json())
            .then(data => {
                let giftsContainer = document.querySelector('.gifts-container');
                giftsContainer.innerHTML = '';

                data.data.forEach(gift => {
                    // Verificar se o presente já foi escolhido (você precisará adicionar esta lógica no backend)
                    const isSelected = gift.is_selected || false;
                    
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
                                        ${!isSelected ? 
                                            `<button onclick="selectGift(${gift.id}, '${gift.name}', '${gift.url}')" class="btn-purchase">Presentear</button>` : 
                                            `<button disabled class="btn-selected">Já Escolhido</button>`
                                        }
                                        
                                        @if ($userLogado->is_admin)
                                        <div class="admin-actions">
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#ModalEditGift${gift.id}">Editar</button>
                                            <form action="/delete/gift/${gift.id}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar?');" style="display:inline;">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i> Deletar
                                                </button>
                                            </form>
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
            <a class="page-link" href="#" onclick="fetchGifts(${data.current_page - 1}); return false;">&laquo;</a>
        </li>`;

        for (let i = 1; i <= data.last_page; i++) {
            paginationContainer.innerHTML += `<li class="page-item ${data.current_page === i ? 'active' : ''}">
                <a class="page-link" href="#" onclick="fetchGifts(${i}); return false;">${i}</a>
            </li>`;
        }

        paginationContainer.innerHTML += `<li class="page-item ${data.current_page === data.last_page ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="fetchGifts(${data.current_page + 1}); return false;">&raquo;</a>
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

    // Configurar o botão de confirmação
    document.getElementById('confirmGiftBtn').addEventListener('click', function() {
        if (selectedGiftId) {
            // Enviar solicitação para marcar o presente como selecionado
            fetch('/api/gifts/select', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ gift_id: selectedGiftId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Redirecionar para a URL de compra
                    window.open(selectedGiftUrl, '_blank');
                    
                    // Recarregar os presentes para atualizar a interface
                    fetchGifts(currentPage);
                    
                    // Fechar o modal
                    bootstrap.Modal.getInstance(document.getElementById('confirmationModal')).hide();
                } else {
                    alert('Este presente já foi escolhido por outra pessoa. Por favor, escolha outro presente.');
                    fetchGifts(currentPage);
                }
            })
            .catch(error => {
                console.error('Erro ao selecionar presente:', error);
                alert('Ocorreu um erro ao selecionar o presente. Por favor, tente novamente.');
            });
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        fetchGifts();
    });
</script>
@endsection