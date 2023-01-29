<img class="logo" src="./assets/img/logo.png" alt="logolibmanager">
<nav class="container-menu">
            <ul class="list-menu">
                <a class="link" href="home.php">
                    <li>Home</li>
                </a>
                <?php if ($perfil_acesso == 1) : ?>
                    <a class="link" href="cadastrar_livros.php">
                        <li>Cadastrar Livro</li>
                    </a>
                    <a class="link" href="cadastrar_funcionario.php">
                        <li>Cadastrar Funcionário</li>
                    </a>
                    <a href="registro_emprestimos.php" class="link">Empréstimos de Livros</a>
                <?php endif ?>
                <a class="link" href="home.php">
                    <li>Pesquisar Livros</li>
                </a>
                <a class="link" href="meus_emprestimos.php">
                    <li>Meus Empréstimos</li>
                </a>
                <a class="link" href="sistema_logout.php">
                    <li>Sair</li>
                </a>
            </ul>
        </nav>