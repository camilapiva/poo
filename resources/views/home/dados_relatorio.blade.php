@extends("layout.principal")
@section("conteudo")

<script src="{{ url('/hightcharts/hightcharts.js') }}"></script>
<script src="{{ url('/hightcharts/series_label.js') }}"></script>
<script src="{{ url('/hightcharts/exporting.js') }}"></script>
<script src="{{ url('/hightcharts/exporting_data.js') }}"></script>

<section class="container-fluid">
	<div class="container-fluid">
		<h2 class="pull-left"> Relatórios - Gráficos </h2>		
	</div>

	<hr>

	<div id="container_seg" style="min-width: 310px; height: 400px; margin: 0 auto"></div>	

	<div id="container_min" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

	<hr>

	<div class="container-fluid">
		<h3 class="pull-left"> Analítico Dados </h3>
	</div>

	<div class="container-fluid">
		<table id="datatable" class="table table-bordered">
			<thead>
				<tr>
					<th class="text-center"> Código Teste </th>
					<th class="text-center"> Data Hora Coleta </th>
					<th class="text-center"> Sensor </th>
					<th class="text-center"> Temperatura </th>
				</tr>
			</thead>
			<tbody>
				@foreach($dados_seg as $val)
				<tr>
					<td>{{ $val->cod_teste }}</td>
					<td>{{ $val->dh_coleta }}</td>
					<td>{{ $val->local_sensor }}</td>
					<td>{{ $val->temp_sensor }}</td>
				</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th class="text-center"> Código Teste </th>
					<th class="text-center"> Data Hora Coleta </th>
					<th class="text-center"> Sensor </th>
					<th class="text-center"> Temperatura </th>
				</tr>
			</tfoot>
		</table>
	</div>
</section>


<script>
	
Highcharts.chart('container_seg', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Gráfico de Temperatura (Segundos)'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: 
        	[
        		<?php
        		foreach($dados_seg as $val)
        		{
        		?>
        			'<?php echo $val->dh_coleta; ?>',
        		<?php
        		}
        		?>
        	]
    },
    yAxis: {
        title: {
            text: 'Temperature'
        },
        labels: {
            formatter: function () {
                return this.value + '°';
            }
        }
    },
    tooltip: {
        crosshairs: true,
        shared: true
    },
    plotOptions: {
        spline: {
            marker: {
                radius: 0,
                lineColor: '#666666',
                lineWidth: 1
            }
        }
    },
    series: 
	[
		<?php 
		foreach($cabecalho as $cab)
		{
		?>
		{
	        name: '<?php echo $cab->local_sensor; ?>',
	        marker: 
	        {
	            symbol: 'square'
	        },
	        
	        data: 
	        	[
	        		<?php 
	        		foreach ($dados_seg as $key => $val)
	        		{
	        			if($val->cod_sensor == $cab->cod_sensor)
	        			{
	        		?>
	        			<?php echo $val->temp_sensor; ?>,
	        		<?php
	        			} 
	        		}
	        		?>,
	        	]
	        
    	},
    	<?php 
    	}
    	?>
    ]
});



</script>



<script>
	
Highcharts.chart('container_min', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Gráfico de Temperatura (Minutos)'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: 
        	[
        		<?php
        		foreach($dh_coleta_min as $val)
        		{
        		?>
        			'<?php echo $val->dh_coleta; ?>',
        		<?php
        		}
        		?>
        	]
    },
    yAxis: {
        title: {
            text: 'Temperature'
        },
        labels: {
            formatter: function () {
                return this.value + '°';
            }
        }
    },
    tooltip: {
        crosshairs: true,
        shared: true
    },
    plotOptions: {
        spline: {
            marker: {
                radius: 0,
                lineColor: '#666666',
                lineWidth: 1
            }
        }
    },
    series: 
	[
		<?php 
		foreach($cabecalho as $cab)
		{
		?>
		{
	        name: '<?php echo $cab->local_sensor; ?>',
	        marker: 
	        {
	            symbol: 'square'
	        },
	        
	        data: 
	        	[
	        		<?php 
	        		foreach ($dados_min as $key => $val)
	        		{
	        			if($val->cod_sensor == $cab->cod_sensor)
	        			{
	        		?>
	        			<?php echo $val->Media; ?>,
	        		<?php
	        			} 
	        		}
	        		?>,
	        	]
	        
    	},
    	<?php 
    	}
    	?>
    ]
});
</script>

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
 
    //Apply the search
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