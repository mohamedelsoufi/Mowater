<!-- Modal -->
<div class="modal fade" id="storePhone" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="storePhoneLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="storePhoneLabel">{{__('words.new_phone')}}</h5>
                <button type="button" class="close {{App::isLocale('ar') ? 'modal-x-sign' : ''}}" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('organization.phone.store')}}" id="store_form" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="basic-form">
                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label>{{__('words.country_code')}}</label>
                                    <select class="form-control @error('country_code') is-invalid @enderror" name="country_code">
                                        <option data-countryCode="BH" value="+973" Selected>{{__('words.Bahrain')}} (+973)</option>
                                        <optgroup label="{{__('words.Other_countries')}}">
                                            <option data-countryCode="DZ" value="+213">{{__('words.Algeria')}} (+213)</option>
                                            <option data-countryCode="AD" value="+376">{{__('words.Andorra')}} (+376)</option>
                                            <option data-countryCode="AO" value="+244">{{__('words.Angola')}} (+244)</option>
                                            <option data-countryCode="AI" value="+1264">{{__('words.Anguilla')}} (+1264)</option>
                                            <option data-countryCode="AG" value="+1268">{{__('words.Antigua&Barbuda')}}
                                                (+1268)
                                            </option>
                                            <option data-countryCode="AR" value="+54">{{__('words.Argentina')}} (+54)</option>
                                            <option data-countryCode="AM" value="+374">{{__('words.Armenia')}} (+374)</option>
                                            <option data-countryCode="AW" value="+297">{{__('words.Aruba')}} (+297)</option>
                                            <option data-countryCode="AU" value="+61">{{__('words.Australia')}} (+61)</option>
                                            <option data-countryCode="AT" value="+43">{{__('words.Austria')}} (+43)</option>
                                            <option data-countryCode="AZ" value="+994">{{__('words.Azerbaijan')}} (+994)</option>
                                            <option data-countryCode="BS" value="+1242">{{__('words.Bahamas')}} (+1242)</option>
{{--                                            <option data-countryCode="BH" value="+973" Selected>Bahrain (+973)</option>--}}
                                            <option data-countryCode="BD" value="+880">{{__('words.Bangladesh')}} (+880)</option>
                                            <option data-countryCode="BB" value="+1246">{{__('words.Barbados')}} (+1246)</option>
                                            <option data-countryCode="BY" value="+375">{{__('words.Belarus')}} (+375)</option>
                                            <option data-countryCode="BE" value="+32">{{__('words.Belgium')}} (+32)</option>
                                            <option data-countryCode="BZ" value="+501">{{__('words.Belize')}} (+501)</option>
                                            <option data-countryCode="BJ" value="+229">{{__('words.Benin')}} (+229)</option>
                                            <option data-countryCode="BM" value="+1441">{{__('words.Bermuda')}} (+1441)</option>
                                            <option data-countryCode="BT" value="+975">{{__('words.Bhutan')}} (+975)</option>
                                            <option data-countryCode="BO" value="+591">{{__('words.Bolivia')}} (+591)</option>
                                            <option data-countryCode="BA" value="+387">{{__('words.Bosnia Herzegovina')}} (+387)
                                            </option>
                                            <option data-countryCode="BW" value="+267">{{__('words.Botswana')}} (+267)</option>
                                            <option data-countryCode="BR" value="+55">{{__('words.Brazil')}} (+55)</option>
                                            <option data-countryCode="BN" value="+673">{{__('words.Brunei')}} (+673)</option>
                                            <option data-countryCode="BG" value="+359">{{__('words.Bulgaria')}} (+359)</option>
                                            <option data-countryCode="BF" value="+226">{{__('words.Burkina Faso')}} (+226)</option>
                                            <option data-countryCode="BI" value="+257">{{__('words.Burundi')}} (+257)</option>
                                            <option data-countryCode="KH" value="+855">{{__('words.Cambodia')}} (+855)</option>
                                            <option data-countryCode="CM" value="+237">{{__('words.Cameroon')}} (+237)</option>
                                            <option data-countryCode="CA" value="+1">{{__('words.Canada')}} (+1)</option>
                                            <option data-countryCode="CV" value="+238">{{__('words.Cape Verde Islands')}} (+238)
                                            </option>
                                            <option data-countryCode="KY" value="+1345">{{__('words.Cayman Islands')}} (+1345)
                                            </option>
                                            <option data-countryCode="CF" value="+236">{{__('words.Central African Republic')}}
                                                (+236)
                                            </option>
                                            <option data-countryCode="CL" value="+56">{{__('words.Chile')}} (+56)</option>
                                            <option data-countryCode="CN" value="+86">{{__('words.China')}} (+86)</option>
                                            <option data-countryCode="CO" value="+57">{{__('words.Colombia')}} (+57)</option>
                                            <option data-countryCode="KM" value="+269">{{__('words.Comoros')}} (+269)</option>
                                            <option data-countryCode="CG" value="+242">{{__('words.Congo')}} (+242)</option>
                                            <option data-countryCode="CK" value="+682">{{__('words.Cook Islands')}} (+682)</option>
                                            <option data-countryCode="CR" value="+506">{{__('words.Costa Rica')}} (+506)</option>
                                            <option data-countryCode="HR" value="+385">{{__('words.Croatia')}} (+385)</option>
                                            <option data-countryCode="CU" value="+53">{{__('words.Cuba')}} (+53)</option>
                                            <option data-countryCode="CY" value="+90392">{{__('words.Cyprus North')}} (+90392)
                                            </option>
                                            <option data-countryCode="CY" value="+357">{{__('words.Cyprus South')}} (+357)</option>
                                            <option data-countryCode="CZ" value="+42">{{__('words.Czech Republic')}} (+42)</option>
                                            <option data-countryCode="DK" value="+45">{{__('words.Denmark')}} (+45)</option>
                                            <option data-countryCode="DJ" value="+253">{{__('words.Djibouti')}} (+253)</option>
                                            <option data-countryCode="DM" value="+1809">{{__('words.Dominica')}} (+1809)</option>
                                            <option data-countryCode="DO" value="+1809">{{__('words.Dominican Republic')}} (+1809)
                                            </option>
                                            <option data-countryCode="EC" value="+593">{{__('words.Ecuador')}} (+593)</option>
                                            <option data-countryCode="EG" value="+20">{{__('words.Egypt')}} (+20)</option>
                                            <option data-countryCode="SV" value="+503">{{__('words.El Salvador')}} (+503)</option>
                                            <option data-countryCode="GQ" value="+240">{{__('words.Equatorial Guinea')}} (+240)
                                            </option>
                                            <option data-countryCode="ER" value="+291">{{__('words.Eritrea')}} (+291)</option>
                                            <option data-countryCode="EE" value="+372">{{__('words.Estonia')}} (+372)</option>
                                            <option data-countryCode="ET" value="+251">{{__('words.Ethiopia')}} (+251)</option>
                                            <option data-countryCode="FK" value="+500">{{__('words.Falkland Islands')}} (+500)
                                            </option>
                                            <option data-countryCode="FO" value="+298">{{__('words.Faroe Islands')}} (+298)</option>
                                            <option data-countryCode="FJ" value="+679">{{__('words.Fiji')}} (+679)</option>
                                            <option data-countryCode="FI" value="+358">{{__('words.Finland')}} (+358)</option>
                                            <option data-countryCode="FR" value="+33">{{__('words.France')}} (+33)</option>
                                            <option data-countryCode="GF" value="+594">{{__('words.French Guiana')}} (+594)</option>
                                            <option data-countryCode="PF" value="+689">{{__('words.French Polynesia')}} (+689)
                                            </option>
                                            <option data-countryCode="GA" value="+241">{{__('words.Gabon')}} (+241)</option>
                                            <option data-countryCode="GM" value="+220">{{__('words.Gambia')}} (+220)</option>
                                            <option data-countryCode="GE" value="+7880">{{__('words.Georgia')}} (+7880)</option>
                                            <option data-countryCode="DE" value="+49">{{__('words.Germany')}} (+49)</option>
                                            <option data-countryCode="GH" value="+233">{{__('words.Ghana')}} (+233)</option>
                                            <option data-countryCode="GI" value="+350">{{__('words.Gibraltar')}} (+350)</option>
                                            <option data-countryCode="GR" value="+30">{{__('words.Greece')}} (+30)</option>
                                            <option data-countryCode="GL" value="+299">{{__('words.Greenland')}} (+299)</option>
                                            <option data-countryCode="GD" value="+1473">{{__('words.Grenada')}} (+1473)</option>
                                            <option data-countryCode="GP" value="+590">{{__('words.Guadeloupe')}} (+590)</option>
                                            <option data-countryCode="GU" value="+671">{{__('words.Guam')}} (+671)</option>
                                            <option data-countryCode="GT" value="+502">{{__('words.Guatemala')}} (+502)</option>
                                            <option data-countryCode="GN" value="+224">{{__('words.Guinea')}} (+224)</option>
                                            <option data-countryCode="GW" value="+245">{{__('words.Guinea - Bissau')}} (+245)
                                            </option>
                                            <option data-countryCode="GY" value="+592">{{__('words.Guyana')}} (+592)</option>
                                            <option data-countryCode="HT" value="+509">{{__('words.Haiti')}} (+509)</option>
                                            <option data-countryCode="HN" value="+504">{{__('words.Honduras')}} (+504)</option>
                                            <option data-countryCode="HK" value="+852">{{__('words.Hong Kong')}} (+852)</option>
                                            <option data-countryCode="HU" value="+36">{{__('words.Hungary')}} (+36)</option>
                                            <option data-countryCode="IS" value="+354">{{__('words.Iceland')}} (+354)</option>
                                            <option data-countryCode="IN" value="+91">{{__('words.India')}} (+91)</option>
                                            <option data-countryCode="ID" value="+62">{{__('words.Indonesia')}} (+62)</option>
                                            <option data-countryCode="IR" value="+98">{{__('words.Iran')}} (+98)</option>
                                            <option data-countryCode="IQ" value="+964">{{__('words.Iraq')}} (+964)</option>
                                            <option data-countryCode="IE" value="+353">{{__('words.Ireland')}} (+353)</option>
                                            <option data-countryCode="IL" value="+972">{{__('words.Israel')}} (+972)</option>
                                            <option data-countryCode="IT" value="+39">{{__('words.Italy')}} (+39)</option>
                                            <option data-countryCode="JM" value="+1876">{{__('words.Jamaica')}} (+1876)</option>
                                            <option data-countryCode="JP" value="+81">{{__('words.Japan')}} (+81)</option>
                                            <option data-countryCode="JO" value="+962">{{__('words.Jordan')}} (+962)</option>
                                            <option data-countryCode="KZ" value="+7">{{__('words.Kazakhstan')}} (+7)</option>
                                            <option data-countryCode="KE" value="+254">{{__('words.Kenya')}} (+254)</option>
                                            <option data-countryCode="KI" value="+686">{{__('words.Kiribati')}} (+686)</option>
                                            <option data-countryCode="KP" value="+850">{{__('words.Korea North')}} (+850)</option>
                                            <option data-countryCode="KR" value="+82">{{__('words.Korea South')}} (+82)</option>
                                            <option data-countryCode="KW" value="+965">{{__('words.Kuwait')}} (+965)</option>
                                            <option data-countryCode="KG" value="+996">{{__('words.Kyrgyzstan')}} (+996)</option>
                                            <option data-countryCode="LA" value="+856">{{__('words.Laos')}} (+856)</option>
                                            <option data-countryCode="LV" value="+371">{{__('words.Latvia')}} (+371)</option>
                                            <option data-countryCode="LB" value="+961">{{__('words.Lebanon')}} (+961)</option>
                                            <option data-countryCode="LS" value="+266">{{__('words.Lesotho')}} (+266)</option>
                                            <option data-countryCode="LR" value="+231">{{__('words.Liberia')}} (+231)</option>
                                            <option data-countryCode="LY" value="+218">{{__('words.Libya')}} (+218)</option>
                                            <option data-countryCode="LI" value="+417">{{__('words.Liechtenstein')}} (+417)</option>
                                            <option data-countryCode="LT" value="+370">{{__('words.Lithuania')}} (+370)</option>
                                            <option data-countryCode="LU" value="+352">{{__('words.Luxembourg')}} (+352)</option>
                                            <option data-countryCode="MO" value="+853">{{__('words.Macao')}} (+853)</option>
                                            <option data-countryCode="MK" value="+389">{{__('words.Macedonia')}} (+389)</option>
                                            <option data-countryCode="MG" value="+261">{{__('words.Madagascar')}} (+261)</option>
                                            <option data-countryCode="MW" value="+265">{{__('words.Malawi')}} (+265)</option>
                                            <option data-countryCode="MY" value="+60">{{__('words.Malaysia')}} (+60)</option>
                                            <option data-countryCode="MV" value="+960">{{__('words.Maldives')}} (+960)</option>
                                            <option data-countryCode="ML" value="+223">{{__('words.Mali')}} (+223)</option>
                                            <option data-countryCode="MT" value="+356">{{__('words.Malta')}} (+356)</option>
                                            <option data-countryCode="MH" value="+692">{{__('words.Marshall Islands')}} (+692)
                                            </option>
                                            <option data-countryCode="MQ" value="+596">{{__('words.Martinique')}} (+596)</option>
                                            <option data-countryCode="MR" value="+222">{{__('words.Mauritania')}} (+222)</option>
                                            <option data-countryCode="YT" value="+269">{{__('words.Mayotte')}} (+269)</option>
                                            <option data-countryCode="MX" value="+52">{{__('words.Mexico')}} (+52)</option>
                                            <option data-countryCode="FM" value="+691">{{__('words.Micronesia')}} (+691)</option>
                                            <option data-countryCode="MD" value="+373">{{__('words.Moldova')}} (+373)</option>
                                            <option data-countryCode="MC" value="+377">{{__('words.Monaco')}} (+377)</option>
                                            <option data-countryCode="MN" value="+976">{{__('words.Mongolia')}} (+976)</option>
                                            <option data-countryCode="MS" value="+1664">{{__('words.Montserrat')}} (+1664)</option>
                                            <option data-countryCode="MA" value="+212">{{__('words.Morocco')}} (+212)</option>
                                            <option data-countryCode="MZ" value="+258">{{__('words.Mozambique')}} (+258)</option>
                                            <option data-countryCode="MN" value="+95">{{__('words.Myanmar')}} (+95)</option>
                                            <option data-countryCode="NA" value="+264">{{__('words.Namibia')}} (+264)</option>
                                            <option data-countryCode="NR" value="+674">{{__('words.Nauru')}} (+674)</option>
                                            <option data-countryCode="NP" value="+977">{{__('words.Nepal')}} (+977)</option>
                                            <option data-countryCode="NL" value="+31">{{__('words.Netherlands')}} (+31)</option>
                                            <option data-countryCode="NC" value="+687">{{__('words.New Caledonia')}} (+687)</option>
                                            <option data-countryCode="NZ" value="+64">{{__('words.New Zealand')}} (+64)</option>
                                            <option data-countryCode="NI" value="+505">{{__('words.Nicaragua')}} (+505)</option>
                                            <option data-countryCode="NE" value="+227">{{__('words.Niger')}} (+227)</option>
                                            <option data-countryCode="NG" value="+234">{{__('words.Nigeria')}} (+234)</option>
                                            <option data-countryCode="NU" value="+683">{{__('words.Niue')}} (+683)</option>
                                            <option data-countryCode="NF" value="+672">{{__('words.Norfolk Islands')}} (+672)
                                            </option>
                                            <option data-countryCode="NP" value="+670">{{__('words.Northern Marianas')}} (+670)
                                            </option>
                                            <option data-countryCode="NO" value="+47">{{__('words.Norway')}} (+47)</option>
                                            <option data-countryCode="OM" value="+968">{{__('words.Oman')}} (+968)</option>
                                            <option data-countryCode="PW" value="+680">{{__('words.Palau')}} (+680)</option>
                                            <option data-countryCode="PA" value="+507">{{__('words.Panama')}} (+507)</option>
                                            <option data-countryCode="PG" value="+675">{{__('words.Papua New Guinea')}} (+675)
                                            </option>
                                            <option data-countryCode="PY" value="+595">{{__('words.Paraguay')}} (+595)</option>
                                            <option data-countryCode="PE" value="+51">{{__('words.Peru')}} (+51)</option>
                                            <option data-countryCode="PH" value="+63">{{__('words.Philippines')}} (+63)</option>
                                            <option data-countryCode="PL" value="+48">{{__('words.Poland')}} (+48)</option>
                                            <option data-countryCode="PT" value="+351">{{__('words.Portugal')}} (+351)</option>
                                            <option data-countryCode="PR" value="+1787">{{__('words.Puerto Rico')}} (+1787)</option>
                                            <option data-countryCode="QA" value="+974">{{__('words.Qatar')}} (+974)</option>
                                            <option data-countryCode="RE" value="+262">{{__('words.Reunion')}} (+262)</option>
                                            <option data-countryCode="RO" value="+40">{{__('words.Romania')}} (+40)</option>
                                            <option data-countryCode="RU" value="+7">{{__('words.Russia')}} (+7)</option>
                                            <option data-countryCode="RW" value="+250">{{__('words.Rwanda')}} (+250)</option>
                                            <option data-countryCode="SM" value="+378">{{__('words.San Marino')}} (+378)</option>
                                            <option data-countryCode="ST" value="+239">{{__('words.Sao Tome & Principe')}}
                                                (+239)
                                            </option>
                                            <option data-countryCode="SA" value="+966">{{__('words.Saudi Arabia')}} (+966)</option>
                                            <option data-countryCode="SN" value="+221">{{__('words.Senegal')}} (+221)</option>
                                            <option data-countryCode="CS" value="+381">{{__('words.Serbia')}} (+381)</option>
                                            <option data-countryCode="SC" value="+248">{{__('words.Seychelles')}} (+248)</option>
                                            <option data-countryCode="SL" value="+232">{{__('words.Sierra Leone')}} (+232)</option>
                                            <option data-countryCode="SG" value="+65">{{__('words.Singapore')}} (+65)</option>
                                            <option data-countryCode="SK" value="+421">{{__('words.Slovak Republic')}} (+421)
                                            </option>
                                            <option data-countryCode="SI" value="+386">{{__('words.Slovenia')}} (+386)</option>
                                            <option data-countryCode="SB" value="+677">{{__('words.Solomon Islands')}} (+677)
                                            </option>
                                            <option data-countryCode="SO" value="+252">{{__('words.Somalia')}} (+252)</option>
                                            <option data-countryCode="ZA" value="+27">{{__('words.South Africa')}} (+27)</option>
                                            <option data-countryCode="ES" value="+34">{{__('words.Spain')}} (+34)</option>
                                            <option data-countryCode="LK" value="+94">{{__('words.Sri Lanka')}} (+94)</option>
                                            <option data-countryCode="SH" value="+290">{{__('words.St. Helena')}} (+290)</option>
                                            <option data-countryCode="KN" value="+1869">{{__('words.St. Kitts')}} (+1869)</option>
                                            <option data-countryCode="SC" value="+1758">{{__('words.St. Lucia')}} (+1758)</option>
                                            <option data-countryCode="SD" value="+249">{{__('words.Sudan')}} (+249)</option>
                                            <option data-countryCode="SR" value="+597">{{__('words.Suriname')}} (+597)</option>
                                            <option data-countryCode="SZ" value="+268">{{__('words.Swaziland')}} (+268)</option>
                                            <option data-countryCode="SE" value="+46">{{__('words.Sweden')}} (+46)</option>
                                            <option data-countryCode="CH" value="+41">{{__('words.Switzerland')}} (+41)</option>
                                            <option data-countryCode="SI" value="+963">{{__('words.Syria')}} (+963)</option>
                                            <option data-countryCode="TW" value="+886">{{__('words.Taiwan')}} (+886)</option>
                                            <option data-countryCode="TJ" value="+7">{{__('words.Tajikstan')}} (+7)</option>
                                            <option data-countryCode="TH" value="+66">{{__('words.Thailand')}} (+66)</option>
                                            <option data-countryCode="TG" value="+228">{{__('words.Togo')}} (+228)</option>
                                            <option data-countryCode="TO" value="+676">{{__('words.Tonga')}} (+676)</option>
                                            <option data-countryCode="TT" value="+1868">{{__('words.Trinidad & Tobago')}}
                                                (+1868)
                                            </option>
                                            <option data-countryCode="TN" value="+216">{{__('words.Tunisia')}} (+216)</option>
                                            <option data-countryCode="TR" value="+90">{{__('words.Turkey')}} (+90)</option>
                                            <option data-countryCode="TM" value="+7">{{__('words.Turkmenistan')}} (+7)</option>
                                            <option data-countryCode="TM" value="+993">{{__('words.Turkmenistan')}} (+993)</option>
                                            <option data-countryCode="TC" value="+1649">{{__('words.Turks & Caicos Islands')}}
                                                (+1649)
                                            </option>
                                            <option data-countryCode="TV" value="+688">{{__('words.Tuvalu')}} (+688)</option>
                                            <option data-countryCode="UG" value="+256">{{__('words.Uganda')}} (+256)</option>
                                            <option data-countryCode="GB" value="+44">{{__('words.UK')}} (+44)</option>
                                            <option data-countryCode="UA" value="+380">{{__('words.Ukraine')}} (+380)</option>
                                            <option data-countryCode="AE" value="+971">{{__('words.United Arab Emirates')}} (+971)
                                            </option>
                                            <option data-countryCode="UY" value="+598">{{__('words.Uruguay')}} (+598)</option>
                                            <option data-countryCode="US" value="+1">{{__('words.USA')}} (+1)</option>
                                            <option data-countryCode="UZ" value="+7">{{__('words.Uzbekistan')}} (+7)</option>
                                            <option data-countryCode="VU" value="+678">{{__('words.Vanuatu')}} (+678)</option>
                                            <option data-countryCode="VA" value="+379">{{__('words.Vatican')}} City (+379)</option>
                                            <option data-countryCode="VE" value="+58">{{__('words.Venezuela')}} (+58)</option>
                                            <option data-countryCode="VN" value="+84">{{__('words.Vietnam')}} (+84)</option>
                                            <option data-countryCode="VG" value="+84">{{__('words.Virgin Islands - British')}}
                                                (+1284)
                                            </option>
                                            <option data-countryCode="VI" value="+84">{{__('words.Virgin Islands - US')}} (+1340)
                                            </option>
                                            <option data-countryCode="WF" value="+681">{{__('words.Wallis & Futuna')}} (+681)
                                            </option>
                                            <option data-countryCode="YE" value="+969">{{__('words.Yemen (North)')}}(+969)</option>
                                            <option data-countryCode="YE" value="+967">{{__('words.Yemen (South)')}}(+967)</option>
                                            <option data-countryCode="ZM" value="+260">{{__('words.Zambia')}} (+260)</option>
                                            <option data-countryCode="ZW" value="+263">{{__('words.Zimbabwe')}} (+263)</option>
                                        </optgroup>
                                        @error('country_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>{{__('words.phone')}}</label>
                                    <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="">
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12">
                                    <label>{{__('words.phone_title_en')}}</label>
                                    <input type="text" name="title_en" class="form-control @error('title_en') is-invalid @enderror" value="{{ old('title_en') }}" placeholder="">
                                    @error('title_en')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12">
                                    <label>{{__('words.phone_title_ar')}}</label>
                                    <input type="text" name="title_ar" class="form-control @error('title_ar') is-invalid @enderror" value="{{ old('title_ar') }}" placeholder="">
                                    @error('title_ar')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">{{__('words.close')}}
                    </button>
                    <button type="submit" class="btn btn-outline-primary">{{__('words.create')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>



