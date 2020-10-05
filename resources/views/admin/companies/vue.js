new Vue({
    el: '#companies_container',
    data: {
        dataLoaded: false,
        isBusy: false,
        processing: false,
        fullscreen: false,
        timer: "",
        fields: [{key: 'id', label: 'ID'},'name', 'country', 'state', 'city', {key: 'zip_code', label: 'Zip Code'}, 'email', {key: 'paypal_id', label: 'Paypal ID'},
            'status',  'Actions'],
        getCompaniesUrl: App_url + '/all',
        deleteCompanyUrl: App_url + '/delete',
        approveCompanyUrl: App_url + '/approve',
        disapproveCompanyUrl: App_url + '/disapprove',
        companies: [],
        companiesTable: {
            searchQuery: '',
            searching: false,
        },
        orderBy: 'DESC',
        companiesMeta: {}
    },
    mounted() {
        this.applyCompaniesFilter();
    },
    watch: {
        'companiesMeta.current_page': function (val) {
            this.loadCompaniesPaginatedData();
        }
    },
    methods: {
        loadCompaniesPaginatedData: function () {
            this.applyCompaniesFilter(this.getCompaniesUrl + '?page=' + this.companiesMeta.current_page);
        },
        getOrderByResult: function(orderBy){
            this.orderBy = orderBy;
            this.applyCompaniesFilter(false);
        },
        resetFilter() {
            this.companiesTable.searchQuery = "";
            this.orderBy = 'DESC';
            this.applyCompaniesFilter();
        },
        applyCompaniesFilter: function (url = false) {
            this.processing = true;
            this.isBusy = true;
            if (url == false) {
                url = this.getCompaniesUrl;
            }
            axios.post(url , {"SearchQuery" : this.companiesTable.searchQuery, orderBy: this.orderBy})
                .then(response => {
                    if(response){
                        if (response.data.msg == 'Success') {
                            this.companies      = response.data.data;
                            this.companiesMeta   = response.data.meta;
                            this.processing = false;
                            this.isBusy = false;
                        }
                    }
                }).catch(error => {
                this.processing = false;
                this.isBusy = false;
            });
        },
        approveCompany(companyId) {
            axios.post(this.approveCompanyUrl, {
                companyId: companyId
            }).then(response => {
                if(response){
                    if (response.data.msg == 'Success') {
                        Swal.fire(
                            'Success! ',
                            'Company Approved Successfully!',
                            'success'
                        );
                        this.applyCompaniesFilter(false);
                    }
                }
            });
        },
        disapproveCompany(companyID) {
            this.processing = true;
            axios.post(this.disapproveCompanyUrl, {
                companyID: companyID
            })
                .then(response => {
                    if(response){
                        this.processing = false;
                        if (response.data.msg == 'Success') {
                            Swal.fire(
                                'Success! ',
                                'Company Disapproved Successfully!',
                                'success'
                            );
                            this.applyCompaniesFilter(false);
                        }
                    }
                });
        },
        deleteCompany(companyId) {
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
                    axios.post(this.deleteCompanyUrl, {
                        id: companyId
                    }).then(response => {
                        if(response){
                            if (response.data.msg == 'Success') {
                                Swal.fire(
                                    'Success! ',
                                    'Company Removed Successfully!',
                                    'success'
                                );
                                this.applyCompaniesFilter(false);
                            }
                        }
                    });
                }
            });

        },
        companiesFiltered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.companiesMeta.totalRows = filteredItems.length;
            this.companiesMeta.currentPage = 1;
        }
    }
});
