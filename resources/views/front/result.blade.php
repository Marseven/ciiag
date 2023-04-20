@extends('layouts.default')

@push('styles')
@endpush

@section('content')

<!-- Contact start -->
<section id="tz_contact">


    <div class="tz_contact_icon_form">
        <div class="container" style="width: 95% !important;">
            <div class="row">

                @include('layouts.flash')

                <div class="col-lg-9 col-md-7 col-sm-12 col-xs-12">

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
                                    15-16 Juin 2023 – Billet Adhérent
                                    <span class="tz_meetup_video_sub_title_line"></span>
                                </span>
                                    <div class="tz_meetup_content">

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
                                                    <p class="tz_list_item_content"> Genre : {{$registration->sexe == "F" ? "Femme" : "Homme"}} </p>
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
                                                <span class="tz_icon_maniva_list tz_icon_maniva_list_style_1">
                                                    <i class="fa fa-check-square-o"></i>
                                                </span>
                                                    <p class="tz_list_item_content"> Pays de provenance : {{$registration->country}}</p>
                                            </li>
                                            <li>
                                                <span class="tz_icon_maniva_list tz_icon_maniva_list_style_1">
                                                    <i class="fa fa-check-square-o"></i>
                                                </span>
                                                    <p class="tz_list_item_content"> N° Adhérant : {{$registration->adherant  == 1 ? $registration->number_adherant : "Pas adhérant"}}</p>
                                            </li>
                                            <li>
                                                <span class="tz_icon_maniva_list tz_icon_maniva_list_style_1">
                                                    <i class="fa fa-check-square-o"></i>
                                                </span>
                                                    <p class="tz_list_item_content"> Participation au Gala : {{$registration->gala == 1 ? "Oui" : "Non"}} </p>
                                            </li>

                                            <li>
                                                <span class="tz_icon_maniva_list tz_icon_maniva_list_style_1">
                                                    <i class="fa fa-check-square-o"></i>
                                                </span>
                                                    <p class="tz_list_item_content"> Jour 1 : </p>
                                                    <ul>
                                                        <li>{{$registration->atelierj1->label}}</li>
                                                        <li>{{$registration->atelierj2->label}}</li>
                                                    </ul>
                                            </li>

                                            <li>
                                                <span class="tz_icon_maniva_list tz_icon_maniva_list_style_1">
                                                    <i class="fa fa-check-square-o"></i>
                                                </span>
                                                    <p class="tz_list_item_content"> Jour 2 : </p>
                                                    <ul>
                                                        <li>{{$registration->atelierj3->label}}</li>
                                                        <li>{{$registration->atelierj4->label}}</li>
                                                    </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <a class="tz_btn_video_meetup tz_btn_shop_meetup tz_meetup_btn_dark" onclick="javascript:window.print();" href="#">Télécharger le Billet</a>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Nav pills -->
                        <ul class="nav nav-pills">
                            <li class="nav-item active">
                                <a class="nav-link active" data-toggle="pill" href="#particulier" style="font-size: 2em; font-weight: 700;">Particulier</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#entreprise" style="font-size: 2em; font-weight: 700;">Entreprise</a>
                            </li>
                        </ul>
                        <br>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="particulier">
                                <h1>Inscription Particulier</h1>

                                <form class="wpcf7-form" method="POST" action="{{ url('/registration')}}" name="form_reg" >
                                    @csrf
                                    <div class="tz_meetup_wpcf7-form">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <p>
                                                    <input class="form-control" type="text" placeholder="Prénom *" aria-invalid="false" aria-required="true" size="40" value="{{old('firstname')}}" name="firstname" required>
                                                </p>
                                            </div>
                                            <div class="col-lg-6">
                                                <p>
                                                    <input class="form-control" type="text" placeholder="Nom *" aria-invalid="false" aria-required="true" size="40" value="{{old('lastname')}}" name="lastname" required>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <p>
                                                <select name="sexe" id="" class="form-control">
                                                    <option value="H">Homme</option>
                                                    <option value="F">Femme</option>
                                                </select>
                                                </p>
                                            </div>
                                            <div class="col-lg-6">
                                                <p>
                                                    <input class="form-control" type="email" placeholder="Email *" aria-invalid="false" aria-required="true" size="40" value="{{old('email')}}" name="email" required>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <p>
                                                    <input class="form-control" type="phone" placeholder="Téléphone Fixe *" aria-invalid="false" aria-required="true" size="40" value="{{old('phone_fixa')}}" name="phone_fixe" required>
                                                </p>
                                            </div>
                                            <div class="col-lg-6">
                                                <p>
                                                    <input class="form-control" type="phone" placeholder="Téléphone Mobile" aria-invalid="false" size="40" value="{{old('phone_mobile')}}" name="phone_mobile">
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <p>
                                                    <input class="form-control" type="text" placeholder="Pays d'Origine *" aria-invalid="false" aria-required="true" size="40" value="{{old('country')}}" name="country" required>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h5>Statut IIA 2023  : Adhérent</h5>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" onChange="afficherPiece()" name="adherant" type="radio" id="inlineCheckbox1" value="1">
                                                    <label class="form-check-label" for="inlineCheckbox1">Oui</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" onChange="afficherPiece()" name="adherant" type="radio" id="inlineCheckbox2" value="0" checked>
                                                    <label class="form-check-label" for="inlineCheckbox2">Non</label>
                                                </div>
                                                <p id="adherant" style="display:none">

                                                        <input class="form-control" type="text" placeholder="Numéro Adhérant *" aria-invalid="false" size="40" value="{{old('number_adherant')}}" name="number_adherant">

                                                </p>
                                            </div>

                                            <div class="col-lg-6">
                                                <h5>
                                                    Participation au Gala :
                                                </h5>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" name="gala" type="radio" id="inlineCheckbox1" value="1">
                                                    <label class="form-check-label" >Oui</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" name="gala" type="radio" id="inlineCheckbox2" value="0" checked>
                                                    <label class="form-check-label" >Non</label>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h5>Jeudi 15 juin 2023</h5>
                                                <h6>Atelier 1 : 14h30 - 15h00</h6>
                                                <div class="form-check form-check-inline">
                                                    <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input" name="atelier_j1_a1" type="radio"  value="1" required> A1 - Les trois lignes de maitrise: Quelle compréhension
                                                        pour les organisations afin d'une meilleure application
                                                        dans un contexte économique en constante évolution ?</label>
                                                </div>
                                                <br>
                                                <div class="form-check form-check-inline">

                                                    <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input" name="atelier_j1_a1" type="radio"  value="2" > A2 - Les interactions entre la conformité et l'audit interne
                                                        dans le secteur bancaire</label>
                                                </div><br>
                                                <div class="form-check form-check-inline">

                                                    <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input"  name="atelier_j1_a1" type="radio"  value="3" > A3 - Le contrôle interne dans le secteur public: un outil
                                                        indispensable pour le renforcement de l'intégrité, la
                                                        transparence et la reddition des comptes</label>
                                                </div><br>
                                                <h6>Atelier 2 : 15h05 - 15h35</h6>
                                                <div class="form-check form-check-inline">

                                                    <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input"  name="atelier_j1_a2" type="radio"  value="4" required> A4 - L'audit interne dans les assurances: les principaux
                                                        facteurs de développement de la fonction</label>
                                                </div><br>
                                                <div class="form-check form-check-inline">

                                                    <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input"  name="atelier_j1_a2" type="radio"  value="5" > A5 - Le renforcement du professionalisme: un atout majeur
                                                        pour le devenir de l'Auditeur interne</label>
                                                </div><br>
                                                <div class="form-check form-check-inline">

                                                    <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input"  name="atelier_j1_a2" type="radio"  value="6" > A6 - Les technologies innovantes: Quel challenge pour le
                                                        devenir de l'Audit Interne ?</label>
                                                </div><br>

                                            </div>

                                            <div class="col-lg-6">
                                                <h5>Vendredi 16 juin 2023</h5>
                                                <h6>Atelier 1: 11h00 - 11h30</h6>
                                                <div class="form-check form-check-inline">

                                                    <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input"  name="atelier_j2_a1" type="radio"  value="7" required> A7 - L'audit interne, le controle interne, et l'inspection:
                                                        comment organiser les activités pour optimiser le travail
                                                        des services d'inspection dans l'administration publique ?</label>
                                                </div><br>
                                                <div class="form-check form-check-inline">

                                                    <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input"  name="atelier_j2_a1" type="radio"  value="8" > A8 - Les trois délis (Fraude-corruption-blanchiement):
                                                        quels dispositifs de lutte efficace pour les organisations ?</label>
                                                </div><br>
                                                <div class="form-check form-check-inline">

                                                    <label style="font-weight: 400" class="form-check-label" >  <input class="form-check-input"  name="atelier_j2_a1" type="radio"  value="9" > A9 - Evaluation qualité de l'audit interne: pour une
                                                        amélioration continu et une crédibilté accrue</label>
                                                </div><br>
                                                <h6>Atelier 2: 11h35 - 12h05</h6>
                                                <div class="form-check form-check-inline">

                                                    <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input"  name="atelier_j2_a2" type="radio"  value="10" required> A10 - L'art de la bonne communication pour convaincre et
                                                        agir</label>
                                                </div><br>
                                                <div class="form-check form-check-inline">

                                                    <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input"  name="atelier_j2_a2" type="radio"  value="11" > A11 - L'audit à distance: les impacts sur la réalisation des
                                                        missions</label>
                                                </div><br>
                                                <div class="form-check form-check-inline">

                                                    <label  style="font-weight: 400"class="form-check-label" > <input class="form-check-input"  name="atelier_j2_a2" type="radio"  value="12" > A12 - La mise en oeuvre et le suivi des recommandations:
                                                        quelle responsabilté pour le management et quelle
                                                        responsabilité pour l'audit interne ?</label>
                                                </div><br>
                                            </div>
                                        </div>

                                        <p>
                                            <input class="wpcf7-form-control wpcf7-submit" type="submit" value="S'inscrire">
                                        </p>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="entreprise">
                                <h1>Inscription Entreprise</h1>

                                <form class="wpcf7-form" method="POST" action="{{ url('/entreprise')}}" name="form_ent" >
                                    @csrf
                                    <div class="tz_meetup_wpcf7-form">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <p>
                                                    <input class="form-control" type="text" placeholder="Nom de l'entreprise *" aria-invalid="false" aria-required="true" size="40" value="{{old('label')}}" name="label">
                                                </p>
                                            </div>
                                            <div class="col-lg-6">
                                                <p>
                                                    <input class="form-control" type="phone" placeholder="Téléphone *" aria-invalid="false" aria-required="true" size="40" value="{{old('phone')}}" name="phone">
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <p>
                                                    <input class="form-control" type="email" placeholder="Email *" aria-invalid="false" aria-required="true" size="40" value="{{old('email')}}" name="email">
                                                </p>
                                            </div>
                                            <div class="col-lg-6">
                                                <p>
                                                    <input class="form-control" type="text" placeholder="Adresse *" aria-invalid="false" aria-required="true" size="40" value="{{old('email')}}" name="adress">
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <p>
                                                    <input class="form-control" type="text" placeholder="Pays d'Origine *" aria-invalid="false" aria-required="true" size="40" value="{{old('country')}}" name="country">
                                                </p>
                                            </div>

                                            <div class="col-lg-6">
                                                <h5>
                                                    Participation au Gala :
                                                </h5>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" name="gala" type="radio" id="inlineCheckbox1" value="1">
                                                    <label class="form-check-label" >Oui</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" name="gala" type="radio" id="inlineCheckbox2" value="0" checked>
                                                    <label class="form-check-label" >Non</label>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <h4>Ajouter un participant <button type="button" class="btn btn-primary add">+ Ajouter</button> <button type="button" class="btn btn-danger remove">- Supprimer</button></h4>
                                        </div>
                                        <br>
                                        <div class="row membre" id="membre">
                                            <div class="row" id="mb1">
                                                <div class="col-lg-4">
                                                    <p>
                                                        <input class="form-control" type="text" placeholder="Prénom *" aria-invalid="false" aria-required="true" size="40" value="{{old('firstname')}}" name="firstname[]">
                                                    </p>
                                                </div>
                                                <div class="col-lg-4">
                                                    <p>
                                                        <input class="form-control" type="text" placeholder="Nom *" aria-invalid="false" aria-required="true" size="40" value="{{old('lastname')}}" name="lastname[]">
                                                    </p>
                                                </div>
                                                <div class="col-lg-2">
                                                    <p>
                                                    <select name="sexe[]" id="" class="form-control">
                                                        <option value="H">Homme</option>
                                                        <option value="F">Femme</option>
                                                    </select>
                                                    </p>
                                                </div>
                                                <div class="col-lg-2">

                                                </div>
                                            </div>
                                        </div>

                                        <br>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h5>Jeudi 15 juin 2023</h5>
                                                <h6>Atelier 1 : 14h30 - 15h00</h6>
                                                <div class="form-check form-check-inline">
                                                    <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input" name="atelier_j1_a1" type="radio"  value="1"> A1 - Les trois lignes de maitrise: Quelle compréhension
                                                        pour les organisations afin d'une meilleure application
                                                        dans un contexte économique en constante évolution ?</label>
                                                </div>
                                                <br>
                                                <div class="form-check form-check-inline">

                                                    <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input" name="atelier_j1_a1" type="radio"  value="2" > A2 - Les interactions entre la conformité et l'audit interne
                                                        dans le secteur bancaire</label>
                                                </div><br>
                                                <div class="form-check form-check-inline">

                                                    <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input"  name="atelier_j1_a1" type="radio"  value="3" > A3 - Le contrôle interne dans le secteur public: un outil
                                                        indispensable pour le renforcement de l'intégrité, la
                                                        transparence et la reddition des comptes</label>
                                                </div><br>
                                                <h6>Atelier 2 : 15h05 - 15h35</h6>
                                                <div class="form-check form-check-inline">

                                                    <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input"  name="atelier_j1_a2" type="radio"  value="4"> A4 - L'audit interne dans les assurances: les principaux
                                                        facteurs de développement de la fonction</label>
                                                </div><br>
                                                <div class="form-check form-check-inline">

                                                    <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input"  name="atelier_j1_a2" type="radio"  value="5" > A5 - Le renforcement du professionalisme: un atout majeur
                                                        pour le devenir de l'Auditeur interne</label>
                                                </div><br>
                                                <div class="form-check form-check-inline">

                                                    <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input"  name="atelier_j1_a2" type="radio"  value="6" > A6 - Les technologies innovantes: Quel challenge pour le
                                                        devenir de l'Audit Interne ?</label>
                                                </div><br>

                                            </div>

                                            <div class="col-lg-6">
                                                <h5>Vendredi 16 juin 2023</h5>
                                                <h6>Atelier 1: 11h00 - 11h30</h6>
                                                <div class="form-check form-check-inline">

                                                    <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input"  name="atelier_j2_a1" type="radio"  value="7"> A7 - L'audit interne, le controle interne, et l'inspection:
                                                        comment organiser les activités pour optimiser le travail
                                                        des services d'inspection dans l'administration publique ?</label>
                                                </div><br>
                                                <div class="form-check form-check-inline">

                                                    <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input"  name="atelier_j2_a1" type="radio"  value="8" > A8 - Les trois délis (Fraude-corruption-blanchiement):
                                                        quels dispositifs de lutte efficace pour les organisations ?</label>
                                                </div><br>
                                                <div class="form-check form-check-inline">

                                                    <label style="font-weight: 400" class="form-check-label" >  <input class="form-check-input"  name="atelier_j2_a1" type="radio"  value="9" > A9 - Evaluation qualité de l'audit interne: pour une
                                                        amélioration continu et une crédibilté accrue</label>
                                                </div><br>
                                                <h6>Atelier 2: 11h35 - 12h05</h6>
                                                <div class="form-check form-check-inline">

                                                    <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input"  name="atelier_j2_a2" type="radio"  value="10"> A10 - L'art de la bonne communication pour convaincre et
                                                        agir</label>
                                                </div><br>
                                                <div class="form-check form-check-inline">

                                                    <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input"  name="atelier_j2_a2" type="radio"  value="11" > A11 - L'audit à distance: les impacts sur la réalisation des
                                                        missions</label>
                                                </div><br>
                                                <div class="form-check form-check-inline">

                                                    <label  style="font-weight: 400"class="form-check-label" > <input class="form-check-input"  name="atelier_j2_a2" type="radio"  value="12" > A12 - La mise en oeuvre et le suivi des recommandations:
                                                        quelle responsabilté pour le management et quelle
                                                        responsabilité pour l'audit interne ?</label>
                                                </div><br>
                                            </div>
                                        </div>

                                        <p>
                                            <input class="wpcf7-form-control wpcf7-submit" type="button" value="S'inscrire">
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Tabs content -->
                    @endif


                </div>
                {{-- <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div class="tz_contact_meet_2">
                        <div class="tz_contact_detail_meet">
                            <span class="tz_contact_meet_icon">
                                <i class="fa fa-money"></i>
                            </span>
                            <h4>Prix</h4>
                        </div>
                        <div class="tz_meetup_contact_detail">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h6>Inscription avant le 20 mai </h6>
                                <p>Adhérent : </p>
                                <ul>
                                    <li>300 000 FCFA</li>
                                    <li>400 000 FCFA (Dîner Inclus)</li>
                                </ul>
                                <p>Externe : </p>
                                <ul>
                                    <li>430 000 FCFA</li>
                                    <li>530 000 FCFA (Dîner Inclus)</li>
                                </ul>
                                </div>
                                <div class="col-lg-6">
                                    <h6>Inscription après le 20 mai</h6>
                                <p>Adhérent : </p>
                                <ul>
                                    <li>370 000 FCFA</li>
                                    <li>470 000 FCFA (Dîner Inclus)</li>
                                </ul>
                                <p>Externe : </p>
                                <ul>
                                    <li>500 000 FCFA</li>
                                    <li>600 000 FCFA (Dîner Inclus)</li>
                                </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tz_contact_meet_2">
                        <div class="tz_contact_detail_meet">
                            <span class="tz_contact_meet_icon">
                                <i class="fa fa-clock-o"></i>
                            </span>
                            <h4>Dates</h4>
                        </div>
                        <div class="tz_meetup_contact_detail">
                            <p>Jeudi 15 juin 2023</p>
                            <p>Vendredi 16 juin 2023</p>
                        </div>
                    </div>
                    <div class="tz_contact_meet_2">
                        <div class="tz_contact_detail_meet">
                            <span class="tz_contact_meet_icon tz_contact_meet_icon_bk_1">
                                <i class="fa fa-map-marker"></i>
                            </span>
                            <h4>Salle</h4>
                        </div>
                        <div class="tz_meetup_contact_detail">
                            <p>Hôtel NOMAD</p>
                            <p>Libreville, Gabon</p>
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
                            <p> contact@conferenceiiagabon.ga</p>
                            <p>+241 77 07 18 56</p>

                        </div>
                    </div> --}}

                </div>

            </div>
        </div>
    </div>

</section>
<!-- Contact end -->

@endsection

@push('scripts')
@endpush
