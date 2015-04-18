@extends('base')

@section('head')
    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'
          rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic'
          rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="/vendor/startbootstrap-creative-1.0.0/css/animate.min.css" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/vendor/startbootstrap-creative-1.0.0/css/creative.css" type="text/css">
@stop

@section('scripts')
    <!-- Plugin JavaScript -->
    <script src="/vendor/startbootstrap-creative-1.0.0/js/jquery.easing.min.js"></script>
    <script src="/vendor/startbootstrap-creative-1.0.0/js/jquery.fittext.js"></script>
    <script src="/vendor/startbootstrap-creative-1.0.0/js/wow.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/vendor/startbootstrap-creative-1.0.0/js/creative.js"></script>
@stop

@section('title')
    Dein Notenbuch
@stop

@section('body')
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">Notenbuch</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="#about">Über uns</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">Angebot</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#portfolio">Portfolio</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Kontakt</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1>Behalte deine Schulnoten immer im Überblick</h1>
                <hr>
                <p>Das Notenbuch ist dein bester Freund wenn es um die Verwaltung deiner Schulnoten geht! Schluss mit
                    unerwarteten Überraschungen bei den Semesterzeugnissen.</p>
                <p><a href="#about" class="btn btn-primary btn-xl page-scroll">Erzähl mir mehr</a></p>
                <a href="/auth/login" class="btn btn-primary btn-xl page-scroll">Anmelden</a>

            </div>
        </div>
    </header>

    <section class="bg-primary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Genau das was du brauchst!</h2>
                    <hr class="light">
                    <p class="text-faded">Im Notenbuch kannst du alle deine Schulnoten eintragen. Ganz einfach - zuerst
                        erfasst du deine Schulfächer und dann kann's los gehen! Viel unterwegs? Kein
                        Problem, das Notenbuch bietet auch eine mobile Ansicht.</p>
                    <a href="#services" class="btn btn-default btn-xl page-scroll">Ich will mehr wissen!</a>
                </div>
            </div>
        </div>
    </section>

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Was wir anbieten</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-dashboard wow bounceIn text-primary"></i>

                        <h3>Up to Date</h3>

                        <p class="text-muted">Behalte die <i>Kontrolle</i> über deine Noten. Mit unserer übersichtlichen Ansicht siehst du auf den ersten Blick wie der Notenschnitt in den verschiedenen Fächern aussieht.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-dollar wow bounceIn text-primary" data-wow-delay=".1s"></i>

                        <h3>Kostenlos</h3>

                        <p class="text-muted">Wir wissen um die finanzielle Lage von Studenten und Schülern. Deshalb ist es uns wichtig, einen <i>kostenlosen</i> Service anzubieten. Ausserdem sind wir werbefrei.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-mobile wow bounceIn text-primary" data-wow-delay=".2s"></i>

                        <h3>Benutzerfreundlich</h3>

                        <p class="text-muted"><i>Simplicity</i> heisst das Zauberwort. Unsere Dienste sind einfach aufgebaut und nicht mit unnötigem Inhalt übersäht. Dazu gehört natürlich eine mobile Ansicht für Smartphone und Tablet.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-heart wow bounceIn text-primary" data-wow-delay=".3s"></i>

                        <h3>Mit Liebe gemacht</h3>

                        <p class="text-muted">Wir entwickeln aus <i>Leidenschaft</i>. Es ist Grundvoraussetzung für eine intuitive und nützliche App und wir sind fest davon überzeugt, dass unsere Benutzer das merken werden.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="no-padding" id="portfolio">
        <div class="container-fluid">
            <div class="row no-gutter">
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="portfolio-box" onclick="return false;">
                        <img src="/images/app_photo_1.png" class="img-responsive" alt="">

                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Notenbuch
                                </div>
                                <div class="project-name">
                                    Dashboard
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="portfolio-box" onclick="return false;">
                        <img src="/images/app_photo_2.png" class="img-responsive" alt="">

                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Notenbuch
                                </div>
                                <div class="project-name">
                                    Note erfassen
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="portfolio-box" onclick="return false;">
                        <img src="/images/app_photo_3.png" class="img-responsive" alt="">

                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Notenbuch
                                </div>
                                <div class="project-name">
                                    Notenübersicht
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>

    <aside class="bg-dark">
        <div class="container text-center">
            <div class="call-to-action">
                <h2>Worauf wartest du noch?</h2>
                <a href="/auth/register" class="btn btn-default btn-xl wow tada">Jetzt registrieren!</a>
            </div>
        </div>
    </aside>

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Fragen oder Feedback?</h2>
                    <hr class="primary">
                    <p>Dir ist etwas noch nicht ganz klar oder du würdest gerne Feedback/Verbesserungsvorschläge geben?
                        Dann tritt in Kontakt mit uns, wir werden ihnen sobald wie möglich antworten.</p>
                </div>
                <div class="col-lg-4 text-center">
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fa fa-envelope-o fa-3x wow bounceIn" data-wow-delay=".1s"></i>

                    <p><a href="mailto:deinnotenbuch@gmail.com">deinnotenbuch@gmail.com</a></p>
                </div>
                <div class="col-lg-4 text-center">
                </div>
            </div>
        </div>
    </section>
@stop