<?php
session_start();
ob_start();
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
        <form action="" method="post">
          <div class="field">
            <legend class="title">Criação de Personagem</legend>
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
            <label class="label">Nome do Personagem</label>
            <div class="control">
              <input class="input" type="text" name="txtname" value="<?php if(isset($dados)){echo $dados['txtname'];} ?>" placeholder="ex. Jim Darkmagic" pattern="^(([A-z'\-.]{2,50})+( [A-z'\-.]{2,50})?)+$" maxlength="50">
            </div>
            <div class="control">
              <label class="label">Sexo</label>
              <label class="radio">
                <input class="radio" type="radio" name="rdsex" value="Masculino" pattern="^(Masculino)$" required <?php if(isset($dados)): if($dados['rdsex'] == "Masculino"):?> checked="checked" <?php endif; endif; ?>>
                Masculino
              </label>
              <label class="radio">
                <input class="radio" type="radio" name="rdsex" value="Feminino" pattern="^(Feminino)$" <?php if(isset($dados)): if($dados['rdsex'] == "Feminino"): ?> checked="checked" <?php endif; endif; ?>>
                Feminino
              </label>
            </div>
            <div class="control">
              <label class="label">Raça</label>
              <div class="select">
                <?php
                if(isset($dados)){
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
                }
                ?>
                <select name="selrace">
                  <?php
                  if(isset($dados)){
                    foreach( $races as $var => $race): ?>
                    <option value="<?php echo $var ?>" <?php if($var == $dados['selrace']): ?> selected="selected" <?php endif; ?>><?php echo $race ?></option>
                    <?php endforeach;
                  }else{
                  ?>
                  <option value="">Escolha a raça</option>
                  <option value="Humano">Humano</option>
                  <option value="Anão">Anão</option>
                  <option value="Elfo">Elfo</option>
                  <option value="Halfling">Halfling</option>
                  <option value="Dragonborn">Dragonborn</option>
                  <option value="Gnomo">Gnomo</option>
                  <option value="Meio-elfo">Meio-elfo</option>
                  <option value="Meio-orc">Meio-orc</option>
                  <option value="Tielfling">Tiefling</option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="control">
              <label class="label">Classe</label>
              <div class="select">
                <?php
                if(isset($dados)){
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
                }
                ?>
                <select name="selclass">
                  <?php
                  if(isset($dados)){
                    foreach($classes as $var => $class): ?>
                    <option value="<?php echo $var ?>" <?php if($var == $dados['selclass']): ?> selected="selected" <?php endif; ?>><?php echo $class ?></option>
                    <?php endforeach;
                  }else{
                  ?>
                  <option value="">Escolha a classe</option>
                  <option value="Bárbaro">Bárbaro(Barbarian)</option>
                  <option value="Bardo">Bardo(Bard)</option>
                  <option value="Clérigo">Clérigo(Cleric)</option>
                  <option value="Druída">Druída(Druid)</option>
                  <option value="Lutador">Lutador(Fighter)</option>
                  <option value="Monge">Monge(Monk)</option>
                  <option value="Paladino">Paladino(Paladin)</option>
                  <option value="Patrulheiro">Patrulheiro(Ranger)</option>
                  <option value="Trapaceiro">Trapaceiro(Rogue)</option>
                  <option value="Feiticeiro">Feiticeiro(Sorcerer)</option>
                  <option value="Bruxo">Bruxo(Warlock)</option>
                  <option value="Mago">Mago(Wizard)</option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="control">
              <label class="label">Antecedência(Background)</label>
              <input class="input" type="text" name="txtbackground" value="<?php if(isset($dados)): echo $dados['txtbackground']; endif; ?>" placeholder="ex. Acolyte">
            </div>
            <div class="control">
              <label class="label">Origens</label>
              <textarea class="textarea" name="txtbackstory" placeholder="ex. Sua aldeia foi atacada por goblins e tomado por ódio ele se tornou um guerreiro[...]"><?php if(isset($dados)): echo $dados['txtbackstory']; endif; ?></textarea>
            </div>
          </div><!--FECHA FIELD-->
          <div class="field is-grouped">
            <div class="control">
              <input class="button is-link" type="submit" name="cadastrar" value="Cadastrar">
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
          If(isset($_POST['cadastrar'])){
            include_once "model/hero.class.php";
            include_once "dao/herodao.class.php";
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
            if(is_array($erros)){
              $er = count($erros);
            }else{
              $er = 0;
            }
            if($er == 0){
              $hero = new Hero();
              $hero->name = Utilities::padronizarInputs($_POST['txtname']);
              $hero->race = Utilities::padronizarInputs($_POST['selrace']);
              $hero->sex = Utilities::padronizarInputs($_POST['rdsex']);
              $hero->class = Utilities::padronizarInputs($_POST['selclass']);
              $hero->background = Utilities::padronizarInputs($_POST['txtbackground']);
              $hero->backstory = Utilities::padronizarTexto($_POST['txtbackstory']);

              $heroDAO = new HeroDAO();
              $heroDAO->registerHero($hero);

              //teste
              // echo "Personagem Cadastrado!<br>";
              // echo $hero;

              $_SESSION['msg'] = "Personagem cadastrado com sucesso!";
              header("location:create-hero.php");
            }else{
              //Caso haja erros
              $_SESSION['erros'] = serialize($erros);
              $_SESSION['post'] = serialize($_POST);
              header("location:create-hero.php");
            }
          }
        ?>
      </div><!--FECHA CONTAINER-->
    </div><!--FECHA SECTION-->
  </body>
</html>
