new Vue({
    el: '#sendpayment_container',
    data: {
        disableCompanySelect: true,
        disableAmount: true,
        selectedCountry: 'Afganistan',
        getCompaniesUrl: App_url + '/companies',
        companies: [],
        selectedCompany: '',
        amount: '',
        disableBtn: true,
    },
    watch: {
        'selectedCompany': function (val){
            if(val !== null || val !== ''){
                this.disableAmount = false;
            }
        },
        'amount': function(val){
            if(val !== '' || val !== null){
                this.disableBtn = false;
            }
        },
    },
    methods: {
        getCompanyCountires: function(){
            axios.post(this.getCompaniesUrl, {country: this.selectedCountry})
                .then(response => {
                    if(response.data.msg == 'Success'){
                        this.companies = response.data.data;
                        this.disableCompanySelect = false;
                    }
                }).catch(error => {
                    console.log(error);
            });
        },
    }
});