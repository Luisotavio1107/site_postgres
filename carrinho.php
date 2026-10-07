<?php
require_once 'includes/functions.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_ok()) {
    $id = (int)($_POST['id'] ?? 0);
    $acao = $_POST['acao'] ?? '';
    if ($acao === 'add') { $_SESSION['carrinho'][$id] = ($_SESSION['carrinho'][$id] ?? 0) + 1; header('Location: carrinho.php'); exit; }
    if ($acao === 'mais') $_SESSION['carrinho'][$id] = ($_SESSION['carrinho'][$id] ?? 0) + 1;
    if ($acao === 'menos') { $_SESSION['carrinho'][$id] = ($_SESSION['carrinho'][$id] ?? 1) - 1; if ($_SESSION['carrinho'][$id] <= 0) unset($_SESSION['carrinho'][$id]); }
    if ($acao === 'remover') unset($_SESSION['carrinho'][$id]);
    header('Location: carrinho.php'); exit;
}
$titulo = 'Carrinho';
require 'includes/header.php';
$itens = carrinho_itens();
$total = array_sum(array_column($itens, 'subtotal'));
?>
<section class="conteudo">
  <h1>Seu carrinho</h1>
  <?php if (!$itens): ?>
    <p>Seu carrinho está vazio. Que tal começar por um tênis de corrida?</p>
    <a class="btn" href="index.php#produtos">Ver produtos</a>
  <?php else: ?>
    <table class="tabela">
      <?php foreach ($itens as $i): ?>
      <tr>
        <td><?= $i['icone'] ?> <?= e($i['nome']) ?></td>
        <td><?= dinheiro($i['preco']) ?></td>
        <td>
          <form method="post" class="qtd">
            <input type="hidden" name="csrf" value="<?= csrf() ?>">
            <input type="hidden" name="id" value="<?= $i['id'] ?>">
            <button name="acao" value="menos" aria-label="Diminuir">−</button>
            <span><?= $i['qtd'] ?></span>
            <button name="acao" value="mais" aria-label="Aumentar">+</button>
          </form>
        </td>
        <td><?= dinheiro($i['subtotal']) ?></td>
        <td>
          <form method="post">
            <input type="hidden" name="csrf" value="<?= csrf() ?>">
            <input type="hidden" name="id" value="<?= $i['id'] ?>">
            <button class="link" name="acao" value="remover">Remover</button>
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
    <p class="total">Total: <strong><?= dinheiro($total) ?></strong></p>
    <a class="btn" href="app/checkout.php">Finalizar compra</a>
  <?php endif; ?>
</section>
<?php require 'includes/footer.php'; ?>
