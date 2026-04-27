<?php
session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

require 'conexao.php';

// Receber ID via GET
$id = $_GET["id"] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $status = $_POST["status"];

    $stmt = $pdo->prepare("UPDATE tarefas SET titulo = ?, descricao = ?, status = ? WHERE id = ? AND usuario_id = ?");
    $stmt->execute([$titulo, $descricao, $status, $id, $_SESSION["usuario_id"]]);
    
    header("Location: index.php");
    exit;
}


$stmt = $pdo->prepare("SELECT * FROM tarefas WHERE id = ? AND usuario_id = ?");
$stmt->execute([$id, $_SESSION["usuario_id"]]);
$tarefa = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$tarefa) {
    header("Location: index.php");
    exit;
}

include 'header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Editar Tarefa</h5>
            </div>
            <div class="card-body">
                <form action="editar.php?id=<?= $tarefa['id'] ?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Título *</label>
                        <input type="text" name="titulo" class="form-control" value="<?= htmlspecialchars($tarefa['titulo']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descrição</label>
                        <textarea name="descricao" class="form-control" rows="3"><?= htmlspecialchars($tarefa['descricao']) ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="pendente" <?= $tarefa['status'] === 'pendente' ? 'selected' : '' ?>>Pendente</option>
                            <option value="concluida" <?= $tarefa['status'] === 'concluida' ? 'selected' : '' ?>>Concluída</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Atualizar Tarefa</button>
                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>