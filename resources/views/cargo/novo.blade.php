@extends("layout")
@section("conteudo")
<h4 class="page-header">CARGOS</h4>
<form method="post">
    <div class="form-group">
        Nome do cargo:
        <input type="text" name="nomecargo" 
               class="form-control">
    </div>
    <input type="submit" value="CADASTRAR" 
           class="btn btn-primary">
    {{ csrf_field() }}
</form>
<hr>
@if(isset($lista) && count($lista))
<table class="table table-bordered">
    <tr>
        <th>ID DO CARGO</th>
        <th>NOME DO CARGO</th>
    </tr>
    @foreach($lista as $c)
    <tr>
        <td>{{ $c->id }}</td>
        <td>{{ $c->nomecargo }}</td>
    </tr>
    @endforeach
</table>
@endif
@endsection