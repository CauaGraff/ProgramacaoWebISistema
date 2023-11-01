<?php

session_start();

use CoffeeCode\Router\Router;

require __DIR__ . "/vendor/autoload.php";

/**
 * Definindo rotas
 */

$router = new Router(CONF_SITE_URL);

$router->namespace('Source\Controllers');

$router->group(null);

/** WEB */
$router->get('/', 'Web:home', 'web.home');
$router->get('/login', 'Web:login', 'web.login');
$router->get('/contato', 'Web:contato', 'web.contato');
$router->post('/cidades', 'Web:cidades', 'web.cidades');

/** AUTH */
$router->post('/login', 'Web:login', 'auth.login');
$router->get('/logout', 'Web:logout', 'auth.logout');

/**USUARIOS */
$router->group('usuarios');
$router->get('/', 'Usuarios:index', 'usuarios.index');
$router->get('/cadastro', 'Usuarios:register', 'usuarios.register');
$router->post('/register', 'Usuarios:register', 'usuarios.post.register');
$router->get('/atualiza/{id}', 'Usuarios:update', 'usuarios.update');
$router->post('/update', 'Usuarios:update', 'usuarios.post.update');
$router->post('/dados', 'Usuarios:dados', 'usuarios.post.dados');
$router->post('/delet', 'Usuarios:delet', 'usuarios.delet');

/**EMPRESAS */
$router->group('empresas');
$router->get('/', 'Empresas:index', 'empresas.index');
$router->get('/cadastro', 'Empresas:register', 'empresas.register');
$router->post('/register', 'Empresas:register', 'empresas.post.register');
$router->get('/atualiza/{id}', 'Empresas:update', 'empresas.update');
$router->post('/update', 'Empresas:update', 'empresas.post.update');
$router->post('/dados', 'Empresas:dados', 'empresas.post.dados');
$router->post('/delet', 'Empresas:delet', 'empresas.delet');

/**CLIENTES */
$router->group('clientes');
$router->get('/', 'Clientes:index', 'clientes.index');
$router->get('/cadastro', 'Clientes:register', 'clientes.register');
$router->post('/register', 'Clientes:register', 'clientes.post.register');
$router->get('/atualiza/{id}', 'Clientes:update', 'clientes.update');
$router->post('/update', 'Clientes:update', 'clientes.post.update');
$router->post('/dados', 'Clientes:dados', 'clientes.post.dados');
$router->post('/delet', 'Clientes:delet', 'clientes.delet');

/** PRODUTOS */
$router->group('produtos');
$router->get('/', 'Produto:index', 'produto.index');
$router->get('/cadastro', 'Produto:register', 'produto.register');
$router->post('/register', 'Produto:register', 'produto.post.register');
$router->get('/atualiza/{id}', 'Produto:update', 'produto.update');
$router->post('/update', 'Produto:update', 'produto.post.update');
$router->post('/dados', 'Produto:dados', 'produto.post.dados');
$router->post('/delet', 'Produto:delet', 'produto.delet');

/**ORÇAMENTOS */
$router->group('orcamento');
$router->get('/', 'Orcamento:index', 'orcamento.index');
$router->post("/items", "Orcament:orcamento", "orcamento.ocramento");
$router->get('/cadastro', 'Orcamento:register', 'orcamento.cadastro');
$router->post('/add/{id}', 'Orcamento:add', 'orcamento.add');
$router->post('/remover/{id}', 'Orcamento:remover', 'orcamento.re');
$router->post('/clear', 'Orcamento:clear', 'orcamento.clear');

/**WDS */
$router->group('json');
$router->get("/", "Wds:index", "wds.index");
$router->get("/clientes", "Wds:clientes", "wds.clientes");
$router->get("/empresas", "Wds:empresas", "wds.empresas");
$router->get("/produtos", "Wds:produtos", "wds.produtos");
$router->get("/unidadesMedida", "Wds:unidadesMedida", "wds.unidadesmedida");
$router->get("/cidades", "Wds:cidades", "wds.cidades");
$router->get("/consomeClientes", "Wds:consomeClientes", "wds.consomeclientes");
$router->get("/inserir", "Wds:insere", "wds.insere");

$router->group('caua');
$router->get("/", "wsCaua:index", "wscaua.index");
$router->get("/clientes", "wsCaua:clientes", "wscaua.clientes");

$router->group('lucas');
$router->get("/empresa", "wsVivan:empresa", "wsvivan.empresa");
$router->get("/clientes", "wsVivan:clientes", "wsvivan.clientes");

$router->group('wesley');
$router->get("/produtos", "wsWesley:produtos", "wsvivan.produtos");

$router->dispatch();
if ($router->error()) {
    echo "Houve um erro " . $router->error();
}
