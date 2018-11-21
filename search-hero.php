<?php
  session_start();
  ob_start();
  include_once "model/hero.class.php";
  include_once "dao/herodao.class.php";

  $heroDAO = new HeroDAO();

  $array = $heroDAO->searchHero();
  //só para teste
  // var_dump($array);
?>
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
            <a class="button is-primary" href="index.php?login=1">
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
        <h1 class="title">Gerenciamento de Heróis</h1>
        <h2 class="subtitle">Consulte, altere e apague heróis da sua lista.</h2>
        <?php
          // Alerta caso usuario entre na edição sem escolher  um heroi
          if(isset($_SESSION['warning'])): ?>
        <h1 class="tile title notification is-warning"><?php echo $_SESSION['warning']; unset($_SESSION['warning']); ?></h1>
        <?php endif;
          // Alerta caso retorno do banco seja vazio.
          if(isset($array)){
            if(count($array) == 0){
              echo "<h2 class='subtitle tile notification is-warning'>Não há heróis no banco de dados!</h2>";
              return;
            }
          }
        ?>
        <form class="" name="filtro" action="" method="post">
          <div class="field is-grouped">
            <div class="control">
              <input type="text" class="input" name="txtkwords" placeholder="Digite sua pesquisa...">
            </div>
            <div class="control select">
              <select class="" name="selfilter">
                <option value="Todos">Todos</option>
                <option value="name">Nome</option>
                <option value="race">Raça</option>
                <option value="sex">Sexo</option>
                <option value="class">Classe</option>
                <option value="background">Antecedência</option>
              </select>
            </div>
          </div><!--fecha field-->
          <div class="field">
            <div class="control">
              <input type="submit" class="button is-primary" name="filter" value="Filtrar">
            </div>
          </div><!--fecha field-->
        </form>
        <?php
        if(isset($_POST['filter'])){
          $heroDAO = new HeroDAO();
          $array = $heroDAO->filterHero($_POST['selfilter'], $_POST['txtkwords']);
          if (count($array) == 0) {
            echo "<h2 class='subtitle tile notification is-warning'>Sua pesquisa não retornou resultados</h2>";
            return;
          }
        }
        ?>
        <!--termina filtro-->
        <div class="has-scroll">
          <table class="table is-striped">
            <thead>
              <tr>
                <th>Alterar</th>
                <th>Excluir</th>
                <th>Nome</th>
                <th>Raça</th>
                <th>Sexo</th>
                <th>Classe</th>
                <th>Antecedência</th>
                <th>Origens</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Alterar</th>
                <th>Excluir</th>
                <th>Nome</th>
                <th>Raça</th>
                <th>Sexo</th>
                <th>Classe</th>
                <th>Antecedência</th>
                <th>Origens</th>
              </tr>
            </tfoot>
            <tbody>
              <?php
                foreach ($array as $hero) {
                  echo "<tr>";
                    echo "<td><a href='edit-hero.php?id=$hero->idHero' class='button is-warning'>Alterar</a></td>";
                    echo "<td><a href='search-hero.php?id=$hero->idHero' class='button is-danger'>Excluir</a></td>";
                    echo "<td>$hero->name</td>";
                    echo "<td>$hero->race</td>";
                    echo "<td>$hero->sex</td>";
                    echo "<td>$hero->class</td>";
                    echo "<td>$hero->background</td>";
                    echo "<td>$hero->backstory</td>";
                  echo "</tr>";
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <?php
    if(isset($_GET['id'])){
      $heroDAO = new HeroDAO();
      $heroDAO->deleteHero($_GET['id']);
      header("location:search-hero.php");
    }
    ?>
  </body>
</html>
