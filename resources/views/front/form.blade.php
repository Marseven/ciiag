@extends('layouts.default')

@push('styles')
@endpush

@section('content')

 <!-- Contact start -->
<section id="tz_contact">


    <div class="tz_contact_icon_form">
        <div class="container">

            <div class="row">

                @include('layouts.flash')
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">


                    <form class="wpcf7-form" method="POST" action="{{ url('/registration')}}" name="form_reg" >
                        @csrf
                        <div class="tz_meetup_wpcf7-form">
                            <div class="row">
                                <div class="col-lg-6">
                                    <p>
                                        <input class="form-control" type="text" placeholder="Prénom *" aria-invalid="false" aria-required="true" size="40" value="{{old('firstname')}}" name="firstname">
                                    </p>
                                </div>
                                <div class="col-lg-6">
                                    <p>
                                        <input class="form-control" type="text" placeholder="Nom *" aria-invalid="false" aria-required="true" size="40" value="{{old('lastname')}}" name="lastname">
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
                                        <input class="form-control" type="email" placeholder="Email *" aria-invalid="false" aria-required="true" size="40" value="{{old('email')}}" name="email">
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <p>
                                        <input class="form-control" type="phone" placeholder="Téléphone Fixe *" aria-invalid="false" aria-required="true" size="40" value="{{old('phone_fixa')}}" name="phone_fixe">
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
                                        <input class="form-control" type="text" placeholder="Pays d'Origine *" aria-invalid="false" aria-required="true" size="40" value="{{old('country')}}" name="country">
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
                                <input class="wpcf7-form-control wpcf7-submit" type="submit" value="S'inscrire">
                            </p>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="tz_contact_meet_2">
                        <div class="tz_contact_detail_meet">
                            <span class="tz_contact_meet_icon">
                                <i class="fa fa-money"></i>
                            </span>
                            <h4>Prix</h4>
                        </div>
                        <div class="tz_meetup_contact_detail">
                            <h6>Inscription avant le 20 mai</h6>
                            <p>Adhérent : 300 000 FCFA</p>
                            <p>Externe : 430 000 FCFA</p>

                            <h6>Inscription après le 20 mai</h6>
                            <p>Adhérent : 370 000 FCFA</p>
                            <p>Externe : 500 000 FCFA</p>

                            <h6>Participation au Gala</h6>
                            <p>100 000 FCFA</p>
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
                            <p>contact@conferenceiiagabon.ga</p>
                            <p>+241 74 01 02 03</p>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</section>
<!-- Contact end -->

@endsection

@push('scripts')
<script language="JavaScript">
    function afficherPiece() {
            var adherant = document.getElementById("adherant");

            if (document.form_reg.adherant.value == 1) {
                adherant.style.display = "block";
            } else {
                adherant.style.display = "none";
            }
        }
</script>
@endpush
