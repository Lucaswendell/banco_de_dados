<?php

namespace Source\Controller;

use Source\Model\ClienteDao;
use Source\Model\ClienteModel;
use Exception;

class Cliente extends Controller
{
    public function __construct($router)
    {
        parent::__construct($router);
    }

    public function home(): void
    {
        $clienteDao = new ClienteDao();
        $clientes = $clienteDao->fetch();

        echo $this->view->render("home", [
            "title" => "Clientes",
            "clientes" => $clientes
        ]);
    }

    public function pesquisa(array $data)
    {
        $q = addslashes(htmlspecialchars_decode($data['q']));

        if (empty($q)) {
            http_response_code(400);
            echo $this->ajaxResponse("cliente", ["error" => "Pesquisa vazia."]);
            die();
        }

        $clienteDao = new ClienteDao();

        $cliente = $clienteDao->fetchNome($q);

        if (!$cliente) {
            http_response_code(400);
            echo $this->ajaxResponse("cliente", ["error" => "Cliente não encontrada no registro."]);
            die();
        }

        echo $this->ajaxResponse("cliente", [
            "id"             => $cliente->id,
            "fisicajuridica" => $cliente->fisicaJuridica,
            "telefone"       => $cliente->telefone,
            "cpf"            => $cliente->cpf,
            "cnpj"           => $cliente->cnpj,
            "razaosocial"    => $cliente->razaoSocial,
            "email"          => $cliente->email,
            "nome"           => $cliente->nome,
        ]);
    }

    public function adicionar(array $data): void
    {
        try {

            $cliente = new ClienteDao();
            $clienteModel = new clienteModel();

            if ((empty($data["cpf"]) && $data["fisicaJuridica"]) || (empty($data["razao"]) && !$data["fisicaJuridica"])  || empty($data["pais"]) ||
                empty($data["estado"]) || empty($data["email"]) || empty($data["cep"])    ||
                empty($data["numero"]) || empty($data['cidade'])  || (empty($data["nome"]) && $data["fisicaJuridica"]) ||
                (empty($data["cnpj"]) && !$data["fisicaJuridica"])
            ) {
                http_response_code(400);
                echo $this->ajaxResponse("cliente", ["error" => "Preencha todos os campos."]);
                die();
            }


            $clienteModel->setFisicaJuridica($data["fisicaJuridica"]);
            if ($data["fisicaJuridica"]) {
                $clienteModel->setCpf($data["cpf"]);
            } else {
                $clienteModel->setCnpj($data["cnpj"]);
            }

            $clienteModel->setRazaoSocial($data["razao"]);
            $clienteModel->setEmail($data["email"]);
            $clienteModel->setNome($data["nome"]);
            $clienteModel->setTelefone($data["telefone"]);

            $clienteModel->getEndereco()->setPais($data["pais"]);
            $clienteModel->getEndereco()->setEstado($data["estado"]);
            $clienteModel->getEndereco()->setNumero($data["numero"]);
            $clienteModel->getEndereco()->setCidade($data["cidade"]);
            $clienteModel->getEndereco()->setComplemento($data["complemento"]);
            $clienteModel->getEndereco()->setCep($data["cep"]);


            $clienteModel = $cliente->save($clienteModel);

            if (gettype($clienteModel) == "string" && $clienteModel == "23000") {
                throw new Exception("Cliente já cadastrado.");
            }

            if (gettype($clienteModel) != "string") {
                echo $this->ajaxResponse("Cliente", [
                    "id"             => $clienteModel->getId(),
                    "FisicaJuridica" => $clienteModel->getFisicaJuridica(),
                    "Telefone"       => $clienteModel->getTelefone(),
                    "Cpf"            => $clienteModel->getCpf(),
                    "Cnpj"           => $clienteModel->getCnpj(),
                    "RazaoSocial"    => $clienteModel->getRazaoSocial(),
                    "Email"          => $clienteModel->getEmail(),
                    "Nome"           => $clienteModel->getNome(),

                    "Pais"           => $clienteModel->getEndereco()->getPais(),
                    "Estado"         => $clienteModel->getEndereco()->getEstado(),
                    "Numero"         => $clienteModel->getEndereco()->getNumero(),
                    "Cidade"         => $clienteModel->getEndereco()->getCidade(),
                    "Complemento"    => $clienteModel->getEndereco()->getComplemento(),
                    "Cep"            => $clienteModel->getEndereco()->getCep(),
                ]);
            } else {
                throw new Exception("Erro ao cadastrar cliente.");
            }
        } catch (Exception $e) {
            http_response_code(400);
            echo $this->ajaxResponse("cliente", ["error" => $e->getMessage()]);
            die();
        }
    }



