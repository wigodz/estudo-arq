@extends('layout.body')

@section('content')
<style>
    .background-container {
        position: relative;
        width: 100%;
        height: 900px;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        display: flex;
        flex-direction: column;
        align-items: center;
        color: #fff;
        text-align: center;
        padding: 20px;
        box-sizing: border-box;
    }
    .tangerine-regular {
        font-family: "Tangerine", cursive;
        font-weight: 400;
        font-style: normal;
        color: #4f0c0f;
        font-size: 5rem;
    }
    .tangerine-bold {
        font-family: "Tangerine", cursive;
        font-weight: 700;
        font-style: normal;
        color: #4f0c0f;
        font-size: 2.5rem;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 16px;
        text-align: left;
    }

    thead tr {
        background-color: #4f0c0f;
        color: #ffffff;
        text-align: left;
        font-weight: bold;
    }

    th, td {
        padding: 12px 15px;
        border: 1px solid #ddd;
    }

    tbody tr:nth-child(even) {
        background-color: #f3f3f3;
    }

    tbody tr:hover {
        background-color: #f1f1f1;
    }

    .checkbox-container {
        text-align: center;
    }
    .pagination-container {
        margin: 20px 0;
        text-align: center;
    }

    .pagination .page-item {
        display: inline-block;
        margin: 0 5px;
    }

    .pagination .page-link {
        color: #4f0c0f;
        text-decoration: none;
        border: 1px solid #ddd;
        padding: 8px 12px;
        border-radius: 4px;
        transition: background-color 0.3s;
    }

    .pagination .page-link:hover {
        background-color: #f1f1f1;
    }

    .pagination .active .page-link {
        background-color: #4f0c0f;
        color: white;
        border: 1px solid #4f0c0f;
    }
</style>

<div class="background-container">
    <div> 
        <h2 class="tangerine-regular">Não deixe de confirmar sua presença nesse momento tão especial para nós. Você foi escolhido com carinho para fazer parte desse momento e ficaríamos extremamente felizes com sua presença.</h2>
    </div>
    @if ( $userLogado->presenca == null)
    <div class="row">
        <div class="col-md-12 d-flex align-items-center">
            <div>
                <h2 class="tangerine-bold mt-4">Podemos contar com a sua presença {{ $userLogado->name }}?</h2>
                <button class="btn btn-success me-2" id="simBtn" data-answer="sim">Sim</button>
                <button class="btn btn-danger" id="naoBtn" data-answer="nao">Não</button>
            </div>
        </div>
    </div>
    @endif
</div>

@if ($userLogado->is_admin)
<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Convidado</th>
            <th>Presenca</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->telefone }}</td>
                <td>
                    <input type="checkbox" class="convidado-checkbox" data-user-id="{{ $user->id }}" 
                       @if ($user->convidado) checked @endif>
                </td>                
                <td>
                    @if ($user->presenca)
                        <span style="display: inline-block; width: 15px; height: 15px; background-color: green; border-radius: 50%;"></span>
                    @else
                        <span style="display: inline-block; width: 15px; height: 15px; background-color: red; border-radius: 50%;"></span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="pagination-container">
    {{ $users->links() }}
</div>
@endif

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.convidado-checkbox').change(function() {
        var userId = $(this).data('user-id');
        var isConvidado = $(this).is(':checked');

        $.ajax({
            url: '{{ route("presenca.update-convidado") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                user_id: userId,
                convidado: isConvidado ? 1 : 0 
            },
            success: function(response) {
                if (response.success) {
                    alert('Status atualizado com sucesso!');
                }
            },
            error: function(xhr) {
                alert('Ocorreu um erro ao atualizar o status.');
            }
        });
    });
});

$(document).ready(function() {
    function enviarResposta(resposta) {
        var userId = $(this).data('user-id')
        $.ajax({
            url: '{{ route("presenca.update-presenca") }}', 
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                presenca: resposta 
            },
            success: function(response) {
                alert('Sua resposta foi salva com sucesso!');
            },
            error: function(xhr) {
                alert('Ocorreu um erro ao salvar sua resposta.');
            }
        });
    }

    $('#simBtn').click(function() {
        enviarResposta(1);
    });

    $('#naoBtn').click(function() {
        enviarResposta(0);
    });
});
</script>
@endsection