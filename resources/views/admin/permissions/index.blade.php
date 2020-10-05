@extends('layouts.app')

<script>
    var App_url = '{!! url()->current() !!}';
</script>
{{--  Inject vue js files  --}}
@push('script')
    <script src="{{ asset('js/app-vue.js') }}" ></script>
    <script src="{{ asset('js/admin/permissions/vue.js') }}" ></script>
@endpush

@section('content')
{{--  Main layout  --}}
<div class="container col-auto pt-3 p-0  bg-white border-0" id="permissions_container">
    <div  class="container-fluid mt-4">
        {{--  Main Content  --}}
        <div class="card rounded-0 shadow-none mt-5">
            <div class="card-header small rgba-deep-purple-strong shadow-lg text-white">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <h5><i class="fas fa-user-cog mr-1"></i> Permissions</h5>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card-body p-0 shadow-lg rounded mb-4">
                <b-table white responsive hover small head-variant="dark" :items="permissions" :busy="isBusy" :fields="fields" show-empty @filtered="Filtered">
                    <template slot="thead-top" slot-scope="data">
                        <tr>
                            <td colspan="12">
                                <div class="p-0 m-0 pt-2 pb-2 row justify-content-between col-12">
{{--                                    @can('permissions-create')--}}
                                        <div class="col-2 float-left mt-2">
                                            <button @click="showAddModal" title="New Permission" class="btn btn-outline-dark btn-sm mt-0" >
                                                <span class="fa fa-plus"></span> New Permission
                                            </button>
                                        </div>
{{--                                    @endcan--}}

                                    <div class="col-2 text-center mt-3">
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


{{--                                    @can('permissions-search')--}}
                                        <div class="col-4 float-right">
                                            <div class="input-group mt-2 pb-0 pr-2 input-group-sm shadow-none">
                                                <span v-if="permissionTable.searching"  class="fa-li fa fa-spinner fa-spin mt-1" ></span>
                                                <input type="search" v-on:keyup.prevent="applyPermissionFilter(false)" class="form-control shadow-sm rounded" v-model="permissionTable.searchQuery" placeholder="Search By Name" aria-label="Search" autocomplete="off">
                                            </div>
                                        </div>
{{--                                    @endcan--}}
                                </div>
                            </td>
                        </tr>
                    </template>
                    <template v-slot:cell(HEAD_name)="data">
                        <span class="m-0 pl-2">@{{data.label}}</span>
                    </template>

                    <template v-slot:cell(FOOT_name)="data">
                        <span class="m-0 pl-2">@{{data.label}}</span>
                    </template>

                    <template v-slot:cell(name)="data" >
                        <span class="m-0 pl-2">@{{data.item.name}}</span>
                    </template>

                    <template v-slot:cell(Actions)="row">
{{--                        @can('permissions-edit')--}}
                            <b-button size="sm" variant="btn btn-dark btn-sm p-1 px-2" @click="editPermission(row.item.id)">
                                <i class="fas fa-cogs"></i>
                            </b-button>
{{--                        @endcan--}}
{{--                          <b-button size="sm" variant="btn btn-dark btn-sm p-1 px-2" @click="deletePermission(row.item.id)">--}}
{{--                          <i class="fas fa-trash"></i>--}}
{{--                          </b-button>--}}
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
                <div class="row px-3 m-auto">
                    <div class="col float-left">
                        <p class="mb-0 p-1 small mt-1 float-left">Showing @{{ permissionMeta.from }} to @{{ permissionMeta.to }} of @{{ permissionMeta.total }} records | Per Page: @{{ permissionMeta.per_page }} | Current Page: @{{ permissionMeta.current_page }}</p>
                    </div>
                    <div class="col float-right">
                        <b-pagination class="float-right" size="sm" :total-rows="permissionMeta.total" v-model="permissionMeta.current_page" :per-page="permissionMeta.per_page" first-text="First" prev-text="Pervious" next-text="Next" last-text="Last" ellipsis-text="More" variant="danger">
                        </b-pagination>
                    </div>
                </div>{{-- End Row --}}
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="addPermissionsModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Permission</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" placeholder="Permission Name" v-model="permissionName">
                        <div v-for="(value, name, index) in permissionErrors" style="color: red">
                            <label v-if="name == 'permissionName'">@{{value[0]}}</label>
                        </div>
                        <div class="form-group row mb-4" v-if="permissionSuccess != null">
                            <div class="col">
                                <p style="color: green">@{{permissionSuccess}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm" @click="savePermission">Create</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="EditPermissionsModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Permission</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" placeholder="Permission Name" v-model="editPermissionName">
                        <div v-for="(value, name, index) in permissionErrors" style="color: red">
                            <label v-if="name == 'permissionName'">@{{value[0]}}</label>
                        </div>
                        <div class="form-group row mb-4" v-if="permissionSuccess != null">
                            <div class="col">
                                <p style="color: green">@{{permissionSuccess}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm" @click="updatePermission">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Load Footer   --}}
    @include('layouts.footer')
</div>

@endsection
