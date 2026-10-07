<?php
$base = '../'; $titulo = 'Entrar';
require_once '../includes/functions.php';
$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_ok()) { $erro = 'Sessão expirada. Tente de novo.'; }
    else {
        $email = strtolower(trim($_POST['email'] ?? ''));
        $u = null;
        foreach (ler('usuarios') as $x) if ($x['email'] === $email) $u = $x;
        if ($u && password_verify($_POST['senha'] ?? '', $u['senha'])) {
            session_regenerate_id(true);
            $_SESSION['usuario'] = ['id' => $u['id'], 'nome' => $u['nome']];
            header('Location: ../' . (carrinho_qtd() ? 'app/checkout.php' : 'index.php')); exit;
        }
        $erro = 'E-mail ou senha incorretos.';
    }
}
require '../includes/header.php';
?>
<section class="conteudo form">
  <h1>Entrar</h1>
  <?php if ($erro): ?><p class="erro"><?= e($erro) ?></p><?php endif; ?>
  <form method="post">
    <input type="hidden" name="csrf" value="<?= csrf() ?>">
    <label>E-mail <input type="email" name="email" required></label>
    <label>Senha <input type="password" name="senha" required></label>
    <button class="btn">Entrar</button>
  </form>
  <p>Ainda não tem conta? <a href="registrar.php">Criar conta</a></p>
</section>
<?php require '../includes/footer.php'; ?>
