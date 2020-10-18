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
/******/ 	return __webpack_require__(__webpack_require__.s = 8);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/views/admin/transactions/vue.js":
/*!***************************************************!*\
  !*** ./resources/views/admin/transactions/vue.js ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

new Vue({
  el: '#transactions_container',
  data: {
    dataLoaded: false,
    isBusy: false,
    processing: false,
    fullscreen: false,
    timer: "",
    fields: [{
      key: 'id',
      label: 'ID'
    }, {
      key: 'payment_id',
      label: 'Payment ID'
    }, 'payment_status', {
      key: 'payer_id',
      label: 'Payer ID'
    }, {
      key: 'payer_email',
      label: 'Payer Email'
    }, {
      key: 'payer_name',
      label: 'Payer Name'
    }, {
      key: 'payer_country_code',
      label: 'Payer Country Code'
    }, {
      key: 'transaction_amount',
      label: 'Transaction Amount'
    }, {
      key: 'transaction_currency',
      label: 'Transaction Currency'
    }, 'merchant_id', 'merchant_email', 'commission', {
      key: 'transaction_create_time',
      label: 'Transaction Created Time'
    }, {
      key: 'transaction_update_time',
      label: 'Transaction Updated Time'
    }],
    getTransactionsUrl: App_url + '/all',
    transactions: [],
    transactionTable: {
      searchQuery: '',
      searching: false
    },
    orderBy: 'DESC',
    transactionsMeta: {},
    commissionFun: 'Add',
    commission: '',
    commissionId: '',
    getCommissionUrl: App_url + '/commission',
    updateCommissionUrl: App_url + '/update/commission'
  },
  mounted: function mounted() {
    this.applyFilter();
  },
  watch: {
    'transactionsMeta.current_page': function transactionsMetaCurrent_page(val) {
      this.loadCompaniesPaginatedData();
    }
  },
  methods: {
    loadCompaniesPaginatedData: function loadCompaniesPaginatedData() {
      this.applyFilter(this.getTransactionsUrl + '?page=' + this.transactionsMeta.current_page);
    },
    getOrderByResult: function getOrderByResult(orderBy) {
      this.orderBy = orderBy;
      this.applyFilter(false);
    },
    resetFilter: function resetFilter() {
      this.transactionTable.searchQuery = "";
      this.orderBy = 'DESC';
      this.applyFilter();
    },
    showCommissionModal: function showCommissionModal() {
      var _this = this;

      $("#commissionModal").modal('show');
      axios.get(this.getCommissionUrl).then(function (response) {
        if (response.data.msg == 'Success') {
          if (response.data.data) {
            _this.commission = response.data.data.value;
            _this.commissionId = response.data.data.id;
          }
        }
      });
    },
    addCommission: function addCommission() {
      var _this2 = this;

      axios.post(this.updateCommissionUrl, {
        id: this.commissionId,
        value: this.commission
      }).then(function (response) {
        if (response.data.msg == 'Commission Set Successfully!') {
          $("#commissionModal").modal('hide');
          Swal.fire('Success!', response.data.msg, 'success');

          _this2.applyFilter();
        } else {
          Swal.fire('Sorry!', 'Something went wrong', 'error');
        }
      })["catch"](function (error) {
        console.log(error);
        Swal.fire('Sorry!', 'Something went wrong', 'error');
      });
    },
    applyFilter: function applyFilter() {
      var _this3 = this;

      var url = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
      this.processing = true;
      this.isBusy = true;

      if (url == false) {
        url = this.getTransactionsUrl;
      }

      axios.post(url, {
        "SearchQuery": this.transactionTable.searchQuery,
        orderBy: this.orderBy
      }).then(function (response) {
        if (response) {
          if (response.data.msg == 'Success') {
            _this3.transactions = response.data.data;
            _this3.transactionsMeta = response.data.meta;
            _this3.processing = false;
            _this3.isBusy = false;
          }
        }
      })["catch"](function (error) {
        _this3.processing = false;
        _this3.isBusy = false;
      });
    },
    transactionsFiltered: function transactionsFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.transactionsMeta.totalRows = filteredItems.length;
      this.transactionsMeta.currentPage = 1;
    }
  }
});

/***/ }),

/***/ 8:
/*!*********************************************************!*\
  !*** multi ./resources/views/admin/transactions/vue.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /var/www/html/Paybill/resources/views/admin/transactions/vue.js */"./resources/views/admin/transactions/vue.js");


/***/ })

/******/ });