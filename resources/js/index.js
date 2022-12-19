import Alpine from "../libs/alpinejs/Alpine.js";
import selectEspecialidad from "./components/select-especialidad.js";

window.Alpine = Alpine;

$(document).on("alpine:init", function() {
    Alpine.store("_interconsultas", []);
    Alpine.store("loader", $("#loader"));

    Alpine.data("selectEspecialidad", selectEspecialidad);
    
    Alpine.data("listInterconsultas", () => ({
        type: "P",
        df: new Intl.DateTimeFormat('es-CO', { 
            weekday: 'long',
            year: 'numeric', 
            month: 'long', 
            day: 'numeric' 
        }),
        /**  @param {array} int */
        sortInterconsultasByEstado( int ){
            const t = { "P": 1, "R": 2 };
            return int
                .filter( el => (el.itc.estado == this.type) )
                .sort((i, y) => t[ i.itc.estado ] - t[ y.itc.estado ]);
        },
        /** @param {string} estado */
        getClass( estado ){
            switch( estado ){ 
                case "P": 
                    return "text-bg-dark text-light";
                case "R":
                default:
                    return "text-bg-success text-light";
            }
        },
        /** @param {string} estado */ 
        getEstadoText( estado ) {
            switch( estado ){ 
                case "P": 
                    return "Pendiente";
                case "R":
                    return "Revisado";
            }
        }
    }));
});

Alpine.start();