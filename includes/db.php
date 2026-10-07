<?php
// Armazenamento em arquivos JSON (não precisa de extensão de banco no PHP).
const DADOS = __DIR__ . '/../database/';

function ler(string $nome): array {
    $f = DADOS . $nome . '.json';
    if (!is_file($f)) return [];
    $d = json_decode((string)file_get_contents($f), true);
    return is_array($d) ? $d : [];
}
function gravar(string $nome, array $dados): void {
    if (!is_dir(DADOS) || !is_writable(DADOS)) {
        die('A pasta database/ precisa existir e ter permissão de escrita.');
    }
    file_put_contents(DADOS . $nome . '.json', json_encode($dados, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT), LOCK_EX);
}
function produtos(): array {
    static $p = null;
    if ($p === null) $p = require DADOS . 'produtos.php';
    return $p;
}
function produto(int $id): ?array {
    foreach (produtos() as $p) if ($p['id'] === $id) return $p;
    return null;
}
function proximo_id(array $lista): int {
    return $lista ? max(array_column($lista, 'id')) + 1 : 1;
}
