import apiUrl from "../extra/api-url.js";

export default ( especialidades ) => ({
    esp: "",
    especialidades: especialidades,
    init() {
        this.$watch("esp", ( value ) => {
            this.getInterconsultas();
            Alpine.store("selectedEsp", value);
        });
        this.esp = Object.keys(this.especialidades)[0];
    },
    async getInterconsultas(){
        try {
            this.$store.loader.toggle();
            const int = await $.get(`${apiUrl}/interconsultas?esp=${this.esp}`);
            Alpine.store("_interconsultas", int);
        } catch (e) {
            Alpine.store("_interconsultas", []); 
            if(e.responseJSON) {
                e.message = e.responseJSON.message ?? 'Error prro';
            }
            console.error(e.message ?? 'Error prro');
        }
        this.$store.loader.toggle();
    }
});