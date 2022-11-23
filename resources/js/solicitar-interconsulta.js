import Alpine from "../libs/alpinejs/Alpine.js";
import selectEspecialidad from "./components/select-especialidad.js";

window.Alpine = Alpine;

$(document).on("alpine:init", function() {
    Alpine.store("_interconsultas", []);
    Alpine.store("loader", $("#loader"));

    Alpine.data("selectEspecialidad", selectEspecialidad);
    
    Alpine.data("listInterconsultas", () => ({
        today: new Date().toLocaleDateString('es-CO', { 
            weekday: 'long',
            year: 'numeric', 
            month: 'long', 
            day: 'numeric' 
        }),
        /**  @param {array} int */
        sortInterconsultasByEstado( int ){
            const t = { "PENDIENTE": 1, "REVISADO": 2, "CANCELADO": 3 };
            return int.sort((i, y) => t[ i.estado ] - t[ y.estado ]);
        },
        getClass( estado ){
            switch( estado ){ 
                case "PENDIENTE": 
                    return "border-secondary bg-white shadow";
                case "CANCELADO":
                    return "border-dark bg-opacity-25 shadow-sm bg-dark";
                case "REVISADO":
                default:
                    return "bg-success bg-opacity-25 border-success shadow-sm";
            }
        }
    }));
});

Alpine.start();