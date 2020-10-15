@extends('layouts.app')

<script>
    var App_url = '{!! url()->current() !!}';
</script>
{{--  Inject vue js files  --}}
@push('script')
    <script src="{{ asset('js/app-vue.js') }}" ></script>
    <script src="{{ asset('js/admin/dashboard/vue.js') }}" ></script>
@endpush


@section('content')
    <div id="dashboard_container">
        <div class="row">
            <div class="col-md-6">
                <canvas id="transactions" width="200" height="200"></canvas>
            </div>
            <div class="col-md-6" >
                <canvas id="companies" width="200" height="200"></canvas>
            </div>
        </div>
    </div>
@endsection
