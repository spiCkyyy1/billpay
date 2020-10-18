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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/views/admin/users/vue.js":
/*!********************************************!*\
  !*** ./resources/views/admin/users/vue.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

new Vue({
  el: '#users_container',
  data: {
    dataLoaded: false,
    isBusy: false,
    processing: false,
    fullscreen: false,
    timer: "",
    fields: [{
      key: 'id',
      label: 'ID'
    }, 'name', 'email', 'Roles', 'Actions'],
    getUsersUrl: App_url + '/all',
    createUserUrl: App_url + '/create',
    deleteUserUrl: App_url + '/delete',
    editUserUrl: App_url + '/get',
    updateUserUrl: App_url + '/update',
    getRolesUrl: App_url + '/roles/all',
    userId: '',
    userName: '',
    userEmail: '',
    userPassword: '',
    userConfirmPw: '',
    errorMessages: [],
    errorMessage: '',
    successMessage: '',
    users: [],
    roles: [],
    selectdRoles: [],
    alreadySelectedRoles: [],
    usersTable: {
      searchQuery: '',
      searching: false
    },
    orderBy: 'DESC',
    userMeta: {}
  },
  mounted: function mounted() {
    this.applyUserFilter();
    this.getRoles();
  },
  watch: {
    'userMeta.current_page': function userMetaCurrent_page(val) {
      this.loadusersPaginatedData();
    }
  },
  methods: {
    toggle: function toggle() {
      this.$refs['fullscreen'].toggle();
    },
    fullscreenChange: function fullscreenChange(fullscreen) {
      this.fullscreen = fullscreen;
    },
    loadusersPaginatedData: function loadusersPaginatedData() {
      this.applyUserFilter(this.getUsersUrl + '?page=' + this.userMeta.current_page);
    },
    getOrderByResult: function getOrderByResult(orderBy) {
      this.orderBy = orderBy;
      this.applyUserFilter(false);
    },
    resetFilter: function resetFilter() {
      this.usersTable.searchQuery = "";
      this.applyUserFilter();
    },
    applyUserFilter: function applyUserFilter() {
      var _this = this;

      var url = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
      this.processing = true;
      this.isBusy = true;

      if (url == false) {
        url = this.getUsersUrl;
      }

      axios.post(url, {
        "SearchQuery": this.usersTable.searchQuery,
        orderBy: this.orderBy
      }).then(function (response) {
        if (response) {
          if (response.data.msg == 'Success') {
            _this.users = response.data.data;
            _this.userMeta = response.data.meta;
            _this.processing = false;
            _this.isBusy = false;
          }
        }
      })["catch"](function (error) {
        _this.processing = false;
        _this.isBusy = false;
      });
    },
    getRoles: function getRoles() {
      var _this2 = this;

      axios.get(this.getRolesUrl).then(function (response) {
        if (response) {
          _this2.roles = response.data.data;
        }
      });
    },
    showAddModal: function showAddModal() {
      $("#addUserModal").modal('show');
      this.userName = '';
      this.userEmail = '';
      this.userPassword = '';
      this.userConfirmPw = '';
      this.selectdRoles = [];
      this.successMessage = '';
      this.errorMessage = '';
      this.errorMessages = [];
    },
    createUser: function createUser() {
      var _this3 = this;

      this.processing = true;
      axios.post(this.createUserUrl, {
        name: this.userName,
        email: this.userEmail,
        password: this.userPassword,
        password_confirmation: this.userConfirmPw,
        selectdRoles: this.selectdRoles
      }).then(function (response) {
        if (response) {
          _this3.processing = false;

          if (response.data.msg == 'User created successfully!') {
            _this3.errorMessages = [];
            _this3.successMessage = '';
            _this3.successMessage = response.data.msg;
            _this3.userName = '';
            _this3.userEmail = '';
            _this3.userPassword = '';
            _this3.userConfirmPw = '';
            _this3.selectdRoles = [];

            _this3.applyUserFilter(false);

            setTimeout(function () {
              this.successMessage = '';
              $("#addUserModal").modal('hide');
            }, 1000);
          }

          if (response.data.code == 219) {
            _this3.errorMessages = [];
            _this3.errorMessages = response.data.data;
          }
        }
      });
    },
    editUser: function editUser(userId) {
      var _this4 = this;

      this.userId = userId;
      this.errorMessages = [];
      axios.post(this.editUserUrl, {
        userId: userId
      }).then(function (response) {
        if (response) {
          if (response.data.msg == 'Success') {
            _this4.userName = response.data.userWithRole.name;
            _this4.userEmail = response.data.userWithRole.email;
            _this4.userPassword = '';
            _this4.userConfirmPw = '';
            _this4.successMessage = '';
            _this4.selectdRoles = response.data.userWithRole.roles;
            $("#editUserModal").modal('show');
            _this4.alreadySelectedRoles = response.data.roles;
          }
        }
      });
    },
    updateUser: function updateUser() {
      var _this5 = this;

      this.processing = true;
      axios.post(this.updateUserUrl, {
        userId: this.userId,
        name: this.userName,
        email: this.userEmail,
        password: this.userPassword,
        password_confirmation: this.userConfirmPw,
        selectdRoles: this.selectdRoles
      }).then(function (response) {
        if (response) {
          _this5.processing = false;

          if (response.data.msg == 'User updated successfully.') {
            _this5.errorMessages = [];
            _this5.successMessage = '';
            _this5.successMessage = response.data.msg;
            _this5.userName = '';
            _this5.userEmail = '';
            _this5.userPassword = '';
            _this5.userConfirmPw = '';
            _this5.selectdRoles = [];

            _this5.applyUserFilter(false);

            setTimeout(function () {
              this.successMessage = '';
              $("#editUserModal").modal('hide');
            }, 1000);
          }

          if (response.data.code == 219) {
            _this5.errorMessages = [];
            _this5.errorMessages = response.data.data;
          }
        }
      });
    },
    deleteUser: function deleteUser(userId) {
      var _this6 = this;

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
          axios.post(_this6.deleteUserUrl, {
            userId: userId
          }).then(function (response) {
            if (response) {
              if (response.data.msg == 'User removed successfully.') {
                _this6.applyUserFilter(false);
              }
            }
          });
        }
      });
    },
    userFiltered: function userFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.userMeta.totalRows = filteredItems.length;
      this.userMeta.currentPage = 1;
    }
  }
});

/***/ }),

/***/ 2:
/*!**************************************************!*\
  !*** multi ./resources/views/admin/users/vue.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /var/www/html/Paybill/resources/views/admin/users/vue.js */"./resources/views/admin/users/vue.js");


/***/ })

/******/ });