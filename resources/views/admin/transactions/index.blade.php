@extends('layouts.app')

<script>
    var App_url = '{!! url()->current() !!}';
</script>
{{--  Inject vue js files  --}}
@push('script')
    <script src="{{ asset('js/app-vue.js') }}" ></script>
    <script src="{{ asset('js/admin/transactions/vue.js') }}" ></script>
@endpush

@section('content')
    {{--  Main layout  --}}
    <div class="container col-auto pt-3 p-0  bg-white border-0" id="transactions_container">
        <div class="container-fluid mt-4">
            {{--  Main Content  --}}
            <div class="card rounded-0 shadow-none mt-5">
                <div class="card-header small rgba-deep-purple-strong shadow-lg">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <h5><i class="fas fa-money-check mr-1"></i> Transactions</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0 shadow-lg rounded mb-4">
                    <div>
                        <b-table white responsive hover small head-variant="dark" :items="transactions" :busy="isBusy" :fields="fields" show-empty @filtered="transactionsFiltered">
                            <template slot="thead-top" slot-scope="data">
                                <tr>
                                    <td colspan="12">
                                        <div class="p-0 m-0 pt-2 pb-2 row justify-content-between col-12">
                                            <div class="col-4 text-center mt-2">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="orderbyasc" name="customRadioInline1"
                                                           class="custom-control-input" value="ASC" v-model="orderBy" @click="getOrderByResult('ASC')">
                                                    <label class="custom-control-label" for="orderbyasc">ASC
                                                    </label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="orderbydesc" name="customRadioInline1" class="custom-control-input" value="DESC" v-model="orderBy" @click="getOrderByResult('DESC')">
                                                    <label class="custom-control-label" for="orderbydesc">DESC
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <button type="button" class="btn btn-dark btn-sm mt-0 px-3 mx-2" title="Reset Filter" @click="resetFilter()"><span class="fa fa-undo"></span></button>
                                            </div>
                                            <div class="col-4 float-right mt-2">
                                                <span class="fa-li fa fa-spinner fa-spin mt-2" v-if="processing"></span>
                                                <input @keyup="applyFilter(false)" v-model="transactionTable.searchQuery" type="text" class="form-control form-control-sm" placeholder="Search by Payer Name">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                            <template v-slot:cellHEAD_name()="data">
                                <span class="m-0 pl-2">@{{data.label}}</span>
                            </template>
                            <template v-slot:cellFOOT_name()="data">
                                <span class="m-0 pl-2">@{{data.label}}</span>
                            </template>
                            <template v-slot:cell(name)="data">
                                <span class="m-0 pl-2">@{{data.item.name}}</span>
                            </template>


                            <div slot="table-busy" class="text-center text-danger my-2">
                                <b-spinner class="align-middle"></b-spinner>
                                <strong>Loading...</strong>
                            </div>
                            <template slot="emptyfiltered" slot-scope="scope">
                                <h4>@{{ scope.emptyFilteredText }}</h4>
                            </template>
                        </b-table>
                        {{-- Row --}}
                        <div class="row px-3">
                            <div class="col">
                                <p class="mb-0 p-1 small mt-1">Showing @{{ transactionsMeta.from }} to @{{ transactionsMeta.to }} of @{{ transactionsMeta.total }} records | Per Page: @{{ transactionsMeta.per_page }} | Current Page: @{{ transactionsMeta.current_page }}</p>
                            </div>
                            <div class="col float-right">
                                <b-pagination class="float-right" size="sm" :total-rows="transactionsMeta.total" v-model="transactionsMeta.current_page" :per-page="transactionsMeta.per_page" first-text="First" prev-text="Pervious" next-text="Next" last-text="Last" ellipsis-text="More" variant="danger">
                                </b-pagination>
                            </div>
                        </div>
                        {{-- End Row --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- Load Footer   --}}
        @include('layouts.footer')
    </div>
@endsection
