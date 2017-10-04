@extends("layout")
@section("conteudo")
<h3 class="page-header">BUSCAR FUNCIONÁRIO</h3>
<form action="{{ route('funcionario_buscar') }}" method="post">
    <div class="form-group">
        Nome: 
        <input type="text" name="nome" class="form-control">
    </div>
    <input type="submit" value="BUSCAR" class="btn btn-info">
    {{ csrf_field() }}
</form>
@if(isset($lista) && count($lista) > 0)
<table class="table table-bordered">
    <tr>
        <th>NOME</th>
        <th>E-MAIL</th>
        <th>SALÁRIO</th>
        <th>CIDADE</th>
        <th>CEP</th>
        <th>ESTADO</th>
        <th>CARGO</th>
        <th>FOTO</th>
        <th>EDITAR</th>
        <th>EXCLUIR</th>
    </tr>
    @foreach($lista as $f)
    <tr>
        <td>{{ $f->nome }}</td>
        <td>{{ $f->email }}</td>
        <td>{{ $f->salario }}</td>
        <td>{{ $f->cidade }}</td>
        <td>{{ $f->cep }}</td>
        <td>{{ $f->estado }}</td>
        <td>{{ $f->nomecargo }}</td>
        <td><img src="{{asset('fotos/'.$f->foto)}}" height="50"></td>
        <td>
            <a href="{{ route('funcionario_detalhes', 
                        ['id' => $f->idfuncionario]) }}" class="btn btn-warning">
                <span class="fa fa-pencil-square-o"></span>
            </a>
        </td>
        
        <td>
            <a href="{{ route('funcionario_excluir', 
                        ['id' => $f->idfuncionario]) }}" class="btn btn-danger"
                onclick="return confirm('Deseja excluir este funcionario?')">
                <span class="fa fa-times"></span>
            </a>
        </td>
    </tr>
    @endforeach
</table>
@endif
@endsection
