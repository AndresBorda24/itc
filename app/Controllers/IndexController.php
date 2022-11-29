<?php
declare(strict_types=1);
namespace App\Controllers;
use App\Helpers\View;

class IndexController
{
    private array $especialidades = [
        "ORTO" => "Ortopedia", 
        "NEUR" => "Neurologia", 
        "CPL" => "Cirugia Plastica", 
        "RAD" => "Radiologia"
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