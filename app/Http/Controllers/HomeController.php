<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Excel;
use DB;
use Carbon\Carbon;
use Datatables;
use Session;

$_SESSION['sistema'] = 'Carro_Eletrico';
$_SESSION['sub_sistema'] = '';
class HomeController extends Controller
{
    public function home()
    {
    	$_SESSION['sistema'] = '';
    	return view('home/home');
    }

    public function importar_arquivo()
    {
    	$_SESSION['sub_sistema'] = 'Sub_Menu';

    	$veiculos = DB::table('veiculos')
    		->orderBy('desc_veiculo','asc')
    		->get();
    	
    	return view('home/importar_arquivo')
    		->with('veiculos', $veiculos);
    }

    public function import_arquivo()
    {
    	$_SESSION['sub_sistema'] = 'Sub_Menu';
    	ini_set('max_execution_time', 10000); 

    	$excel = Input::file('arquivo');
    	$input = Request::all();

    	DB::table('testes')
    		->insert([
    			'cod_veiculo' => $input['cod_veiculo'],
    			'dh_importacao' => Carbon::now('America/Sao_paulo'),
    			'dh_teste' => $input['dh_teste'],
    			'observacao_test' => $input['observacao_teste']
    		]);

    	$id_teste = DB::getPDO()->LastInsertId();

    	Excel::load($excel, function($reader) use($id_teste) {

		    // Getting all results
		    $cabecalho = $reader->first()->keys()->toArray();
		   	
		   	$array_cabecalho = array();
			
		   	$results = $reader->all();

		   	foreach ($cabecalho as $key => $cab)
		   	{
		   		if($cab <> 'time')
		   		{

			   		$verif = DB::table('cabecalhos')
			   			->where('local_sensor', $cab)
			   			->first();

			   		if(!$verif)
			   		{
			   			DB::table('cabecalhos')
			   				->insert([
			   					'local_sensor' => $cab
			   				]);
			   		}

			   		$id_cabecalho = DB::table('cabecalhos')
			   			->where('local_sensor', $cab)
			   			->first();

			   		foreach ($results as $key => $val)
			   		{
			   			
			   			if($val->$cab == null)
			   			{
			   				$dados_coluna = '00.00';
			   			}else{
			   				$dados_coluna = $val->$cab;
			   			}
			   			// echo $val->$cab;
			   			DB::table('temp_coletadas')
			   				->insert([
			   					'dh_coleta' => $val->time,
			   					'cod_teste' => $id_teste,
			   					'cod_sensor' => $id_cabecalho->cod_sensor,
			   					'temp_sensor' => $dados_coluna
			   				]);
			   		}
			   	}
		   	}

		   	echo "<script>alert('Dados inseridos com sucesso.') </script>";
		   	echo "<script> window.history.back(); </script>";

		});
    }

    public function veiculo()
    {

    	$dados = DB::table('veiculos')
    		->get();

    	return view('home/veiculos')
    		->with('dados', $dados);
    }

    public function adiciona_veiculo()
    {

    	return view('home/adiciona_veiculo');
    }

    public function add_veiculo()
    {
    	$input = Request::all();

    	DB::table('veiculos')
    		->insert([
    			'desc_veiculo' => $input['desc_veiculo']
    		]);

    	return redirect('/veiculo')
    		->with('success', 'Dados inseridos com sucesso.');
    }

    public function editar_veiculo($id)
    {
    	$dados = DB::table('veiculos')
    		->where('cod_veiculo', $id)
    		->first();

    	return view('home/editar_veiculo')
    		->with('dados', $dados);
    }

    public function att_veiculo($id)
    {

    	$input = Request::all();

    	DB::table('veiculos')
    		->where('cod_veiculo', $id)
    		->update([
    			'desc_veiculo' => $input['desc_veiculo']
    		]);

    	return redirect('/veiculo')
    		->with('success', 'Dados atualizados com sucesso.');
    }

    public function relatorios()
    {

    	$veiculos = DB::table('veiculos')
    		->orderBy('desc_veiculo','asc')
    		->get();

    	$cabecalhos = DB::table('cabecalhos')
    		->orderBy('local_sensor','asc')
    		->get();

    	return view('home/relatorios')
    		->with('cabecalhos', $cabecalhos)
    		->with('veiculos', $veiculos);
    }

