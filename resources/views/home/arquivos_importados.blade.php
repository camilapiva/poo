@extends("layout.principal")
@section("conteudo")
<?php  
	use Carbon\Carbon;
?>
<section class="container-fluid">
    <div class="container-fluid">
        <h2 class="pull-left"> Arquivos Importados </h2>
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
    
    <div class="container-fluid">
    	<table id="datatable" class="table table-bordered">
    		<thead>
    			<tr>
    				<th class="text-center"> Veículo Teste </th>
    				<th class="text-center"> Data | Hora Importação </th>
    				<th class="text-center"> Data Teste </th>
    				<th class="text-center"> Descrição Teste </th>
    				<th class="text-center" width="15%"> Visualizar Dados </th>
    				<th class="text-center" width="15%"> Excluir Dados </th>
    			</tr>
    		</thead>
    		<tbody>
    			@foreach($dados as $val)
    			<tr>
    				<td> {{ $val->desc_veiculo }} </td>
    				<td> {{ $val->dh_importacao }} </td>
    				<td> {{ $val->dh_teste }} </td>
    				<td> {{ $val->observacao_test }} </td>
    				<td> <a class='btn-primary btn btn-xs' href="{{ url('/visualizar-dados-teste', [$val->cod_teste]) }}"> Visualizar </a> </td>
    				<td> <a class='btn-danger btn btn-xs' href="{{ url('/deletar-dados-teste', [$val->cod_teste]) }}"> Deletar </a> </td>
    			</tr>
    			@endforeach
    		</tbody>
    		<tfoot>
    			<tr>
    				<th class="text-center"> Veículo Teste </th>
    				<th class="text-center"> Data | Hora Importação </th>
    				<th class="text-center"> Data Teste </th>
    				<th class="text-center"> Descrição Teste </th>
    				<th class="text-center"> Visualizar Dados </th>
    				<th class="text-center"> Excluir Dados </th>
    			</tr>
    		</tfoot>
    	</table>
    </div>
</section>

<!--  DATATABLES  -->
<style type="text/css">
  .dataTables_length{
    
    width: 10%;
  }
  .dataTables_info{
    width: 10%;
  }
</style>

<link rel="stylesheet" type="text/css" href="/datatable/datatable.css">
<script src="/datatable/datatable.js"></script>

<script>
    $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#datatable tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" style="width: 100%;" class="form-control" placeholder="Pesquisar '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#datatable').DataTable({
    "oLanguage":{
    "sEmptyTable": "Nenhum registro encontrado",
    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
    "sInfoPostFix": "",
    "sInfoThousands": ".",
    "sLengthMenu": "_MENU_ resultados por página",
    "sLoadingRecords": "Carregando...",
    "sProcessing": "Processando...",
    "sZeroRecords": "Nenhum registro encontrado",
    "sSearch": "Pesquisar",
    "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
    },
    "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
    }}});
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
} );
</script>

@stop