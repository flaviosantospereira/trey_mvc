<?php

class SalesmanController
{
    public function createList()
    {
        $salesman = new Salesman;
        $salesman->list($_GET);
    }
}