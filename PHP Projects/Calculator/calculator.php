<?php
class Calculator {
    public function add($a, $b) {
    // TODO: returnează suma
        $rezultat = $a + $b;
        echo $rezultat . "\n";
    }
    public function sub($a, $b) {
    // TODO: scădere
        $rezultat = $a - $b;
        echo $rezultat . "\n";
    }
    public function mul($a, $b) {
    // TODO: înmulțire
        $rezultat = $a * $b;
        echo $rezultat . "\n";
    }
    public function div($a, $b) {
        if($b == 0)
            echo "Nu putem imparti la 0";
        else{
            $rezultat = $a / $b;
            echo $rezultat . "\n";            
        }
    // TODO: tratează cazul b == 0
    }
}
    $calc = new Calculator();

    $calc -> add(2,3);
    $calc -> sub(10,4);
    $calc -> mul(6,7);
    $calc -> div(8,2);
    $calc -> div(8,0);