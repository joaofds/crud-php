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
            </tr>
        </thead>
        <tbody>
            @foreach($produtos as $produto)
                <tr>
                    <td>{{ $produto->id }}</td>
                    <td>{{ $produto->nome }}</td>
                    <td>R$ {{ $produto->valor }}</td>
                    <td>{{ $produto->qtde }}</td>
                    <td>{{ $produto->categoria }}</td>
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
