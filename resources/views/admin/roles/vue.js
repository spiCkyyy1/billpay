new Vue({
    el: '#roles_container',
    data: {
        dataLoaded: false,
        isBusy: false,
        fullscreen: false,
        rolesTable: {
            searchQuery: '',
            searching: false
        },
        orderBy: 'DESC',
        fields: [{key: 'id', label: 'ID'},'name', 'permissions', 'Actions'],
        roleName: '',
        roleId: '',
        editRoleName: '',
        getRolesUrl: App_url + '/all',
        saveRoleUrl: App_url + '/create',
        editRoleUrl: App_url + '/get',
        updateRoleUrl: App_url + '/update',
        deleteRoleUrl: App_url + '/delete',
        getPermissionsUrl: App_url + '/permissions/all',
        roles: [],
        permissions: [],
        roleErrors: [],
        roleError: '',
        roleSuccessMessage: '',
        checkedPermissions: [],
        editAlreadySelectedPermissions: [],
        rolesMeta: {}
    },
    mounted() {
        this.getPermissions();
        this.applyRolesFilter(false);
    },
    watch: {
        'rolesMeta.current_page': function (val) {
            this.loadrolesPaginatedData();
        }
    },
    methods: {
        toggle() {
            this.$refs['fullscreen'].toggle();
        },
        fullscreenChange(fullscreen) {
            this.fullscreen = fullscreen;
        },
        loadrolesPaginatedData: function () {
            this.applyRolesFilter(this.getRolesUrl + '?page=' + this.rolesMeta.current_page);
        },
        getOrderByResult: function(orderBy){
            this.orderBy = orderBy;
            this.applyRolesFilter(false);
        },
        applyRolesFilter: function (url = false) {
            this.isBusy = true;
            if (url == false) {
                url = this.getRolesUrl;
            }
            axios.post(url, {search: this.rolesTable.searchQuery, orderBy: this.orderBy})
                .then(response => {
                    if(response){
                        if(response.data.msg == 'Success'){
                            this.roles = response.data.data;
                            this.rolesMeta = response.data.meta;
                            this.isBusy = false;
                        }
                    }
                }).catch(error => {
                console.log(error);
                this.isBusy = false;
            });
        },
        getPermissions() {
            axios.get(this.getPermissionsUrl).then(response => {
                if(response){
                    if(response.data.code == 200){
                        this.permissions = response.data.data;
                    }
                }
            });
        },
        showAddModal: function(){
            $("#addRoleModal").modal('show');
            this.roleSuccessMessage = '';
            this.roleName = '';
            this.checkedPermissions = [];
            this.editAlreadySelectedPermissions = [];
            this.roleErrors = [];
        },
        saveRole() {
            this.roleErrors         = [];
            this.roleError          = '';
            this.roleSuccessMessage = '';
            axios.post(this.saveRoleUrl, {
                roleName: this.roleName,
                permissions: this.checkedPermissions
            }).then(response => {
                if(response){
                    if (response.data.code == 219) {
                        this.roleError = response.data.msg;
                    }
                    if (response.data.msg == 'Role created successfully.') {
                        this.roleSuccessMessage = response.data.msg;
                        this.roleName           = '';
                        this.checkedPermissions = [];
                        this.editAlreadySelectedPermissions = [];
                        this.applyRolesFilter(false);
                        setTimeout(function(){
                            $("#addRoleModal").modal('hide');
                        },1000);
                    }
                }
            });
        },
        editRole(roleId) {
            this.roleId                         = roleId;
            this.roleErrors                     = [];
            this.roleError                      = '';
            this.editAlreadySelectedPermissions = [];
            this.roleSuccessMessage             = '';
            axios.post(this.editRoleUrl, {
                roleId: roleId
            }).then(response => {
                if(response){
                    if (response.data.msg == 'Success') {
                        $("#editRoleModal").modal('show');
                        this.editRoleName = response.data.roleWithPermission.name;
                        this.editAlreadySelectedPermissions = response.data.permissions;
                        this.roleSuccessMessage = '';
                        this.roleError = '';
                    }
                }
            });
        },
        updateRole() {
            this.roleErrors         = [];
            this.roleError          = '';
            this.roleSuccessMessage = '';
            axios.post(this.updateRoleUrl, {
                roleName: this.editRoleName,
                roleId: this.roleId,
                permissions: this.editAlreadySelectedPermissions
            })
                .then(response => {
                    if(response){
                        if (response.data.code == 219) {
                            this.roleError = response.data.msg;
                        }
                        if (response.data.msg == 'Role updated successfully.') {
                            this.applyRolesFilter(false);
                            this.roleId = '';
                            this.roleSuccessMessage = response.data.msg;
                            setTimeout(function () {
                                this.editRoleName = '';
                                $("#editRoleModal").modal('hide');
                            }, 1000);
                        }
                    }
                });
        },
        deleteRole(roleId) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    axios.post(this.deleteRoleUrl, {
                        roleId: roleId
                    }).then(response => {
                        if(response){
                            if (response.data.code == 200) {
                                swal(
                                    'Deleted!',
                                    response.data.message,
                                    'success'
                                );
                                this.applyRolesFilter(false);
                            }
                        }
                    }).catch(error => {
                        swal(
                            'Sorry!',
                            error.response.data.message,
                            'warning'
                        );
                    });
                }
            })
        },
        Filtered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.rolesMeta.totalRows = filteredItems.length;
            this.rolesMeta.currentPage = 1;
        }
    }
});
