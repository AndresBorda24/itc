import Alpine from "../libs/alpinejs/Alpine.js";
import selectEspecialidad from "./components/select-especialidad.js";
import apiUrl from "./extra/api-url.js";

window.Alpine = Alpine;

$(document).on("alpine:init", function() {
    Alpine.store("interconsultas", {});
    Alpine.store("loader", $("#loader"));

    Alpine.data("selectEspecialidad", selectEspecialidad);
    
    Alpine.data("listInterconsultas", () => ({
        today: new Date().toLocaleDateString('es-CO', { 
            weekday: 'long',
            year: 'numeric', 
            month: 'long', 
            day: 'numeric' 
        }),
        async init() {
            try {
                this.$store.loader.toggle();
                const res = await $.get(`${apiUrl}/interconsultas-full`);
                Alpine.store("interconsultas", this.settleInterconsultas(res));
            } catch (error) {
                console.error(error);
            }
            this.$store.loader.toggle();
        },
        /**  @param {array} i */
        settleInterconsultas( i ) {
            const a = i.reduce( (a, c) => {
                if (! (c.especialidad_cod in a) ) {
                    a[ c.especialidad_cod ] = { 
                        i: [],
                        nombre: c.nombre,
                        esp_cod: c.especialidad_cod.toLowerCase()
                    };
                }
                // La propiedad i guarda todas las interconsultas
                a[ c.especialidad_cod ].i.push(c);
                return a;
            }, {});
            console.log(a);
            return a;
        },
        /**  @param {array} int */
        sortInterconsultasByEstado( int ){
            return int.sort((i, y) => {
                if (i.estado == "PENDIENTE") return -1;
                if (y.estado == "PENDIENTE") return 1;
    
                if (["CANCELADO", "REVISADO"].includes(i.estado)) return 1;
                return 1;
            });
        },
    }));
});

Alpine.start();