    public function excluir(array $data)
    {
        $id = addslashes($data["id"]);
        $id = htmlspecialchars_decode($id);

        if (empty($id)) {
            http_response_code(400);
            echo $this->ajaxResponse("Cliente", ["error" => "Cliente invalido."]);
            die();
        }

        $cliente = new ClienteDao();
        $result = $cliente->delete($id);
        if ($result) {
            echo $this->ajaxResponse("cliente", ["success" => "Cliente deletado com sucesso."]);
        } else {
            http_response_code(400);

            echo $this->ajaxResponse("cliente", ["error" => $result]);
            die();
        }
    }

    public function editar(array $data)
    {
        $cliente = new ClienteDao();
        $clienteModel = new clienteModel();

        if ((empty($data["razao"]) && !$data["fisicaJuridica"])  || empty($data["pais"]) ||
            empty($data["estado"]) || empty($data["email"]) || empty($data["cep"])    ||
            empty($data["numero"]) || empty($data['cidade'])  || (empty($data["nome"]) && $data["fisicaJuridica"])
        ) {
            http_response_code(400);
            echo $this->ajaxResponse("cliente", ["error" => "Preencha todos os campos."]);
            die();
        }


        $clienteModel->setId($data["id"]);
        $clienteModel->setRazaoSocial($data["razao"]);
        $clienteModel->setEmail($data["email"]);
        $clienteModel->setNome($data["nome"]);
        $clienteModel->setTelefone($data["telefone"]);

        $clienteModel->getEndereco()->setId($data["idEndereco"]);
        $clienteModel->getEndereco()->setCliente($clienteModel->getId());
        $clienteModel->getEndereco()->setPais($data["pais"]);
        $clienteModel->getEndereco()->setEstado($data["estado"]);
        $clienteModel->getEndereco()->setNumero($data["numero"]);
        $clienteModel->getEndereco()->setCidade($data["cidade"]);
        $clienteModel->getEndereco()->setComplemento($data["complemento"]);
        $clienteModel->getEndereco()->setCep($data["cep"]);
                
        $clienteModel = $cliente->save($clienteModel);

        if (gettype($clienteModel) == "string" && $clienteModel == "23000") {
            throw new Exception("Cliente já cadastrado.");
        }

        if ((bool)$clienteModel) {
            echo $this->ajaxResponse("Cliente", ["success" => "cliente editado com sucesso."]);
        } else {
            http_response_code(400);
            echo $this->ajaxResponse("cliente", ["error" => "Erro ao editar cliente."]);
        }
    }

    public function formEditar(array $data)
    {
        $id = addslashes($data["id"]);
        $id = htmlspecialchars_decode($id);

        if (empty($id)) {
            http_response_code(400);
            echo $this->ajaxResponse("Cliente", ["error" => "Cliente invalido."]);
            die();
        }

        $ClienteDao = new ClienteDao();
        $cliente = $ClienteDao->fetch($id);

        echo $this->view->render("formEditar", [
            "title" => "MJA Alocaçoes | Editar",
            "cliente" => $cliente
        ]);
    }

    public function formAdicionar(): void
    {
        echo $this->view->render("formAdicionar", [
            "title" => "MJAAlocacoes | Adicionar Clientes"
        ]);
    }



    public function error(array $data): void
    {
        echo $data["errcode"];
    }
}
