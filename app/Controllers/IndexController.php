<?php
declare(strict_types=1);
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

    public function index( bool $isEsp = false)
    {       
        View::load('index', [
            "especialidades" => $this->especialidades,
            "role" => $isEsp ? "esp" : "urg",
            "isEsp" => $isEsp
        ]);
    }
}