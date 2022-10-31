<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">

            {{-- User Start --}}
            <li>
                <a class="{{ request()->routeIs('users.index') ? 'active' : '' }}"
                   href="{{route('users.index')}}" aria-expanded="false">
                    <i class="fas fa-users"></i>
                    <span class="nav-text">{{__('words.users')}}</span>
                </a>
            </li>
            {{-- User End --}}

            {{-- Vehicle details toggle start --}}
            <li>
                <a class="has-arrow" aria-expanded="false">
                    <i class="fa fa-car"></i>
                    <span class="nav-text">{{__('words.vehicles_details')}}</span>
                </a>
                <ul aria-expanded="false">

                    {{-- Brand routes start --}}
                    <li>
                        <a class="{{ request()->routeIs('brands.index') ? 'active' : '' }}"
                           href="{{route('brands.index')}}" aria-expanded="false">
                            <i class="fa fa-copyright"></i>
                            <span class="nav-text">{{__('words.brands')}}</span>
                        </a>
                    </li>
                    {{-- Brand routes end --}}

                    {{-- Car models routes start --}}
                    <li>
                        <a class="{{ request()->routeIs('car-models.index') ? 'active' : '' }}"
                           href="{{route('car-models.index')}}" aria-expanded="false">
                            <i class="fa fa-star"></i>
                            <span class="nav-text">{{__('words.car_model')}}</span>
                        </a>
                    </li>
                    {{-- Car models routes end --}}

                    {{-- Car class routes start --}}
                    <li>
                        <a class="{{ request()->routeIs('car-classes.index') ? 'active' : '' }}"
                           href="{{route('car-classes.index')}}" aria-expanded="false">
                            <i class="fa fa-list-ol"></i>
                            <span class="nav-text">{{__('words.car_class')}}</span>
                        </a>
                    </li>
                    {{-- Car class routes end --}}

                    {{-- Manufaturing countries routes start --}}
                    <li>
                        <a class="{{ request()->routeIs('manufacture-countries.index') ? 'active' : '' }}"
                           href="{{route('manufacture-countries.index')}}" aria-expanded="false">
                            <i class="fa fa-industry"></i>
                            <span class="nav-text">{{__('words.manufacture_countries')}}</span>
                        </a>
                    </li>
                    {{-- Manufaturing countries routes end --}}
                </ul>
            </li>
            {{-- Vehicle details toggle end --}}

            {{-- Location toggle start --}}
            <li>
                <a class="has-arrow" aria-expanded="false">
                    <i class="fa fa-globe"></i>
                    <span class="nav-text">{{__('words.location')}}</span>
                </a>
                <ul aria-expanded="false">

                    {{-- Country routes start --}}
                    <li>
                        <a class="{{ request()->routeIs('countries.index') ? 'active' : '' }}"
                           href="{{route('countries.index')}}" aria-expanded="false">
                            <i class="fa fa-flag"></i>
                            <span class="nav-text">{{__('words.countries')}}</span>
                        </a>
                    </li>
                    {{-- Country routes end --}}

                    {{-- City routes start --}}
                    <li>
                        <a class="{{ request()->routeIs('cities.index') ? 'active' : '' }}"
                           href="{{route('cities.index')}}" aria-expanded="false">
                            <i class="fas fa-place-of-worship"></i>
                            <span class="nav-text">{{__('words.cities')}}</span>
                        </a>
                    </li>
                    {{-- City routes end --}}

                    {{-- Area routes start --}}
                    <li>
                        <a class="{{ request()->routeIs('areas.index') ? 'active' : '' }}"
                           href="{{route('areas.index')}}" aria-expanded="false">
                            <i class="fas fa-home"></i>
                            <span class="nav-text">{{__('words.areas')}}</span>
                        </a>
                    </li>
                    {{-- Area routes end --}}

                </ul>
            </li>
            {{-- Location toggle end --}}

            {{-- General toggle start --}}
            <li class="{{ request()->routeIs('org_sliders*') ? 'mm-active' : '' }}">
                <a class="has-arrow" aria-expanded="false">
                    <i class="fas fa-sliders-h"></i>
                    <span class="nav-text">{{__('words.general')}}</span>
                </a>
                <ul aria-expanded="false" class="{{ request()->routeIs('org_sliders*') ? 'mm-collapse mm-show' : '' }}">
                    {{-- Discount Card routes start --}}
                    <li>
                        <a class="{{ request()->routeIs('discount-cards.index') ? 'active' : '' }}"
                           href="{{route('discount-cards.index')}}" aria-expanded="false">
                            <i class="fas fa-donate"></i>
                            <span class="nav-text">{{__('words.discount_cards')}}</span>
                        </a>
                    </li>
                    {{-- Discount Card routes end --}}

                    {{-- Section routes start --}}
                    <li>
                        <a class="{{ request()->routeIs('sections.index') ? 'active' : '' }}"
                           href="{{route('sections.index')}}" aria-expanded="false">
                            <i class="fas fa-th-list"></i>
                            <span class="nav-text">{{__('words.sections')}}</span>
                        </a>
                    </li>
                    {{-- Section routes end --}}

                    {{-- Category routes start --}}
                    <li>
                        <a class="{{ request()->routeIs('categories.index') ? 'active' : '' }}"
                           href="{{route('categories.index')}}" aria-expanded="false">
                            <i class="fas fa-bars"></i>
                            <span class="nav-text">{{__('words.categories')}}</span>
                        </a>
                    </li>
                    {{-- Category routes end --}}

                    {{-- Sub Category routes start --}}
                    <li>
                        <a class="{{ request()->routeIs('sub-categories.index') ? 'active' : '' }}"
                           href="{{route('sub-categories.index')}}" aria-expanded="false">
                            <i class="fas fa-folder"></i>
                            <span class="nav-text">{{__('words.sub_categories')}}</span>
                        </a>
                    </li>
                    {{-- Category routes end --}}

                    {{-- App Slider routes start --}}
                    <li>
                        <a class="{{ request()->routeIs('app-sliders.*') ? 'mm-active' : '' }}"
                           href="{{route('app-sliders.index')}}" aria-expanded="false">
                            <i class="fas fa-photo-video"></i>
                            <span class="nav-text">{{__('words.app_sliders')}}</span>
                        </a>
                        {{--<a class="d-none" href="" aria-expanded="false"></a>--}}
                    </li>
                    {{-- App Slider routes end --}}

                    {{-- Slider routes start --}}
                    <li>
                        <a class="{{ request()->routeIs('organization-sliders.*') ? 'mm-active' : '' }}"
                           href="{{route('organization-sliders.index')}}" aria-expanded="false">
                            <i class="fas fa-photo-video"></i>
                            <span class="nav-text">{{__('words.org_sliders')}}</span>
                        </a>
                       {{-- <a class="d-none" href="" aria-expanded="false"></a>--}}
                    </li>
                    {{-- Slider routes end --}}

                    {{-- Payment method routes start --}}
                    <li>
                        <a class="{{ request()->routeIs('payment-methods.index') ? 'active' : '' }}"
                           href="{{route('payment-methods.index')}}" aria-expanded="false">
                            <i class="fas fa-credit-card"></i>
                            <span class="nav-text">{{__('words.payment_methods')}}</span>
                        </a>
                    </li>
                    {{-- Payment method routes end --}}

                    {{-- Color routes start --}}
                    <li>
                        <a class="{{ request()->routeIs('colors.index') ? 'active' : '' }}"
                           href="{{route('colors.index')}}" aria-expanded="false">
                            <i class="fas fa-palette"></i>
                            <span class="nav-text">{{__('words.colors')}}</span>
                        </a>
                    </li>
                    {{-- Color routes end --}}

                    {{-- Currency routes start --}}
                    <li>
                        <a class="{{ request()->routeIs('currencies.index') ? 'active' : '' }}"
                           href="{{route('currencies.index')}}" aria-expanded="false">
                            <i class="fas fa-dollar-sign"></i>
                            <span class="nav-text">{{__('words.currencies')}}</span>
                        </a>
                    </li>
                    {{-- Currency routes end --}}


                    {{-- auctions routes start --}}
                    <li>
                        <a class="{{ request()->routeIs('auctions.index') ? 'active' : '' }}"
                           href="{{route('auctions.index')}}" aria-expanded="false">
                            <i class="la la-gavel"></i>
                            <span class="nav-text">{{__('words.auctions')}}</span>
                        </a>
                    </li>
                    {{-- auctions routes end --}}
                </ul>
            </li>
            {{-- General toggle end --}}

            {{-- Organizations toggle start --}}
            <li>
                <a class="has-arrow" aria-expanded="false">
                    <i class="fas fa-place-of-worship"></i>
                    <span class="nav-text">{{__('words.organizations')}}</span>
                </a>
                <ul aria-expanded="false">

                    {{-- Special numbers routes start --}}
                    <li>
                        <a class="has-arrow" aria-expanded="false">
                            <i class="fas fa-sort-numeric-down"></i>
                            <span class="nav-text">{{__('words.special_numbers')}}</span>
                        </a>
                        <ul aria-expanded="false">
                            {{-- Special number organization routes start--}}
                            <li>
                                <a class="{{ request()->routeIs('special-number-organizations.index') ? 'active' : '' }}"
                                   href="{{route('special-number-organizations.index')}}" aria-expanded="false">
                                    <i class="fas fa-archway"></i>
                                    <span class="nav-text">{{__('words.special_numbers_organizations')}}</span>
                                </a>
                            </li>
                            {{-- Special number organization routes end --}}

                            {{-- Special number category routes start --}}
                            <li>
                                <a class="{{ request()->routeIs('special-number-categories.index') ? 'active' : '' }}"
                                   href="{{route('special-number-categories.index')}}" aria-expanded="false">
                                    <i class="fas fa-bars"></i>
                                    <span class="nav-text">{{__('words.special_numbers_categories')}}</span>
                                </a>
                            </li>
                            {{-- Special number category routes end --}}

                            {{-- Special number routes start --}}
                            <li>
                                <a class="{{ request()->routeIs('special-numbers.index') ? 'active' : '' }}"
                                   href="{{route('special-numbers.index')}}" aria-expanded="false">
                                    <i class="fas fa-award"></i>
                                    <span class="nav-text">{{__('words.special_numbers')}}</span>
                                </a>
                            </li>
                            {{-- Special number category routes end --}}
                        </ul>
                    </li>
                    {{-- Special numbers routes end --}}

                    {{-- Agency routes start --}}
                    <li>
                        <a class="{{ request()->routeIs('agencies.index') ? 'active' : '' }}"
                           href="{{route('agencies.index')}}" aria-expanded="false">
                            <i class="fas fa-peace"></i>
                            <span class="nav-text">{{__('words.agencies')}}</span>
                        </a>
                    </li>
                    {{-- Agency routes end --}}

                    {{-- Car Showroom routes start --}}
                    <li>
                        <a class="{{ request()->routeIs('car-showrooms.index') ? 'active' : '' }}"
                           href="{{route('car-showrooms.index')}}" aria-expanded="false">
                            <i class="fas fa-store"></i>
                            <span class="nav-text">{{__('words.car_showrooms')}}</span>
                        </a>
                    </li>
                    {{-- Car Showroom routes end --}}

                    {{-- Rental Office routes start --}}
                    <li>
                        <a class="{{ request()->routeIs('rental-offices.index') ? 'active' : '' }}"
                           href="{{route('rental-offices.index')}}" aria-expanded="false">
                            <i class="fas fa-handshake"></i>
                            <span class="nav-text">{{__('words.rental_offices')}}</span>
                        </a>
                    </li>
                    {{-- Rental Office routes end --}}

                    {{-- Wench routes start --}}
                    <li>
                        <a class="{{ request()->routeIs('wenches.index') ? 'active' : '' }}"
                           href="{{route('wenches.index')}}" aria-expanded="false">
                            <i class="fas fa-truck-loading"></i>
                            <span class="nav-text">{{__('words.wenches')}}</span>
                        </a>
                    </li>
                    {{-- Wench routes end --}}

                    {{--Scrap routes start--}}
                    <li>
                        <a class="{{ request()->routeIs('scraps.index') ? 'active' : '' }}"
                           href="{{route('scraps.index')}}" aria-expanded="false">
                            <i class="fa fa-wrench" aria-hidden="true"></i>
                            <span class="nav-text">{{__('words.scraps')}}</span>
                        </a>
                    </li>
                    {{--Scrap routes end--}}

                    {{--Spare Part routes start--}}
                    <li>
                        <a class="{{ request()->routeIs('spareparts.index') ? 'active' : '' }}"
                           href="{{route('spareparts.index')}}" aria-expanded="false">
                            <i class="fa fa-cogs" aria-hidden="true"></i>
                            <span class="nav-text">{{__('words.spare_parts')}}</span>
                        </a>
                    </li>
                    {{--Spare Part routes end--}}

                    {{-- broker routes start--}}
                    <li>
                        <a class="{{ request()->routeIs('brokers.index') ? 'active' : '' }}"
                           href="{{route('brokers.index')}}" aria-expanded="false">
                            <i class="far fa-handshake"></i>
                            <span class="nav-text">{{__('words.brokers')}}</span>
                        </a>
                    </li>
                    {{-- broker routes end --}}

                    {{-- trainers routes start --}}
                    <li>
                        <a class="{{ request()->routeIs('trainers.index') ? 'active' : '' }}"
                           href="{{route('trainers.index')}}" aria-expanded="false">
                            <i class="fas fa-car-side"></i>
                            <span class="nav-text">{{__('words.driving_trainers')}}</span>
                        </a>
                    </li>
                    {{-- trainers routes end --}}

                    {{-- delivery routes start --}}
                    <li>
                        <a class="{{ request()->routeIs('delivery.index') ? 'active' : '' }}"
                           href="{{route('delivery.index')}}" aria-expanded="false">
                            <i class="la la-motorcycle"></i>
                            <span class="nav-text">{{__('words.delivery')}}</span>
                        </a>
                    </li>
                    {{-- delivery routes end --}}

                    {{-- Insurance Company routes start --}}
                    <li>
                        <a class="{{ request()->routeIs('insurance_companies.index') ? 'active' : '' }}"
                           href="{{route('insurance_companies.index')}}" aria-expanded="false">
                            <i class="fas fa-car-crash"></i>
                            <span class="nav-text">{{__('words.insurance_companies')}}</span>
                        </a>
                    </li>
                    {{-- Insurance Company routes end --}}


                    {{-- Auto Service Centers routes start --}}
                    <li class="{{ request()->routeIs('garages.*') ? 'mm-active' : '' }}">
                        <a class="has-arrow" aria-expanded="false">
                            <i class="fas fa-tools"></i>
                            <span class="nav-text">{{__('words.AutoServiceCenters')}}</span>
                        </a>
                        <ul aria-expanded="false">
                            {{-- Special number organization routes start --}}
                            <li>
                                <a class="{{ request()->routeIs('garages.index') ? 'active' : '' }}"
                                   href="{{route('garages.index')}}" aria-expanded="false">
                                    <i class="fas fa-warehouse"></i>
                                    <span class="nav-text">{{__('words.garages')}}</span>
                                </a>
                            </li>
                            {{-- Special number organization routes end --}}


                        </ul>
                    </li>
                    {{-- Auto Service Centers routes end --}}

                    {{-- Fuel Stattions routes start --}}
                    <li>
                        <a class="{{ request()->routeIs('fuel-stations.index') ? 'active' : '' }}"
                           href="{{route('fuel-stations.index')}}" aria-expanded="false">
                            <i class="fas fa-gas-pump"></i>
                            <span class="nav-text">{{__('words.fuel_stations')}}</span>
                        </a>
                    </li>
                    {{-- Fuel Stattions routes end --}}

                </ul>
            </li>
            {{-- Organizations toggle end --}}
        </ul>
    </div>


</div>
