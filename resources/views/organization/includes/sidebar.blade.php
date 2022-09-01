<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">

            {{-- Organizations routes start --}}

            <li>
                <a class="{{ request()->routeIs('organization.users.index') ? 'active' : '' }}"
                   href="{{route('organization.users.index')}}" aria-expanded="false">
                    <i class="fas fa-users"></i>
                    <span class="nav-text">{{__('words.users')}}</span>
                </a>
            </li>

            <li>
                <a class="{{ request()->routeIs('organization.organizations.index') ? 'active' : '' }}"
                   href="{{route('organization.organizations.index')}}" aria-expanded="false">
                    <i class="fas fa-eye"></i>
                    <span class="nav-text">{{__('words.show_data')}}</span>
                </a>
            </li>

            {{-- Vehicle routes start --}}
            @if(auth()->guard('web')->user() && auth()->guard('web')->user()->organizable &&  method_exists(auth()->guard('web')->user()->organizable,'available_vehicles'))
                <li>
                    <a class="{{ request()->routeIs('organization.available_vehicle.index') ? 'active' : '' }}"
                       href="{{route('organization.available_vehicle.index')}}" aria-expanded="false">
                        <i class="fas fa-car-side"></i>
                        <span class="nav-text">{{__('words.available_vehicles')}}</span>
                    </a>
                </li>
            @endif

            {{-- Rental Office Cars routes start --}}
            @if(auth()->guard('web')->user() && auth()->guard('web')->user()->organizable &&  method_exists(auth()->guard('web')->user()->organizable,'rental_office_cars'))
                <li>
                    <a class="{{ request()->routeIs('organization.rental_office_car.index') ? 'active' : '' }}"
                       href="{{route('organization.rental_office_car.index')}}" aria-expanded="false">
                        <i class="fas fa-car-side"></i>
                        <span class="nav-text">{{__('words.rental_office_cars')}}</span>
                    </a>
                </li>
            @endif

            {{-- Rental Laws routes start --}}
            @if(auth()->guard('web')->user() && auth()->guard('web')->user()->organizable &&  method_exists(auth()->guard('web')->user()->organizable,'rental_laws'))
                <li>
                    <a class="{{ request()->routeIs('organization.rental_law.index') ? 'active' : '' }}"
                       href="{{route('organization.rental_law.index')}}" aria-expanded="false">
                        <i class="fas fa-solid fa-gavel"></i>
                        <span class="nav-text">{{__('words.rental_laws')}}</span>
                    </a>
                </li>
            @endif

            {{-- Laws routes start --}}
            @if(auth()->guard('web')->user() && auth()->guard('web')->user()->organizable &&  method_exists(auth()->guard('web')->user()->organizable,'laws'))
                <li>
                    <a class="{{ request()->routeIs('organization.law.index') ? 'active' : '' }}"
                       href="{{route('organization.law.index')}}" aria-expanded="false">
                        <i class="fas fa-solid fa-gavel"></i>
                        <span class="nav-text">{{__('words.laws')}}</span>
                    </a>
                </li>
            @endif

            {{-- Coverage Types routes start --}}
            @if(auth()->guard('web')->user() && auth()->guard('web')->user()->organizable &&  method_exists(auth()->guard('web')->user()->organizable,'coverage_types'))
                <li>
                    <a class="{{ request()->routeIs('organization.coverage_type.index') ? 'active' : '' }}"
                       href="{{route('organization.coverage_type.index')}}" aria-expanded="false">
                        <i class="fas fa-solid fa-box-open"></i>
                        <span class="nav-text">{{__('words.coverage_types')}}</span>
                    </a>
                </li>
            @endif

            {{-- Available Payment Methods --}}
            @if(auth()->guard('web')->user() && auth()->guard('web')->user()->organizable &&  method_exists(auth()->guard('web')->user()->organizable,'rental_laws'))
                <li>
                    <a class="{{ request()->routeIs('organization.available_payment_method.index') ? 'active' : '' }}"
                       href="{{route('organization.available_payment_method.index')}}" aria-expanded="false">
                        <i class="fas fa-solid fa-money-bill"></i>
                        <span class="nav-text">{{__('words.available_payment_methods')}}</span>
                    </a>
                </li>
            @endif

            {{-- Rental Reservations --}}
            @if(auth()->guard('web')->user() && auth()->guard('web')->user()->organizable &&  method_exists(auth()->guard('web')->user()->organizable,'rental_reservations'))
                <li>
                    <a class="{{ request()->routeIs('organization.rental_reservation.index') ? 'active' : '' }}"
                       href="{{route('organization.rental_reservation.index')}}" aria-expanded="false">
                        <i class="fas fa-clipboard"></i>
                        <span class="nav-text">{{__('words.rental_reservations')}}</span>
                    </a>
                </li>
            @endif

            @if(auth()->guard('web')->user() && auth()->guard('web')->user()->organizable &&  method_exists(auth()->guard('web')->user()->organizable,'available_vehicles'))
                <li>
                    <a class="{{ request()->routeIs('organization.available_product.index') ? 'active' : '' }}"
                       href="{{route('organization.available_product.index')}}" aria-expanded="false">
                        <i class="fab fa-product-hunt"></i>
                        <span class="nav-text">{{__('words.available_products')}}</span>
                    </a>
                </li>
            @endif

            @if(auth()->guard('web')->user() && auth()->guard('web')->user()->organizable &&  method_exists(auth()->guard('web')->user()->organizable,'available_vehicles'))
                <li>
                    <a class="{{ request()->routeIs('organization.available_service.index') ? 'active' : '' }}"
                       href="{{route('organization.available_service.index')}}" aria-expanded="false">
                        <i class="fas fa-toolbox"></i>
                        <span class="nav-text">{{__('words.available_services')}}</span>
                    </a>
                </li>
            @endif

            @if(auth()->guard('web')->user() && auth()->guard('web')->user()->organizable &&  method_exists(auth()->guard('web')->user()->organizable,'vehicles'))
                <li>
                    <a class="has-arrow" aria-expanded="false">
                        <i class="fas fa-car-side"></i>
                        <span class="nav-text">{{__('words.vehicles')}}</span>
                    </a>
                    <ul aria-expanded="false">
                        <li>
                            <a class="{{ request()->routeIs('organization.vehicles.index') ? 'active' : '' }}"
                               href="{{route('organization.vehicles.index')}}" aria-expanded="false">
                                <i class="fas fa-eye"></i>
                                <span class="nav-text">{{__('words.show_vehicles')}}</span>
                            </a>
                        </li>

                        <li>
                            <a class="{{ request()->routeIs('organization.vehicles.create') ? 'active' : '' }}"
                               href="{{route('organization.vehicles.create')}}" aria-expanded="false">
                                <i class="fa fa-plus"></i>
                                <span class="nav-text">{{__('words.new_vehicle')}}</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            @if(auth()->guard('web')->user() && auth()->guard('web')->user()->organizable &&  method_exists(auth()->guard('web')->user()->organizable,'products'))
                <li>
                    <a class="{{ request()->routeIs('organization.products.index') ? 'active' : '' }}"
                       href="{{route('organization.products.index')}}" aria-expanded="false">
                        <i class="fab fa-product-hunt"></i>
                        <span class="nav-text">{{__('words.products')}}</span>
                    </a>
                </li>
            @endif

            @if(auth()->guard('web')->user() && auth()->guard('web')->user()->organizable && method_exists( auth()->guard('web')->user()->organizable,'services'))
                <li>
                    <a class="{{ request()->routeIs('organization.services.index') ? 'active' : '' }}"
                       href="{{route('organization.services.index')}}" aria-expanded="false">
                        <i class="fas fa-toolbox"></i>
                        <span class="nav-text">{{__('words.services')}}</span>
                    </a>
                </li>
            @endif
            @if(auth()->guard('web')->user() && auth()->guard('web')->user()->organizable && method_exists( auth()->guard('web')->user()->organizable,'ads'))
                <li>
                    <a class="{{ request()->routeIs('organization.ads.index') ? 'active' : '' }}"
                       href="{{route('organization.ads.index')}}" aria-expanded="false">
                        <i class="fa fa-bullhorn" aria-hidden="true"></i>
                        <span class="nav-text">{{__('words.ads')}}</span>
                    </a>
                </li>
            @endif

            {{-- <li>
                <a class="{{ request()->routeIs('brands.index') ? 'active' : '' }}" href="{{route('brands.index')}}"
                   aria-expanded="false">
                    <i class="far fa-registered"></i>
                    <span class="nav-text">{{__('words.reviews')}}</span>
                </a>
            </li> --}}
            {{--//show the reservations of products--}}
            @if(auth()->guard('web')->user() && auth()->guard('web')->user()->organizable &&  method_exists(auth()->guard('web')->user()->organizable,'reservations'))
                <li>
                    @if(auth()->guard('web')->user()->organizable_type=='\App\Models\DrivingTrainer')
                        <a class="{{ request()->routeIs('organization.trainer_reservations.index') ? 'active' : '' }}"
                           href="{{route('organization.trainer_reservations.index')}}" aria-expanded="false">
                            <i class="la la-pencil-square-o"></i>
                            <span class="nav-text">{{__('words.reservations')}}</span>
                        </a>
                    @elseif(auth()->guard('web')->user()->organizable_type=='App\Models\DeliveryMan')
                        <a class="{{ request()->routeIs('organization.delivery_reservations.index') ? 'active' : '' }}"
                           href="{{route('organization.delivery_reservations.index')}}" aria-expanded="false">
                            <i class="la la-pencil-square-o"></i>
                            <span class="nav-text">{{__('words.reservations')}}</span>
                        </a>
                    @else
                        <a class="{{ request()->routeIs('organization.reservations.index') ? 'active' : '' }}"
                           href="{{route('organization.reservations.index')}}" aria-expanded="false">
                            <i class="la la-pencil-square-o"></i>
                            <span class="nav-text">{{__('words.reservations')}}</span>
                        </a>
                    @endif

                </li>
            @endif
            {{--requests of the products--}}
            @if(auth()->guard('web')->user() && auth()->guard('web')->user()->organizable &&  method_exists(auth()->guard('web')->user()->organizable,'products'))
                <li>
                    <a class="{{ request()->routeIs('organization.products_requests.index') ? 'active' : '' }}"
                       href="{{route('organization.products_requests.index')}}" aria-expanded="false">
                        <i class="fas fa-envelope-open-text"></i>
                        <span class="nav-text">{{__('words.products_requests')}}</span>
                    </a>
                </li>
            @endif

            {{--requests of the insurance--}}
                @if(auth()->guard('web')->user() && auth()->guard('web')->user()->organizable && auth()->guard('web')->user()->organizable->request_insurance_organizations)
                <li>
                    <a class="{{ request()->routeIs('organization.insurance_requests.index') ? 'active' : '' }}"
                       href="{{route('organization.insurance_requests.index')}}" aria-expanded="false">
                        <i class="fas fa-hand-holding"></i>
                        <span class="nav-text">{{__('words.insurance_requests')}}</span>
                    </a>
                </li>
            @endif
            {{--            @if(auth()->guard('web')->user() && auth()->guard('web')->user()->organizable && auth()->guard('web')->user()->organizable->products)--}}
            {{--                <a class="{{ request()->routeIs('organization.products_requests.index') ? 'active' : '' }}"--}}
            {{--                   href="{{route('organization.products_requests.index')}}" aria-expanded="false">--}}
            {{--                    <i class="fas fa-envelope-open-text"></i> <span--}}
            {{--                        class="nav-text">{{__('words.products_requests')}}</span>--}}
            {{--                </a>--}}
            {{--                </li>--}}
            {{--            @endif--}}

            @if(auth()->guard('web')->user() && auth()->guard('web')->user()->organizable && method_exists(auth()->guard('web')->user()->organizable,'work_time'))
                <li>
                    <a class="{{ request()->routeIs('organization.work_time.edit') ? 'active' : '' }}"
                       href="{{route('organization.work_time.edit')}}" aria-expanded="false">
                        <i class="fas fa-clock"></i>
                        <span class="nav-text">{{__('words.work_time')}}</span>
                    </a>
                </li>
            @endif

            @if(auth()->guard('web')->user() && auth()->guard('web')->user()->organizable &&  method_exists(auth()->guard('web')->user()->organizable,'contact'))
                <li>
                    <a class="{{ request()->routeIs('organization.contact.edit') ? 'active' : '' }}"
                       href="{{route('organization.contact.edit')}}" aria-expanded="false">
                        <i class="fas fa-id-card-alt"></i>
                        <span class="nav-text">{{__('words.contact')}}</span>
                    </a>
                </li>
            @endif

            @if(auth()->guard('web')->user() && auth()->guard('web')->user()->organizable && auth()->guard('web')->user()->organizable->phones)
                <li>
                    <a class="{{ request()->routeIs('organization.phone.index') ? 'active' : '' }}"
                       href="{{route('organization.phone.index')}}" aria-expanded="false">
                        <i class="fas fa-phone"></i>
                        <span class="nav-text">{{__('words.phones')}}</span>
                    </a>
                </li>
            @endif

            @if(auth()->guard('web')->user() && auth()->guard('web')->user()->organizable && auth()->guard('web')->user()->organizable->day_offs)
                <li>
                    <a class="{{ request()->routeIs('organization.day_off.index') ? 'active' : '' }}"
                       href="{{route('organization.day_off.index')}}" aria-expanded="false">
                        <i class="fas fa-calendar-day"></i>
                        <span class="nav-text">{{__('words.day_offs')}}</span>
                    </a>
                </li>
            @endif

            {{-- reserve_vehicles --}}
            @if(auth()->guard('web')->user() && auth()->guard('web')->user()->organizable && auth()->guard('web')->user()->organizable->reserve_vehicles)
                <li>
                    <a class="{{ request()->routeIs('organization.reserve_vehicle.index') ? 'active' : '' }}"
                       href="{{route('organization.reserve_vehicle.index')}}" aria-expanded="false">
                        <i class="fas fa-clipboard"></i>
                        <span class="nav-text">{{__('words.reserve_vehicles')}}</span>
                    </a>
                </li>
            @endif

            @if(auth()->guard('web')->user() && auth()->guard('web')->user()->organizable && auth()->guard('web')->user()->organizable->tests)
                <li>
                    <a class="{{ request()->routeIs('organization.test.index') ? 'active' : '' }}"
                       href="{{route('organization.test.index')}}" aria-expanded="false">
                        <i class="fas fa-clipboard"></i>
                        <span class="nav-text">{{__('words.tests')}}</span>
                    </a>
                </li>
            @endif


            @if(auth()->guard('web')->user() && auth()->guard('web')->user()->organizable && auth()->guard('web')->user()->organizable->reviews)
                <li>
                    <a class="{{ request()->routeIs('organization.review.index') ? 'active' : '' }}"
                       href="{{route('organization.review.index')}}" aria-expanded="false">
                        <i class="fas fa-star-half-alt"></i>
                        <span class="nav-text">{{__('words.reviews')}}</span>
                    </a>
                </li>
            @endif

            @if(auth()->guard('web')->user() && auth()->guard('web')->user()->organizable && auth()->guard('web')->user()->organizable->branches)
                <li>
                    <a class="{{ request()->routeIs('organization.branch.index') ? 'active' : '' }}"
                       href="{{route('organization.branch.index')}}" aria-expanded="false">
                        <i class="fas fa-code-branch"></i>
                        <span class="nav-text">{{__('words.branches')}}</span>
                    </a>
                </li>

            @endif

            {{-- Special number routes start --}}
            @if(auth()->guard('web')->user() && auth()->guard('web')->user()->organizable && auth()->guard('web')->user()->organizable->special_numbers)
                <li>
                    <a class="{{ request()->routeIs('organization.special-numbers.index') ? 'active' : '' }}"
                       href="{{route('organization.special-numbers.index')}}" aria-expanded="false">
                        <i class="fas fa-award"></i>
                        <span class="nav-text">{{__('words.special_numbers')}}</span>
                    </a>
                </li>
            @endif

            {{-- reserve_vehicles --}}
            @if(auth()->guard('web')->user() && auth()->guard('web')->user()->organizable && auth()->guard('web')->user()->organizable->special_number_reservation)
                <li>
                    <a class="{{ request()->routeIs('organization.special-number-reservations') ? 'active' : '' }}"
                       href="{{route('organization.special-number-reservations')}}" aria-expanded="false">
                        <i class="fas fa-clipboard"></i>
                        <span class="nav-text">{{__('words.special_number_reservations')}}</span>
                    </a>
                </li>
            @endif
            {{-- Special number routes start --}}

            {{-- Verification routes start --}}
            @if(auth()->guard('web')->user() && auth()->guard('web')->user()->organizable && auth()->guard('web')->user()->organizable->special_number_verification)
                <li>
                    <a class="{{ request()->routeIs('organization.verifications.index') ? 'active' : '' }}"
                       href="{{route('organization.verifications.index')}}" aria-expanded="false">
                        <i class="fas fa-sync"></i>
                        <span class="nav-text">{{__('words.verifications')}}</span>
                    </a>
                </li>
            @endif
            {{-- Verification routes end --}}

            {{-- Discount Card routes start --}}
            @if(auth()->guard('web')->user() && auth()->guard('web')->user()->organizable && auth()->guard('web')->user()->organizable->discount_cards)
            <li>
                <a class="{{ request()->routeIs('organization.discount-cards.index') ? 'active' : '' }}"
                   href="{{route('organization.discount-cards.index')}}" aria-expanded="false">
                    <i class="fas fa-donate"></i>
                    <span class="nav-text">{{__('words.discount_cards')}}</span>
                </a>
            </li>
            @endif
            {{-- Discount Card routes end --}}

            {{-- Organizations routes end --}}
        </ul>
    </div>


</div>
