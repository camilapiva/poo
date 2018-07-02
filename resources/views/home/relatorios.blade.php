@extends("layout.principal")
@section("conteudo")
<section class="container-fluid">
    <div class="container-fluid">
        <h2 class="pull-left"> Relatório </h2>
    </div>

    <hr>

    <form method="get" action="{{ url('/dados-relatorio') }}">
        <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> -->
        
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
                <div class="clearfix">
                    <label class="pull-left" for="cabecalho"> Componentes </label>
                </div>
                <div class="pull-left">
                    <select class="form-control" id="cabecalho" name="cabecalho[]" multiple="" required="">
                        @foreach($cabecalhos as $val)
                        <option value="{{ $val->cod_sensor }}"> {{ $val->local_sensor }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="clearfix form-group">
        	<div class="col-md-3">
                <label class="pull-left" for="data_1"> Data Inicio </label>
                <input type="datetime-local" required="" class="form-control date-time" id="data_1" name="data_1">
            </div>

            <div class="col-md-3">
        		<label class="pull-left" for="data_2"> Data Fim </label>
        		<input type="datetime-local" required="" class="form-control date-time" id="data_2" name="data_2">
        	</div>
        </div>

        <hr>

        <div class="clearfix">
            <div class="col-md-1">
                <button class="btn btn-primary">
                    Gerar Relatório
                </button>
            </div>
        </div>

    </form>
</section>
@stop