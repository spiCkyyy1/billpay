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
/******/ 	return __webpack_require__(__webpack_require__.s = 6);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/views/admin/permissions/vue.js":
/*!**************************************************!*\
  !*** ./resources/views/admin/permissions/vue.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

new Vue({
  el: '#permissions_container',
  data: {
    dataLoaded: false,
    isBusy: false,
    fullscreen: false,
    permissionTable: {
      searchQuery: '',
      searching: false
    },
    orderBy: 'DESC',
    fields: [{
      key: 'id',
      label: 'ID'
    }, 'name', 'Actions'],
    permissionName: '',
    permissionId: '',
    editPermissionName: '',
    getPermissionsUrl: App_url + '/all',
    savePermissionUrl: App_url + '/create',
    deletePermissionUrl: App_url + '/delete',
    editPermissionUrl: App_url + '/get',
    updatePermissionUrl: App_url + '/update',
    permissions: [],
    editAlreadySelectedPermissions: [],
    permissionErrors: [],
    permissionSuccess: '',
    permissionMeta: {},
    timer: ""
  },
  mounted: function mounted() {
    this.applyPermissionFilter(false);
  },
  watch: {
    'permissionMeta.current_page': function permissionMetaCurrent_page(val) {
      this.loadPermissionPaginatedData();
    },
    "permissionTable.searchQuery": function permissionTableSearchQuery(val) {
      this.applyPermissionFilter(false);
    }
  },
  methods: {
    toggle: function toggle() {
      this.$refs['fullscreen'].toggle();
    },
    fullscreenChange: function fullscreenChange(fullscreen) {
      this.fullscreen = fullscreen;
    },
    loadPermissionPaginatedData: function loadPermissionPaginatedData() {
      this.applyPermissionFilter(this.getPermissionsUrl + '?page=' + this.permissionMeta.current_page);
    },
    getOrderByResult: function getOrderByResult(orderBy) {
      this.orderBy = orderBy;
      this.applyPermissionFilter(false);
    },
    applyPermissionFilter: function applyPermissionFilter() {
      var _this = this;

      var url = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
      // $('.loading').show();
      this.permissionTable.searching = true;
      this.dataLoaded = false;
      this.isBusy = true;

      if (url == false) {
        url = this.getPermissionsUrl;
      }

      axios.post(url, {
        searchQuery: this.permissionTable.searchQuery,
        orderBy: this.orderBy
      }).then(function (response) {
        if (response) {
          if (response.data.msg == 'Success') {
            _this.permissions = response.data.data;
            _this.permissionMeta = response.data.meta; // $('.loading').hide();

            _this.permissionTable.searching = false;
            _this.dataLoaded = true;
            _this.isBusy = false;
          }
        }
      })["catch"](function (error) {
        $('.loading').hide();
        _this.isBusy = false;
      });
    },
    showAddModal: function showAddModal() {
      $("#addPermissionsModal").modal('show');
      this.permissionSuccess = '';
      this.permissionErrors = [];
    },
    savePermission: function savePermission() {
      var _this2 = this;

      axios.post(this.savePermissionUrl, {
        permissionName: this.permissionName
      }).then(function (response) {
        if (response) {
          if (response.data.code == 219) {
            _this2.permissionErrors = [];
            _this2.permissionErrors = response.data.data;
          }

          if (response.data.msg == 'Permission created successfully.') {
            _this2.applyPermissionFilter(false);

            _this2.permissionErrors = [];
            _this2.permissionName = '';
            _this2.permissionSuccess = '';
            _this2.permissionSuccess = response.data.msg;
            _this2.editAlreadySelectedPermissions = [];
            setTimeout(function () {
              $("#addPermissionsModal").modal('hide');
            }, 1000);
          }
        }
      })["catch"](function (error) {
        return console.log(error);
      });
    },
    editPermission: function editPermission(permissionId) {
      var _this3 = this;

      this.permissionErrors = [];
      this.editAlreadySelectedPermissions = [];
      this.permissionId = permissionId;
      this.permissionSuccess = '';
      axios.post(this.editPermissionUrl, {
        permissionId: permissionId
      }).then(function (response) {
        if (response) {
          if (response.data.msg == 'Success') {
            $("#EditPermissionsModal").modal('show');
            _this3.editPermissionName = response.data.data.name;
            _this3.permissionSuccess = '';
          }
        }
      });
    },
    updatePermission: function updatePermission() {
      var _this4 = this;

      axios.post(this.updatePermissionUrl, {
        permissionName: this.editPermissionName,
        permissionId: this.permissionId
      }).then(function (response) {
        if (response) {
          if (response.data.code == 219) {
            _this4.permissionErrors = [];
            _this4.permissionErrors = response.data.data;
          }

          if (response.data.msg == 'Permission updated successfully.') {
            _this4.applyPermissionFilter(false);

            _this4.permissionErrors = [];
            _this4.permissionId = ''; // this.permissionSuccess = '';
            // this.permissionSuccess = response.data.msg;

            $("#EditPermissionsModal").modal('hide'); // setTimeout(function () {
            // this.permissionSuccess = '';
            // }, 1000);
          }
        }
      });
    },
    deletePermission: function deletePermission(permissionId) {
      var _this5 = this;

      axios.post(this.deletePermissionUrl, {
        permissionId: permissionId
      }).then(function (response) {
        if (response) {
          if (response.data.code == 200) {
            _this5.applyPermissionFilter(false);
          }
        }
      })["catch"](function (error) {
        console.log(error);
      });
    },
    Filtered: function Filtered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.permissionMeta.totalRows = filteredItems.length;
      this.permissionMeta.currentPage = 1;
    }
  }
});

/***/ }),

/***/ 6:
/*!********************************************************!*\
  !*** multi ./resources/views/admin/permissions/vue.js ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /var/www/html/Paybill/resources/views/admin/permissions/vue.js */"./resources/views/admin/permissions/vue.js");


/***/ })

/******/ });