<?php

namespace Source\Model;

class ClienteModel
{
    private $id;
    private $nome;
    private $email;
    private $telefone;
    private $cpf;
    private $cnpj;
    private $razaoSocial;
    private $fisicaJuridica;
    private $endereco;

    function __construct(){
        $this->endereco = new EnderecoModel();
    }

    public function getId() : ?int{
        return $this->id;
    }

    public function getNome() : string{
        return $this->nome;
    }

    public function getEmail() : string{
        return $this->email;
    }

    public function getTelefone() : string{
        return $this->telefone;
    }

    public function getCpf() : ?string{
        return $this->cpf;
    }

    public function getCnpj() :?string{
        return $this->cnpj;
    }

    public function getRazaoSocial() : string{
        return $this->razaoSocial;
    }

    public function getFisicaJuridica() : int{
        return $this->fisicaJuridica;
    }

    public function getEndereco() : EnderecoModel{
        return $this->endereco;
    }

    public function setId(int $id){
        $this->id = $id;
    }

    public function setNome(string $nome){
        $this->nome = $nome;
    }

    public function setEmail(string $email){
        $this->email = $email;
    }

    public function setTelefone(string $telefone){
        $this->telefone = $telefone;
    }

    public function setRazaoSocial(string $razaoSocial){
        $this->razaoSocial = $razaoSocial;
    }

    public function setFisicaJuridica(int $fisicaJuridica){
        $this->fisicaJuridica = $fisicaJuridica;
    }

    public function setCpf(?string $cpf){
         $this->cpf = $cpf;
    }

    public function setCnpj(?string $cnpj){
         $this->cnpj = $cnpj;
    }

    public function setEndereco($endereco){
        $this->endereco = $endereco;
   }
}