<?php
session_start();
require 'conexao.php';

// Redireciona se já estiver logado
if (isset($_SESSION["usuario_id"])) {
    header("Location: index.php");
    exit;
}

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = trim($_POST["usuario"]);
    $senha = md5(trim($_POST["senha"])); // Hash MD5 exigido

    $stmt = $pdo->prepare("SELECT id, usuario FROM usuarios WHERE usuario = ? AND senha = ?");
    $stmt->execute([$usuario, $senha]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION["usuario_id"] = $user["id"];
        $_SESSION["usuario"] = $user["usuario"];
        header("Location: index.php");
        exit;
    } else {
        $erro = "Usuário ou senha incorretos!";
    }
}

include 'header.php';
?>

<div class="row justify-content-center mt-5">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <h4>Login - Tarefas</h4>
            </div>
            <div class="card-body">
                <?php if ($erro): ?>
                    <div class="alert alert-danger"><?= $erro ?></div>
                <?php endif; ?>
                
                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Usuário</label>
                        <input type="text" name="usuario" class="form-control" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Senha</label>
                        <input type="password" name="senha" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Entrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>