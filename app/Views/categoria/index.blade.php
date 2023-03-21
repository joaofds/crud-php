@extends('template.main')
 
@section('title', '..::Categorias::..')
 
@section('content')
<div class="card mt-5">
  <div class="card-header">
    <h4 class="float-start">Categorias</h4>
    <div class="float-end">
        <a href="/categorias/cadastrar" class="btn btn-primary"><i class="fa fa-plus"></i></a>
    </div>
  </div>
  <div class="card-body">
  <table id="categorias" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Percentual (%)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->id }}</td>
                    <td>{{ $categoria->nome }}</td>
                    <td>{{ $categoria->percentual }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Percentual (%)</th>
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
