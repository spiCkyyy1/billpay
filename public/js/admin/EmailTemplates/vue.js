/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/views/admin/EmailTemplates/vue.js":
/*!*****************************************************!*\
  !*** ./resources/views/admin/EmailTemplates/vue.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

new Vue({
  el: '#email_template_container',
  data: {
    dataLoaded: false,
    isBusy: false,
    processing: false,
    fullscreen: false,
    timer: "",
    fields: [{
      key: 'id',
      label: 'ID'
    }, 'name', 'slug', 'subject', 'body', 'status', 'Actions'],
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
      searching: false
    },
    orderBy: 'DESC',
    emailTemplatesMeta: {}
  },
  mounted: function mounted() {
    this.applyEmailTemplatesFilter();
  },
  watch: {
    'emailTemplatesMeta.current_page': function emailTemplatesMetaCurrent_page(val) {
      this.loadEmailTemplatesPaginatedData();
    }
  },
  methods: {
    loadEmailTemplatesPaginatedData: function loadEmailTemplatesPaginatedData() {
      this.applyEmailTemplatesFilter(this.getEmailTemplateUrl + '?page=' + this.emailTemplatesMeta.current_page);
    },
    getOrderByResult: function getOrderByResult(orderBy) {
      this.orderBy = orderBy;
      this.applyEmailTemplatesFilter(false);
    },
    resetFilter: function resetFilter() {
      this.emailTemplatesTable.searchQuery = "";
      this.orderBy = 'DESC';
      this.applyEmailTemplatesFilter();
    },
    applyEmailTemplatesFilter: function applyEmailTemplatesFilter() {
      var _this = this;

      var url = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
      this.processing = true;
      this.isBusy = true;

      if (url == false) {
        url = this.getEmailTemplateUrl;
      }

      axios.post(url, {
        "SearchQuery": this.emailTemplatesMeta.searchQuery,
        orderBy: this.orderBy
      }).then(function (response) {
        if (response) {
          if (response.data.msg == 'Success') {
            _this.emailTemplates = response.data.data;
            _this.emailTemplatesMeta = response.data.meta;
            _this.processing = false;
            _this.isBusy = false;
          }
        }
      })["catch"](function (error) {
        _this.processing = false;
        _this.isBusy = false;
      });
    },
    showAddModal: function showAddModal() {
      $("#addEmailTemplateModal").modal('show');
      this.name = '';
      this.slug = '';
      this.subject = '';
      this.body = '';
      this.status = 1;
      this.successMessage = '';
      this.errorMessage = '';
      this.errorMessages = [];
    },
    createEmailTemplate: function createEmailTemplate() {
      var _this2 = this;

      this.processing = true;
      axios.post(this.createEmailTemplateUrl, {
        name: this.name,
        slug: this.slug,
        subject: this.subject,
        body: this.body,
        status: this.status
      }).then(function (response) {
        if (response) {
          _this2.processing = false;

          if (response.data.msg == 'Email Template Created Successfully.') {
            var context = _this2;
            _this2.errorMessages = [];
            _this2.successMessage = '';
            _this2.successMessage = response.data.msg;
            _this2.name = '';
            _this2.slug = '';
            _this2.subject = '';
            _this2.body = '';
            _this2.status = 1;

            _this2.applyEmailTemplatesFilter(false);

            setTimeout(function () {
              context.successMessage = '';
              $("#addEmailTemplateModal").modal('hide');
            }, 1000);
          }

          if (response.data.code == 219) {
            _this2.errorMessages = [];
            _this2.errorMessages = response.data.data;
          }
        }
      });
    },
    editEmailTemplate: function editEmailTemplate(emailTemplateID) {
      var _this3 = this;

      this.id = emailTemplateID;
      this.errorMessages = [];
      axios.post(this.editEmailTemplateUrl, {
        id: emailTemplateID
      }).then(function (response) {
        if (response) {
          if (response.data.msg == 'Success') {
            _this3.name = response.data.data.name;
            _this3.slug = response.data.data.slug;
            _this3.subject = response.data.data.subject;
            _this3.body = response.data.data.body;
            _this3.status = response.data.data.status;
            _this3.successMessage = '';
            $("#editEmailTemplateModal").modal('show');
          }
        }
      });
    },
    updateEmailTemplate: function updateEmailTemplate() {
      var _this4 = this;

      this.processing = true;
      axios.post(this.updateEmailTemplateUrl, {
        id: this.id,
        name: this.name,
        subject: this.subject,
        body: this.body,
        slug: this.slug,
        status: this.status
      }).then(function (response) {
        if (response) {
          _this4.processing = false;

          if (response.data.msg == 'Email Template Updated Successfully.') {
            var context = _this4;
            _this4.errorMessages = [];
            _this4.successMessage = '';
            _this4.successMessage = response.data.msg;
            _this4.name = '';
            _this4.slug = '';
            _this4.subject = '';
            _this4.body = '';
            _this4.status = 1;

            _this4.applyEmailTemplatesFilter(false);

            setTimeout(function () {
              context.successMessage = '';
              $("#editEmailTemplateModal").modal('hide');
            }, 1000);
          }

          if (response.data.code == 219) {
            _this4.errorMessages = [];
            _this4.errorMessages = response.data.data;
          }
        }
      });
    },
    deleteEmailTemplate: function deleteEmailTemplate(id) {
      var _this5 = this;

      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then(function (result) {
        if (result.value) {
          axios.post(_this5.deleteEmailTemplateUrl, {
            id: id
          }).then(function (response) {
            if (response) {
              if (response.data.msg == 'Email Template Deleted Successfully.') {
                _this5.applyEmailTemplatesFilter(false);
              }
            }
          });
        }
      });
    },
    emailTemplateFiltered: function emailTemplateFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.emailTemplatesMeta.totalRows = filteredItems.length;
      this.emailTemplatesMeta.currentPage = 1;
    }
  }
});

/***/ }),

/***/ 5:
/*!***********************************************************!*\
  !*** multi ./resources/views/admin/EmailTemplates/vue.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /var/www/html/Paybill/resources/views/admin/EmailTemplates/vue.js */"./resources/views/admin/EmailTemplates/vue.js");


/***/ })

/******/ });