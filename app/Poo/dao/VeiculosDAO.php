<?php

namespace App\Http\Controllers;
namespace Poo;

use Carbon\Carbon as Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

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

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
}

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

        require_once("Veiculos.php");

        $veiculos = new Veiculos();
        $veiculos->setCod_veiculo($_POST['cod_veiculo']);

        $desc_veiculo = $_POST['desc_veiculo'];
        $cod_veiculo = $_POST['cod_veiculo'];

    	DB::table('veiculos')
    		->insert([
    			'desc_veiculo' => $input['desc_veiculo']
    		]);

    	return redirect('/veiculo')
    		->with('success', 'Dados inseridos com sucesso.');
    }

        public function editar_veiculo($id)
    {
        require_once("Veiculos.php");

        $veiculos = new Veiculos();
        $veiculos->setCod_veiculo($_POST['cod_veiculo']);

        $desc_veiculo = $_POST['desc_veiculo'];
        $cod_veiculo = $_POST['cod_veiculo'];


    	$dados = DB::table('veiculos')
    		->where('cod_veiculo', $id)
    		->first();

    	return view('home/editar_veiculo')
    		->with('dados', $dados);
    }

    public function att_veiculo($id)
    {

        require_once("Veiculos.php");

        $veiculos = new Veiculos();
        $veiculos->setCod_veiculo($_POST['cod_veiculo']);

        $desc_veiculo = $_POST['desc_veiculo'];
        $cod_veiculo = $_POST['cod_veiculo'];

    	$input = Request::all();

    	DB::table('veiculos')
    		->where('cod_veiculo', $id)
    		->update([
    			'desc_veiculo' => $input['desc_veiculo']
    		]);

    	return redirect('/veiculo')
    		->with('success', 'Dados atualizados com sucesso.');
    }

        public function deletar_veiculo($id)
    {

        require_once("Veiculos.php");

        $veiculos = new Veiculos();
        $veiculos->setCod_veiculo($_POST['cod_veiculo']);

        $desc_veiculo = $_POST['desc_veiculo'];
        $cod_veiculo = $_POST['cod_veiculo'];        

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