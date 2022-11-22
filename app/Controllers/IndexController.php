<?php
namespace App\Controllers;
use App\Helpers\View;

class IndexController
{
     private array $especialidades = [
        "NUTR" => "Nutricion", 
        "ODMX" => "Odontologia Maxilofacial", 
        "OTOR" => "Otorrino Laringologia", 
        "OPTO" => "Optometria", 
        "PEDI" => "Pediatria"
    ];   

    public function index()
    {       
        View::load('index', [
            "especialidades" => $this->especialidades
        ]);
    }
}