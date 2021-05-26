<?php

namespace Source\Model;

class EnderecoModel
{
    private $id;
    private $cliente;
    private $numero;
    private $complemento;
    private $cidade;
    private $estado;
    private $pais;
    private $cep;
    
    public function getId() : ?int{
        return $this->id;
    }

    public function getCliente() : int{
        return $this->cliente;
    }

    public function getNumero() : string{
        return $this->numero;
    }

    public function getComplemento() : string{
        return $this->complemento;
    }

    public function getCidade() : string{
        return $this->cidade;
    }

    public function getEstado() : string{
        return $this->estado;
    }

    public function getPais() : string{
        return $this->pais;
    }

    public function getCep() : string{
        return $this->cep;
    }

    public function setId(int $id){
        $this->id = $id;
    }

    public function setCliente(int $cliente){
        $this->cliente = $cliente;
    }

    public function setNumero(string $numero){
        $this->numero = $numero;
    }

    public function setComplemento(string $complemento){
        $this->complemento = $complemento;
    }

    public function setCidade(string $cidade){
        $this->cidade = $cidade;
    }

    public function setEstado(string $estado){
        $this->estado = $estado;
    }

    public function setPais(string $pais){
        $this->pais = $pais;
    }

    public function setCep(string $cep){
        $this->cep = $cep;
    }
}
