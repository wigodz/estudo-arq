@extends('layout.body')

@section('content')
<style>
    :root {
        --burgundy: #4f0c0f;
        --deep-red: #8B2621;
        --terracotta: #C17A56;
        --peach: #E8A87C;
        --sage: #A9B4A7;
    }

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
        color: var(--burgundy);
        text-align: center;
        padding: 40px;
        box-sizing: border-box;
    }

    .title-text {
        font-family: "Montserrat", sans-serif;
        font-weight: 500;
        color: var(--burgundy);
        font-size: 2.2rem;
        line-height: 1.5;
        max-width: 800px;
        margin-bottom: 40px;
    }

    .subtitle-text {
        font-family: "Montserrat", sans-serif;
        font-weight: 500;
        color: #8B5A2B;
        font-size: 1.8rem;
        margin-top: 30px;
        margin-bottom: 30px;
        text-align: center;
    }

    .button-container {
        display: flex;
        flex-direction: row;
        gap: 15px;
        justify-content: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .rsvp-btn {
        font-family: "Montserrat", sans-serif;
        padding: 15px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
        width: 250px;
        cursor: pointer;
        text-align: center;
    }

    .rsvp-yes {
        background-color: #8B5A44;
        color: white;
    }

    .rsvp-yes:hover {
        background-color: #7A4E3B;
    }

    .rsvp-no {
        background-color: #C0BCBB;
        color: white;
    }

    .rsvp-no:hover {
        background-color: #B0ACAB;
    }

    .confirmation-container {
        background-color: rgba(255, 255, 255, 0.9);
        padding: 30px 40px;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        margin-top: 20px;
    }

    /* Table styling */
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 30px 0;
        font-family: "Montserrat", sans-serif;
        font-size: 15px;
        text-align: left;
        background-color: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    thead tr {
        background-color: var(--burgundy);
        color: #ffffff;
        text-align: left;
        font-weight: 500;
        letter-spacing: 0.5px;
    }

    th, td {
        padding: 14px 18px;
        border: none;
        border-bottom: 1px solid #f0e6e6;
    }

    tbody tr:nth-child(even) {
        background-color: #faf6f6;
    }

    tbody tr:hover {
        background-color: #f7f1f1;
    }

    .checkbox-container {
        text-align: center;
    }

    /* Pagination styling */
    .pagination-container {
        margin: 30px 0;
        text-align: center;
        font-family: "Montserrat", sans-serif;
    }

    .pagination .page-item {
        display: inline-block;
        margin: 0 5px;
    }

    .pagination .page-link {
        color: var(--burgundy);
        text-decoration: none;
        border: 1px solid #f0e6e6;
        padding: 10px 15px;
        border-radius: 30px;
        transition: all 0.3s ease;
        font-size: 14px;
    }

    .pagination .page-link:hover {
        background-color: #f7f1f1;
    }

    .pagination .active .page-link {
        background-color: var(--burgundy);
        color: white;
        border: 1px solid var(--burgundy);
    }

    /* Status indicators */
    .status-indicator {
        display: inline-block; 
        width: 15px; 
        height: 15px; 
        border-radius: 50%;
    }

    .status-yes {
        background-color: var(--sage);
    }

    .status-no {
        background-color: var(--terracotta);
    }

    /* Decorative elements */
    .floral-divider {
        height: 30px;
        background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="20" viewBox="0 0 100 20"><path d="M0,10 C30,20 70,0 100,10" stroke="%23C17A56" stroke-width="1" fill="none" /></svg>');
        background-repeat: repeat-x;
        background-size: 100px 20px;
        margin: 20px 0;
        opacity: 0.6;
    }
</style>

<div class="background-container">
    <div class="floral-divider"></div>
    <div> 
        <h2 class="title-text">Não deixe de confirmar sua presença nesse momento tão especial para nós. Você foi escolhido com carinho para fazer parte desse momento e ficaríamos extremamente felizes com sua presença.</h2>
    </div>
    @if ($userLogado->presenca === null)
    <div class="confirmation-container">
        <div class="row">
            <div class="col-md-12 d-flex align-items-center">
                <div>
                    <h2 class="subtitle-text">Podemos contar com a sua presença {{ $userLogado->name }}?</h2>
                    <div class="button-container">
                        <button class="rsvp-btn rsvp-yes" id="simBtn" data-answer="sim">Sim, estarei presente</button>
                        <button class="rsvp-btn rsvp-no" id="naoBtn" data-answer="nao">Infelizmente não poderei ir</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="floral-divider"></div>
</div>

@if ($userLogado->is_admin)
<div class="admin-section">
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Convidado</th>
                <th>Presença</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->telefone }}</td>
                    <td class="checkbox-container">
                        <input type="checkbox" class="convidado-checkbox" data-user-id="{{ $user->id }}" 
                        @if ($user->convidado) checked @endif>
                    </td>                
                    <td class="checkbox-container">
                        @if ($user->presenca)
                            <span class="status-indicator status-yes"></span>
                        @else
                            <span class="status-indicator status-no"></span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination-container">
        {{ $users->links() }}
    </div>
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
                    Swal.fire({
                        icon: 'success',
                        title: 'Atualizado!',
                        text: 'Status atualizado com sucesso.',
                        showConfirmButton: true
                    });
                }
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: 'Ocorreu um erro ao atualizar o status.'
                });
            }
        });
    });

    function enviarResposta(resposta) {
        $.ajax({
            url: '{{ route("presenca.update-presenca") }}', 
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                presenca: resposta 
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Confirmado!',
                    text: resposta == 1 ? 'Presença confirmada. Que bom poder ter você conosco neste dia!' : 'Agradecemos a resposta.',
                    showConfirmButton: true
                }).then(() => {
                    location.reload();
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: 'Ocorreu um erro ao salvar sua resposta.'
                });
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
