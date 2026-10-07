<?php
$titulo = 'Início';
require 'includes/header.php';
$cat = $_GET['cat'] ?? '';
$cats = array_values(array_unique(array_column(produtos(), 'categoria')));
sort($cats);
$produtos = $cat === '' ? produtos() : array_filter(produtos(), fn($p) => $p['categoria'] === $cat);
?>
<section class="hero">
  <h1>Treine hoje.<br>Chegue amanhã.</h1>
  <p>Tênis, bolas, bikes e acessórios com entrega rápida para todo o Brasil.</p>
  <a class="btn" href="#produtos">Ver produtos</a>
</section>

<section id="produtos" class="conteudo">
  <div class="filtros">
    <a href="index.php#produtos" class="<?= $cat === '' ? 'on' : '' ?>">Todos</a>
    <?php foreach ($cats as $c): ?>
      <a href="?cat=<?= urlencode($c) ?>#produtos" class="<?= $cat === $c ? 'on' : '' ?>"><?= e($c) ?></a>
    <?php endforeach; ?>
  </div>
  <div class="grade">
    <?php foreach ($produtos as $p): ?>
      <article class="card">
        <a href="produto.php?id=<?= $p['id'] ?>" class="foto" style="background:<?= e($p['cor']) ?>"><?= $p['icone'] ?></a>
        <div class="info">
          <small><?= e($p['categoria']) ?></small>
          <h3><a href="produto.php?id=<?= $p['id'] ?>"><?= e($p['nome']) ?></a></h3>
          <p class="preco"><?= dinheiro($p['preco']) ?></p>
          <form method="post" action="carrinho.php">
            <input type="hidden" name="csrf" value="<?= csrf() ?>">
            <input type="hidden" name="id" value="<?= $p['id'] ?>">
            <button class="btn pequeno" name="acao" value="add">Adicionar ao carrinho</button>
          </form>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</section>
<?php require 'includes/footer.php'; ?>
