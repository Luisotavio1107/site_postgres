<?php
$base = '../'; $titulo = 'Criar conta';
require_once '../includes/functions.php';
$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = strtolower(trim($_POST['email'] ?? ''));
    $senha = $_POST['senha'] ?? '';
    if (!csrf_ok()) $erro = 'Sessão expirada. Tente de novo.';
    elseif ($nome === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $erro = 'Informe seu nome e um e-mail válido.';
    elseif (strlen($senha) < 6) $erro = 'A senha precisa ter pelo menos 6 caracteres.';
    else {
        $usuarios = ler('usuarios');
        if (in_array($email, array_column($usuarios, 'email'), true)) {
            $erro = 'Este e-mail já está cadastrado.';
        } else {
            $id = proximo_id($usuarios);
            $usuarios[] = ['id' => $id, 'nome' => $nome, 'email' => $email, 'senha' => password_hash($senha, PASSWORD_DEFAULT)];
            gravar('usuarios', $usuarios);
            session_regenerate_id(true);
            $_SESSION['usuario'] = ['id' => $id, 'nome' => $nome];
            header('Location: ../index.php'); exit;
        }
    }
}
require '../includes/header.php';
?>
<section class="conteudo form">
  <h1>Criar conta</h1>
  <?php if ($erro): ?><p class="erro"><?= e($erro) ?></p><?php endif; ?>
  <form method="post">
    <input type="hidden" name="csrf" value="<?= csrf() ?>">
    <label>Nome <input name="nome" required></label>
    <label>E-mail <input type="email" name="email" required></label>
    <label>Senha <input type="password" name="senha" minlength="6" required></label>
    <button class="btn">Criar conta</button>
  </form>
  <p>Já tem conta? <a href="login.php">Entrar</a></p>
</section>
<?php require '../includes/footer.php'; ?>
