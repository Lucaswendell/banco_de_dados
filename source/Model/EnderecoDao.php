<?php

namespace Source\Model;

use Error;
use Exception;
use PDO;
use Source\Controller\Connection;
use Source\Model\EnderecoModel;

class enderecoDao
{
    public function save(EnderecoModel $e)
    {
        try {

            $con = Connection::getConnection();
            if ($con == null) throw new Error("Conexão falhou.");

            if (!$e->getId()) {
                $sql = "INSERT INTO Endereco(cliente_id, numero, complemento, cidade, estado, pais, cep) 
                        VALUES (:cliente_id, :numero, :complemento,  :cidade, :estado, :pais, :cep);";

                $stmt = $con->prepare($sql);
                
                $stmt->bindValue(":pais", $e->getPais());
                $stmt->bindValue(":estado", $e->getEstado());
                $stmt->bindValue(":numero", $e->getNumero());
                $stmt->bindValue(":cidade", $e->getCidade());
                $stmt->bindValue(":complemento", $e->getComplemento());
                $stmt->bindValue(":cep", $e->getCep());
                $stmt->bindValue(":cliente_id", $e->getCliente());

                if ($stmt->execute()) {
                    $e->setId($con->lastInsertId());
                } else {
                    throw new Exception("Erro no cadastrar");
                }
            } else {
                $sql = "UPDATE Endereco SET numero = :numero
                            ,complemento = :complemento
                            ,cidade = :cidade
                            ,estado = :estado
                            ,pais = :pais
                            ,cep = :cep 
                        WHERE id = :id;";
                $stmt = $con->prepare($sql);

                $stmt->bindValue(":pais", $e->getPais());
                $stmt->bindValue(":estado", $e->getEstado());
                $stmt->bindValue(":numero", $e->getNumero());
                $stmt->bindValue(":cidade", $e->getCidade());
                $stmt->bindValue(":complemento", $e->getComplemento());
                $stmt->bindValue(":cep", $e->getCep());
                $stmt->bindValue(":id", $e->getId());

                if ($stmt->execute()) {
                    $e = true;
                } else {
                    throw new Exception("Erro no cadastrar");
                }
            }
        } catch (Error $e) {
            dd($e->getMessage());
            return false;
        } catch (Exception $e) {
            dd($e->getMessage());
            return false;
        } finally {
            Connection::close($con);
        }
        return $e;
    }

    public function fetch(int $id = null)
    {
        try {
            $con = Connection::getConnection();
            if ($con == null) throw new Error("Conexão falhou.");
            
            $enderecos = null;
            
            if ($id) {
                $sql = "SELECT id, cliente_id, numero, complemento, cidade, estado, pais, cep
                        FROM Endereco 
                        WHERE cliente_id = :id";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":id", $id);
            }

            if ($stmt->execute()) {
                $enderecos = $stmt->fetchAll(PDO::FETCH_CLASS, "Source\Model\EnderecoModel");
                if($enderecos){
                    $enderecos = $enderecos[0];
                }
            } else {
                throw new Exception("Erro na busca.");
            }
        } catch (Error $e) {
            $enderecos = [];
            return $enderecos;
        } catch (Exception $e) {
            $enderecos = [];
            return $enderecos;
        } finally {
            Connection::close($con);
        }
        return $enderecos;
    }
}
