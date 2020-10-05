@extends('layouts.app')

<script>
    var App_url = '{!! url()->current() !!}';
</script>
{{--  Inject vue js files  --}}
@push('script')
    <script src="{{ asset('js/app-vue.js') }}" ></script>
    <script src="{{ asset('js/admin/roles/vue.js') }}" ></script>
@endpush

@section('content')
<div class="container col-auto pt-3 p-0  bg-white border-0" id="roles_container">
    <div class="container-fluid mt-4" >
        {{--  Main Content  --}}
        <div class="card rounded-0 shadow-none mt-5">
            <div class="card-header small rgba-deep-purple-strong shadow-lg text-white">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <h5><i class="fas fa-user-graduate mr-1"></i> Roles</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0 shadow-lg rounded mb-4">
                <b-table white responsive hover small head-variant="dark" :items="roles" :busy="isBusy" :fields="fields" show-empty @filtered="Filtered">
                    <template slot="thead-top" slot-scope="data">
                        <tr>
                            <td colspan="12">
                                <div class="p-0 m-0 pt-2 pb-2 row justify-content-between col-12">
{{--                                    @can('roles-create')--}}
                                        <div class="col-2 float-left mt-2">
                                            <button @click="showAddModal" title="New Role" class="btn btn-outline-dark btn-sm mt-0" >
                                                <span class="fa fa-plus"></span> New Role
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
                                    <div class="col-4 float-right">
                                        <div class="input-group mt-2 pb-0 pr-2 input-group-sm shadow-none">
                                            <span v-if="rolesTable.searching"  class="fa-li fa fa-spinner fa-spin mt-1" ></span>
                                            <input type="search" class="form-control shadow-sm rounded" v-on:keyup.prevent="applyRolesFilter(false)" v-model="rolesTable.searchQuery" placeholder="Search by ID or Name" aria-label="Search" autocomplete="off">
                                        </div>
                                    </div>
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
                    <template v-slot:cell(permissions)="rolepermissions">
                      <span class="badge badge-primary mr-1" v-for="permissionName in rolepermissions.item.permissions">
                        @{{permissionName.name}}
                      </span>
                    </template>
                    <template v-slot:cell(Actions)="actionRow">
{{--                        @can('roles-edit')--}}
                            <b-button size="sm" title="Edit Permissions" variant="btn btn-dark mt-0 btn-sm p-1 px-2" @click="editRole(actionRow.item.id)">
                                <i class="fas fa-cogs"></i>
                            </b-button>
{{--                        @endcan--}}
                        {{--
                        <b-button size="sm" variant="btn btn-dark btn-sm p-1 px-2" @click="deleteRole(actionRow.item.id)">  --}}
                        {{--  <i class="fas fa-trash"></i>  --}}
                        {{--
                     </b-button>
                     --}}
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
                        <p class="mb-0 p-1 small mt-1 float-left">Showing @{{ rolesMeta.from }} to @{{ rolesMeta.to }} of @{{ rolesMeta.total }} records | Per Page: @{{ rolesMeta.per_page }} | Current Page: @{{ rolesMeta.current_page }}</p>
                    </div>
                    <div class="col float-right">
                        <b-pagination class="float-right" size="sm" :total-rows="rolesMeta.total" v-model="rolesMeta.current_page" :per-page="rolesMeta.per_page" first-text="First" prev-text="Pervious" next-text="Next" last-text="Last" ellipsis-text="More" variant="danger">
                        </b-pagination>
                    </div>
                </div>
                {{-- End Row --}}
            </div>
        </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="addRoleModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" role="alert" v-if="roleError">
                            <b>@{{roleError}}</b>
                        </div>
                        <div class="alert alert-success" role="alert" v-if="roleSuccessMessage">
                            <b>@{{roleSuccessMessage}}</b>
                        </div>
                        <input type="text" class="form-control" placeholder="Role Name" v-model="roleName">
                        <hr>
                        <div v-if="permissions.length" style="height: 350px; overflow-y: auto;">
                            <label>Give Permissions:</label>
                            <div class="custom-control custom-checkbox" v-for="permission in permissions">
                                <input type="checkbox" class="custom-control-input" :id="`${'give_permission_'+permission.id}`" :value="permission.id" v-model="checkedPermissions">
                                <label :for="`${'give_permission_'+permission.id}`" class="custom-control-label"><b>@{{permission.name}}</b></label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm" @click="saveRole">Create</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="editRoleModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" role="alert" v-if="roleError">
                            <b>@{{roleError}}</b>
                        </div>
                        <div class="alert alert-success" role="alert" v-if="roleSuccessMessage">
                            <b>@{{roleSuccessMessage}}</b>
                        </div>
                        <input type="text" class="form-control" placeholder="Role Name" v-model="editRoleName">
                        <div v-for="(value, name, index) in roleErrors" style="color: red">
                            <label v-if="name == 'roleName'">@{{value[0]}}</label>
                        </div>
                        <hr>
                        <div v-if="permissions.length" style="height: 350px; overflow-y: auto;">
                            <label>Edit Permissions:</label>
                            <div class="custom-control custom-checkbox" v-for="permission in editAlreadySelectedPermissions">
                                <input type="checkbox" class="custom-control-input" :id="`${'edit_permission_'+permission.id}`" :value="permission.id" v-model="permission.checked">
                                <label :for="`${'edit_permission_'+permission.id}`" class="custom-control-label"><b>@{{permission.name}}</b></label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm" @click="updateRole">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Load Footer   --}}
    @include('layouts.footer')
</div>
@endsection
