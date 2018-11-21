<?php
class User{
  private $idUser;
  private $username;
  private $email;
  private $password;

  public function __construct(){}
  public function __destruct(){}

  public function __get($a){return $this->$a;}
  public function __set($a,$v){$this->$a = $v;}

  public function __toString(){
    return nl2br("Usuário: $this->username
                  Email: $this->email
                  Senha: $this->password");
  }
}
