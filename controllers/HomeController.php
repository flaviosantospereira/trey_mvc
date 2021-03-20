<?php

class HomeController extends Controller
{
    public function showHome(){
        return $this->view('home/home');
    }
}