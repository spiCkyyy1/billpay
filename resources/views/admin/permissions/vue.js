new Vue({
    el: '#permissions_container',
    data: {
        dataLoaded: false,
        isBusy: false,
        fullscreen: false,
        permissionTable: {
            searchQuery: '',
            searching: false
        },
        orderBy: 'DESC',
        fields: [{key:'id', label: 'ID'},'name', 'Actions'],
        permissionName: '',
        permissionId: '',
        editPermissionName: '',
        getPermissionsUrl: App_url + '/all',
        savePermissionUrl: App_url + '/create',
        deletePermissionUrl: App_url + '/delete',
        editPermissionUrl: App_url + '/get',
        updatePermissionUrl: App_url + '/update',
        permissions: [],
        editAlreadySelectedPermissions: [],
        permissionErrors: [],
        permissionSuccess: '',
        permissionMeta: {},
        timer: ""
    },
    mounted() {
        this.applyPermissionFilter(false);
    },
    watch: {
        'permissionMeta.current_page': function (val) {
            this.loadPermissionPaginatedData();
        },
        "permissionTable.searchQuery": function(val) {
            this.applyPermissionFilter(false);
        },
    },
    methods: {
        toggle() {
            this.$refs['fullscreen'].toggle();
        },
        fullscreenChange(fullscreen) {
            this.fullscreen = fullscreen;
        },
        loadPermissionPaginatedData: function () {
            this.applyPermissionFilter(this.getPermissionsUrl + '?page=' + this.permissionMeta.current_page);
        },
        getOrderByResult: function(orderBy){
            this.orderBy = orderBy;
            this.applyPermissionFilter(false);
        },
        applyPermissionFilter: function (url = false) {
            // $('.loading').show();
            this.permissionTable.searching = true;
            this.dataLoaded = false;
            this.isBusy = true;
            if (url == false) {
                url = this.getPermissionsUrl;
            }
            axios.post(url, {searchQuery: this.permissionTable.searchQuery, orderBy: this.orderBy})
                .then(response => {
                    if(response){
                        if(response.data.msg == 'Success'){
                            this.permissions = response.data.data;
                            this.permissionMeta = response.data.meta;
                            // $('.loading').hide();
                            this.permissionTable.searching = false;
                            this.dataLoaded = true;
                            this.isBusy = false;
                        }
                    }
                }).catch(error => {
                $('.loading').hide();
                this.isBusy = false;
            });
        },
        showAddModal: function(){
            $("#addPermissionsModal").modal('show');
            this.permissionSuccess = '';
            this.permissionErrors = [];
        },
        savePermission() {
            axios.post(this.savePermissionUrl, {
                permissionName: this.permissionName
            }).then(response => {
                if(response){
                    if (response.data.code == 219) {
                        this.permissionErrors = [];
                        this.permissionErrors = response.data.data;
                    }
                    if (response.data.msg == 'Permission created successfully.') {
                        this.applyPermissionFilter(false);
                        this.permissionErrors = [];
                        this.permissionName = '';
                        this.permissionSuccess = '';
                        this.permissionSuccess = response.data.msg;
                        this.editAlreadySelectedPermissions = [];
                        setTimeout(function(){
                            $("#addPermissionsModal").modal('hide');
                        },1000);
                    }
                }
            }).catch(error => console.log(error));
        },
        editPermission(permissionId) {
            this.permissionErrors = [];
            this.editAlreadySelectedPermissions = [];
            this.permissionId = permissionId;
            this.permissionSuccess = '';
            axios.post(this.editPermissionUrl, {
                permissionId: permissionId
            }).then(response => {
                if(response){
                    if (response.data.msg == 'Success') {
                        $("#EditPermissionsModal").modal('show');
                        this.editPermissionName = response.data.data.name;
                        this.permissionSuccess = '';
                    }
                }
            });

        },
        updatePermission() {
            axios.post(this.updatePermissionUrl, {
                permissionName: this.editPermissionName,
                permissionId: this.permissionId
            }).then(response => {
                if(response){
                    if (response.data.code == 219) {
                        this.permissionErrors = [];
                        this.permissionErrors = response.data.data;
                    }
                    if (response.data.msg == 'Permission updated successfully.') {
                        this.applyPermissionFilter(false);
                        this.permissionErrors = [];
                        this.permissionId = '';
                        this.permissionSuccess = '';
                        this.permissionSuccess = response.data.msg;
                        setTimeout(function () {
                            var context = this;
                            context.permissionSuccess = '';
                            $("#EditPermissionsModal").modal('hide');
                        }, 1000);
                    }
                }
            });
        },
        deletePermission(permissionId) {
            axios.post(this.deletePermissionUrl, {
                permissionId: permissionId
            }).then(response => {
                if(response){
                    if (response.data.code == 200) {
                        this.applyPermissionFilter(false);
                    }
                }
            }).catch(error => {
                console.log(error);
            });
        },
        Filtered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.permissionMeta.totalRows = filteredItems.length;
            this.permissionMeta.currentPage = 1;
        },
    }
});
