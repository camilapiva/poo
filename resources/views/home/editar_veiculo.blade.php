@extends("layout.principal")
@section("conteudo")
<section class="container-fluid">
    <div class="container-fluid">
        <h2 class="pull-left"> Editar Veículo </h2>
    </div>

    <hr>

    <form method="post" action="{{ url('/att_veiculo', [$dados->cod_veiculo]) }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        
        <div class="clearfix form-group">
            <div class="col-md-4">
                <label class="pull-left" for="desc_veiculo"> Descrição Veículo </label>
                <input type="text" placeholder="Max: 50" value="{{ $dados->desc_veiculo }}" class="form-control" required="" id="desc_veiculo" name="desc_veiculo" maxlength="50">
            </div>
        </div>
      
        <hr>

        <div class="clearfix">
            <div class="col-md-1">
                <button class="btn btn-primary">
                    Salvar Edição
                </button>
            </div>
        </div>

    </form>
</section>
@stop