<?php
// O FRAMEWORK ESCOLHIDO FOI O BOOTSTRAP 5
// Importado no arquivo header.php usando a CDN: https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css

session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

require 'conexao.php';
include 'header.php';

// Buscar as tarefas apenas do usuário logado
$stmt = $pdo->prepare("SELECT * FROM tarefas WHERE usuario_id = ? ORDER BY data_criacao DESC");
$stmt->execute([$_SESSION["usuario_id"]]);
$tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Minhas Tarefas</h2>
    <a href="nova.php" class="btn btn-success">+ Nova Tarefa</a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped m-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Título</th>
                        <th>Status</th>
                        <th>Data de Criação</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($tarefas) > 0): ?>
                        <?php foreach ($tarefas as $t): ?>
                            <tr>
                                <td>
                                    <strong><?= htmlspecialchars($t['titulo']) ?></strong><br>
                                    <small class="text-muted"><?= htmlspecialchars($t['descricao']) ?></small>
                                </td>
                                <td>
                                    <?php if ($t['status'] === 'concluida'): ?>
                                        <span class="badge bg-success">Concluída</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark">Pendente</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('d/m/Y H:i', strtotime($t['data_criacao'])) ?></td>
                                <td class="text-end">
                                    <a href="editar.php?id=<?= $t['id'] ?>" class="btn btn-sm btn-primary">Editar</a>
                                    
                                    <?php if ($t['status'] === 'pendente'): ?>
                                        <a href="concluir.php?id=<?= $t['id'] ?>" class="btn btn-sm btn-success">Concluir</a>
                                    <?php endif; ?>
                                    
                                    <a href="excluir.php?id=<?= $t['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center py-3">Nenhuma tarefa encontrada.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>