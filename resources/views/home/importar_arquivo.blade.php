@extends("layout.principal")
@section("conteudo")
<section class="container-fluid">
    <div class="container-fluid">
        <h2 class="pull-left"> Importar Arquivo </h2>
    </div>

    <hr>

    @if (session('error'))
    <div class="alert alert-danger" id="alerta">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>{{ session('error') }} </strong>
    </div>
    @endif
    @if (session('success'))
    <div class="alert alert-success" id="alerta">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>{{ session('success') }} </strong>
    </div>
    @endif
    
    <form method="post" enctype="multipart/form-data" action="{{ url('/import_arquivo') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        
        <div class="clearfix form-group">
        	<div class="col-md-3">
        		<label class="pull-left" for="cod_veiculo"> Veículos </label>
        		<select class="form-control" required="" id="cod_veiculo" name="cod_veiculo">
        			<option value=""> Selecione </option>
        		@foreach($veiculos as $val)
        			<option value="{{ $val->cod_veiculo }}"> {{ $val->desc_veiculo }} </option>
        		@endforeach
        		</select>
        	</div>
        </div>

        <div class="clearfix form-group">
        	<div class="col-md-3">
        		<label class="pull-left" for="dh_teste"> Data Teste </label>
        		<input type="date" required="" class="form-control date-time" id="dh_teste" name="dh_teste">
        	</div>
        </div>

        <div class="clearfix form-group">
            <div class="col-md-4">
                <label class="pull-left" for="arquivo"> Arquivo </label>
                <input type="file" class="form-control" required="" id="arquivo" name="arquivo">
                <p class="pull-left"> *Enviar um arquivo .xlsx. </p>
            </div>
        </div>
      	
        <div class="clearfix form-group">
        	<div class="col-md-4">
        		<label class="pull-left" for="observacao_teste"> Observação Teste </label>
        		<textarea class="form-control" id="observacao_teste" name="observacao_teste" required="" maxlength="100"></textarea>
        	</div>
        </div>

        <hr>

        <div class="clearfix">
            <div class="col-md-1">
                <button class="btn btn-primary">
                    Salvar Dados
                </button>
            </div>
        </div>

    </form>
</section>
@stop