import Alpine from "../libs/alpinejs/Alpine.js";
import apiUrl from "./extra/api-url.js";

window.Alpine = Alpine;

$(document).on("alpine:init", function () {
    Alpine.store("loader", $("#loader"));
    Alpine.store("_interconsultas", []);

    Alpine.data("pacientes", (esp) => ({
        esp: esp,
        modal: $("#mostrar-pacientes"),
        onlyPend: true,
        // Solamente para "quemar" la fecha en el código
        today: new Date().toLocaleDateString('es-CO', { 
            weekday: 'long',
            year: 'numeric', 
            month: 'long', 
            day: 'numeric' 
        }),
        async init() {
            await this.getInterconsultas();
        },
        /** @param {array} int interconsultas */
        manageSort(int) {
            if (this.onlyPend) {
                return this.soloPendientes(int);
            }
            return this.sortInterconsultasByEstado(int);
        },
        /** @param {array} int interconsultas */
        soloPendientes(int) {
            return int.filter(int => (int.estado == "PENDIENTE"));
        },
        /** @param {array} int interconsultas */
        sortInterconsultasByEstado(int) {
            return int.sort((i, y) => {
                if (i.estado == "PENDIENTE") return -1;
                if (y.estado == "PENDIENTE") return 1;
    
                if (["CANCELADO", "REVISADO"].includes(i.estado)) return 1;
                return 1;
            });
        },
        manageShow() {
            $("body").toggleClass("overflow-hidden");
            this.modal.fadeToggle("fast");
        },
        async getInterconsultas() {
            try {
                this.$store.loader.toggle();
                const int = await $.get(`${apiUrl}/interconsultas?esp=${this.esp}`);
                Alpine.store("_interconsultas", int);
            } catch (e) {
                Alpine.store("_interconsultas", []); 
                if (e.responseJSON) {
                    e.message = e.responseJSON.message ?? 'Error prro';
                }
                console.error(e.message ?? 'Error prro');
            }
            this.$store.loader.toggle();
        }
    }));
});

Alpine.start();