<?php

declare(strict_types=1);

namespace App\Controllers\Api;

use App\Helpers\Response;

class InterconsultasController
{
    private array $interconsultas;
    private array $especialidades = [
        "NUTR" => "Nutricion", 
        "ODMX" => "Odontologia Maxilofacial", 
        "OTOR" => "Otorrino Laringologia", 
        "OPTO" => "Optometria", 
        "PEDI" => "Pediatria"
    ];

    public function __construct()
    {
        $this->interconsultas = json_decode(
            '[{"id":"637cd51d61040194e3fc9145","fecha":"2022-02-24T10:11:24.957Z","estado":"PENDIENTE","paciente":{"edad":90,"nombre":"Parsons May Petersen Todd","documento":44358},"observacion":"Aliquip pariatur ad anim duis id amet commodo.","nombre_medico":"Madge Iris Steele Gregory","especialidad_cod":"PEDI"},{"id":"637cd51db45f8fdb005d9d74","fecha":"2022-02-24T17:41:21.546Z","estado":"CANCELADO","paciente":{"edad":90,"nombre":"Fletcher Pam Simpson Dennis","documento":22008},"observacion":"Esse et ea anim proident et reprehenderit quis exercitation sunt velit occaecat consectetur.","nombre_medico":"Yang Sutton Hamilton Reyes","especialidad_cod":"OTOR"},{"id":"637cd51d597b03165b15c65d","fecha":"2022-02-24T20:08:10.777Z","estado":"REVISADO","paciente":{"edad":82,"nombre":"Nikki Manuela Wise Marshall","documento":44625},"observacion":"In ea sunt irure amet in culpa consectetur ex occaecat aliqua in nulla aute sit.","nombre_medico":"Orr Stuart Merritt Sellers","especialidad_cod":"NUTR"},{"id":"637cd51da13b7a3646606429","fecha":"2022-02-24T16:52:16.794Z","estado":"REVISADO","paciente":{"edad":4,"nombre":"Whitfield Laverne Estrada Schmidt","documento":37279},"observacion":"Aute mollit magna et esse aute elit dolore.","nombre_medico":"Ingrid Susan Alexander Cervantes","especialidad_cod":"ODMX"},{"id":"637cd51d57161656e89eadcf","fecha":"2022-02-24T04:18:35.896Z","estado":"PENDIENTE","paciente":{"edad":89,"nombre":"Burt Carly Chase Cohen","documento":29452},"observacion":"Aute tempor qui do ex enim.","nombre_medico":"Lenore April French Pena","especialidad_cod":"NUTR"},{"id":"637cd51dc8256e8f47bbe775","fecha":"2022-02-24T01:20:32.553Z","estado":"PENDIENTE","paciente":{"edad":22,"nombre":"Luz Allison Moore Chavez","documento":92863},"observacion":"Nostrud aute aute pariatur magna incididunt veniam commodo proident eiusmod cillum duis mollit.","nombre_medico":"Mason Huber Burton Ball","especialidad_cod":"NUTR"},{"id":"637cd51d4cfd6437b179d84e","fecha":"2022-02-24T20:29:24.594Z","estado":"CANCELADO","paciente":{"edad":6,"nombre":"Woodward Tami Oneil Olsen","documento":66245},"observacion":"Duis excepteur aliqua culpa commodo consequat elit minim cillum cillum duis cillum pariatur.","nombre_medico":"Natasha Rosemarie Mcclure Lyons","especialidad_cod":"ODMX"},{"id":"637cd51d5259b9a723885ebf","fecha":"2022-02-24T14:32:05.340Z","estado":"PENDIENTE","paciente":{"edad":58,"nombre":"Stephenson Mayra Shaw Combs","documento":31892},"observacion":"Anim culpa do eiusmod voluptate et labore enim laboris dolor duis veniam dolore eu.","nombre_medico":"Mccoy Kirkland Witt Noel","especialidad_cod":"OTOR"},{"id":"637cd51dcc1c0216233b65a3","fecha":"2022-02-24T17:36:06.819Z","estado":"CANCELADO","paciente":{"edad":35,"nombre":"Bright Ernestine Wilcox Bruce","documento":88408},"observacion":"Reprehenderit est commodo ea ipsum enim elit consequat nostrud occaecat eu ea fugiat veniam.","nombre_medico":"Verna Craft Blevins Black","especialidad_cod":"NUTR"},{"id":"637cd51dd6b65ceff3f7a4c3","fecha":"2022-02-24T19:59:53.809Z","estado":"REVISADO","paciente":{"edad":43,"nombre":"Clark Bernadine Burns Solomon","documento":39849},"observacion":"Ipsum nostrud adipisicing magna proident excepteur sit enim laboris in nostrud eu elit reprehenderit.","nombre_medico":"Owen Moody Beck Hardy","especialidad_cod":"NUTR"},{"id":"637cd51d04231a6c2887c684","fecha":"2022-02-24T13:22:13.977Z","estado":"REVISADO","paciente":{"edad":82,"nombre":"Gilliam Maria Fowler Cross","documento":99587},"observacion":"Lorem nulla nisi amet id velit.","nombre_medico":"Sharpe Darla Perez Stephens","especialidad_cod":"NUTR"},{"id":"637cd51d368f24598ec083a3","fecha":"2022-02-24T09:11:31.882Z","estado":"REVISADO","paciente":{"edad":43,"nombre":"Chambers Kris Riggs Brock","documento":80941},"observacion":"Aute fugiat ad eu excepteur nostrud reprehenderit adipisicing adipisicing esse fugiat.","nombre_medico":"Taylor Ginger Richmond House","especialidad_cod":"NUTR"},{"id":"637cd51d446d4d60bbaf9f9d","fecha":"2022-02-24T13:31:42.210Z","estado":"PENDIENTE","paciente":{"edad":14,"nombre":"Socorro Ruth Guy Osborn","documento":86910},"observacion":"Nulla veniam excepteur eu laborum nulla anim nulla.","nombre_medico":"Stevenson Flynn Holcomb Fuentes","especialidad_cod":"OTOR"},{"id":"637cd51d380d73919335f652","fecha":"2022-02-24T02:02:48.994Z","estado":"CANCELADO","paciente":{"edad":61,"nombre":"Kemp Valenzuela Horton Jackson","documento":71774},"observacion":"Et cillum ipsum culpa ut.","nombre_medico":"Leigh Joy Morales Berger","especialidad_cod":"PEDI"},{"id":"637cd51d4c730994bd4664ec","fecha":"2022-02-24T07:15:38.896Z","estado":"PENDIENTE","paciente":{"edad":16,"nombre":"Pat Mavis Chang Aguilar","documento":42021},"observacion":"Incididunt ad proident consectetur qui ad ad veniam Lorem qui non consectetur.","nombre_medico":"Cunningham Rosemary Grant Meyer","especialidad_cod":"OTOR"},{"id":"637cd51db06b23fd41e63871","fecha":"2022-02-24T22:37:20.449Z","estado":"CANCELADO","paciente":{"edad":2,"nombre":"Jones Madeline Bolton Guthrie","documento":55754},"observacion":"Irure commodo laborum do in do.","nombre_medico":"Winifred Price Alvarado Welch","especialidad_cod":"OTOR"},{"id":"637cd51de5af6a2cf1fae29d","fecha":"2022-02-24T16:26:20.407Z","estado":"PENDIENTE","paciente":{"edad":19,"nombre":"Lynda Fay Short Gutierrez","documento":56344},"observacion":"In sunt dolore velit ut amet eiusmod ad magna velit ad enim pariatur exercitation officia.","nombre_medico":"Sheppard Puckett Vaughan Faulkner","especialidad_cod":"ODMX"},{"id":"637cd51d643dfdc16fe39e9e","fecha":"2022-02-24T09:39:23.757Z","estado":"CANCELADO","paciente":{"edad":76,"nombre":"Juana Curtis Boyer Malone","documento":76682},"observacion":"Veniam mollit consectetur voluptate enim excepteur nulla pariatur tempor sint.","nombre_medico":"Nellie Lydia Freeman Cain","especialidad_cod":"OTOR"},{"id":"637cd51d6bab42b095469eb1","fecha":"2022-02-24T22:09:15.349Z","estado":"REVISADO","paciente":{"edad":46,"nombre":"Schultz Osborne Nolan Hodges","documento":22129},"observacion":"Qui esse elit officia aute laboris incididunt consectetur aliqua enim quis nostrud deserunt do do.","nombre_medico":"Jody Katelyn Byers Huff","especialidad_cod":"PEDI"},{"id":"637cd51db319ea12e10a8a03","fecha":"2022-02-24T22:18:19.515Z","estado":"REVISADO","paciente":{"edad":36,"nombre":"Zamora Irma Stein Macdonald","documento":50538},"observacion":"Veniam aliqua id non amet proident.","nombre_medico":"Mendez Hawkins Davis Salazar","especialidad_cod":"OTOR"},{"id":"637cd51d24b68540238424d3","fecha":"2022-02-24T09:49:45.372Z","estado":"CANCELADO","paciente":{"edad":24,"nombre":"Joseph Hutchinson Carson Lynn","documento":44326},"observacion":"Pariatur est reprehenderit ipsum quis veniam laboris aliqua commodo commodo aliqua do ullamco laboris.","nombre_medico":"Abigail Lee Hardin Barrett","especialidad_cod":"OTOR"},{"id":"637cd51d686ec2ca06a29a15","fecha":"2022-02-24T19:52:19.088Z","estado":"REVISADO","paciente":{"edad":16,"nombre":"Alyson Brigitte Roy Gill","documento":22127},"observacion":"Pariatur irure ex sit deserunt veniam eiusmod officia.","nombre_medico":"Sheri Watkins Rollins Wheeler","especialidad_cod":"NUTR"},{"id":"637cd51d098387d0dcce0117","fecha":"2022-02-24T19:06:47.992Z","estado":"REVISADO","paciente":{"edad":83,"nombre":"Rosanna Sherman Armstrong Ortiz","documento":54348},"observacion":"Cillum consectetur dolore aliqua in consequat nulla amet consectetur et non.","nombre_medico":"Perez Brady Donovan Stewart","especialidad_cod":"OTOR"},{"id":"637cd51d72f423df37459360","fecha":"2022-02-24T07:34:34.058Z","estado":"CANCELADO","paciente":{"edad":8,"nombre":"Elisa Browning Langley Wyatt","documento":67497},"observacion":"Sunt ex duis non anim magna voluptate ea consequat mollit qui duis consectetur.","nombre_medico":"Francis Pennington Mercado Rogers","especialidad_cod":"OPTO"},{"id":"637cd51d4bd3f15d5c87dc67","fecha":"2022-02-24T07:09:18.617Z","estado":"REVISADO","paciente":{"edad":11,"nombre":"Petersen Eva Mckinney Kinney","documento":63470},"observacion":"Lorem mollit officia in laboris culpa.","nombre_medico":"Leblanc Herrera Porter Gilmore","especialidad_cod":"OPTO"},{"id":"637cd51ddd720b603e37dcc5","fecha":"2022-02-24T01:58:07.886Z","estado":"REVISADO","paciente":{"edad":7,"nombre":"Winters Rivera Baxter Booth","documento":55010},"observacion":"Irure Lorem cupidatat eiusmod ea ad.","nombre_medico":"Espinoza Shirley Brady Farley","especialidad_cod":"OTOR"}]',
            true
        );
    }

    public function getInterconsultas(): void
    {
        try {
            if (!isset($_GET["esp"])) {
                throw new \RuntimeException("No se encontró el parametro {esp}.");
            }


            $espCod = $_GET["esp"];
            $esps = array_filter($this->interconsultas, fn ($in) => ($in["especialidad_cod"] == $espCod));
            
            Response::json(array_values($esps));
        } catch (\Throwable $e) {
            Response::jsonError($e->getMessage());
        }
    }

    public function getInterconsultasFull(): void
    {
        $inte = array_map( 
            fn($el) => array_merge($el, array("nombre" => $this->especialidades[$el["especialidad_cod"]])),
            $this->interconsultas
        );

        Response::json($inte);
    }
    
}
