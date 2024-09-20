@extends('layout.body')

@section('content')
    <h1>Bem-vindo ao casamento!</h1>
    <p>Lista de presentes</p>
    <div class="modal fade" id="ModalCreateGift" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Criar presente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <form action="{{ route('create.gift') }}" method="POST" enctype="multipart/form-data">
                            @csrf  
                              
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="name" name="name" value="" required>
                            </div>    
                            <div class="mb-3">
                                <label for="description" class="form-label">Descrição</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                            </div>    
                            <div class="mb-3">
                                <label for="url" class="form-label">URL</label>
                                <input type="url" class="form-control" id="url" name="url" value="" required>
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
    </div>
    <div>
        <div class="d-flex justify-content-end space-between">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalCreateGift">Adicionar</button>
        </div>
    </div>
    <div class="row">

        @foreach($gifts as $gift)
        <div class="col-md-4">
                <div class="gift-item" style="text-align: center;">
                    <img src="{{ asset('storage/' . $gift['image_path']) }}" alt="{{ $gift['name'] }}" class="img-fluid" style="width: 250px; height: 100%; object-fit: cover; border: 2px solid #ddd; border-radius: 4px;">
                    
                    <h3 style="margin-top: 10px;">{{ $gift['name'] }}</h3>
                    {{-- <p>{{ $gift['price'] }} R$</p> --}}
                    
                    <p id="description-{{ $gift['id'] }}">
                        {{ Str::limit($gift['description'], 20) }}
                        <button type="button" class="btn btn-link" onclick="document.getElementById('full-description-{{ $gift['id'] }}').style.display='block'; this.style.display='none';">Leia mais</button>
                    </p>
                    <p id="full-description-{{ $gift['id'] }}" style="display: none;">
                        {{ $gift['description'] }}
                        <button type="button" class="btn btn-link" onclick="document.getElementById('full-description-{{ $gift['id'] }}').style.display='none'; document.getElementById('description-{{ $gift['id'] }}').style.display='block';">Fechar</button>
                    </p>
                    
                    <a href="{{ $gift['url'] }}" class="btn btn-secondary">Link de desejo</a>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalEditGift{{ $gift['id'] }}">Editar</button>
                    <form action="{{ route('delete.gift', $gift['id']) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar?');" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Deletar
                        </button>
                    </form>
                </div>
            </div>
          
            <div class="modal fade" id="ModalEditGift{{ $gift['id'] }}" tabindex="-1" aria-labelledby="ModalEditGiftLabel{{ $gift['id'] }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalEditGiftLabel{{ $gift['id'] }}">Editar Presente</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('update.gift', $gift['id']) }}" method="POST">
                                @csrf  

                                <div class="mb-3">
                                    <label for="name{{ $gift['id'] }}" class="form-label">Nome</label>
                                    <input type="text" class="form-control" id="name{{ $gift['id'] }}" name="name" value="{{ $gift['name'] }}" required>
                                </div>    
                                <div class="mb-3">
                                    <label for="description{{ $gift['id'] }}" class="form-label">Descrição</label>
                                    <textarea class="form-control" id="description{{ $gift['id'] }}" name="description" rows="3" required>{{ $gift['description'] }}</textarea>
                                </div>    
                                <div class="mb-3">
                                    <label for="url{{ $gift['id'] }}" class="form-label">URL</label>
                                    <input type="url" class="form-control" id="url{{ $gift['id'] }}" name="url" value="{{ $gift['url'] }}" required>
                                </div>    
                                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection