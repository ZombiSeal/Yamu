@extends('layouts.main')
@section('content')
    <div class="container">
        <h1>Бронирование</h1>
        <form class="book-form" action="{{route('booking.reserve')}}" method="post">
            <div class="book-form__row row">
                <div class="book-form__item">
                    <x-input name="name" type="text">Имя*</x-input>
                    <div class="input-error"></div>
                </div>
                <div class="book-form__item">
                    <x-input name="phone" type="text">Телефон*</x-input>
                    <div class="input-error"></div>
                </div>
                <div class="book-form__item">
                    <x-input name="date" type="date"></x-input>
                </div>
                <div class="book-form__item">
                    <x-input name="time" type="time"></x-input>
                </div>
            </div>

            <svg class="rest" width="100%" height="639" viewBox="0 0 1469 639" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="rest-map">
                    <g id="line">
                        <path id="Vector 3" d="M5 634.56H1464V433.492H1410.91V251.742H1115L1115 5.06982H647.49H5V634.56Z" fill="white" stroke="black" stroke-width="10"/>
                        <path id="Vector 4" d="M1407.5 437H1169.5L1111.5 368V256" stroke="black" stroke-width="3"/>
                        <text id="WC" fill="black" xml:space="preserve" style="white-space: pre" font-family="Ubuntu" font-size="18" font-weight="300" letter-spacing="0em"><tspan x="1255" y="345.187">WC</tspan></text>
                        <text id="&#208;&#154;&#209;&#131;&#209;&#133;&#208;&#189;&#209;&#143;" fill="black" xml:space="preserve" style="white-space: pre" font-family="Ubuntu" font-size="18" font-weight="300" letter-spacing="0em"><tspan x="914" y="207.187">&#x41a;&#x443;&#x445;&#x43d;&#x44f;</tspan></text>
                        <text id="&#208;&#147;&#208;&#176;&#209;&#128;&#208;&#180;&#208;&#181;&#209;&#128;&#208;&#190;&#208;&#177;" fill="black" xml:space="preserve" style="white-space: pre" font-family="Ubuntu" font-size="18" font-weight="300" letter-spacing="0em"><tspan x="1072" y="592.187">&#x413;&#x430;&#x440;&#x434;&#x435;&#x440;&#x43e;&#x431;</tspan></text>
                        <path id="Vector 5" d="M765 7V369H1113" stroke="black" stroke-width="3"/>
                        <path id="Vector 6" d="M1315 634.56V535H914V634.56" stroke="black" stroke-width="3"/>
                        <text id="&#208;&#146;&#209;&#133;&#208;&#190;&#208;&#180;" transform="translate(1421 558) rotate(-90)" fill="black" xml:space="preserve" style="white-space: pre" font-family="Ubuntu" font-size="18" font-weight="300" letter-spacing="0em"><tspan x="0" y="20.187">&#x412;&#x445;&#x43e;&#x434;</tspan></text>
                        <rect id="window7" x="408.5" y="2.5" width="179" height="6" fill="white" stroke="black" stroke-width="3"/>
                        <rect id="window6" x="64.5" y="2.5" width="179" height="6" fill="white" stroke="black" stroke-width="3"/>
                        <rect id="window5" x="1.5" y="254.5" width="179" height="7" transform="rotate(-90 1.5 254.5)" fill="white" stroke="black" stroke-width="3"/>
                        <rect id="window4" x="1.5" y="569.5" width="179" height="7" transform="rotate(-90 1.5 569.5)" fill="white" stroke="black" stroke-width="3"/>
                        <rect id="window3" x="51.5" y="631.5" width="179" height="6" fill="white" stroke="black" stroke-width="3"/>
                        <rect id="window2" x="382.5" y="631.5" width="179" height="6" fill="white" stroke="black" stroke-width="3"/>
                        <rect id="window1" x="678.5" y="631.5" width="179" height="6" fill="white" stroke="black" stroke-width="3"/>
                    </g>
                    <g id="table12" data-number="12" class="table">
                        <rect id="Rectangle 46" width="82" height="82" transform="matrix(-1 0 0 1 391 276)"/>
                        <circle id="Ellipse 4" cx="13.5" cy="13.5" r="13.5" transform="matrix(-1 0 0 1 298 304)"/>
                        <circle id="Ellipse 5" cx="13.5" cy="13.5" r="13.5" transform="matrix(-1 0 0 1 429 304)"/>
                    </g>
                    <g id="table11" data-number="11" class="table">
                        <rect id="Rectangle 46_2" width="82" height="82" transform="matrix(-1 0 0 1 618 276)"/>
                        <circle id="Ellipse 4_2" cx="13.5" cy="13.5" r="13.5" transform="matrix(-1 0 0 1 525 304)" />
                        <circle id="Ellipse 5_2" cx="13.5" cy="13.5" r="13.5" transform="matrix(-1 0 0 1 656 304)" />
                    </g>
                    <g id="table10" data-number="10" class="table">
                        <circle id="Ellipse 4_3" cx="13.5" cy="13.5" r="13.5" transform="matrix(-1 0 0 1 668 171)" />
                        <circle id="Ellipse 5_3" cx="13.5" cy="13.5" r="13.5" transform="matrix(-1 0 0 1 668 40)" />
                        <rect id="Rectangle 46_3" width="82" height="82" transform="matrix(-1 0 0 1 695 78)" />
                    </g>
                    <g id="table9" data-number="9" class="table">
                        <circle id="Ellipse 4_4" cx="13.5" cy="13.5" r="13.5" transform="matrix(-1 0 0 1 511 171)"/>
                        <circle id="Ellipse 5_4" cx="13.5" cy="13.5" r="13.5" transform="matrix(-1 0 0 1 511 40)"/>
                        <rect id="Rectangle 46_4" width="82" height="82" transform="matrix(-1 0 0 1 538 78)"/>
                    </g>
                    <g id="table8" data-number="8" class="table">
                        <circle id="Ellipse 5_5" cx="13.5" cy="13.5" r="13.5" transform="matrix(4.37114e-08 1 1 -4.37114e-08 256 46)" />
                        <circle id="Ellipse 7" cx="13.5" cy="13.5" r="13.5" transform="matrix(4.37114e-08 1 1 -4.37114e-08 256 165)" />
                        <circle id="Ellipse 6" cx="13.5" cy="13.5" r="13.5" transform="matrix(4.37114e-08 1 1 -4.37114e-08 331 46)" />
                        <circle id="Ellipse 8" cx="13.5" cy="13.5" r="13.5" transform="matrix(4.37114e-08 1 1 -4.37114e-08 331 165)" />
                        <rect id="Rectangle 46_5" width="82" height="149" transform="matrix(4.37114e-08 1 1 -4.37114e-08 232 78)" />

                    </g>
                    <g id="table7" data-number="7" class="table">
                        <circle id="Ellipse 6_2" cx="13.5" cy="13.5" r="13.5" transform="matrix(4.37114e-08 1 1 -4.37114e-08 149 105)" />
                        <circle id="Ellipse 7_2" cx="13.5" cy="13.5" r="13.5" transform="matrix(4.37114e-08 1 1 -4.37114e-08 32 105)" />
                        <rect id="Rectangle 47" width="82" height="82" transform="matrix(4.37114e-08 1 1 -4.37114e-08 63 78)" />
                        <circle id="Ellipse 8_2" cx="13.5" cy="13.5" r="13.5" transform="matrix(4.37114e-08 1 1 -4.37114e-08 89 46)" />
                    </g>
                    <g id="table6" data-number="6" class="table">
                        <circle id="Ellipse 6_3" cx="13.5" cy="13.5" r="13.5" transform="matrix(4.37114e-08 1 1 -4.37114e-08 149 233)" />
                        <circle id="Ellipse 8_3" cx="13.5" cy="13.5" r="13.5" transform="matrix(4.37114e-08 1 1 -4.37114e-08 149 272)" />
                        <circle id="Ellipse 7_3" cx="13.5" cy="13.5" r="13.5" transform="matrix(4.37114e-08 1 1 -4.37114e-08 32 253)" />
                        <rect id="Rectangle 47_2" width="82" height="82" transform="matrix(4.37114e-08 1 1 -4.37114e-08 63 226)" />
                    </g>
                    <g id="table5" data-number="5" class="table">
                        <circle id="Ellipse 4_5" cx="13.5" cy="13.5" r="13.5" transform="matrix(-1 0 0 1 118 561)" />
                        <circle id="Ellipse 4_6" cx="13.5" cy="13.5" r="13.5" transform="matrix(-1 0 0 1 118 375)" />
                        <circle id="Ellipse 5_6" cx="13.5" cy="13.5" r="13.5" transform="matrix(-1 0 0 1 177 431)" />
                        <circle id="Ellipse 7_4" cx="13.5" cy="13.5" r="13.5" transform="matrix(-1 0 0 1 60 431)" />
                        <circle id="Ellipse 6_4" cx="13.5" cy="13.5" r="13.5" transform="matrix(-1 0 0 1 177 494)" />
                        <circle id="Ellipse 8_4" cx="13.5" cy="13.5" r="13.5" transform="matrix(-1 0 0 1 59 494)" />
                        <rect id="Rectangle 46_6" width="82" height="149" transform="matrix(-1 0 0 1 145 407)" />
                    </g>
                    <g id="table4" data-number="4" class="table">
                        <circle id="Ellipse 4_7" cx="13.5" cy="13.5" r="13.5" transform="matrix(-1 0 0 1 304 565)" />
                        <circle id="Ellipse 5_7" cx="13.5" cy="13.5" r="13.5" transform="matrix(-1 0 0 1 304 446)" />
                        <rect id="Rectangle 46_7" width="82" height="82" transform="matrix(-1 0 0 1 331 478)" />
                        <circle id="Ellipse 5_8" cx="13.5" cy="13.5" r="13.5" transform="matrix(-1 0 0 1 243 505)" />
                    </g>
                    <g id="table3" data-number="3" class="table">
                        <circle id="Ellipse 6_5" cx="13.5" cy="13.5" r="13.5" transform="matrix(-1 0 0 1 456 564)" />
                        <circle id="Ellipse 8_5" cx="13.5" cy="13.5" r="13.5" transform="matrix(-1 0 0 1 417 564)" />
                        <circle id="Ellipse 7_5" cx="13.5" cy="13.5" r="13.5" transform="matrix(-1 0 0 1 436 447)" />
                        <rect id="Rectangle 47_3" width="82" height="82" transform="matrix(-1 0 0 1 463 478)" />
                    </g>
                    <g id="table2" data-number="2" class="table">
                        <circle id="Ellipse 5_9" cx="13.5" cy="13.5" r="13.5" transform="matrix(4.37114e-08 1 1 -4.37114e-08 538 446)" />
                        <circle id="Ellipse 7_6" cx="13.5" cy="13.5" r="13.5" transform="matrix(4.37114e-08 1 1 -4.37114e-08 538 565)" />
                        <circle id="Ellipse 6_6" cx="13.5" cy="13.5" r="13.5" transform="matrix(4.37114e-08 1 1 -4.37114e-08 613 446)" />
                        <circle id="Ellipse 8_6" cx="13.5" cy="13.5" r="13.5" transform="matrix(4.37114e-08 1 1 -4.37114e-08 613 565)" />
                        <rect id="Rectangle 46_8" width="82" height="149" transform="matrix(4.37114e-08 1 1 -4.37114e-08 514 478)" />
                    </g>
                    <g id="table1" data-number="1" class="table">
                        <circle id="Ellipse 4_8" cx="13.5" cy="13.5" r="13.5" transform="matrix(-1 0 0 1 768 565)" />
                        <circle id="Ellipse 5_10" cx="13.5" cy="13.5" r="13.5" transform="matrix(-1 0 0 1 768 446)" />
                        <circle id="Ellipse 4_9" cx="13.5" cy="13.5" r="13.5" transform="matrix(-1 0 0 1 832 507)" />
                        <rect id="Rectangle 46_9" width="82" height="82" transform="matrix(-1 0 0 1 795 478)" />
                    </g>
                    <g id="table-noreserve">
                        <circle id="Ellipse 20" cx="1165.52" cy="28.1799" r="15" fill="#FFD582"/>
                        <text fill="black" xml:space="preserve" style="white-space: pre" font-family="Ubuntu" font-size="18" font-weight="300" letter-spacing="0em"><tspan x="1200" y="34.8667">Столик свободен</tspan></text>
                    </g>
                    <g id="table-reserve">
                        <text fill="black" xml:space="preserve" style="white-space: pre" font-family="Ubuntu" font-size="18" font-weight="300" letter-spacing="0em"><tspan x="1200" y="103.007">Столик забронирован</tspan></text>
                        <circle id="Ellipse 21" cx="1165.52" cy="96.3201" r="15" fill="#C1272D"/>
                    </g>
                </g>
            </svg>
            <x-button class="book-form__sbmt">Забронировать</x-button>
        </form>
    </div>

    <link rel="stylesheet" href="{{asset('/css/booking.css')}}">
    <script src="{{asset('/js/booking.js')}}"></script>
@endsection
