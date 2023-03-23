@extends('template.main')
 
@section('title', '..::PDV::..')
 
@section('content')
<div class="card mt-5">
  <div class="card-header">
    <h4 class="float-start">PDV</h4>
    <div class="float-end">
        <a href="/vendas" class="btn btn-secondary">Voltar</a>
    </div>
  </div>
  <div class="card-body">
    <form id="form-pdv">
        <div class="row">
            <div class="col-8">
                <div class="mb-3 mt-3">
                    <select class="form-select" id="single-select-field" data-placeholder="Buscar produtos">
                        <option></option>
                        @foreach($produtos as $produto)
                            <option data-id="{{ $produto->id }}">{{ $produto->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="mb-3 mt-3">
                    <input type="number" class="form-control" id="qtde" min="1" max="1000" placeholder="Qtde"/>
                </div>
            </div>
            <div class="col-1">
                <button type="button" id="add-produto" class="btn btn-lg btn-success mt-3 float-end">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <table id="produtos" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Produto</th>
                            <th>Qtde</th>
                            <th>Preço</th>
                            <th>ICMS UND</th>
                            <th>Total ICMS</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th id="total_icms"></th>
                            <th id="total-produtos"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="d-flex flex-column text-center">
                        <h4 class="text-muted">Total</h4>
                        <h2 class="total">R$: 0,00</h2>
                    </div>
                </div>
                <div class="row">
                    <button type="button" id="finalizar" class="btn btn-primary mt-3 float-end">Finalizar</button>
                </div>
            </div>
        </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
    <script>
        // para guardar ultimo produto selecionado no select2
        var produto = null;
        var produtos = [];

        // atribui produto selecionado à variavel produto.
        $(document).ready(function() {
            // event on change do select
            $('#single-select-field').on('select2:select', function (e) {
                produto = e.params.data;
            });
        });


        // event on click do botão para inserir na tabela
        $('#add-produto').on('click', function() {
            // input de quantidade
            let qtde = $("#qtde").val();

            // produto atual
            let preco = produto?.preco;
            let icms_und = (produto?.preco * produto?.percentual).toFixed(2);
            let icms_total = ((produto?.preco * produto?.percentual) * qtde).toFixed(2);
            let total_itens = (produto?.preco * qtde).toFixed(2);
            
            if (!produto || qtde == "") {
                alert('Preencha todos os campos...')
            } else {
                // count para imcrementar contagem da tabela
                let count = $("#produtos").find('tbody tr').length;

                // dados para table body
                $("#produtos").find('tbody')
                    .append(
                    `
                        <tr>
                            <td>${count + 1}</td>
                            <td>${produto.text}</td>
                            <td>${qtde}</td>
                            <td>${preco}</td>
                            <td>${icms_und}</td>
                            <td>${icms_total}</td>
                            <td>${total_itens}</td>
                        </tr>
                    `
                )

                // atualiza produto atual no array de produtos
                produto.icms_und = icms_und;
                produto.icms_total = icms_total;
                produto.qtde = qtde;
                produto.total_itens = total_itens;
                produtos.push(produto);

                // busca totais no array de produtos
                let icms = calculaTotal(produtos, 'icms_total');
                let total = calculaTotal(produtos, 'total_itens');

                // atualiza totais e limpa inputs
                $('#total_icms').html('Total: ' + icms);
                $('#total-produtos').html('Total: ' + total);
                $('.total').html('R$: '+ total);
                $("#single-select-field").empty();
                $("#qtde").val('')

            }
        });

        // funcao para calculo de total de um item dentro de um array de objetos
        function calculaTotal(array, propriedade) {
            return array.reduce((acumulador, objeto) => acumulador + parseFloat(objeto[propriedade]), 0).toFixed(2);
        }

        // select2 e ajax
        $("#single-select-field").select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '10%' : 'style',
            placeholder: $(this).data('placeholder'),
            tags: true,
            multiple: false,
            tokenSeparators: [',', ' '],
            minimumInputLength: 2,
            minimumResultsForSearch: 10,
            ajax: {
                url: '/produtos/find',
                dataType: "json",
                type: "POST",
                data: function (params) {
                    var queryParameters = {
                        term: params.term
                    }
                    return queryParameters;
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                id: item.id,
                                text: item.nome.toUpperCase(),
                                preco: item.valor,
                                categoria: item.categoria,
                                percentual: item.percentual
                                
                            }
                        })
                    };
                }
            }
        });

        // ajax para envio da venda
        $("#finalizar").on('click', function() {
            if (!produtos.length) {
                alert('Nenhum produto foi selecionado...')
            } else {    
                $.ajax({
                    method: "POST",
                    url: "/vendas/salvar",
                    data: {
                        //cliente_id: 2,
                        total_venda: calculaTotal(produtos, 'total_itens'),
                        total_imposto: calculaTotal(produtos, 'icms_total'),
                        produtos: produtos
                    }
                })
                .done(function(response) {
                    if(response.code == 200) {
                        alert(response.msg);
                        window.location = '/vendas'
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
