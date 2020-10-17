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
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/views/admin/categories/vue.js":
/*!*************************************************!*\
  !*** ./resources/views/admin/categories/vue.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

new Vue({
  el: '#categories_container',
  data: {
    dataLoaded: false,
    isBusy: false,
    processing: false,
    fullscreen: false,
    timer: "",
    fields: [{
      key: 'id',
      label: 'ID'
    }, 'name', 'slug', 'status', 'Actions'],
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
      searching: false
    },
    orderBy: 'DESC',
    categoriesMeta: {}
  },
  mounted: function mounted() {
    this.applyCategoriesFilter();
  },
  watch: {
    'categoriesMeta.current_page': function categoriesMetaCurrent_page(val) {
      this.loadCategoriesPaginatedData();
    },
    'categoryName': function categoryName(val) {
      this.categorySlug = this.sanitizeTitle(val);
    }
  },
  methods: {
    loadCategoriesPaginatedData: function loadCategoriesPaginatedData() {
      this.applyCategoriesFilter(this.getCategoriesUrl + '?page=' + this.categoriesMeta.current_page);
    },
    getOrderByResult: function getOrderByResult(orderBy) {
      this.orderBy = orderBy;
      this.applyCategoriesFilter(false);
    },
    sanitizeTitle: function sanitizeTitle(str) {
      var $slug = '';
      var trimmed = $.trim(str);
      $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').replace(/-+/g, '-').replace(/^-|-$/g, '');
      return $slug.toLowerCase();
    },
    resetFilter: function resetFilter() {
      this.categoriesTable.searchQuery = "";
      this.orderBy = 'DESC';
      this.applyCategoriesFilter();
    },
    applyCategoriesFilter: function applyCategoriesFilter() {
      var _this = this;

      var url = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
      this.processing = true;
      this.isBusy = true;

      if (url == false) {
        url = this.getCategoriesUrl;
      }

      axios.post(url, {
        "SearchQuery": this.categoriesMeta.searchQuery,
        orderBy: this.orderBy
      }).then(function (response) {
        if (response) {
          if (response.data.msg == 'Success') {
            _this.categories = response.data.data;
            _this.categoriesMeta = response.data.meta;
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
      $("#addCategoryModal").modal('show');
      this.categoryName = '';
      this.categorySlug = '';
      this.categoryStatus = 'enabled';
      this.successMessage = '';
      this.errorMessage = '';
      this.errorMessages = [];
    },
    createCategory: function createCategory() {
      var _this2 = this;

      this.processing = true;
      axios.post(this.createCategoryUrl, {
        name: this.categoryName,
        slug: this.categorySlug,
        status: this.categoryStatus
      }).then(function (response) {
        if (response) {
          _this2.processing = false;

          if (response.data.msg == 'Category Created Successfully.') {
            var context = _this2;
            _this2.errorMessages = [];
            _this2.successMessage = '';
            _this2.successMessage = response.data.msg;
            _this2.categoryName = '';
            _this2.categorySlug = '';
            _this2.categoryStatus = 'enabled';

            _this2.applyCategoriesFilter(false);

            setTimeout(function () {
              context.successMessage = '';
              $("#addCategoryModal").modal('hide');
            }, 1000);
          }

          if (response.data.code == 219) {
            _this2.errorMessages = [];
            _this2.errorMessages = response.data.data;
            console.log(_this2.errorMessages);
          }
        }
      });
    },
    editCategory: function editCategory(categoryId) {
      var _this3 = this;

      this.categoryId = categoryId;
      this.errorMessages = [];
      axios.post(this.editCategoryUrl, {
        categoryId: categoryId
      }).then(function (response) {
        if (response) {
          if (response.data.msg == 'Success') {
            _this3.categoryName = response.data.data.name;
            _this3.categorySlug = response.data.data.slug;
            _this3.categoryStatus = response.data.data.status;
            _this3.successMessage = '';
            $("#editCategoryModal").modal('show');
          }
        }
      });
    },
    updateCategory: function updateCategory() {
      var _this4 = this;

      this.processing = true;
      axios.post(this.updateCategoryUrl, {
        id: this.categoryId,
        name: this.categoryName,
        slug: this.categorySlug,
        status: this.categoryStatus
      }).then(function (response) {
        if (response) {
          _this4.processing = false;

          if (response.data.msg == 'Category Updated Successfully.') {
            var context = _this4;
            _this4.errorMessages = [];
            _this4.successMessage = '';
            _this4.successMessage = response.data.msg;
            _this4.categoryName = '';
            _this4.categorySlug = '';
            _this4.categoryStatus = 'enabled';

            _this4.applyCategoriesFilter(false);

            setTimeout(function () {
              context.successMessage = '';
              $("#editCategoryModal").modal('hide');
            }, 1000);
          }

          if (response.data.code == 219) {
            _this4.errorMessages = [];
            _this4.errorMessages = response.data.data;
          }
        }
      });
    },
    deleteCategory: function deleteCategory(categoryId) {
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
          axios.post(_this5.deleteCategoryUrl, {
            id: categoryId
          }).then(function (response) {
            if (response) {
              if (response.data.msg == 'Category Deleted Successfully.') {
                _this5.applyCategoriesFilter(false);
              }
            }
          });
        }
      });
    },
    categoriesFiltered: function categoriesFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.categoriesMeta.totalRows = filteredItems.length;
      this.categoriesMeta.currentPage = 1;
    }
  }
});

/***/ }),

/***/ 3:
/*!*******************************************************!*\
  !*** multi ./resources/views/admin/categories/vue.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /var/www/html/Paybill/resources/views/admin/categories/vue.js */"./resources/views/admin/categories/vue.js");


/***/ })

/******/ });