<?php
// Abra http://localhost:8000/diagnostico.php para ver o que está faltando. Apague depois de usar.
header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL); ini_set('display_errors', '1');
$ok = fn($b) => $b ? '✅' : '❌';
$pasta = __DIR__;
$arquivos = ['index.php','produto.php','carrinho.php','includes/db.php','includes/functions.php','includes/header.php','includes/footer.php','login/login.php','login/registrar.php','login/logout.php','app/checkout.php','app/pedidos.php','database/produtos.php','assets/style.css'];
echo '<h2>Diagnóstico da Raia Sports</h2><pre>';
echo "Versão do PHP: " . PHP_VERSION . ' ' . $ok(version_compare(PHP_VERSION, '7.4', '>=')) . " (precisa de 7.4 ou mais)\n";
echo "Pasta do site: $pasta\n\n";
foreach ($arquivos as $a) echo $ok(is_file("$pasta/$a")) . " $a\n";
echo "\n" . $ok(is_writable("$pasta/database")) . " pasta database/ com permissão de escrita\n";
$texto = is_file("$pasta/includes/db.php") ? file_get_contents("$pasta/includes/db.php") : '';
echo $ok(strpos($texto, 'PDO') === false && $texto !== '') . " includes/db.php é a versão nova (sem PDO)\n";
echo $ok(function_exists('json_encode')) . " extensão json\n";
session_start(); $_SESSION['t'] = 1;
echo $ok(isset($_SESSION['t'])) . " sessões\n";
require_once "$pasta/includes/db.php";
try { echo $ok(count(produtos()) === 12) . ' produtos carregados: ' . count(produtos()) . "\n"; }
catch (Throwable $t) { echo '❌ erro ao carregar produtos: ' . $t->getMessage() . "\n"; }
echo '</pre>';
