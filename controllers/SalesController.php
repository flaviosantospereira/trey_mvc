<?php

class SalesController
{
    public function createSale()
    {
        $sale = new Sales;      
//        $now = new DateTime();
//        if($_POST > $now->format('Y-m-d'){

//        }  
        if($sale->store($_POST)){
            return $sale->message;
        }                
    }
}