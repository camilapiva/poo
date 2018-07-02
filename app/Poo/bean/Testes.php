<?php

class Testes{
	private $id_teste;
	private $cod_veiculo;
	private $dh_importacao;
	private $dh_teste;
	private $observacao_test;
}

function Testes(){
	$this->id_teste = $id_teste;
	$this->cod_veiculo = $cod_veiculo;
	$this->dh_importacao = $dh_importacao;
	$this->dh_teste = $dh_teste;
	$this->observacao_test = $observacao_test;
}

public function setId_teste($id_teste){
	$this->id_teste = $id_teste;
}

public function getId_teste(){
	$this->id_teste = $id_teste;
}

public function setCod_veiculo($cod_veiculo){
	$this->cod_veiculo = $cod_veiculo;
}

public function getCod_veiculo(){
	$this->cod_veiculo = $cod_veiculo;
}

public function setDh_importacao($dh_importacao){
	$this->dh_importacao = $dh_importacao;
}

public function getDh_importacao(){
	$this->dh_importacao = $dh_importacao;
}

public function setDh_teste($dh_teste){
	$this->dh_teste = $dh_teste;
}

public function getDh_teste(){
	$this->dh_teste = $dh_teste;
}

public function setObservacao_test($observacao_test){
	$this->observacao_test = $observacao_test;
}

public function getObservacao_test(){
	$this->observacao_test = $observacao_test;
}