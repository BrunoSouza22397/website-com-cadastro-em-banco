<?php
require_once "config\conexaoBanco.class.php";
class UserDAO{
  private $conexao = null;

  public function __construct(){
    $this->conexao = ConexaoBanco::getInstance();
  }
  public function __destruct(){}

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
}
