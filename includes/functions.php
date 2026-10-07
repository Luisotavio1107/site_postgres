<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/db.php';

function e($v): string { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
function dinheiro(float $v): string { return 'R$ ' . number_format($v, 2, ',', '.'); }
function usuario(): ?array { return $_SESSION['usuario'] ?? null; }
function exigir_login(string $base = ''): void {
    if (!usuario()) { header('Location: ' . $base . 'login/login.php'); exit; }
}
function csrf(): string {
    if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(16));
    return $_SESSION['csrf'];
}
function csrf_ok(): bool {
    return isset($_POST['csrf']) && hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf']);
}
function carrinho(): array { return $_SESSION['carrinho'] ?? []; }
function carrinho_qtd(): int { return array_sum(carrinho()); }
function carrinho_itens(): array {
    $itens = [];
    foreach (carrinho() as $id => $qtd) {
        $p = produto((int)$id);
        if (!$p) continue;
        $p['qtd'] = $qtd;
        $p['subtotal'] = $qtd * $p['preco'];
        $itens[] = $p;
    }
    return $itens;
}
