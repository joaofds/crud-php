@extends('template.main')
 
@section('title', '..::Produtos::..')
 
@section('content')
<div class="card mt-5">
  <div class="card-header">
    <h4 class="float-start">Cadastro de Categoria</h4>
    <div class="float-end">
        <a href="/categorias" class="btn btn-secondary">Voltar</a>
    </div>
  </div>
  <div class="card-body">
    <form id="form-produto" class="d-flex justify-content-center align-itens-center">
        <div class="col-sm-12 col-md-6">
            <div class="mb-3 mt-3">
                <label for="nome" class="form-label">Nome da Categoria:</label>
                <input type="text" class="form-control" id="nome" name="nome" />
            </div>

            <div class="mb-3 mt-3">
                <label for="percentual" class="form-label">Percentual:</label>
                <input type="number" class="form-control" id="percentual" name="percentual" min="0" max="10000" />
            </div>
            <button type="button" id="salvar" class="btn btn-success mt-3 float-end">Salvar</button>
        </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            //
        });

        $("#salvar").on('click', function() {
            if (!$("#nome").val() || !$("#percentual").val()) {
                alert('Antes de enviar preencha todos os campos')
            } else {
                $.ajax({
                    method: "POST",
                    url: "/categorias/salvar",
                    data: { 
                        categoria: $("#nome").val(),
                        percentual: $("#percentual").val()
                    }
                })
                .done(function(response) {
                    if(response.code == 200) {
                        alert(response.msg)
                        window.location = '/categorias'
                    } else {
                        alert(response.msg)
                    }
                });
            }
        });
    </script>
@endpush

<style>
    input {
        text-transform: uppercase
    }
</style>
