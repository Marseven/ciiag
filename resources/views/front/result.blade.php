@extends('layouts.default')

@push('styles')
@endpush

@section('content')

<!-- Contact start -->
<section id="tz_contact">


    <div class="tz_contact_icon_form">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="tz_contact_meet_2">
                        <div class="tz_contact_detail_meet">
                            <span class="tz_contact_meet_icon">
                                <i class="fa fa-clock-o"></i>
                            </span>
                            <h4>Dates</h4>
                        </div>
                        <div class="tz_meetup_contact_detail">
                            <p>Monday-Friday: 8:00AM-05PM</p>
                            <p>Saturday: 09:00AM-01:00PM</p>
                            <p>Sunday: Holiday</p>
                        </div>
                    </div>
                    <div class="tz_contact_meet_2">
                        <div class="tz_contact_detail_meet">
                            <span class="tz_contact_meet_icon tz_contact_meet_icon_bk_1">
                                <i class="fa fa-map-marker"></i>
                            </span>
                            <h4>Salles</h4>
                        </div>
                        <div class="tz_meetup_contact_detail">
                            <p>Semona Web Technologies</p>
                            <p>9315 Circle Drive Street,</p>
                            <p>Santa Cruz, CA 95060, USA</p>
                        </div>
                    </div>
                    <div class="tz_contact_meet_2">
                        <div class="tz_contact_detail_meet">
                            <span class="tz_contact_meet_icon tz_contact_meet_icon_bk_2">
                                <i class="fa fa-envelope"></i>
                            </span>
                            <h4> Plus d'infos </h4>
                        </div>
                        <div class="tz_meetup_contact_detail">
                            <p>info@templaza.com</p>
                            <p>+1-202-555-0105 – 120</p>

                        </div>
                    </div>

                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

                    @include('layouts.flash')

                    @if ($registration)
                    <div class="tz_width_column tz_text_box_slider_padding">
                        <div class="tz_check_width_right_position tz_custom_width tz_width_box" style="width: 490px;">
                            <div class="tz_maniva_meetup_title tz_box_text_bk text-left">
                                <h3 class="tz_meetup_general_title tz_meetup_general_title_2">Merci pour votre inscription</h3>
                                <div class="tz_image_title_meetup">
                                    <hr>
                                </div>
                            <span class="tz_meetup_video_sub_title">
                                <i class="fa fa-clock-o tz_icon_position_left"></i>
                                February 24, 2016 – Billet Adhérent
                                <span class="tz_meetup_video_sub_title_line"></span>
                            </span>
                                <div class="tz_meetup_content">
                                    <p>
                                    <span>
                                        Join us on February 24, 2016 for our FREE one-day virtual event dedicated to content marketing technology. ContentTECH 2016 will feature 6 technology-focused webinars:
                                    </span>
                                    </p>
                                    <ul class="tz-plazart-list">
                                        <li>
                                    <span class="tz_icon_maniva_list tz_icon_maniva_list_style_1">
                                        <i class="fa fa-check-square-o"></i>
                                    </span>
                                            <p class="tz_list_item_content"> Nom & Prénom : {{$registration->firstname}} {{$registration->lastname}} </p>
                                        </li>
                                        <li>
                                            <span class="tz_icon_maniva_list tz_icon_maniva_list_style_1">
                                                <i class="fa fa-check-square-o"></i>
                                            </span>
                                                <p class="tz_list_item_content"> Genre : {{$registration->sexe}} </p>
                                        </li>
                                        <li>
                                            <span class="tz_icon_maniva_list tz_icon_maniva_list_style_1">
                                                <i class="fa fa-check-square-o"></i>
                                            </span>
                                                <p class="tz_list_item_content"> Email : {{$registration->email}}</p>
                                        </li>
                                        <li>
                                            <span class="tz_icon_maniva_list tz_icon_maniva_list_style_1">
                                                <i class="fa fa-check-square-o"></i>
                                            </span>
                                                <p class="tz_list_item_content"> Téléphone : {{$registration->phone_fixe}} {{' /'.$registration->phone_mobile}} </p>
                                        </li>
                                        <li>
                                            <span class="tz_icon_maniva_list">
                                                <i class="fa fa-times"></i>
                                            </span>
                                                <p class="tz_list_item_content"> Pays de provenance : {{$registration->country}}</p>
                                        </li>
                                        <li>
                                            <span class="tz_icon_maniva_list">
                                                <i class="fa fa-times"></i>
                                            </span>
                                                <p class="tz_list_item_content"> N° Adhérant : {{$registration->number_adherant}}</p>
                                        </li>
                                        <li>
                                            <span class="tz_icon_maniva_list">
                                                <i class="fa fa-times"></i>
                                            </span>
                                                <p class="tz_list_item_content"> Participation au Gala : {{$registration->gala}} </p>
                                        </li>
                                    </ul>
                                </div>
                                <a class="tz_btn_video_meetup tz_btn_shop_meetup tz_meetup_btn_dark" target="_blank" href="#">Télécharger le Billet</a>
                            </div>
                        </div>
                    </div>
                    @else
                        <form class="wpcf7-form" method="POST" action="{{ url('/registration')}}">
                            @csrf
                            <div class="tz_meetup_wpcf7-form">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p>
                                            <span class="wpcf7-form-control-wrap">
                                                <input class="wpcf7-form-control wpcf7-text" type="text" placeholder="Prénom *" aria-invalid="false" aria-required="true" size="40" value="{{old('firstname')}}" name="firstname">
                                            </span>
                                            <i class="fa fa-user"></i>
                                        </p>
                                    </div>
                                    <div class="col-lg-6">
                                        <p>
                                            <span class="wpcf7-form-control-wrap">
                                                <input class="wpcf7-form-control wpcf7-text" type="text" placeholder="Nom *" aria-invalid="false" aria-required="true" size="40" value="{{old('lastname')}}" name="lastname">
                                            </span>
                                            <i class="fa fa-user"></i>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p>
                                        <select name="sexe" id="">
                                            <option value="H">Homme</option>
                                            <option value="F">Femme</option>
                                        </select>
                                            <i class="fa fa-sort-desc"></i>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p>
                                            <span class="wpcf7-form-control-wrap">
                                                <input class="wpcf7-form-control wpcf7-text" type="phone" placeholder="Téléphone Fixe *" aria-invalid="false" aria-required="true" size="40" value="{{old('phone_fixa')}}" name="phone_fixe">
                                            </span>
                                            <i class="fa fa-phone"></i>
                                        </p>
                                    </div>
                                    <div class="col-lg-6">
                                        <p>
                                            <span class="wpcf7-form-control-wrap">
                                                <input class="wpcf7-form-control wpcf7-text" type="phone" placeholder="Téléphone Mobile" aria-invalid="false" size="40" value="{{old('phone_mobile')}}" name="phone_mobile">
                                            </span>
                                            <i class="fa fa-phone"></i>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p>
                                            <span class="wpcf7-form-control-wrap">
                                                <input class="wpcf7-form-control wpcf7-text" type="email" placeholder="Email *" aria-invalid="false" aria-required="true" size="40" value="{{old('email')}}" name="email">
                                            </span>
                                            <i class="fa fa-envelope-o"></i>

                                        </p>
                                    </div>

                                    <div class="col-lg-6">
                                        <p>
                                            <span class="wpcf7-form-control-wrap">
                                                <input class="wpcf7-form-control wpcf7-text" type="text" placeholder="Pays d'Origine *" aria-invalid="false" aria-required="true" size="40" value="{{old('country')}}" name="country">
                                            </span>
                                            <i class="fa fa-map-marker"></i>
                                        </p>
                                    </div>


                                </div>

                                <div class="row">

                                    <div class="col-lg-6">
                                        <h6>Statut IIA 2023</h6>
                                        <p>
                                            Adhérent <br>
                                            <input class="wpcf7-form-control wpcf7-text" type="radio" value="1" name="adherant"> Oui
                                            <input class="wpcf7-form-control wpcf7-text" type="radio" value="0" name="adherant"> Non
                                        </p>
                                        <p>
                                            <span class="wpcf7-form-control-wrap">
                                                <input class="wpcf7-form-control wpcf7-text" type="text" placeholder="Numéro Adhérant *" aria-invalid="false" size="40" value="{{old('number_adherant')}}" name="number_adherant">
                                            </span>
                                            <i class="fa fa-number"></i>
                                        </p>
                                    </div>

                                    <div class="col-lg-6">
                                        <p>
                                            Participation au Gala : <br>
                                            <input class="wpcf7-form-control wpcf7-text" type="radio" value="1" name="gala"> Oui
                                            <input class="wpcf7-form-control wpcf7-text" type="radio" value="0" name="gala"> Non
                                        </p>
                                    </div>
                                </div>

                                <p>
                                    <input class="wpcf7-form-control wpcf7-submit" type="submit" value="S'inscrire">
                                </p>
                            </div>
                        </form>
                    @endif


                </div>
            </div>
        </div>
    </div>

</section>
<!-- Contact end -->

@endsection

@push('scripts')
@endpush
