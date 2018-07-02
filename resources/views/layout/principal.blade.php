<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=0">

        <meta name="description" content="">
        <meta name="author" content="">
        <!-- <link rel="icon" href="/imagens/logo.png"> -->

        <title> {{ $title or 'Carro Elétrico' }} </title>

        <link href="{{ url('/css/tela.css') }}" rel="stylesheet">
        
        <link href="{{ url('/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- <link href="{{ url('/css/bootstrap-theme.css') }}" rel="stylesheet"> -->

        <link href="{{ url('/css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">

        <link href="{{ url('/css/dashboard.css') }}" rel="stylesheet">

        <link rel="stylesheet" href="{{ url('/css/code_jquery.css') }}">

        <link rel="stylesheet" href="{{ url('/css/code_jquery2.css') }}">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        <!-- jquery -->
        <script src="{{ url('/js/ajax_googleapi.js') }}"></script>

        <script src="{{ url('/js/filtragem_grafico.js') }}"></script>
        <!-- cdn for modernizr, if you haven't included it already -->
        <script src="{{ url('/js/cdn_js.js') }}"></script>
        <!-- polyfiller file to detect and load polyfills -->

        <!-- DATAS MOZILA E IE -->
        <script src="/js/webshim/js-webshim/minified/polyfiller.js"></script>
        <script>
        webshims.setOptions('waitReady', false);
        webshims.setOptions('forms-ext', {types: 'date'});
        webshims.polyfill('forms forms-ext');
        webshim.activeLang('pt-br');
        </script>
        <!-- FIM DATAS MOZILA E IE -->
        
        <script src="{{ url('/js/ie-emulation-modes-warning.js') }}"></script>
        
        <script type="text/javascript" src="{{ url('/js/max.js') }}"></script>

        <script src="{{ url('/js/mult-select.js') }}"></script>

        <script src="{{ url('/js/mascara-cpf-cnpj-telefone.js') }}" type="text/javascript"></script>

    </head>

    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top" style="background: #E8E8E8;">
            <div class="container-fluid">
                <!-- <div class="navbar-header"> -->
                    <div class="form-group">
                        <a class="pull-left" href="/"> <img src="{{ url('/camila/satc1.png') }}"> </a>
                        <a class="pull-right" href="/"> <img src="{{ url('/camila/eng_comp1.png') }}"> </a>
                    </div>
                <!-- </div> -->
            </div>
        </nav>

        <div class="container-fluid" >
            <div  class="row" >
                <div style="width: 19%; background: #003300; " class="col-sm-2 sidebar container" >
                    <ul class="nav nav-sidebar" >
                        <div style="margin-left: 0%; margin-top: 5%;" class="container navbar-nav" >
                            <div class="row" >
                                <div class="col-sm-3 col-md-3" style="width: 22%;">
                                    <div  class="panel-group" id="accordion" >
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseUsuarios"><span class="glyphicon glyphicon-folder-close">
                                                    </span> Carro Elétrico </a>
                                                </h4>
                                            </div>
                                            <div id="collapseUsuarios" class="panel-collapse collapse <?php if(empty($_SESSION['sistema'])){}else{if($_SESSION['sistema'] == 'Carro_Eletrico') echo 'in';} ?>">
                                                <div class="panel-body">
                                                    <table class="table">
                                                        <tr>
                                                            <td>
                                                                <a class="panel-title" style="font-size: 14px;" href="{{ url('/veiculo') }}"> Veículo </a>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <a class="panel-title" style="font-size: 14px;" href="{{ url('/relatorios') }}"> Relatórios </a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <!-- INICIO SUB CARRO ELÉTRICO -->
                                                <div class="panel panel-default">
                                                    
                                                    <div class="panel-heading" style="background: white;">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" data-parent="#accordionsub" href="#collapseSubIntranet"><span class="glyphicon glyphicon-folder-close">
                                                            </span>Importação</a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseSubIntranet" class="panel-collapse collapse <?php if(empty($_SESSION['sub_sistema'])){}else{if($_SESSION['sub_sistema'] == 'Sub_Menu') echo 'in';} ?>">
                                                        <div class="panel-body">
                                                            <table class="table">
                                                                <tr>
                                                                    <td>
                                                                        <a class="panel-title" style="font-size: 14px;" href="{{ url('/importar-arquivo') }}"> Importar Arquivo </a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <a class="panel-title" style="font-size: 14px;" href="{{ url('/arquivos-importados') }}"> Arquivos Importados </a>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- FIM SUB CARRO ELÉTRICO -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </ul>
                    <ul class="nav nav-sidebar"></ul>
                    <ul class="nav nav-sidebar"></ul>
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          
        			<div class="row placeholders">  
        				@yield('conteudo')
        			</div>
                </div>
            </div>
        </div>
    </body>
</html>

