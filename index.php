<?php
require __DIR__."/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(url());

$router->namespace("Source\Controller");

/**
 * Cliente
 * home
 */
$router->group(null);
$router->get("/", "Cliente:home");
$router->get("/{q}", "Cliente:pesquisa");

/**
 * Cliente
 * adicionar
 */
$router->group("adicionar");
$router->get("/", "Cliente:formAdicionar");
$router->post("/", "Cliente:adicionar");

/**
 * Cliente
 * Excluir
 */
$router->group("excluir");
$router->delete("/{id}", "Cliente:excluir");

/**
 * Cliente
 * editar
 */
$router->group("editar");
$router->get("/{id}", "Cliente:formEditar");
$router->post("/{id}", "Cliente:editar");


/**
 * Cliente
 * error
 */
$router->group("error");
$router->get("/{errcode}", "Cliente:error");

/**
 * Pedido
 * Servico
 */
$router->group("servico");
$router->get("/{cliente}", "Pedido:formAdicionar");
$router->post("/", "Pedido:formAdicionar");



$router->dispatch();

/**
 * Erro
 */
if ($router->error()) {
    $router->redirect("/error/{$router->error()}");
}