@extends('layout.body')

@section('content')
<style>
    .image-gift {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .gifts-container .gift-item {
        margin-bottom: 20px;
    }
    .image-gift img {
        width: 250px;
        height: 100%;
        object-fit: cover;
        border: 2px solid #ddd;
        border-radius: 8px; /* Deixando as bordas mais suaves */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave para efeito elegante */
        transition: transform 0.3s ease, box-shadow 0.3s ease; /* Transição suave ao passar o mouse */
    }

    .image-gift img:hover {
        transform: scale(1.05); /* Pequeno zoom ao passar o mouse */
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Aumenta a sombra ao passar o mouse */
    }
</style>

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
                        <button type="submit" class="btn btn-primary">Criar presente</button>
                    </div>                
                </form>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-end space-between">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalCreateGift">Adicionar</button>
</div>

<div class="row gifts-container">
</div>

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center" id="pagination">
    </ul>
</nav>

<script>
    let currentPage = 1;

    function fetchGifts(page = 1) {
        fetch(`{{ route('presentes.get') }}?page=${page}`)
            .then(response => response.json())
            .then(data => {
                let giftsContainer = document.querySelector('.gifts-container');
                let paginationContainer = document.getElementById('pagination');
                giftsContainer.innerHTML = '';

                data.data.forEach(gift => {
                    let giftElement = `
                        <div class="col-md-3"> <!-- 4 presentes por linha -->
                            <div class="gift-item" style="text-align: center;">
                                <div class="image-gift">
                                    <a target="_blank" href="${gift.url}"> <!-- Torna a imagem clicável -->
                                        <img src="${gift.image_path ? '{{ asset('storage/') }}' + '/' + gift.image_path : 'URL_IMAGEM_PADRAO'}" alt="${gift.name}" class="img-fluid">
                                    </a>
                                </div>
                                <div>
                                    <h3 style="margin-top: 10px;">${gift.name}</h3>
                                    <p id="description-${gift.id}">
                                        ${gift.description.substring(0, 20)}...
                                        <button type="button" class="btn btn-link" onclick="document.getElementById('full-description-${gift.id}').style.display='block'; this.style.display='none';">Leia mais</button>
                                    </p>
                                    <p id="full-description-${gift.id}" style="display: none;">
                                        ${gift.description}
                                        <button type="button" class="btn btn-link" onclick="document.getElementById('full-description-${gift.id}').style.display='none'; document.getElementById('description-${gift.id}').style.display='block';">Fechar</button>
                                    </p>
                                    <a href="${gift.url}" class="btn btn-secondary" target="_blank">Link de desejo</a>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalEditGift${gift.id}">Editar</button>
                                    <form action="/delete/gift/${gift.id}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar?');" style="display:inline;">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash"></i> Deletar
                                        </button>
                                    </form>
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
                                        <form action="{{ route('update.gift', ':id') }}".replace(':id', gift.id) method="POST">
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
                                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
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
            <a class="page-link" href="#" onclick="fetchGifts(${data.current_page - 1})">&laquo;</a>
        </li>`;

        for (let i = 1; i <= data.last_page; i++) {
            paginationContainer.innerHTML += `<li class="page-item ${data.current_page === i ? 'active' : ''}">
                <a class="page-link" href="#" onclick="fetchGifts(${i})">${i}</a>
            </li>`;
        }

        paginationContainer.innerHTML += `<li class="page-item ${data.current_page === data.last_page ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="fetchGifts(${data.current_page + 1})">&raquo;</a>
        </li>`;
    }

    document.addEventListener('DOMContentLoaded', function () {
        fetchGifts();
    });
</script>

@endsection
