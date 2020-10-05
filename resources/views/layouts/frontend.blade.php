<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Camerooon</title>

    <link  rel="icon" type="image/x-icon" href="https://shop2motherland.com/pub/media/favicon/default/favicon_1.ico" />
    <link  rel="shortcut icon" type="image/x-icon" href="https://shop2motherland.com/pub/media/favicon/default/favicon_1.ico" />

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('style')
</head>
<body>
<div id="app">
    <main class="py-4">
        @yield('content')
    </main>
{{--    <footer class="page-footer"><div class="footer footer-wrapper">--}}
{{--            <a id="yt-totop-fix" href="javascript:void(0)" title="Go to Top"></a>--}}

{{--            <div class="footer-container footer-style-9">--}}
{{--                <div class="footer-wrapper">--}}
{{--                    <div class="footer-top">--}}
{{--                        <div class="container clearfix">--}}
{{--                            <div class="col-md-4 col-sm-6 col-xs-12 block-inline contact-footer">--}}
{{--                                <div class="footer-block">--}}
{{--                                    <div class="footer-block-title">--}}
{{--                                        <h3>Contact Us</h3>--}}
{{--                                    </div>--}}
{{--                                    <div class="footer-block-content">--}}
{{--                                        <ul class="links-contact">--}}
{{--                                            <li class="add-icon">Address: 23 Elks Trail New Castle, DE, 19720 United States</li>--}}
{{--                                            <li class="email-icon middle-content">Email: support@shop2motherland.com</li>--}}
{{--                                            <li class="phone-icon">Phone: 877 628-2199</li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-3 col-sm-6 col-xs-12 block-inline about-store">--}}
{{--                                <div class="footer-block">--}}
{{--                                    <div class="footer-block-title">--}}
{{--                                        <h3>About Market</h3>--}}
{{--                                    </div>--}}
{{--                                    <div class="footer-block-content">--}}
{{--                                        <ul class="links-footer">--}}
{{--                                            <li><a title="About Us" href="https://shop2motherland.com/about-us/">About Us</a></li>--}}
{{--                                            <li><a title="Terms of Use" href="https://shop2motherland.com/term/">Terms of Use</a></li>--}}
{{--                                            <li><a title="Privacy Policy" href="https://shop2motherland.com/privacy-policy/">Privacy Policy</a></li>--}}
{{--                                            <li><a title="Site Map" href="https://shop2motherland.com/site-map/">Site Map</a></li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-3 col-sm-6 col-xs-12 block-inline customer-services">--}}
{{--                                <div class="footer-block">--}}
{{--                                    <div class="footer-block-title">--}}
{{--                                        <h3>Customer Service</h3>--}}
{{--                                    </div>--}}
{{--                                    <div class="footer-block-content">--}}
{{--                                        <ul class="links-footer">--}}
{{--                                            <li><a title="Shipping Policy" href="https://shop2motherland.com/shipping/">Shipping Policy</a></li>--}}

{{--                                            <li><a title="My Account" href="https://shop2motherland.com/customer/account/">My Account</a></li>--}}
{{--                                            <li><a title="Return Policy" href="https://shop2motherland.com/return-policy/">Return Policy</a></li>--}}
{{--                                            <li><a title="Contact Us" href="https://shop2motherland.com/contact-us/">Contact Us</a></li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-2 col-sm-6 col-xs-12 block-inline payment-shipping">--}}
{{--                                <div class="footer-block">--}}
{{--                                    <div class="footer-block-title">--}}
{{--                                        <h3>Payment &amp; Shipping</h3>--}}
{{--                                    </div>--}}
{{--                                    <div class="footer-block-content">--}}
{{--                                        <ul class="links-footer">--}}
{{--                                            <li><a title="Terms of Use" href="https://shop2motherland.com/term-of-use/">Terms of Use</a></li>--}}
{{--                                            <li><a title="Payment Methods" href="https://shop2motherland.com/payment-method/">Payment Methods</a></li>--}}
{{--                                            <li><a title="Shipping Guide" href="https://shop2motherland.com/shipping-guide/">Shipping Guide</a></li>--}}
{{--                                            <li><a title="Locations We Ship To" href="https://shop2motherland.com/location-shipping/">Locations We Ship To</a></li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="footer-middle">--}}
{{--                        <div class="container container-table clearfix">--}}
{{--                            <div class="col-lg-4 social-wrapper"><div class="socials-wrap">--}}
{{--                                    <div class="title-follow">Follow Us</div>--}}
{{--                                    <ul>--}}
{{--                                        <li class="li-social facebook-social">--}}
{{--                                            <a title="Facebook" href=" https://web.facebook.com/shop2motherland/ " target="_blank">--}}
{{--                                                <span class="fa fa-facebook icon-social"></span><span class="name-social">Facebook</span>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}

{{--                                        <li class="li-social twitter-social">--}}
{{--                                            <a title="Twitter" href="https://twitter.com/shop2motherland " target="_blank">--}}
{{--                                                <span class="fa fa-twitter icon-social"></span> <span class="name-social">Twitter</span>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}


{{--                                        <li class="li-social linkedin-social">--}}
{{--                                            <a title="Linkedin" href="https://www.linkedin.com/in/shop2-motherland-8a57561a9/" target="_blank">--}}
{{--                                                <span class="fa fa-linkedin icon-social"></span> <span class="name-social">Linkedin</span>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}




{{--                                        <a href="https://www.bbb.org/us/de/new-castle/profile/internet-marketing-services/shop2motherland-inc-0251-92019408/#sealclick" target="_blank" rel="nofollow" style="color:#000 !important;"><img src="https://seal-delaware.bbb.org/seals/blue-seal-250-52-whitetxt-bbb-92019408.png" style="border: 0;" alt="Shop2motherland Inc. BBB Business Review" /></a>--}}


{{--                                    </ul>--}}
{{--                                </div></div>--}}

{{--                            <div class="col-lg-8 newsletter-wrapper">--}}
{{--                                <div class="newsletter-title"><span class="first-span">Sign Up For </span><span class="last-span">NewsLetter</span></div>--}}
{{--                                <div class="block-subscribe-footer">--}}
{{--                                    <div class="title-middle-footer">--}}
{{--                                        Sign Up For Newsletter	</div>--}}
{{--                                    <form class="form subscribe"--}}
{{--                                          novalidate--}}
{{--                                          action="https://shop2motherland.com/newsletter/subscriber/new/"--}}
{{--                                          method="post"--}}
{{--                                          data-mage-init='{"validation": {"errorClass": "mage-error"}}'--}}
{{--                                          id="newsletter-footer-validate-detail">--}}

{{--                                        <div class="newsletter-content">--}}
{{--                                            <div class="input-box">--}}
{{--                                                <input name="email" type="email" id="newsletter-footer" placeholder="Your Email Address"/>--}}
{{--                                            </div>--}}

{{--                                            <div class="action-button">--}}
{{--                                                <button class="action subscribe primary" title="Subscribe" type="submit">--}}
{{--                                                    <span>Subscribe</span>--}}
{{--                                                </button>--}}

{{--                                            </div>--}}

{{--                                        </div>--}}
{{--                                    </form>--}}
{{--                                    <br>--}}
{{--                                    <img src="https://shop2motherland.com/trust_seal.png" width="150px" style="height: auto;" />--}}
{{--                                    <div>--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="footer-bottom">--}}
{{--                        <div class="container">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 copyright-footer">--}}
{{--                                    <address>Copyright © 2020-. All rights reserved.</address>--}}
{{--                                </div>--}}

{{--                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 footer-payment">--}}
{{--                                    <img  class="mark-lazy lazyload"   src="https://shop2motherland.com/pub/media/lazyloading/blank.png" data-src="https://shop2motherland.com/pub/media/wysiwyg/payment/payment-id16.png"  alt="Payment" />						</div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div></footer>--}}
</div>
</body>
</html>
