<?php
require_once "config\conexaoBanco.class.php";
class HeroDAO{

  private $conexao = null;

  public function __construct(){
    $this->conexao = ConexaoBanco::getInstance();
  }
  public function __destruct(){}

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
}//fecha class
