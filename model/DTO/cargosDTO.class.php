<?php 
class CargosDTO {

    private $codCargos; 
    function setCodCargos($valor){
        $this->codCargos = $valor;
    }
    function getCodCargos(){
       return $this->codCargos;
    }

    private $descricaoCargos;
    function setDescricaoCargos($valor){
        $this->descricaoCargos = $valor;
    }
    function getDescricaoCargos(){
       return $this->descricaoCargos;
    }

}
?>