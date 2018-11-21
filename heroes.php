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
    <div class="section is-large">
      <div class="container">
        <div class="columns">
          <div class="column">
            <!-- first -->
            <figure class="image">
              <img class="" src="images\celestial_beings-700x385.jpg" alt="criação">
            </figure>
            <div class="content">
              <a href="create-hero.php" class="button is-dark is-large is-fullwidth">Criar um Herói</a>
            </div>
          </div>
          <div class="column">
            <!-- second -->
            <figure class="image">
              <img src="images\scag_header-970x544.jpg" alt="lista">
            </figure>
            <div class="content">
              <a href="search-hero.php" class="button is-dark is-large is-fullwidth">Lista de Heróis</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
