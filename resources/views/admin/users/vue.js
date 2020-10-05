new Vue({
    el: '#users_container',
    data: {
        dataLoaded: false,
        isBusy: false,
        processing: false,
        fullscreen: false,
        timer: "",
        fields: [{key: 'id', label: 'ID'},'name', 'email', 'Roles', 'Actions'],
        getUsersUrl: App_url + '/all',
        createUserUrl: App_url + '/create',
        deleteUserUrl: App_url + '/delete',
        editUserUrl: App_url + '/get',
        updateUserUrl: App_url + '/update',
        getRolesUrl: App_url + '/roles/all',
        userId: '',
        userName: '',
        userEmail: '',
        userPassword: '',
        userConfirmPw: '',
        errorMessages: [],
        errorMessage: '',
        successMessage: '',
        users: [],
        roles: [],
        selectdRoles: [],
        alreadySelectedRoles: [],
        usersTable: {
            searchQuery: '',
            searching: false,
        },
        orderBy: 'DESC',
        userMeta: {}
    },
    mounted() {
        this.applyUserFilter();
        this.getRoles();
    },
    watch: {
        'userMeta.current_page': function (val) {
            this.loadusersPaginatedData();
        }
    },
    methods: {
        toggle() {
            this.$refs['fullscreen'].toggle();
        },
        fullscreenChange(fullscreen) {
            this.fullscreen = fullscreen;
        },
        loadusersPaginatedData: function () {
            this.applyUserFilter(this.getUsersUrl + '?page=' + this.userMeta.current_page);
        },
        getOrderByResult: function(orderBy){
            this.orderBy = orderBy;
            this.applyUserFilter(false);
        },
        resetFilter() {
            this.usersTable.searchQuery = "";
            this.applyUserFilter();
        },
        applyUserFilter: function (url = false) {
            this.processing = true;
            this.isBusy = true;
            if (url == false) {
                url = this.getUsersUrl;
            }
            axios.post(url , {"SearchQuery" : this.usersTable.searchQuery, orderBy: this.orderBy})
                .then(response => {
                    if(response){
                        if (response.data.msg == 'Success') {
                            this.users      = response.data.data;
                            this.userMeta   = response.data.meta;
                            this.processing = false;
                            this.isBusy = false;
                        }
                    }
                }).catch(error => {
                this.processing = false;
                this.isBusy = false;
            });
        },
        getRoles() {
            axios.get(this.getRolesUrl).then(response => {
                if(response){
                    this.roles = response.data.data;
                }
            });
        },
        showAddModal: function () {
            $("#addUserModal").modal('show');
            this.userName = '';
            this.userEmail = '';
            this.userPassword = '';
            this.userConfirmPw = '';
            this.selectdRoles = [];
            this.successMessage = '';
            this.errorMessage = '';
            this.errorMessages = [];
        },
        createUser() {
            this.processing = true;
            axios.post(this.createUserUrl, {
                name: this.userName,
                email: this.userEmail,
                password: this.userPassword,
                password_confirmation: this.userConfirmPw,
                selectdRoles: this.selectdRoles
            })
                .then(response => {
                    if(response){
                        this.processing = false;
                        if (response.data.msg == 'User created successfully!') {
                            this.errorMessages = [];
                            this.successMessage = '';
                            this.successMessage = response.data.msg;
                            this.userName = '';
                            this.userEmail = '';
                            this.userPassword = '';
                            this.userConfirmPw = '';
                            this.selectdRoles = [];
                            this.applyUserFilter(false);
                            setTimeout(function () {
                                this.successMessage = '';
                                $("#addUserModal").modal('hide');
                            }, 1000);
                        }
                        if (response.data.code == 219) {
                            this.errorMessages = [];
                            this.errorMessages = response.data.data;
                        }
                    }
                });
        },
        editUser(userId) {
            this.userId = userId;
            this.errorMessages = [];
            axios.post(this.editUserUrl, {
                userId: userId
            }).then(response => {
                if(response){
                    if (response.data.msg == 'Success') {
                        this.userName = response.data.userWithRole.name;
                        this.userEmail = response.data.userWithRole.email;
                        this.userPassword = '';
                        this.userConfirmPw = '';
                        this.successMessage = '';
                        this.selectdRoles = response.data.userWithRole.roles;
                        $("#editUserModal").modal('show');
                        this.alreadySelectedRoles = response.data.roles;
                    }
                }
            });
        },
        updateUser() {
            this.processing = true;
            axios.post(this.updateUserUrl, {
                userId: this.userId,
                name: this.userName,
                email: this.userEmail,
                password: this.userPassword,
                password_confirmation: this.userConfirmPw,
                selectdRoles: this.selectdRoles
            })
                .then(response => {
                    if(response){
                        this.processing = false;
                        if (response.data.msg == 'User updated successfully.') {
                            this.errorMessages = [];
                            this.successMessage = '';
                            this.successMessage = response.data.msg;
                            this.userName = '';
                            this.userEmail = '';
                            this.userPassword = '';
                            this.userConfirmPw = '';
                            this.selectdRoles = [];
                            this.applyUserFilter(false);
                            setTimeout(function () {
                                this.successMessage = '';
                                $("#editUserModal").modal('hide');
                            }, 1000);
                        }
                        if (response.data.code == 219) {
                            this.errorMessages = [];
                            this.errorMessages = response.data.data;
                        }
                    }
                });
        },
        deleteUser(userId) {
            Swal.fire({
                title              : 'Are you sure?',
                text               : "You won't be able to revert this!",
                type               : 'warning',
                showCancelButton   : true,
                confirmButtonColor : '#3085d6',
                cancelButtonColor  : '#d33',
                confirmButtonText  : 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    axios.post(this.deleteUserUrl, {
                        userId: userId
                    }).then(response => {
                        if(response){
                            if (response.data.msg == 'User removed successfully.') {
                                this.applyUserFilter(false);
                            }
                        }
                    });
                }
            });

        },
        userFiltered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.userMeta.totalRows = filteredItems.length;
            this.userMeta.currentPage = 1;
        }
    }
});
