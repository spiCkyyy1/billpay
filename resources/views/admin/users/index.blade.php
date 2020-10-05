@extends('layouts.app')

<script>
    var App_url = '{!! url()->current() !!}';
    var allRoles_url = '{{ route('roles.all')}}';
</script>
{{--  Inject vue js files  --}}
@push('script')
    <script src="{{ asset('js/app-vue.js') }}" ></script>
    <script src="{{ asset('js/admin/users/vue.js') }}" ></script>
@endpush

@section('content')
{{--  Main layout  --}}
<div class="container col-auto pt-3 p-0  bg-white border-0" id="users_container">
    <div class="container-fluid mt-4">
        {{--  Main Content  --}}
        <div class="card rounded-0 shadow-none mt-5">
            <div class="card-header small rgba-deep-purple-strong shadow-lg">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <h5><i class="fas fa-users mr-1"></i> Users</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0 shadow-lg rounded mb-4">
                <div>
                    <b-table white responsive hover small head-variant="dark" :items="users" :busy="isBusy" :fields="fields" show-empty @filtered="userFiltered">
                        <template slot="thead-top" slot-scope="data">
                            <tr>
                                <td colspan="12">
                                    <div class="p-0 m-0 pt-2 pb-2 row justify-content-between col-12">
                                        <div class="col-2 float-left mt-2">
{{--                                            @can('users-create')--}}
                                                <button @click="showAddModal" title="New User" class="btn btn-outline-dark btn-sm mt-0" >
                                                    <span class="fa fa-plus"></span> New User
                                                </button>
{{--                                            @endcan--}}
                                            <button type="button" class="btn btn-dark btn-sm mt-0 px-3 mx-2" title="Reset Filter" @click="resetFilter()"><span class="fa fa-undo"></span></button>
                                        </div>
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
                                            <input @keyup="applyUserFilter(false)" v-model="usersTable.searchQuery" type="text" class="form-control form-control-sm" placeholder="Search by name or email">
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
                        <template v-slot:cell(Roles)="userroles">
                             <span class="badge badge-primary mr-1" v-for="role in userroles.item.roles">
                                @{{role.name}}
                             </span>
                        </template>
                        <template v-slot:cell(Actions)="row">
{{--                            @can('users-edit')--}}
                                <b-button size="sm" title="User Details" variant="btn btn-dark btn-sm p-1 px-2 mt-0" @click="editUser(row.item.id)">
                                    <i class="fas fa-cogs"></i>
                                </b-button>
{{--                            @endcan--}}
{{--                            @can('users-delete')--}}
                                <b-button size="sm" title="Delete" variant="btn btn-dark btn-sm p-1 px-2 mt-0" @click="deleteUser(row.item.id)">
                                    <i class="fas fa-trash"></i>
                                </b-button>
{{--                            @endcan--}}
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
                            <p class="mb-0 p-1 small mt-1">Showing @{{ userMeta.from }} to @{{ userMeta.to }} of @{{ userMeta.total }} records | Per Page: @{{ userMeta.per_page }} | Current Page: @{{ userMeta.current_page }}</p>
                        </div>
                        <div class="col float-right">
                            <b-pagination class="float-right" size="sm" :total-rows="userMeta.total" v-model="userMeta.current_page" :per-page="userMeta.per_page" first-text="First" prev-text="Pervious" next-text="Next" last-text="Last" ellipsis-text="More" variant="danger">
                            </b-pagination>
                        </div>
                    </div>
                    {{-- End Row --}}
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" id="addUserModal" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="my-modal-title">Add New User</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" id="defaultRegisterFormFirstName" class="form-control" v-model="userName" placeholder="Name">
                            <div v-for="(value, name, index) in errorMessages" style="color: red">
                                <label v-if="name == 'name'">@{{value[0]}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" id="defaultRegisterFormEmail" class="form-control" v-model="userEmail" placeholder="E-mail">
                            <div v-for="(value, name, index) in errorMessages" style="color: red">
                                <label v-if="name == 'email'">@{{value[0]}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="password" id="defaultRegisterFormPassword" class="form-control" placeholder="Password" v-model="userPassword" aria-describedby="defaultRegisterFormPasswordHelpBlock">
                            <div v-for="(value, name, index) in errorMessages" style="color: red">
                                <label v-if="name == 'password'">@{{value[0]}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="password" id="defaultRegisterFormPassword" class="form-control" placeholder="Confirm Password" v-model="userConfirmPw" aria-describedby="defaultRegisterFormPasswordHelpBlock">
                        </div>
                        <div class="form-group">
                             <select class="w-100" v-model="selectdRoles" multiple>
                               <option v-for="role in roles" :value="role.id">@{{role.name}}</option>
                            </select>

{{--                            <v-select placeholder="Select Roles" :reduce="role => role.id" v-model="selectdRoles" :options="roles" label="name" taggable multiple></v-select>--}}

                            <div v-for="(value, name, index) in errorMessages" style="color: red">
                                <label v-if="name == 'selectdRoles'">@{{value[0]}}</label>
                            </div>
                        </div>
                        <div class="form-group row mb-4" v-if="successMessage != null">
                            <div class="col">
                                <p style="color: green">@{{successMessage}}</p>
                            </div>
                        </div>
                        <button :disabled="processing" class="btn btn-info my-4 btn-block" type="button" @click="createUser">Create User</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" id="editUserModal" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="my-modal-title">Edit User</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" id="defaultRegisterFormFirstName" class="form-control" v-model="userName" placeholder="Name">
                            <div v-for="(value, name, index) in errorMessages" style="color: red">
                                <label v-if="name == 'name'">@{{value[0]}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" id="defaultRegisterFormEmail" class="form-control" v-model="userEmail" placeholder="E-mail">
                            <div v-for="(value, name, index) in errorMessages" style="color: red">
                                <label v-if="name == 'email'">@{{value[0]}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="password" id="defaultRegisterFormPassword" class="form-control" placeholder="Password" v-model="userPassword" aria-describedby="defaultRegisterFormPasswordHelpBlock">
                            <div v-for="(value, name, index) in errorMessages" style="color: red">
                                <label v-if="name == 'password'">@{{value[0]}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="password" id="defaultRegisterFormPassword" class="form-control" placeholder="Confirm Password" v-model="userConfirmPw" aria-describedby="defaultRegisterFormPasswordHelpBlock">
                        </div>
                        <div class="form-group">
{{--                            <v-select placeholder="Select Roles" :reduce="role => role.id" v-model="selectdRoles" :options="roles" label="name" taggable multiple></v-select>--}}
                            <div v-for="(value, name, index) in errorMessages" style="color: red">
                                <label v-if="name == 'selectdRoles'">@{{value[0]}}</label>
                            </div>
                            <select class="w-100" v-model="selectdRoles" multiple>
                                <option v-for="role in roles" :value="role.id">@{{role.name}}</option>
                            </select>
                        </div>
                        <div class="form-group row mb-4" v-if="successMessage != null">
                            <div class="col">
                                <p style="color: green">@{{successMessage}}</p>
                            </div>
                        </div>
                        <button :disabled="processing" class="btn btn-info my-4 btn-block" type="button" @click="updateUser">Update User</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Load Footer   --}}
    @include('layouts.footer')
</div>
@endsection
