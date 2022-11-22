<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Helpers\View;

class EspecialistasController
{
    private array $especialidades = [
        "NUTR" => "Nutricion", 
        "ODMX" => "Odontologia Maxilofacial", 
        "OTOR" => "Otorrino Laringologia", 
        "OPTO" => "Optometria", 
        "PEDI" => "Pediatria"
    ];

    public function index(): void
    {
        View::load("especialistas", [
            "especialidades" => $this->especialidades
        ]);
    }
}