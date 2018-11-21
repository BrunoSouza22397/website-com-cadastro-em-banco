<?php
class Hero{
  private $name;
  private $race;
  private $sex;
  private $class;
  private $background;
  private $backstory;

  public function __construct(){}
  public function __destruct(){}
  public function __get($a){return $this->$a;}
  public function __set($a, $v){$this->$a = $v;}
  public function __toString(){
    return nl2br("Nome: $this->name
                  Raça: $this->race
                  Sexo: $this->sex
                  Classe: $this->class
                  Antecedencia: $this->background
                  História: $this->backstory");
  }
}
