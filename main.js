var url = "bd/crud.php";
var appMoviles = new Vue({
    el: "#appMoviles",
    data: {
        moviles: [],
        marca: "",
        modelo: "",
        stock: "",
        total: 0
    },
    methods: {
        //botones
        btnAlta: async function() {
            const { value: formValues } = await Swal.fire({
                title: 'NUEVO',
                html: '<div class="row"><label class="col-sm-3 col-form-label">Marca</label><div class="col-sm-7"><input id="marca" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Modelo</label><div class="col-sm-7"><input id="modelo" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Stock</label><div class="col-sm-7"><input id="stock" type="number" min="0" class="form-control"></div></div>',
                focusConfirm: false,
                showCancelButton: true,
                confirmButtonText: 'Guardar',
                confirmButtonColor: '#1cc88a',
                cancelButtonColor: '#3085d6',
                preConfirm: () => {
                    return [
                        this.marca = document.getElementById('marca').value,
                        this.modelo = document.getElementById('modelo').value,
                        this.stock = document.getElementById('stock').value
                    ]
                }
            })
            if (this.marca == "" || this.modelo == "" || this.stock == 0) {
                Swal.fire({
                    type: 'info',
                    title: 'Datos incompletos',
                })
            } else {
                this.altaMovil(); //llamar la funcion para ingresar
                //mensaje para mostrar que fue agregado exitosamente
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                Toast.fire({
                    type: 'success',
                    title: 'Producto agregado'
                })
            }
        },
        btnEditar: async function(id, marca, modelo, stock) {
            //console.log...
            await Swal.fire({
                title: 'EDITAR',
                html: '<div class="row"><label class="col-sm-3 col-form-label">Marca</label><div class="col-sm-7"><input id="marca" value="' + marca + '" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Modelo</label><div class="col-sm-7"><input id="modelo" value="' + modelo + '" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Stock</label><div class="col-sm-7"><input id="stock" value="' + stock + '" type="number" min="0" class="form-control"></div></div>',
                focusConfirm: false,
                showCancelButton: true,
            }).then((result) => {
                if (result.value) {
                    //capturo los nuevos datos si es que los modificaron
                    marca = document.getElementById('marca').value,
                        modelo = document.getElementById('modelo').value,
                        stock = document.getElementById('stock').value,

                        this.editarMovil(id, marca, modelo, stock);
                    Swal.fire(
                        'Actualizado',
                        'El registro actualizo',
                        'success'
                    )
                }
            });

        },
        btnBorrar: function(id) {
            Swal.fire({
                title: 'Estas seguro de borrar el registro:' + id + "?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Borrar',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
            }).then((result) => {
                if (result.value) {
                    this.borrarMovil(id);
                    //y mostramos un msj sobre la eliminacion
                    Swal.fire(
                        'Eliminado',
                        'El registro ha sido borrado',
                        'success'
                    )
                }
            })
        },

        //procedimientos
        //listar
        listarMoviles: function() {
            axios.post(url, { opcion: 4 })
                .then(response => {
                    this.moviles = response.data;
                    /*    console.log(this.moviles); */
                })

        },
        //crear
        altaMovil: function() {
            axios.post(url, { opcion: 1, marca: this.marca, modelo: this.modelo, stock: this.stock })
                .then(response => {
                    this.listarMoviles();
                    /*    console.log(this.moviles); */
                });
            this.marca = "";
            this.modelo = "";
            this.stock = 0;

        },
        //editar
        editarMovil: function(id, marca, modelo, stock) {
            axios.post(url, { opcion: 2, id: id, marca: marca, modelo: modelo, stock: stock })
                .then(response => {
                    this.listarMoviles();

                });
        },
        //borrar
        borrarMovil: function(id) {
            axios.post(url, { opcion: 3, id: id })
                .then(response => {
                    this.listarMoviles();
                });
        },
    },
    created: function() {
        this.listarMoviles();
    },
    computed: {
        totalStock() {
            this.total = 0;
            for (movil of this.moviles) {
                this.total = this.total + parseInt(movil.stock);
            }
            return this.total;
        }
    }
}); //se llaman todas las caracteristicas de vuejs