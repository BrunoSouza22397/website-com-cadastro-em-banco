<?php session_start(); ob_start(); ?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css\mystyles.css">
    <link rel="stylesheet" href="node_modules\@fortawesome\fontawesome-free\css\all.min.css">
    <script src="node_modules\jquery\dist\jquery.min.js"></script>
    <script src="scripts/burger-script.js"></script>
    <title>Vault of Memories</title>
  </head>
  <body>
    <!--navbar-->
    <nav class="navbar is-black" role="navigation" aria-label="main navigation">
      <div class="navbar-brand">
        <a class="navbar-item has-icons-left" href="index.php">
          <strong class="title has-text-danger">Vault of Memories</strong>
          <span class="icon is-large is-left">
            <i class="fas fa-dice-d20"></i>
          </span>
        </a>
        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navMenu">
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
        </a>
      </div><!--fecha navbar-brand-->
      <div class="navbar-menu" id="navMenu">
        <div class="navbar-start">
          <a class="navbar-item" href="index.php">
            Home
          </a>
          <div class="navbar-item has-dropdown is-hoverable">
            <a class="navbar-link" href="heroes.php">
              Heroes
            </a>
            <div class="navbar-dropdown">
              <a href="create-hero.php" class="navbar-item">Criar Heróis</a>
              <a href="search-hero.php" class="navbar-item">Lista de Heróis</a>
            </div>
          </div>
          <a href="#" class="navbar-item">Reportar Bugs</a>
        </div>
        <div class="navbar-end">
          <div class="navbar-item">
            <div class="buttons">
              <a href="index.php?login=1" class="button is-primary" href="#">
                <strong>Cadastrar</strong>
              </a>
              <a href="index.php?login=2" class="button is-dark">
                <strong>Login</strong>
              </a>
            </div>
          </div>
        </div><!--fecha navbar-end-->
      </div><!--fecha navbar-menu-->
    </nav>
    <!-- fim do navbar -->
    <!--conteudo-->
    <div class="section">
      <div class="container">
        <?php
        if(isset($_GET['login'])){
          if($_GET['login'] == 1){
            ?>
            <h1 class="title is-1 is-spaced">Cadastro de Usuário</h1>
            <?php
            //Mostra os erros
            if(isset($_SESSION['erros'])){
              $erros = unserialize($_SESSION['erros']);
              foreach($erros as $e){
                echo "<h3 class='tile notification is-danger'>".$e."</h3>";
              }
              unset($_SESSION['erros']);
            }
            //Insere valores anteriores em variavel para que sejam mostrados novamente nos inputs
            if(isset($_SESSION['post'])){
              $dados = unserialize($_SESSION['post']);
              unset($_SESSION['post']);
            }
            //FORM DE CADASTRO
            ?>
            <form action="" method="post">
              <div class="field">
                <label class="label">Nome de Usuário</label>
                <div class="control has-icons-left">
                  <input class="input" type="text" name="txtuser" value="<?php if(isset($dados)){echo $dados['txtuser'];} ?>" placeholder="Ex.: Usuario12345" pattern="^[\w.-]{4,20}$" maxlength="20" required>
                  <span class="icon is-small is-left">
                    <i class="fas fa-user"></i>
                  </span>
                </div>
              </div><!--fecha field do username-->

              <div class="field">
                <label class="label">Email</label>
                <div class="control has-icons-left">
                  <input class="input" type="email" name="txtemail" value="<?php if(isset($dados)){echo $dados['txtemail'];} ?>" placeholder="Ex.: meu.email@dominio.com" required>
                  <span class="icon is-small is-left">
                    <i class="fas fa-envelope"></i>
                  </span>
                </div>
              </div><!--fecha field do email-->
              <div class="field">
                <label class="label">Senha</label>
                <div class="control has-icons-left">
                  <input class="input" type="password" name="txtpass" placeholder="Digite sua senha aqui..." pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{6,12}$" title="Deve conter pelo menos 1 letra maiuscula, 1 letra minuscula e 1 numero. Pode conter caracteres especiais. Min 6 caracteres, Max 12." required>
                  <span class="icon is-small is-left">
                    <i class="fas fa-key"></i>
                  </span>
                </div>
              </div><!--fecha field da senha-->
              <div class="field">
                <label class="label">Repita a senha</label>
                <div class="control has-icons-left">
                  <input class="input" type="password" name="txtrpass" placeholder="Repita sua senha aqui..." pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{6,12}$" title="Deve conter pelo menos 1 letra maiuscula, 1 letra minuscula e 1 numero. Pode conter caracteres especiais. Min 6 caracteres, Max 12." required>
                  <span class="icon is-small is-left">
                    <i class="fas fa-key"></i>
                  </span>
                </div>
              </div><!--fecha field da senha-->
              <div class="field is-grouped">
                <div class="control">
                  <input class="button is-link" type="submit" name="cadastrar" value="Cadastrar">
                </div>
                <div class="control">
                  <input class="button is-text" type="reset" value="Limpar">
                </div>
              </div><!--fecha field dos botões-->
            </form>
            <?php
          }elseif ($_GET['login'] == 2) {
            //------FORM DE LOGIN
            if(isset($_SESSION['msg'])){
              echo "<h2 class='tile subtitle notification is-primary'>".$_SESSION['msg']."</h2>";
              unset($_SESSION['msg']);
            }
            ?>
            <h1 class="title is-1 is-spaced">Login</h1>
            <form action="" method="post">
              <div class="field">
                <label class="label">Usuário</label>
                <div class="control has-icons-left">
                  <input class="input" type="text" name="txtuser" placeholder="Nome de usuário." pattern="^[\w.-]{4,20}$" maxlength="20" required>
                  <span class="icon is-small is-left">
                    <i class="fas fa-user"></i>
                  </span>
                </div>
              </div><!--fecha field user-->
              <div class="field">
                <label class="label">Senha</label>
                <div class="control has-icons-left">
                  <input class="input" type="password" name="txtpass" placeholder="Senha." pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{6,12}$" title="Deve conter pelo menos 1 letra maiuscula, 1 letra minuscula e 1 numero. Pode conter caracteres especiais. Min 6 caracteres, Max 12." required>
                  <span class="icon is-small is-left">
                    <i class="fas fa-key"></i>
                  </span>
                </div>
              </div><!--fecha field senha-->
              <div class="field is-grouped">
                  <div class="control">
                    <input class="button is-link" type="submit" name="login" value="Login">
                  </div>
                  <div class="control">
                    <input class="button is-text" type="reset" value="Limpar">
                  </div>
                </div>
              </div><!--fecha field buttons-->
            </form>
            <?php
          }
        }else{
        ?>
        <h1 class="title is-1">Bem vindo ao Vault of Memories!</h1>
        <h2 class="subtitle">Aqui você pode cadastrar seus personagens de D&D 5e em uma lista de fácil aceso.</h2>
      <?php }//fecha else
        if(isset($_POST['cadastrar'])){
          include_once "model/user.class.php";
          include_once "dao/userdao.class.php";
          include_once "util/utilities.class.php";

          //tratamento de erros
          $erros = array();
          if (!Utilities::validateUser($_POST['txtuser'])) {
            $erros[] = "Usuário inválido!";
          }
          if (!Utilities::validateEmail($_POST['txtemail'])) {
            $erros[] = "Email inválido!";
          }
          if($_POST['txtpass'] != $_POST['txtrpass']){
            $erros[] = "Senhas são diferentes!";
          }else{
            if (!Utilities::validatePass($_POST['txtpass'])) {
              $erros[] = "Senha inválida!";
            }
          }
          //envio de dados
          if(is_array($erros)){
            $er = count($erros);
          }else{
            $er = 0;
          }
          if ($er == 0) {
            $user = new User();
            $user->username = Utilities::padronizarUser($_POST['txtuser']);
            $user->email = Utilities::padronizarUser($_POST['txtemail']);
            $user->pass = Utilities::encrypt($_POST['txtpass']);

            $userDAO = new UserDAO();
            $userDAO->registerUser($user);

            $_SESSION['msg'] = "Usuário cadastrado com sucesso!";
            header("location:index.php?login=2");
          }else{
            //caso haja erros
            $_SESSION['erros'] = serialize($erros);
            $_SESSION['post'] = serialize($_POST);
            header("location:index.php?login=1");
          }
        }//fecha if cadastrar
        if(isset($_POST['login'])){
          include_once "model/user.class.php";
          include_once "dao/userdao.class.php";
          include_once "util/utilities.class.php";

          $u = new User();
          $u->username = Utilities::padronizarUser($_POST['txtuser']);
          $u->pass = Utilities::encrypt($_POST['txtpass']);

          $uDAO = new UserDAO();
          $usuario = $uDAO->logUser($u);

          if($usuario == null){
            echo "<h2 class='tile subtitle notification is-danger'>Usuário/senha inváido(s)!</h2>";
          }else{
            $_SESSION['privateUser'] = serialize($usuario);
            header("location:index.php");
          }
        }
        ?>
      </div>
    </div>
  </body>
</html>
