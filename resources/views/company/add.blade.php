@extends('layouts.frontend')


@section('style')
    <style>
        .errorMessage {
            color: #ff0000;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
{{--        <div class="card-body p-0 shadow-lg rounded mb-4 mt-1">--}}
{{--            <!-- Nav tabs -->--}}
{{--            <ul class="nav nav-tabs shadow-sm" id="myTab" role="tablist">--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link font-weight-bold nav-link-custom @if(!\Illuminate\Support\Facades\Session::has('success')) active @endif" id="home-tab" data-toggle="tab"--}}
{{--                       href="#send_money_to_cust" role="tab" aria-controls="home" aria-selected="true">--}}
{{--                        <i class="fa fa-building"></i> Register Company--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item font-weight-bold @if(session('success') || session('error')) active @endif">--}}
{{--                    <a class="nav-link nav-link-custom" id="settings-tab" data-toggle="tab" href="#manual_recovery"--}}
{{--                       role="tab" aria-controls="settings" aria-selected="false">--}}
{{--                        <i class="fa fa-money-bill-wave"></i> Send Payment--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}

{{--            <div class="tab-content py-3">--}}
{{--                <div class="tab-pane @if(!\Illuminate\Support\Facades\Session::has('success')) active @endif"--}}
{{--                     id="send_money_to_cust" role="tabpanel"--}}
{{--                     aria-labelledby="send-money-to-customer">--}}
{{--                    @if (session('companyCreated'))--}}
{{--                        <div class="alert alert-success alert-dismissible fade show" role="alert">--}}
{{--                            <strong> {{session('companyCreated')}}</strong>--}}
{{--                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                                <span aria-hidden="true">&times;</span>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                    <div class="row justify-content-md-center">--}}
{{--                        <form method="POST" action="{{route('company.add')}}">--}}
{{--                            @csrf--}}
{{--                            <div class="form-row">--}}
{{--                                <div class="form-group col-md-12">--}}
{{--                                    <label for="name">Company Name</label>--}}
{{--                                    <input type="text" name="name" id="name" class="form-control form-control-sm"--}}
{{--                                           required value="{{old('name')}}" placeholder="Company Name">--}}
{{--                                    @error('name')--}}
{{--                                    <span class="errorMessage">{{ $message }}</span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-row">--}}
{{--                                <div class="form-group col-md-6">--}}
{{--                                    <label for="email">Email</label>--}}
{{--                                    <input type="email" class="form-control form-control-sm" id="email" name="email"--}}
{{--                                           placeholder="Email" required value="{{old('email')}}">--}}
{{--                                    @error('email')--}}
{{--                                    <span class="errorMessage">{{ $message }}</span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                                <div class="form-group col-md-6">--}}
{{--                                    <label for="password">Password</label>--}}
{{--                                    <input type="password" class="form-control form-control-sm" id="password"--}}
{{--                                           name="password" placeholder="Password" required>--}}
{{--                                    @error('password')--}}
{{--                                    <span class="errorMessage">{{ $message }}</span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="address">Address</label>--}}
{{--                                <input type="text" class="form-control" id="address" name="address"--}}
{{--                                       placeholder="Enter your address" required value="{{old('address')}}">--}}
{{--                                @error('address')--}}
{{--                                <span class="errorMessage">{{ $message }}</span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}

{{--                            <div class="form-row">--}}
{{--                                <div class="form-group col-md-6">--}}
{{--                                    <label for="country">Country</label>--}}
{{--                                    <input type="text" class="form-control form-control-sm" id="country" name="country"--}}
{{--                                           required value="{{old('country')}}" placeholder="Company Country">--}}
{{--                                    @error('country')--}}
{{--                                    <span class="errorMessage">{{ $message }}</span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                                <div class="form-group col-md-6">--}}
{{--                                    <label for="state">State</label>--}}
{{--                                    <input type="text" name="state" id="state" class="form-control form-control-sm"--}}
{{--                                           required value="{{old('state')}}" placeholder="Company state">--}}
{{--                                    @error('state')--}}
{{--                                    <span class="errorMessage">{{ $message }}</span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-row">--}}
{{--                                <div class="form-group col-md-6">--}}
{{--                                    <label for="city">City</label>--}}
{{--                                    <input type="text" class="form-control form-control-sm" id="city" name="city"--}}
{{--                                           required value="{{old('city')}}" placeholder="Company City">--}}
{{--                                    @error('city')--}}
{{--                                    <span class="errorMessage">{{ $message }}</span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                                <div class="form-group col-md-6">--}}
{{--                                    <label for="zip">Zip Code</label>--}}
{{--                                    <input type="text" name="zip_code" id="zip_code"--}}
{{--                                           class="form-control form-control-sm" placeholder="Company Zip Code" required--}}
{{--                                           value="{{old('zip_code')}}">--}}
{{--                                    @error('zip_code')--}}
{{--                                    <span class="errorMessage">{{ $message }}</span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="paypal_id">PayPal ID</label>--}}
{{--                                <input type="text" class="form-control form-control-sm" name="paypal_id" id="paypal_id"--}}
{{--                                       placeholder="Company Paypal ID" required value="{{old('paypal_id')}}">--}}
{{--                                @error('paypal_id')--}}
{{--                                <span class="errorMessage">{{ $message }}</span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <button type="submit" class="btn btn-primary">Create Company</button>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="tab-pane @if(session('success') || session('error')) active @endif" id="manual_recovery"--}}
{{--                     role="tabpanel" aria-labelledby="manual-recovery">--}}
{{--                    <div class="container">--}}
{{--                        @if (session('success'))--}}
{{--                            <div class="alert alert-success alert-dismissible fade show" role="alert">--}}
{{--                                <strong> {{session('success')}}</strong>--}}
{{--                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                                    <span aria-hidden="true">&times;</span>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                            @php \Illuminate\Support\Facades\Session::forget('success'); @endphp--}}
{{--                        @endif--}}

{{--                        @if (session('error'))--}}
{{--                            <div class="alert alert-danger alert-dismissible fade show" role="alert">--}}
{{--                                <strong> {{session('error')}}</strong>--}}
{{--                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                                    <span aria-hidden="true">&times;</span>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                            @php \Illuminate\Support\Facades\Session::forget('error'); @endphp--}}
{{--                        @endif--}}
{{--                        <div class="container">--}}
{{--                            <form method="POST" id="payment-form"--}}
{{--                                  action="{!! URL::to('paypal') !!}">--}}
{{--                                @csrf--}}

{{--                                <div class="form-group">--}}
{{--                                    <div class="col-md-12">--}}
{{--                                        @if(count($companies) > 0)--}}
{{--                                            <label for="companies">Select Company to pay</label>--}}
{{--                                            <select name="company_id" class="custom-select mr-sm-2" id="companies">--}}
{{--                                                @foreach($companies as $company)--}}
{{--                                                    <option value="{{$company->id}}">{{$company->name}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        @else--}}
{{--                                            <strong class="errorMessage">Sorry, no companies registered--}}
{{--                                                yet.</strong>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="form-group">--}}
{{--                                    <div class="col-md-12">--}}
{{--                                        @if(count($categories) > 0)--}}
{{--                                            <label for="categories">Select Category to pay</label>--}}
{{--                                            <select name="category" class="custom-select mr-sm-2" id="categories">--}}
{{--                                                @foreach($categories as $category)--}}
{{--                                                    <option value="{{$category->name}}">{{$category->name}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        @else--}}
{{--                                            <strong class="errorMessage">Sorry, no categories found.</strong>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <div class="col-md-12">--}}
{{--                                        <p>--}}
{{--                                            <label class="text-primary" for="amount"><b>Enter Amount</b></label>--}}
{{--                                            <input class="form-control form-control-sm border" id="amount" name="amount"--}}
{{--                                                   type="text">--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <button class="btn btn-success">Pay with PayPal</button>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="tab-pane @if(!\Illuminate\Support\Facades\Session::has('success')) active @endif"--}}
{{--             id="send_money_to_cust" role="tabpanel"--}}
{{--             aria-labelledby="send-money-to-customer">--}}
        <div>
            @if (session('companyCreated'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong> {{session('companyCreated')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="container">
                <div class="form-row">
                    <h2>Register Company</h2>
                </div>
                <form method="POST" action="{{route('company.add')}}">
                    @csrf
                    <div class="form-row">
                        <div class=" col-md-4">
                            <label for="name">Company Name</label>
                            <input type="text" name="name" id="name" class="form-control form-control-sm"
                                   required value="{{old('name')}}" placeholder="Company Name">
                            @error('name')
                            <span class="errorMessage">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-4">
                            <label for="email">Email</label>
                            <input type="email" class="form-control form-control-sm" id="email" name="email"
                                   placeholder="Email" required value="{{old('email')}}">
                            @error('email')
                            <span class="errorMessage">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-4">
                            <label for="password">Password</label>
                            <input type="password" class="form-control form-control-sm" id="password"
                                   name="password" placeholder="Password" required>
                            @error('password')
                            <span class="errorMessage">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            @if(count($categories) > 0)
                                <label for="categories">Select Category</label>
                                <select name="category_id" class="custom-select mr-sm-2" id="categories">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            @else
                                <strong class="errorMessage">Sorry, no categories found.</strong>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                   placeholder="Enter your address" required value="{{old('address')}}">
                            @error('address')
                            <span class="errorMessage">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="paypal_id">PayPal ID</label>
                            <input type="text" class="form-control form-control-sm" name="paypal_id" id="paypal_id"
                                   placeholder="Company Paypal ID" required value="{{old('paypal_id')}}">
                            @error('paypal_id')
                            <span class="errorMessage">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                            <div class="col-md-4">
                                <label for="country">Country</label>
                                    <select id="country" name="country" value="{{old('country')}}" required>
                                        <option value="Afganistan">Afghanistan</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="American Samoa">American Samoa</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Anguilla">Anguilla</option>
                                        <option value="Antigua & Barbuda">Antigua & Barbuda</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Armenia">Armenia</option>
                                        <option value="Aruba">Aruba</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Austria">Austria</option>
                                        <option value="Azerbaijan">Azerbaijan</option>
                                        <option value="Bahamas">Bahamas</option>
                                        <option value="Bahrain">Bahrain</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Barbados">Barbados</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Belize">Belize</option>
                                        <option value="Benin">Benin</option>
                                        <option value="Bermuda">Bermuda</option>
                                        <option value="Bhutan">Bhutan</option>
                                        <option value="Bolivia">Bolivia</option>
                                        <option value="Bonaire">Bonaire</option>
                                        <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
                                        <option value="Botswana">Botswana</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                                        <option value="Brunei">Brunei</option>
                                        <option value="Bulgaria">Bulgaria</option>
                                        <option value="Burkina Faso">Burkina Faso</option>
                                        <option value="Burundi">Burundi</option>
                                        <option value="Cambodia">Cambodia</option>
                                        <option value="Cameroon">Cameroon</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Canary Islands">Canary Islands</option>
                                        <option value="Cape Verde">Cape Verde</option>
                                        <option value="Cayman Islands">Cayman Islands</option>
                                        <option value="Central African Republic">Central African Republic</option>
                                        <option value="Chad">Chad</option>
                                        <option value="Channel Islands">Channel Islands</option>
                                        <option value="Chile">Chile</option>
                                        <option value="China">China</option>
                                        <option value="Christmas Island">Christmas Island</option>
                                        <option value="Cocos Island">Cocos Island</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="Comoros">Comoros</option>
                                        <option value="Congo">Congo</option>
                                        <option value="Cook Islands">Cook Islands</option>
                                        <option value="Costa Rica">Costa Rica</option>
                                        <option value="Cote DIvoire">Cote DIvoire</option>
                                        <option value="Croatia">Croatia</option>
                                        <option value="Cuba">Cuba</option>
                                        <option value="Curaco">Curacao</option>
                                        <option value="Cyprus">Cyprus</option>
                                        <option value="Czech Republic">Czech Republic</option>
                                        <option value="Denmark">Denmark</option>
                                        <option value="Djibouti">Djibouti</option>
                                        <option value="Dominica">Dominica</option>
                                        <option value="Dominican Republic">Dominican Republic</option>
                                        <option value="East Timor">East Timor</option>
                                        <option value="Ecuador">Ecuador</option>
                                        <option value="Egypt">Egypt</option>
                                        <option value="El Salvador">El Salvador</option>
                                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                                        <option value="Eritrea">Eritrea</option>
                                        <option value="Estonia">Estonia</option>
                                        <option value="Ethiopia">Ethiopia</option>
                                        <option value="Falkland Islands">Falkland Islands</option>
                                        <option value="Faroe Islands">Faroe Islands</option>
                                        <option value="Fiji">Fiji</option>
                                        <option value="Finland">Finland</option>
                                        <option value="France">France</option>
                                        <option value="French Guiana">French Guiana</option>
                                        <option value="French Polynesia">French Polynesia</option>
                                        <option value="French Southern Ter">French Southern Ter</option>
                                        <option value="Gabon">Gabon</option>
                                        <option value="Gambia">Gambia</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Germany">Germany</option>
                                        <option value="Ghana">Ghana</option>
                                        <option value="Gibraltar">Gibraltar</option>
                                        <option value="Great Britain">Great Britain</option>
                                        <option value="Greece">Greece</option>
                                        <option value="Greenland">Greenland</option>
                                        <option value="Grenada">Grenada</option>
                                        <option value="Guadeloupe">Guadeloupe</option>
                                        <option value="Guam">Guam</option>
                                        <option value="Guatemala">Guatemala</option>
                                        <option value="Guinea">Guinea</option>
                                        <option value="Guyana">Guyana</option>
                                        <option value="Haiti">Haiti</option>
                                        <option value="Hawaii">Hawaii</option>
                                        <option value="Honduras">Honduras</option>
                                        <option value="Hong Kong">Hong Kong</option>
                                        <option value="Hungary">Hungary</option>
                                        <option value="Iceland">Iceland</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="India">India</option>
                                        <option value="Iran">Iran</option>
                                        <option value="Iraq">Iraq</option>
                                        <option value="Ireland">Ireland</option>
                                        <option value="Isle of Man">Isle of Man</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Jamaica">Jamaica</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Jordan">Jordan</option>
                                        <option value="Kazakhstan">Kazakhstan</option>
                                        <option value="Kenya">Kenya</option>
                                        <option value="Kiribati">Kiribati</option>
                                        <option value="Korea North">Korea North</option>
                                        <option value="Korea Sout">Korea South</option>
                                        <option value="Kuwait">Kuwait</option>
                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                        <option value="Laos">Laos</option>
                                        <option value="Latvia">Latvia</option>
                                        <option value="Lebanon">Lebanon</option>
                                        <option value="Lesotho">Lesotho</option>
                                        <option value="Liberia">Liberia</option>
                                        <option value="Libya">Libya</option>
                                        <option value="Liechtenstein">Liechtenstein</option>
                                        <option value="Lithuania">Lithuania</option>
                                        <option value="Luxembourg">Luxembourg</option>
                                        <option value="Macau">Macau</option>
                                        <option value="Macedonia">Macedonia</option>
                                        <option value="Madagascar">Madagascar</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Malawi">Malawi</option>
                                        <option value="Maldives">Maldives</option>
                                        <option value="Mali">Mali</option>
                                        <option value="Malta">Malta</option>
                                        <option value="Marshall Islands">Marshall Islands</option>
                                        <option value="Martinique">Martinique</option>
                                        <option value="Mauritania">Mauritania</option>
                                        <option value="Mauritius">Mauritius</option>
                                        <option value="Mayotte">Mayotte</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Midway Islands">Midway Islands</option>
                                        <option value="Moldova">Moldova</option>
                                        <option value="Monaco">Monaco</option>
                                        <option value="Mongolia">Mongolia</option>
                                        <option value="Montserrat">Montserrat</option>
                                        <option value="Morocco">Morocco</option>
                                        <option value="Mozambique">Mozambique</option>
                                        <option value="Myanmar">Myanmar</option>
                                        <option value="Nambia">Nambia</option>
                                        <option value="Nauru">Nauru</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="Netherland Antilles">Netherland Antilles</option>
                                        <option value="Netherlands">Netherlands (Holland, Europe)</option>
                                        <option value="Nevis">Nevis</option>
                                        <option value="New Caledonia">New Caledonia</option>
                                        <option value="New Zealand">New Zealand</option>
                                        <option value="Nicaragua">Nicaragua</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Nigeria">Nigeria</option>
                                        <option value="Niue">Niue</option>
                                        <option value="Norfolk Island">Norfolk Island</option>
                                        <option value="Norway">Norway</option>
                                        <option value="Oman">Oman</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Palau Island">Palau Island</option>
                                        <option value="Palestine">Palestine</option>
                                        <option value="Panama">Panama</option>
                                        <option value="Papua New Guinea">Papua New Guinea</option>
                                        <option value="Paraguay">Paraguay</option>
                                        <option value="Peru">Peru</option>
                                        <option value="Phillipines">Philippines</option>
                                        <option value="Pitcairn Island">Pitcairn Island</option>
                                        <option value="Poland">Poland</option>
                                        <option value="Portugal">Portugal</option>
                                        <option value="Puerto Rico">Puerto Rico</option>
                                        <option value="Qatar">Qatar</option>
                                        <option value="Republic of Montenegro">Republic of Montenegro</option>
                                        <option value="Republic of Serbia">Republic of Serbia</option>
                                        <option value="Reunion">Reunion</option>
                                        <option value="Romania">Romania</option>
                                        <option value="Russia">Russia</option>
                                        <option value="Rwanda">Rwanda</option>
                                        <option value="St Barthelemy">St Barthelemy</option>
                                        <option value="St Eustatius">St Eustatius</option>
                                        <option value="St Helena">St Helena</option>
                                        <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                                        <option value="St Lucia">St Lucia</option>
                                        <option value="St Maarten">St Maarten</option>
                                        <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
                                        <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
                                        <option value="Saipan">Saipan</option>
                                        <option value="Samoa">Samoa</option>
                                        <option value="Samoa American">Samoa American</option>
                                        <option value="San Marino">San Marino</option>
                                        <option value="Sao Tome & Principe">Sao Tome & Principe</option>
                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                        <option value="Senegal">Senegal</option>
                                        <option value="Seychelles">Seychelles</option>
                                        <option value="Sierra Leone">Sierra Leone</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Slovakia">Slovakia</option>
                                        <option value="Slovenia">Slovenia</option>
                                        <option value="Solomon Islands">Solomon Islands</option>
                                        <option value="Somalia">Somalia</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="Spain">Spain</option>
                                        <option value="Sri Lanka">Sri Lanka</option>
                                        <option value="Sudan">Sudan</option>
                                        <option value="Suriname">Suriname</option>
                                        <option value="Swaziland">Swaziland</option>
                                        <option value="Sweden">Sweden</option>
                                        <option value="Switzerland">Switzerland</option>
                                        <option value="Syria">Syria</option>
                                        <option value="Tahiti">Tahiti</option>
                                        <option value="Taiwan">Taiwan</option>
                                        <option value="Tajikistan">Tajikistan</option>
                                        <option value="Tanzania">Tanzania</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Togo">Togo</option>
                                        <option value="Tokelau">Tokelau</option>
                                        <option value="Tonga">Tonga</option>
                                        <option value="Trinidad & Tobago">Trinidad & Tobago</option>
                                        <option value="Tunisia">Tunisia</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Turkmenistan">Turkmenistan</option>
                                        <option value="Turks & Caicos Is">Turks & Caicos Is</option>
                                        <option value="Tuvalu">Tuvalu</option>
                                        <option value="Uganda">Uganda</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Erimates">United Arab Emirates</option>
                                        <option value="United States of America">United States of America</option>
                                        <option value="Uraguay">Uruguay</option>
                                        <option value="Uzbekistan">Uzbekistan</option>
                                        <option value="Vanuatu">Vanuatu</option>
                                        <option value="Vatican City State">Vatican City State</option>
                                        <option value="Venezuela">Venezuela</option>
                                        <option value="Vietnam">Vietnam</option>
                                        <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                                        <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                                        <option value="Wake Island">Wake Island</option>
                                        <option value="Wallis & Futana Is">Wallis & Futana Is</option>
                                        <option value="Yemen">Yemen</option>
                                        <option value="Zaire">Zaire</option>
                                        <option value="Zambia">Zambia</option>
                                        <option value="Zimbabwe">Zimbabwe</option>
                                    </select>
                                    @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="state">State</label>
                                <input type="text" name="state" id="state" class="form-control form-control-sm"
                                       required value="{{old('state')}}" placeholder="Company state">
                                @error('state')
                                <span class="errorMessage">{{ $message }}</span>
                                @enderror
                            </div>
                        <div class="col-md-2">
                            <label for="zip">Zip Code</label>
                            <input type="text" name="zip_code" id="zip_code"
                                   class="form-control form-control-sm" placeholder="Company Zip Code" required
                                   value="{{old('zip_code')}}">
                            @error('zip_code')
                            <span class="errorMessage">{{ $message }}</span>
                            @enderror
                        </div>
                            <div class="col-md-4">
                                <label for="city">City</label>
                                <input type="text" class="form-control form-control-sm" id="city" name="city"
                                       required value="{{old('city')}}" placeholder="Company City">
                                @error('city')
                                <span class="errorMessage">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    <div class="form-row">
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-sm">Register Company</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
