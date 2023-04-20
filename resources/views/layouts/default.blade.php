<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>CIIAG</title>

        <!-- Bootstrap -->
        <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('front/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('front/fonts/linea-arrows/styles.css') }}" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700,800' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Lato:400,400italic' rel='stylesheet' type='text/css'>
        <link href="{{ asset('front/css/owl.carousel.min.css') }}" rel="stylesheet">

        <!-- Style css -->
        <link href="{{ asset('front/style.css') }}" rel="stylesheet" />

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="{{ asset('front/js/library/html5shiv.min.js') }}"></script>
        <script src="{{ asset('front/js/library/respond.min.js') }}"></script>
        <![endif]-->

        @stack('styles')

    </head>
    <body id="bd">
    <div id="tzwrapper">

        <!-- Header start -->
        <header class="tz-headerHome tz-homeType2 tz-homeTypeRelative">
            <div class="tz_meetup_header_option">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="tz_meetup_header_option_phone">
                                <div class="tz_meetup_header_option_phone">
                                    <span>
                                        <img src="https://conferenceiiagabon.ga/wp-content/themes/maniva-meetup/images/phone.png" alt="phone">
                                    241077071856
                                </span>

                                <span>
                                    <img src="https://conferenceiiagabon.ga/wp-content/themes/maniva-meetup/images/email_meetup.png" alt="email">
                                    <a href="mailto:contact@conferenceiiagabon.ga">contact@conferenceiiagabon.ga</a>
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="tz-headerRight text-right">
                                <ul>
                                    <li>
                                        <a target="_blank" href="https://www.facebook.com/IIAGABON/"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="https://www.facebook.com/IIAGABON/"><i class="fa fa-linkedin"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tz-header-content">
                <div class="container">
                    <div class="tzHeaderContainer">
                        <h3 class="pull-left tz_logo">
                            <a title="Home" href="{{route('home')}}">
                                <img src="{{ asset('front/images/logo-ciiag.png') }}" alt="maniva-meetup" width="60%">
                            </a>
                        </h3>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#tz-navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>

                        <button class="pull-right tz-search">
                            <i class="fa fa-search"></i>
                        </button>

                        <!-- Menu start -->
                        <nav class="nav-collapse pull-right tz-menu">
                            <ul id="tz-navbar-collapse" class="nav navbar-nav collapse navbar-collapse tz-nav">
                                <li><a href="https://conferenceiiagabon.ga/">Accueil</a></li>
                                <li><a href="https://conferenceiiagabon.ga/a-propos/">IIA Gabon</a></li>
                                <li class="menu-item-has-children">
                                    <a href="#">La Conférence</a>
                                    <ul class="sub-menu non_mega_menu">
                                        <li class="menu-item">
                                            <a href="https://conferenceiiagabon.ga/presentation/">Présentation</a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="https://conferenceiiagabon.ga/les-intervenants/">Intervenants</a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="https://conferenceiiagabon.ga/le-programme/">Programme</a>
                                        </li>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="#">Services Utiles</a>
                                    <ul class="sub-menu non_mega_menu">
                                        <li class="menu-item">
                                            <a href="https://conferenceiiagabon.ga/liste-des-hotels/">Hôtels</a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="https://conferenceiiagabon.ga/restaurants/">Restaurants</a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="https://conferenceiiagabon.ga/transports/">Transport</a>
                                        </li>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="https://conferenceiiagabon.ga/formalites/">Formalités</a></li>
                                <li><a href="https://conferenceiiagabon.ga/contact/">Contact</a></li>
                            </ul>
                        </nav>
                        <!-- Menu end -->
                    </div>
                </div>
            </div>
        </header>
        <!-- Header end -->

        <!-- Breadcrumb start -->
        <section class="tz-sectionBreadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="tz_breadcrumb_single_cat_title">
                            <h4> Inscription </h4>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="tz-breadcrumb">
                            <h4>
                                <span>
                                    <a class="home" href="index-2.html">Accueil / </a>
                                </span>
                                <span>
                                    Inscription
                                </span>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Breadcrumb end -->

        {{-- @include('layouts.flash') --}}

        @yield('content')

        <!-- footer start -->
        <footer class="tz-footer tz-footer-type1">

            <aside class="MultiColorSubscribeWidget widget">
                <h3 class="module-title">
                    <span>Restez informer..!</span>
                </h3>
                <div class="multicolor-subscribe">
                    <div class="max-email-box">
                        <form class="multicolor-subscribe-form">
                            <input class="email commons mcolor-subbox" type="email" placeholder="Votre Email..." name="email">
                            <input class="mcolor-button subscribe commons" type="submit" value="S'INSCRIRE" name="commit">
                        </form>
                    </div>
                </div>
            </aside>
            <aside class="widget tzsocial">
                <div class="tzSocial_bg">
                    <div class="tzSocial_bg_meetup">
                        <span class="meetup_line_left"></span>
                        <a class="tzSocial-no" href="https://www.facebook.com/templaza">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a class="tzSocial-no" href="https://twitter.com/templazavn">
                            <i class="fa fa fa-twitter"></i>
                        </a>
                        <a class="tzSocial-no" href="#">
                            <i class="fa fa-youtube"></i>
                        </a>
                        <a class="tzSocial-no" href="#">
                            <i class="fa fa-whatsapp"></i>
                        </a>
                        <a class="tzSocial-no" href="#">
                            <i class="fa fa-skype"></i>
                        </a>
                        <span class="meetup_line_right"></span>
                    </div>
                </div>
            </aside>
            <div class="tzcopyright">
                <p>
                    Copyright &copy; 2023
                    <a target="_blank" href="#">CIIAG </a>
                    Tous Droits Réservés.
                </p>
            </div>
        </footer>
        <!-- footer end -->

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{ asset('front/js/library/jquery.min.js') }}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('front/js/library/bootstrap.min.js') }}"></script>
    <script>
        jQuery.noConflict();
    </script>
    <!-- Include bxslider -->
    <script src="{{ asset('front/js/library/parallax.min.js') }}"></script>
    <script src="{{ asset('front/js/library/owl.carousel.min.js') }}"></script>

    <!-- Include custom js -->
    <script src="{{ asset('front/js/custom.js') }}"></script>

    @stack('scripts')

    </body>

</html>
