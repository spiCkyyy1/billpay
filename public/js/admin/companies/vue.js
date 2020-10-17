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
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/views/admin/companies/vue.js":
/*!************************************************!*\
  !*** ./resources/views/admin/companies/vue.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

new Vue({
  el: '#companies_container',
  data: {
    dataLoaded: false,
    isBusy: false,
    processing: false,
    fullscreen: false,
    timer: "",
    fields: [{
      key: 'id',
      label: 'ID'
    }, 'name', {
      key: 'category_id',
      label: 'Category'
    }, 'country', 'state', 'city', {
      key: 'zip_code',
      label: 'Zip Code'
    }, 'email', {
      key: 'paypal_id',
      label: 'Paypal ID'
    }, 'status', 'Actions'],
    getCompaniesUrl: App_url + '/all',
    deleteCompanyUrl: App_url + '/delete',
    approveCompanyUrl: App_url + '/approve',
    disapproveCompanyUrl: App_url + '/disapprove',
    companies: [],
    companiesTable: {
      searchQuery: '',
      searching: false
    },
    orderBy: 'DESC',
    companiesMeta: {}
  },
  mounted: function mounted() {
    this.applyCompaniesFilter();
  },
  watch: {
    'companiesMeta.current_page': function companiesMetaCurrent_page(val) {
      this.loadCompaniesPaginatedData();
    }
  },
  methods: {
    loadCompaniesPaginatedData: function loadCompaniesPaginatedData() {
      this.applyCompaniesFilter(this.getCompaniesUrl + '?page=' + this.companiesMeta.current_page);
    },
    getOrderByResult: function getOrderByResult(orderBy) {
      this.orderBy = orderBy;
      this.applyCompaniesFilter(false);
    },
    resetFilter: function resetFilter() {
      this.companiesTable.searchQuery = "";
      this.orderBy = 'DESC';
      this.applyCompaniesFilter();
    },
    applyCompaniesFilter: function applyCompaniesFilter() {
      var _this = this;

      var url = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
      this.processing = true;
      this.isBusy = true;

      if (url == false) {
        url = this.getCompaniesUrl;
      }

      axios.post(url, {
        "SearchQuery": this.companiesTable.searchQuery,
        orderBy: this.orderBy
      }).then(function (response) {
        if (response) {
          if (response.data.msg == 'Success') {
            _this.companies = response.data.data;
            _this.companiesMeta = response.data.meta;
            _this.processing = false;
            _this.isBusy = false;
          }
        }
      })["catch"](function (error) {
        _this.processing = false;
        _this.isBusy = false;
      });
    },
    approveCompany: function approveCompany(companyId) {
      var _this2 = this;

      axios.post(this.approveCompanyUrl, {
        companyId: companyId
      }).then(function (response) {
        console.log(response);

        if (response) {
          if (response.data.msg == 'Success') {
            Swal.fire('Success! ', 'Company Approved Successfully!', 'success');

            _this2.applyCompaniesFilter(false);
          }

          if (response.data.code == 219) {
            Swal.fire('Sorry!', response.data.msg, 'error');
          }
        }
      });
    },
    disapproveCompany: function disapproveCompany(companyID) {
      var _this3 = this;

      this.processing = true;
      axios.post(this.disapproveCompanyUrl, {
        companyID: companyID
      }).then(function (response) {
        if (response) {
          _this3.processing = false;

          if (response.data.msg == 'Success') {
            Swal.fire('Success! ', 'Company Disapproved Successfully!', 'success');

            _this3.applyCompaniesFilter(false);
          }
        }
      });
    },
    deleteCompany: function deleteCompany(companyId) {
      var _this4 = this;

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
          axios.post(_this4.deleteCompanyUrl, {
            id: companyId
          }).then(function (response) {
            if (response) {
              if (response.data.msg == 'Success') {
                Swal.fire('Success! ', 'Company Removed Successfully!', 'success');

                _this4.applyCompaniesFilter(false);
              }
            }
          });
        }
      });
    },
    companiesFiltered: function companiesFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.companiesMeta.totalRows = filteredItems.length;
      this.companiesMeta.currentPage = 1;
    }
  }
});

/***/ }),

/***/ 4:
/*!******************************************************!*\
  !*** multi ./resources/views/admin/companies/vue.js ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /var/www/html/Paybill/resources/views/admin/companies/vue.js */"./resources/views/admin/companies/vue.js");


/***/ })

/******/ });