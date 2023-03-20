@extends('template.main')
 
@section('title', '..::Produtos::..')
 
@section('content')
<div class="card mt-5">
  <div class="card-header">
    <h4 class="float-start">Cadastro de Produto</h4>
    <div class="float-end">
        <a href="/produtos" class="btn btn-secondary">Voltar</a>
    </div>
  </div>
  <div class="card-body">
    <form id="form-produto" class="d-flex justify-content-center align-itens-center">
        <div class="col-sm-12 col-md-6">
            <div class="mb-3 mt-3">
                <label for="produto" class="form-label">Nome do Produto:</label>
                <input type="text" class="form-control" id="produto" name="produto" />
            </div>

            <div class="mb-3 mt-3">
                <label for="preco" class="form-label">Preço:</label>
                <input type="number" class="form-control" id="preco" name="preco" min="0.00" max="10000.00" step="0.01" />
            </div>

            <div class="mb-3 mt-3">
                <label for="qtde" class="form-label">Quantidade:</label>
                <input type="number" class="form-control" id="qtde" name="qtde" min="1" max="10000" />
            </div>

            <select id="tipo" class="form-select">
                <option value="" selected>Selecione a categoria...</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>

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
            if (!$("#produto").val() || !$("#preco").val() || !$("#qtde").val() || ($("#tipo").val() == "")) {
                alert('Preencha todos os campos')
            } else {    
                $.ajax({
                    method: "POST",
                    url: "/produtos/salvar",
                    data: { 
                        produto: $("#produto").val(),
                        preco: $("#preco").val(),
                        qtde: $("#qtde").val(),
                        tipo: $("#tipo").val()
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
