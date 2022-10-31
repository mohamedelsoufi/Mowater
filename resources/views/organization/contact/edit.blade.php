@extends('organization.layouts.app')
@section('title','Mawatery | Contact')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.contact')}}</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.contact')}}</li>
                    </ol>
                </div>
                @include('organization.includes.alerts.success')
                @include('organization.includes.alerts.errors')
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        {{-- create modal start --}}
                        <div class="card-header">

                        </div>

                        <div class="card-body">
                            <form action="{{route('organization.contact.update')}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label>{{__('words.facebook_link')}}</label>
                                        <input type="text" name="facebook_link"
                                               value="{{$contact ? $contact->facebook_link : ''}}"
                                               class="form-control @error('facebook_link') is-invalid @enderror">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{__('words.whatsapp_number')}}</label>
                                        <input type="text" name="whatsapp_number"
                                               value="{{$contact ? $contact->whatsapp_number : ''}}"
                                               class="form-control @error('whatsapp_number') is-invalid @enderror">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{__('words.country_code')}}</label>
                                        <select class="form-control @error('country_code') is-invalid @enderror"
                                                name="country_code">
                                            <option data-countryCode="BH" value="+973" Selected>{{__('words.Bahrain')}}
                                                (+973)
                                            </option>
                                            <optgroup label="{{__('words.Other_countries')}}">
                                                <option data-countryCode="DZ"
                                                        value="+213" {{$contact->country_code == '+213' ? 'selected' : ''}}>
                                                    {{__('words.Bahrain')}} (+213)
                                                </option>
                                                <option data-countryCode="AD"
                                                        value="+376"{{$contact->country_code == '+376' ? 'selected' : ''}}>
                                                    {{__('words.Algeria')}} (+376)
                                                </option>
                                                <option data-countryCode="AO"
                                                        value="+244"{{$contact->country_code == '+244' ? 'selected' : ''}}>
                                                    {{__('words.Andorra')}} (+244)
                                                </option>
                                                <option data-countryCode="AI"
                                                        value="+1264"{{$contact->country_code == '+1264' ? 'selected' : ''}}>
                                                    {{__('words.Angola')}} (+1264)
                                                </option>
                                                <option data-countryCode="AG"
                                                        value="+1268"{{$contact->country_code == '+1268' ? 'selected' : ''}}>
                                                    {{__('words.Anguilla')}}
                                                    (+1268)
                                                </option>
                                                <option data-countryCode="AR"
                                                        value="+54" {{$contact->country_code == '+54' ? 'selected' : ''}}>
                                                    {{__('words.Antigua&Barbuda')}} (+54)
                                                </option>
                                                <option data-countryCode="AM"
                                                        value="+374"{{$contact->country_code == '+374' ? 'selected' : ''}}>
                                                    {{__('words.Argentina')}} (+374)
                                                </option>
                                                <option data-countryCode="AW"
                                                        value="+297"{{$contact->country_code == '+297' ? 'selected' : ''}}>
                                                    {{__('words.Armenia')}} (+297)
                                                </option>
                                                <option data-countryCode="AU"
                                                        value="+61"{{$contact->country_code == '+61' ? 'selected' : ''}}>
                                                    {{__('words.Aruba')}} (+61)
                                                </option>
                                                <option data-countryCode="AT"
                                                        value="+43"{{$contact->country_code == '+43' ? 'selected' : ''}}>
                                                    {{__('words.Australia')}} (+43)
                                                </option>
                                                <option data-countryCode="AZ"
                                                        value="+994"{{$contact->country_code == '+994' ? 'selected' : ''}}>
                                                    {{__('words.Austria')}} (+994)
                                                </option>
                                                <option data-countryCode="BS"
                                                        value="+1242"{{$contact->country_code == '+1242' ? 'selected' : ''}}>
                                                    {{__('words.Azerbaijan')}} (+1242)
                                                </option>
                                                {{--                                                <option data-countryCode="BH"--}}
                                                {{--                                                        value="+973" {{$contact->country_code == '+973' ? 'selected' : ''}}>--}}
                                                {{--                                                    Bahrain (+973)--}}
                                                {{--                                                </option>--}}
                                                <option data-countryCode="BD"
                                                        value="+880"{{$contact->country_code == '+880' ? 'selected' : ''}}>
                                                    {{__('words.Bahamas')}} (+880)
                                                </option>
                                                <option data-countryCode="BB"
                                                        value="+1246"{{$contact->country_code == '+1246' ? 'selected' : ''}}>
                                                    {{__('words.Bangladesh')}} (+1246)
                                                </option>
                                                <option data-countryCode="BY"
                                                        value="+375"{{$contact->country_code == '+375' ? 'selected' : ''}}>
                                                    {{__('words.Barbados')}} (+375)
                                                </option>
                                                <option data-countryCode="BE"
                                                        value="+32"{{$contact->country_code == '+32' ? 'selected' : ''}}>
                                                    {{__('words.Belarus')}} (+32)
                                                </option>
                                                <option data-countryCode="BZ"
                                                        value="+501"{{$contact->country_code == '+501' ? 'selected' : ''}}>
                                                    {{__('words.Belgium')}} (+501)
                                                </option>
                                                <option data-countryCode="BJ"
                                                        value="+229"{{$contact->country_code == '+229' ? 'selected' : ''}}>
                                                    {{__('words.Belize')}} (+229)
                                                </option>
                                                <option data-countryCode="BM"
                                                        value="+1441"{{$contact->country_code == '+1441' ? 'selected' : ''}}>
                                                    {{__('words.Benin')}} (+1441)
                                                </option>
                                                <option data-countryCode="BT"
                                                        value="+975"{{$contact->country_code == '+975' ? 'selected' : ''}}>
                                                    {{__('words.Bermuda')}} (+975)
                                                </option>
                                                <option data-countryCode="BO"
                                                        value="+591"{{$contact->country_code == '+591' ? 'selected' : ''}}>
                                                    {{__('words.Bhutan')}} (+591)
                                                </option>
                                                <option data-countryCode="BA"
                                                        value="+387"{{$contact->country_code == '+387' ? 'selected' : ''}}>
                                                    {{__('words.Bolivia')}} (+387)
                                                </option>
                                                <option data-countryCode="BW"
                                                        value="+267"{{$contact->country_code == '+267' ? 'selected' : ''}}>
                                                    {{__('words.Bosnia Herzegovina')}} (+267)
                                                </option>
                                                <option data-countryCode="BR"
                                                        value="+55"{{$contact->country_code == '+55' ? 'selected' : ''}}>
                                                    {{__('words.Botswana')}} (+55)
                                                </option>
                                                <option data-countryCode="BN"
                                                        value="+673"{{$contact->country_code == '+673' ? 'selected' : ''}}>
                                                    {{__('words.Brazil')}} (+673)
                                                </option>
                                                <option data-countryCode="BG"
                                                        value="+359"{{$contact->country_code == '+359' ? 'selected' : ''}}>
                                                    {{__('words.Brunei')}} (+359)
                                                </option>
                                                <option data-countryCode="BF"
                                                        value="+226"{{$contact->country_code == '+226' ? 'selected' : ''}}>
                                                    {{__('words.Bulgaria')}} (+226)
                                                </option>
                                                <option data-countryCode="BI"
                                                        value="+257"{{$contact->country_code == '+257' ? 'selected' : ''}}>
                                                    {{__('words.Burkina Faso')}} (+257)
                                                </option>
                                                <option data-countryCode="KH"
                                                        value="+855"{{$contact->country_code == '+855' ? 'selected' : ''}}>
                                                    {{__('words.Burundi')}} (+855)
                                                </option>
                                                <option data-countryCode="CM"
                                                        value="+237"{{$contact->country_code == '+237' ? 'selected' : ''}}>
                                                    {{__('words.Cambodia')}} (+237)
                                                </option>
                                                <option data-countryCode="CA"
                                                        value="+1"{{$contact->country_code == '+1' ? 'selected' : ''}}>
                                                    {{__('words.Cameroon')}} (+1)
                                                </option>
                                                <option data-countryCode="CV"
                                                        value="+238"{{$contact->country_code == '+238' ? 'selected' : ''}}>
                                                    {{__('words.Canada')}} (+238)
                                                </option>
                                                <option data-countryCode="KY"
                                                        value="+1345"{{$contact->country_code == '+1345' ? 'selected' : ''}}>
                                                    {{__('words.Cape Verde Islands')}} (+1345)
                                                </option>
                                                <option data-countryCode="CF"
                                                        value="+236"{{$contact->country_code == '+236' ? 'selected' : ''}}>
                                                    {{__('words.Cayman Islands')}}
                                                    (+236)
                                                </option>
                                                <option data-countryCode="CL"
                                                        value="+56"{{$contact->country_code == '+56' ? 'selected' : ''}}>
                                                    {{__('words.Central African Republic')}} (+56)
                                                </option>
                                                <option data-countryCode="CN"
                                                        value="+86"{{$contact->country_code == '+86' ? 'selected' : ''}}>
                                                    {{__('words.Chile')}} (+86)
                                                </option>
                                                <option data-countryCode="CO"
                                                        value="+57"{{$contact->country_code == '+57' ? 'selected' : ''}}>
                                                    {{__('words.China')}} (+57)
                                                </option>
                                                <option data-countryCode="KM"
                                                        value="+269"{{$contact->country_code == '+269' ? 'selected' : ''}}>
                                                    {{__('words.Colombia')}} (+269)
                                                </option>
                                                <option data-countryCode="CG"
                                                        value="+242"{{$contact->country_code == '+242' ? 'selected' : ''}}>
                                                    {{__('words.Comoros')}} (+242)
                                                </option>
                                                <option data-countryCode="CK"
                                                        value="+682"{{$contact->country_code == '+682' ? 'selected' : ''}}>
                                                    {{__('words.Congo')}} (+682)
                                                </option>
                                                <option data-countryCode="CR"
                                                        value="+506"{{$contact->country_code == '+506' ? 'selected' : ''}}>
                                                    {{__('words.Cook Islands')}} (+506)
                                                </option>
                                                <option data-countryCode="HR"
                                                        value="+385"{{$contact->country_code == '+385' ? 'selected' : ''}}>
                                                    {{__('words.Costa Rica')}} (+385)
                                                </option>
                                                <option data-countryCode="CU"
                                                        value="+53"{{$contact->country_code == '+53' ? 'selected' : ''}}>
                                                    {{__('words.Croatia')}} (+53)
                                                </option>
                                                <option data-countryCode="CY"
                                                        value="+90392"{{$contact->country_code == '+90392' ? 'selected' : ''}}>
                                                    {{__('words.Cuba')}} (+90392)
                                                </option>
                                                <option data-countryCode="CY"
                                                        value="+357"{{$contact->country_code == '+357' ? 'selected' : ''}}>
                                                    {{__('words.Cyprus North')}} (+357)
                                                </option>
                                                <option data-countryCode="CZ"
                                                        value="+42"{{$contact->country_code == '+42' ? 'selected' : ''}}>
                                                    {{__('words.Cyprus South')}} (+42)
                                                </option>
                                                <option data-countryCode="DK"
                                                        value="+45"{{$contact->country_code == '+45' ? 'selected' : ''}}>
                                                    {{__('words.Czech Republic')}} (+45)
                                                </option>
                                                <option data-countryCode="DJ"
                                                        value="+253"{{$contact->country_code == '+253' ? 'selected' : ''}}>
                                                    {{__('words.Denmark')}} (+253)
                                                </option>
                                                <option data-countryCode="DM"
                                                        value="+1809"{{$contact->country_code == '+1809' ? 'selected' : ''}}>
                                                    {{__('words.Djibouti')}} (+1809)
                                                </option>
                                                <option data-countryCode="DO"
                                                        value="+1809"{{$contact->country_code == '+1809' ? 'selected' : ''}}>
                                                    {{__('words.Dominica')}} (+1809)
                                                </option>
                                                <option data-countryCode="EC"
                                                        value="+593"{{$contact->country_code == '+593' ? 'selected' : ''}}>
                                                    {{__('words.Dominican Republic')}} (+593)
                                                </option>
                                                <option data-countryCode="EG"
                                                        value="+20"{{$contact->country_code == '+20' ? 'selected' : ''}}>
                                                    {{__('words.Ecuador')}} (+20)
                                                </option>
                                                <option data-countryCode="SV"
                                                        value="+503"{{$contact->country_code == '+503' ? 'selected' : ''}}>
                                                    {{__('words.Egypt')}} (+503)
                                                </option>
                                                <option data-countryCode="GQ"
                                                        value="+240"{{$contact->country_code == '+240' ? 'selected' : ''}}>
                                                    {{__('words.El Salvador')}}(+240)
                                                </option>
                                                <option data-countryCode="ER"
                                                        value="+291"{{$contact->country_code == '+291' ? 'selected' : ''}}>
                                                    {{__('words.Equatorial Guinea')}} (+291)
                                                </option>
                                                <option data-countryCode="EE"
                                                        value="+372"{{$contact->country_code == '+372' ? 'selected' : ''}}>
                                                    {{__('words.Eritrea')}} (+372)
                                                </option>
                                                <option data-countryCode="ET"
                                                        value="+251"{{$contact->country_code == '+251' ? 'selected' : ''}}>
                                                    {{__('words.Estonia')}} (+251)
                                                </option>
                                                <option data-countryCode="FK"
                                                        value="+500"{{$contact->country_code == '+500' ? 'selected' : ''}}>
                                                    {{__('words.Ethiopia')}} (+500)
                                                </option>
                                                <option data-countryCode="FO"
                                                        value="+298"{{$contact->country_code == '+298' ? 'selected' : ''}}>
                                                    {{__('words.Falkland Islands')}} (+298)
                                                </option>
                                                <option data-countryCode="FJ"
                                                        value="+679"{{$contact->country_code == '+679' ? 'selected' : ''}}>
                                                    {{__('words.Faroe Islands')}} (+679)
                                                </option>
                                                <option data-countryCode="FI"
                                                        value="+358"{{$contact->country_code == '+358' ? 'selected' : ''}}>
                                                    {{__('words.Fiji')}} (+358)
                                                </option>
                                                <option data-countryCode="FR"
                                                        value="+33"{{$contact->country_code == '+33' ? 'selected' : ''}}>
                                                    {{__('words.Finland')}} (+33)
                                                </option>
                                                <option data-countryCode="GF"
                                                        value="+594"{{$contact->country_code == '+594' ? 'selected' : ''}}>
                                                    {{__('words.France')}} (+594)
                                                </option>
                                                <option data-countryCode="PF"
                                                        value="+689"{{$contact->country_code == '+689' ? 'selected' : ''}}>
                                                    {{__('words.French Guiana')}} (+689)
                                                </option>
                                                <option data-countryCode="GA"
                                                        value="+241"{{$contact->country_code == '+241' ? 'selected' : ''}}>
                                                    {{__('words.French Polynesia')}} (+241)
                                                </option>
                                                <option data-countryCode="GM"
                                                        value="+220"{{$contact->country_code == '+220' ? 'selected' : ''}}>
                                                    {{__('words.Gabon')}} (+220)
                                                </option>
                                                <option data-countryCode="GE"
                                                        value="+7880"{{$contact->country_code == '+7880' ? 'selected' : ''}}>
                                                    {{__('words.Gambia')}} (+7880)
                                                </option>
                                                <option data-countryCode="DE"
                                                        value="+49"{{$contact->country_code == '+49' ? 'selected' : ''}}>
                                                    {{__('words.Georgia')}} (+49)
                                                </option>
                                                <option data-countryCode="GH"
                                                        value="+233"{{$contact->country_code == '+233' ? 'selected' : ''}}>
                                                    {{__('words.Germany')}} (+233)
                                                </option>
                                                <option data-countryCode="GI"
                                                        value="+350"{{$contact->country_code == '+350' ? 'selected' : ''}}>
                                                    {{__('words.Ghana')}} (+350)
                                                </option>
                                                <option data-countryCode="GR"
                                                        value="+30"{{$contact->country_code == '+30' ? 'selected' : ''}}>
                                                    {{__('words.Gibraltar')}} (+30)
                                                </option>
                                                <option data-countryCode="GL"
                                                        value="+299"{{$contact->country_code == '+299' ? 'selected' : ''}}>
                                                    {{__('words.Greece')}} (+299)
                                                </option>
                                                <option data-countryCode="GD"
                                                        value="+1473"{{$contact->country_code == '+1473' ? 'selected' : ''}}>
                                                    {{__('words.Greenland')}} (+1473)
                                                </option>
                                                <option data-countryCode="GP"
                                                        value="+590"{{$contact->country_code == '+590' ? 'selected' : ''}}>
                                                    {{__('words.Grenada')}} (+590)
                                                </option>
                                                <option data-countryCode="GU"
                                                        value="+671"{{$contact->country_code == '+671' ? 'selected' : ''}}>
                                                    {{__('words.Guadeloupe')}} (+671)
                                                </option>
                                                <option data-countryCode="GT"
                                                        value="+502"{{$contact->country_code == '+502' ? 'selected' : ''}}>
                                                    {{__('words.Guam')}} (+502)
                                                </option>
                                                <option data-countryCode="GN"
                                                        value="+224"{{$contact->country_code == '+224' ? 'selected' : ''}}>
                                                    {{__('words.Guatemala')}} (+224)
                                                </option>
                                                <option data-countryCode="GW"
                                                        value="+245"{{$contact->country_code == '+245' ? 'selected' : ''}}>
                                                    {{__('words.Guinea')}} (+245)
                                                </option>
                                                <option data-countryCode="GY"
                                                        value="+592"{{$contact->country_code == '+592' ? 'selected' : ''}}>
                                                    {{__('words.Guinea - Bissau')}} (+592)
                                                </option>
                                                <option data-countryCode="HT"
                                                        value="+509"{{$contact->country_code == '+509' ? 'selected' : ''}}>
                                                    {{__('words.Guyana')}} (+509)
                                                </option>
                                                <option data-countryCode="HN"
                                                        value="+504"{{$contact->country_code == '+504' ? 'selected' : ''}}>
                                                    {{__('words.Haiti')}} (+504)
                                                </option>
                                                <option data-countryCode="HK"
                                                        value="+852"{{$contact->country_code == '+852' ? 'selected' : ''}}>
                                                    {{__('words.Honduras')}} (+852)
                                                </option>
                                                <option data-countryCode="HU"
                                                        value="+36"{{$contact->country_code == '+36' ? 'selected' : ''}}>
                                                    {{__('words.Hong Kong')}} (+36)
                                                </option>
                                                <option data-countryCode="IS"
                                                        value="+354"{{$contact->country_code == '+354' ? 'selected' : ''}}>
                                                    {{__('words.Hungary')}} (+354)
                                                </option>
                                                <option data-countryCode="IN"
                                                        value="+91"{{$contact->country_code == '+91' ? 'selected' : ''}}>
                                                    {{__('words.Iceland')}} (+91)
                                                </option>
                                                <option data-countryCode="ID"
                                                        value="+62"{{$contact->country_code == '+62' ? 'selected' : ''}}>
                                                    {{__('words.India')}} (+62)
                                                </option>
                                                <option data-countryCode="IR"
                                                        value="+98"{{$contact->country_code == '+98' ? 'selected' : ''}}>
                                                    {{__('words.Indonesia')}} (+98)
                                                </option>
                                                <option data-countryCode="IQ"
                                                        value="+964"{{$contact->country_code == '+964' ? 'selected' : ''}}>
                                                    {{__('words.Iran')}} (+964)
                                                </option>
                                                <option data-countryCode="IE"
                                                        value="+353"{{$contact->country_code == '+353' ? 'selected' : ''}}>
                                                    {{__('words.Iraq')}} (+353)
                                                </option>
                                                <option data-countryCode="IL"
                                                        value="+972"{{$contact->country_code == '+972' ? 'selected' : ''}}>
                                                    {{__('words.Ireland')}} (+972)
                                                </option>
                                                <option data-countryCode="IT"
                                                        value="+39"{{$contact->country_code == '+39' ? 'selected' : ''}}>
                                                    {{__('words.Israel')}} (+39)
                                                </option>
                                                <option data-countryCode="JM"
                                                        value="+1876"{{$contact->country_code == '+1876' ? 'selected' : ''}}>
                                                    {{__('words.Italy')}} (+1876)
                                                </option>
                                                <option data-countryCode="JP"
                                                        value="+81"{{$contact->country_code == '+81' ? 'selected' : ''}}>
                                                    {{__('words.Jamaica')}} (+81)
                                                </option>
                                                <option data-countryCode="JO"
                                                        value="+962"{{$contact->country_code == '+962' ? 'selected' : ''}}>
                                                    {{__('words.Japan')}} (+962)
                                                </option>
                                                <option data-countryCode="KZ"
                                                        value="+7"{{$contact->country_code == '+7' ? 'selected' : ''}}>
                                                    {{__('words.Jordan')}} (+7)
                                                </option>
                                                <option data-countryCode="KE"
                                                        value="+254"{{$contact->country_code == '+254' ? 'selected' : ''}}>
                                                    {{__('words.Kazakhstan')}} (+254)
                                                </option>
                                                <option data-countryCode="KI"
                                                        value="+686"{{$contact->country_code == '+686' ? 'selected' : ''}}>
                                                    {{__('words.Kenya')}} (+686)
                                                </option>
                                                <option data-countryCode="KP"
                                                        value="+850"{{$contact->country_code == '+850' ? 'selected' : ''}}>
                                                    {{__('words.Kiribati')}} (+850)
                                                </option>
                                                <option data-countryCode="KR"
                                                        value="+82"{{$contact->country_code == '+82' ? 'selected' : ''}}>
                                                    {{__('words.Korea North')}} (+82)
                                                </option>
                                                <option data-countryCode="KW"
                                                        value="+965"{{$contact->country_code == '+965' ? 'selected' : ''}}>
                                                    {{__('words.Korea South')}} (+965)
                                                </option>
                                                <option data-countryCode="KG"
                                                        value="+996"{{$contact->country_code == '+996' ? 'selected' : ''}}>
                                                    {{__('words.Kuwait')}} (+996)
                                                </option>
                                                <option data-countryCode="LA"
                                                        value="+856"{{$contact->country_code == '+856' ? 'selected' : ''}}>
                                                    {{__('words.Kyrgyzstan')}} (+856)
                                                </option>
                                                <option data-countryCode="LV"
                                                        value="+371"{{$contact->country_code == '+371' ? 'selected' : ''}}>
                                                    {{__('words.Latvia')}} (+371)
                                                </option>
                                                <option data-countryCode="LB"
                                                        value="+961"{{$contact->country_code == '+961' ? 'selected' : ''}}>
                                                    {{__('words.Lebanon')}} (+961)
                                                </option>
                                                <option data-countryCode="LS"
                                                        value="+266"{{$contact->country_code == '+266' ? 'selected' : ''}}>
                                                    {{__('words.Lesotho')}} (+266)
                                                </option>
                                                <option data-countryCode="LR"
                                                        value="+231"{{$contact->country_code == '+231' ? 'selected' : ''}}>
                                                    {{__('words.Liberia')}} (+231)
                                                </option>
                                                <option data-countryCode="LY"
                                                        value="+218"{{$contact->country_code == '+218' ? 'selected' : ''}}>
                                                    {{__('words.Libya')}} (+218)
                                                </option>
                                                <option data-countryCode="LI"
                                                        value="+417"{{$contact->country_code == '+417' ? 'selected' : ''}}>
                                                    {{__('words.Liechtenstein')}} (+417)
                                                </option>
                                                <option data-countryCode="LT"
                                                        value="+370"{{$contact->country_code == '+370' ? 'selected' : ''}}>
                                                    {{__('words.Lithuania')}} (+370)
                                                </option>
                                                <option data-countryCode="LU"
                                                        value="+352"{{$contact->country_code == '+352' ? 'selected' : ''}}>
                                                    {{__('words.Luxembourg')}} (+352)
                                                </option>
                                                <option data-countryCode="MO"
                                                        value="+853"{{$contact->country_code == '+853' ? 'selected' : ''}}>
                                                    {{__('words.Macao')}} (+853)
                                                </option>
                                                <option data-countryCode="MK"
                                                        value="+389"{{$contact->country_code == '+389' ? 'selected' : ''}}>
                                                    {{__('words.Macedonia')}} (+389)
                                                </option>
                                                <option data-countryCode="MG"
                                                        value="+261"{{$contact->country_code == '+261' ? 'selected' : ''}}>
                                                    {{__('words.Madagascar')}} (+261)
                                                </option>
                                                <option data-countryCode="MW"
                                                        value="+265"{{$contact->country_code == '+265' ? 'selected' : ''}}>
                                                    {{__('words.Malawi')}} (+265)
                                                </option>
                                                <option data-countryCode="MY"
                                                        value="+60"{{$contact->country_code == '+60' ? 'selected' : ''}}>
                                                    {{__('words.Malaysia')}} (+60)
                                                </option>
                                                <option data-countryCode="MV"
                                                        value="+960"{{$contact->country_code == '+960' ? 'selected' : ''}}>
                                                    {{__('words.Maldives')}} (+960)
                                                </option>
                                                <option data-countryCode="ML"
                                                        value="+223"{{$contact->country_code == '+223' ? 'selected' : ''}}>
                                                    {{__('words.Mali')}} (+223)
                                                </option>
                                                <option data-countryCode="MT"
                                                        value="+356"{{$contact->country_code == '+356' ? 'selected' : ''}}>
                                                    {{__('words.Malta')}} (+356)
                                                </option>
                                                <option data-countryCode="MH"
                                                        value="+692"{{$contact->country_code == '+692' ? 'selected' : ''}}>
                                                    {{__('words.Marshall Islands')}} (+692)
                                                </option>
                                                <option data-countryCode="MQ"
                                                        value="+596"{{$contact->country_code == '+596' ? 'selected' : ''}}>
                                                    {{__('words.Martinique')}} (+596)
                                                </option>
                                                <option data-countryCode="MR"
                                                        value="+222"{{$contact->country_code == '+222' ? 'selected' : ''}}>
                                                    {{__('words.Mauritania')}} (+222)
                                                </option>
                                                <option data-countryCode="YT"
                                                        value="+269"{{$contact->country_code == '+269' ? 'selected' : ''}}>
                                                    {{__('words.Mayotte')}} (+269)
                                                </option>
                                                <option data-countryCode="MX"
                                                        value="+52"{{$contact->country_code == '+52' ? 'selected' : ''}}>
                                                    {{__('words.Mexico')}} (+52)
                                                </option>
                                                <option data-countryCode="FM"
                                                        value="+691"{{$contact->country_code == '+691' ? 'selected' : ''}}>
                                                    {{__('words.Micronesia')}} (+691)
                                                </option>
                                                <option data-countryCode="MD"
                                                        value="+373"{{$contact->country_code == '+373' ? 'selected' : ''}}>
                                                    {{__('words.Moldova')}} (+373)
                                                </option>
                                                <option data-countryCode="MC"
                                                        value="+377"{{$contact->country_code == '+377' ? 'selected' : ''}}>
                                                    {{__('words.Monaco')}} (+377)
                                                </option>
                                                <option data-countryCode="MN"
                                                        value="+976"{{$contact->country_code == '+976' ? 'selected' : ''}}>
                                                    {{__('words.Mongolia')}} (+976)
                                                </option>
                                                <option data-countryCode="MS"
                                                        value="+1664"{{$contact->country_code == '+1664' ? 'selected' : ''}}>
                                                    {{__('words.Montserrat')}} (+1664)
                                                </option>
                                                <option data-countryCode="MA"
                                                        value="+212"{{$contact->country_code == '+212' ? 'selected' : ''}}>
                                                    {{__('words.Morocco')}} (+212)
                                                </option>
                                                <option data-countryCode="MZ"
                                                        value="+258"{{$contact->country_code == '+258' ? 'selected' : ''}}>
                                                    {{__('words.Mozambique')}} (+258)
                                                </option>
                                                <option data-countryCode="MN"
                                                        value="+95"{{$contact->country_code == '+95' ? 'selected' : ''}}>
                                                    {{__('words.Myanmar')}} (+95)
                                                </option>
                                                <option data-countryCode="NA"
                                                        value="+264"{{$contact->country_code == '+264' ? 'selected' : ''}}>
                                                    {{__('words.Namibia')}} (+264)
                                                </option>
                                                <option data-countryCode="NR"
                                                        value="+674"{{$contact->country_code == '+674' ? 'selected' : ''}}>
                                                    {{__('words.Nauru')}} (+674)
                                                </option>
                                                <option data-countryCode="NP"
                                                        value="+977"{{$contact->country_code == '+977' ? 'selected' : ''}}>
                                                    {{__('words.Nepal')}} (+977)
                                                </option>
                                                <option data-countryCode="NL"
                                                        value="+31"{{$contact->country_code == '+31' ? 'selected' : ''}}>
                                                    {{__('words.Netherlands')}} (+31)
                                                </option>
                                                <option data-countryCode="NC"
                                                        value="+687"{{$contact->country_code == '+687' ? 'selected' : ''}}>
                                                    {{__('words.New Caledonia')}} (+687)
                                                </option>
                                                <option data-countryCode="NZ"
                                                        value="+64"{{$contact->country_code == '+64' ? 'selected' : ''}}>
                                                    {{__('words.New Zealand')}} (+64)
                                                </option>
                                                <option data-countryCode="NI"
                                                        value="+505"{{$contact->country_code == '+505' ? 'selected' : ''}}>
                                                    {{__('words.Nicaragua')}} (+505)
                                                </option>
                                                <option data-countryCode="NE"
                                                        value="+227"{{$contact->country_code == '+227' ? 'selected' : ''}}>
                                                    {{__('words.Niger')}} (+227)
                                                </option>
                                                <option data-countryCode="NG"
                                                        value="+234"{{$contact->country_code == '+234' ? 'selected' : ''}}>
                                                    {{__('words.Nigeria')}} (+234)
                                                </option>
                                                <option data-countryCode="NU"
                                                        value="+683"{{$contact->country_code == '+683' ? 'selected' : ''}}>
                                                    {{__('words.Niue')}} (+683)
                                                </option>
                                                <option data-countryCode="NF"
                                                        value="+672"{{$contact->country_code == '+672' ? 'selected' : ''}}>
                                                    {{__('words.Norfolk Islands')}} (+672)
                                                </option>
                                                <option data-countryCode="NP"
                                                        value="+670"{{$contact->country_code == '+670' ? 'selected' : ''}}>
                                                    {{__('words.Northern Marianas')}} (+670)
                                                </option>
                                                <option data-countryCode="NO"
                                                        value="+47"{{$contact->country_code == '+47' ? 'selected' : ''}}>
                                                    {{__('words.Norway')}} (+47)
                                                </option>
                                                <option data-countryCode="OM"
                                                        value="+968"{{$contact->country_code == '+968' ? 'selected' : ''}}>
                                                    {{__('words.Oman')}} (+968)
                                                </option>
                                                <option data-countryCode="PW"
                                                        value="+680"{{$contact->country_code == '+680' ? 'selected' : ''}}>
                                                    {{__('words.Palau')}} (+680)
                                                </option>
                                                <option data-countryCode="PA"
                                                        value="+507"{{$contact->country_code == '+507' ? 'selected' : ''}}>
                                                    {{__('words.Panama')}} (+507)
                                                </option>
                                                <option data-countryCode="PG"
                                                        value="+675"{{$contact->country_code == '+675' ? 'selected' : ''}}>
                                                    {{__('words.Papua New Guinea')}} (+675)
                                                </option>
                                                <option data-countryCode="PY"
                                                        value="+595"{{$contact->country_code == '+595' ? 'selected' : ''}}>
                                                    {{__('words.Paraguay')}} (+595)
                                                </option>
                                                <option data-countryCode="PE"
                                                        value="+51"{{$contact->country_code == '+51' ? 'selected' : ''}}>
                                                    {{__('words.Peru')}} (+51)
                                                </option>
                                                <option data-countryCode="PH"
                                                        value="+63"{{$contact->country_code == '+63' ? 'selected' : ''}}>
                                                    {{__('words.Philippines')}} (+63)
                                                </option>
                                                <option data-countryCode="PL"
                                                        value="+48"{{$contact->country_code == '+48' ? 'selected' : ''}}>
                                                    {{__('words.Poland')}} (+48)
                                                </option>
                                                <option data-countryCode="PT"
                                                        value="+351"{{$contact->country_code == '+351' ? 'selected' : ''}}>
                                                    {{__('words.Portugal')}} (+351)
                                                </option>
                                                <option data-countryCode="PR"
                                                        value="+1787"{{$contact->country_code == '+1787' ? 'selected' : ''}}>
                                                    {{__('words.Puerto')}} (+1787)
                                                </option>
                                                <option data-countryCode="QA"
                                                        value="+974"{{$contact->country_code == '+974' ? 'selected' : ''}}>
                                                    {{__('words.Qatar')}} (+974)
                                                </option>
                                                <option data-countryCode="RE"
                                                        value="+262"{{$contact->country_code == '+262' ? 'selected' : ''}}>
                                                    {{__('words.Reunion')}} (+262)
                                                </option>
                                                <option data-countryCode="RO"
                                                        value="+40"{{$contact->country_code == '+40' ? 'selected' : ''}}>
                                                    {{__('words.Romania')}} (+40)
                                                </option>
                                                <option data-countryCode="RU"
                                                        value="+7"{{$contact->country_code == '+7' ? 'selected' : ''}}>
                                                    {{__('words.Russia')}} (+7)
                                                </option>
                                                <option data-countryCode="RW"
                                                        value="+250"{{$contact->country_code == '+250' ? 'selected' : ''}}>
                                                    {{__('words.Rwanda')}} (+250)
                                                </option>
                                                <option data-countryCode="SM"
                                                        value="+378"{{$contact->country_code == '+378' ? 'selected' : ''}}>
                                                    {{__('words.San Marino')}} (+378)
                                                </option>
                                                <option data-countryCode="ST"
                                                        value="+239"{{$contact->country_code == '+239' ? 'selected' : ''}}>
                                                    {{__('words.Sao Tome & Principe')}}
                                                    (+239)
                                                </option>
                                                <option data-countryCode="SA"
                                                        value="+966"{{$contact->country_code == '+966' ? 'selected' : ''}}>
                                                    {{__('words.Saudi Arabia')}} (+966)
                                                </option>
                                                <option data-countryCode="SN"
                                                        value="+221"{{$contact->country_code == '+221' ? 'selected' : ''}}>
                                                    {{__('words.Senegal')}} (+221)
                                                </option>
                                                <option data-countryCode="CS"
                                                        value="+381"{{$contact->country_code == '+381' ? 'selected' : ''}}>
                                                    {{__('words.Serbia')}} (+381)
                                                </option>
                                                <option data-countryCode="SC"
                                                        value="+248"{{$contact->country_code == '+248' ? 'selected' : ''}}>
                                                    {{__('words.Seychelles')}} (+248)
                                                </option>
                                                <option data-countryCode="SL"
                                                        value="+232"{{$contact->country_code == '+232' ? 'selected' : ''}}>
                                                    {{__('words.Sierra Leone')}} (+232)
                                                </option>
                                                <option data-countryCode="SG"
                                                        value="+65"{{$contact->country_code == '+65' ? 'selected' : ''}}>
                                                    {{__('words.Singapore')}} (+65)
                                                </option>
                                                <option data-countryCode="SK"
                                                        value="+421"{{$contact->country_code == '+421' ? 'selected' : ''}}>
                                                    {{__('words.Slovak Republic')}} (+421)
                                                </option>
                                                <option data-countryCode="SI"
                                                        value="+386"{{$contact->country_code == '+386' ? 'selected' : ''}}>
                                                    {{__('words.Slovenia')}} (+386)
                                                </option>
                                                <option data-countryCode="SB"
                                                        value="+677"{{$contact->country_code == '+677' ? 'selected' : ''}}>
                                                    {{__('words.Solomon Islands')}} (+677)
                                                </option>
                                                <option data-countryCode="SO"
                                                        value="+252"{{$contact->country_code == '+252' ? 'selected' : ''}}>
                                                    {{__('words.Somalia')}} (+252)
                                                </option>
                                                <option data-countryCode="ZA"
                                                        value="+27"{{$contact->country_code == '+27' ? 'selected' : ''}}>
                                                    {{__('words.South Africa')}} (+27)
                                                </option>
                                                <option data-countryCode="ES"
                                                        value="+34"{{$contact->country_code == '+34' ? 'selected' : ''}}>
                                                    {{__('words.Spain')}} (+34)
                                                </option>
                                                <option data-countryCode="LK"
                                                        value="+94"{{$contact->country_code == '+94' ? 'selected' : ''}}>
                                                    {{__('words.Sri Lanka')}} (+94)
                                                </option>
                                                <option data-countryCode="SH"
                                                        value="+290"{{$contact->country_code == '+290' ? 'selected' : ''}}>
                                                    {{__('words.St. Helena')}} (+290)
                                                </option>
                                                <option data-countryCode="KN"
                                                        value="+1869"{{$contact->country_code == '+1869' ? 'selected' : ''}}>
                                                    {{__('words.St. Kitts')}} (+1869)
                                                </option>
                                                <option data-countryCode="SC"
                                                        value="+1758"{{$contact->country_code == '+1758' ? 'selected' : ''}}>
                                                    {{__('words.St. Lucia')}} (+1758)
                                                </option>
                                                <option data-countryCode="SD"
                                                        value="+249"{{$contact->country_code == '+249' ? 'selected' : ''}}>
                                                    {{__('words.Sudan')}} (+249)
                                                </option>
                                                <option data-countryCode="SR"
                                                        value="+597"{{$contact->country_code == '+597' ? 'selected' : ''}}>
                                                    {{__('words.Suriname')}} (+597)
                                                </option>
                                                <option data-countryCode="SZ"
                                                        value="+268"{{$contact->country_code == '+268' ? 'selected' : ''}}>
                                                    {{__('words.Swaziland')}} (+268)
                                                </option>
                                                <option data-countryCode="SE"
                                                        value="+46"{{$contact->country_code == '+46' ? 'selected' : ''}}>
                                                    {{__('words.Sweden')}} (+46)
                                                </option>
                                                <option data-countryCode="CH"
                                                        value="+41"{{$contact->country_code == '+41' ? 'selected' : ''}}>
                                                    {{__('words.Switzerland')}} (+41)
                                                </option>
                                                <option data-countryCode="SI"
                                                        value="+963"{{$contact->country_code == '+963' ? 'selected' : ''}}>
                                                    {{__('words.Syria')}} (+963)
                                                </option>
                                                <option data-countryCode="TW"
                                                        value="+886"{{$contact->country_code == '+886' ? 'selected' : ''}}>
                                                    {{__('words.Taiwan')}} (+886)
                                                </option>
                                                <option data-countryCode="TJ"
                                                        value="+7"{{$contact->country_code == '+7' ? 'selected' : ''}}>
                                                    {{__('words.Tajikstan')}} (+7)
                                                </option>
                                                <option data-countryCode="TH"
                                                        value="+66"{{$contact->country_code == '+66' ? 'selected' : ''}}>
                                                    {{__('words.Thailand')}} (+66)
                                                </option>
                                                <option data-countryCode="TG"
                                                        value="+228"{{$contact->country_code == '+228' ? 'selected' : ''}}>
                                                    {{__('words.Togo')}} (+228)
                                                </option>
                                                <option data-countryCode="TO"
                                                        value="+676"{{$contact->country_code == '+676' ? 'selected' : ''}}>
                                                    {{__('words.Tonga')}} (+676)
                                                </option>
                                                <option data-countryCode="TT"
                                                        value="+1868"{{$contact->country_code == '+1868' ? 'selected' : ''}}>
                                                    {{__('words.Trinidad')}}
                                                    (+1868)
                                                </option>
                                                <option data-countryCode="TN"
                                                        value="+216"{{$contact->country_code == '+216' ? 'selected' : ''}}>
                                                    {{__('words.Tunisia')}} (+216)
                                                </option>
                                                <option data-countryCode="TR"
                                                        value="+90"{{$contact->country_code == '+90' ? 'selected' : ''}}>
                                                    {{__('words.Turkey')}} (+90)
                                                </option>
                                                <option data-countryCode="TM"
                                                        value="+7"{{$contact->country_code == '+7' ? 'selected' : ''}}>
                                                    {{__('words.Turkmenistan')}} (+7)
                                                </option>
                                                <option data-countryCode="TM"
                                                        value="+993"{{$contact->country_code == '+993' ? 'selected' : ''}}>
                                                    {{__('words.Turkmenistan')}} (+993)
                                                </option>
                                                <option data-countryCode="TC"
                                                        value="+1649"{{$contact->country_code == '+1649' ? 'selected' : ''}}>
                                                    {{__('words.Turks & Caicos Islands')}}
                                                    (+1649)
                                                </option>
                                                <option data-countryCode="TV"
                                                        value="+688"{{$contact->country_code == '+688' ? 'selected' : ''}}>
                                                    {{__('words.Tuvalu')}} (+688)
                                                </option>
                                                <option data-countryCode="UG"
                                                        value="+256"{{$contact->country_code == '+256' ? 'selected' : ''}}>
                                                    {{__('words.Uganda')}} (+256)
                                                </option>
                                                <option data-countryCode="GB"
                                                        value="+44"{{$contact->country_code == '+44' ? 'selected' : ''}}>
                                                    {{__('words.UK')}} (+44)
                                                </option>
                                                <option data-countryCode="UA"
                                                        value="+380"{{$contact->country_code == '+380' ? 'selected' : ''}}>
                                                    {{__('words.Ukraine')}} (+380)
                                                </option>
                                                <option data-countryCode="AE"
                                                        value="+971"{{$contact->country_code == '+971' ? 'selected' : ''}}>
                                                    {{__('words.United Arab Emirates')}} (+971)
                                                </option>
                                                <option data-countryCode="UY"
                                                        value="+598"{{$contact->country_code == '+598' ? 'selected' : ''}}>
                                                    {{__('words.Uruguay')}} (+598)
                                                </option>
                                                <option data-countryCode="US"
                                                        value="+1"{{$contact->country_code == '+1' ? 'selected' : ''}}>
                                                    {{__('words.USA')}} (+1)
                                                </option>
                                                <option data-countryCode="UZ"
                                                        value="+7"{{$contact->country_code == '+7' ? 'selected' : ''}}>
                                                    {{__('words.Uzbekistan')}} (+7)
                                                </option>
                                                <option data-countryCode="VU"
                                                        value="+678"{{$contact->country_code == '+678' ? 'selected' : ''}}>
                                                    {{__('words.Vanuatu')}} (+678)
                                                </option>
                                                <option data-countryCode="VA"
                                                        value="+379"{{$contact->country_code == '+379' ? 'selected' : ''}}>
                                                    {{__('words.Vatican')}} (+379)
                                                </option>
                                                <option data-countryCode="VE"
                                                        value="+58"{{$contact->country_code == '+58' ? 'selected' : ''}}>
                                                    {{__('words.Venezuela')}} (+58)
                                                </option>
                                                <option data-countryCode="VN"
                                                        value="+84"{{$contact->country_code == '+84' ? 'selected' : ''}}>
                                                    {{__('words.Vietnam')}} (+84)
                                                </option>
                                                <option data-countryCode="VG"
                                                        value="+84"{{$contact->country_code == '+84' ? 'selected' : ''}}>
                                                    {{__('words.Virgin Islands - British')}}
                                                    (+1284)
                                                </option>
                                                <option data-countryCode="VI"
                                                        value="+84"{{$contact->country_code == '+84' ? 'selected' : ''}}>
                                                    {{__('words.Virgin Islands - US')}} (+1340)
                                                </option>
                                                <option data-countryCode="WF"
                                                        value="+681"{{$contact->country_code == '+681' ? 'selected' : ''}}>
                                                    {{__('words.Wallis & Futuna')}} (+681)
                                                </option>
                                                <option data-countryCode="YE"
                                                        value="+969"{{$contact->country_code == '+969' ? 'selected' : ''}}>
                                                    {{__('words.Yemen (North)')}}(+969)
                                                </option>
                                                <option data-countryCode="YE"
                                                        value="+967"{{$contact->country_code == '+967' ? 'selected' : ''}}>
                                                    {{__('words.Yemen (South)')}}(+967)
                                                </option>
                                                <option data-countryCode="ZM"
                                                        value="+260"{{$contact->country_code == '+260' ? 'selected' : ''}}>
                                                    {{__('words.Zambia')}} (+260)
                                                </option>
                                                <option data-countryCode="ZW"
                                                        value="+263"{{$contact->country_code == '+263' ? 'selected' : ''}}>
                                                    {{__('words.Zimbabwe')}} (+263)
                                                </option>
                                            </optgroup>
                                        </select>
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label>{{__('words.phone')}}</label>
                                        <input type="number" name="phone" value="{{$contact ? $contact->phone : ''}}"
                                               class="form-control @error('phone') is-invalid @enderror">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{__('words.website')}}</label>
                                        <input type="text" name="website" value="{{$contact ? $contact->website : ''}}"
                                               class="form-control @error('website') is-invalid @enderror">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{__('words.instagram_link')}}</label>
                                        <input type="text" name="instagram_link"
                                               value="{{$contact ? $contact->instagram_link : ''}}"
                                               class="form-control @error('instagram_link') is-invalid @enderror">
                                    </div>


                                </div>


                                <div class="modal-footer">

                                    <button type="submit" class="btn btn-outline-primary">{{__('words.edit')}}</button>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

@endsection

