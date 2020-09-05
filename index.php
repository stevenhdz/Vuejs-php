<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--fontawesome CSS 5.14.0-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <!--bootstrap CSS 4.5.2-->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!--Sweet alert 2 CSS 9.17.2-->
    <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
    <!--Custom-->
    <link rel="stylesheet" href="main.css">
</head>

<body>

    <header>
        <h2 class="text-center text-dark"><span class="badge badge-success">CRUD CON VUEJS</span></h2>
    </header>

    <div id="appMoviles">
        <div class="container">
            <div class="row">
                <div class="col">
                    <button @click="btnAlta" class="btn btn-success" title="Nuevo">
                        <i class="fas fa-plus-circle fa-2xs"></i>
                    </button>
                </div>
                <div class="col text-right">
                    <h5>Stock total: <span class="badge badge-success">{{totalStock}}</span></h5>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-12">
                    <table class="table table-striped">
                        <thead>
                            <tr class="bg-primary text-light">
                                <th>ID</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Stock</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(movil,indice) of moviles">
                                <td>{{movil.id}}</td>
                                <td>{{movil.marca}}</td>
                                <td>{{movil.modelo}}</td>
                                <td>
                                    <div class="col-md-8">
                                        <input type="number" v-model.number="movil.stock" class="form-control text-right" disabled>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-secondary" title="Editar" @click="btnEditar(movil.id,movil.marca, movil.modelo,  movil.stock)">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        <button class="btn btn-danger" title="Eliminar" @click="btnBorrar(movil.id)">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--jquery js 3.5.1-->
    <script src="jquery/jquery-3.5.1.min.js"></script>
    <!--popper js 2.4.4-->
    <script src="popper/popper.min.js"></script>
    <!--bootstrap js 4.5.2-->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!--vue js 2.6.12-->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <!--axios js 0.20.0-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.js" integrity="sha512-nqIFZC8560+CqHgXKez61MI0f9XSTKLkm0zFVm/99Wt0jSTZ7yeeYwbzyl0SGn/s8Mulbdw+ScCG41hmO2+FKw==" crossorigin="anonymous"></script>
    <!--Sweet alert 2 js 9.17.2-->
    <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <!--Custom-->
    <script src="main.js"></script>
</body>

</html>