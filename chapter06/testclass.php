<?php
class A {
  
  public static function whichclass() {
    echo __CLASS__;
  }

  public static function test() {
    static::whichclass();
  }
}


class B extends A {
  public static function whichclass() {
    echo __CLASS__;
  }
}

A::test();
B::test();
?>
