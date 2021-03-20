<?php

class SalesController
{
    public function createSale()
    {
        $sale = new Sales;        
        $sale->store($_POST);
        if($sale->store($_POST)){
            return $sale->message;
        }                
    }
}