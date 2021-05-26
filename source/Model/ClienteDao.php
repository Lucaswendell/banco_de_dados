<?php

namespace Source\Model;

use Error;
use Exception;
use PDO;
use Source\Controller\Connection;
use Source\Model\ClienteModel;
use Source\Model\EnderecoDao;

class ClienteDao
{  

    public function save(ClienteModel $c)
    {
        try {

            $endereco = new EnderecoDao();

            $con = Connection::getConnection();
            if ($con == null) throw new Error("Conexão falhou.");

            $con->beginTransaction();

            if (!$c->getId()) {
                $sql = "INSERT INTO Cliente(nome, email, telefone, cpf, cnpj, fisica_juridica, razao_social) 
                        VALUES (:nome, :email, :telefone, :cpf, :cnpj, :fisica_juridica, :razao_social);";

                $stmt = $con->prepare($sql);
                $stmt->bindValue(":fisica_juridica", $c->getFisicaJuridica());
                $stmt->bindValue(":razao_social", $c->getRazaoSocial());
                $stmt->bindValue(":email", $c->getEmail());
                $stmt->bindValue(":nome", $c->getNome());
                $stmt->bindValue(":telefone", $c->getTelefone());

                if($c->getFisicaJuridica()){
                    $stmt->bindValue("cpf", $c->getCpf());
                    $stmt->bindValue("cnpj", null);
                }else{
                    $stmt->bindValue("cnpj", $c->getCnpj());
                    $stmt->bindValue("cpf", null);
                }

                if ($stmt->execute()) {
                    $c->setId($con->lastInsertId());
                    $c->getEndereco()->setCliente($c->getId());

                    $enderecoModel = $endereco->save($c->getEndereco());
                    if($enderecoModel){
                        $c->setEndereco($enderecoModel);

                        $con->commit();
                        
                    }else{
                        $con->rollBack();
                        throw new Exception("Erro no cadastrar endereco");
                    }
                } else {
                    throw new Exception("Erro no cadastrar");
                }
            } else {
                $sql = "UPDATE Cliente SET nome = :nome
                        , email = :email
                        , telefone = :telefone
                        , razao_social = :razao_social WHERE id = :id;";
                $stmt = $con->prepare($sql);

                $stmt->bindValue(":razao_social", $c->getRazaoSocial());
                $stmt->bindValue(":email", $c->getEmail());
                $stmt->bindValue(":nome", $c->getNome());
                $stmt->bindValue(":telefone", $c->getTelefone());
                $stmt->bindValue(":id", $c->getId());

                if ($stmt->execute()) {
                    $enderecoModel = $endereco->save($c->getEndereco());
                   
                    if($enderecoModel){
                        $con->commit();
                        $c = true;
                    }else{
                        $con->rollBack();
                        $c = false;
                    }
                } else {
                    throw new Exception("Erro no cadastrar");
                }
            }
        } catch (Error $e) {
            
            return $e->getCode();
        } catch (Exception $e) {
            return $e->getCode();
        } finally {
            Connection::close($con);
        }
        return $c;
    }

    public function fetch(int $id = null)
    {
        try {
            $con = Connection::getConnection();
            if ($con == null) throw new Error("Conexão falhou.");
            
            $clientes = null;
            
            if (!$id) {
                $sql = "SELECT id
                         , nome
                         , email
                         , telefone
                         , cpf
                         , cnpj
                         , razao_social as razaoSocial
                         , fisica_juridica as fisicaJuridica
                        FROM Cliente 
                        ORDER BY
                        id DESC;";

                $stmt = $con->prepare($sql);
            } else {
                $sql = "SELECT id
                         , nome
                         , email
                         , telefone
                         , cpf
                         , cnpj
                         , razao_social as razaoSocial
                         , fisica_juridica as fisicaJuridica
                        FROM Cliente c
                        WHERE 
                          id = :id";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":id", $id);
            }

            if ($stmt->execute()) {
                if(!$id){
                    $clientes = $stmt->fetchAll(PDO::FETCH_CLASS, "Source\Model\ClienteModel");
                }else{
                    $clientes = $stmt->fetchAll(PDO::FETCH_CLASS, "Source\Model\ClienteModel");
                    if($clientes){
                        $clientes = $clientes[0];
                    }
                    
                    if($clientes->getId()){
                        $enderecoDao = new EnderecoDao();

                        $endereco = $enderecoDao->fetch($id);
                        $clientes->setEndereco($endereco);
                    }
                }
            } else {
                throw new Exception("Erro na busca.");
            }
        } catch (Error $e) {
            $clientes = [];
            return $clientes;
        } catch (Exception $e) {
            $clientes = [];
            return $clientes;
        } finally {
            Connection::close($con);
        }
        return $clientes;
    }

    public function fetchNome(string $nome)
    {
        try {
            $con = Connection::getConnection();
            if ($con == null) throw new Error("Conexão falhou.");
            
            $cliente = null;
            $nome = strtolower($nome);
            $sql = "SELECT id
                         , nome
                         , email
                         , telefone
                         , cpf
                         , cnpj
                         , razao_social as razaoSocial
                         , fisica_juridica as fisicaJuridica
                        FROM Cliente 
                        WHERE 
                            LOWER(nome) LIKE '%{$nome}%' OR
                            LOWER(razao_social) LIKE '%{$nome}%'";
            
            $stmt = $con->prepare($sql);

            if ($stmt->execute()) {
                $cliente = $stmt->fetch(PDO::FETCH_OBJ);
            } else {
                throw new Exception("Erro na busca.");
            }
        } catch (Error $e) {
            return $cliente;
        } catch (Exception $e) {
            return $cliente;
        } finally {
            Connection::close($con);
        }
        return $cliente;
    }

    public function delete(int $id): bool
    {
        try {
            $con = Connection::getConnection();
            if ($con == null) throw new Error("Conexão falhou.");
            
            $result = false;
            $sql = "DELETE FROM Cliente WHERE id = :id";

            $stmt = $con->prepare($sql);
            $stmt->bindValue(":id", $id);

            if ($stmt->execute()) {
                $result = true;
            } else {
                throw new Exception("Erro no deletar");
            }
        } catch (Error $e) {
            return $result;
            die();
        } catch (Exception $e) {
            dd($e->getMessage());
            return $result;
        } finally {
            Connection::close($con);
        }
        return $result;
    }
}
