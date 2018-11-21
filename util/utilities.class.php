<?php
class Utilities{
  //---------PADRONIZAÇÕES-----------
  public static function padronizarInputs($v){
    return ucwords(strtolower(htmlspecialchars(trim($v))));
  }
  public static function padronizarTexto($v){
    return ucfirst(strtolower(htmlspecialchars(trim($v))));
  }
  public static function padronizarUser($v){
    return htmlspecialchars(trim($v));
  }
  //----------SEGURANÇA---------------
  public static function encrypt($v){
    return md5('fire'.$v.'breath');
  }
  //----------VALIDAÇÕES--------------
  public static function validateName($v){
    $exp = "/^(([A-z'\-.]{2,50})( [A-z'\-.]{2,50})?){1}$/";
    if(strlen($v) > 50){
      return false;
    }else{
      return preg_match($exp,$v);
    }
  }
  public static function validateSex($v){
    $exp = "/^(Masculino|Feminino)$/";
    return preg_match($exp,$v);
  }
  public static function validateRace($v){
    $exp = "/^(Humano|Anão|Elfo|Halfling|Dragonborn|Gnomo|Meio\-elfo|Meio\-orc|Tielfling)$/";
    return preg_match($exp,$v);
  }
  public static function validateClass($v){
    $exp = "/^(Bárbaro|Bardo|Clérigo|Druída|Lutador|Monge|Paladino|Patrulheiro|Trapaceiro|Feiticeiro|Bruxo|Mago)$/";
    return preg_match($exp,$v);
  }
  public static function validateBackground($v){
    $exp = "/^(([\w'\-.]{2,20})( [\w'\-.]{2,20})?){1}$/";
    if(strlen($v) > 20){
      return false;
    }else{
      return preg_match($exp,$v);
    }
  }
  public static function validateBackstory($v){
    if(strlen($v) > 255){
      return false;
    }else{
      return true;
    }
  }
  public static function validateUser($v){
    $exp = "/^[\w.-]{4,20}$/";
    return preg_match($exp,$v);
  }
  public static function validateEmail($v){
    return filter_var($v, FILTER_VALIDATE_EMAIL);
  }
  public static function validatePass($v){
    $exp = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{6,12}$/";
    return preg_match($exp,$v);
  }
}//fecha classe
