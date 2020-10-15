<div class="header-container header-style-9">
    <div class="header-top">
        <div class="container">
            <div class="row row-topheader">
                <div class="col-lg-4 col-md-4 col-sm-3 language-currency-header">
                    <div class="language-wrapper">
                    </div>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-9 header-top-links">
                    <div class="toplinks-wrapper">
                        <ul class="header links">
{{--                            <li class="myaccount-link">--}}
{{--                                <a href="https://shop2motherland.com/us/customer/account/" title="My Account">My--}}
{{--                                    Account</a>--}}
{{--                            </li>--}}
{{--                            <li class="link wishlist" data-bind="scope: 'wishlist'">--}}
{{--                                <a href="https://shop2motherland.com/us/wishlist/">My Wish List--}}
{{--                                    <!-- ko if: wishlist().counter -->--}}
{{--                                    <span data-bind="text: wishlist().counter" class="counter qty"></span>--}}
{{--                                    <!-- /ko -->--}}
{{--                                </a>--}}
{{--                            </li>--}}

{{--                            <li class="checkout-link">--}}
{{--                                <a href="https://shop2motherland.com/us/checkout/" title="Checkout">Checkout</a>--}}
{{--                            </li>--}}
{{--                            <li class="authorization-link" data-label="or">--}}
{{--                                <a href="https://shop2motherland.com/us/customer/account/login/referer/aHR0cHM6Ly9zaG9wMm1vdGhlcmxhbmQuY29tL3VzLw%2C%2C/">--}}
{{--                                    Sign In </a>--}}
{{--                            </li>--}}
{{--                            <li><a href="https://shop2motherland.com/us/marketplace/">Seller Registration</a></li>--}}
{{--                            <li><a href="https://shop2motherland.com/us/marketplace/seller/sellerlist/">Seller List</a>--}}
{{--                            </li>--}}
                            @guest()
                            <li>
                                <a href="{{route('login')}}">Login</a>
                            </li>
                            <li>
                                <a href="{{route('register')}}">Register</a>
                            </li>
                            @endguest
                            <li>
                                <a href="{{route('company.form')}}">Register company</a>
                            </li>

                            <li>
                                <a href="{{route('send.payment')}}">Send Payment</a>
                            </li>
                            @auth
                                <li>
                                    <a href="{{route('home')}}">Dashboard</a>
                                </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="dripicons-exit text-muted mr-2"></i> {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                            @endauth
{{--                            <li class="nav item"><a href="https://shop2motherland.com/us/location/">Store Locator</a>--}}
{{--                            </li>--}}
                        </ul>
                        <style type="text/css">
                            .header-top .header-top-links .toplinks-wrapper {
                                display: flex;
                            }

                            .goog-logo-link {
                                display: none !important;
                            }

                            .goog-te-gadget {
                                color: transparent !important;
                            }

                            .goog-te-gadget .goog-te-combo {
                                color: #444 !important;
                                margin: 2px 2px;
                                cursor: pointer;
                            }


                            @media screen and (max-width: 767px) {
                                .custom-google {
                                    float: none !important;
                                    position: absolute;
                                    margin-top: 15px;
                                }

                                .custom-google .goog-te-gadget .goog-te-gadget-simple {
                                    padding: 8px 8px;
                                }

                                .custom-google .goog-te-gadget .goog-te-gadget-icon {
                                    float: left;
                                    background-repeat: no-repeat;
                                }

                                .custom-google .goog-te-gadget span {
                                    display: inline-block;
                                }

                                .custom-google .goog-te-gadget span .goog-te-menu-value {
                                    padding: 0px 4px 0px 6px !important;
                                }
                            }

                            .goog-te-banner-frame.skiptranslate {
                                display: none !important;
                            }

                            body {
                                top: 0px !important;
                            }

                            .select-css {
                                display: block;
                                font-family: sans-serif;
                                font-weight: 700;
                                color: #444;
                                line-height: 1.3;
                                padding: .6em 1.4em .5em .8em;
                                width: 100%;
                                max-width: 100%; /* useful when width is set to anything other than 100% */
                                box-sizing: border-box;
                                margin: 0;
                                box-shadow: 0 1px 0 1px rgba(0, 0, 0, .04);
                                -moz-appearance: none;
                                -webkit-appearance: none;
                                appearance: none;
                                background-color: #fff;
                                /* note: bg image below uses 2 urls. The first is an svg data uri for the arrow icon, and the second is the gradient.
                                    for the icon, if you want to change the color, be sure to use `%23` instead of `#`, since it's a url. You can also swap in a different svg icon or an external image reference

                                */
                                background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23007CB2%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'),
                                linear-gradient(to bottom, #ffffff 0%, #e5e5e5 100%);
                                background-repeat: no-repeat, repeat;
                                /* arrow icon position (1em from the right, 50% vertical) , then gradient position*/
                                background-position: right .7em top 50%, 0 0;
                                /* icon size, then gradient */
                                background-size: .65em auto, 100%;
                            }

                            /* Hide arrow icon in IE browsers */
                            .select-css::-ms-expand {
                                display: none;
                            }

                            /* Hover style */
                            .select-css:hover {
                                border-color: #888;
                            }

                            /* Focus style */
                            .select-css:focus {
                                border-color: #aaa;
                                /* It'd be nice to use -webkit-focus-ring-color here but it doesn't work on box-shadow */
                                box-shadow: 0 0 1px 3px rgba(59, 153, 252, .7);
                                box-shadow: 0 0 0 3px -moz-mac-focusring;
                                color: #222;
                                outline: none;
                            }

                            /* Set options to normal weight */
                            .select-css option {
                                font-weight: normal;
                            }

                            /* Support for rtl text, explicit support for Arabic and Hebrew */
                            *[dir="rtl"] .select-css, :root:lang(ar) .select-css, :root:lang(iw) .select-css {
                                background-position: left .7em top 50%, 0 0;
                                padding: .6em .8em .5em 1.4em;
                            }

                            /* Disabled styles */
                            .select-css:disabled, .select-css[aria-disabled=true] {
                                color: graytext;
                                background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22graytext%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'),
                                linear-gradient(to bottom, #ffffff 0%, #e5e5e5 100%);
                            }

                            .select-css:disabled:hover, .select-css[aria-disabled=true] {
                                border-color: #aaa;
                            }

                            .goog-te-combo {
                                display: block;
                                font-family: sans-serif;
                                font-weight: 700;
                                color: #444;
                                line-height: 1.3;
                                padding: .6em 1.4em .5em .8em;
                                width: 100%;
                                max-width: 100%; /* useful when width is set to anything other than 100% */
                                box-sizing: border-box;
                                margin: 0;
                                box-shadow: 0 1px 0 1px rgba(0, 0, 0, .04);
                                -moz-appearance: none;
                                -webkit-appearance: none;
                                appearance: none;
                                background-color: #fff;
                                /* note: bg image below uses 2 urls. The first is an svg data uri for the arrow icon, and the second is the gradient.
                                    for the icon, if you want to change the color, be sure to use `%23` instead of `#`, since it's a url. You can also swap in a different svg icon or an external image reference

                                */
                                background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23007CB2%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'),
                                linear-gradient(to bottom, #ffffff 0%, #e5e5e5 100%);
                                background-repeat: no-repeat, repeat;
                                /* arrow icon position (1em from the right, 50% vertical) , then gradient position*/
                                background-position: right .7em top 50%, 0 0;
                                /* icon size, then gradient */
                                background-size: .65em auto, 100%;

                            }

                            .goog-te-combo:hover {
                                border-color: #888;
                            }

                            /* Focus style */
                            .goog-te-combo:focus {
                                border-color: #aaa;
                                /* It'd be nice to use -webkit-focus-ring-color here but it doesn't work on box-shadow */
                                box-shadow: 0 0 1px 3px rgba(59, 153, 252, .7);
                                box-shadow: 0 0 0 3px -moz-mac-focusring;
                                color: #222;
                                outline: none;
                            }

                            /* Set options to normal weight */
                            .goog-te-combo option {
                                font-weight: normal;
                            }

                            /* Support for rtl text, explicit support for Arabic and Hebrew */
                            *[dir="rtl"] .goog-te-combo, :root:lang(ar) .goog-te-combo, :root:lang(iw) .goog-te-combo {
                                background-position: left .7em top 50%, 0 0;
                                padding: .6em .8em .5em 1.4em;
                            }

                            /* Disabled styles */
                            .goog-te-combo:disabled, .goog-te-combo[aria-disabled=true] {
                                color: graytext;
                                background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22graytext%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'),
                                linear-gradient(to bottom, #ffffff 0%, #e5e5e5 100%);
                            }

                            .goog-te-combo:disabled:hover, .goog-te-combo[aria-disabled=true] {
                                border-color: #aaa;
                            }

                        </style>
                        <div class="main-custom-google">
                            <div class="custom-google">
                                <div id="google-translate-element"></div>


                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="header-middle">
        <div class="container">
            <div class="middle-content">
                <div class="row">
                    <div class="col-lg-3 logo-header">
                        <div class="logo-wrapper">
                            <h1 class="logo-content">
                                <strong class="logo">
                                    <a class="logo" href="{{url('/')}}" title="Cameroon">
                                        <img src="https://shop2motherland.com/pub/media/logo/default/mother.png"
                                             alt=""
                                             width="105" height="57"/>

                                    </a>
                                </strong>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-bottom">
        <div class="container">
            <div class="row">
                <div class="navigation-mobile-container">


                    <!--COLLAPSE-->

                    <!--SIDEBAR-->
                    <div class="nav-mobile-container sidebar-type">
                        <div class="btn-mobile">
                            <a id="sidebar-button" class="button-mobile sidebar-nav" title="Categories"><i
                                    class="fa fa-bars"></i><span class="hidden">Categories</span></a>
                        </div>

                        <nav id="navigation-mobile" class="navigation-mobile"></nav>


                    </div>


                </div>

                <div class="col-xl-12 col-lg-12 col-md-12 main-megamenu">
                    <nav class="sm_megamenu_wrapper_horizontal_menu sambar" id="sm_megamenu_menu5f84a2b5ed374"
                         data-sam="2360437411602527925">
                        <div class="sambar-inner">
					<span class="btn-sambar" data-sapi="collapse" data-href="#sm_megamenu_menu5f84a2b5ed374">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</span>
                            <div class="mega-content">
                                <ul class="horizontal-type sm-megamenu-hover sm_megamenu_menu sm_megamenu_menu_black"
                                    data-jsapi="on">

                                    <li class="other-toggle 							sm_megamenu_lv1 sm_megamenu_drop parent    ">
                                        <a class="sm_megamenu_head sm_megamenu_drop sm_megamenu_haschild"
                                           href="https://shop2motherland.com/us/groceries.html" id="sm_megamenu_120">
							                                    <span class="sm_megamenu_icon sm_megamenu_nodesc">
														                                        <span
                                                                                                    class="sm_megamenu_title">Grocery</span>
																			</span>
                                        </a>
                                        <div class="sm-megamenu-child sm_megamenu_dropdown_6columns ">
                                            <div data-link="https://shop2motherland.com/us/"
                                                 class="sm_megamenu_col_6 sm_megamenu_firstcolumn    ">
                                                <div data-link="" class="sm_megamenu_col_6    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  ">
                                                            <div data-link="https://shop2motherland.com/us/"
                                                                 class="sm_megamenu_col_2    ">
                                                                <div class="sm_megamenu_head_item">
                                                                    <div class="sm_megamenu_title  "><a
                                                                            class="sm_megamenu_nodrop "
                                                                            href="https://shop2motherland.com/us/groceries/baby.html" target="_blank"><span
                                                                                class="sm_megamenu_title_lv-3">Baby</span></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div data-link="https://shop2motherland.com/us/"
                                                                 class="sm_megamenu_col_2    ">
                                                                <div class="sm_megamenu_head_item">
                                                                    <div class="sm_megamenu_title  "><a
                                                                            class="sm_megamenu_nodrop " target="_blank"
                                                                            href="https://shop2motherland.com/us/groceries/beer-wine-spirits.html"><span
                                                                                class="sm_megamenu_title_lv-3">Beer, Wine & Spirits</span></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div data-link="https://shop2motherland.com/us/"
                                                                 class="sm_megamenu_col_2    ">
                                                                <div class="sm_megamenu_head_item">
                                                                    <div class="sm_megamenu_title  "><a
                                                                            class="sm_megamenu_nodrop " target="_blank"
                                                                            href="https://shop2motherland.com/us/groceries/cookies-snacks-candy.html"><span
                                                                                class="sm_megamenu_title_lv-3">Cookies, Snacks & Candy</span></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div data-link="https://shop2motherland.com/us/"
                                                                 class="sm_megamenu_col_2 sm_megamenu_firstcolumn    ">
                                                                <div class="sm_megamenu_head_item">
                                                                    <div class="sm_megamenu_title  "><a
                                                                            class="sm_megamenu_nodrop " target="_blank"
                                                                            href="https://shop2motherland.com/us/groceries/beverages-tea-coffee-soda-juice-hot-chocolate-water-etc.html"><span
                                                                                class="sm_megamenu_title_lv-3">Beverages</span></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div data-link="https://shop2motherland.com/us/"
                                                                 class="sm_megamenu_col_2    ">
                                                                <div class="sm_megamenu_head_item">
                                                                    <div class="sm_megamenu_title  "><a
                                                                            class="sm_megamenu_nodrop " target="_blank"
                                                                            href="https://shop2motherland.com/us/groceries/bread-bakery.html"><span
                                                                                class="sm_megamenu_title_lv-3">Bread & Bakery</span></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div data-link="https://shop2motherland.com/us/"
                                                                 class="sm_megamenu_col_2    ">
                                                                <div class="sm_megamenu_head_item">
                                                                    <div class="sm_megamenu_title  "><a
                                                                            class="sm_megamenu_nodrop " target="_blank"
                                                                            href="https://shop2motherland.com/us/groceries/canned-goods-soups.html"><span
                                                                                class="sm_megamenu_title_lv-3">Canned Goods & Soups</span></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div data-link="https://shop2motherland.com/us/"
                                                                 class="sm_megamenu_col_2 sm_megamenu_firstcolumn    ">
                                                                <div class="sm_megamenu_head_item">
                                                                    <div class="sm_megamenu_title  "><a
                                                                            class="sm_megamenu_nodrop " target="_blank"
                                                                            href="https://shop2motherland.com/us/groceries/breakfast-cereal.html"><span
                                                                                class="sm_megamenu_title_lv-3">Breakfast & Cereal</span></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div data-link="https://shop2motherland.com/us/"
                                                                 class="sm_megamenu_col_2    ">
                                                                <div class="sm_megamenu_head_item">
                                                                    <div class="sm_megamenu_title  "><a
                                                                            class="sm_megamenu_nodrop " target="_blank"
                                                                            href="https://shop2motherland.com/us/groceries/condiments-spices-bake.html"><span
                                                                                class="sm_megamenu_title_lv-3">Condiments/Spices & Bake</span></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div data-link="https://shop2motherland.com/us/"
                                                                 class="sm_megamenu_col_2    ">
                                                                <div class="sm_megamenu_head_item">
                                                                    <div class="sm_megamenu_title  "><a
                                                                            class="sm_megamenu_nodrop " target="_blank"
                                                                            href="https://shop2motherland.com/us/groceries/cookies-snacks-candy.html"><span
                                                                                class="sm_megamenu_title_lv-3">Cookies, Snacks & Candy</span></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div data-link="https://shop2motherland.com/us/"
                                                                 class="sm_megamenu_col_2 sm_megamenu_firstcolumn    ">
                                                                <div class="sm_megamenu_head_item">
                                                                    <div class="sm_megamenu_title  "><a
                                                                            class="sm_megamenu_nodrop " target="_blank"
                                                                            href="https://shop2motherland.com/us/groceries/dairy-eggs-cheese.html"><span
                                                                                class="sm_megamenu_title_lv-3">Dairy, Eggs & Cheese</span></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div data-link="https://shop2motherland.com/us/"
                                                                 class="sm_megamenu_col_2    ">
                                                                <div class="sm_megamenu_head_item">
                                                                    <div class="sm_megamenu_title  "><a
                                                                            class="sm_megamenu_nodrop " target="_blank"
                                                                            href="https://shop2motherland.com/us/groceries/deli-signature-cafe.html"><span
                                                                                class="sm_megamenu_title_lv-3">Deli & Signature Cafe</span></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div data-link="https://shop2motherland.com/us/"
                                                                 class="sm_megamenu_col_2    ">
                                                                <div class="sm_megamenu_head_item">
                                                                    <div class="sm_megamenu_title  "><a
                                                                            class="sm_megamenu_nodrop " target="_blank"
                                                                            href="https://shop2motherland.com/us/groceries/frozen-foods.html"><span
                                                                                class="sm_megamenu_title_lv-3">Frozen Foods</span></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div data-link="https://shop2motherland.com/us/"
                                                                 class="sm_megamenu_col_2 sm_megamenu_firstcolumn    ">
                                                                <div class="sm_megamenu_head_item">
                                                                    <div class="sm_megamenu_title  "><a
                                                                            class="sm_megamenu_nodrop " target="_blank"
                                                                            href="https://shop2motherland.com/us/groceries/produce-fruits-vegetables.html"><span
                                                                                class="sm_megamenu_title_lv-3">Produce: Fruits & Vegetables</span></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div data-link="https://shop2motherland.com/us/"
                                                                 class="sm_megamenu_col_2    ">
                                                                <div class="sm_megamenu_head_item">
                                                                    <div class="sm_megamenu_title  "><a
                                                                            class="sm_megamenu_nodrop " target="_blank"
                                                                            href="https://shop2motherland.com/us/groceries/grains-pasta-sides.html"><span
                                                                                class="sm_megamenu_title_lv-3">Grains, Pasta & Sides</span></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div data-link="https://shop2motherland.com/us/"
                                                                 class="sm_megamenu_col_2    ">
                                                                <div class="sm_megamenu_head_item">
                                                                    <div class="sm_megamenu_title  "><a
                                                                            class="sm_megamenu_nodrop " target="_blank"
                                                                            href="https://shop2motherland.com/us/groceries/meat-seafood.html"><span
                                                                                class="sm_megamenu_title_lv-3">Meat & Seafood</span></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div data-link="https://shop2motherland.com/us/"
                                                                 class="sm_megamenu_col_2 sm_megamenu_firstcolumn    ">
                                                                <div class="sm_megamenu_head_item">
                                                                    <div class="sm_megamenu_title  "><a
                                                                            class="sm_megamenu_nodrop " target="_blank"
                                                                            href="https://shop2motherland.com/us/groceries/miscellaneous-gift-cards-wrap-batteries-etc.html"><span
                                                                                class="sm_megamenu_title_lv-3">Miscellaneous – gift cards/wrap, batteries, etc.</span></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div data-link="https://shop2motherland.com/us/"
                                                                 class="sm_megamenu_col_2    ">
                                                                <div class="sm_megamenu_head_item">
                                                                    <div class="sm_megamenu_title  "><a
                                                                            class="sm_megamenu_nodrop " target="_blank"
                                                                            href="https://shop2motherland.com/us/groceries/paper-products-toilet-paper-paper-towels-tissues-paper-plates-cups-etc.html"><span
                                                                                class="sm_megamenu_title_lv-3">Paper Products – toilet paper, paper towels, tissues, paper plates/cups, etc.</span></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div data-link="https://shop2motherland.com/us/"
                                                                 class="sm_megamenu_col_2    ">
                                                                <div class="sm_megamenu_head_item">
                                                                    <div class="sm_megamenu_title  "><a
                                                                            class="sm_megamenu_nodrop " target="_blank"
                                                                            href="https://shop2motherland.com/us/groceries/tobacco.html"><span
                                                                                class="sm_megamenu_title_lv-3">Tobacco</span></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="btn-submobile"></span>
                                    </li>
                                    <li class="other-toggle 							sm_megamenu_lv1 sm_megamenu_drop parent    ">
                                        <a class="sm_megamenu_head sm_megamenu_drop sm_megamenu_haschild"
                                           href="https://shop2motherland.com/us/argro-products.html"
                                           id="sm_megamenu_185">
							                                    <span class="sm_megamenu_icon sm_megamenu_nodesc">
														                                        <span
                                                                                                    class="sm_megamenu_title">Agro Products</span>
																			</span>
                                        </a>
                                        <div class="sm-megamenu-child sm_megamenu_dropdown_6columns ">
                                            <div data-link="https://shop2motherland.com/us/"
                                                 class="sm_megamenu_col_6 sm_megamenu_firstcolumn    ">
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_1    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/argro-products/livestock.html"></a>
                                                            <div class="sm_megamenu_title"><h3
                                                                    class="sm_megamenu_nodrop  title-cat">Livestock</h3>
                                                            </div>
                                                            <div class="sm_megamenu_title "><a
                                                                    class="sm_megamenu_nodrop" target="_blank"
                                                                    href="https://shop2motherland.com/us/argro-products/livestock/cattle.html"><span
                                                                        class="sm_megamenu_title_lv-2">Cattle </span></a>
                                                            </div>
                                                            <div class="sm_megamenu_title "><a
                                                                    class="sm_megamenu_nodrop" target="_blank"
                                                                    href="https://shop2motherland.com/us/argro-products/livestock/goat.html"><span
                                                                        class="sm_megamenu_title_lv-2">Goat </span></a>
                                                            </div>
                                                            <div class="sm_megamenu_title "><a
                                                                    class="sm_megamenu_nodrop" target="_blank"
                                                                    href="https://shop2motherland.com/us/argro-products/livestock/pig.html"><span
                                                                        class="sm_megamenu_title_lv-2">Pig</span></a>
                                                            </div>
                                                            <div class="sm_megamenu_title "><a
                                                                    class="sm_megamenu_nodrop" target="_blank"
                                                                    href="https://shop2motherland.com/us/argro-products/livestock/lamb.html"><span
                                                                        class="sm_megamenu_title_lv-2">Lamb</span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_1    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop "
                                                                                            href="https://shop2motherland.com/us/argro-products/poultry.html"></a>
                                                            <div class="sm_megamenu_title"><h3
                                                                    class="sm_megamenu_nodrop  title-cat">Poultry </h3>
                                                            </div>
                                                            <div class="sm_megamenu_title "><a
                                                                    class="sm_megamenu_nodrop"
                                                                    href="https://shop2motherland.com/us/argro-products/poultry/chicken.html"><span
                                                                        class="sm_megamenu_title_lv-2" target="_blank">Chicken</span></a>
                                                            </div>
                                                            <div class="sm_megamenu_title "><a
                                                                    class="sm_megamenu_nodrop"
                                                                    href="https://shop2motherland.com/us/argro-products/poultry/turkey.html"><span
                                                                        class="sm_megamenu_title_lv-2" target="_blank">Turkey</span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_1    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop "
                                                                                            href="https://shop2motherland.com/us/argro-products/fishing-seafood.html"></a>
                                                            <div class="sm_megamenu_title"><h3
                                                                    class="sm_megamenu_nodrop  title-cat">Fishing &
                                                                    Seafood</h3></div>
                                                            <div class="sm_megamenu_title "><a
                                                                    class="sm_megamenu_nodrop"
                                                                    href="https://shop2motherland.com/us/argro-products/fishing-seafood/fish-farm.html"><span
                                                                        class="sm_megamenu_title_lv-2" target="_blank">Fish Farm</span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_1    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop "
                                                                                            href="https://shop2motherland.com/us/argro-products/vegetables.html"></a>
                                                            <div class="sm_megamenu_title"><h3
                                                                    class="sm_megamenu_nodrop  title-cat">
                                                                    Vegetables</h3></div>
                                                            <div class="sm_megamenu_title "><a
                                                                    class="sm_megamenu_nodrop"
                                                                    href="https://shop2motherland.com/us/argro-products/vegetables/vegetables.html"><span
                                                                        class="sm_megamenu_title_lv-2" target="_blank">Vegetables</span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="btn-submobile"></span>
                                    </li>
                                    <li class="other-toggle 							sm_megamenu_lv1 sm_megamenu_drop parent    ">
                                        <a class="sm_megamenu_head sm_megamenu_drop sm_megamenu_haschild"
                                           href="https://shop2motherland.com/us/building-and-construction-materials.html"
                                           id="sm_megamenu_78">
							                                    <span class="sm_megamenu_icon sm_megamenu_nodesc">
														                                        <span
                                                                                                    class="sm_megamenu_title">Building Materials</span>
																			</span>
                                        </a>
                                        <div class="sm-megamenu-child sm_megamenu_dropdown_6columns ">
                                            <div data-link="https://shop2motherland.com/us/"
                                                 class="sm_megamenu_col_6 sm_megamenu_firstcolumn    ">
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/building-and-construction-materials/cement.html"><span
                                                                    class="sm_megamenu_title_lv-2">Cement</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/building-and-construction-materials/flooring.html"><span
                                                                    class="sm_megamenu_title_lv-2">Flooring</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/building-and-construction-materials/lighting.html"><span
                                                                    class="sm_megamenu_title_lv-2">Lighting</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2 sm_megamenu_firstcolumn    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/building-and-construction-materials/bathroom.html"><span
                                                                    class="sm_megamenu_title_lv-2">Bathroom</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/building-and-construction-materials/doors.html"><span
                                                                    class="sm_megamenu_title_lv-2">Doors</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/building-and-construction-materials/roofing.html"><span
                                                                    class="sm_megamenu_title_lv-2">Roofing</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2 sm_megamenu_firstcolumn    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/building-and-construction-materials/binding-wires-rods.html"><span
                                                                    class="sm_megamenu_title_lv-2">Binding Wires & Rods</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/building-and-construction-materials/electricals.html"><span
                                                                    class="sm_megamenu_title_lv-2">Electricals</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/building-and-construction-materials/kitchen.html"><span
                                                                    class="sm_megamenu_title_lv-2">Kitchen</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2 sm_megamenu_firstcolumn    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/building-and-construction-materials/paint.html"><span
                                                                    class="sm_megamenu_title_lv-2">Paint</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/building-and-construction-materials/walls.html"><span
                                                                    class="sm_megamenu_title_lv-2">Walls</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/building-and-construction-materials/tiles.html"><span
                                                                    class="sm_megamenu_title_lv-2">Tiles</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2 sm_megamenu_firstcolumn    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/building-and-construction-materials/wood.html"><span
                                                                    class="sm_megamenu_title_lv-2">Wood</span></a></div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/building-and-construction-materials/interior-design.html"><span
                                                                    class="sm_megamenu_title_lv-2">Interior Design</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/building-and-construction-materials/furniture.html"><span
                                                                    class="sm_megamenu_title_lv-2">Furniture</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2 sm_megamenu_firstcolumn    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/building-and-construction-materials/plastics.html"><span
                                                                    class="sm_megamenu_title_lv-2">Plastics</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/building-and-construction-materials/generators.html"><span
                                                                    class="sm_megamenu_title_lv-2">Generators</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="btn-submobile"></span>
                                    </li>
                                    <li class="other-toggle 							sm_megamenu_lv1 sm_megamenu_drop parent    ">
                                        <a class="sm_megamenu_head sm_megamenu_drop sm_megamenu_haschild"
                                           href="https://shop2motherland.com/us/event-party-supplies.html"
                                           id="sm_megamenu_81">
							                                    <span class="sm_megamenu_icon sm_megamenu_nodesc">
														                                        <span
                                                                                                    class="sm_megamenu_title">Event & Party Supplies</span>
																			</span>
                                        </a>
                                        <div class="sm-megamenu-child sm_megamenu_dropdown_4columns ">
                                            <div data-link="https://shop2motherland.com/us/"
                                                 class="sm_megamenu_col_4 sm_megamenu_firstcolumn    ">
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/event-party-supplies/halls.html"><span
                                                                    class="sm_megamenu_title_lv-2">Halls</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/event-party-supplies/chairs.html"><span
                                                                    class="sm_megamenu_title_lv-2">Chairs</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2 sm_megamenu_firstcolumn    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/event-party-supplies/canopy.html"><span
                                                                    class="sm_megamenu_title_lv-2">Canopy</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/event-party-supplies/tables.html"><span
                                                                    class="sm_megamenu_title_lv-2">Tables</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2 sm_megamenu_firstcolumn    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/event-party-supplies/catering-equipment.html"><span
                                                                    class="sm_megamenu_title_lv-2">Catering Equipment</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/event-party-supplies/dj-equipment.html"><span
                                                                    class="sm_megamenu_title_lv-2">DJ Equipment</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2 sm_megamenu_firstcolumn    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/event-party-supplies/party-lighting.html"><span
                                                                    class="sm_megamenu_title_lv-2">Party Lighting</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="btn-submobile"></span>
                                    </li>
                                    <li class="other-toggle 							sm_megamenu_lv1 sm_megamenu_drop parent    ">
                                        <a class="sm_megamenu_head sm_megamenu_drop sm_megamenu_haschild"
                                           href="https://shop2motherland.com/us/new-in.html" id="sm_megamenu_82">
							                                    <span class="sm_megamenu_icon sm_megamenu_nodesc">
														                                        <span
                                                                                                    class="sm_megamenu_title">Fashion Store</span>
																			</span>
                                        </a>
                                        <div class="sm-megamenu-child sm_megamenu_dropdown_5columns ">
                                            <div data-link="https://shop2motherland.com/us/"
                                                 class="sm_megamenu_col_5 sm_megamenu_firstcolumn    ">
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/mens.html"></a>
                                                            <div class="sm_megamenu_title"><h3
                                                                    class="sm_megamenu_nodrop  title-cat">Mens</h3>
                                                            </div>
                                                            <div class="sm_megamenu_title "><a
                                                                    class="sm_megamenu_nodrop" target="_blank"
                                                                    href="https://shop2motherland.com/us/mens/men-s-clothing.html"><span
                                                                        class="sm_megamenu_title_lv-2">Men’s Clothing</span></a>
                                                            </div>
                                                            <div class="sm_megamenu_title "><a
                                                                    class="sm_megamenu_nodrop" target="_blank"
                                                                    href="https://shop2motherland.com/us/mens/men-s-accessories.html"><span
                                                                        class="sm_megamenu_title_lv-2">Men’s Accessories</span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2  sm_megamenu_right  ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/women.html"></a>
                                                            <div class="sm_megamenu_title"><h3
                                                                    class="sm_megamenu_nodrop  title-cat">Women</h3>
                                                            </div>
                                                            <div class="sm_megamenu_title "><a
                                                                    class="sm_megamenu_nodrop" target="_blank"
                                                                    href="https://shop2motherland.com/us/women/footwear.html"><span
                                                                        class="sm_megamenu_title_lv-2">Footwear</span></a>
                                                            </div>
                                                            <div class="sm_megamenu_title "><a
                                                                    class="sm_megamenu_nodrop" target="_blank"
                                                                    href="https://shop2motherland.com/us/women/female-clothing.html"><span
                                                                        class="sm_megamenu_title_lv-2">Female Clothing</span></a>
                                                            </div>
                                                            <div class="sm_megamenu_title "><a
                                                                    class="sm_megamenu_nodrop" target="_blank"
                                                                    href="https://shop2motherland.com/us/women/female-accessories.html"><span
                                                                        class="sm_megamenu_title_lv-2">Female Accessories</span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2 sm_megamenu_firstcolumn    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop "
                                                                                            href="https://shop2motherland.com/us/kids.html"></a>
                                                            <div class="sm_megamenu_title"><h3
                                                                    class="sm_megamenu_nodrop  title-cat">kids</h3>
                                                            </div>
                                                            <div class="sm_megamenu_title "><a
                                                                    class="sm_megamenu_nodrop"  target="_blank"
                                                                    href="https://shop2motherland.com/us/kids/all-kids.html"><span
                                                                        class="sm_megamenu_title_lv-2">Boys</span></a>
                                                            </div>
                                                            <div class="sm_megamenu_title "><a
                                                                    class="sm_megamenu_nodrop" target="_blank"
                                                                    href="https://shop2motherland.com/us/kids/girls.html"><span
                                                                        class="sm_megamenu_title_lv-2">Girls</span></a>
                                                            </div>
                                                            <div class="sm_megamenu_title "><a
                                                                    class="sm_megamenu_nodrop" target="_blank"
                                                                    href="https://shop2motherland.com/us/kids/infants.html"><span
                                                                        class="sm_megamenu_title_lv-2">Infants</span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="btn-submobile"></span>
                                    </li>
                                    <li class="other-toggle 							sm_megamenu_lv1 sm_megamenu_drop parent    ">
                                        <a class="sm_megamenu_head sm_megamenu_drop sm_megamenu_haschild"
                                           href="https://shop2motherland.com/us/household-equipments.html"
                                           id="sm_megamenu_83">
							                                    <span class="sm_megamenu_icon sm_megamenu_nodesc">
														                                        <span
                                                                                                    class="sm_megamenu_title">Household Equipments</span>
																			</span>
                                        </a>
                                        <div class="sm-megamenu-child sm_megamenu_dropdown_6columns ">
                                            <div data-link="https://shop2motherland.com/us/"
                                                 class="sm_megamenu_col_6 sm_megamenu_firstcolumn    ">
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/household-equipments/tv-s.html"><span
                                                                    class="sm_megamenu_title_lv-2">TV’s</span></a></div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/household-equipments/laptops.html"><span
                                                                    class="sm_megamenu_title_lv-2">Laptops</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/household-equipments/cell-phones.html"><span
                                                                    class="sm_megamenu_title_lv-2">Cell Phones</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2 sm_megamenu_firstcolumn    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/household-equipments/ipad-tablets.html"><span
                                                                    class="sm_megamenu_title_lv-2">Ipad & Tablets</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/household-equipments/desktop-computers.html"><span
                                                                    class="sm_megamenu_title_lv-2">Desktop Computers</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/household-equipments/printers.html"><span
                                                                    class="sm_megamenu_title_lv-2">Printers</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2 sm_megamenu_firstcolumn    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/household-equipments/refrigerators.html"><span
                                                                    class="sm_megamenu_title_lv-2">Refrigerators</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/household-equipments/stoves-cookers.html"><span
                                                                    class="sm_megamenu_title_lv-2">Stoves & Cookers</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/household-equipments/kitchen-equipment.html"><span
                                                                    class="sm_megamenu_title_lv-2">Kitchen Equipment</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-link="https://shop2motherland.com/us/"
                                                     class="sm_megamenu_col_2 sm_megamenu_firstcolumn    ">
                                                    <div class="sm_megamenu_head_item">
                                                        <div class="sm_megamenu_title  "><a class="sm_megamenu_nodrop " target="_blank"
                                                                                            href="https://shop2motherland.com/us/household-equipments/household-cleaning-supplies.html"><span
                                                                    class="sm_megamenu_title_lv-2">Household Cleaning Supplies</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="btn-submobile"></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
