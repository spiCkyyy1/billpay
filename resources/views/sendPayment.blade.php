@extends('layouts.frontend')

@section('content')
{{--<div class="tab-pane @if(session('success') || session('error')) active @endif" id="manual_recovery"--}}
{{--     role="tabpanel" aria-labelledby="manual-recovery">--}}
    <div class="container-fluid">
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
        <div>
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
                            <strong style="color: red">Sorry, no companies registered
                                yet.</strong>
                        @endif
                    </div>
                </div>

{{--                <div class="form-group">--}}
{{--                    <div class="col-md-12">--}}
{{--                        @if(count($categories) > 0)--}}
{{--                            <label for="categories">Select Category to pay</label>--}}
{{--                            <select name="category" class="custom-select mr-sm-2" id="categories">--}}
{{--                                @foreach($categories as $category)--}}
{{--                                    <option value="{{$category->name}}">{{$category->name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        @else--}}
{{--                            <strong class="errorMessage">Sorry, no categories found.</strong>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}
                @if(count($companies) > 0)
                <div class="form-group">
                    <div class="col-md-12">
                        <p>
                            <label class="text-primary" for="amount"><b>Enter Amount</b></label>
                            <input class="form-control form-control-sm border" id="amount" name="amount"
                                   type="text">
                        </p>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <button class="btn btn-success">Pay with PayPal</button>
                    </div>
                </div>
                @endif
            </form>
        </div>
    </div>
{{--</div>--}}
@endsection
