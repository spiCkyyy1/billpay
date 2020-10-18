new Vue({
    el: '#sendpayment_container',
    data: {
        disableCompanySelect: true,
        disableAmount: true,
        selectedCountry: '',
        getCompaniesUrl: App_url + '/companies',
        companies: [],
        selectedCompany: '',
        amount: '',
        disableBtn: true,
    },
    watch: {
        'selectedCountry': function (val){
          if(this.selectedCompany != null || this.selectedCountry !== ''){
              this.disableAmount = false;
          }
        },
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
                        if(response.data.data.length > 0){
                            this.companies = response.data.data;
                            this.disableCompanySelect = false;
                        }else{
                            this.companies = [];
                            this.disableCompanySelect = true;
                            this.disableAmount = true;
                        }
                    }
                }).catch(error => {
                    console.log(error);
            });
        },
    }
});