    public function dados_relatorio()
    {
    	$input = Request::all();

    	$data_1 = $input['data_1'].':00';
    	$data_2 = $input['data_2'].':59';

    	$cabecalho = DB::table('cabecalhos')
    		->whereIn('cod_sensor', $input['cabecalho'])
    		->orderBy('local_sensor','asc')
    		->get();

    	$dados_seg = DB::table('testes as a')
    		->join('temp_coletadas as b','a.cod_teste','=','b.cod_teste')
    		->join('cabecalhos as c','b.cod_sensor','=','c.cod_sensor')
    		->select('a.cod_veiculo','b.*','c.local_sensor')
    		->where('a.cod_veiculo', $input['cod_veiculo'])
    		->whereBetween('b.dh_coleta',[$data_1, $data_2])
    		->whereIn('b.cod_sensor', $input['cabecalho'])
    		->orderBy('dh_coleta','asc')
    		->get();


    	$dh_coleta_min = DB::table('testes as a')
    		->join('temp_coletadas as b','a.cod_teste','=','b.cod_teste')
    		->select('b.dh_coleta')
    		->where('a.cod_veiculo', $input['cod_veiculo'])
    		->whereBetween('b.dh_coleta',[$data_1, $data_2])
    		->whereIn('b.cod_sensor', $input['cabecalho'])
    		->orderBy('dh_coleta','asc')
    		->groupBy(db::raw('year(b.dh_coleta),month(b.dh_coleta),day(b.dh_coleta),hour(b.dh_coleta),minute(b.dh_coleta)'))
    		->get();

    	$dados_min = DB::table('testes as a')
    		->join('temp_coletadas as b','a.cod_teste','=','b.cod_teste')
    		->select('a.cod_veiculo','b.cod_sensor','b.dh_coleta',db::raw('avg(b.temp_sensor) as Media'))
    		->where('a.cod_veiculo', $input['cod_veiculo'])
    		->whereBetween('b.dh_coleta',[$data_1, $data_2])
    		->whereIn('b.cod_sensor', $input['cabecalho'])
    		->orderBy('dh_coleta','asc')
    		->groupBy(db::raw('b.cod_sensor, year(b.dh_coleta),month(b.dh_coleta),day(b.dh_coleta),hour(b.dh_coleta),minute(b.dh_coleta)'))
    		->get();

    	

    	return view('home/dados_relatorio')
    		->with('cabecalho', $cabecalho)
    		->with('dh_coleta_min', $dh_coleta_min)
    		->with('dados_min', $dados_min)
    		->with('dados_seg', $dados_seg);
    }

    public function arquivos_importados()
    {
    	$_SESSION['sub_sistema'] = 'Sub_Menu';

    	$dados = DB::table('testes as a')
    		->join('veiculos as b','a.cod_veiculo','=','b.cod_veiculo')
    		->select('a.cod_teste','a.observacao_test','a.dh_importacao','a.dh_teste','b.desc_veiculo')
    		->get();

    	return view('home/arquivos_importados')
    		->with('dados', $dados);
    }

    public function visualizar_dados_teste($id)
    {
    	$_SESSION['sub_sistema'] = 'Sub_Menu';
    	Session::put('id_teste', $id);
    	
    	$sensores = DB::table('temp_coletadas as a')
    		->join('cabecalhos as b','a.cod_sensor','=','b.cod_sensor')
    		->select('b.local_sensor')
    		->where('a.cod_teste', $id)
    		->groupBy('a.cod_sensor')
    		->orderBy('b.local_sensor', 'asc')
    		->get();

    	return view('home/visualizar_dados_teste')
    		->with('sensores', $sensores);
    }

    public function getPosts()
    {
    	$id_teste = Session::get('id_teste');

    	$dados = DB::table('temp_coletadas as a')
    		->join('cabecalhos as b','a.cod_sensor','=','b.cod_sensor')
    		->select('a.id as Id','a.dh_coleta as Coleta','b.local_sensor as Sensor','a.temp_sensor as Temp_sensor')
    		->where('a.cod_teste', $id_teste);

    	 return Datatables::of($dados)
    	 	->make(true);
    }

    public function deletar_item_arquivo($id)
    {

    	DB::table('temp_coletadas')
    		->where('id', $id)
    		->delete();

    	return back()
    		->with('success', 'Dados excluidos com sucesso.');
    }

    public function deletar_dados_teste($id)
    {

    	DB::table('temp_coletadas')
    		->where('cod_teste', $id)
    		->delete();

    	DB::table('testes')
    		->where('cod_teste', $id)
    		->delete();

    	return back()->with('success', 'Dados excluidos com sucesso.');

    }

    public function deletar_veiculo($id)
    {
    	$teste_id = DB::table('testes')
    		->where('cod_veiculo', $id)
    		->get();

    	$array_id_teste = array();

    	foreach ($teste_id as $key => $val)
    	{
    		$array_id_teste[] = $val->cod_teste;
    	}


    	DB::table('temp_coletadas')
    		->whereIn('cod_teste', $array_id_teste)
    		->delete();

    	DB::table('testes')
    		->where('cod_veiculo', $id)
    		->delete();

    	DB::table('veiculos')
    		->where('cod_veiculo', $id)
    		->delete();

    	return back()->with('success', 'Dados excluidos com sucesso.');
    }

}