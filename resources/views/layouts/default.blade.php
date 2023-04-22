<!DOCTYPE html>
<html lang="fr">

@php
    $lang = session()->get('locale');
@endphp

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
                                    <p class="tz_description_event"> {{ __('form.slide-text') }} </p>
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
                            <a title="Home" href="{{route('home')}}/?lang={{$lang}}">
                                <img src="{{ asset('front/images/logo-ciiag-2.png') }}" alt="maniva-meetup" width="80%">
                            </a>
                        </h3>
                        <div class="tzHeaderMenu_nav">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#tz-navbar-collapse">
                                <i class="fa fa-bars"></i>
                            </button>

                            <button class="pull-right tz-search">
                                <i class="fa fa-search"></i>
                            </button>

                            <!-- Menu start -->
                            <nav class="nav-collapse pull-right tz-menu">
                                <ul id="tz-navbar-collapse" class="nav navbar-nav collapse navbar-collapse tz-nav">
                                    <li><a href="https://conferenceiiagabon.ga/?lang={{$lang}}">{{ __('form.home') }}</a></li>
                                    <li class="menu-item-has-children">
                                        <a href="https://conferenceiiagabon.ga/a-propos/?lang={{$lang}}">{{ __('form.iia-gabon') }}</a>
                                        <ul class="sub-menu non_mega_menu">
                                            <li class="menu-item"><a href="https://conferenceiiagabon.ga/a-propos/?lang={{$lang}}">{{ __('form.about') }}</a></li>
                                            <li class="menu-item"><a href="https://conferenceiiagabon.ga/nos-mission/?lang={{$lang}}">{{ __('form.mission') }}</a></li>
                                            <li class="menu-item"><a href="https://conferenceiiagabon.ga/nos-objectifs/?lang={{$lang}}">{{ __('form.objectif') }}</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="#">{{ __('form.la-conference') }}</a>
                                        <ul class="sub-menu non_mega_menu">
                                            <li class="menu-item">
                                                <a href="https://conferenceiiagabon.ga/presentation/?lang={{$lang}}">{{ __('form.presentation') }}</a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="https://conferenceiiagabon.ga/les-intervenants/?lang={{$lang}}">{{ __('form.intervenant') }}</a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="https://conferenceiiagabon.ga/le-programme/?lang={{$lang}}">{{ __('form.programme') }}</a>
                                            </li>
                                            <li class="menu-item"><a href="https://ciiag.mebodorichard.tech/public/?lang={{$lang}}">{{ __('form.inscription') }}</a></li>

                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="#">{{ __('form.service-utile') }}</a>
                                        <ul class="sub-menu non_mega_menu">
                                            <li class="menu-item">
                                                <a href="https://conferenceiiagabon.ga/liste-des-hotels/?lang={{$lang}}">{{ __('form.hotel') }}</a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="https://conferenceiiagabon.ga/restaurants/?lang={{$lang}}">{{ __('form.restaurant') }}</a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="https://conferenceiiagabon.ga/transports/?lang={{$lang}}">{{ __('form.transport') }}</a>
                                            </li>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="https://conferenceiiagabon.ga/formalites/?lang={{$lang}}">{{ __('form.formalites') }}</a></li>
                                    <li><a href="https://conferenceiiagabon.ga/contact/?lang={{$lang}}">{{ __('form.contact') }}</a></li>
                                </ul>

                            </nav>
                            <!-- Menu end -->
                        </div>

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
                            <h4> {{ __('form.inscription') }} </h4>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="tz-breadcrumb">
                            <h4>
                                <span>
                                    <a class="home" href="https://conferenceiiagabon.ga/">{{ __('form.home') }} / </a>
                                </span>
                                <span>
                                    {{ __('form.inscription') }}
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
                    <span>{{ __('form.keep-contact') }}</span>
                </h3>
                <div class="multicolor-subscribe">
                    <div class="max-email-box">
                        <form class="multicolor-subscribe-form">
                            <input class="email commons mcolor-subbox" type="email" placeholder=" {{ __('form.email') }}..." name="email">
                            <input class="mcolor-button subscribe commons" type="submit" value="{{ __('form.register') }}" name="commit">
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
                    {{ __('form.copyright') }}.
                </p>
            </div>
        </footer>
        <!-- footer end -->

    </div>

    @if ($lang == 'fr')
        <div class="wrap-template">
            <div class="transcy-switch notranslate">
                <div class="default-template" positon-float="Top-right" english-name="only-flag">
                    <div class="lang-current" arrow-icon="caret-down" effect="small-shadow" hover-effect="large-shadow" flag-style="square circle" flag-size="small" english-name="only-flag">
                        <div class="wrap-flag fr">
                                <div class="lang-flag"></div>
                        </div>
                        <div class="lang-text">
                            <span>Français</span>
                        </div>
                        <div class="lang-arrow"></div>
                    </div>
                    <div class="lang-target">
                        <ul>
                            <li>
                                <a href="{{route('changeLang')}}?lang=en">
                                    <div class="wrap-flag en">
                                        <div class="lang-flag"></div>
                                    </div>
                                    <span>English</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="wrap-template">
            <div class="transcy-switch notranslate">
                <div class="default-template" positon-float="Top-right" english-name="only-flag">
                    <div class="lang-current" arrow-icon="caret-down" effect="small-shadow" hover-effect="large-shadow" flag-style="square circle" flag-size="small" english-name="only-flag">
                        <div class="wrap-flag en">
                                <div class="lang-flag"></div>
                        </div>
                        <div class="lang-text">
                            <span>English</span>
                        </div>
                        <div class="lang-arrow"></div>
                    </div>
                    <div class="lang-target">
                        <ul>
                            <li>
                                <a href="{{route('changeLang')}}?lang=fr">
                                    <div class="wrap-flag fr">
                                        <div class="lang-flag"></div>
                                    </div>
                                    <span>Français</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif


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
    <script type="text/javascript" src="https://conferenceiiagabon.ga/wp-content/plugins/transcy/assets/js/script.js" id="transcy-front-script-js"></script>
    <script type="text/javascript" src="https://conferenceiiagabon.ga/wp-content/plugins/transcy/assets/js/front.js" id="transcy-front-js-js"></script>

    @stack('scripts')


    </body>

</html>
