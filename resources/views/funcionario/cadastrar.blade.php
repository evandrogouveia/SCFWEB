@extends("layout")
@section("conteudo")
<h3 class="page-header">CADASTRAR NOVO FUNCIONÁRIO</h3>
<div class="container">
<form method="post" enctype="multipart/form-data">
    <div class="row">
        <fieldset>
        <div class="col-xs-2">
            Foto:<br>
            <label for="selecao-arquivo">
            <img id="view-img" src="{{ asset('img/user.png') }}">
            <input id="selecao-arquivo" type="file" name="foto">
            </label>
        </div>
        <div class="col-xs-2 form-group">
            Matrícula:
            <input type="text" name="matricula" class="form-control">
        </div>
        <div class="col-xs-5 form-group">
            Nome:
            <input type="text" name="nome" class="form-control">
        </div>
         <div class="col-xs-2 form-group">
            Tel.:
            <input type="text" name="telefone" class="form-control">
        </div>
        <div class="col-xs-1 form-group">
             Sexo:<br>
             <select type="text"  name="sexo" class="form-control">
                 <option>M</option>
                 <option>F</option>
           </select>
        </div>
        <div class="col-xs-5 form-group">
            E-mail:
            <input type="email" name="email" class="form-control">
        </div>
          
        <div class="col-xs-2 form-group">
            Salário:
            <input type="text" name="salario" class="form-control">
        </div>
        <div class="col-xs-3 form-group">
            Cargo:
            <select name="idcargo" class="form-control">
               @foreach($lista as $c)
               <option value="{{$c->id}}">
                   {{$c->nomecargo}}
               </option>
               @endforeach
            </select>
        </div>
        </fieldset><br>
         
        <div class="col-xs-6 col-xs-offset-2 form-group">
            Endereço:
            <input type="text" name="endereco" class="form-control">
        </div>
        <div class="col-xs-4 form-group">
            Bairro:
            <input type="text" name="bairro" class="form-control">
        </div>
        
        <div class="col-xs-3 col-xs-offset-2 form-group">
            Cep:
            <input type="text" name="cep" class="form-control">
        </div>
        <div class="col-xs-3 form-group">
            Cidade:
            <select type='text'  name="cidade" class="form-control">
                 <option></option> 
                 <option>Rio de Janeiro</option>
                 <option>São Paulo</option>
                 <option>Minas Gerais</option>
                 <option>Espirito Santo</option>
           </select>
        </div>
        <div class="col-xs-2 form-group">
            Estado:
            <select type='text'  name="estado" class="form-control">
                 <option></option> 
                 <option>RJ</option>
                 <option>SP</option>
                 <option>MG</option>
                 <option>ES</option>
           </select>
        </div>  
    </div>
    <input type="submit" value="CADASTRAR" class="btn btn-primary col-xs-offset-2">
    {{csrf_field()}}
</form>
</div>
<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
        <script>
$("#selecao-arquivo").change(function(){
    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#view-img').attr('src', e.target.result);
        };
        reader.readAsDataURL(this.files[0]);
    }
});
</script>
@endsection