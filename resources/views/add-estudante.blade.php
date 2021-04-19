@extends('layout.app')
@section('content')

<div class="container">
<h2 class="text-center">Novo Estudante</h2>
<form method="post" action="/salvar-estudante">
  <div class="row">
       <div class="col">
           <label for="nome">Nome *:</label>
           <input type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{old('nome')}}" required>
                               @error('nome')
                                  <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                  </span>
                               @enderror
        </div>

        <div class="col">
            <label for="nome_meio">Segundo Nome *:</label>
            <input type="text" class="form-control" name="nome_meio" value="{{old('nome_meio')}}">
        </div>
    
        <div class="col">
            <label for="sobrenome">Sobrenome *:</label>
            <input type="text" class="form-control @error('sobrenome') is-invalid @enderror" name="sobrenome" value="{{old('sobrenome')}}" required>
                                @error('sobrenome')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
        </div>
    </div>              

    <div class="row mt-1">
        <div class="col">
            <label for="data_nascimento">Data de Nascimento *:</label>
            <input type="date" class="form-control @error('data_nascimento') is-invalid @enderror" name="data_nascimento" value="{{old('data_nascimento')}}" required>
                                @error('data_nascimento')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
        </div>


    <div class="col">
    <label for="qualificacao">Qualificação *:</label>
    <input type="text" class="form-control @error('qualificacao') is-invalid @enderror" name="qualificacao" value="{{old('qualificacao')}}" required>
                        @error('qualificacao')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
    </div>

    <div class="col">
        <label for="local_nascimento">Local de Nascimento *:</label>
        <input type="text" class="form-control" name="local_nascimento" value="{{old('local_nascimento')}}">
    </div>

    <div class="row mt-1">
        <div class="col">
            <label for="imagem_perfil">Selecione uma imagem pra seu perfil:</label>
                <div class="custom-file mb-3">
                    <input type="file" accept="image/*" class="custom-file-input" name="imagem_perfil" id="imagem_perfil">
                    <label class="custom-file-label" for="customFile1">Carregar foto do perfil</label>
                </div>

                <label for="email">Email *:</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" required>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                <label for="contato">Celular *:</label>
                <input type="number" class="form-control @error('contato') is-invalid @enderror" name="contato" value="{{old('contato')}}" required>
                                    @error('contato')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
        </div>

        <div class="col text-center">
            <h5 class="text-danger"><small><b> {{ $errors->first('imagem_perfil') }} </b></small></h5>
            <span id="uploaded_pp"></span>
        </div>
    </div>

    <button class="btn btn-primary btn-sm float float-right" type="submit">Novo Estudante</button>
@csrf
</form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>

    $(document).ready(function(){
        $(document).on('change', '#imagem_perfil', function(){
            var name = document.getElementById("imagem_perfil").files[0].name;
            var form_data = new FormData();
            var ext = name.split('.').pop().toLowerCase();

            if(jQuery.inArray(ext, ['png','jpg','jpeg']) == -1)  {
                alert("Formato de arquivo inválido(Apenas imagens são permitidas)");
            }
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("imagem_perfil").files[0]);
            var f = document.getElementById("imagem_perfil").files[0];
            var fsize = f.size||f.fileSize;

            if (fsize > 2000000) {
                alert("O tamanho do arquivo é muito grande(O tamanho permitido é no máximo 2 MB)");
            } 
            else 
            {
                event.preventDefault();

                form_data.append("file", document.getElementById('imagem_perfil').files[0]);

                $.ajax({
                    url:"/upload_pp",
                    method:"POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function(){
                        $('#uploaded_pp').html("<label class='text-dark'>Upload da foto do perfil...(Fill other fields)</label>");
                    },

                    success:function(data){
                        $('#uploaded_pp').html(data);
                    },
                    resetForm: true
                });
            }
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>
@endsection
