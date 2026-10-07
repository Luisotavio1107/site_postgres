<?php
$base = '../'; $titulo = 'Meus pedidos';
require_once '../includes/functions.php';
exigir_login('../');
$uid = usuario()['id'];
$pedidos = array_reverse(array_values(array_filter(ler('pedidos'), fn($p) => $p['usuario_id'] === $uid)));
require '../includes/header.php';
?>
<section class="conteudo">
  <h1>Meus pedidos</h1>
  <?php if (isset($_GET['ok'])): ?><p class="sucesso">Pedido #<?= (int)$_GET['ok'] ?> confirmado. Obrigado pela compra!</p><?php endif; ?>
  <?php if (!$pedidos): ?>
    <p>Você ainda não fez nenhum pedido.</p><a class="btn" href="../index.php#produtos">Ver produtos</a>
  <?php endif; ?>
  <?php foreach ($pedidos as $p): ?>
    <div class="pedido">
      <h3>Pedido #<?= $p['id'] ?> <small><?= e(date('d/m/Y H:i', strtotime($p['criado_em']))) ?></small></h3>
      <ul><?php foreach ($p['itens'] as $i): ?><li><?= $i['icone'] ?> <?= e($i['nome']) ?> × <?= $i['qtd'] ?></li><?php endforeach; ?></ul>
      <strong><?= dinheiro($p['total']) ?></strong>
    </div>
  <?php endforeach; ?>
</section>
<?php require '../includes/footer.php'; ?>
