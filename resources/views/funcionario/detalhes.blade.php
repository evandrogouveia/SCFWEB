@extends("layout")
@section("conteudo")
<h3 class="page-header">DETALHES DO FUNCIONÁRIO</h3>

<form method="post">
    <div class="row">
        <div class="col-xs-12 form-group">
            Nome: 
            <input type="text" name="nome" class="form-control" 
                   value="{{ $f->nome }}">
        </div>
        
        <div class="col-xs-6 form-group">
            E-mail: 
            <input type="email" name="email" class="form-control"
                   value="{{ $f->email }}">
        </div>
        <div class="col-xs-6 form-group">
            Salário: 
            <input type="text" name="salario" class="form-control"
                   value="{{ $f->salario }}">
        </div>
        <div class="col-xs-6 form-group">
            Cargo:
            <select name="idcargo" class="form-control">
               @foreach($lista as $c)
               <option value="{{$c->id}}">
                   {{$c->nomecargo}}
               </option>
               @endforeach
            </select>
        </div>
        
        <div class="col-xs-4 form-group">
            Cep: 
            <input type="text" name="cep" class="form-control"
                   value="{{ $f->endereco->cep }}">
        </div>
        
        <div class="col-xs-4 form-group">
            Cidade: 
            <input type="text" name="cidade" class="form-control"
                   value="{{ $f->endereco->cidade }}">
        </div>
        <div class="col-xs-4 form-group">
            Estado: 
            <input type="text" name="estado" class="form-control"
                   value="{{ $f->endereco->estado }}" >
        </div>
    </div>
    <input type="submit" value="SALVAR" class="btn btn-primary">
    {{ csrf_field() }}
</form>

@endsection
