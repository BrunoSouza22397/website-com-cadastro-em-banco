<?php
require_once "config\conexaoBanco.class.php";
class DAO{

  private $conexao = null;

  public function __construct(){
    $this->conexao = ConexaoBanco::getInstance();
  }
  public function __destruct(){}
  /**********************************************/
  //-------------FUNÇÕES HERO-----------------//
  /*********************************************/
  public function registerHero($hero){
    try{
      $stat = $this->conexao->prepare(
        "insert into hero(idHero,name,race,sex,class,background,backstory) values(null,?,?,?,?,?,?)"
      );
      $stat->bindValue(1,$hero->name);
      $stat->bindValue(2,$hero->race);
      $stat->bindValue(3,$hero->sex);
      $stat->bindValue(4,$hero->class);
      $stat->bindValue(5,$hero->background);
      $stat->bindValue(6,$hero->backstory);
      $stat->execute();
    }catch(PDOException $e){
      echo "Erro ao cadastrar herói. ".$e;
    }
  }//fecha registerHero

  public function searchHero(){
    try{
      $stat = $this->conexao->query("select * from hero");
      $array = $stat->fetchAll(PDO::FETCH_CLASS,"Hero");
      return $array;
    }catch(PDOException $e){
      echo "Erro ao buscar personagem! ".$e;
    }
  }//fecha searchHero

  public function deleteHero($id){
    try {
      $stat = $this->conexao->prepare("delete from hero where idhero = ?");
      $stat->bindValue(1,$id);
      $stat->execute();
    } catch (PDOException $e) {
      echo "Erro ao excluir herói! ".$e;
    }
  }//fecha deleteHero

  public function filterHero($filter, $kwords){
    try {
      $query = "";
      switch($filter){
        case "name":
          $query = "where name like '%".$kwords."%'";
          break;
        case "race":
          $query = "where race like '%".$kwords."%'";
          break;
        case "sex":
          $query = "where sex like '%".$kwords."%'";
          break;
        case "class":
          $query = "where class like '%".$kwords."%'";
          break;
        case "background":
          $query = "where background like '%".$kwords."%'";
          break;
        case "id":
          $query = "where idhero = ".$kwords;
          break;
      }
      if(empty($kwords)){
        $query = "";
      }
      $stat = $this->conexao->query("select * from hero ".$query);
      $array = $stat->fetchAll(PDO::FETCH_CLASS, "Hero");
      return $array;
    } catch (PDOException $e) {
      echo "Erro ao filtrar! ".$e;
    }
  }//fecha filterHero

  public function editHero($hero){
    try {
      $stat = $this->conexao->prepare("update hero set name=?,race=?,sex=?,class=?,background=?,backstory=? where idhero=?");
      $stat->bindValue(1,$hero->name);
      $stat->bindValue(2,$hero->race);
      $stat->bindValue(3,$hero->sex);
      $stat->bindValue(4,$hero->class);
      $stat->bindValue(5,$hero->background);
      $stat->bindValue(6,$hero->backstory);
      $stat->execute();
    } catch (PDOException $e) {
      echo "Erro ao editar herói! ".$e;
    }
  }//fecha editHero
  /**********************************************************************/
  //------------------------FUNÇÕES USER-------------------------------//
  /**********************************************************************/
  public function registerUser($u){
    try {
      $stat = $this->conexao->prepare(
        "insert into user(iduser,username,email,password) values(null,?,?,?)"
      );
      $stat->bindValue(1,$u->username);
      $stat->bindValue(2,$u->email);
      $stat->bindValue(3,$u->password);
      $stat->execute();
    } catch (PDOException $e) {
      echo "Erro ao cadastrar! ".$e;
    }
  }//fecha registerUser

  public function logUser($u){
    try {
      $stat = $this->conexao->prepare(
        "select * from user where username = ? and pass = ?"
      );
      $stat->bindValue(1,$u->username);
      $stat->bindValue(2,$u->pass);
      $stat->execute();

      $usuario = null;
      $usuario = $stat->fetchObject('User');
      return $usuario;
    } catch (PDOException $e) {
      echo "Erro ao logar! ".$e;
    }
  }//fecha logUser
  /*******************************************************/
  //---------------------FUNÇÕES ITEM---------------------//
  /*******************************************************/
  public function registerItem($item){
    try{
      $stat = $this->conexao->prepare(
        "insert into item(idItem,name,rarity,type,isMagical,description) values(null,?,?,?,?,?)"
      );
      $stat->bindValue(1,$item->name);
      $stat->bindValue(2,$item->rarity);
      $stat->bindValue(3,$item->type);
      $stat->bindValue(4,$item->isMagical);
      $stat->bindValue(5,$item->description);
      $stat->execute();
    }catch(PDOException $e){
      echo "Erro ao cadastrar item. ".$e;
    }
  }//fecha registerItem

  public function searchItem(){
    try{
      $stat = $this->conexao->query("select * from item");
      $array = $stat->fetchAll(PDO::FETCH_CLASS,"Item");
      return $array;
    }catch(PDOException $e){
      echo "Erro ao buscar item! ".$e;
    }
  }//fecha searchItem

  public function deleteItem($id){
    try {
      $stat = $this->conexao->prepare("delete from item where iditem = ?");
      $stat->bindValue(1,$id);
      $stat->execute();
    } catch (PDOException $e) {
      echo "Erro ao excluir item! ".$e;
    }
  }//fecha deleteItem

  public function filterItem($filter, $kwords){
    try {
      $query = "";
      switch($filter){
        case "name":
          $query = "where name like '%".$kwords."%'";
          break;
        case "rarity":
          $query = "where rarity like '%".$kwords."%'";
          break;
        case "type":
          $query = "where type like '%".$kwords."%'";
          break;
        case "isMagical":
          $query = "where isMagical = ".$kwords;
          break;
        case "id":
          $query = "where iditem = ".$kwords;
          break;
      }
      if(empty($kwords)){
        $query = "";
      }
      $stat = $this->conexao->query("select * from item ".$query);
      $array = $stat->fetchAll(PDO::FETCH_CLASS, "Item");
      return $array;
    } catch (PDOException $e) {
      echo "Erro ao filtrar! ".$e;
    }
  }//fecha filterItem

  public function editItem($item){
    try {
      $stat = $this->conexao->prepare("update item set name=?,rarity=?,type=?,isMagical=?,description=? where iditem=?");
      $stat->bindValue(1,$item->name);
      $stat->bindValue(2,$item->rarity);
      $stat->bindValue(3,$item->type);
      $stat->bindValue(4,$item->isMagical);
      $stat->bindValue(5,$item->description);
      $stat->bindValue(6,$item->iditem);
      $stat->execute();
    } catch (PDOException $e) {
      echo "Erro ao editar item! ".$e;
    }
  }//fecha editItem
}//fecha class
