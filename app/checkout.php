<?php
$base = '../'; $titulo = 'Finalizar compra';
require_once '../includes/functions.php';
exigir_login('../');
$itens = carrinho_itens();
if (!$itens) { header('Location: ../carrinho.php'); exit; }
$total = array_sum(array_column($itens, 'subtotal'));
if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_ok()) {
    $pedidos = ler('pedidos');
    $pid = proximo_id($pedidos);
    $pedidos[] = [
        'id' => $pid, 'usuario_id' => usuario()['id'], 'total' => $total, 'criado_em' => date('Y-m-d H:i:s'),
        'itens' => array_map(fn($i) => ['nome' => $i['nome'], 'icone' => $i['icone'], 'qtd' => $i['qtd'], 'preco' => $i['preco']], $itens),
    ];
    gravar('pedidos', $pedidos);
    unset($_SESSION['carrinho']);
    header('Location: pedidos.php?ok=' . $pid); exit;
}
require '../includes/header.php';
?>
<section class="conteudo">
  <h1>Finalizar compra</h1>
  <table class="tabela">
    <?php foreach ($itens as $i): ?>
      <tr><td><?= $i['icone'] ?> <?= e($i['nome']) ?></td><td>× <?= $i['qtd'] ?></td><td><?= dinheiro($i['subtotal']) ?></td></tr>
    <?php endforeach; ?>
  </table>
  <p class="total">Total: <strong><?= dinheiro($total) ?></strong></p>
  <form method="post">
    <input type="hidden" name="csrf" value="<?= csrf() ?>">
    <button class="btn">Confirmar pedido</button>
  </form>
</section>
<?php require '../includes/footer.php'; ?>
