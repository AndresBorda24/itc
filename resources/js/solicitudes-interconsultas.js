import Alpine from "../libs/alpinejs/Alpine.js";
import selectEspecialidad from "./components/select-especialidad.js";

window.Alpine = Alpine;

$(document).on("alpine:init", function() {
    Alpine.store("loader", $("#loader"));
    Alpine.store("_interconsultas", []);

    Alpine.data("selectEspecialidad", selectEspecialidad);

    Alpine.data("listIntercosultas", () => ({
        today: new Date().toLocaleDateString('es-CO', { 
            weekday: 'long',
            year: 'numeric', 
            month: 'long', 
            day: 'numeric' 
        }),
        sortInterconsultasByEstado( int ){
            return int.sort((i, y) => {
                if (i.estado == "PENDIENTE") return -1;
                if (y.estado == "PENDIENTE") return 1;
    
                if (["CANCELADO", "REVISADO"].includes(i.estado)) return 1;
                return 1;
            });
        },
    }));

    Alpine.data("interconsulta", ( i ) => ({
        state: i,
        getClass(){
            switch (this.state.estado) {
                case "CANCELADO":
                case "REVISADO":
                    return "text-muted bg-secondary bg-opacity-25 text-decoration-line-through";
                case "PENDIENTE":
                    return "bg-white"
            }
        }
    }));
});

Alpine.start();