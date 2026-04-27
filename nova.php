<?php
session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

require 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];

   
    $stmt = $pdo->prepare("INSERT INTO tarefas (titulo, descricao, usuario_id) VALUES (?, ?, ?)");
    $stmt->execute([$titulo, $descricao, $_SESSION["usuario_id"]]);
    
    header("Location: index.php");
    exit;
}

include 'header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Adicionar Nova Tarefa</h5>
            </div>
            <div class="card-body">
                <form action="nova.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Título *</label>
                        <input type="text" name="titulo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descrição</label>
                        <textarea name="descricao" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Salvar Tarefa</button>
                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>