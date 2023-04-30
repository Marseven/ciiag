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

                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">

                    <!-- Nav pills -->
                    <ul class="nav nav-pills">
                        <li class="nav-item active">
                            <a class="nav-link active" data-toggle="pill" href="#particulier" style="font-size: 2em; font-weight: 700;">{{ __('form.particular') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#entreprise" style="font-size: 2em; font-weight: 700;">{{ __('form.entreprise') }}</a>
                        </li>
                    </ul>
                    <br>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="particulier">
                            <h1>{{ __('form.title-form-part') }}</h1>

                            <form class="wpcf7-form" method="POST" action="{{ url('/registration')}}" name="form_reg" >
                                @csrf
                                <div class="tz_meetup_wpcf7-form">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <p>
                                                <input class="form-control" type="text" placeholder="{{ __('form.firstname') }} *" aria-invalid="false" aria-required="true" size="40" value="" name="firstname" required>
                                            </p>
                                        </div>
                                        <div class="col-lg-6">
                                            <p>
                                                <input class="form-control" type="text" placeholder="{{ __('form.lastname') }} *" aria-invalid="false" aria-required="true" size="40" value="" name="lastname" required>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <p>
                                            <select name="sexe" id="" class="form-control">
                                                <option value="H">{{ __('form.men') }}</option>
                                                <option value="F">{{ __('form.women') }}</option>
                                            </select>
                                            </p>
                                        </div>
                                        <div class="col-lg-6">
                                            <p>
                                                <input class="form-control" type="email" placeholder="{{ __('form.email') }} *" aria-invalid="false" aria-required="true" size="40" value="" name="email" required>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <p>
                                                <input class="form-control" type="phone" placeholder="{{ __('form.phone-mobile') }} *" aria-invalid="false" aria-required="true" size="40" value="" name="phone_mobile" required>
                                            </p>
                                        </div>
                                        <div class="col-lg-6">
                                            <p>
                                                <input class="form-control" type="phone" placeholder="{{ __('form.phone-fixe') }}" aria-invalid="false" size="40" value="" name="phone_fixe">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <p>
                                                <input class="form-control" type="text" placeholder="{{ __('form.country') }} *" aria-invalid="false" aria-required="true" size="40" value="" name="country" required>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h5>{{ __('form.status-iia') }}  : {{ __('form.adherent') }}</h5>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input adherant" onChange="afficherPiece()" name="adherant" type="radio" id="inlineCheckbox1" value="1">
                                                <label class="form-check-label" for="inlineCheckbox1">{{ __('form.yes') }}</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input adherant" onChange="afficherPiece()" name="adherant" type="radio" id="inlineCheckbox2" value="0" checked>
                                                <label class="form-check-label" for="inlineCheckbox2">{{ __('form.no') }}</label>
                                            </div>
                                            <p id="adherant" style="display:none">

                                                    <input class="form-control" type="text" placeholder="{{ __('form.number-adherent') }} *" aria-invalid="false" size="40" value="" name="number_adherant">

                                            </p>
                                        </div>

                                        <div class="col-lg-6">
                                            <h5>
                                                {{ __('form.gala') }} :
                                            </h5>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input gala" name="gala" type="radio" id="inlineCheckbox1" value="1">
                                                <label class="form-check-label" >{{ __('form.yes') }}</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input gala" name="gala" type="radio" id="inlineCheckbox2" value="0" checked>
                                                <label class="form-check-label" >{{ __('form.no') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h5>{{ __('form.date1') }}</h5>
                                            <h6>{{ __('form.atelier1') }}</h6>
                                            <div class="form-check form-check-inline">
                                                <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input" name="atelier_j1_a1" type="radio"  value="1" required> {{ __('form.a1') }}</label>
                                            </div>
                                            <br>
                                            <div class="form-check form-check-inline">

                                                <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input" name="atelier_j1_a1" type="radio"  value="2" > {{ __('form.a2') }}</label>
                                            </div><br>
                                            <div class="form-check form-check-inline">

                                                <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input"  name="atelier_j1_a1" type="radio"  value="3" > {{ __('form.a3') }}</label>
                                            </div><br>
                                            <h6>{{ __('form.atelier2') }}</h6>
                                            <div class="form-check form-check-inline">

                                                <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input"  name="atelier_j1_a2" type="radio"  value="4" required> {{ __('form.a4') }}</label>
                                            </div><br>
                                            <div class="form-check form-check-inline">

                                                <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input"  name="atelier_j1_a2" type="radio"  value="5" > {{ __('form.a5') }}</label>
                                            </div><br>
                                            <div class="form-check form-check-inline">

                                                <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input"  name="atelier_j1_a2" type="radio"  value="6" > {{ __('form.a6') }}</label>
                                            </div><br>

                                        </div>

                                        <div class="col-lg-6">
                                            <h5>{{ __('form.date2') }}</h5>
                                            <h6>{{ __('form.atelier3') }}</h6>
                                            <div class="form-check form-check-inline">

                                                <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input"  name="atelier_j2_a1" type="radio"  value="7" required> {{ __('form.a7') }}</label>
                                            </div><br>
                                            <div class="form-check form-check-inline">

                                                <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input"  name="atelier_j2_a1" type="radio"  value="8" > {{ __('form.a8') }}</label>
                                            </div><br>
                                            <div class="form-check form-check-inline">

                                                <label style="font-weight: 400" class="form-check-label" >  <input class="form-check-input"  name="atelier_j2_a1" type="radio"  value="9" > {{ __('form.a9') }}</label>
                                            </div><br>
                                            <h6>{{ __('form.atelier4') }}</h6>
                                            <div class="form-check form-check-inline">

                                                <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input"  name="atelier_j2_a2" type="radio"  value="10" required> {{ __('form.a10') }}</label>
                                            </div><br>
                                            <div class="form-check form-check-inline">

                                                <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input"  name="atelier_j2_a2" type="radio"  value="11" > {{ __('form.a11') }}</label>
                                            </div><br>
                                            <div class="form-check form-check-inline">

                                                <label  style="font-weight: 400"class="form-check-label" > <input class="form-check-input"  name="atelier_j2_a2" type="radio"  value="12" > {{ __('form.a12') }}</label>
                                            </div><br>
                                        </div>
                                    </div>

                                    <div id="budget">
                                        <h4>{{__('form.price_total')}}</h4>
                                        <ul>
                                            <li>{{__('form.montant_net')}} : <span id="item-montant-net"></span> {{__('form.devise')}}</li>
                                            <li>{{__('form.fees_eb')}} : <span id="item-montant-eb"></span> {{__('form.devise')}}</li>
                                        </ul>
                                        <h3>Total : <span id="item-montant-tt"></span> {{__('form.devise')}}</h3>
                                    </div>
                                    <br>
                                    <p>
                                        <input class="wpcf7-form-control wpcf7-submit" type="submit" value="{{ __('form.register') }}">
                                    </p>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="entreprise">
                            <h1>{{ __('form.title-form-ent') }}</h1>

                            <form class="wpcf7-form" method="POST" action="{{ url('/entreprise')}}" name="form_ent" >
                                @csrf
                                <div class="tz_meetup_wpcf7-form">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <p>
                                                <input class="form-control" type="text" placeholder="{{ __('form.label-ent') }} *" aria-invalid="false" aria-required="true" size="40" value="" name="label">
                                            </p>
                                        </div>
                                        <div class="col-lg-6">
                                            <p>
                                                <input class="form-control" type="phone" placeholder="{{ __('form.phone') }} *" aria-invalid="false" aria-required="true" size="40" value="" name="phone">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <p>
                                                <input class="form-control" type="email" placeholder="{{ __('form.email') }} *" aria-invalid="false" aria-required="true" size="40" value="" name="email">
                                            </p>
                                        </div>
                                        <div class="col-lg-6">
                                            <p>
                                                <input class="form-control" type="text" placeholder="{{ __('form.adress') }} *" aria-invalid="false" aria-required="true" size="40" value="" name="adress">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <p>
                                                <input class="form-control" type="text" placeholder="{{ __('form.country') }}e *" aria-invalid="false" aria-required="true" size="40" value="" name="country">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">


                                        <div class="col-lg-6">
                                            <h5>{{ __('form.status-iia') }}  : {{ __('form.adherent') }}</h5>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input adherant_ent" onChange="afficherad()" name="adherant" type="radio" id="inlineCheckbox1" value="1">
                                                <label class="form-check-label" for="inlineCheckbox1">{{ __('form.yes') }}</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input adherant_ent" onChange="afficherad()" name="adherant" type="radio" id="inlineCheckbox2" value="0" checked>
                                                <label class="form-check-label" for="inlineCheckbox2">{{ __('form.no') }}</label>
                                            </div>
                                            <p id="adherant_ent" style="display:none">
                                                <input class="form-control" type="text" placeholder="{{ __('form.number-adherent') }} *" aria-invalid="false" size="40" value="{{old('number_adherant')}}" name="number_adherant">
                                            </p>
                                        </div>

                                        <div class="col-lg-6">
                                            <h5>
                                                {{ __('form.gala') }} :
                                            </h5>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input gala_ent" name="gala" type="radio" id="inlineCheckbox1" value="1">
                                                <label class="form-check-label" >{{ __('form.yes') }}</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input gala_ent" name="gala" type="radio" id="inlineCheckbox2" value="0" checked>
                                                <label class="form-check-label" >{{ __('form.no') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <h4>{{ __('form.add-participant') }} <button type="button" class="btn btn-primary add">+ {{ __('form.add') }}</button> <button type="button" class="btn btn-danger remove">- {{ __('form.delete') }}</button></h4>
                                    </div>
                                    <br>
                                    <div class="row membre" id="membre">
                                        <div class="row" id="mb1">
                                            <div class="col-lg-4">
                                                <p>
                                                    <input class="form-control" type="text" placeholder="{{ __('form.firstname') }} *" aria-invalid="false" aria-required="true" size="40" value="" name="firstname[]">
                                                </p>
                                            </div>
                                            <div class="col-lg-4">
                                                <p>
                                                    <input class="form-control" type="text" placeholder="{{ __('form.lastname') }} *" aria-invalid="false" aria-required="true" size="40" value="" name="lastname[]">
                                                </p>
                                            </div>
                                            <div class="col-lg-2">
                                                <p>
                                                <select name="sexe[]" id="" class="form-control">
                                                    <option value="H">{{ __('form.men') }}</option>
                                                    <option value="F">{{ __('form.women') }}</option>
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
                                            <h5>{{ __('form.date1') }}</h5>
                                            <h6>{{ __('form.atelier1') }}</h6>
                                            <div class="form-check form-check-inline">
                                                <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input" name="atelier_j1_a1" type="radio"  value="1" required> {{ __('form.a1') }}</label>
                                            </div>
                                            <br>
                                            <div class="form-check form-check-inline">

                                                <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input" name="atelier_j1_a1" type="radio"  value="2" > {{ __('form.a2') }}</label>
                                            </div><br>
                                            <div class="form-check form-check-inline">

                                                <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input"  name="atelier_j1_a1" type="radio"  value="3" > {{ __('form.a3') }}</label>
                                            </div><br>
                                            <h6>{{ __('form.atelier2') }}</h6>
                                            <div class="form-check form-check-inline">

                                                <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input"  name="atelier_j1_a2" type="radio"  value="4" required> {{ __('form.a4') }}</label>
                                            </div><br>
                                            <div class="form-check form-check-inline">

                                                <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input"  name="atelier_j1_a2" type="radio"  value="5" > {{ __('form.a5') }}</label>
                                            </div><br>
                                            <div class="form-check form-check-inline">

                                                <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input"  name="atelier_j1_a2" type="radio"  value="6" > {{ __('form.a6') }}</label>
                                            </div><br>

                                        </div>

                                        <div class="col-lg-6">
                                            <h5>{{ __('form.date2') }}</h5>
                                            <h6>{{ __('form.atelier3') }}</h6>
                                            <div class="form-check form-check-inline">

                                                <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input"  name="atelier_j2_a1" type="radio"  value="7" required> {{ __('form.a7') }}</label>
                                            </div><br>
                                            <div class="form-check form-check-inline">

                                                <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input"  name="atelier_j2_a1" type="radio"  value="8" > {{ __('form.a8') }}</label>
                                            </div><br>
                                            <div class="form-check form-check-inline">

                                                <label style="font-weight: 400" class="form-check-label" >  <input class="form-check-input"  name="atelier_j2_a1" type="radio"  value="9" > {{ __('form.a9') }}</label>
                                            </div><br>
                                            <h6>{{ __('form.atelier4') }}</h6>
                                            <div class="form-check form-check-inline">

                                                <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input"  name="atelier_j2_a2" type="radio"  value="10" required> {{ __('form.a10') }}</label>
                                            </div><br>
                                            <div class="form-check form-check-inline">

                                                <label style="font-weight: 400" class="form-check-label" > <input class="form-check-input"  name="atelier_j2_a2" type="radio"  value="11" > {{ __('form.a11') }}</label>
                                            </div><br>
                                            <div class="form-check form-check-inline">

                                                <label  style="font-weight: 400"class="form-check-label" > <input class="form-check-input"  name="atelier_j2_a2" type="radio"  value="12" > {{ __('form.a12') }}</label>
                                            </div><br>
                                        </div>
                                    </div>

                                    <div id="budget-ent">
                                        <h4>{{__('form.price_total')}}</h4>
                                        <ul>
                                            <li>{{__('form.montant_net')}} : <span id="item-montant-net-ent"></span> {{__('form.devise')}}</li>
                                            <li>{{__('form.fees_eb')}} : <span id="item-montant-eb-ent"></span> {{__('form.devise')}}</li>
                                        </ul>
                                        <h3>Total : <span id="item-montant-tt-ent"></span> {{__('form.devise')}}</h3>
                                    </div>



                                    <p>
                                        <input class="wpcf7-form-control wpcf7-submit" type="submit" value="{{ __('form.register') }}">
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Tabs content -->

                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div class="tz_contact_meet_2">
                        <div class="tz_contact_detail_meet">
                            <span class="tz_contact_meet_icon">
                                <i class="fa fa-money"></i>
                            </span>
                            <h4>{{ __('form.price') }}</h4>
                        </div>
                        <div class="tz_meetup_contact_detail">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h6>{{ __('form.inscription-before') }} </h6>
                                <p>{{ __('form.adherent') }} : </p>
                                <ul>
                                    <li>{{ __('form.price_a_bf') }}</li>
                                    <li>{{ __('form.price_a_bf_g') }} ({{ __('form.diner') }})</li>
                                </ul>
                                <p>{{ __('form.externe') }} : </p>
                                <ul>
                                    <li>{{ __('form.price_e_bf') }}</li>
                                    <li>{{ __('form.price_e_bf_g') }} ({{ __('form.diner') }})</li>
                                </ul>
                                </div>
                                <div class="col-lg-6">
                                    <h6>{{ __('form.inscription-after') }}</h6>
                                <p>{{ __('form.adherent') }} : </p>
                                <ul>
                                    <li>{{ __('form.price_a_af') }}</li>
                                    <li>{{ __('form.price_a_af_g') }} ({{ __('form.diner') }})</li>
                                </ul>
                                <p>Externe : </p>
                                <ul>
                                    <li>{{ __('form.price_e_af') }}</li>
                                    <li>{{ __('form.price_e_af_g') }} ({{ __('form.diner') }})</li>
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
                            <h4>{{ __('form.dates') }}</h4>
                        </div>
                        <div class="tz_meetup_contact_detail">
                            <p>{{ __('form.date1') }}</p>
                            <p>{{ __('form.date2') }}</p>
                        </div>
                    </div>
                    <div class="tz_contact_meet_2">
                        <div class="tz_contact_detail_meet">
                            <span class="tz_contact_meet_icon tz_contact_meet_icon_bk_1">
                                <i class="fa fa-map-marker"></i>
                            </span>
                            <h4>{{ __('form.salle') }}</h4>
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
                            <h4> {{ __('form.more-infos') }} </h4>
                        </div>
                        <div class="tz_meetup_contact_detail">
                            <p> contact@conferenceiiagabon.ga</p>
                            <p>+241 77 07 18 56</p>

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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <script language="JavaScript">

        function formatNumber(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
        }


        function afficherPiece() {
            var adherant = document.getElementById("adherant");

            if (document.form_reg.adherant.value == 1) {
                adherant.style.display = "block";
            } else {
                adherant.style.display = "none";
            }
        }

        function afficherad() {
            var adherant = document.getElementById("adherant_ent");

            if (document.form_ent.adherant.value == 1) {
                adherant.style.display = "block";
            } else {
                adherant.style.display = "none";
            }
        }

        var counter = 2;

        $(".add").click(function(e) {
            e.preventDefault();
            if (counter > 10) {
                alert('Vous ne pouvez pas ajouter plus de 10 membres au même moment.', 'Attention');
                return false;
            }

            var membre = document.getElementById("membre");
            content = '<div class="row" id="mb'+counter+'"><div class="col-lg-4"><p><input class="form-control" type="text" placeholder="Prénom *" aria-invalid="false" aria-required="true" size="40" value="" name="firstname[]"></p></div><div class="col-lg-4"><p><input class="form-control" type="text" placeholder="Nom *" aria-invalid="false" aria-required="true" size="40" value="" name="lastname[]"> </p></div><div class="col-lg-2"><p><select name="sexe[]" id="" class="form-control"><option value="H">Homme</option><option value="F">Femme</option></select></p></div><div class="col-lg-2"></div></div>';
            membre.insertAdjacentHTML('beforeend', content);
            counter++;
            pay_ent();

        });

        //delete forms
        $(".remove").click(function(e) {
            e.preventDefault();

            if (counter == 2) {
                alert('Il n y a rien à supprimer', 'Attention');
                return false;
            }

            counter--;
            var index = counter - 1;
            var mb = document.getElementById("mb" + counter);
            mb.remove();
            pay_ent();

        });

        var today = new Date();
        var date_limite = new Date('2023-05-20');
        var montant_net = 0;
        var fees_eb = 0;
        var aPayer = 0;

        function pay_reg(){
            if(today <= date_limite){
                if(document.form_reg.adherant.value == 1){
                    montant_net = 300000;
                }else{
                    montant_net = 450000;
                }
            }else{
                if(document.form_reg.adherant.value == 1){
                    montant_net = 370000;
                }else{
                    montant_net = 520000;
                }

            }

            if(document.form_reg.gala.value == 1){ montant_net += 100000;}

            fees_eb = montant_net * 0.025;

            aPayer = montant_net+fees_eb;

            if(document.documentElement.lang == "en"){
                montant_net /= 655.997;
                fees_eb /= 655.997;
                aPayer /= 655.997;
            }

            $("#item-montant-net").html(formatNumber(montant_net.toFixed(0)));
            $("#item-montant-eb").html(formatNumber(fees_eb.toFixed(0)));
            $("#item-montant-tt").html(formatNumber(aPayer.toFixed(0)));
        }

        pay_reg();

        $(".gala").click(function() {

            pay_reg();
        });

        $(".adherant").click(function() {

            pay_reg();
        });

        var montant_net_ent = 0;
        var fees_eb_ent = 0;
        var aPayer_ent = 0;

        function pay_ent(){
            if(today <= date_limite){
                if(document.form_ent.adherant.value == 1){
                    montant_net_ent = 300000;
                }else{
                    montant_net_ent = 450000;
                }
            }else{
                if(document.form_ent.adherant.value == 1){
                    montant_net_ent = 370000;
                }else{
                    montant_net_ent = 520000;
                }

            }

            if(document.form_ent.gala.value == 1){ montant_net_ent += 100000;}

            montant_net_ent *= (counter-1);

            fees_eb_ent = montant_net_ent * 0.025;

            aPayer_ent = montant_net_ent+fees_eb_ent;

            if(document.documentElement.lang == "en"){
                montant_net_ent /= 655.997;
                fees_eb_ent /= 655.997;
                aPayer_ent /= 655.997;
            }

            $("#item-montant-net-ent").html(formatNumber(montant_net_ent.toFixed(0)));
            $("#item-montant-eb-ent").html(formatNumber(fees_eb_ent.toFixed(0)));
            $("#item-montant-tt-ent").html(formatNumber(aPayer_ent.toFixed(0)));
        }

        pay_ent();

        $(".gala_ent").click(function() {

            pay_ent();
        });

        $(".adherant_ent").click(function() {

            pay_ent();
        });
    </script>
@endpush
