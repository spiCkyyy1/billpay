new Vue({
    el: '#transactions_container',
    data: {
        dataLoaded: false,
        isBusy: false,
        processing: false,
        fullscreen: false,
        timer: "",
        fields: [{key: 'id', label: 'ID'}, {key: 'payment_id', label: 'Payment ID'}, 'payment_status',
            {key: 'payer_id', label: 'Payer ID'}, {key: 'payer_email', label: 'Payer Email'},{key: 'payer_name', label: 'Payer Name'},
            {key: 'payer_country_code', label: 'Payer Country Code'}, {key: 'transaction_amount', label: 'Transaction Amount'},
            {key: 'transaction_currency', label: 'Transaction Currency'}, 'merchant_id', 'merchant_email',
            'commission',{key: 'transaction_create_time', label: 'Transaction Created Time'},
            {key: 'transaction_update_time', label: 'Transaction Updated Time'}],
        getTransactionsUrl: App_url + '/all',
        transactions: [],
        transactionTable: {
            searchQuery: '',
            searching: false,
        },
        orderBy: 'DESC',
        transactionsMeta: {}
    },
    mounted() {
        this.applyFilter();
    },
    watch: {
        'transactionsMeta.current_page': function (val) {
            this.loadCompaniesPaginatedData();
        }
    },
    methods: {
        loadCompaniesPaginatedData: function () {
            this.applyFilter(this.getTransactionsUrl + '?page=' + this.transactionsMeta.current_page);
        },
        getOrderByResult: function(orderBy){
            this.orderBy = orderBy;
            this.applyFilter(false);
        },
        resetFilter() {
            this.transactionTable.searchQuery = "";
            this.orderBy = 'DESC';
            this.applyFilter();
        },
        applyFilter: function (url = false) {
            this.processing = true;
            this.isBusy = true;
            if (url == false) {
                url = this.getTransactionsUrl;
            }
            axios.post(url , {"SearchQuery" : this.transactionTable.searchQuery, orderBy: this.orderBy})
                .then(response => {
                    if(response){
                        if (response.data.msg == 'Success') {
                            this.transactions      = response.data.data;
                            this.transactionsMeta   = response.data.meta;
                            this.processing = false;
                            this.isBusy = false;
                        }
                    }
                }).catch(error => {
                this.processing = false;
                this.isBusy = false;
            });
        },
        transactionsFiltered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.transactionsMeta.totalRows = filteredItems.length;
            this.transactionsMeta.currentPage = 1;
        }
    }
});
