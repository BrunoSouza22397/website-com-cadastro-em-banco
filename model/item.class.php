<?php
class Item{
  private $idItem;
  private $name;
  private $rarity;
  private $type;
  private $isMagical;
  private $desciption;

  public function __construct(){}
  public function __destruct(){}
  public function __get($a){return $this->$a;}
  public function __set($a, $v){$this->$a = $v;}
  public function __toString(){
    return nl2br("ID: $this->idItem
                  Nome: $this->name
                  Raridade: $this->rarity
                  Tipo: $this->type
                  Mágico? $this->isMagical
                  Descrição: $this->description");
  }
}
