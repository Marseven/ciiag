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

                    @if ($entity)
                        <div class="tz_width_column tz_text_box_slider_padding">
                            <div class="tz_check_width_right_position tz_custom_width tz_width_box" style="width: 490px;">
                                <div class="tz_maniva_meetup_title tz_box_text_bk text-left">
                                    <h3 class="tz_meetup_general_title tz_meetup_general_title_2">{{ __('form.thanks') }}</h3>
                                    <div class="tz_image_title_meetup">
                                        <hr>
                                    </div>
                                    <span class="tz_meetup_video_sub_title">
                                        <i class="fa fa-clock-o tz_icon_position_left"></i>
                                        15-16 {{ __('form.june') }} 2023 – {{ __('form.ticket') }} N°{{$entity->id}}
                                        <span class="tz_meetup_video_sub_title_line"></span>
                                    </span>
                                    @if ($type == "reg")
                                        <div class="tz_meetup_content">

                                            <ul class="tz-plazart-list">
                                                <li>
                                            <span class="tz_icon_maniva_list tz_icon_maniva_list_style_1">
                                                <i class="fa fa-check-square-o"></i>
                                            </span>
                                                    <p class="tz_list_item_content"> {{ __('form.lastname') }} & {{ __('form.firstname') }} : {{$entity->firstname}} {{$entity->lastname}} </p>
                                                </li>
                                                <li>
                                                    <span class="tz_icon_maniva_list tz_icon_maniva_list_style_1">
                                                        <i class="fa fa-check-square-o"></i>
                                                    </span>
                                                        <p class="tz_list_item_content"> {{ __('form.gender') }} : {{$entity->sexe == "F" ? "Femme" : "Homme"}} </p>
                                                </li>
                                                <li>
                                                    <span class="tz_icon_maniva_list tz_icon_maniva_list_style_1">
                                                        <i class="fa fa-check-square-o"></i>
                                                    </span>
                                                        <p class="tz_list_item_content"> {{ __('form.email') }} : {{$entity->email}}</p>
                                                </li>
                                                <li>
                                                    <span class="tz_icon_maniva_list tz_icon_maniva_list_style_1">
                                                        <i class="fa fa-check-square-o"></i>
                                                    </span>
                                                        <p class="tz_list_item_content"> {{ __('form.phone') }} : {{$entity->phone_mobile}} {{' /'.$entity->phone_fixe}} </p>
                                                </li>
                                                <li>
                                                    <span class="tz_icon_maniva_list tz_icon_maniva_list_style_1">
                                                        <i class="fa fa-check-square-o"></i>
                                                    </span>
                                                        <p class="tz_list_item_content"> {{ __('form.country') }} : {{$entity->country}}</p>
                                                </li>
                                                <li>
                                                    <span class="tz_icon_maniva_list tz_icon_maniva_list_style_1">
                                                        <i class="fa fa-check-square-o"></i>
                                                    </span>
                                                        <p class="tz_list_item_content"> {{ __('form.number-adherent') }} : {{$entity->adherant  == 1 ? $entity->number_adherant : "Pas adhérant"}}</p>
                                                </li>
                                                <li>
                                                    <span class="tz_icon_maniva_list tz_icon_maniva_list_style_1">
                                                        <i class="fa fa-check-square-o"></i>
                                                    </span>
                                                        <p class="tz_list_item_content"> {{ __('form.gala') }} : {{$entity->gala == 1 ? "Oui" : "Non"}} </p>
                                                </li>

                                                <li>
                                                    <span class="tz_icon_maniva_list tz_icon_maniva_list_style_1">
                                                        <i class="fa fa-check-square-o"></i>
                                                    </span>
                                                        <p class="tz_list_item_content"> {{ __('form.date1') }} : </p>
                                                        <ul>
                                                            <li>{{$entity->atelierj1->label}}</li>
                                                            <li>{{$entity->atelierj2->label}}</li>
                                                        </ul>
                                                </li>

                                                <li>
                                                    <span class="tz_icon_maniva_list tz_icon_maniva_list_style_1">
                                                        <i class="fa fa-check-square-o"></i>
                                                    </span>
                                                        <p class="tz_list_item_content"> {{ __('form.date2') }} : </p>
                                                        <ul>
                                                            <li>{{$entity->atelierj3->label}}</li>
                                                            <li>{{$entity->atelierj4->label}}</li>
                                                        </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    @else
                                        <div class="tz_meetup_content">

                                            <ul class="tz-plazart-list">
                                                <li>
                                            <span class="tz_icon_maniva_list tz_icon_maniva_list_style_1">
                                                <i class="fa fa-check-square-o"></i>
                                            </span>
                                                    <p class="tz_list_item_content"> {{ __('form.label-ent') }} : {{$entity->label}} </p>
                                                </li>
                                                <li>
                                                    <span class="tz_icon_maniva_list tz_icon_maniva_list_style_1">
                                                        <i class="fa fa-check-square-o"></i>
                                                    </span>
                                                        <p class="tz_list_item_content"> {{ __('form.email') }} : {{$entity->email}}</p>
                                                </li>
                                                <li>
                                                    <span class="tz_icon_maniva_list tz_icon_maniva_list_style_1">
                                                        <i class="fa fa-check-square-o"></i>
                                                    </span>
                                                        <p class="tz_list_item_content"> {{ __('form.phone') }} : {{$entity->phone}}</p>
                                                </li>
                                                <li>
                                                    <span class="tz_icon_maniva_list tz_icon_maniva_list_style_1">
                                                        <i class="fa fa-check-square-o"></i>
                                                    </span>
                                                        <p class="tz_list_item_content"> {{ __('form.country') }} : {{$entity->country}}</p>
                                                </li>
                                                <li>
                                                    <span class="tz_icon_maniva_list tz_icon_maniva_list_style_1">
                                                        <i class="fa fa-check-square-o"></i>
                                                    </span>
                                                        <p class="tz_list_item_content"> {{ __('form.number-adherent') }} : {{$entity->adherant  == 1 ? $entity->number_adherant : "Pas adhérant"}}</p>
                                                </li>
                                                <li>
                                                    <span class="tz_icon_maniva_list tz_icon_maniva_list_style_1">
                                                        <i class="fa fa-check-square-o"></i>
                                                    </span>
                                                        <p class="tz_list_item_content"> {{ __('form.gala') }} : {{$entity->gala == 1 ? "Oui" : "Non"}} </p>
                                                </li>

                                                <li>
                                                    <span class="tz_icon_maniva_list tz_icon_maniva_list_style_1">
                                                        <i class="fa fa-check-square-o"></i>
                                                    </span>
                                                        <p class="tz_list_item_content"> {{ __('form.date1') }} : </p>
                                                        <ul>
                                                            <li>{{$entity->atelierj1->label}}</li>
                                                            <li>{{$entity->atelierj2->label}}</li>
                                                        </ul>
                                                </li>

                                                <li>
                                                    <span class="tz_icon_maniva_list tz_icon_maniva_list_style_1">
                                                        <i class="fa fa-check-square-o"></i>
                                                    </span>
                                                        <p class="tz_list_item_content"> {{ __('form.date2') }} : </p>
                                                        <ul>
                                                            <li>{{$entity->atelierj3->label}}</li>
                                                            <li>{{$entity->atelierj4->label}}</li>
                                                        </ul>
                                                </li>

                                                <li>
                                                    <span class="tz_icon_maniva_list tz_icon_maniva_list_style_1">
                                                        <i class="fa fa-check-square-o"></i>
                                                    </span>
                                                        <p class="tz_list_item_content"> {{ __('form.list-members') }} : </p>
                                                        <ul>
                                                            @foreach ($entity->membres as $membre)
                                                                <li>{{$membre->sexe == 'F' ? 'Mme.' : 'M.'}} {{$membre->firstname}} {{$membre->lastname}}</li>
                                                            @endforeach
                                                        </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif

                                    <a class="tz_btn_video_meetup tz_btn_shop_meetup tz_meetup_btn_dark" onclick="javascript:window.print();" href="#">{{ __('form.download') }}</a>
                                </div>
                            </div>
                        </div>
                    @else
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
                                                <input class="form-check-input" onChange="afficherPiece()" name="adherant" type="radio" id="inlineCheckbox1" value="1">
                                                <label class="form-check-label" for="inlineCheckbox1">{{ __('form.yes') }}</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" onChange="afficherPiece()" name="adherant" type="radio" id="inlineCheckbox2" value="0" checked>
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
                                                <input class="form-check-input" name="gala" type="radio" id="inlineCheckbox1" value="1">
                                                <label class="form-check-label" >{{ __('form.yes') }}</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="gala" type="radio" id="inlineCheckbox2" value="0" checked>
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

                                    <p>
                                        <input class="wpcf7-form-control wpcf7-submit" type="submit" value="S'inscrire">
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
                                                <input class="form-check-input" onChange="afficherad()" name="adherant" type="radio" id="inlineCheckbox1" value="1">
                                                <label class="form-check-label" for="inlineCheckbox1">{{ __('form.yes') }}</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" onChange="afficherad()" name="adherant" type="radio" id="inlineCheckbox2" value="0" checked>
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
                                                <input class="form-check-input" name="gala" type="radio" id="inlineCheckbox1" value="1">
                                                <label class="form-check-label" >{{ __('form.yes') }}</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="gala" type="radio" id="inlineCheckbox2" value="0" checked>
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

                                    <p>
                                        <input class="wpcf7-form-control wpcf7-submit" type="submit" value="S'inscrire">
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<script language="JavaScript">
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
            alert('Vous ne pouvez pas ajouter plus de 20 membres au même moment.', 'Attention');
            return false;
        }

        var membre = document.getElementById("membre");
        content = '<div class="row" id="mb'+counter+'"><div class="col-lg-4"><p><input class="form-control" type="text" placeholder="Prénom *" aria-invalid="false" aria-required="true" size="40" value="" name="firstname[]"></p></div><div class="col-lg-4"><p><input class="form-control" type="text" placeholder="Nom *" aria-invalid="false" aria-required="true" size="40" value="" name="lastname[]"> </p></div><div class="col-lg-2"><p><select name="sexe[]" id="" class="form-control"><option value="H">Homme</option><option value="F">Femme</option></select></p></div><div class="col-lg-2"></div></div>';
        membre.insertAdjacentHTML('beforeend', content);
        counter++;

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

    });
</script>
@endpush
