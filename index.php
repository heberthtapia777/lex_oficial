<?php
//include "admin/inc/conexion.php";
require 'admin/inc/sessionControlIndex.php';
?>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="ie=edge" http-equiv="X-UA-Compatible">
        <!-- Bootstrap CSS -->
        <link href="images/logo-pwc.ico" rel="shortcut icon" type="image/x-icon"/>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/mdb.css" rel="stylesheet">
        <link href="fontawesome/css/fontawesome.css" rel="stylesheet">
        <link href="fontawesome/css/all.css" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap5.min.css"/>
        <link rel="stylesheet" type="text/css" href="admin/vendors/datatables/css/buttons.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="admin/vendors/datatables/css/jquery-ui-1.10.4.custom.css">

        <link href="css/style.css" rel="stylesheet">
        <title>Proyecto LEX</title>
    </head>
    <body>
        <!-- Navbar burger on large screens items right-->
        <nav class="navbar navbar navbar-light bg-light scrolling-navbar fixed-top">
            <div class="d-flex justify-content-start">
                <img class="img-fluid rounded mr-2 ml-3" height="auto" src="images/logo_pwc.png" width="80">
                    <a alt="logo PwC" class="navbar-brand ml-2 my-2" href="index">
                        | Lex Legislacion  Express
                    </a>
                </img>
            </div>
            <!-- Search form -->
            <form class="form-inline d-flex justify-content-end md-form form-md my-2">
                <i aria-hidden="true" class="fas fa-search">
                </i>
                <input aria-label="Search" class="form-control form-control-lg ml-3 w-75" placeholder="Buscar" type="text">
                </input>
            </form>
            <!-- Form -->
            <button aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler " data-target="#navbarNavDropdown" data-toggle="collapse" type="button">
                <span class="navbar-toggler-icon">
                </span>
                <span class="hoverme">Menu</span>
            </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">

          <ul class="navbar-nav ml-auto">
            <li class="nav-item ml-auto mr-3">
              <a class="nav-link hoverme" href="index">Inicio <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown ml-auto mr-3">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Quienes somos
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item hoverme" href="quienes-somos">Lex - Legislacion express</a>
              </div>
            </li>
            <li class="nav-item dropdown ml-auto mr-3">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Servicios legales
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item hoverme" href="tax-litigation">Tax litigation</a>
                <a class="dropdown-item hoverme" href="Compliance-societario-integral">Compliance societario integral</a>
                <a class="dropdown-item hoverme" href="Servicio-de-informacion-normativa-y-capacitacion">Servicio de informacion normativa y capacitacion</a>
                <a class="dropdown-item hoverme" href="Consultoria-laboral-y-de-seguridad-social">Consultoria laboral y de seguridad social</a>
                <a class="dropdown-item hoverme" href="LEX-legislacion-express">LEX - legislacion express</a>
                <a class="dropdown-item hoverme" href="Asignaciones-internacionales">Asignaciones internacionales</a>
              </div>
            </li>
            <li class="nav-item ml-auto mr-3">
              <a class="nav-link hoverme" href="https://www.pwc.com/bo/es.html" target="blank">PWC - Bolivia</a>
            </li>
            <li class="nav-item ml-auto mr-3">
              <a class="nav-link hoverme" href="https://www.pwc.com/bo/es/servicios/asesoramiento-tributario.html" target="blank">PWC - Tax & Legal</a>
            </li>
            <li class="nav-item ml-auto mr-3">
              <a class="nav-link hoverme" href="#">Nuestro equipo</a>
            </li>
            <li class="nav-item dropdown ml-auto mr-3">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Contactos
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item hoverme" href="ubicacion-la-paz">Ubicacion La Paz</a>
                <a class="dropdown-item hoverme" href="ubicacion-santa-cruz">Ubicacion Santa Cruz</a>
              </div>
            </li>
          </ul>
        </div>
        </nav>
        <!-- Navbar burger on large screens right -->
        <section class="carrusel">
            <!--Carousel Wrapper-->
            <div class="carousel slide carousel-fade" data-ride="carousel" id="carousel-example-2">
                <!--Indicators-->
                <ol class="carousel-indicators">
                <?php
                    $c=0;
                    $sql = "SELECT * FROM banner WHERE status = 1 ORDER BY (id) DESC";
                    $query = $db->Execute($sql);
                    while ($reg = $query->FetchRow()) {
                ?>
                    <li class="<?=($c == 0) ? 'active' : '';?>" data-slide-to="<?=$c;?>" data-target="#carousel-example-2"></li>
                <?php
                    $c++;
                }
                ?>
                </ol>
                <!--/.Indicators-->
                <!--Slides-->
                <div class="carousel-inner" role="listbox">
                <?php
                    $c=0;
                    $sql = "SELECT * FROM banner WHERE status = 1 ORDER BY (id) DESC";
                    $query = $db->Execute($sql);
                    while ($reg = $query->FetchRow()) {
                ?>
                    <div class="carousel-item <?=($c == 0) ? 'active' : '';?>">
                        <div class="view">
                            <img alt="First slide" class="d-block w-100" src="admin/modulo/banner/img/<?=$reg['imagen'];?>">
                                <div class="mask rgba-black-light">
                                </div>
                            </img>
                        </div>
                        <div class="carousel-caption">
                            <h3 class="h3-responsive">
                                <?=$reg['title'];?>
                            </h3>
                            <p>
                                <?=$reg['subtitle'];?>
                            </p>
                        </div>
                    </div>
                <?php
                    $c++;
                }
                ?>
                </div>
                <!--/.Slides-->
                <!--Controls-->
                <a class="carousel-control-prev" data-slide="prev" href="#carousel-example-2" role="button">
                    <span aria-hidden="true" class="carousel-control-prev-icon">
                    </span>
                    <span class="sr-only">
                        Previous
                    </span>
                </a>
                <a class="carousel-control-next" data-slide="next" href="#carousel-example-2" role="button">
                    <span aria-hidden="true" class="carousel-control-next-icon">
                    </span>
                    <span class="sr-only">
                        Next
                    </span>
                </a>
                <!--/.Controls-->
            </div>
            <!--/.Carousel Wrapper-->
        </section>
        <!-- Jumbotron -->
        <div class="jumbotron suscripcion card card-image text-center">
            <!-- Title -->
            <h2 class="card-title titulo">
                LEGISLACION EXPRESS
            </h2>
            <!-- Grid row -->
            <div class="row d-flex justify-content-center">
                <!-- Grid column -->
                <div class="col-xl-7 pb-2">
                    <p class="card-text" style="color: #fff;">
                        SUSCRIBETE Y ADQUIERE TODOS NUESTROS BENEFICIOS
                    </p>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
            <div class="py-2">
                <a class="btn btn-blue waves-effect" href="suscripcion" type="button">
                    Suscribete
                    <span class="fas fa-gem ml-1">
                    </span>
                </a>
            </div>
            <div class="my-md-3">
                <p style="color: #fff; font-size: 20px;">
                    Ya tienes una cuenta??? Entonces ingresa con tu nombre de usuario y contraseña
                </p>
                <p>
                    <a class="btn btn-sm btn-success btn-rounded" data-target="#modalLoginForm" data-toggle="modal" href="">
                        Ingresar
                    </a>
                </p>
            </div>
        </div>
        <!-- Jumbotron -->
        <!-- buscador -->
        <section class="buscador">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-4 mt-3" style="background: #414040">
                        <h4 class="mt-md-3 titulo">
                            Ingresa tu busqueda
                        </h4>
                        <form role="form" name="frmSearchSimple" id="frmSearchSimple" enctype="multipart/form-data" class="cmxform" novalidate="novalidate">
                            <div class="md-form md-outline input-with-post-icon">
                                <input class="form-control" id="search" name="search" placeholder="Buscar por titulo" style="background: #fff;" type="text">
                                    <i class="fas  fa-search input-prefix" tabindex="0">
                                    </i>
                                </input>
                            </div>
                            <div class="text-center">
                                <button id="submitSimple" class="btn btn-dark btn-md">
                                    Buscar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-4 mb-3" style="background: #414040">
                        <h5 class="my-md-3 text-center" style="color: #EFA34A;font-weight: 5px;" id="show">Buscador avanzado <span><i class="fa fa-arrow-right" aria-hidden="true"></i></span></h5>
                        <div id="element" style="display: none;">
                            <form role="form" name="frmSearchAdvance" id="frmSearchAdvance" enctype="multipart/form-data" class="cmxform" novalidate="novalidate">
                                <p>
                                    <select id="typeSearch" name="typeSearch" class="js-example-responsive" style="width: 100%">
                                        <option></option>
                                        <option value="tipo">
                                            Por indice
                                        </option>
                                        <option value="tema">
                                            Por tema
                                        </option>
                                        <option value="boletin">
                                            Por numero de Boletin
                                        </option>
                                    </select>
                                </p>
                                <p>
                                    <select id="idOption" name="idOption" class="js-example-responsive" style="width: 100%">
                                        <option></option>
                                    </select>
                                </p>

                                <div class="md-form md-outline">
                                    <input class="form-control" id="termSearch" name="termSearch" placeholder="Buscar dato" style="background: #fff;" type="text">
                                    </input>
                                </div>
                                <div class="text-center">
                                    <button id="submitAdvance" class="btn btn-dark btn-md mb-2">
                                        Buscar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div id="divSearch" class="col-md-12 mb-3" style="display: none">
                        <h5 class="my-md-3 text-center" style="color: rgba(0,0,0,.9);font-weight: 5px;" id="show">Resultados de la Busqueda</h5>
                        <table id="tblSearch" class="table table-striped table-bordered table-condensed table-hover" cellspacing="0" cellpadding="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Boletin</th>
                                    <th>Asunto</th>
                                    <th>Índice</th>
                                    <th>Temas</th>
                                    <th>Fecha Creación</th>
                                    <th>Fecha Publicacion</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Boletin</th>
                                    <th>Asunto</th>
                                    <th>Índice</th>
                                    <th>Temas</th>
                                    <th>Fecha Creación</th>
                                    <th>Fecha Publicacion</th>
                                </tr>
                            </tfoot>

                            <tbody id="busqueda">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <br>
        <!-- Footer -->
        <footer class="page-footer font-small pt-4">
            <!-- Footer Links -->
            <div class="container text-center text-md-left">
                <!-- Grid row -->
                <div class="row">
                    <!-- Grid column -->
                    <div class="col-md-4 mx-auto">
                        <!-- Content -->
                        <h5 class="font-weight-bold text-uppercase mt-3 mb-4">
                            Oficinas
                        </h5>
                        <p>
                            La Paz: Edif. Ana Maria, Piso 1,2 y 3, Pasaje Villegas N° 383, San Jorge.
                        </p>
                        <p>
                            Santa Cruz:Calle Dr. Viador Pinto esquina calle I Equipetrol Edificio Omnia Dei - Primer Piso
                        </p>
                    </div>
                    <!-- Grid column -->
                    <hr class="clearfix w-100 d-md-none">
                        <!-- Grid column -->
                        <div class="col-md-4">
                            <!-- Links -->
                            <h5 class="font-weight-bold text-uppercase mt-3 mb-4">
                                Siguenos en
                            </h5>
                            <!-- Social buttons -->
                            <ul class="list-unstyled list-inline">
                                <li class="list-inline-item">
                                    <a class="btn-floating mx-1">
                                        <img class="img-fluid" height="25" src="images/facebook.png" width="25">
                                        </img>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="btn-floating mx-1">
                                        <img class="img-fluid" height="25" src="images/twitter.png" width="25">
                                        </img>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="btn-floating mx-1">
                                        <img class="img-fluid" height="25" src="images/google_mas.png" width="25">
                                        </img>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="btn-floating mx-1">
                                        <img class="img-fluid" height="25" src="images/likedin.png" width="25">
                                        </img>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="btn-floating mx-1">
                                        <img class="img-fluid" height="25" src="images/mundo.png" width="25">
                                        </img>
                                    </a>
                                </li>
                            </ul>
                            <!-- Social buttons -->
                        </div>
                        <!-- Grid column -->
                        <hr class="clearfix w-100 d-md-none">
                            <!-- Grid column -->
                            <div class="col-md-4 mx-auto">
                                <!-- Links -->
                                <h5 class="font-weight-bold text-uppercase mt-3 mb-4">
                                    Escribenos
                                </h5>
                                <p><a href="" class="btn btn-sm btn-success btn-rounded" data-toggle="modal" data-target="#modalLoginForm">Ingresar</a></p>
                                <p><button class="btn btn-sm btn-primary">Mapa del sitio</button></p>
                            </div>
                            <!-- Grid column -->
                        </hr>
                    </hr>
                </div>
                <!-- Grid row -->
            </div>
            <!-- Footer Links -->
            <hr>
                <div class="mx-3">
                    <p>
                        © 2017 - 2021 PwC. Todos los derechos reservados. No se permite la distribución adicional sin autorización de PwC. “PwC” hace referencia a la red de firmas miembros de PricewaterhouseCoopers International Limited (PwCIL) o, según cada caso concreto, a firmas miembros individuales de la red PwC. Cada firma miembro es una entidad jurídica independiente y no actúa como agente de PwCIL ni de ninguna otra firma miembro. PwCIL no presta servicios a clientes. PwCIL no se responsabiliza ni responde de los actos u omisiones de ninguna de sus firmas miembros, ni del contenido profesional de sus trabajos ni puede vincularlas u obligarlas en forma alguna. De igual manera, ninguna de las firmas miembro son responsables por los actos u omisiones del resto de las firmas miembros ni del contenido profesional de sus trabajos, ni pueden vincular u obligar ni a dichas firmas miembros ni a PwCIL en forma alguna.
                    </p>
                    <div class="row text-center mb-3">
                        <div class="col-lg-3">
                            <a  data-toggle="modal" data-target="#centralModalDark">
                                Política de Privacidad
                            </a>
                                <!-- Central Modal Medium Success -->
                                <div class="modal fade" id="centralModalDark" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-notify modal-success" role="document">
                                    <!--Content-->
                                    <div class="modal-content">
                                    <!--Header-->
                                    <div class="modal-header">
                                        <p class="heading lead">Modal Success</p>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" class="white-text">&times;</span>
                                        </button>
                                    </div>

                                    <!--Body-->
                                    <div class="modal-body">
                                        <div class="text-center">
                                        <i class="fas fa-check fa-4x mb-3 animated rotateIn"></i>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit iusto nulla aperiam blanditiis
                                            ad consequatur in dolores culpa, dignissimos, eius non possimus fugiat. Esse ratione fuga, enim,
                                            ab officiis totam.</p>
                                        </div>
                                    </div>

                                    <!--Footer-->
                                    <div class="modal-footer justify-content-center">
                                        <a type="button" class="btn btn-success">Get it now <i class="far fa-gem ml-1 text-white"></i></a>
                                        <a type="button" class="btn btn-outline-success waves-effect" data-dismiss="modal">No, thanks</a>
                                    </div>
                                    </div>
                                    <!--/.Content-->
                                </div>
                                </div>
                                <!-- Central Modal Medium Success-->
                        </div>
                        <div class="col-lg-3">
                            <a href="">
                                Información sobre cookies
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="">
                                Términos Legales
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="">
                                Acerca del proveedor de este sitio
                            </a>
                        </div>
                    </div>
                </div>
                <!-- modal login -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="modalLoginForm" role="dialog" tabindex="-1">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header text-center">
                                <h4 class="modal-title w-100 font-weight-bold" style="color: #000;">
                                    Ingresar
                                </h4>
                                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                                    <span aria-hidden="true">
                                        ×
                                    </span>
                                </button>
                            </div>
                            <div class="modal-body mx-3">
                                <div class="md-form mb-5">
                                    <i class="fas fa-user prefix grey-text">
                                    </i>
                                    <input class="form-control validate" id="defaultForm-email" type="email">
                                        <label data-error="wrong" data-success="right" for="defaultForm-email">
                                            Usuario
                                        </label>
                                    </input>
                                </div>
                                <div class="md-form mb-4">
                                    <i class="fas fa-lock prefix grey-text">
                                    </i>
                                    <input class="form-control validate" id="defaultForm-pass" type="password">
                                        <label data-error="wrong" data-success="right" for="defaultForm-pass">
                                            Contraseña
                                        </label>
                                    </input>
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button class="btn btn-sm btn-secondary">
                                    Ingresar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal login -->
                <!-- Copyright -->
                <div class="footer-copyright text-center py-3">
                    © 2021 Copyright:
                    <a href="http://www.technosoft-bolivia.com">
                        TechnoSoft
                    </a>
                </div>
                <!-- Copyright -->
            </hr>
        </footer>
        <!-- Footer -->
        <?php
          	include "chat.php";
        ?>
        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->

        <script src="js/responsiveslides.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/mdb.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/i18n/es.js"></script>

        <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js"></script>

        <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap5.min.js "></script>

        <script src="admin/assets/js/jquery.validate.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

        <!-- <script src="fontawesome/js/fontawesome.js">
        </script>
        <script src="fontawesome/js/all.js">
        </script> -->

        <script type="text/javascript">
            $(document).ready(function(){
                $("#hide").on('click', function() {
                    $("#element").hide();
                    return false;
                });

                $("#show").on('click', function() {
                    $("#element").show();
                    return false;
                });

				$('#typeSearch').select2({
					//tags: "true",
                    placeholder: 'Seleccione una opción',
                    language: "es"
					//allowClear: true,
					//width: 'resolve',
                    //search: off
				});
                // Bind an event
                $('#typeSearch').on('select2:select', function (e) {
                    var data = e.params.data;
                    console.log(data.id);
                    termBD = data.id;
                    chargueSelect2(termBD);
                });

		        $('input[type="text"]').val('');
                $('#button-addon2').click(function(){

                    $('#tblSearch').DataTable().search(
                        $('#buscar').val()
                    ).draw();
                })

                /** VALIDADOR BUSQUEDA SIMPLE */

                validatorS = $("#frmSearchSimple").validate({
                    ignore: "",
                    rules: {
                        search: "required"
                    },
                    errorElement: "em",
                    errorPlacement: function(label, element) {
                        // Add the `invalid-feedback` class to the label element
                        label.addClass( "invalid-feedback" );

                        if ( element.prop( "type" ) === "checkbox" ) {
                            label.insertAfter( element.next() );
                        } else {
                            if (element.is("textarea")) {
                                label.insertAfter(element.next());
                            } else {
                                label.insertAfter(element)
                            }
                        }
                    },
                    highlight: function(error, errorClass, validClass) {
                        $(error)
                            .addClass("is-invalid")
                            .removeClass("is-valid");
                    },
                    unhighlight: function(error, errorClass, validClass) {
                        $(error)
                            .addClass("is-valid")
                            .removeClass("is-invalid");
                    }
                });

                /** VALIDADOR BUSCADOR AVANZADO */

                validator = $("#frmSearchAdvance").validate({
                    ignore: "",
                    rules: {
                        typeSearch: "required",
                        idOption: "required",
                        //termSearch: "required"
                    },
                    errorElement: "em",
                    errorPlacement: function(label, element) {
                        // Add the `invalid-feedback` class to the label element
                        label.addClass( "invalid-feedback" );

                        if ( element.prop( "type" ) === "checkbox" ) {
                            label.insertAfter( element.next() );
                        } else {
                            //label.insertAfter( element );
                            // position label label after generated textarea
                            if (element.is("textarea")) {
                                label.insertAfter(element.next());
                            } else {
                                label.insertAfter(element)
                            }
                        }
                    },
                    highlight: function(error, errorClass, validClass) {
                        $(error)
                            .addClass("is-invalid")
                            .removeClass("is-valid");
                    },
                    unhighlight: function(error, errorClass, validClass) {
                        $(error)
                            .addClass("is-valid")
                            .removeClass("is-invalid");
                    },
                    submitHandler: function () {

                        var typeSearch = $('#typeSearch').find(":selected").val();
                        var idOption = $('#idOption').find(":selected").val();
                        var termSearch = $('#termSearch').val();

                        $('#divSearch').css("display", "block");

                        var table = $('#tblSearch').dataTable(
                        {   "aProcessing": true,
                            "aServerSide": true,
                            "scrollX": true,
                            "bFilter": false,
                            language: {
                                url: 'https://cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json'
                            },
                            dom: 'Bfrtip',
                            "aoColumns":[
                                {   "mDataProp": "0"},
                                {   "mDataProp": "1"},
                                {
                                    "mDataProp": "2",
                                    "width": "20%", "targets": 0
                                },
                                {   "mDataProp": "3"},
                                {   "mDataProp": "4"},
                                {   "mDataProp": "5"},
                                {   "mDataProp": "6"}
                            ],
                            "ajax":{
                                url: 'admin/ajax/boletinAjax.php?op=listSearchAdvance',
                                data:{
                                    'typeSearch': typeSearch,
                                    'idOption' : idOption,
                                    'termSearch': termSearch
                                },
                                type: 'post',
                                error: function(e){
                                    console.log(e.responseText);
                                }
                            },
                            "order": [[ 1, 'desc' ]],
                            "bDestroy": true

                        }).DataTable();

                    }
                });
            });

            /** SUBMIT AVANZADO */

                /** CAMBIANDO LA FORMA DE ENVIAR EL FORM DEL BUSCADOR */

            /** SUBMIT SIMPLE */

            $.validator.setDefaults({
                submitHandler: function () {
                    var search = $('#search').val();

                    $('#divSearch').css("display", "block");

                    var table = $('#tblSearch').dataTable(
                    {   "aProcessing": true,
                        "aServerSide": true,
                        "scrollX": true,
                        "bFilter": false,
                        language: {
                            url: 'https://cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json'
                        },
                        dom: 'Bfrtip',
                        "aoColumns":[
                            {   "mDataProp": "0"},
                            {   "mDataProp": "1"},
                            {
                                "mDataProp": "2",
                                "width": "20%", "targets": 0
                            },
                            {   "mDataProp": "3"},
                            {   "mDataProp": "4"},
                            {   "mDataProp": "5"},
                            {   "mDataProp": "6"}
                        ],
                        "ajax":{
                            url: 'admin/ajax/boletinAjax.php?op=listSearchSimple',
                            data:{
                                'search': search
                            },
                            type: 'post',
                            error: function(e){
                                console.log(e.responseText);
                            }
                        },
                        "order": [[ 1, 'desc' ]],
                        "bDestroy": true

                    }).DataTable();
                }
            });

            function chargueSelect2(termBD){
                $('#idOption').select2({
                    ajax: {
                        url: 'admin/ajax/boletinAjax.php?op=listTypeSearch',
                        type: 'POST',
                        dataType: 'json',
                        data: function (params) {
                            return{
                                searchTerm  : params.term,
                                termBD      : termBD
                            };
                        },
                        processResults: function(response) {
                            return {
                                results: response
                            };
                        },
                        cache: true
                    },
                    placeholder: 'Seleccione una opción',
                    language: "es"
                    //minimumInputLength: 3
				});
            }


        </script>
    </body>
</html>
