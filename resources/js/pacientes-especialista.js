import Alpine from "../libs/alpinejs/Alpine.js";
import apiUrl from "./extra/api-url.js";

window.Alpine = Alpine;

$(document).on("alpine:init", function () {
    Alpine.store("loader", $("#loader"));
    Alpine.store("_pacientes", []);
    /* Esta es para redireccionar al finalizar la reunion */
    Alpine.store("__url", apiUrl.substring(0, apiUrl.length - 4))

    Alpine.data("pacientes", (esp = "orto") => ({
        esp: esp,
        tab: 1,
        pac: null,
        mobile: true,
        async init() {
            await this.getPacientes();
        },
        async getPacientes() {
            try {
                this.$store.loader.toggle();
                const int = await $.get(`${apiUrl}/interconsultas-pendientes?esp=${this.esp}`);
                Alpine.store("_pacientes", int);
                this.pac = int[0];
            } catch (e) {
                Alpine.store("_pacientes", []); 
                if (e.responseJSON) {
                    e.message = e.responseJSON.message ?? 'Error prro';
                }
                console.error(e.message ?? 'Error prro');
            }
            this.$store.loader.toggle();
        },
        setPaciente( pac ) {
            this.pac = pac;
        },
        getEstado() {
            return this.pac.itc.estado;
        },
        cambiarEstado() {
            if (this.pac.itc.estado == "R") {
                this.pac.itc.estado = "P"; 
                return;
            }

            this.pac.itc.estado = "R";
            const i = Alpine.store("_pacientes").indexOf(this.pac);

            if (Alpine.store("_pacientes")[ i+1 ] !== undefined && !this.mobile) {
                this.pac = Alpine.store("_pacientes")[ i+1 ];
            }
            return;
        },
        /** (Solo mobole)*/ 
        next() {
            const i = Alpine.store("_pacientes").indexOf(this.pac);

            if (Alpine.store("_pacientes")[ i+1 ] !== undefined && this.mobile) {
                this.pac = Alpine.store("_pacientes")[ i+1 ];
            }
            return;
        },
        /** (Solo mobole)*/ 
        previous() {
            const i = Alpine.store("_pacientes").indexOf(this.pac);

            if (Alpine.store("_pacientes")[ i-1 ] !== undefined && this.mobile) {
                this.pac = Alpine.store("_pacientes")[ i-1 ];
            }
            return;
        }
    }));
});

Alpine.start();