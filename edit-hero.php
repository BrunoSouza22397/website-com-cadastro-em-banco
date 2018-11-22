<?php
session_start();
ob_start();
if(isset($_GET['id'])){
  include_once "model/hero.class.php";
  include_once "dao/dao.class.php";
  $dao = new DAO();
  $array = $dao->filterHero("id",$_GET['id']);
  $hero = $array[0];
}else{
  $_SESSION['warning'] = "Escolha um personagem para alterar.";
  header("location:search-hero.php");
}
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
    <div class="section">
      <div class="container">
        <form name="editHero" action="" method="post">
          <div class="field">
            <legend class="title">Edição de Personagem</legend>
            <label class="label">Nome do Personagem</label>
            <?php
            //Mostra os erros
            if(isset($_SESSION['erros'])){
              $erros = unserialize($_SESSION['erros']);
              foreach($erros as $e){
                echo "<h3 class='tile subtitle notification is-danger'>".$e."</h3>";
              }
              unset($_SESSION['erros']);
            }
            //Insere valores anteriores em variavel para que sejam mostrados novamente nos inputs
            if(isset($_SESSION['post'])){
              $dados = unserialize($_SESSION['post']);
              unset($_SESSION['post']);
            }
            ?>
            <div class="control">
              <input class="input" type="text" name="txtname" value="<?php if(isset($hero)){ echo $hero->name;} ?>" placeholder="ex. Jim Darkmagic">
            </div>
            <div class="control">
              <label class="label">Sexo</label>
              <label class="radio">
                <input class="radio" type="radio" name="rdsex" value="Masculino" required <?php if(isset($hero)){if($hero->sex == "Masculino"){echo "checked='checked'";}} ?>>
                Masculino
              </label>
              <label class="radio">
                <input class="radio" type="radio" name="rdsex" value="Feminino" <?php if(isset($hero)){if($hero->sex == "Feminino"){echo "checked='checked'";}} ?>>
                Feminino
              </label>
            </div>
            <div class="control">
              <label class="label">Raça</label>
              <div class="select">
                <?php
                $races = array(
                  'Humano' => 'Humano',
                  'Anão' => 'Anão',
                  'Elfo' => 'Elfo',
                  'Halfling' => 'Halfling',
                  'Dragonborn' => 'Dragonborn',
                  'Gnomo' => 'Gnomo',
                  'Meio-elfo' => 'Meio-elfo',
                  'Meio-orc' => 'Meio-orc',
                  'Tiefling' => 'Tiefling'
                );
                ?>
                <select name="selrace">
                  <?php foreach( $races as $var => $race): ?>
                  <option value="<?php echo $var ?>" <?php if($var == $hero->race): ?> selected="selected" <?php endif; ?>><?php echo $race ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="control">
              <label class="label">Classe</label>
              <div class="select">
                <?php
                $classes = array(
                  'Bárbaro' => 'Bárbaro(Barbarian)',
                  'Bardo' => 'Bardo(Bard)',
                  'Clérigo' => 'Clérigo(Cleric)',
                  'Druída' => 'Druída(Druid)',
                  'Lutador' => 'Lutador(Fighter)',
                  'Monge' => 'Monge(Monk)',
                  'Paladino' => 'Paladino(Paladin)',
                  'Patrulheiro' => 'Patrulheiro(Ranger)',
                  'Trapaceiro' => 'Trapaceiro(Rogue)',
                  'Feiticeiro' => 'Feiticeiro(Sorcerer)',
                  'Bruxo' => 'Bruxo(Warlock)',
                  'Mago' => 'Mago(Mage)'
                );
                ?>
                <select name="selclass">
                  <?php foreach($classes as $var => $class): ?>
                  <option value="<?php echo $var ?>" <?php if($var == $hero->class): ?> selected="selected" <?php endif; ?>><?php echo $class ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="control">
              <label class="label">Antecedência(Background)</label>
              <input class="input" type="text" name="txtbackground" value="<?php echo $hero->background; ?>" placeholder="ex. Acolyte">
            </div>
            <div class="control">
              <label class="label">Origens</label>
              <textarea class="textarea" name="txtbackstory" placeholder="ex. Sua aldeia foi atacada por goblins e tomado por ódio ele se tornou um guerreiro[...]"><?php echo $hero->backstory; ?></textarea>
            </div>
          </div><!--FECHA FIELD-->
          <div class="field is-grouped">
            <div class="control">
              <input class="button is-link" type="submit" name="edit" value="Alterar">
            </div>
            <div class="control">
              <input class="button is-text" type="reset" value="Limpar">
            </div>
          </div><!--FECHA FIELD-->
        </form>
        <?php
          if(isset($_SESSION['msg'])){
            echo "<h2 class='tile title notification is-primary'>".$_SESSION['msg']."</h2>";
            unset($_SESSION['msg']);
          }
          If(isset($_POST['edit'])){
            include_once "model/hero.class.php";
            include_once "dao/dao.class.php";
            include_once "util/utilities.class.php";

            //Tratamento de erros
            $erros = array();
            if (!Utilities::validateName($_POST['txtname'])) {
              $erros[] = "Nome Inválido!";
            }
            if (!Utilities::validateSex($_POST['rdsex'])) {
              $erros[] = "Sexo inválido!";
            }
            if (!Utilities::validateRace($_POST['selrace'])) {
              $erros[] = "Raça inválida!";
            }
            if (!Utilities::validateClass($_POST['selclass'])) {
              $erros[] = "Classe Inválida!";
            }
            if (!Utilities::validateBackground($_POST['txtbackground'])) {
              $erros[] = "Antecedência inválida!";
            }
            if (!Utilities::validateBackstory($_POST['txtbackstory'])) {
              $erros[] = "Origem muito longa! Máx. 255 carácteres.";
            }

            //Envio de dados
            if(count($erros) == 0){
              $hero = new Hero();
              $hero->idHero = $_GET['id'];
              $hero->name = Utilities::padronizarInputs($_POST['txtname']);
              $hero->race = Utilities::padronizarInputs($_POST['selrace']);
              $hero->sex = Utilities::padronizarInputs($_POST['rdsex']);
              $hero->class = Utilities::padronizarInputs($_POST['selclass']);
              $hero->background = Utilities::padronizarInputs($_POST['txtbackground']);
              $hero->backstory = Utilities::padronizarTexto($_POST['txtbackstory']);

              $dao = new DAO();
              $dao->editHero($hero);

              //teste
              // echo "Personagem Cadastrado!<br>";
              // echo $hero;

              $_SESSION['msg'] = "Personagem alterado com sucesso!";
              header("location:search-hero.php");
            }
          }
        ?>
      </div><!--FECHA CONTAINER-->
    </div><!--FECHA SECTION-->
  </body>
</html>
