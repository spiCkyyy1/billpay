new Vue({
    el: '#email_template_container',
    data: {
        dataLoaded: false,
        isBusy: false,
        processing: false,
        fullscreen: false,
        timer: "",
        fields: [{key: 'id', label: 'ID'},'name', 'slug', 'subject', 'body', 'status',  'Actions'],
        getEmailTemplateUrl: App_url + '/all',
        createEmailTemplateUrl: App_url + '/create',
        deleteEmailTemplateUrl: App_url + '/delete',
        editEmailTemplateUrl: App_url + '/get',
        updateEmailTemplateUrl: App_url + '/update',
        id: '',
        name: '',
        subject: '',
        body: '',
        slug: '',
        status: 1,
        errorMessages: [],
        errorMessage: '',
        successMessage: '',
        emailTemplates: [],
        emailTemplatesTable: {
            searchQuery: '',
            searching: false,
        },
        orderBy: 'DESC',
        emailTemplatesMeta: {}
    },
    mounted() {
        this.applyEmailTemplatesFilter();
    },
    watch: {
        'emailTemplatesMeta.current_page': function (val) {
            this.loadEmailTemplatesPaginatedData();
        },
        'name': function (val){
            this.slug = this.sanitizeTitle(val);
        }
    },
    methods: {
        loadEmailTemplatesPaginatedData: function () {
            this.applyEmailTemplatesFilter(this.getEmailTemplateUrl + '?page=' + this.emailTemplatesMeta.current_page);
        },
        getOrderByResult: function(orderBy){
            this.orderBy = orderBy;
            this.applyEmailTemplatesFilter(false);
        },
        sanitizeTitle: function(str) {
            var $slug = '';
            var trimmed = $.trim(str);
            $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
            replace(/-+/g, '-').
            replace(/^-|-$/g, '');
            return $slug.toLowerCase();
        },
        resetFilter() {
            this.emailTemplatesTable.searchQuery = "";
            this.orderBy = 'DESC';
            this.applyEmailTemplatesFilter();
        },
        applyEmailTemplatesFilter: function (url = false) {
            this.processing = true;
            this.isBusy = true;
            if (url == false) {
                url = this.getEmailTemplateUrl;
            }
            axios.post(url , {"SearchQuery" : this.emailTemplatesMeta.searchQuery, orderBy: this.orderBy})
                .then(response => {
                    if(response){
                        if (response.data.msg == 'Success') {
                            this.emailTemplates      = response.data.data;
                            this.emailTemplatesMeta   = response.data.meta;
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
            $("#addEmailTemplateModal").modal('show');
            this.name = '';
            this.slug = '';
            this.subject= '';
            this.body = '';
            this.status = 1;
            this.successMessage = '';
            this.errorMessage = '';
            this.errorMessages = [];
        },
        createEmailTemplate() {
            this.processing = true;
            axios.post(this.createEmailTemplateUrl, {
                name: this.name,
                slug: this.slug,
                subject: this.subject,
                body: this.body,
                status: this.status
            })
                .then(response => {
                    if(response){
                        this.processing = false;
                        if (response.data.msg == 'Email Template Created Successfully.') {
                            var context = this;
                            this.errorMessages = [];
                            this.successMessage = '';
                            this.successMessage = response.data.msg;
                            this.name = '';
                            this.slug = '';
                            this.subject = '';
                            this.body = '';
                            this.status = 1;
                            this.applyEmailTemplatesFilter(false);
                            setTimeout(function () {
                                context.successMessage = '';
                                $("#addEmailTemplateModal").modal('hide');
                            }, 1000);
                        }
                        if (response.data.code == 219) {
                            this.errorMessages = [];
                            this.errorMessages = response.data.data;
                        }
                    }
                });
        },
        editEmailTemplate(emailTemplateID) {
            this.id = emailTemplateID;
            this.errorMessages = [];
            axios.post(this.editEmailTemplateUrl, {
                id: emailTemplateID
            }).then(response => {
                if(response){
                    if (response.data.msg == 'Success') {
                        this.name = response.data.data.name;
                        this.slug = response.data.data.slug;
                        this.subject = response.data.data.subject;
                        this.body = response.data.data.body;
                        this.status = response.data.data.status;
                        this.successMessage = '';
                        $("#editEmailTemplateModal").modal('show');
                    }
                }
            });
        },
        updateEmailTemplate() {
            this.processing = true;
            axios.post(this.updateEmailTemplateUrl, {
                id: this.id,
                name: this.name,
                subject: this.subject,
                body: this.body,
                slug: this.slug,
                status: this.status,
            })
                .then(response => {
                    if(response){
                        this.processing = false;
                        if (response.data.msg == 'Email Template Updated Successfully.') {
                            var context = this;
                            this.errorMessages = [];
                            this.successMessage = '';
                            this.successMessage = response.data.msg;
                            this.name = '';
                            this.slug = '';
                            this.subject = '';
                            this.body = '';
                            this.status = 1;
                            this.applyEmailTemplatesFilter(false);
                            setTimeout(function () {
                                context.successMessage = '';
                                $("#editEmailTemplateModal").modal('hide');
                            }, 1000);
                        }
                        if (response.data.code == 219) {
                            this.errorMessages = [];
                            this.errorMessages = response.data.data;
                        }
                    }
                });
        },
        deleteEmailTemplate(id) {
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
                    axios.post(this.deleteEmailTemplateUrl, {
                        id: id
                    }).then(response => {
                        if(response){
                            if (response.data.msg == 'Email Template Deleted Successfully.') {
                                this.applyEmailTemplatesFilter(false);
                            }
                        }
                    });
                }
            });
        },
        emailTemplateFiltered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.emailTemplatesMeta.totalRows = filteredItems.length;
            this.emailTemplatesMeta.currentPage = 1;
        }
    }
});
