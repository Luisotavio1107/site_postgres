<?php
require_once 'includes/functions.php';
$p = produto((int)($_GET['id'] ?? 0));
if (!$p) { http_response_code(404); $titulo = 'Não encontrado'; require 'includes/header.php'; echo '<section class="conteudo"><h1>Produto não encontrado</h1><a class="btn" href="index.php">Voltar à loja</a></section>'; require 'includes/footer.php'; exit; }
$titulo = $p['nome'];
require 'includes/header.php';
?>
<section class="conteudo detalhe">
  <div class="foto grande" style="background:<?= e($p['cor']) ?>"><?= $p['icone'] ?></div>
  <div>
    <small><?= e($p['categoria']) ?></small>
    <h1><?= e($p['nome']) ?></h1>
    <p class="preco grande"><?= dinheiro($p['preco']) ?></p>
    <p><?= e($p['descricao']) ?></p>
    <p class="nota">Em até 6x de <?= dinheiro($p['preco'] / 6) ?> sem juros.</p>
    <form method="post" action="carrinho.php">
      <input type="hidden" name="csrf" value="<?= csrf() ?>">
      <input type="hidden" name="id" value="<?= $p['id'] ?>">
      <button class="btn" name="acao" value="add">Adicionar ao carrinho</button>
    </form>
  </div>
</section>
<?php require 'includes/footer.php'; ?>
