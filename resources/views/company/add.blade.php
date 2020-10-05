@extends('layouts.frontend')


@section('style')
    <style>
        .errorMessage {
            color: #ff0000;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="card-body p-0 shadow-lg rounded mb-4 mt-1">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs shadow-sm" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link font-weight-bold nav-link-custom @if(!\Illuminate\Support\Facades\Session::has('success')) active @endif" id="home-tab" data-toggle="tab"
                       href="#send_money_to_cust" role="tab" aria-controls="home" aria-selected="true">
                        <i class="fa fa-building"></i> Register Company
                    </a>
                </li>
                <li class="nav-item font-weight-bold @if(session('success') || session('error')) active @endif">
                    <a class="nav-link nav-link-custom" id="settings-tab" data-toggle="tab" href="#manual_recovery"
                       role="tab" aria-controls="settings" aria-selected="false">
                        <i class="fa fa-money-bill-wave"></i> Send Payment
                    </a>
                </li>
            </ul>

            <div class="tab-content py-3">
                <div class="tab-pane @if(!\Illuminate\Support\Facades\Session::has('success')) active @endif"
                     id="send_money_to_cust" role="tabpanel"
                     aria-labelledby="send-money-to-customer">
                    @if (session('companyCreated'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong> {{session('companyCreated')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="row justify-content-md-center">
                        <form method="POST" action="{{route('company.add')}}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="name">Company Name</label>
                                    <input type="text" name="name" id="name" class="form-control form-control-sm"
                                           required value="{{old('name')}}" placeholder="Company Name">
                                    @error('name')
                                    <span class="errorMessage">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control form-control-sm" id="email" name="email"
                                           placeholder="Email" required value="{{old('email')}}">
                                    @error('email')
                                    <span class="errorMessage">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control form-control-sm" id="password"
                                           name="password" placeholder="Password" required>
                                    @error('password')
                                    <span class="errorMessage">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                       placeholder="Enter your address" required value="{{old('address')}}">
                                @error('address')
                                <span class="errorMessage">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control form-control-sm" id="country" name="country"
                                           required value="{{old('country')}}" placeholder="Company Country">
                                    @error('country')
                                    <span class="errorMessage">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="state">State</label>
                                    <input type="text" name="state" id="state" class="form-control form-control-sm"
                                           required value="{{old('state')}}" placeholder="Company state">
                                    @error('state')
                                    <span class="errorMessage">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control form-control-sm" id="city" name="city"
                                           required value="{{old('city')}}" placeholder="Company City">
                                    @error('city')
                                    <span class="errorMessage">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="zip">Zip Code</label>
                                    <input type="text" name="zip_code" id="zip_code"
                                           class="form-control form-control-sm" placeholder="Company Zip Code" required
                                           value="{{old('zip_code')}}">
                                    @error('zip_code')
                                    <span class="errorMessage">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="paypal_id">PayPal ID</label>
                                <input type="text" class="form-control form-control-sm" name="paypal_id" id="paypal_id"
                                       placeholder="Company Paypal ID" required value="{{old('paypal_id')}}">
                                @error('paypal_id')
                                <span class="errorMessage">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Create Company</button>
                        </form>
                    </div>
                </div>
                <div class="tab-pane @if(session('success') || session('error')) active @endif" id="manual_recovery"
                     role="tabpanel" aria-labelledby="manual-recovery">
                    <div class="container">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong> {{session('success')}}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @php \Illuminate\Support\Facades\Session::forget('success'); @endphp
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong> {{session('error')}}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @php \Illuminate\Support\Facades\Session::forget('error'); @endphp
                        @endif
                        <div class="container">
                            <form method="POST" id="payment-form"
                                  action="{!! URL::to('paypal') !!}">
                                @csrf

                                <div class="form-group">
                                    <div class="col-md-12">
                                        @if(count($companies) > 0)
                                            <label for="companies">Select Company to pay</label>
                                            <select name="company_id" class="custom-select mr-sm-2" id="companies">
                                                @foreach($companies as $company)
                                                    <option value="{{$company->id}}">{{$company->name}}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <strong class="errorMessage">Sorry, no companies registered
                                                yet.</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        @if(count($categories) > 0)
                                            <label for="categories">Select Category to pay</label>
                                            <select name="category" class="custom-select mr-sm-2" id="categories">
                                                @foreach($categories as $category)
                                                    <option value="{{$category->name}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <strong class="errorMessage">Sorry, no categories found.</strong>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <p>
                                            <label class="text-primary" for="amount"><b>Enter Amount</b></label>
                                            <input class="form-control form-control-sm border" id="amount" name="amount"
                                                   type="text">
                                        </p>
                                    </div>
                                </div>

                                <button class="btn btn-success">Pay with PayPal</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
