@extends('template.main')
 
@section('title', '..::Produtos::..')
 
@section('content')
<div class="card mt-5">
  <div class="card-header">
    <h4 class="float-start">Cadastrar Categorias</h4>
    <div class="float-end">
        <a href="/categorias" class="btn btn-secondary">Voltar</a>
    </div>
  </div>
  <div class="card-body">
    <form id="form-produto" class="d-flex justify-content-center align-itens-center">
        <div class="col-sm-12 col-md-6">
            <div class="mb-3 mt-3">
                <label for="categoria" class="form-label">Nome da Categoria:</label>
                <input type="text" class="form-control" id="categoria" name="categoria" />
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
            if (!$("#categoria").val()) {
                alert('Antes de enviar preencha todos os campos')
            } else {
                $.ajax({
                    method: "POST",
                    url: "/categorias/salvar",
                    data: { 
                        categoria: $("#categoria").val()
                    }
                })
                .done(function(response) {
                    alert(response);
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
