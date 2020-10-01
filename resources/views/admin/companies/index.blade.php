@extends('layouts.app')

<script>
    var App_url = '{!! url()->current() !!}';
</script>
{{--  Inject vue js files  --}}
@push('script')
    <script src="{{ asset('js/app-vue.js') }}" ></script>
    <script src="{{ asset('js/admin/companies/vue.js') }}" ></script>
@endpush

@section('content')
    {{--  Main layout  --}}
    <div class="container col-auto pt-3 p-0  bg-white border-0" id="companies_container">
        <div class="container-fluid mt-4">
            {{--  Main Content  --}}
            <div class="card rounded-0 shadow-none mt-5">
                <div class="card-header small rgba-deep-purple-strong shadow-lg">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <h5><i class="fas fa-building mr-1"></i> Companies</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0 shadow-lg rounded mb-4">
                    <div>
                        <b-table white responsive hover small head-variant="dark" :items="companies" :busy="isBusy" :fields="fields" show-empty @filtered="companiesFiltered">
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
                                            <div class="col-4 float-right mt-2">
                                                <span class="fa-li fa fa-spinner fa-spin mt-2" v-if="processing"></span>
                                                <input @keyup="applyCompaniesFilter(false)" v-model="companiesTable.searchQuery" type="text" class="form-control form-control-sm" placeholder="Search by Name or Email">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                            <template slot="HEAD_name" slot-scope="data">
                                <span class="m-0 pl-2">@{{data.label}}</span>
                            </template>
                            <template slot="FOOT_name" slot-scope="data">
                                <span class="m-0 pl-2">@{{data.label}}</span>
                            </template>
                            <template slot="name" slot-scope="data">
                                <span class="m-0 pl-2">@{{data.item.name}}</span>
                            </template>

                            <template v-slot:cell(status)="data">
                                <span class="m-0 pl-2 badge badge-success" v-if="data.item.status == '1'">Approved</span>
                                <span class="m-0 pl-2 badge badge-danger" v-else>Not Approved</span>
                            </template>


                            <template v-slot:cell(Actions)="row">
                                <b-button size="sm" title="Approve Company" variant="btn btn-dark btn-sm p-1 px-2 mt-0" @click="approveCompany(row.item.id)">
                                    <i class="fas fa-check" style="color: #008000"></i>
                                </b-button>
                                <b-button size="sm" title="Disapprove Company" variant="btn btn-dark btn-sm p-1 px-2 mt-0" @click="disapproveCompany(row.item.id)">
                                    <i class="fas fa-times" style="color: #ff0000"></i>
                                </b-button>
                                <b-button size="sm" title="Delete Company" variant="btn btn-dark btn-sm p-1 px-2 mt-0" @click="deleteCompany(row.item.id)">
                                    <i class="fas fa-trash"></i>
                                </b-button>
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
                                <p class="mb-0 p-1 small mt-1">Showing @{{ companiesMeta.from }} to @{{ companiesMeta.to }} of @{{ companiesMeta.total }} records | Per Page: @{{ companiesMeta.per_page }} | Current Page: @{{ companiesMeta.current_page }}</p>
                            </div>
                            <div class="col float-right">
                                <b-pagination class="float-right" size="sm" :total-rows="companiesMeta.total" v-model="companiesMeta.current_page" :per-page="companiesMeta.per_page" first-text="First" prev-text="Pervious" next-text="Next" last-text="Last" ellipsis-text="More" variant="danger">
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
