@extends('template.main')
 
@section('title', '..::Vendas::..')
 
@section('content')
<div class="card mt-5">
  <div class="card-header">
    <h4 class="float-start">Minhas Vendas</h4>
    <div class="float-end">
        <a href="/vendas/cadastrar" class="btn btn-primary"><i class="fa fa-plus"></i></a>
    </div>
  </div>
  <div class="card-body">
  <table id="vendas" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>CPF</th>
                <th>Total</th>
                <th>Total Imposto</th>
                <th>Data</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            @php $count = 1 @endphp
            @foreach($vendas as $venda)
                <tr>
                    <td>{{ $count++ }}</td>
                    <td>{{ $venda->cliente }}</td>
                    <td>{{ $venda->cpf }}</td>
                    <td>R$ {{ $venda->total_venda }}</td>
                    <td>{{ $venda->total_imposto }}</td>
                    <td>{{ date('d/m/Y H:m', strtotime($venda->data_cadastro))}}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-gear"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Ver Produtos</a></li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
        <tr>
        <th>#</th>
                <th>Cliente</th>
                <th>CPF</th>
                <th>Total</th>
                <th>Total Imposto</th>
                <th>Data</th>
                <th>Ação</th>
            </tr>
        </tfoot>
    </table>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Produtos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            //
        });

        
    </script>
@endpush
