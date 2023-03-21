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
            <div class="col">
                <table id="produtos" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Produto</th>
                            <th>Qtde</th>
                            <th>Preço</th>
                            <th>Total</th>
                            <th>ICMS UND</th>
                            <th>Total ICMS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Produto 1</td>
                            <td>2</td>
                            <td>R$ 2,50</td>
                            <td>R$ 5,00</td>
                            <td>R$ 0,35</td>
                            <td>R$ 0,70</td>
                        </tr>
                        <td>1</td>
                            <td>Produto 2</td>
                            <td>5</td>
                            <td>R$ 3,50</td>
                            <td>R$ 17,50</td>
                            <td>R$ 0,32</td>
                            <td>R$ 1,60</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Total: 22,50 </th>
                            <th></th>
                            <th>Total ICMS: 2,30</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#single-select-field').select2({
                theme: "bootstrap-5",
                width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
                placeholder: $( this ).data( 'placeholder' ),
            });
        });
    </script>
@endpush

<style>
    input {
        text-transform: uppercase
    }
</style>
