@extends('layouts.app')

<script>
    var App_url = '{!! url()->current() !!}';
</script>
{{--  Inject vue js files  --}}
@push('script')
    <script src="{{ asset('js/app-vue.js') }}" ></script>
    <script src="{{ asset('js/admin/EmailTemplates/vue.js') }}" ></script>
@endpush

@section('content')
    {{--  Main layout  --}}
    <div class="container col-auto pt-3 p-0  bg-white border-0" id="email_template_container">
        <div class="container-fluid mt-4">
            {{--  Main Content  --}}
            <div class="card rounded-0 shadow-none mt-5">
                <div class="card-header small rgba-deep-purple-strong shadow-lg">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <h5><i class="fas fa-mail-bulk mr-1"></i> Email Templates</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0 shadow-lg rounded mb-4">
                    <div>
                        <b-table white responsive hover small head-variant="dark" :items="emailTemplates" :busy="isBusy" :fields="fields" show-empty @filtered="emailTemplateFiltered">
                            <template slot="thead-top" slot-scope="data">
                                <tr>
                                    <td colspan="12">
                                        <div class="p-0 m-0 pt-2 pb-2 row justify-content-between col-12">
                                            <div class="col-2 float-left mt-2">
                                                {{--                                            @can('users-create')--}}
                                                   <button @click="showAddModal" title="New Email Template" class="btn btn-outline-dark btn-sm mt-0" >
                                                    <span class="fa fa-plus"></span> New Email Template
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
                                                <input @keyup="applyEmailTemplatesFilter(false)" v-model="emailTemplatesTable.searchQuery" type="text" class="form-control form-control-sm" placeholder="Search by name">
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
                            <template v-slot:cell(name)="data">
                                <span class="m-0 pl-2">@{{data.item.name}}</span>
                            </template>

                            <template v-slot:cell(body)="data">
                                <span v-if="data.item.body.length < 20">@{{ data.item.body }}</span>
                                <span v-else>@{{ data.item.body.substring(0, 20)+"..." }}</span>
                            </template>

                            <template v-slot:cell(status)="data">
                                <span class="m-0 pl-2 badge badge-success" v-if="data.item.status == 1">Active</span>
                                <span class="m-0 pl-2 badge badge-danger" v-else>InActive</span>
                            </template>


                            <template v-slot:cell(Actions)="row">
                                {{--                            @can('users-edit')--}}
                                <b-button size="sm" title="Temaplte Details" variant="btn btn-dark btn-sm p-1 px-2 mt-0" @click="editEmailTemplate(row.item.id)">
                                    <i class="fas fa-cogs"></i>
                                </b-button>
                                {{--                            @endcan--}}
                                {{--                            @can('users-delete')--}}
                                <b-button size="sm" title="Delete" variant="btn btn-dark btn-sm p-1 px-2 mt-0" @click="deleteEmailTemplate(row.item.id)">
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
                                <p class="mb-0 p-1 small mt-1">Showing @{{ emailTemplatesMeta.from }} to @{{ emailTemplatesMeta.to }} of @{{ emailTemplatesMeta.total }} records | Per Page: @{{ emailTemplatesMeta.per_page }} | Current Page: @{{ emailTemplatesMeta.current_page }}</p>
                            </div>
                            <div class="col float-right">
                                <b-pagination class="float-right" size="sm" :total-rows="emailTemplatesMeta.total" v-model="emailTemplatesMeta.current_page" :per-page="emailTemplatesMeta.per_page" first-text="First" prev-text="Pervious" next-text="Next" last-text="Last" ellipsis-text="More" variant="danger">
                                </b-pagination>
                            </div>
                        </div>
                        {{-- End Row --}}
                    </div>
                </div>
            </div>
            <div class="modal fade" tabindex="-1" id="addEmailTemplateModal" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="my-modal-title">Add New Email Template</h5>
                            <button class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" id="defaultRegisterFormFirstName" class="form-control" v-model="name" placeholder="Name">
                                <div v-for="(value, name, index) in errorMessages" style="color: red">
                                    <label v-if="name == 'name'">@{{value[0]}}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" id="defaultRegisterFormEmail" class="form-control" v-model="slug" placeholder="Slug" disabled>
                                <div v-for="(value, name, index) in errorMessages" style="color: red">
                                    <label v-if="name == 'slug'">@{{value[0]}}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="text" id="subject" class="form-control" v-model="subject" placeholder="Subject">
                                <div v-for="(value, name, index) in errorMessages" style="color: red">
                                    <label v-if="name == 'subject'">@{{value[0]}}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <textarea name="body" id="body" v-model="body" cols="30" rows="10" class="form-control"></textarea>
                                <div v-for="(value, name, index) in errorMessages" style="color: red">
                                    <label v-if="name == 'body'">@{{value[0]}}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <select class="w-100" v-model="status">
                                    <option value="1">Active</option>
                                    <option value="0">In-Active</option>
                                </select>
                            </div>
                            <div class="form-group row mb-4" v-if="successMessage != null">
                                <div class="col">
                                    <p style="color: green">@{{successMessage}}</p>
                                </div>
                            </div>
                            <button :disabled="processing" class="btn btn-info my-4 btn-block" type="button" @click="createEmailTemplate">Create Template</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" tabindex="-1" id="editEmailTemplateModal" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="my-modal-title">Edit Template</h5>
                            <button class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" id="defaultRegisterFormFirstName" class="form-control" v-model="name" placeholder="Name">
                                <div v-for="(value, name, index) in errorMessages" style="color: red">
                                    <label v-if="name == 'name'">@{{value[0]}}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" id="defaultRegisterFormEmail" class="form-control" v-model="slug" placeholder="Slug" disabled>
                                <div v-for="(value, name, index) in errorMessages" style="color: red">
                                    <label v-if="name == 'slug'">@{{value[0]}}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" id="subject" class="form-control" v-model="subject" placeholder="Subject">
                                <div v-for="(value, name, index) in errorMessages" style="color: red">
                                    <label v-if="name == 'subject'">@{{value[0]}}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <textarea name="body" id="body" v-model="body" cols="30" rows="10" class="form-control"></textarea>
                                <div v-for="(value, name, index) in errorMessages" style="color: red">
                                    <label v-if="name == 'body'">@{{value[0]}}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <select class="w-100" v-model="status">
                                    <option value="1">Active</option>
                                    <option value="0">In-Active</option>
                                </select>
                            </div>
                            <div class="form-group row mb-4" v-if="successMessage != null">
                                <div class="col">
                                    <p style="color: green">@{{successMessage}}</p>
                                </div>
                            </div>
                            <button :disabled="processing" class="btn btn-info my-4 btn-block" type="button" @click="updateEmailTemplate">Update Template</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Load Footer   --}}
        @include('layouts.footer')
    </div>
@endsection
