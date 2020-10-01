new Vue({
    el: '#categories_container',
    data: {
        dataLoaded: false,
        isBusy: false,
        processing: false,
        fullscreen: false,
        timer: "",
        fields: [{key: 'id', label: 'ID'},'name', 'slug', 'status',  'Actions'],
        getCategoriesUrl: App_url + '/all',
        createCategoryUrl: App_url + '/create',
        deleteCategoryUrl: App_url + '/delete',
        editCategoryUrl: App_url + '/get',
        updateCategoryUrl: App_url + '/update',
        categoryId: '',
        categoryName: '',
        categorySlug: '',
        categoryStatus: 'enabled',
        errorMessages: [],
        errorMessage: '',
        successMessage: '',
        categories: [],
        categoriesTable: {
            searchQuery: '',
            searching: false,
        },
        orderBy: 'DESC',
        categoriesMeta: {}
    },
    mounted() {
        this.applyCategoriesFilter();
    },
    watch: {
        'categoriesMeta.current_page': function (val) {
            this.loadCategoriesPaginatedData();
        }
    },
    methods: {
        loadCategoriesPaginatedData: function () {
            this.applyCategoriesFilter(this.getCategoriesUrl + '?page=' + this.categoriesMeta.current_page);
        },
        getOrderByResult: function(orderBy){
            this.orderBy = orderBy;
            this.applyCategoriesFilter(false);
        },
        resetFilter() {
            this.categoriesTable.searchQuery = "";
            this.orderBy = 'DESC';
            this.applyCategoriesFilter();
        },
        applyCategoriesFilter: function (url = false) {
            this.processing = true;
            this.isBusy = true;
            if (url == false) {
                url = this.getCategoriesUrl;
            }
            axios.post(url , {"SearchQuery" : this.categoriesMeta.searchQuery, orderBy: this.orderBy})
                .then(response => {
                    if(response){
                        if (response.data.msg == 'Success') {
                            this.categories      = response.data.data;
                            this.categoriesMeta   = response.data.meta;
                            this.processing = false;
                            this.isBusy = false;
                        }
                    }
                }).catch(error => {
                this.processing = false;
                this.isBusy = false;
            });
        },
        showAddModal: function () {
            $("#addCategoryModal").modal('show');
            this.categoryName = '';
            this.categorySlug = '';
            this.categoryStatus = 'enabled';
            this.successMessage = '';
            this.errorMessage = '';
            this.errorMessages = [];
        },
        createCategory() {
            this.processing = true;
            axios.post(this.createCategoryUrl, {
                name: this.categoryName,
                slug: this.categorySlug,
                status: this.categoryStatus
            })
                .then(response => {
                    if(response){
                        this.processing = false;
                        if (response.data.msg == 'Category Created Successfully.') {
                            var context = this;
                            this.errorMessages = [];
                            this.successMessage = '';
                            this.successMessage = response.data.success;
                            this.categoryName = '';
                            this.categorySlug = '';
                            this.categoryStatus = 'enabled';
                            this.applyCategoriesFilter(false);
                            setTimeout(function () {
                                context.successMessage = '';
                                $("#addCategoryModal").modal('hide');
                            }, 1000);
                        }
                        if (response.data.code == 219) {
                            this.errorMessages = [];
                            this.errorMessages = response.data.data;
                        }
                    }
                });
        },
        editCategory(categoryId) {
            this.categoryId = categoryId;
            this.errorMessages = [];
            axios.post(this.editCategoryUrl, {
                categoryId: categoryId
            }).then(response => {
                if(response){
                    if (response.data.msg == 'Success') {
                        this.categoryName = response.data.data.name;
                        this.categorySlug = response.data.data.slug;
                        this.categoryStatus = response.data.data.status;
                        this.successMessage = '';
                        $("#editCategoryModal").modal('show');
                    }
                }
            });
        },
        updateCategory() {
            this.processing = true;
            axios.post(this.updateCategoryUrl, {
                categoryId: this.categoryId,
                name: this.categoryName,
                slug: this.categorySlug,
                status: this.categoryStatus,
            })
                .then(response => {
                    if(response){
                        this.processing = false;
                        if (response.data.msg == 'Category Updated Successfully.') {
                            var context = this;
                            this.errorMessages = [];
                            this.successMessage = '';
                            this.successMessage = response.data.success;
                            this.categoryName = '';
                            this.categorySlug = '';
                            this.categoryStatus = 'enabled';
                            this.applyCategoriesFilter(false);
                            setTimeout(function () {
                                context.successMessage = '';
                                $("#editCategoryModal").modal('hide');
                            }, 1000);
                        }
                        if (response.data.code == 219) {
                            this.errorMessages = [];
                            this.errorMessages = response.data.data;
                        }
                    }
                });
        },
        deleteCategory(categoryId) {
            axios.post(this.deleteCategoryUrl, {
                id: categoryId
            }).then(response => {
                if(response){
                    if (response.data.msg == 'Category Deleted Successfully.') {
                        this.applyCategoriesFilter(false);
                    }
                }
            });
        },
        categoriesFiltered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.categoriesMeta.totalRows = filteredItems.length;
            this.categoriesMeta.currentPage = 1;
        }
    }
});
