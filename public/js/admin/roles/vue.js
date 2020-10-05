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
/******/ 	return __webpack_require__(__webpack_require__.s = 7);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/views/admin/roles/vue.js":
/*!********************************************!*\
  !*** ./resources/views/admin/roles/vue.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

new Vue({
  el: '#roles_container',
  data: {
    dataLoaded: false,
    isBusy: false,
    fullscreen: false,
    rolesTable: {
      searchQuery: '',
      searching: false
    },
    orderBy: 'DESC',
    fields: [{
      key: 'id',
      label: 'ID'
    }, 'name', 'permissions', 'Actions'],
    roleName: '',
    roleId: '',
    editRoleName: '',
    getRolesUrl: App_url + '/all',
    saveRoleUrl: App_url + '/create',
    editRoleUrl: App_url + '/get',
    updateRoleUrl: App_url + '/update',
    deleteRoleUrl: App_url + '/delete',
    getPermissionsUrl: App_url + '/permissions/all',
    roles: [],
    permissions: [],
    roleErrors: [],
    roleError: '',
    roleSuccessMessage: '',
    checkedPermissions: [],
    editAlreadySelectedPermissions: [],
    rolesMeta: {}
  },
  mounted: function mounted() {
    this.getPermissions();
    this.applyRolesFilter(false);
  },
  watch: {
    'rolesMeta.current_page': function rolesMetaCurrent_page(val) {
      this.loadrolesPaginatedData();
    }
  },
  methods: {
    toggle: function toggle() {
      this.$refs['fullscreen'].toggle();
    },
    fullscreenChange: function fullscreenChange(fullscreen) {
      this.fullscreen = fullscreen;
    },
    loadrolesPaginatedData: function loadrolesPaginatedData() {
      this.applyRolesFilter(this.getRolesUrl + '?page=' + this.rolesMeta.current_page);
    },
    getOrderByResult: function getOrderByResult(orderBy) {
      this.orderBy = orderBy;
      this.applyRolesFilter(false);
    },
    applyRolesFilter: function applyRolesFilter() {
      var _this = this;

      var url = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
      this.isBusy = true;

      if (url == false) {
        url = this.getRolesUrl;
      }

      axios.post(url, {
        search: this.rolesTable.searchQuery,
        orderBy: this.orderBy
      }).then(function (response) {
        if (response) {
          if (response.data.msg == 'Success') {
            _this.roles = response.data.data;
            _this.rolesMeta = response.data.meta;
            _this.isBusy = false;
          }
        }
      })["catch"](function (error) {
        console.log(error);
        _this.isBusy = false;
      });
    },
    getPermissions: function getPermissions() {
      var _this2 = this;

      axios.get(this.getPermissionsUrl).then(function (response) {
        if (response) {
          if (response.data.code == 200) {
            _this2.permissions = response.data.data;
          }
        }
      });
    },
    showAddModal: function showAddModal() {
      $("#addRoleModal").modal('show');
      this.roleSuccessMessage = '';
      this.roleName = '';
      this.checkedPermissions = [];
      this.editAlreadySelectedPermissions = [];
      this.roleErrors = [];
    },
    saveRole: function saveRole() {
      var _this3 = this;

      this.roleErrors = [];
      this.roleError = '';
      this.roleSuccessMessage = '';
      axios.post(this.saveRoleUrl, {
        roleName: this.roleName,
        permissions: this.checkedPermissions
      }).then(function (response) {
        if (response) {
          if (response.data.code == 219) {
            _this3.roleError = response.data.msg;
          }

          if (response.data.msg == 'Role created successfully.') {
            _this3.roleSuccessMessage = response.data.msg;
            _this3.roleName = '';
            _this3.checkedPermissions = [];
            _this3.editAlreadySelectedPermissions = [];

            _this3.applyRolesFilter(false);

            setTimeout(function () {
              $("#addRoleModal").modal('hide');
            }, 1000);
          }
        }
      });
    },
    editRole: function editRole(roleId) {
      var _this4 = this;

      this.roleId = roleId;
      this.roleErrors = [];
      this.roleError = '';
      this.editAlreadySelectedPermissions = [];
      this.roleSuccessMessage = '';
      axios.post(this.editRoleUrl, {
        roleId: roleId
      }).then(function (response) {
        if (response) {
          if (response.data.msg == 'Success') {
            $("#editRoleModal").modal('show');
            _this4.editRoleName = response.data.roleWithPermission.name;
            _this4.editAlreadySelectedPermissions = response.data.permissions;
            _this4.roleSuccessMessage = '';
            _this4.roleError = '';
          }
        }
      });
    },
    updateRole: function updateRole() {
      var _this5 = this;

      this.roleErrors = [];
      this.roleError = '';
      this.roleSuccessMessage = '';
      axios.post(this.updateRoleUrl, {
        roleName: this.editRoleName,
        roleId: this.roleId,
        permissions: this.editAlreadySelectedPermissions
      }).then(function (response) {
        if (response) {
          if (response.data.code == 219) {
            _this5.roleError = response.data.msg;
          }

          if (response.data.msg == 'Role updated successfully.') {
            _this5.applyRolesFilter(false);

            _this5.roleId = '';
            _this5.roleSuccessMessage = response.data.msg;
            setTimeout(function () {
              this.editRoleName = '';
              $("#editRoleModal").modal('hide');
            }, 1000);
          }
        }
      });
    },
    deleteRole: function deleteRole(roleId) {
      var _this6 = this;

      swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then(function (result) {
        if (result.value) {
          axios.post(_this6.deleteRoleUrl, {
            roleId: roleId
          }).then(function (response) {
            if (response) {
              if (response.data.code == 200) {
                swal('Deleted!', response.data.message, 'success');

                _this6.applyRolesFilter(false);
              }
            }
          })["catch"](function (error) {
            swal('Sorry!', error.response.data.message, 'warning');
          });
        }
      });
    },
    Filtered: function Filtered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.rolesMeta.totalRows = filteredItems.length;
      this.rolesMeta.currentPage = 1;
    }
  }
});

/***/ }),

/***/ 7:
/*!**************************************************!*\
  !*** multi ./resources/views/admin/roles/vue.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /var/www/html/Paybill/resources/views/admin/roles/vue.js */"./resources/views/admin/roles/vue.js");


/***/ })

/******/ });