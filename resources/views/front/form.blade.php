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
                            <p>ANPI, Centre-ville</p>
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
                                    <h6>Statut IIA 2023  : Adhérent</h6>
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
                                    <h6>
                                        Participation au Gala :
                                    </h6>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="gala" type="radio" id="inlineCheckbox1" value="1">
                                        <label class="form-check-label" for="inlineCheckbox1">Oui</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="gala" type="radio" id="inlineCheckbox2" value="0" checked>
                                        <label class="form-check-label" for="inlineCheckbox2">Non</label>
                                    </div>
                                </div>
                            </div>

                            <p>
                                <input class="wpcf7-form-control wpcf7-submit" type="submit" value="S'inscrire">
                            </p>
                        </div>
                    </form>
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
