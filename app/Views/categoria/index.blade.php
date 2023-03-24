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
                <th>Data Cadastro</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            @php $count = 1 @endphp
            @foreach($categorias as $categoria)
                <tr>
                    <td>{{ $count++ }}</td>
                    <td>{{ $categoria->nome }}</td>
                    <td>{{ $categoria->percentual }}</td>
                    <td>{{ date('d/m/Y H:m', strtotime($categoria->data_cadastro))}}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-gear"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li class="deletar" data="{{ $categoria->id }}"><a class="dropdown-item" href="#">Remover</a></li>
                                    <li class="edit" data="{{ $categoria->id }}"><a class="dropdown-item" href="#">Editar</a></li>
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
                <th>Nome</th>
                <th>Percentual (%)</th>
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

        // deleta uma categoria
        $(".deletar").on('click', function() {
          let id_produto = $(this).attr('data');
          let table_tr = $(this).closest('tr');
          console.log($(this).closest('tr'));
          $.ajax({
                    method: "POST",
                    url: `/categoria/delete`,
                    data: { 
                        id: id_produto
                    }
                })
                .done(function(response) {
                    if(response.code == 200) {
                        alert(response.msg);
                        table_tr.remove();
                    } else {
                        alert(response.msg);
                    }
                });
        });
    </script>
@endpush
