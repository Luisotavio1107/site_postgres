<?php
require_once __DIR__ . '/functions.php';
$base = $base ?? '';
$titulo = $titulo ?? 'Raia Sports';
$u = usuario();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($titulo) ?> | Raia Sports</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;800&family=Barlow:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= $base ?>assets/style.css">
</head>
<body>
<header class="topo">
  <a class="logo" href="<?= $base ?>index.php">RAIA<span>SPORTS</span></a>
  <nav>
    <a href="<?= $base ?>index.php#produtos">Produtos</a>
    <?php if ($u): ?>
      <a href="<?= $base ?>app/pedidos.php">Meus pedidos</a>
      <a href="<?= $base ?>login/logout.php">Sair (<?= e(explode(' ', $u['nome'])[0]) ?>)</a>
    <?php else: ?>
      <a href="<?= $base ?>login/login.php">Entrar</a>
    <?php endif; ?>
    <a class="carrinho" href="<?= $base ?>carrinho.php">Carrinho <b><?= carrinho_qtd() ?></b></a>
  </nav>
</header>
<main>
