<?php

    session_start();
    require "conexion.php";

    if(!isset($_SESSION['tipo_idtipo'])){//indica que el usuario inicio secion
        header("location: index.php");
    }
    
    $nombre = $_SESSION['nombre'];
    $nivel = $_SESSION['nivel'];
    //$pater = $_SESSION['tipo_idtipo'];//para crear aca necesitamos mandarnos ap en la consulta y en la sesion, desde index.php
    //echo $nivel;
    $tipo_idtipo = $_SESSION['tipo_idtipo'];//sabemos si es 1 o 2 tipo de usuario
    $idusu = $_SESSION['tipo_idtipo'];//como ya tenemos idUSUARIO mandandonos desde index le damos este valor a idusu para poder utilizar este registro
    

?>

<?php include("template/cabecera.php");?>

<body>

    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#header-carousel" data-slide-to="1"></li>
                <li data-target="#header-carousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="img-fluid" src="img/carousel-1.jpg" alt="Imagen">
                    <div class="carousel-caption d-flex align-items-center justify-content-center">
                        <div class="p-5" style="width: 100%; max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-md-3">Raíces Artesanales - CONECTA CULTURA Y TECNOLOGÍA .</h5>
                            <h1 class="display-3 text-white mb-md-4">Servicios Creativos para Impulsar Ventas</h1>
                            <a href="" class="btn btn-success py-md-2 px-md-4 font-weight-semi-bold mt-2">Saber Más</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="img-fluid" src="img/carousel-2.jpg" alt="Imagen">
                    <div class="carousel-caption d-flex align-items-center justify-content-center">
                        <div class="p-3" style="width: 100%; max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-md-4">Raíces Artesanales - CONECTA CULTURA Y TECNOLOGÍA .</h5>
                            <h1 class="display-3 text-white mb-md-4">Equipo Altamente Profesional para Ventas</h1>
                            <a href="" class="btn btn-success py-md-2 px-md-4 font-weight-semi-bold mt-2">Saber Más</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="img-fluid" src="img/carousel-3.jpg" alt="Imagen">
                    <div class="carousel-caption d-flex align-items-center justify-content-center">
                        <div class="p-5" style="width: 100%; max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-md-3">Raíces Artesanales - CONECTA CULTURA Y TECNOLOGÍA .</h5>
                            <h1 class="display-3 text-white mb-md-4">Clientes Felices y Reseñas Positivas</h1>
                            <a href="" class="btn btn-success py-md-2 px-md-4 font-weight-semi-bold mt-2">Saber Más</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Carousel End -->


    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row align-items-center pb-1">
                <div class="col-lg-5">
                    <img class="img-thumbnail p-3" src="./img/logo.jpg" alt="">
                </div>
                <div class="col-lg-7 mt-5 mt-lg-0">
                    <small class="bg-success text-white text-uppercase font-weight-bold px-1">Nuestra Misión</small>
                    <h1 class="mt-2 mb-4"> "COMPROMISO CON EL ARTE Y LA CULTURA BOLIVIANA" </h1>
                    <p class="mb-4">Promover y preservar el arte y la cultura boliviana, conectando a las comunidades artesanales con compradores alrededor del mundo. Nuestro objetivo es ofrecer una plataforma accesible que fomente el comercio justo, brinde una fuente de ingresos sostenible para los artesanos y resalte el valor cultural de cada creación.</p>
                    <a href="" class="btn btn-success py-md-2 px-md-4 font-weight-semi-bold">Leer Más</a>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="d-flex align-items-center border mb-4 mb-lg-0 p-4" style="height: 120px;">
                        <i class="fa fa-2x fa-hands-helping text-success mr-3"></i>
                        <div class="d-flex flex-column">
                            <h5 class="font-weight-bold">Nuestra Oficina</h5>
                            <p class="m-0"> Av. 6 De Agosto Nro 352 </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center border mb-4 mb-lg-0 p-4" style="height: 120px;">
                        <i class="fa fa-2x fa-envelope-open text-success mr-3"></i>
                        <div class="d-flex flex-column">
                            <h5 class="font-weight-bold">Contáctenos por Correo</h5>
                            <p class="m-0">RaicesArtesanales@ventas.org</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center border mb-4 mb-lg-0 p-4" style="height: 120px;">
                        <i class="fas fa-2x fa-phone-alt text-success mr-3"></i>
                        <div class="d-flex flex-column">
                            <h5 class="font-weight-bold">Llámenos</h5>
                            <p class="m-0">+591 70115477</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Services Start -->
    <div class="container-fluid pt-5 pb-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-5">
                    <small class="bg-success text-white text-uppercase font-weight-bold px-1">Qué hacemos</small>
                    <h1 class="mt-2 mb-3">Ofrecemos Servicios de Ventas de productos artesanales </h1>
                    <h4 class="font-weight-normal text-muted mb-4">Ofrecemos Servicios de Ventas de productos artesanales únicos y auténticos, creados por talentosos artesanos de comunidades de Bolivia. Cada pieza cuenta una historia y refleja las tradiciones culturales transmitidas de generación en generación. Nos comprometemos a llevarte productos de alta calidad que honran el trabajo artesanal y brindan un toque de autenticidad a tu vida.</h4>
                    <a href="" class="btn btn-success py-md-2 px-md-4 font-weight-semi-bold">Descubrir Más</a>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-6 mb-5">
                            <div class="d-flex">
                                <i class="fa fa-3x fa-laptop-code text-success mr-4"></i>
                                <div class="d-flex flex-column">
                                    <h4 class="font-weight-bold mb-3">Plataforma Web</h4>
                                    <p>Descubre nuestra selección de productos artesanales, creados con dedicación y esmero por comunidades de todo Bolivia. Cada pieza en nuestra plataforma cuenta una historia única, reflejando las tradiciones y el talento de nuestros artesanos locales. Nuestra misión es ofrecerte una experiencia de compra que va más allá de lo convencional: aquí, cada producto es una expresión auténtica de la cultura boliviana.</p>
                                    <a class="font-weight-semi-bold" href="">Leer Más <i class="fa fa-angle-double-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-5">
                            <div class="d-flex">
                                <i class="fa fa-3x fa-code text-success mr-4"></i>
                                <div class="d-flex flex-column">
                                    <h4 class="font-weight-bold mb-3">Desarrollo</h4>
                                    <p>Queremos que conozcas la historia detrás de cada pieza. A través de nuestra plataforma, puedes descubrir el origen de los productos y el talento de los artesanos que los hacen posibles.</p>
                                    <a class="font-weight-semi-bold" href="">Leer Más <i class="fa fa-angle-double-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-5">
                            <div class="d-flex">
                                <i class="fa fa-3x fa-envelope-open-text text-success mr-4"></i>
                                <div class="d-flex flex-column">
                                    <h4 class="font-weight-bold mb-3">Campañas de Correo</h4>
                                    <p>En nuestro compromiso por conectar a los artesanos de Bolivia con los amantes de las artesanías, hemos desarrollado una estrategia de campañas de correo electrónico diseñada para mantenerte informado y entusiasmado sobre nuestras novedades, promociones y eventos especiales.</p>
                                    <a class="font-weight-semi-bold" href="">Leer Más <i class="fa fa-angle-double-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-5">
                            <div class="d-flex">
                                <i class="fa fa-3x fa-chart-line text-success mr-4"></i>
                                <div class="d-flex flex-column">
                                    <h4 class="font-weight-bold mb-3">Estrategias</h4>
                                    <p>Mantener una comunicación constante con nuestros usuarios para informarles sobre nuevos productos, historias de los artesanos y tradiciones que inspiran cada creación.</p>
                                    <a class="font-weight-semi-bold" href="">Leer Más <i class="fa fa-angle-double-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Services End -->


    <!-- Features Start -->
    <div class="container-fluid pt-5 pb-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5">
                    <small class="bg-success text-white text-uppercase font-weight-bold px-1">Por qué Elegirnos</small>
                    <h1 class="mt-2 mb-3">15 Años de Experiencia</h1>
                    <h4 class="font-weight-normal text-muted mb-4">Nos enorgullecemos de ofrecer solo productos artesanales de alta calidad, elaborados por talentosos artesanos de Bolivia. Cada pieza cuenta con un proceso de producción cuidado y auténtico que refleja la rica herencia cultural del país.</h4>
                    <div class="list-inline mb-4">
                        <p class="font-weight-semi-bold mb-2"><i class="fa fa-angle-right text-success mr-2"></i>Compromiso con la calidad</p>
                        <p class="font-weight-semi-bold mb-2"><i class="fa fa-angle-right text-success mr-2"></i>Impacto social</p>
                        <p class="font-weight-semi-bold mb-2"><i class="fa fa-angle-right text-success mr-2"></i>Innovacion y Creatividad</p>
                    </div>
                    <a href="" class="btn btn-success py-md-2 px-md-4 font-weight-semi-bold">Conocer Más</a>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-sm-6 pb-1">
                            <div class="d-flex flex-column align-items-center border px-4 mb-4">
                                <h2 class="display-3 text-success mb-3" data-toggle="counter-up">15</h2>
                                <h5 class="font-weight-bold mb-4">Años de Experiencia</h5>
                            </div>
                        </div>
                        <div class="col-sm-6 pb-1">
                            <div class="d-flex flex-column align-items-center border px-4 mb-4">
                                <h2 class="display-3 text-success mb-3" data-toggle="counter-up">225</h2>
                                <h5 class="font-weight-bold mb-4">Expertos Calificados</h5>
                            </div>
                        </div>
                        <div class="col-sm-6 pb-1">
                            <div class="d-flex flex-column align-items-center border px-4 mb-4">
                                <h2 class="display-3 text-success mb-3" data-toggle="counter-up">1050</h2>
                                <h5 class="font-weight-bold mb-4">Clientes Satisfechos</h5>
                            </div>
                        </div>
                        <div class="col-sm-6 pb-1">
                            <div class="d-flex flex-column align-items-center border px-4 mb-4">
                                <h2 class="display-3 text-success mb-3" data-toggle="counter-up">2500</h2>
                                <h5 class="font-weight-bold mb-4">Proyectos Completados</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features End -->


    <!-- Team Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-5">
                    <small class="bg-success text-white text-uppercase font-weight-bold px-1">Conoce al Equipo</small>
                    <h1 class="mt-2 mb-3">Conoce a los Artesanos y Administradores</h1>
                    <h4 class="font-weight-normal text-muted mb-4">Cada artesano en nuestra plataforma representa una historia única de tradición y creatividad. Desde maestros de la cerámica hasta expertos en textiles, todos ellos emplean técnicas tradicionales que han aprendido de sus ancestros y que se renuevan con cada creación. Aquí puedes descubrir más sobre los procesos, inspiración y compromiso de cada artesano, acercándote a sus historias y a la cultura de sus comunidades. Tu apoyo impulsa su crecimiento y les permite seguir compartiendo su talento con el mundo.</h4>
                    <a href="" class="btn btn-success py-md-2 px-md-4 font-weight-semi-bold">Conocer a Todos los Vendedores</a>
                </div>
                <div class="col-lg-8 mb-5">
                    <div class="owl-carousel team-carousel">
                        <div class="team-item">
                            <div class="position-relative">
                                <img class="img-fluid w-100" src="img/team-1.jpg" alt="">
                                <div class="team-overlay position-absolute d-flex align-items-center justify-content-center m-3">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <a class="btn btn-outline-secondary rounded-circle text-center mr-2 px-0" style="width: 38px; height: 38px;" href="#"><i class="fab fa-twitter"></i></a>
                                        <a class="btn btn-outline-secondary rounded-circle text-center mr-2 px-0" style="width: 38px; height: 38px;" href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a class="btn btn-outline-secondary rounded-circle text-center px-0" style="width: 38px; height: 38px;" href="#"><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="border border-top-0 text-center" style="padding: 30px;">
                                <h5 class="font-weight-bold">John Doe</h5>
                                <span>Artesanos</span>
                            </div>
                        </div>
                        <div class="team-item">
                            <div class="position-relative">
                                <img class="img-fluid w-100" src="img/team-2.jpg" alt="">
                                <div class="team-overlay position-absolute d-flex align-items-center justify-content-center m-3">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <a class="btn btn-outline-secondary rounded-circle text-center mr-2 px-0" style="width: 38px; height: 38px;" href="#"><i class="fab fa-twitter"></i></a>
                                        <a class="btn btn-outline-secondary rounded-circle text-center mr-2 px-0" style="width: 38px; height: 38px;" href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a class="btn btn-outline-secondary rounded-circle text-center px-0" style="width: 38px; height: 38px;" href="#"><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="border border-top-0 text-center" style="padding: 30px;">
                                <h5 class="font-weight-bold">Kate Wilson</h5>
                                <span>Administradores</span>
                            </div>
                        </div>
                        <div class="team-item">
                            <div class="position-relative">
                                <img class="img-fluid w-100" src="img/team-3.jpg" alt="">
                                <div class="team-overlay position-absolute d-flex align-items-center justify-content-center m-3">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <a class="btn btn-outline-secondary rounded-circle text-center mr-2 px-0" style="width: 38px; height: 38px;" href="#"><i class="fab fa-twitter"></i></a>
                                        <a class="btn btn-outline-secondary rounded-circle text-center mr-2 px-0" style="width: 38px; height: 38px;" href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a class="btn btn-outline-secondary rounded-circle text-center px-0" style="width: 38px; height: 38px;" href="#"><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="border border-top-0 text-center" style="padding: 30px;">
                                <h5 class="font-weight-bold">John Brown</h5>
                                <span>Vendedor</span>
                            </div>
                        </div>
                        <div class="team-item">
                            <div class="position-relative">
                                <img class="img-fluid w-100" src="img/team-4.jpg" alt="">
                                <div class="team-overlay position-absolute d-flex align-items-center justify-content-center m-3">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <a class="btn btn-outline-secondary rounded-circle text-center mr-2 px-0" style="width: 38px; height: 38px;" href="#"><i class="fab fa-twitter"></i></a>
                                        <a class="btn btn-outline-secondary rounded-circle text-center mr-2 px-0" style="width: 38px; height: 38px;" href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a class="btn btn-outline-secondary rounded-circle text-center px-0" style="width: 38px; height: 38px;" href="#"><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="border border-top-0 text-center" style="padding: 30px;">
                                <h5 class="font-weight-bold">Paul Watson</h5>
                                <span>Artesano</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Team End -->


    <!-- Pricing Plan Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-md-6 mb-5">
                            <div class="d-flex flex-column align-items-center justify-content-center bg-success p-4">
                                <h3>Básico</h3>
                                <h1 class="display-4 mb-0">
                                    <small class="align-top" style="font-size: 22px; line-height: 45px;">$</small>0<small class="align-bottom" style="font-size: 16px; line-height: 40px;">/
                                        Mo</small>
                                </h1>
                            </div>
                            <div class="border border-top-0 d-flex flex-column align-items-center py-4">
                                <p>Acceso a Recursos Básicos</p>
                                <p>Soporte Comunitario</p>
                                <p>Boletín Informativo</p>
                                <p>Eventos Gratuitos</p>
                                <a href="" class="btn btn-success py-md-2 px-md-4 font-weight-semi-bold my-2">Únete Ahora</a>
                            </div>
                        </div>
                        <div class="col-md-6 mb-5">
                            <div class="d-flex flex-column align-items-center justify-content-center bg-success p-4">
                                <h3>Premium</h3>
                                <h1 class="display-4 mb-0">
                                    <small class="align-top" style="font-size: 22px; line-height: 45px;">$</small>50<small class="align-bottom" style="font-size: 16px; line-height: 40px;">/
                                        Mo</small>
                                </h1>
                            </div>
                            <div class="border border-top-0 d-flex flex-column align-items-center py-4">
                                <p>Acceso Completo a Recursos</p>
                                <p>Soporte Personalizado</p>
                                <p>Eventos Exclusivos</p>
                                <p>Reconocimiento en Nuestra Web</p>
                                <a href="" class="btn btn-success py-md-2 px-md-4 font-weight-semi-bold my-2">Únete Ahora</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 mb-5">
                    <small class="d-inline bg-success text-white text-uppercase font-weight-bold px-1">Nuestro Plan de Membresía</small>
                    <h1 class="mt-2 mb-3">Ofrecemos Paquetes Asequibles y Flexibles</h1>
                    <h4 class="font-weight-normal text-muted mb-4">Únete a nuestra organización sin fines de lucro y disfruta de los beneficios de ser parte de nuestra comunidad comprometida.</h4>
                    <h5 class="font-weight-bold mb-4">¿Necesitas un Paquete Personalizado?</h5>
                    <a href="" class="btn btn-success py-md-2 px-md-4 font-weight-semi-bold">Contáctanos Ahora</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Pricing Plan End -->


    <!-- Testimonial Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-5">
                    <small class="bg-success text-white text-uppercase font-weight-bold px-1">Lo que dicen nuestros colaboradores</small>
                    <h1 class="mt-2 mb-3">Testimonios sobre nuestra organización</h1>
                    <h4 class="font-weight-normal text-muted mb-4">Aquí puedes leer lo que nuestros colaboradores tienen que decir sobre nuestra labor y compromiso con la comunidad.</h4>
                    <a href="" class="btn btn-success py-md-2 px-md-4 font-weight-semi-bold">Enviar Testimonio</a>
                </div>
                <div class="col-lg-8 mb-5">
                    <div class="owl-carousel testimonial-carousel">
                        <div class="testimonial-item">
                            <div class="testimonial-text position-relative border mb-4" style="padding: 25px 30px;">
                                Estoy realmente impresionado por el impacto positivo que nuestra organización ha tenido en la comunidad. Es increíble ver cómo nuestras donaciones están cambiando vidas para mejor.
                            </div>
                            <div class="d-flex align-items-center">
                                <img class="img-fluid rounded-circle" src="img/testimonial-1.jpg" style="width: 80px; height: 80px;" alt="Image">
                                <div class="pl-4">
                                    <h6 class="font-weight-bold">Marío López</h6>
                                    <i class="text-muted">Voluntario</i>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-item">
                            <div class="testimonial-text position-relative border mb-4" style="padding: 25px 30px;">
                                Desde que me uní como voluntario, he sido testigo del increíble trabajo que realiza nuestra organización. Cada donación marca la diferencia en la vida de quienes más lo necesitan.
                            </div>
                            <div class="d-flex align-items-center">
                                <img class="img-fluid rounded-circle" src="img/testimonial-2.jpg" style="width: 80px; height: 80px;" alt="Image">
                                <div class="pl-4">
                                    <h6 class="font-weight-bold">Juan Pérez</h6>
                                    <i class="text-muted">Administrativo</i>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-item">
                            <div class="testimonial-text position-relative border mb-4" style="padding: 25px 30px;">
                                La labor de nuestra organización ha sido fundamental para brindar esperanza a aquellos que enfrentan situaciones difíciles. Estoy orgulloso de formar parte de este equipo comprometido.
                            </div>
                            <div class="d-flex align-items-center">
                                <img class="img-fluid rounded-circle" src="img/testimonial-3.jpg" style="width: 80px; height: 80px;" alt="Image">
                                <div class="pl-4">
                                    <h6 class="font-weight-bold">Alejandro Martínez</h6>
                                    <i class="text-muted">Donador</i>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-item">
                            <div class="testimonial-text position-relative border mb-4" style="padding: 25px 30px;">
                                Como beneficiario de las donaciones de esta organización, puedo decir que han sido un verdadero salvavidas para mí y mi familia. Estamos eternamente agradecidos por su ayuda.
                            </div>
                            <div class="d-flex align-items-center">
                                <img class="img-fluid rounded-circle" src="img/testimonial-4.jpg" style="width: 80px; height: 80px;" alt="Image">
                                <div class="pl-4">
                                    <h6 class="font-weight-bold">Ericka Rodríguez</h6>
                                    <i class="text-muted">Beneficiaria</i>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-item">
                            <div class="testimonial-text position-relative border mb-4" style="padding: 25px 30px;">
                                Como beneficiario de las donaciones de esta organización, puedo decir que han sido un verdadero salvavidas para mí y mi familia. Estamos eternamente agradecidos por su ayuda.
                            </div>
                            <div class="d-flex align-items-center">
                                <img class="img-fluid rounded-circle" src="img/testimonial-5.jpg" style="width: 80px; height: 80px;" alt="Image">
                                <div class="pl-4">
                                    <h6 class="font-weight-bold">Jose Gómez</h6>
                                    <i class="text-muted">Beneficiario</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonial End -->


    <!-- Blog Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="text-center">
                <small class="bg-success text-white text-uppercase font-weight-bold text-center px-1">Nuestro Blog</small>
                <h1 class="mt-2 mb-5">Lo último de nuestro blog</h1>
            </div>
            <div class="row">
                <div class="col-md-6 mb-5">
                    <div class="position-relative">
                        <img class="img-fluid w-100" src="img/blog-1.jpg" alt="">
                        <div class="position-absolute bg-success d-flex flex-column align-items-center justify-content-center" style="width: 80px; height: 80px; bottom: 0; left: 0;">
                            <h6 class="text-uppercase mt-2 mb-n2">Ene</h6>
                            <h1 class="m-0">01</h1>
                        </div>
                    </div>
                    <div class="border border-top-0" style="padding: 30px;">
                        <div class="d-flex mb-3">
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle" style="width: 40px; height: 40px;" src="img/user.jpg" alt="">
                                <a class="text-muted ml-2" href="">Juan Pérez</a>
                            </div>
                            <div class="d-flex align-items-center ml-4">
                                <i class="far fa-bookmark text-success"></i>
                                <a class="text-muted ml-2" href="">Donaciones</a>
                            </div>
                        </div>
                        <a class="h5 font-weight-bold" href="">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et nulla id dolor laoreet consectetur nec nec nulla.</a>
                    </div>
                </div>
                <div class="col-md-6 mb-5">
                    <div class="position-relative">
                        <img class="img-fluid w-100" src="img/blog-2.jpg" alt="">
                        <div class="position-absolute bg-success d-flex flex-column align-items-center justify-content-center" style="width: 80px; height: 80px; bottom: 0; left: 0;">
                            <h6 class="text-uppercase mt-2 mb-n2">Ene</h6>
                            <h1 class="m-0">01</h1>
                        </div>
                    </div>
                    <div class="border border-top-0" style="padding: 30px;">
                        <div class="d-flex mb-3">
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle" style="width: 40px; height: 40px;" src="img/testimonial-4.jpg" alt="">
                                <a class="text-muted ml-2" href="">María Gómez</a>
                            </div>
                            <div class="d-flex align-items-center ml-4">
                                <i class="far fa-bookmark text-success"></i>
                                <a class="text-muted ml-2" href="">Impacto Social</a>
                            </div>
                        </div>
                        <a class="h5 font-weight-bold" href="">Suspendisse potenti. Mauris suscipit, nisi eget suscipit auctor, urna orci convallis libero, id lobortis arcu ligula in justo.</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

       
    <script src="js/main.js"></script>
</body>

<?php include("template/pie.php");?>