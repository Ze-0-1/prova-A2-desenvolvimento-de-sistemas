# 📝 Sistema de Tarefas (To-Do List)

Este é um sistema web simples para gerenciamento de tarefas (To-Do List) com autenticação de usuários. O projeto foi desenvolvido como requisito para avaliação da disciplina de Desenvolvimento de Sistemas (Prova A2).

## 🚀 Funcionalidades

* **Autenticação:** Sistema de Login e Logout com verificação de credenciais.
* **Criptografia:** Senhas protegidas no banco de dados utilizando hash MD5 (conforme exigência do escopo).
* **Proteção de Rotas:** Controle de sessão (`session_start()`) garantindo que apenas usuários logados acessem o painel.
* **CRUD de Tarefas:**
  * **C:** Criar novas tarefas (Título e Descrição).
  * **R:** Listar tarefas organizadas da mais recente para a mais antiga.
  * **U:** Editar tarefas existentes e alterar o status (Pendente / Concluída).
  * **D:** Excluir tarefas do sistema.
* **Ações Rápidas:** Botão para concluir tarefas com um clique diretamente na listagem.
* **Interface Responsiva:** Layout padronizado utilizando o framework **Bootstrap 5**.

## 🛠️ Tecnologias Utilizadas

* **Linguagem:** PHP (com manipulação via PDO para maior segurança contra SQL Injection)
* **Banco de Dados:** MySQL
* **Frontend:** HTML5, CSS3 e Bootstrap 5 (via CDN)

## ⚙️ Como executar o projeto localmente

### 1. Pré-requisitos
* Ter um servidor local instalado (XAMPP, WampServer, Laragon, etc.).
* O serviço do **Apache** e do **MySQL** devem estar em execução.


### 3. Configurando a Conexão
Verifique o arquivo `conexao.php` e certifique-se de que as credenciais correspondem ao seu ambiente local (host, porta, usuário, senha e nome do banco de dados).

### 🔑 Credenciais de Teste
* **Usuário:** `admin`
* **Senha:** `123456`

---

## Autor e Informações Acadêmicas
Nome do Aluno: José Gabriel Ribeiro Cecilio

Projeto: MindClear - Organizador de Rotina

Link do Repositório: https://github.com/Ze-0-1/prova-A2-desenvolvimento-de-sistemas.git

---

*Desenvolvido para fins acadêmicos.*