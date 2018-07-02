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

    <div class="clearfix form-group">
        <div class="col-md-3">
            <label class="pull-left"> Sensores Arquivo </label>
            <select class="form-control" multiple="" disabled="">
            @foreach($sensores as $val)
                <option> {{ $val->local_sensor }} </option>
            @endforeach
            </select>
        </div>
    </div>
    
    <div class="container-fluid">
        <table id="datatable" class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center"> Sensor</th>
                    <th class="text-center"> Data | Hora Coleta</th>
                    <th class="text-center"> Temperatura Sensor</th>
                    <th class="text-center" width="10px"> Deletar</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="text-center"> Sensor</th>
                    <th class="text-center"> Data | Hora Coleta</th>
                    <th class="text-center"> Temperatura Sensor</th>
                    <th class="text-center"> </th>
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

<script type="text/javascript">
$(document).ready(function() {

    oTable = $('#datatable').DataTable({

    stateSave: true,
    
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
    }},
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('datatable.getposts') }}", // rota que executa a requisição
        "columns": [
            {data: 'Sensor', name: 'b.local_sensor'},
            {data: 'Coleta', name: 'a.dh_coleta'},
            {data: 'Temp_sensor', name: 'a.temp_sensor'},
            {defaultContent: "<button class='btn-danger btn btn-xs' id='permissao'> Deletar </button>"},
        ]
    });

    var cont = 0;
    $('#datatable tfoot th').each(function()
    {
        var title = $(this).text();
        if(cont == 3 || cont == 4 || cont == 5)
        {

        }else{

            $(this).html( '<input type="text" style="width: 100%;" id="busca_'+cont+'" class="form-control" placeholder="'+title+'" />' );
        }

        cont++;
    });
 
    // DataTable
    var table = $('#datatable').DataTable();
    var state = oTable.state.loaded();

    if(state)
    {
        oTable.columns().eq( 0 ).each( function ( colIdx ) 
        {
            
            var colSearch = state.columns[colIdx].search;

            if(colSearch.search)
            {
                if (colIdx == 0)
                {
                    $('#busca_0').val( colSearch.search);
                }
                if (colIdx == 1)
                {
                    $('#busca_1').val( colSearch.search);
                }
                if (colIdx == 2)
                {
                    $('#busca_2').val( colSearch.search);
                }
                if (colIdx == 3)
                {
                    $('#busca_3').val( colSearch.search);
                }
                if (colIdx == 4)
                {
                    $('#busca_4').val( colSearch.search);
                }
            }
        });
    }

    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $('input', this.footer() ).on('keyup change', function () {
            if (that.search() !== this.value) 
            {
                that.search( this.value ).draw();   
            }
        });
    });

    $('#datatable tbody').on('click', '#permissao', function () {
        var data = oTable.row($(this).parents('tr')).data();
        // console.log(data['Id']);
        window.location = "/deletar-item-arquivo/" + data['Id'];

    });

    // $('#datatable tbody').on('click', '#editar', function () {
    //     var data = oTable.row($(this).parents('tr')).data();
    //     // console.log(data['Id']);
    //     window.location = "/usuarios/editando_usuario/" + data['Id_edit'];

    // });
});
</script>   

@stop