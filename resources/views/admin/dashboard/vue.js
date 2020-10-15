new Vue({
    el: '#dashboard_container',
    data: {
        showCompaniesChart : false,
        getChartDataUrl : App_url + '/data',
    },
    mounted() {
        this.getChartData();
    },
    methods: {
        getChartData: function(){
            axios.get(this.getChartDataUrl).then(response => {
                this.showCompaniesChart = response.data.showCompaniesChart;
                if(this.showCompaniesChart == true){
                    this.companiesChartData(response.data.companies);
                }
                this.transactionsChartData(response.data.transactions);
            }).catch(error => {
               console.log(error);
            });
        },
        transactionsChartData: function(transactions){
            var ctx = document.getElementById('transactions').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October',
                        'November', 'December'],
                    datasets: [{
                        label: '# of Transactions',
                        data: Object.values(transactions),

                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        },
        companiesChartData: function(companies){
            var ctx = document.getElementById('companies').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October',
                    'November', 'December'],
                    datasets: [{
                        label: '# of companies',
                        data: Object.values(companies),
                        // backgroundColor: [
                        //     'rgba(255, 99, 132, 0.2)',
                        //     'rgba(54, 162, 235, 0.2)',
                        //     'rgba(255, 206, 86, 0.2)',
                        //     'rgba(75, 192, 192, 0.2)',
                        //     'rgba(153, 102, 255, 0.2)',
                        //     'rgba(255, 159, 64, 0.2)'
                        // ],
                        // borderColor: [
                        //     'rgba(255, 99, 132, 1)',
                        //     'rgba(54, 162, 235, 1)',
                        //     'rgba(255, 206, 86, 1)',
                        //     'rgba(75, 192, 192, 1)',
                        //     'rgba(153, 102, 255, 1)',
                        //     'rgba(255, 159, 64, 1)'
                        // ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }
    }
});
