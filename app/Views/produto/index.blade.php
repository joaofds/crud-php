@extends('template.main')
 
@section('title', '..::Produtos::..')
 
@section('content')
<div class="card mt-5">
  <div class="card-header">
    <h4 class="float-start">Produtos</h4>
    <div class="float-end">
        <a href="/produtos/cadastrar" class="btn btn-primary"><i class="fa fa-plus"></i></a>
    </div>
  </div>
  <div class="card-body">
  <table id="produtos" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Produto</th>
                <th>Preço</th>
                <th>Qtde</th>
                <th>Categoria</th>
                <th>Data Cadastro</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            @php $count = 1 @endphp
            @foreach($produtos as $produto)
                <tr>
                    <td>{{ $count++ }}</td>
                    <td>{{ $produto->nome }}</td>
                    <td>R$ {{ $produto->valor }}</td>
                    <td>{{ $produto->qtde }}</td>
                    <td>{{ $produto->categoria }}</td>
                    <td>{{ date('d/m/Y H:m', strtotime($produto->data_cadastro))}}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-gear"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#itensVenda">Remover</a></li>
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#itensVenda">Editar</a></li>
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
                <th>Produto</th>
                <th>Preço</th>
                <th>Qtde</th>
                <th>Categoria</th>
                <th>Data Cadastro</th>
                <th>Ação</th>
            </tr>
        </tfoot>
    </table>
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
