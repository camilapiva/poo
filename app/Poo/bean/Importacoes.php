<?php

class Importacoes{
	private $dh_coleta;
	private $cod_teste;
	private $cod_sensor;
	private $temp_sensor;
	private $id_sensor;
}

function Importacoes(){
	$this->dh_coleta = $dh_coleta;
	$this->cod_teste = $cod_teste;
	$this->cod_sensor = $cod_sensor;
	$this->temp_sensor = $temp_sensor;
	$this->$id_sensor = $id_sensor;
}

public function setDh_coleta($dh_coleta){
	$this->dh_coleta = $dh_coleta;
}

public function getDh_coleta(){
	$this->dh_coleta = $dh_coleta;
}

public function setCod_teste($cod_teste){
	$this->cod_teste = $cod_teste;
}

public function getCod_teste(){
	$this->cod_teste = $cod_teste;
}

public function setCod_sensor($cod_sensor){
	$this->cod_sensor = $cod_sensor;
}

public function getCod_sensor(){
	$this->cod_sensor = $cod_sensor;
}

public function setTemp_sensor($temp_sensor){
	$this->temp_sensor = $temp_sensor;
}

public function getTemp_sensor(){
	$this->temp_sensor = $temp_sensor;
}

public function setId_sensor($id_sensor){
	$this->id_sensor = $id_sensor;
}

public function getId_sensor(){
	$this->id_sensor = $id_sensor;
}
