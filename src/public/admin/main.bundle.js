webpackJsonp([0,3],{

/***/ 1049:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(449);


/***/ }),

/***/ 12:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__extended_http_service__ = __webpack_require__(73);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__angular_http__ = __webpack_require__(37);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__ = __webpack_require__(31);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__environments_environment__ = __webpack_require__(42);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5_rxjs_add_operator_map__ = __webpack_require__(63);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5_rxjs_add_operator_map___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_5_rxjs_add_operator_map__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6_rxjs_add_operator_catch__ = __webpack_require__(62);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6_rxjs_add_operator_catch___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_6_rxjs_add_operator_catch__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ApiService; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};







var ApiService = (function () {
    function ApiService(http) {
        this.http = http;
        this.apiUrl = __WEBPACK_IMPORTED_MODULE_4__environments_environment__["a" /* environment */].domain_url + "api/";
    }
    ApiService.prototype.getAll = function (entity) {
        return this.http.get(this.apiUrl + entity)
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiService.prototype.get = function (entity, id) {
        return this.http.get(this.apiUrl + entity + '/' + id)
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiService.prototype.create = function (entity, data) {
        var headers = new __WEBPACK_IMPORTED_MODULE_2__angular_http__["Headers"]({ 'Content-Type': 'application/json' });
        var options = new __WEBPACK_IMPORTED_MODULE_2__angular_http__["RequestOptions"]({ headers: headers });
        return this.http.post(this.apiUrl + entity + '/', data, options)
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiService.prototype.update = function (entity, id, data) {
        var headers = new __WEBPACK_IMPORTED_MODULE_2__angular_http__["Headers"]({ 'Content-Type': 'application/json' });
        var options = new __WEBPACK_IMPORTED_MODULE_2__angular_http__["RequestOptions"]({ headers: headers });
        return this.http.post(this.apiUrl + entity + '/' + id, data, options)
            .map(function (res) { res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiService.prototype.delete = function (entity, id) {
        return this.http.delete(this.apiUrl + entity + '/delete/' + id)
            .map(function (res) { })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiService = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_1__angular_core__["Injectable"])(), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_0__extended_http_service__["a" /* ExtendedHttpService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_0__extended_http_service__["a" /* ExtendedHttpService */]) === 'function' && _a) || Object])
    ], ApiService);
    return ApiService;
    var _a;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/api.service.js.map

/***/ }),

/***/ 131:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_http__ = __webpack_require__(37);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_rxjs_Rx__ = __webpack_require__(31);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_rxjs_Rx___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2_rxjs_Rx__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__environments_environment__ = __webpack_require__(42);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__extended_http_service__ = __webpack_require__(73);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5_rxjs_add_operator_map__ = __webpack_require__(63);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5_rxjs_add_operator_map___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_5_rxjs_add_operator_map__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6_rxjs_add_operator_catch__ = __webpack_require__(62);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6_rxjs_add_operator_catch___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_6_rxjs_add_operator_catch__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ApiLocationService; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};







var ApiLocationService = (function () {
    function ApiLocationService(http) {
        this.http = http;
        this.apiUrl = __WEBPACK_IMPORTED_MODULE_3__environments_environment__["a" /* environment */].domain_url + "api/locations/";
    }
    ApiLocationService.prototype.getAll = function () {
        return this.http.get(this.apiUrl + 'all')
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_2_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiLocationService.prototype.get = function (id) {
        return this.http.get(this.apiUrl + id)
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_2_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiLocationService.prototype.create = function (data) {
        var headers = new __WEBPACK_IMPORTED_MODULE_1__angular_http__["Headers"]({ 'Content-Type': 'application/json' });
        var options = new __WEBPACK_IMPORTED_MODULE_1__angular_http__["RequestOptions"]({ headers: headers });
        return this.http.post(this.apiUrl, data, options)
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_2_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiLocationService.prototype.update = function (id, data) {
        var headers = new __WEBPACK_IMPORTED_MODULE_1__angular_http__["Headers"]({ 'Content-Type': 'application/json' });
        var options = new __WEBPACK_IMPORTED_MODULE_1__angular_http__["RequestOptions"]({ headers: headers });
        return this.http.post(this.apiUrl + id, data, options)
            .map(function (res) { res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_2_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiLocationService.prototype.delete = function (id) {
        return this.http.delete(this.apiUrl + 'delete/' + id)
            .map(function (res) { })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_2_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiLocationService = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Injectable"])(), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_4__extended_http_service__["a" /* ExtendedHttpService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_4__extended_http_service__["a" /* ExtendedHttpService */]) === 'function' && _a) || Object])
    ], ApiLocationService);
    return ApiLocationService;
    var _a;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/api.location.service.js.map

/***/ }),

/***/ 132:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__extended_http_service__ = __webpack_require__(73);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__angular_http__ = __webpack_require__(37);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__ = __webpack_require__(31);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__environments_environment__ = __webpack_require__(42);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5_rxjs_add_operator_map__ = __webpack_require__(63);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5_rxjs_add_operator_map___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_5_rxjs_add_operator_map__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6_rxjs_add_operator_catch__ = __webpack_require__(62);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6_rxjs_add_operator_catch___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_6_rxjs_add_operator_catch__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7__authentication_service__ = __webpack_require__(87);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ApiReferenceService; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};








var ApiReferenceService = (function () {
    function ApiReferenceService(http, authService, simplehttp) {
        this.http = http;
        this.authService = authService;
        this.simplehttp = simplehttp;
        this.apiUrl = __WEBPACK_IMPORTED_MODULE_4__environments_environment__["a" /* environment */].domain_url + "api/references/";
    }
    Object.defineProperty(ApiReferenceService.prototype, "bearer", {
        get: function () { return "Bearer " + this.authService.token; },
        enumerable: true,
        configurable: true
    });
    ApiReferenceService.prototype.getAll = function () {
        return this.http.get(this.apiUrl + 'all')
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiReferenceService.prototype.get = function (id) {
        return this.http.get(this.apiUrl + id)
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiReferenceService.prototype.getProducts = function (id) {
        return this.http.get(this.apiUrl + id + '/products')
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiReferenceService.prototype.getManufacturers = function (id) {
        return this.http.get(this.apiUrl + id + '/manufacturers')
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiReferenceService.prototype.getImages = function (id) {
        return this.http.get(this.apiUrl + id + '/images')
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiReferenceService.prototype.create = function (data) {
        var headers = new __WEBPACK_IMPORTED_MODULE_2__angular_http__["Headers"]({ 'Content-Type': 'application/json' });
        var options = new __WEBPACK_IMPORTED_MODULE_2__angular_http__["RequestOptions"]({ headers: headers });
        return this.http.post(this.apiUrl, data, options)
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiReferenceService.prototype.update = function (id, data) {
        var headers = new __WEBPACK_IMPORTED_MODULE_2__angular_http__["Headers"]({ 'Content-Type': 'application/json' });
        var options = new __WEBPACK_IMPORTED_MODULE_2__angular_http__["RequestOptions"]({ headers: headers });
        return this.http.post(this.apiUrl + 'update/' + id, data, options)
            .map(function (res) { res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiReferenceService.prototype.delete = function (id) {
        return this.http.delete(this.apiUrl + 'delete/' + id)
            .map(function (res) { })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiReferenceService.prototype.deleteImage = function (id, data) {
        return this.http.post(this.apiUrl + 'images/delete/' + id, data)
            .map(function (res) { res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiReferenceService.prototype.getBrandReferences = function (brandId) {
        var headers = new __WEBPACK_IMPORTED_MODULE_2__angular_http__["Headers"]({ 'Content-Type': 'application/json' });
        var options = new __WEBPACK_IMPORTED_MODULE_2__angular_http__["RequestOptions"]({ headers: headers });
        return this.http.get(__WEBPACK_IMPORTED_MODULE_4__environments_environment__["a" /* environment */].domain_url + "api/brands/" + brandId + "/references", options)
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiReferenceService.prototype.createBrandReferences = function (brandId, data) {
        var uri = __WEBPACK_IMPORTED_MODULE_4__environments_environment__["a" /* environment */].domain_url + "api/brands/" + brandId + "/references";
        // Uses simple http because ExtendedHttpService couldnt submit form request
        return this.simplehttp.post(uri, data, { headers: new __WEBPACK_IMPORTED_MODULE_2__angular_http__["Headers"]({ 'Authorization': this.bearer }) })
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiReferenceService.prototype.deleteBrandReference = function (brandId, brandreferenceId) {
        var headers = new __WEBPACK_IMPORTED_MODULE_2__angular_http__["Headers"]({ 'Content-Type': 'application/json' });
        var options = new __WEBPACK_IMPORTED_MODULE_2__angular_http__["RequestOptions"]({ headers: headers });
        var uri = __WEBPACK_IMPORTED_MODULE_4__environments_environment__["a" /* environment */].domain_url + "api/brands/" + brandId + "/references/" + brandreferenceId;
        return this.http.delete(uri, options)
            .map(function (res) { return res.status === 204 ? true : false; })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiReferenceService = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_1__angular_core__["Injectable"])(), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_0__extended_http_service__["a" /* ExtendedHttpService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_0__extended_http_service__["a" /* ExtendedHttpService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_7__authentication_service__["a" /* AuthenticationService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_7__authentication_service__["a" /* AuthenticationService */]) === 'function' && _b) || Object, (typeof (_c = typeof __WEBPACK_IMPORTED_MODULE_2__angular_http__["Http"] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2__angular_http__["Http"]) === 'function' && _c) || Object])
    ], ApiReferenceService);
    return ApiReferenceService;
    var _a, _b, _c;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/api.reference.service.js.map

/***/ }),

/***/ 183:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__extended_http_service__ = __webpack_require__(73);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__angular_http__ = __webpack_require__(37);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__ = __webpack_require__(31);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__environments_environment__ = __webpack_require__(42);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5_rxjs_add_operator_map__ = __webpack_require__(63);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5_rxjs_add_operator_map___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_5_rxjs_add_operator_map__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6_rxjs_add_operator_catch__ = __webpack_require__(62);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6_rxjs_add_operator_catch___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_6_rxjs_add_operator_catch__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ApiPanelService; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};







var ApiPanelService = (function () {
    function ApiPanelService(http) {
        this.http = http;
        this.apiUrl = __WEBPACK_IMPORTED_MODULE_4__environments_environment__["a" /* environment */].domain_url + "api/panels/";
    }
    ApiPanelService.prototype.getAll = function () {
        return this.http.get(this.apiUrl + 'all')
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiPanelService.prototype.get = function (id) {
        return this.http.get(this.apiUrl + id)
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiPanelService.prototype.getFieldGroups = function (id) {
        return this.http.get(this.apiUrl + 'fieldgroups/' + id)
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiPanelService.prototype.getPanelsByPackage = function (id) {
        return this.http.get(this.apiUrl + 'package/' + id)
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiPanelService.prototype.create = function (data) {
        var headers = new __WEBPACK_IMPORTED_MODULE_2__angular_http__["Headers"]({ 'Content-Type': 'application/json' });
        var options = new __WEBPACK_IMPORTED_MODULE_2__angular_http__["RequestOptions"]({ headers: headers });
        return this.http.post(this.apiUrl, data, options)
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiPanelService.prototype.update = function (id, data) {
        var headers = new __WEBPACK_IMPORTED_MODULE_2__angular_http__["Headers"]({ 'Content-Type': 'application/json' });
        var options = new __WEBPACK_IMPORTED_MODULE_2__angular_http__["RequestOptions"]({ headers: headers });
        return this.http.post(this.apiUrl + id, data, options)
            .map(function (res) { res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiPanelService.prototype.delete = function (id) {
        return this.http.delete(this.apiUrl + 'delete/' + id)
            .map(function (res) { })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiPanelService = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_1__angular_core__["Injectable"])(), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_0__extended_http_service__["a" /* ExtendedHttpService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_0__extended_http_service__["a" /* ExtendedHttpService */]) === 'function' && _a) || Object])
    ], ApiPanelService);
    return ApiPanelService;
    var _a;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/api.panel.service.js.map

/***/ }),

/***/ 184:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__extended_http_service__ = __webpack_require__(73);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__angular_http__ = __webpack_require__(37);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__ = __webpack_require__(31);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__environments_environment__ = __webpack_require__(42);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5_rxjs_add_operator_map__ = __webpack_require__(63);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5_rxjs_add_operator_map___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_5_rxjs_add_operator_map__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6_rxjs_add_operator_catch__ = __webpack_require__(62);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6_rxjs_add_operator_catch___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_6_rxjs_add_operator_catch__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ApiProductService; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};







var ApiProductService = (function () {
    function ApiProductService(http) {
        this.http = http;
        this.apiUrl = __WEBPACK_IMPORTED_MODULE_4__environments_environment__["a" /* environment */].domain_url + "api/products/";
    }
    ApiProductService.prototype.getAll = function () {
        return this.http.get(this.apiUrl)
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiProductService.prototype.get = function (id) {
        return this.http.get(this.apiUrl + id)
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiProductService.prototype.getCategories = function (id) {
        return this.http.get(this.apiUrl + id + '/categories')
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiProductService.prototype.getReferences = function (id) {
        return this.http.get(this.apiUrl + id + '/references')
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiProductService.prototype.getImages = function (id) {
        return this.http.get(this.apiUrl + id + '/images')
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiProductService.prototype.create = function (data) {
        var headers = new __WEBPACK_IMPORTED_MODULE_2__angular_http__["Headers"]({ 'Content-Type': 'application/json' });
        var options = new __WEBPACK_IMPORTED_MODULE_2__angular_http__["RequestOptions"]({ headers: headers });
        return this.http.post(this.apiUrl, data, options)
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiProductService.prototype.update = function (id, data) {
        var headers = new __WEBPACK_IMPORTED_MODULE_2__angular_http__["Headers"]({ 'Content-Type': 'application/json' });
        var options = new __WEBPACK_IMPORTED_MODULE_2__angular_http__["RequestOptions"]({ headers: headers });
        return this.http.post(this.apiUrl + 'update/' + id, data, options)
            .map(function (res) { res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiProductService.prototype.delete = function (id) {
        return this.http.delete(this.apiUrl + 'delete/' + id)
            .map(function (res) { })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiProductService.prototype.deleteImage = function (id, data) {
        return this.http.post(this.apiUrl + 'images/delete/' + id, data)
            .map(function (res) { res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiProductService = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_1__angular_core__["Injectable"])(), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_0__extended_http_service__["a" /* ExtendedHttpService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_0__extended_http_service__["a" /* ExtendedHttpService */]) === 'function' && _a) || Object])
    ], ApiProductService);
    return ApiProductService;
    var _a;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/api.product.service.js.map

/***/ }),

/***/ 376:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__logout_logout_component__ = __webpack_require__(577);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__service_auth_guard__ = __webpack_require__(378);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__angular_router__ = __webpack_require__(17);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__app_component__ = __webpack_require__(377);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__advertisements_advertisements_component__ = __webpack_require__(562);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__advertisements_advertisement_detail_component__ = __webpack_require__(561);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7__not_found_component__ = __webpack_require__(580);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_8__stores_stores_component__ = __webpack_require__(597);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_9__stores_store_detail_component__ = __webpack_require__(596);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_10__stores_store_create_component__ = __webpack_require__(595);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_11__slides_slides_component__ = __webpack_require__(594);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_12__slides_slide_detail_component__ = __webpack_require__(593);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_13__manufacturers_manufacturers_component__ = __webpack_require__(579);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_14__manufacturers_manufacturer_detail_component__ = __webpack_require__(578);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_15__categories_categories_component__ = __webpack_require__(565);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_16__categories_category_detail_component__ = __webpack_require__(566);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_17__fieldtypes_fieldtypes_component__ = __webpack_require__(572);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_18__fieldtypes_fieldtype_detail_component__ = __webpack_require__(571);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_19__fields_fields_component__ = __webpack_require__(570);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_20__fields_field_detail_component__ = __webpack_require__(569);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_21__fieldgroups_fieldgroups_component__ = __webpack_require__(568);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_22__fieldgroups_fieldgroup_detail_component__ = __webpack_require__(567);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_23__panels_panels_component__ = __webpack_require__(585);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_24__panels_panel_detail_component__ = __webpack_require__(584);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_25__packages_packages_component__ = __webpack_require__(583);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_26__packages_package_detail_component__ = __webpack_require__(582);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_27__locations_locations_component__ = __webpack_require__(575);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_28__locations_location_detail_component__ = __webpack_require__(574);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_29__registerfields_registerfields_component__ = __webpack_require__(591);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_30__registerfields_registerfield_detail_component__ = __webpack_require__(590);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_31__references_references_component__ = __webpack_require__(589);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_32__references_reference_detail_component__ = __webpack_require__(588);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_33__products_products_component__ = __webpack_require__(587);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_34__products_product_detail_component__ = __webpack_require__(586);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_35__login_login_component__ = __webpack_require__(576);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return declarations; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "b", function() { return AppRoutingModule; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};




































var appRoutes = [
    { path: 'login', component: __WEBPACK_IMPORTED_MODULE_35__login_login_component__["a" /* LoginComponent */] },
    { path: '', canActivate: [__WEBPACK_IMPORTED_MODULE_1__service_auth_guard__["a" /* AuthGuard */]], children: [
            { path: 'logout', component: __WEBPACK_IMPORTED_MODULE_0__logout_logout_component__["a" /* LogoutComponent */] },
            { path: 'advertisements', component: __WEBPACK_IMPORTED_MODULE_5__advertisements_advertisements_component__["a" /* AdvertisementsComponent */] },
            { path: 'advertisement/:id', component: __WEBPACK_IMPORTED_MODULE_6__advertisements_advertisement_detail_component__["a" /* AdvertisementDetailComponent */] },
            { path: 'stores', component: __WEBPACK_IMPORTED_MODULE_8__stores_stores_component__["a" /* StoresComponent */] },
            { path: 'store/create', component: __WEBPACK_IMPORTED_MODULE_10__stores_store_create_component__["a" /* StoreCreateComponent */] },
            { path: 'store/:id', component: __WEBPACK_IMPORTED_MODULE_9__stores_store_detail_component__["a" /* StoreDetailComponent */] },
            { path: 'slides', component: __WEBPACK_IMPORTED_MODULE_11__slides_slides_component__["a" /* SlidesComponent */] },
            { path: 'slide/:id', component: __WEBPACK_IMPORTED_MODULE_12__slides_slide_detail_component__["a" /* SlideDetailComponent */] },
            { path: 'manufacturers', component: __WEBPACK_IMPORTED_MODULE_13__manufacturers_manufacturers_component__["a" /* ManufacturersComponent */] },
            { path: 'manufacturer/:id', component: __WEBPACK_IMPORTED_MODULE_14__manufacturers_manufacturer_detail_component__["a" /* ManufacturerDetailComponent */] },
            { path: 'categories', component: __WEBPACK_IMPORTED_MODULE_15__categories_categories_component__["a" /* CategoriesComponent */] },
            { path: 'category/:id', component: __WEBPACK_IMPORTED_MODULE_16__categories_category_detail_component__["a" /* CategoryDetailComponent */] },
            { path: 'fieldtypes', component: __WEBPACK_IMPORTED_MODULE_17__fieldtypes_fieldtypes_component__["a" /* FieldtypesComponent */] },
            { path: 'fieldtype/:id', component: __WEBPACK_IMPORTED_MODULE_18__fieldtypes_fieldtype_detail_component__["a" /* FieldtypeDetailComponent */] },
            { path: 'fields', component: __WEBPACK_IMPORTED_MODULE_19__fields_fields_component__["a" /* FieldsComponent */] },
            { path: 'field/:id', component: __WEBPACK_IMPORTED_MODULE_20__fields_field_detail_component__["a" /* FieldDetailComponent */] },
            { path: 'fieldgroups', component: __WEBPACK_IMPORTED_MODULE_21__fieldgroups_fieldgroups_component__["a" /* FieldgroupsComponent */] },
            { path: 'fieldgroup/:id', component: __WEBPACK_IMPORTED_MODULE_22__fieldgroups_fieldgroup_detail_component__["a" /* FieldgroupDetailComponent */] },
            { path: 'panels', component: __WEBPACK_IMPORTED_MODULE_23__panels_panels_component__["a" /* PanelsComponent */] },
            { path: 'panel/:id', component: __WEBPACK_IMPORTED_MODULE_24__panels_panel_detail_component__["a" /* PanelDetailComponent */] },
            { path: 'packages', component: __WEBPACK_IMPORTED_MODULE_25__packages_packages_component__["a" /* PackagesComponent */] },
            { path: 'package/:id', component: __WEBPACK_IMPORTED_MODULE_26__packages_package_detail_component__["a" /* PackageDetailComponent */] },
            { path: 'locations', component: __WEBPACK_IMPORTED_MODULE_27__locations_locations_component__["a" /* LocationsComponent */] },
            { path: 'location/:id', component: __WEBPACK_IMPORTED_MODULE_28__locations_location_detail_component__["a" /* LocationDetailComponent */] },
            { path: 'registerfields', component: __WEBPACK_IMPORTED_MODULE_29__registerfields_registerfields_component__["a" /* RegisterfieldsComponent */] },
            { path: 'registerfield/:id', component: __WEBPACK_IMPORTED_MODULE_30__registerfields_registerfield_detail_component__["a" /* RegisterfieldDetailComponent */] },
            { path: 'references', component: __WEBPACK_IMPORTED_MODULE_31__references_references_component__["a" /* ReferencesComponent */] },
            { path: 'reference/:id', component: __WEBPACK_IMPORTED_MODULE_32__references_reference_detail_component__["a" /* ReferenceDetailComponent */] },
            { path: 'products', component: __WEBPACK_IMPORTED_MODULE_33__products_products_component__["a" /* ProductsComponent */] },
            { path: 'product/:id', component: __WEBPACK_IMPORTED_MODULE_34__products_product_detail_component__["a" /* ProductDetailComponent */] },
            { path: '', component: __WEBPACK_IMPORTED_MODULE_5__advertisements_advertisements_component__["a" /* AdvertisementsComponent */] },
            { path: '**', component: __WEBPACK_IMPORTED_MODULE_7__not_found_component__["a" /* PageNotFoundComponent */] }
        ]
    }
];
var declarations = [
    __WEBPACK_IMPORTED_MODULE_4__app_component__["a" /* AppComponent */],
    __WEBPACK_IMPORTED_MODULE_35__login_login_component__["a" /* LoginComponent */]
];
appRoutes[1].children.forEach(function (route) {
    declarations.push(route.component);
});
var AppRoutingModule = (function () {
    function AppRoutingModule() {
    }
    AppRoutingModule = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_2__angular_core__["NgModule"])({
            imports: [__WEBPACK_IMPORTED_MODULE_3__angular_router__["b" /* RouterModule */].forRoot(appRoutes)],
            exports: [__WEBPACK_IMPORTED_MODULE_3__angular_router__["b" /* RouterModule */]],
            providers: []
        }), 
        __metadata('design:paramtypes', [])
    ], AppRoutingModule);
    return AppRoutingModule;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/app-routing.module.js.map

/***/ }),

/***/ 377:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__service_authentication_service__ = __webpack_require__(87);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_core__ = __webpack_require__(1);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return AppComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};


var AppComponent = (function () {
    function AppComponent(authenticationService) {
        var _this = this;
        this.authenticationService = authenticationService;
        this.title = 'TopdiTop Admin';
        this.authenticationService.isLoggedIn().subscribe(function (status) {
            _this.isLoggedIn = status;
        });
    }
    AppComponent.prototype.ngOnInit = function () {
        var _this = this;
        if (this.authenticationService.tokenStillActive()) {
            this.authenticationService.check().subscribe(function (response) {
            }, function (error) {
                _this.authenticationService.logout();
            });
        }
        else {
            this.authenticationService.logout();
        }
    };
    AppComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_1__angular_core__["Component"])({
            selector: 'app-root',
            template: __webpack_require__(755),
            styles: [__webpack_require__(751)]
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_0__service_authentication_service__["a" /* AuthenticationService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_0__service_authentication_service__["a" /* AuthenticationService */]) === 'function' && _a) || Object])
    ], AppComponent);
    return AppComponent;
    var _a;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/app.component.js.map

/***/ }),

/***/ 378:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__authentication_service__ = __webpack_require__(87);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__angular_router__ = __webpack_require__(17);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return AuthGuard; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};



var AuthGuard = (function () {
    function AuthGuard(authenticationService, router) {
        this.authenticationService = authenticationService;
        this.router = router;
    }
    AuthGuard.prototype.canActivate = function (route, state) {
        var url = state.url;
        return this.checkLogin(url);
    };
    AuthGuard.prototype.checkLogin = function (url) {
        if (this.authenticationService.tokenStillActive()) {
            this.authenticationService.redirectUrl = '/';
            return true;
        }
        else {
            this.authenticationService.redirectUrl = url;
            this.router.navigate(['/login']);
            return false;
        }
    };
    AuthGuard = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_1__angular_core__["Injectable"])(), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_0__authentication_service__["a" /* AuthenticationService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_0__authentication_service__["a" /* AuthenticationService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_2__angular_router__["a" /* Router */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2__angular_router__["a" /* Router */]) === 'function' && _b) || Object])
    ], AuthGuard);
    return AuthGuard;
    var _a, _b;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/auth.guard.js.map

/***/ }),

/***/ 42:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return environment; });
var environment = {
    production: false,
    domain_url: 'http://topditop.com:8080/'
};
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/environment.js.map

/***/ }),

/***/ 448:
/***/ (function(module, exports) {

function webpackEmptyContext(req) {
	throw new Error("Cannot find module '" + req + "'.");
}
webpackEmptyContext.keys = function() { return []; };
webpackEmptyContext.resolve = webpackEmptyContext;
module.exports = webpackEmptyContext;
webpackEmptyContext.id = 448;


/***/ }),

/***/ 449:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__polyfills_ts__ = __webpack_require__(598);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_platform_browser_dynamic__ = __webpack_require__(534);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__environments_environment__ = __webpack_require__(42);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__app___ = __webpack_require__(573);





if (__WEBPACK_IMPORTED_MODULE_3__environments_environment__["a" /* environment */].production) {
    __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_2__angular_core__["enableProdMode"])();
}
__webpack_require__.i(__WEBPACK_IMPORTED_MODULE_1__angular_platform_browser_dynamic__["a" /* platformBrowserDynamic */])().bootstrapModule(__WEBPACK_IMPORTED_MODULE_4__app___["a" /* AppModule */]);
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/main.js.map

/***/ }),

/***/ 561:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__service_api_service__ = __webpack_require__(12);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__angular_router__ = __webpack_require__(17);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__angular_forms__ = __webpack_require__(27);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4_angular2_toaster__ = __webpack_require__(9);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__environments_environment__ = __webpack_require__(42);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return AdvertisementDetailComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};






var AdvertisementDetailComponent = (function () {
    function AdvertisementDetailComponent(apiService, router, route, fb, toasterService) {
        this.apiService = apiService;
        this.router = router;
        this.route = route;
        this.fb = fb;
        this.toasterService = toasterService;
        this.entity = 'adverts';
        this.disabled = false;
        this.filename_scanned_image_url_base64 = null;
        this.filename_brand_logo_url_base64 = null;
        this.filename_reference_image_url_base64 = null;
        this.domain = __WEBPACK_IMPORTED_MODULE_5__environments_environment__["a" /* environment */].domain_url;
    }
    AdvertisementDetailComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.id = this.route.snapshot.params['id'];
        if (this.id != -1) {
            this.apiService
                .get(this.entity, this.id)
                .subscribe(function (advert) {
                _this.advert = advert;
                _this.createFormGroup();
            }, function (error) {
                _this.errorMessage = error;
                _this.toasterService.pop('error', 'Error', 'Advertisement with given ID doesn`t exist!');
                _this.router.navigate(['/advertisements']);
            });
        }
        else {
            this.advert = {
                id: null,
                scanned_image_url: '',
                brand_logo_url: '',
                reference_image_url: '',
                manufacturer_id: '',
                name: ''
            };
            this.createFormGroup();
        }
        this.apiService
            .getAll('manufacturers/all')
            .subscribe(function (brands) { return _this.brands = brands; }, function (error) { return _this.errorMessage = error; });
    };
    AdvertisementDetailComponent.prototype.changeListener = function ($event) {
        this.readThis($event.target);
    };
    AdvertisementDetailComponent.prototype.readThis = function (inputValue) {
        var _this = this;
        var file = inputValue.files[0];
        var myReader = new FileReader();
        if (!inputValue.files || inputValue.files.length === 0) {
            if (inputValue.id == 'filename_scanned_image_url') {
                this.filename_scanned_image_url_base64 = null;
            }
            if (inputValue.id == 'filename_brand_logo_url') {
                this.filename_brand_logo_url_base64 = null;
            }
            if (inputValue.id == 'filename_reference_image_url') {
                this.filename_reference_image_url_base64 = null;
            }
            return;
        }
        myReader.onloadend = function (e) {
            if (inputValue.id == 'filename_scanned_image_url') {
                _this.filename_scanned_image_url_base64 = myReader.result;
                _this.advert.scanned_image_url = myReader.result;
            }
            if (inputValue.id == 'filename_brand_logo_url') {
                _this.filename_brand_logo_url_base64 = myReader.result;
                _this.advert.brand_logo_url = myReader.result;
            }
            if (inputValue.id == 'filename_reference_image_url') {
                _this.filename_reference_image_url_base64 = myReader.result;
                _this.advert.reference_image_url = myReader.result;
            }
        };
        myReader.readAsDataURL(file);
    };
    AdvertisementDetailComponent.prototype.onSubmit = function () {
        this.disabled = true;
        if (this.id != -1) {
            this.updateAdvert(this.id);
        }
        else {
            this.createAdvert();
        }
    };
    AdvertisementDetailComponent.prototype.createAdvert = function () {
        var _this = this;
        var advert = this.createDataObject();
        this.apiService.create(this.entity, advert)
            .subscribe(function (advert) {
            _this.advert = advert;
            _this.id = _this.advert.id;
            _this.updateImages();
            _this.toasterService.pop('success', 'Success', 'Advertisement created!');
            _this.disabled = false;
            _this.router.navigate(['/advertisements']);
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with creating advertisement!');
            _this.disabled = false;
            _this.router.navigate(['/advertisements']);
        });
    };
    AdvertisementDetailComponent.prototype.updateAdvert = function (id) {
        var _this = this;
        var advert = this.createDataObject();
        console.log(advert);
        this.updateImages();
        this.apiService
            .update(this.entity, this.id, advert)
            .subscribe(function (advert) {
            _this.advert = advert;
            _this.toasterService.pop('success', 'Success', 'Advertisement updated!');
            _this.router.navigate(['/advertisements']);
            _this.disabled = false;
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with updating advertisement!');
            _this.disabled = false;
            _this.router.navigate(['/advertisements']);
        });
    };
    AdvertisementDetailComponent.prototype.deleteAdvert = function (id) {
        var _this = this;
        this.disabled = true;
        this.apiService
            .delete(this.entity, id)
            .subscribe(function (advert) {
            _this.toasterService.pop('success', 'Success', 'Advertisement deleted!');
            _this.router.navigate(['/advertisements']);
            _this.disabled = false;
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with deleting advertisement!');
            _this.disabled = false;
            _this.router.navigate(['/advertisements']);
        });
    };
    AdvertisementDetailComponent.prototype.createFormGroup = function () {
        this.advertForm = this.fb.group({
            name: this.advert.name,
            manufacturer_id: this.advert.manufacturer_id
        });
    };
    AdvertisementDetailComponent.prototype.createDataObject = function () {
        var advert = {
            'manufacturer_id': this.advertForm.value.manufacturer_id,
            'name': this.advertForm.value.name
        };
        return advert;
    };
    AdvertisementDetailComponent.prototype.updateImages = function () {
        if (this.filename_brand_logo_url_base64 != null) {
            var image = {
                'base64': this.filename_brand_logo_url_base64,
                'type': 'brand_logo'
            };
            this.apiService.create(this.entity + "/" + this.id + "/images", image).subscribe();
        }
        ;
        if (this.filename_reference_image_url_base64 != null) {
            var image = {
                'base64': this.filename_reference_image_url_base64,
                'type': 'reference_image'
            };
            this.apiService.create(this.entity + "/" + this.id + "/images", image).subscribe();
        }
        ;
        if (this.filename_scanned_image_url_base64 != null) {
            var image = {
                'base64': this.filename_scanned_image_url_base64,
                'type': 'scanned_image'
            };
            this.apiService.create(this.entity + "/" + this.id + "/images", image).subscribe();
        }
        ;
    };
    AdvertisementDetailComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'app-advertisement-detail',
            template: __webpack_require__(753)
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1__service_api_service__["a" /* ApiService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_1__service_api_service__["a" /* ApiService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_2__angular_router__["a" /* Router */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2__angular_router__["a" /* Router */]) === 'function' && _b) || Object, (typeof (_c = typeof __WEBPACK_IMPORTED_MODULE_2__angular_router__["c" /* ActivatedRoute */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2__angular_router__["c" /* ActivatedRoute */]) === 'function' && _c) || Object, (typeof (_d = typeof __WEBPACK_IMPORTED_MODULE_3__angular_forms__["d" /* FormBuilder */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_3__angular_forms__["d" /* FormBuilder */]) === 'function' && _d) || Object, (typeof (_e = typeof __WEBPACK_IMPORTED_MODULE_4_angular2_toaster__["b" /* ToasterService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_4_angular2_toaster__["b" /* ToasterService */]) === 'function' && _e) || Object])
    ], AdvertisementDetailComponent);
    return AdvertisementDetailComponent;
    var _a, _b, _c, _d, _e;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/advertisement-detail.component.js.map

/***/ }),

/***/ 562:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__service_api_service__ = __webpack_require__(12);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__ = __webpack_require__(9);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return AdvertisementsComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};



var AdvertisementsComponent = (function () {
    function AdvertisementsComponent(apiService, toasterService) {
        this.apiService = apiService;
        this.toasterService = toasterService;
        this.entity_url = 'adverts/all';
    }
    AdvertisementsComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.apiService
            .getAll(this.entity_url)
            .subscribe(function (adverts) { return _this.adverts = adverts; }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with loading advertisements');
        });
    };
    AdvertisementsComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'app-advertisement',
            template: __webpack_require__(754)
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1__service_api_service__["a" /* ApiService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_1__service_api_service__["a" /* ApiService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__["b" /* ToasterService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__["b" /* ToasterService */]) === 'function' && _b) || Object])
    ], AdvertisementsComponent);
    return AdvertisementsComponent;
    var _a, _b;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/advertisements.component.js.map

/***/ }),

/***/ 563:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__service_auth_guard__ = __webpack_require__(378);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_platform_browser__ = __webpack_require__(180);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__angular_forms__ = __webpack_require__(27);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4_angular2_toaster__ = __webpack_require__(9);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__angular_http__ = __webpack_require__(37);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__app_routing_module__ = __webpack_require__(376);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7__service_api_service__ = __webpack_require__(12);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_8__service_api_en_service__ = __webpack_require__(592);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_9__service_api_panel_service__ = __webpack_require__(183);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_10__service_api_store_service__ = __webpack_require__(86);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_11__service_api_location_service__ = __webpack_require__(131);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_12__service_api_reference_service__ = __webpack_require__(132);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_13__service_api_product_service__ = __webpack_require__(184);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_14__auth_module__ = __webpack_require__(564);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return AppModule; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
















var AppModule = (function () {
    function AppModule() {
    }
    AppModule = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_2__angular_core__["NgModule"])({
            declarations: __WEBPACK_IMPORTED_MODULE_6__app_routing_module__["a" /* declarations */],
            imports: [
                __WEBPACK_IMPORTED_MODULE_1__angular_platform_browser__["a" /* BrowserModule */],
                __WEBPACK_IMPORTED_MODULE_3__angular_forms__["a" /* FormsModule */],
                __WEBPACK_IMPORTED_MODULE_5__angular_http__["HttpModule"],
                __WEBPACK_IMPORTED_MODULE_3__angular_forms__["b" /* ReactiveFormsModule */],
                __WEBPACK_IMPORTED_MODULE_6__app_routing_module__["b" /* AppRoutingModule */],
                __WEBPACK_IMPORTED_MODULE_14__auth_module__["a" /* AuthModule */],
                __WEBPACK_IMPORTED_MODULE_4_angular2_toaster__["a" /* ToasterModule */]
            ],
            providers: [
                __WEBPACK_IMPORTED_MODULE_7__service_api_service__["a" /* ApiService */],
                __WEBPACK_IMPORTED_MODULE_8__service_api_en_service__["a" /* ApiEnService */],
                __WEBPACK_IMPORTED_MODULE_9__service_api_panel_service__["a" /* ApiPanelService */],
                __WEBPACK_IMPORTED_MODULE_11__service_api_location_service__["a" /* ApiLocationService */],
                __WEBPACK_IMPORTED_MODULE_10__service_api_store_service__["a" /* ApiStoreService */],
                __WEBPACK_IMPORTED_MODULE_12__service_api_reference_service__["a" /* ApiReferenceService */],
                __WEBPACK_IMPORTED_MODULE_13__service_api_product_service__["a" /* ApiProductService */],
                __WEBPACK_IMPORTED_MODULE_0__service_auth_guard__["a" /* AuthGuard */]
            ],
            bootstrap: [__WEBPACK_IMPORTED_MODULE_6__app_routing_module__["a" /* declarations */][0]]
        }), 
        __metadata('design:paramtypes', [])
    ], AppModule);
    return AppModule;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/app.module.js.map

/***/ }),

/***/ 564:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_http__ = __webpack_require__(37);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_angular2_jwt__ = __webpack_require__(256);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_angular2_jwt___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2_angular2_jwt__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__service_extended_http_service__ = __webpack_require__(73);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__service_authentication_service__ = __webpack_require__(87);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__angular_router__ = __webpack_require__(17);
/* unused harmony export authHttpServiceFactory */
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return AuthModule; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};






function authHttpServiceFactory(http, router, authenticationService, options) {
    return new __WEBPACK_IMPORTED_MODULE_3__service_extended_http_service__["a" /* ExtendedHttpService */](new __WEBPACK_IMPORTED_MODULE_2_angular2_jwt__["AuthConfig"]({
        tokenName: 'token',
        globalHeaders: [{ 'Content-Type': 'application/json' }, { 'Accept': 'application/json' }],
    }), http, router, authenticationService, options);
}
var AuthModule = (function () {
    function AuthModule() {
    }
    AuthModule = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["NgModule"])({
            providers: [
                {
                    provide: __WEBPACK_IMPORTED_MODULE_3__service_extended_http_service__["a" /* ExtendedHttpService */],
                    useFactory: authHttpServiceFactory,
                    deps: [__WEBPACK_IMPORTED_MODULE_1__angular_http__["Http"], __WEBPACK_IMPORTED_MODULE_5__angular_router__["a" /* Router */], __WEBPACK_IMPORTED_MODULE_4__service_authentication_service__["a" /* AuthenticationService */], __WEBPACK_IMPORTED_MODULE_1__angular_http__["RequestOptions"]]
                },
                __WEBPACK_IMPORTED_MODULE_4__service_authentication_service__["a" /* AuthenticationService */]
            ]
        }), 
        __metadata('design:paramtypes', [])
    ], AuthModule);
    return AuthModule;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/auth.module.js.map

/***/ }),

/***/ 565:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__service_api_service__ = __webpack_require__(12);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__ = __webpack_require__(9);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return CategoriesComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};



var CategoriesComponent = (function () {
    function CategoriesComponent(apiService, toasterService) {
        this.apiService = apiService;
        this.toasterService = toasterService;
        this.entity_url = 'categories/all';
    }
    CategoriesComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.apiService.getAll(this.entity_url)
            .subscribe(function (categories) { return _this.categories = categories; }, function (error) { _this.errorMessage = error; _this.toasterService.pop('error', 'Error', 'Error with loading categories'); });
    };
    CategoriesComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'app-categories',
            template: __webpack_require__(756)
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1__service_api_service__["a" /* ApiService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_1__service_api_service__["a" /* ApiService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__["b" /* ToasterService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__["b" /* ToasterService */]) === 'function' && _b) || Object])
    ], CategoriesComponent);
    return CategoriesComponent;
    var _a, _b;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/categories.component.js.map

/***/ }),

/***/ 566:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__service_api_service__ = __webpack_require__(12);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__angular_router__ = __webpack_require__(17);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__angular_forms__ = __webpack_require__(27);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4_angular2_toaster__ = __webpack_require__(9);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return CategoryDetailComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};





var CategoryDetailComponent = (function () {
    function CategoryDetailComponent(apiService, router, route, fb, toasterService) {
        this.apiService = apiService;
        this.router = router;
        this.route = route;
        this.fb = fb;
        this.toasterService = toasterService;
        this.entity = 'categories';
        this.disabled = false;
    }
    CategoryDetailComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.id = this.route.snapshot.params['id'];
        if (this.id != -1) {
            this.apiService.get(this.entity, this.id)
                .subscribe(function (category) { _this.category = category; _this.createFormGroup(); }, function (error) { _this.errorMessage = error; _this.toasterService.pop('error', 'Error', 'Category with given ID doesn`t exist!'); _this.router.navigate(['/categories']); });
        }
        else {
            this.category = {
                id: null,
                name: '',
                description: ''
            };
            this.createFormGroup();
        }
    };
    CategoryDetailComponent.prototype.onSubmit = function () {
        this.disabled = true;
        if (this.id != -1) {
            this.updateCategory(this.id);
        }
        else {
            this.createCategory();
        }
    };
    CategoryDetailComponent.prototype.createCategory = function () {
        var _this = this;
        var category = this.createDataObject();
        this.apiService.create(this.entity, category)
            .subscribe(function (category) { _this.category = category; _this.toasterService.pop('success', 'Success', 'Category created!'); _this.disabled = false; _this.router.navigate(['/category', _this.category.id]); _this.id = _this.category.id; }, function (error) { _this.errorMessage = error; _this.toasterService.pop('error', 'Error', 'Error with creating category!'); _this.disabled = false; _this.router.navigate(['/categories']); });
    };
    CategoryDetailComponent.prototype.updateCategory = function (id) {
        var _this = this;
        var category = this.createDataObject();
        this.apiService.update(this.entity, this.id, category)
            .subscribe(function (category) { _this.category = category; _this.toasterService.pop('success', 'Success', 'Category updated!'); _this.router.navigate(['/categories']); _this.disabled = false; }, function (error) { _this.errorMessage = error; _this.toasterService.pop('error', 'Error', 'Error with updating category!'); _this.disabled = false; _this.router.navigate(['/categories']); });
    };
    CategoryDetailComponent.prototype.deleteCategory = function (id) {
        var _this = this;
        this.disabled = true;
        this.apiService.delete(this.entity, id)
            .subscribe(function () { _this.toasterService.pop('success', 'Success', 'Category deleted!'); _this.disabled = false; _this.router.navigate(['/categories']); }, function (error) { _this.errorMessage = error; _this.toasterService.pop('error', 'Error', 'Error with deleting category!'); _this.disabled = false; _this.router.navigate(['/categories']); });
    };
    CategoryDetailComponent.prototype.createDataObject = function () {
        var category = {
            "name": this.categoryForm.value.name,
            "description": this.categoryForm.value.description
        };
        return category;
    };
    CategoryDetailComponent.prototype.createFormGroup = function () {
        this.categoryForm = this.fb.group({
            name: this.category.name,
            description: this.category.description
        });
    };
    CategoryDetailComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'app-category-detail',
            template: __webpack_require__(757)
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1__service_api_service__["a" /* ApiService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_1__service_api_service__["a" /* ApiService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_2__angular_router__["a" /* Router */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2__angular_router__["a" /* Router */]) === 'function' && _b) || Object, (typeof (_c = typeof __WEBPACK_IMPORTED_MODULE_2__angular_router__["c" /* ActivatedRoute */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2__angular_router__["c" /* ActivatedRoute */]) === 'function' && _c) || Object, (typeof (_d = typeof __WEBPACK_IMPORTED_MODULE_3__angular_forms__["d" /* FormBuilder */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_3__angular_forms__["d" /* FormBuilder */]) === 'function' && _d) || Object, (typeof (_e = typeof __WEBPACK_IMPORTED_MODULE_4_angular2_toaster__["b" /* ToasterService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_4_angular2_toaster__["b" /* ToasterService */]) === 'function' && _e) || Object])
    ], CategoryDetailComponent);
    return CategoryDetailComponent;
    var _a, _b, _c, _d, _e;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/category-detail.component.js.map

/***/ }),

/***/ 567:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_rxjs_Rx__ = __webpack_require__(31);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_rxjs_Rx___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_rxjs_Rx__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__service_api_service__ = __webpack_require__(12);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__angular_router__ = __webpack_require__(17);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__angular_forms__ = __webpack_require__(27);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5_angular2_toaster__ = __webpack_require__(9);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return FieldgroupDetailComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};






var FieldgroupDetailComponent = (function () {
    function FieldgroupDetailComponent(apiService, router, route, fb, toasterService) {
        this.apiService = apiService;
        this.router = router;
        this.route = route;
        this.fb = fb;
        this.toasterService = toasterService;
        this.entity = 'fieldgroups';
        this.disabled = false;
    }
    FieldgroupDetailComponent.prototype.ngOnInit = function () {
        this.id = this.route.snapshot.params['id'];
        this.createFormGroup();
        if (this.id != -1) {
            this.populateFieldGroup();
        }
        else {
            this.initializeFieldGroup();
        }
    };
    FieldgroupDetailComponent.prototype.onSubmit = function () {
        this.disabled = true;
        if (this.id != -1) {
            this.updateFieldgroup(this.id);
        }
        else {
            this.createFieldgroup();
        }
    };
    FieldgroupDetailComponent.prototype.createFieldgroup = function () {
        var _this = this;
        var fieldgroup = this.createDataObject();
        this.apiService
            .create(this.entity, fieldgroup)
            .subscribe(function (fieldgroup) {
            _this.fieldgroup = fieldgroup;
            _this.toasterService.pop('success', 'Success', 'Fieldgroup created!');
            _this.disabled = false;
            _this.router.navigate(['/fieldgroup', _this.fieldgroup.id]);
            _this.id = _this.fieldgroup.id;
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with creating fieldgroup!');
            _this.disabled = false;
            _this.router.navigate(['/fieldgroups']);
        });
    };
    FieldgroupDetailComponent.prototype.updateFieldgroup = function (id) {
        var _this = this;
        var fieldgroup = this.createDataObject();
        this.apiService
            .update(this.entity, this.id, fieldgroup)
            .subscribe(function (fieldgroup) {
            _this.fieldgroup = fieldgroup;
            _this.toasterService.pop('success', 'Success', 'Fieldgroup updated!');
            _this.router.navigate(['/fieldgroups']);
            _this.disabled = false;
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with updating fieldgroup!');
            _this.disabled = false;
            _this.router.navigate(['/fieldgroups']);
        });
    };
    FieldgroupDetailComponent.prototype.deleteFieldgroup = function (id) {
        var _this = this;
        this.disabled = true;
        this.apiService
            .delete(this.entity, this.id)
            .subscribe(function () {
            _this.toasterService.pop('success', 'Success', 'Fieldgroup deleted!');
            _this.disabled = false;
            _this.router.navigate(['/fieldgroups']);
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with deleting fieldgroup!');
            _this.disabled = false;
            _this.router.navigate(['/fieldgroups']);
        });
    };
    FieldgroupDetailComponent.prototype.initializeFieldGroup = function () {
        var _this = this;
        this.fieldgroup = {
            id: null,
            cssclass: '',
            active: '',
            tableorder: '',
            name: '',
            fields: []
        };
        this.apiService
            .getAll('fields/all/free')
            .subscribe(function (fields) {
            _this.fields = fields;
        }, function (error) { return _this.errorMessage = error; });
    };
    FieldgroupDetailComponent.prototype.populateFieldGroup = function () {
        var _this = this;
        __WEBPACK_IMPORTED_MODULE_0_rxjs_Rx__["Observable"].forkJoin(this.apiService.get(this.entity, this.id), this.apiService.getAll('fields/all/free/' + this.id)).subscribe(function (result) {
            _this.fieldgroup = result[0];
            _this.fields = result[1];
            _this.setFormGroup();
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Something went wrong!');
            _this.router.navigate(['/fieldgroups']);
        });
    };
    FieldgroupDetailComponent.prototype.setFormGroup = function () {
        this.fieldgroupForm.controls['name'].setValue(this.fieldgroup.name);
        this.fieldgroupForm.controls['cssclass'].setValue(this.fieldgroup.cssclass);
        this.fieldgroupForm.controls['selectedFields'].setValue(this.getFieldId());
    };
    FieldgroupDetailComponent.prototype.createFormGroup = function () {
        this.fieldgroupForm = this.fb.group({
            name: '',
            cssclass: '',
            selectedFields: new __WEBPACK_IMPORTED_MODULE_4__angular_forms__["c" /* FormControl */]([])
        });
    };
    FieldgroupDetailComponent.prototype.createDataObject = function () {
        var fieldgroup = {
            'name': this.fieldgroupForm.value.name,
            'cssclass': this.fieldgroupForm.value.cssclass,
            'fields': this.fieldgroupForm.value.selectedFields,
        };
        return fieldgroup;
    };
    FieldgroupDetailComponent.prototype.getFieldId = function () {
        if (this.fields) {
            var fieldIds = [];
            for (var i = 0; i < this.fields.length; i++) {
                if (this.id == +this.fields[i].field_group_id) {
                    fieldIds.push(this.fields[i].id);
                }
            }
            return fieldIds;
        }
    };
    FieldgroupDetailComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_1__angular_core__["Component"])({
            selector: 'app-fieldgroup-detail',
            template: __webpack_require__(758)
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_2__service_api_service__["a" /* ApiService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2__service_api_service__["a" /* ApiService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_3__angular_router__["a" /* Router */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_3__angular_router__["a" /* Router */]) === 'function' && _b) || Object, (typeof (_c = typeof __WEBPACK_IMPORTED_MODULE_3__angular_router__["c" /* ActivatedRoute */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_3__angular_router__["c" /* ActivatedRoute */]) === 'function' && _c) || Object, (typeof (_d = typeof __WEBPACK_IMPORTED_MODULE_4__angular_forms__["d" /* FormBuilder */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_4__angular_forms__["d" /* FormBuilder */]) === 'function' && _d) || Object, (typeof (_e = typeof __WEBPACK_IMPORTED_MODULE_5_angular2_toaster__["b" /* ToasterService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_5_angular2_toaster__["b" /* ToasterService */]) === 'function' && _e) || Object])
    ], FieldgroupDetailComponent);
    return FieldgroupDetailComponent;
    var _a, _b, _c, _d, _e;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/fieldgroup-detail.component.js.map

/***/ }),

/***/ 568:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__service_api_service__ = __webpack_require__(12);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__ = __webpack_require__(9);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return FieldgroupsComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};



var FieldgroupsComponent = (function () {
    function FieldgroupsComponent(apiService, toasterService) {
        this.apiService = apiService;
        this.toasterService = toasterService;
        this.entity_url = 'fieldgroups/all';
    }
    FieldgroupsComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.apiService
            .getAll(this.entity_url)
            .subscribe(function (fieldgroups) { return _this.fieldgroups = fieldgroups; }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with loading fieldgroups');
        });
    };
    FieldgroupsComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'app-fieldgroups',
            template: __webpack_require__(759)
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1__service_api_service__["a" /* ApiService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_1__service_api_service__["a" /* ApiService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__["b" /* ToasterService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__["b" /* ToasterService */]) === 'function' && _b) || Object])
    ], FieldgroupsComponent);
    return FieldgroupsComponent;
    var _a, _b;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/fieldgroups.component.js.map

/***/ }),

/***/ 569:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__service_api_service__ = __webpack_require__(12);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__angular_router__ = __webpack_require__(17);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__angular_forms__ = __webpack_require__(27);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4_angular2_toaster__ = __webpack_require__(9);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return FieldDetailComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};





var FieldDetailComponent = (function () {
    function FieldDetailComponent(apiService, router, route, fb, toasterService) {
        this.apiService = apiService;
        this.router = router;
        this.route = route;
        this.fb = fb;
        this.toasterService = toasterService;
        this.entity = 'fields';
        this.disabled = false;
    }
    FieldDetailComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.id = this.route.snapshot.params['id'];
        if (this.id != -1) {
            this.apiService.get(this.entity, this.id)
                .subscribe(function (field) { _this.field = field; _this.createFormGroup(); }, function (error) { _this.errorMessage = error; _this.toasterService.pop('error', 'Error', 'Field with given ID doesn`t exist!'); _this.router.navigate(['/fields']); });
        }
        else {
            this.field = {
                id: null,
                key: '',
                fieldtype_id: '',
                field_group_id: '',
                cssclass: '',
                active: '',
                order: '',
                name: '',
                values: ''
            };
            this.createFormGroup();
        }
        this.apiService.getAll('fieldtypes/all')
            .subscribe(function (fieldtypes) { _this.fieldtypes = fieldtypes; }, function (error) { return _this.errorMessage = error; });
    };
    FieldDetailComponent.prototype.onSubmit = function () {
        this.disabled = true;
        if (this.id != -1) {
            this.updateField(this.id);
        }
        else {
            this.createField();
        }
    };
    FieldDetailComponent.prototype.createField = function () {
        var _this = this;
        var field = this.createDataObject();
        this.apiService.create(this.entity, field)
            .subscribe(function (field) { _this.field = field; _this.toasterService.pop('success', 'Success', 'Field created!'); _this.disabled = false; _this.router.navigate(['/field', _this.field.id]); _this.id = _this.field.id; }, function (error) { _this.errorMessage = error; _this.toasterService.pop('error', 'Error', 'Error with creating field!'); _this.disabled = false; _this.router.navigate(['/fields']); });
    };
    FieldDetailComponent.prototype.updateField = function (id) {
        var _this = this;
        var field = this.createDataObject();
        this.apiService.update(this.entity, this.id, field)
            .subscribe(function (field) { _this.field = field; _this.toasterService.pop('success', 'Success', 'Field updated!'); _this.router.navigate(['/fields']); _this.disabled = false; }, function (error) { _this.errorMessage = error; _this.toasterService.pop('error', 'Error', 'Error with updating field!'); _this.disabled = false; _this.router.navigate(['/fields']); });
    };
    FieldDetailComponent.prototype.deleteField = function (id) {
        var _this = this;
        this.disabled = true;
        this.apiService.delete(this.entity, this.id)
            .subscribe(function () { _this.toasterService.pop('success', 'Success', 'Field deleted!'); _this.disabled = false; _this.router.navigate(['/fields']); }, function (error) { _this.errorMessage = error; _this.toasterService.pop('error', 'Error', 'Error with deleting field!'); _this.disabled = false; _this.router.navigate(['/fields']); });
    };
    FieldDetailComponent.prototype.createFormGroup = function () {
        this.fieldForm = this.fb.group({
            key: this.field.key,
            name: this.field.name,
            cssclass: this.field.cssclass,
            fieldtype_id: this.field.fieldtype_id,
            values: this.field.values,
        });
    };
    FieldDetailComponent.prototype.createDataObject = function () {
        var field = {
            "key": this.fieldForm.value.key,
            "name": this.fieldForm.value.name,
            "cssclass": this.fieldForm.value.cssclass,
            "fieldtype_id": this.fieldForm.value.fieldtype_id,
            "values": this.fieldForm.value.values
        };
        return field;
    };
    FieldDetailComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'app-field-detail',
            template: __webpack_require__(760)
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1__service_api_service__["a" /* ApiService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_1__service_api_service__["a" /* ApiService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_2__angular_router__["a" /* Router */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2__angular_router__["a" /* Router */]) === 'function' && _b) || Object, (typeof (_c = typeof __WEBPACK_IMPORTED_MODULE_2__angular_router__["c" /* ActivatedRoute */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2__angular_router__["c" /* ActivatedRoute */]) === 'function' && _c) || Object, (typeof (_d = typeof __WEBPACK_IMPORTED_MODULE_3__angular_forms__["d" /* FormBuilder */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_3__angular_forms__["d" /* FormBuilder */]) === 'function' && _d) || Object, (typeof (_e = typeof __WEBPACK_IMPORTED_MODULE_4_angular2_toaster__["b" /* ToasterService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_4_angular2_toaster__["b" /* ToasterService */]) === 'function' && _e) || Object])
    ], FieldDetailComponent);
    return FieldDetailComponent;
    var _a, _b, _c, _d, _e;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/field-detail.component.js.map

/***/ }),

/***/ 570:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__service_api_service__ = __webpack_require__(12);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__ = __webpack_require__(9);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return FieldsComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};



var FieldsComponent = (function () {
    function FieldsComponent(apiService, toasterService) {
        this.apiService = apiService;
        this.toasterService = toasterService;
        this.entity_url = 'fields/all';
    }
    FieldsComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.apiService
            .getAll(this.entity_url)
            .subscribe(function (fields) { return _this.fields = fields; }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with loading fields');
        });
    };
    FieldsComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'app-fields',
            template: __webpack_require__(761)
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1__service_api_service__["a" /* ApiService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_1__service_api_service__["a" /* ApiService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__["b" /* ToasterService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__["b" /* ToasterService */]) === 'function' && _b) || Object])
    ], FieldsComponent);
    return FieldsComponent;
    var _a, _b;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/fields.component.js.map

/***/ }),

/***/ 571:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__service_api_service__ = __webpack_require__(12);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__angular_router__ = __webpack_require__(17);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__angular_forms__ = __webpack_require__(27);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4_angular2_toaster__ = __webpack_require__(9);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return FieldtypeDetailComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};





var FieldtypeDetailComponent = (function () {
    function FieldtypeDetailComponent(apiService, router, route, fb, toasterService) {
        this.apiService = apiService;
        this.router = router;
        this.route = route;
        this.fb = fb;
        this.toasterService = toasterService;
        this.entity = 'fieldtypes';
        this.disabled = false;
    }
    FieldtypeDetailComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.id = this.route.snapshot.params['id'];
        if (this.id != -1) {
            this.apiService.get(this.entity, this.id)
                .subscribe(function (fieldtype) { _this.fieldtype = fieldtype; _this.createFormGroup(); }, function (error) { _this.errorMessage = error; _this.toasterService.pop('error', 'Error', 'Fieldtype with given ID doesn`t exist!'); _this.router.navigate(['/fieldtypes']); });
        }
        else {
            this.fieldtype = {
                id: null,
                name: '',
                template: '',
                active: ''
            };
            this.createFormGroup();
        }
    };
    FieldtypeDetailComponent.prototype.onSubmit = function () {
        this.disabled = true;
        if (this.id != -1) {
            this.updateFieldtype(this.id);
        }
        else {
            this.createFieldtype();
        }
    };
    FieldtypeDetailComponent.prototype.createFieldtype = function () {
        var _this = this;
        var fieldtype = this.createDataObject();
        this.apiService.create(this.entity, fieldtype)
            .subscribe(function (fieldtype) { _this.fieldtype = fieldtype; _this.toasterService.pop('success', 'Success', 'Fieldtype created!'); _this.disabled = false; _this.router.navigate(['/fieldtype', _this.fieldtype.id]); _this.id = _this.fieldtype.id; }, function (error) { _this.errorMessage = error; _this.toasterService.pop('error', 'Error', 'Error with creating fieldtype!'); _this.disabled = false; _this.router.navigate(['/fieldtypes']); });
    };
    FieldtypeDetailComponent.prototype.updateFieldtype = function (id) {
        var _this = this;
        var fieldtype = this.createDataObject();
        this.apiService.update(this.entity, this.id, fieldtype)
            .subscribe(function (fieldtype) { _this.fieldtype = fieldtype; _this.toasterService.pop('success', 'Success', 'Fieldtype updated!'); _this.router.navigate(['/fieldtypes']); _this.disabled = false; }, function (error) { _this.errorMessage = error; _this.toasterService.pop('error', 'Error', 'Error with updating fieldtype!'); _this.disabled = false; _this.router.navigate(['/fieldtypes']); });
    };
    FieldtypeDetailComponent.prototype.deleteFieldtype = function (id) {
        var _this = this;
        this.disabled = true;
        this.apiService.delete(this.entity, id)
            .subscribe(function () { _this.toasterService.pop('success', 'Success', 'Fieldtype deleted!'); _this.disabled = false; _this.router.navigate(['/fieldtypes']); }, function (error) { _this.errorMessage = error; _this.toasterService.pop('error', 'Error', 'Error with deleting fieldtype!'); _this.disabled = false; _this.router.navigate(['/fieldtypes']); });
    };
    FieldtypeDetailComponent.prototype.createFormGroup = function () {
        this.fieldtypeForm = this.fb.group({
            name: this.fieldtype.name
        });
    };
    FieldtypeDetailComponent.prototype.createDataObject = function () {
        var fieldtype = {
            "name": this.fieldtypeForm.value.name,
        };
        return fieldtype;
    };
    FieldtypeDetailComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'app-fieldtype-detail',
            template: __webpack_require__(762)
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1__service_api_service__["a" /* ApiService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_1__service_api_service__["a" /* ApiService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_2__angular_router__["a" /* Router */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2__angular_router__["a" /* Router */]) === 'function' && _b) || Object, (typeof (_c = typeof __WEBPACK_IMPORTED_MODULE_2__angular_router__["c" /* ActivatedRoute */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2__angular_router__["c" /* ActivatedRoute */]) === 'function' && _c) || Object, (typeof (_d = typeof __WEBPACK_IMPORTED_MODULE_3__angular_forms__["d" /* FormBuilder */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_3__angular_forms__["d" /* FormBuilder */]) === 'function' && _d) || Object, (typeof (_e = typeof __WEBPACK_IMPORTED_MODULE_4_angular2_toaster__["b" /* ToasterService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_4_angular2_toaster__["b" /* ToasterService */]) === 'function' && _e) || Object])
    ], FieldtypeDetailComponent);
    return FieldtypeDetailComponent;
    var _a, _b, _c, _d, _e;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/fieldtype-detail.component.js.map

/***/ }),

/***/ 572:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__service_api_service__ = __webpack_require__(12);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__ = __webpack_require__(9);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return FieldtypesComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};



var FieldtypesComponent = (function () {
    function FieldtypesComponent(apiService, toasterService) {
        this.apiService = apiService;
        this.toasterService = toasterService;
        this.entity_url = 'fieldtypes/all';
    }
    FieldtypesComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.apiService.getAll(this.entity_url)
            .subscribe(function (fieldtypes) { return _this.fieldtypes = fieldtypes; }, function (error) { _this.errorMessage = error; _this.toasterService.pop('error', 'Error', 'Error with loading fieldtypes'); });
    };
    FieldtypesComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'app-fieldtypes',
            template: __webpack_require__(763)
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1__service_api_service__["a" /* ApiService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_1__service_api_service__["a" /* ApiService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__["b" /* ToasterService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__["b" /* ToasterService */]) === 'function' && _b) || Object])
    ], FieldtypesComponent);
    return FieldtypesComponent;
    var _a, _b;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/fieldtypes.component.js.map

/***/ }),

/***/ 573:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__app_component__ = __webpack_require__(377);
/* unused harmony namespace reexport */
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__app_module__ = __webpack_require__(563);
/* harmony namespace reexport (by used) */ __webpack_require__.d(__webpack_exports__, "a", function() { return __WEBPACK_IMPORTED_MODULE_1__app_module__["a"]; });


//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/index.js.map

/***/ }),

/***/ 574:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__service_api_location_service__ = __webpack_require__(131);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__angular_router__ = __webpack_require__(17);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__angular_forms__ = __webpack_require__(27);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4_angular2_toaster__ = __webpack_require__(9);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return LocationDetailComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};





var LocationDetailComponent = (function () {
    function LocationDetailComponent(apiLocationService, router, route, fb, toasterService) {
        this.apiLocationService = apiLocationService;
        this.router = router;
        this.route = route;
        this.fb = fb;
        this.toasterService = toasterService;
        this.disabled = false;
    }
    LocationDetailComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.id = this.route.snapshot.params['id'];
        if (this.id != -1) {
            this.apiLocationService.get(this.id)
                .subscribe(function (location) {
                _this.location = location;
                _this.createFormGroup();
            }, function (error) {
                _this.errorMessage = error;
                _this.toasterService.pop('error', 'Error', 'Location with given ID doesn`t exist!');
                _this.router.navigate(['/locations']);
            });
        }
        else {
            this.location = {
                id: null,
                key: '',
                name: '',
                latitude: '',
                longitude: '',
                is_featured: false,
            };
            this.createFormGroup();
        }
    };
    LocationDetailComponent.prototype.onSubmit = function () {
        this.disabled = true;
        if (this.id != -1) {
            this.updateLocation(this.id);
        }
        else {
            this.createLocation();
        }
    };
    LocationDetailComponent.prototype.createLocation = function () {
        var _this = this;
        var location = this.createDataObject();
        this.apiLocationService.create(location)
            .subscribe(function (location) {
            _this.location = location;
            _this.toasterService.pop('success', 'Success', 'Location created!');
            _this.disabled = false;
            _this.router.navigate(['/location', _this.location.id]);
            _this.id = _this.location.id;
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with creating location!');
            _this.disabled = false;
        });
    };
    LocationDetailComponent.prototype.updateLocation = function (id) {
        var _this = this;
        var location = this.createDataObject();
        this.apiLocationService.update(this.id, location)
            .subscribe(function (location) {
            _this.location = location;
            _this.toasterService.pop('success', 'Success', 'Location updated!');
            _this.router.navigate(['/locations']);
            _this.disabled = false;
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with updating location!');
            _this.disabled = false;
            _this.router.navigate(['/locations']);
        });
    };
    LocationDetailComponent.prototype.deleteLocation = function (id) {
        var _this = this;
        this.disabled = true;
        this.apiLocationService.delete(id)
            .subscribe(function () {
            _this.toasterService.pop('success', 'Success', 'Location deleted!');
            _this.disabled = false;
            _this.router.navigate(['/locations']);
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', "Error with deleting location! " + error.message);
            _this.disabled = false;
            _this.router.navigate(['/locations']);
        });
    };
    LocationDetailComponent.prototype.createDataObject = function () {
        var location = {
            'key': this.locationForm.value.key,
            'name': this.locationForm.value.name,
            'latitude': this.locationForm.value.latitude,
            'longitude': this.locationForm.value.longitude,
            'is_featured': this.locationForm.value.is_featured,
        };
        return location;
    };
    LocationDetailComponent.prototype.createFormGroup = function () {
        this.locationForm = this.fb.group({
            key: this.location.key,
            name: this.location.name,
            latitude: this.location.latitude,
            longitude: this.location.longitude,
            is_featured: this.location.is_featured,
        });
    };
    LocationDetailComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'app-location-detail',
            template: __webpack_require__(764),
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1__service_api_location_service__["a" /* ApiLocationService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_1__service_api_location_service__["a" /* ApiLocationService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_2__angular_router__["a" /* Router */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2__angular_router__["a" /* Router */]) === 'function' && _b) || Object, (typeof (_c = typeof __WEBPACK_IMPORTED_MODULE_2__angular_router__["c" /* ActivatedRoute */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2__angular_router__["c" /* ActivatedRoute */]) === 'function' && _c) || Object, (typeof (_d = typeof __WEBPACK_IMPORTED_MODULE_3__angular_forms__["d" /* FormBuilder */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_3__angular_forms__["d" /* FormBuilder */]) === 'function' && _d) || Object, (typeof (_e = typeof __WEBPACK_IMPORTED_MODULE_4_angular2_toaster__["b" /* ToasterService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_4_angular2_toaster__["b" /* ToasterService */]) === 'function' && _e) || Object])
    ], LocationDetailComponent);
    return LocationDetailComponent;
    var _a, _b, _c, _d, _e;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/location-detail.component.js.map

/***/ }),

/***/ 575:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__service_api_location_service__ = __webpack_require__(131);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__ = __webpack_require__(9);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return LocationsComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};



var LocationsComponent = (function () {
    function LocationsComponent(apiLocationService, toasterService) {
        this.apiLocationService = apiLocationService;
        this.toasterService = toasterService;
    }
    LocationsComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.apiLocationService.getAll()
            .subscribe(function (locations) { return _this.locations = locations; }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with loading locations');
        });
    };
    LocationsComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'app-locations',
            template: __webpack_require__(765),
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1__service_api_location_service__["a" /* ApiLocationService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_1__service_api_location_service__["a" /* ApiLocationService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__["b" /* ToasterService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__["b" /* ToasterService */]) === 'function' && _b) || Object])
    ], LocationsComponent);
    return LocationsComponent;
    var _a, _b;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/locations.component.js.map

/***/ }),

/***/ 576:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_router__ = __webpack_require__(17);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__service_authentication_service__ = __webpack_require__(87);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return LoginComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};



var LoginComponent = (function () {
    function LoginComponent(router, authenticationService) {
        this.router = router;
        this.authenticationService = authenticationService;
        this.model = {};
        this.loading = false;
        this.error = '';
    }
    LoginComponent.prototype.login = function () {
        var _this = this;
        this.loading = true;
        this.authenticationService.login(this.model.username, this.model.password)
            .subscribe(function (result) {
            _this.loading = false;
            var url = _this.authenticationService.redirectUrl;
            _this.router.navigate([url]);
        }, function (error) {
            _this.error = 'The email or password you have entered is invalid.';
            _this.loading = false;
        });
    };
    LoginComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'app-login',
            template: __webpack_require__(766)
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1__angular_router__["a" /* Router */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_1__angular_router__["a" /* Router */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_2__service_authentication_service__["a" /* AuthenticationService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2__service_authentication_service__["a" /* AuthenticationService */]) === 'function' && _b) || Object])
    ], LoginComponent);
    return LoginComponent;
    var _a, _b;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/login.component.js.map

/***/ }),

/***/ 577:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__service_authentication_service__ = __webpack_require__(87);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_core__ = __webpack_require__(1);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return LogoutComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};


var LogoutComponent = (function () {
    function LogoutComponent(authenticationService) {
        this.authenticationService = authenticationService;
    }
    LogoutComponent.prototype.ngOnInit = function () {
        this.authenticationService.logout();
    };
    LogoutComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_1__angular_core__["Component"])({
            selector: 'app-logout',
            template: ''
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_0__service_authentication_service__["a" /* AuthenticationService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_0__service_authentication_service__["a" /* AuthenticationService */]) === 'function' && _a) || Object])
    ], LogoutComponent);
    return LogoutComponent;
    var _a;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/logout.component.js.map

/***/ }),

/***/ 578:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__service_api_reference_service__ = __webpack_require__(132);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__service_api_service__ = __webpack_require__(12);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__angular_router__ = __webpack_require__(17);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__angular_forms__ = __webpack_require__(27);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5_angular2_toaster__ = __webpack_require__(9);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__environments_environment__ = __webpack_require__(42);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ManufacturerDetailComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};







var ManufacturerDetailComponent = (function () {
    function ManufacturerDetailComponent(apiService, apiReferenceService, router, route, fb, toasterService) {
        this.apiService = apiService;
        this.apiReferenceService = apiReferenceService;
        this.router = router;
        this.route = route;
        this.fb = fb;
        this.toasterService = toasterService;
        this.entity = 'manufacturers';
        this.base64 = null;
        this.disabled = false;
        this.brandreferences = [];
        this.categories = [];
        this.domain = __WEBPACK_IMPORTED_MODULE_6__environments_environment__["a" /* environment */].domain_url;
        this.progress = {
            brandreference: {
                creating: false,
                deleteMap: {}
            }
        };
    }
    Object.defineProperty(ManufacturerDetailComponent.prototype, "reverseBrandreferences", {
        get: function () { return [].concat(this.brandreferences).sort(function (a, b) { return a.id > b.id ? -1 : 1; }); },
        enumerable: true,
        configurable: true
    });
    ManufacturerDetailComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.id = this.route.snapshot.params['id'];
        this.createbrandreferenceFormGroup();
        this.apiService.getAll('categories/all')
            .subscribe(function (categories) {
            _this.categories = categories;
        }, function (error) { _this.errorMessage = error; _this.toasterService.pop('error', 'Error', 'Error with loading categories'); });
        if (this.id != -1) {
            this.apiService
                .get(this.entity, this.id)
                .subscribe(function (manufacturer) {
                _this.manufacturer = manufacturer;
                _this.createFormGroup();
                _this.loadBrandReferences();
            }, function (error) {
                _this.errorMessage = error;
                _this.toasterService.pop('error', 'Error', 'Manufacturer with given ID doesn`t exist!');
                _this.router.navigate(['/manufacturers']);
            });
        }
        else {
            this.manufacturer = {
                id: null,
                name: '',
                url: '',
                image_url: '',
                featured: '',
                brandreferences_count: 0,
            };
            this.createFormGroup();
        }
    };
    ManufacturerDetailComponent.prototype.resetBrandreferenceImage = function () {
        this.brandreferenceImage = null;
    };
    ManufacturerDetailComponent.prototype.onSubmit = function () {
        this.disabled = true;
        if (this.id != -1) {
            this.updateManufacturer(this.id);
        }
        else {
            this.createManufacturer();
        }
    };
    ManufacturerDetailComponent.prototype.setCategories = function (brs) {
        var _this = this;
        brs.forEach(function (br) { return _this.setCategory(br); });
    };
    ManufacturerDetailComponent.prototype.setCategory = function (br) {
        br.category = br.category_id ? this.categories.find(function (cat) { return cat.id === br.category_id; }) : null;
    };
    ManufacturerDetailComponent.prototype.createManufacturer = function () {
        var _this = this;
        var manufacturer = this.createDataObject();
        this.apiService
            .create(this.entity, manufacturer)
            .subscribe(function (manufacturer) {
            _this.manufacturer = manufacturer;
            _this.toasterService.pop('success', 'Success', 'Manufacturer created!');
            _this.disabled = false;
            _this.router.navigate(['/manufacturer', _this.manufacturer.id]);
            _this.id = _this.manufacturer.id;
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with creating manufacturer!');
            _this.disabled = false;
            _this.router.navigate(['/manufacturers']);
        });
    };
    ManufacturerDetailComponent.prototype.loadBrandReferences = function () {
        var _this = this;
        if (!this.manufacturer) {
            return;
        }
        this.apiReferenceService.getBrandReferences(this.manufacturer.id)
            .subscribe(function (brandreferences) {
            _this.brandreferences = brandreferences;
            _this.setCategories(_this.brandreferences);
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with brand references');
        });
    };
    ManufacturerDetailComponent.prototype.updateManufacturer = function (id) {
        var _this = this;
        var manufacturer = this.createDataObject();
        this.apiService.update(this.entity, this.id, manufacturer)
            .subscribe(function (manufacturer) { _this.manufacturer = manufacturer; _this.toasterService.pop('success', 'Success', 'Manufacturer updated!'); _this.router.navigate(['/manufacturers']); _this.disabled = false; }, function (error) { _this.errorMessage = error; _this.toasterService.pop('error', 'Error', 'Error with updating manufacturer!'); _this.disabled = false; _this.router.navigate(['/manufacturers']); });
    };
    ManufacturerDetailComponent.prototype.deleteManufacturer = function (id) {
        var _this = this;
        this.disabled = true;
        this.apiService
            .delete(this.entity, id)
            .subscribe(function () {
            _this.toasterService.pop('success', 'Success', 'Manufacturer deleted!');
            _this.disabled = false;
            _this.router.navigate(['/manufacturers']);
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with deleting manufacturer!');
            _this.disabled = false;
            _this.router.navigate(['/manufacturers']);
        });
    };
    ManufacturerDetailComponent.prototype.deleteBrandReference = function (br) {
        var _this = this;
        this.progress.brandreference.deleteMap[br.id] = true;
        this.apiReferenceService.deleteBrandReference(br.manufacturer_id, br.id)
            .subscribe(function (success) { return _this.brandreferences = _this.brandreferences.filter(function (ref) { return ref.id !== br.id; }); }, function (error) { return _this.toasterService.pop('error', 'Error', 'Error with deleting brand reference!'); }, function () { return _this.progress.brandreference.deleteMap[br.id] = false; });
    };
    ManufacturerDetailComponent.prototype.changeListener = function ($event) {
        this.readThis($event.target);
    };
    ManufacturerDetailComponent.prototype.readThis = function (inputValue) {
        var _this = this;
        var file = inputValue.files[0];
        var myReader = new FileReader();
        if (!inputValue.files || inputValue.files.length === 0) {
            return;
        }
        myReader.onloadend = function (e) {
            _this.base64 = myReader.result;
            _this.manufacturer.image_url = myReader.result;
        };
        myReader.readAsDataURL(file);
    };
    ManufacturerDetailComponent.prototype.onFileChange = function (event) {
        if (event.target.files && event.target.files.length > 0) {
            this.brandreferenceImage = event.target.files[0];
        }
    };
    ManufacturerDetailComponent.prototype.onSubmitBrandReference = function () {
        var _this = this;
        if (this.brandreferenceForm.invalid) {
            this.toasterService.pop('warning', 'Fill in the form', 'Fill in all fields and select 1 image');
            return;
        }
        if (!this.brandreferenceImage) {
            this.toasterService.pop('warning', 'Image not selected', 'Select brand reference image');
            return;
        }
        this.progress.brandreference.creating = true;
        var formdata = new FormData();
        var title = this.brandreferenceForm.get('title').value;
        formdata.append('title', title);
        var description = this.brandreferenceForm.get('description').value;
        formdata.append('description', description);
        var category_id = this.brandreferenceForm.get('category_id').value;
        formdata.append('category_id', category_id);
        formdata.append('image', this.brandreferenceImage);
        this.apiReferenceService.createBrandReferences(this.manufacturer.id, formdata)
            .subscribe(function (brandreference) {
            var br = brandreference;
            _this.setCategory(br);
            _this.brandreferences.push(br);
            _this.brandreferenceImage = null;
            _this.progress.brandreference.creating = false;
            _this.brandreferenceForm.reset();
        }, function (error) {
            _this.toasterService.pop('error', 'Error', 'Error with creating brand reference!');
            _this.progress.brandreference.creating = false;
        });
    };
    ManufacturerDetailComponent.prototype.createFormGroup = function () {
        this.manufacturerForm = this.fb.group({
            name: this.manufacturer.name,
            featured: this.manufacturer.featured
        });
    };
    ManufacturerDetailComponent.prototype.createbrandreferenceFormGroup = function () {
        this.brandreferenceForm = this.fb.group({
            title: new __WEBPACK_IMPORTED_MODULE_4__angular_forms__["c" /* FormControl */]('', __WEBPACK_IMPORTED_MODULE_4__angular_forms__["e" /* Validators */].required),
            description: new __WEBPACK_IMPORTED_MODULE_4__angular_forms__["c" /* FormControl */]('', __WEBPACK_IMPORTED_MODULE_4__angular_forms__["e" /* Validators */].required),
            category_id: new __WEBPACK_IMPORTED_MODULE_4__angular_forms__["c" /* FormControl */](null),
            image: new __WEBPACK_IMPORTED_MODULE_4__angular_forms__["c" /* FormControl */](null, __WEBPACK_IMPORTED_MODULE_4__angular_forms__["e" /* Validators */].required),
        });
    };
    ManufacturerDetailComponent.prototype.createDataObject = function () {
        var manufacturer = {
            "name": this.manufacturerForm.value.name,
            "featured": this.manufacturerForm.value.featured ? '1' : '',
        };
        if (this.base64 != null) {
            manufacturer['base64'] = this.base64;
        }
        ;
        return manufacturer;
    };
    ManufacturerDetailComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_1__angular_core__["Component"])({
            selector: 'app-manufacturer-detail',
            template: __webpack_require__(767)
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_2__service_api_service__["a" /* ApiService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2__service_api_service__["a" /* ApiService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_0__service_api_reference_service__["a" /* ApiReferenceService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_0__service_api_reference_service__["a" /* ApiReferenceService */]) === 'function' && _b) || Object, (typeof (_c = typeof __WEBPACK_IMPORTED_MODULE_3__angular_router__["a" /* Router */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_3__angular_router__["a" /* Router */]) === 'function' && _c) || Object, (typeof (_d = typeof __WEBPACK_IMPORTED_MODULE_3__angular_router__["c" /* ActivatedRoute */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_3__angular_router__["c" /* ActivatedRoute */]) === 'function' && _d) || Object, (typeof (_e = typeof __WEBPACK_IMPORTED_MODULE_4__angular_forms__["d" /* FormBuilder */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_4__angular_forms__["d" /* FormBuilder */]) === 'function' && _e) || Object, (typeof (_f = typeof __WEBPACK_IMPORTED_MODULE_5_angular2_toaster__["b" /* ToasterService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_5_angular2_toaster__["b" /* ToasterService */]) === 'function' && _f) || Object])
    ], ManufacturerDetailComponent);
    return ManufacturerDetailComponent;
    var _a, _b, _c, _d, _e, _f;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/manufacturer-detail.component.js.map

/***/ }),

/***/ 579:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__service_api_service__ = __webpack_require__(12);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__ = __webpack_require__(9);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ManufacturersComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};



var ManufacturersComponent = (function () {
    function ManufacturersComponent(apiService, toasterService) {
        this.apiService = apiService;
        this.toasterService = toasterService;
        this.entity_url = 'manufacturers/all';
    }
    ManufacturersComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.apiService
            .getAll(this.entity_url)
            .subscribe(function (manufacturers) { return _this.manufacturers = manufacturers; }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with loading manufacturers');
        });
    };
    ManufacturersComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'app-manufacturers',
            template: __webpack_require__(768)
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1__service_api_service__["a" /* ApiService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_1__service_api_service__["a" /* ApiService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__["b" /* ToasterService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__["b" /* ToasterService */]) === 'function' && _b) || Object])
    ], ManufacturersComponent);
    return ManufacturersComponent;
    var _a, _b;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/manufacturers.component.js.map

/***/ }),

/***/ 580:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(1);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return PageNotFoundComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};

var PageNotFoundComponent = (function () {
    function PageNotFoundComponent() {
    }
    PageNotFoundComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            template: '<h2>Page not found</h2>'
        }), 
        __metadata('design:paramtypes', [])
    ], PageNotFoundComponent);
    return PageNotFoundComponent;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/not-found.component.js.map

/***/ }),

/***/ 581:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return Packages; });
var Packages = (function () {
    function Packages() {
    }
    Packages.paid = function () {
        return [this.STORE, this.TOPSTORE, this.TOPDITOPSTORE];
    };
    Packages.all = function () {
        return [this.LIGHT].concat(this.paid());
    };
    Packages.TOPDITOPSTORE = 'TopDiTop Store';
    Packages.TOPSTORE = 'TopStore';
    Packages.STORE = 'Store';
    Packages.LIGHT = 'Light Store';
    return Packages;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/Packages.js.map

/***/ }),

/***/ 582:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_rxjs_Rx__ = __webpack_require__(31);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_rxjs_Rx___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_rxjs_Rx__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__service_api_service__ = __webpack_require__(12);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__service_api_panel_service__ = __webpack_require__(183);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__angular_router__ = __webpack_require__(17);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__angular_forms__ = __webpack_require__(27);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6_angular2_toaster__ = __webpack_require__(9);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return PackageDetailComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};







var PackageDetailComponent = (function () {
    function PackageDetailComponent(apiPanelService, apiService, router, route, fb, toasterService) {
        this.apiPanelService = apiPanelService;
        this.apiService = apiService;
        this.router = router;
        this.route = route;
        this.fb = fb;
        this.toasterService = toasterService;
        this.entity = 'packages';
        this.disabled = false;
    }
    PackageDetailComponent.prototype.ngOnInit = function () {
        this.id = this.route.snapshot.params['id'];
        if (this.id != -1) {
            this.populatePackage();
        }
        else {
            this.initializePackage();
        }
    };
    PackageDetailComponent.prototype.onSubmit = function () {
        this.disabled = true;
        if (this.id != -1) {
            this.updatePackage(this.id);
        }
        else {
            this.createPackage();
        }
    };
    PackageDetailComponent.prototype.createPackage = function () {
        var _this = this;
        var pack = this.createDataObject();
        this.apiService
            .create(this.entity, pack)
            .subscribe(function (pack) {
            _this.pack = pack;
            _this.toasterService.pop('success', 'Success', 'Package created!');
            _this.disabled = false;
            _this.router.navigate(['/package', _this.pack.id]);
            _this.id = _this.pack.id;
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with creating package!');
            _this.disabled = false;
            _this.router.navigate(['/packages']);
        });
    };
    PackageDetailComponent.prototype.updatePackage = function (id) {
        var _this = this;
        var pack = this.createDataObject();
        this.apiService
            .update(this.entity, this.id, pack)
            .subscribe(function (pack) {
            _this.pack = pack;
            _this.toasterService.pop('success', 'Success', 'Package updated!');
            _this.router.navigate(['/packages']);
            _this.disabled = false;
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with updating pack!');
            _this.disabled = false;
            _this.router.navigate(['/packages']);
        });
    };
    PackageDetailComponent.prototype.deletePackage = function (id) {
        var _this = this;
        this.disabled = true;
        this.apiService
            .delete(this.entity, this.id)
            .subscribe(function () {
            _this.toasterService.pop('success', 'Success', 'Package deleted!');
            _this.disabled = false;
            _this.router.navigate(['/packages']);
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with deleting package!');
            _this.disabled = false;
            _this.router.navigate(['/packages']);
        });
    };
    PackageDetailComponent.prototype.populatePackage = function () {
        var _this = this;
        __WEBPACK_IMPORTED_MODULE_0_rxjs_Rx__["Observable"].forkJoin(this.apiService.get(this.entity, this.id), this.apiPanelService.getAll()).subscribe(function (result) {
            _this.pack = result[0];
            _this.panels = result[1];
            _this.createFormGroup();
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Something went wrong!');
            _this.router.navigate(['/packages']);
        });
    };
    PackageDetailComponent.prototype.initializePackage = function () {
        var _this = this;
        this.pack = {
            id: null,
            name: '',
            description: ''
        };
        this.apiPanelService.getAll().subscribe(function (panels) { _this.panels = panels; }, function (error) { return _this.errorMessage = error; });
        this.createFormGroup();
    };
    PackageDetailComponent.prototype.createFormGroup = function () {
        this.packageForm = this.fb.group({
            name: this.pack.name,
            selectedPanels: new __WEBPACK_IMPORTED_MODULE_5__angular_forms__["c" /* FormControl */](this.getPanelId())
        });
    };
    PackageDetailComponent.prototype.createDataObject = function () {
        var pack = {
            'name': [this.packageForm.value.name],
            'panels': this.packageForm.value.selectedPanels,
        };
        return pack;
    };
    PackageDetailComponent.prototype.getPanelId = function () {
        if (this.panels) {
            var panelIds = [];
            for (var i = 0; i < this.panels.length; i++) {
                if (this.id == +this.panels[i].package_id) {
                    panelIds.push(this.panels[i].id);
                }
            }
            return panelIds;
        }
    };
    PackageDetailComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_1__angular_core__["Component"])({
            selector: 'app-package-detail',
            template: __webpack_require__(769)
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_3__service_api_panel_service__["a" /* ApiPanelService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_3__service_api_panel_service__["a" /* ApiPanelService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_2__service_api_service__["a" /* ApiService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2__service_api_service__["a" /* ApiService */]) === 'function' && _b) || Object, (typeof (_c = typeof __WEBPACK_IMPORTED_MODULE_4__angular_router__["a" /* Router */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_4__angular_router__["a" /* Router */]) === 'function' && _c) || Object, (typeof (_d = typeof __WEBPACK_IMPORTED_MODULE_4__angular_router__["c" /* ActivatedRoute */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_4__angular_router__["c" /* ActivatedRoute */]) === 'function' && _d) || Object, (typeof (_e = typeof __WEBPACK_IMPORTED_MODULE_5__angular_forms__["d" /* FormBuilder */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_5__angular_forms__["d" /* FormBuilder */]) === 'function' && _e) || Object, (typeof (_f = typeof __WEBPACK_IMPORTED_MODULE_6_angular2_toaster__["b" /* ToasterService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_6_angular2_toaster__["b" /* ToasterService */]) === 'function' && _f) || Object])
    ], PackageDetailComponent);
    return PackageDetailComponent;
    var _a, _b, _c, _d, _e, _f;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/package-detail.component.js.map

/***/ }),

/***/ 583:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__service_api_service__ = __webpack_require__(12);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__ = __webpack_require__(9);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return PackagesComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};



var PackagesComponent = (function () {
    function PackagesComponent(apiService, toasterService) {
        this.apiService = apiService;
        this.toasterService = toasterService;
        this.entity_url = 'packages/all';
    }
    PackagesComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.apiService.getAll(this.entity_url)
            .subscribe(function (packages) { return _this.packages = packages; }, function (error) { _this.errorMessage = error; _this.toasterService.pop('error', 'Error', 'Error with loading packages'); });
    };
    PackagesComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'app-packages',
            template: __webpack_require__(770)
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1__service_api_service__["a" /* ApiService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_1__service_api_service__["a" /* ApiService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__["b" /* ToasterService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__["b" /* ToasterService */]) === 'function' && _b) || Object])
    ], PackagesComponent);
    return PackagesComponent;
    var _a, _b;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/packages.component.js.map

/***/ }),

/***/ 584:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__service_api_panel_service__ = __webpack_require__(183);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__service_api_service__ = __webpack_require__(12);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__angular_router__ = __webpack_require__(17);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__angular_forms__ = __webpack_require__(27);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5_angular2_toaster__ = __webpack_require__(9);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6_rxjs__ = __webpack_require__(31);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6_rxjs___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_6_rxjs__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return PanelDetailComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};







var PanelDetailComponent = (function () {
    function PanelDetailComponent(apiPanelService, apiService, router, route, fb, toasterService) {
        this.apiPanelService = apiPanelService;
        this.apiService = apiService;
        this.router = router;
        this.route = route;
        this.fb = fb;
        this.toasterService = toasterService;
        this.disabled = false;
    }
    PanelDetailComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.id = this.route.snapshot.params['id'];
        if (this.id != -1) {
            this.populatePanel();
        }
        else {
            this.panel = {
                id: null,
                package_id: '',
                description: '',
                key: '',
                name: ''
            };
            this.createFormGroup();
            this.fieldgroups = [];
        }
        ;
        this.apiService
            .getAll('fieldgroups/all')
            .subscribe(function (allFieldGroups) {
            _this.allFieldGroups = allFieldGroups;
        }, function (error) { return _this.errorMessage = error; });
    };
    PanelDetailComponent.prototype.onSubmit = function () {
        this.disabled = true;
        if (this.id != -1) {
            this.updatePanel(this.id);
        }
        else {
            this.createPanel();
        }
    };
    PanelDetailComponent.prototype.createPanel = function () {
        var _this = this;
        var panel = this.createDataObject();
        this.apiPanelService.create(panel)
            .subscribe(function (panel) {
            _this.panel = panel;
            _this.toasterService.pop('success', 'Success', 'Panel created!');
            _this.disabled = false;
            _this.router.navigate(['/panel', _this.panel.id]);
            _this.id = _this.panel.id;
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with creating panel!');
            _this.disabled = false;
            _this.router.navigate(['/panels']);
        });
    };
    PanelDetailComponent.prototype.updatePanel = function (id) {
        var _this = this;
        var panel = this.createDataObject();
        this.apiPanelService.update(id, panel)
            .subscribe(function (panel) {
            _this.panel = panel;
            _this.toasterService.pop('success', 'Success', 'Panel updated!');
            _this.router.navigate(['/panels']);
            _this.disabled = false;
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with updating panel!');
            _this.disabled = false;
            _this.router.navigate(['/panels']);
        });
    };
    PanelDetailComponent.prototype.deletePanel = function (id) {
        var _this = this;
        this.disabled = true;
        this.apiPanelService.delete(id)
            .subscribe(function () {
            _this.toasterService.pop('success', 'Success', 'Panel deleted!');
            _this.disabled = false;
            _this.router.navigate(['/panels']);
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with deleting panel!');
            _this.disabled = false;
            _this.router.navigate(['/panels']);
        });
    };
    PanelDetailComponent.prototype.populatePanel = function () {
        var _this = this;
        __WEBPACK_IMPORTED_MODULE_6_rxjs__["Observable"].forkJoin(this.apiPanelService.get(this.id), this.apiPanelService.getFieldGroups(this.id)).subscribe(function (result) {
            _this.panel = result[0];
            _this.fieldgroups = result[1];
            _this.createFormGroup();
            _this.populateFieldGroups();
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Something went wrong!');
            _this.router.navigate(['/panels']);
        });
    };
    PanelDetailComponent.prototype.createFormGroup = function () {
        this.panelForm = this.fb.group({
            name: this.panel.name,
            key: this.panel.key,
            selectedFieldGroups: this.fb.array([])
        });
    };
    PanelDetailComponent.prototype.initFieldGroup = function (value) {
        return this.fb.group({
            id: ['' + value]
        });
    };
    PanelDetailComponent.prototype.populateFieldGroups = function () {
        var control = this.panelForm.controls['selectedFieldGroups'];
        for (var i = 0; i < this.fieldgroups.length; i++) {
            control.push(this.initFieldGroup(this.fieldgroups[i].id));
        }
    };
    PanelDetailComponent.prototype.addNewFieldGroup = function () {
        var control = this.panelForm.controls['selectedFieldGroups'];
        control.push(this.initFieldGroup());
    };
    PanelDetailComponent.prototype.createDataObject = function () {
        var panel = {
            'name': this.panelForm.value.name,
            'key': this.panelForm.value.key,
            'fieldGroups': this.panelForm.value.selectedFieldGroups
        };
        return panel;
    };
    PanelDetailComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'app-panel-detail',
            template: __webpack_require__(771)
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1__service_api_panel_service__["a" /* ApiPanelService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_1__service_api_panel_service__["a" /* ApiPanelService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_2__service_api_service__["a" /* ApiService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2__service_api_service__["a" /* ApiService */]) === 'function' && _b) || Object, (typeof (_c = typeof __WEBPACK_IMPORTED_MODULE_3__angular_router__["a" /* Router */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_3__angular_router__["a" /* Router */]) === 'function' && _c) || Object, (typeof (_d = typeof __WEBPACK_IMPORTED_MODULE_3__angular_router__["c" /* ActivatedRoute */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_3__angular_router__["c" /* ActivatedRoute */]) === 'function' && _d) || Object, (typeof (_e = typeof __WEBPACK_IMPORTED_MODULE_4__angular_forms__["d" /* FormBuilder */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_4__angular_forms__["d" /* FormBuilder */]) === 'function' && _e) || Object, (typeof (_f = typeof __WEBPACK_IMPORTED_MODULE_5_angular2_toaster__["b" /* ToasterService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_5_angular2_toaster__["b" /* ToasterService */]) === 'function' && _f) || Object])
    ], PanelDetailComponent);
    return PanelDetailComponent;
    var _a, _b, _c, _d, _e, _f;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/panel-detail.component.js.map

/***/ }),

/***/ 585:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__service_api_panel_service__ = __webpack_require__(183);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__ = __webpack_require__(9);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return PanelsComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};



var PanelsComponent = (function () {
    function PanelsComponent(apiPanelService, toasterService) {
        this.apiPanelService = apiPanelService;
        this.toasterService = toasterService;
        this.entity_url = 'panels/all';
    }
    PanelsComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.apiPanelService.getAll()
            .subscribe(function (panels) { return _this.panels = panels; }, function (error) { _this.errorMessage = error; _this.toasterService.pop('error', 'Error', 'Error with loading panels'); });
    };
    PanelsComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'app-panels',
            template: __webpack_require__(772)
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1__service_api_panel_service__["a" /* ApiPanelService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_1__service_api_panel_service__["a" /* ApiPanelService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__["b" /* ToasterService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__["b" /* ToasterService */]) === 'function' && _b) || Object])
    ], PanelsComponent);
    return PanelsComponent;
    var _a, _b;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/panels.component.js.map

/***/ }),

/***/ 586:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_rxjs__ = __webpack_require__(31);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_rxjs___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_rxjs__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__service_api_reference_service__ = __webpack_require__(132);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__service_api_store_service__ = __webpack_require__(86);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__service_api_product_service__ = __webpack_require__(184);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__service_api_service__ = __webpack_require__(12);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__angular_router__ = __webpack_require__(17);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7__angular_forms__ = __webpack_require__(27);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_8_angular2_toaster__ = __webpack_require__(9);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ProductDetailComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};









var ProductDetailComponent = (function () {
    function ProductDetailComponent(apiService, apiReferenceService, apiProductService, apiStoreService, router, route, fb, toasterService) {
        this.apiService = apiService;
        this.apiReferenceService = apiReferenceService;
        this.apiProductService = apiProductService;
        this.apiStoreService = apiStoreService;
        this.router = router;
        this.route = route;
        this.fb = fb;
        this.toasterService = toasterService;
        this.disabled = false;
        this.newImages = [];
        this.dirty = false;
    }
    ProductDetailComponent.prototype.ngOnInit = function () {
        this.id = this.route.snapshot.params['id'];
        this.createFormGroup();
        if (this.id != -1) {
            this.populateProduct();
        }
        else {
            this.initializeProduct();
        }
    };
    ProductDetailComponent.prototype.onSubmit = function () {
        this.disabled = true;
        if (this.id != -1) {
            this.updateProduct(this.id);
        }
        else {
            this.createProduct();
        }
    };
    ProductDetailComponent.prototype.createProduct = function () {
        var _this = this;
        var product = this.createDataObject();
        this.apiProductService
            .create(product)
            .subscribe(function (product) {
            _this.product = product;
            _this.toasterService.pop('success', 'Success', 'Product created!');
            _this.disabled = false;
            _this.router.navigate(['/products']);
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with creating product!');
            _this.disabled = false;
            _this.router.navigate(['/products']);
        });
    };
    ProductDetailComponent.prototype.updateProduct = function (id) {
        var _this = this;
        var product = this.createDataObject();
        this.apiProductService
            .update(this.id, product)
            .subscribe(function (product) {
            _this.product = product;
            _this.toasterService.pop('success', 'Success', 'Product updated!');
            _this.router.navigate(['/products']);
            _this.disabled = false;
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with updating product!');
            _this.disabled = false;
            _this.router.navigate(['/products']);
        });
    };
    ProductDetailComponent.prototype.deleteProduct = function (id) {
        var _this = this;
        this.disabled = true;
        this.apiProductService
            .delete(this.id)
            .subscribe(function () {
            _this.toasterService.pop('success', 'Success', 'Product deleted!');
            _this.disabled = false;
            _this.router.navigate(['/products']);
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with deleting product!');
            _this.disabled = false;
            _this.router.navigate(['/products']);
        });
    };
    ProductDetailComponent.prototype.deleteImage = function (id, index) {
        var _this = this;
        this.disabled = true;
        var product = {
            'productId': this.id
        };
        this.apiProductService
            .deleteImage(id, product)
            .subscribe(function (image) {
            _this.toasterService.pop('success', 'Success', 'Image deleted!');
            _this.disabled = false;
            _this.myImages.splice(index, 1);
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with deleting image!');
        });
    };
    ProductDetailComponent.prototype.populateProduct = function () {
        var _this = this;
        __WEBPACK_IMPORTED_MODULE_0_rxjs__["Observable"].forkJoin(this.apiProductService.get(this.id), this.apiStoreService.getAll(), this.apiProductService.getReferences(this.id), this.apiReferenceService.getAll(), this.apiProductService.getCategories(this.id), this.apiService.getAll('categories/all'), this.apiService.getAll('manufacturers/all'), this.apiProductService.getImages(this.id)).subscribe(function (result) {
            _this.product = result[0];
            _this.stores = result[1];
            _this.myReferences = result[2];
            _this.allReferences = result[3];
            _this.myCategories = result[4];
            _this.allCategories = result[5];
            _this.manufacturers = result[6];
            _this.myImages = result[7];
            _this.setFormGroup();
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Something went wrong with loading product!');
            _this.router.navigate(['/products']);
        });
    };
    ProductDetailComponent.prototype.initializeProduct = function () {
        var _this = this;
        this.product = {
            id: null,
            title: '',
            description: '',
            SKU: '',
            category_ids: '',
            short_description: '',
            weight: '',
            news_from_date: '',
            news_to_date: '',
            country_of_manufacture: '',
            price: '',
            url_key: '',
            mag_product_id: '',
            image_id: '',
            store_id: '',
            manufacturer_id: '',
            views: '',
            productImage: '',
            categoriesNice: ''
        };
        __WEBPACK_IMPORTED_MODULE_0_rxjs__["Observable"].forkJoin(this.apiStoreService.getAll(), this.apiReferenceService.getAll(), this.apiService.getAll('categories/all'), this.apiService.getAll('manufacturers/all')).subscribe(function (result) {
            _this.stores = result[0];
            _this.allReferences = result[1];
            _this.allCategories = result[2];
            _this.manufacturers = result[3];
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Something went wrong!');
            _this.router.navigate(['/products']);
        });
    };
    ProductDetailComponent.prototype.createDataObject = function () {
        var reference = {
            'title': this.productForm.value.title,
            'description': this.productForm.value.description,
            'price': this.productForm.value.price,
            'store_id': this.productForm.value.store_id,
            'references': this.productForm.value.selectedReferences,
            'categories': this.productForm.value.selectedCategories,
            'manufacturer_id': this.productForm.value.manufacturer_id,
        };
        if (this.dirty) {
            reference['newImages'] = this.newImages;
        }
        return reference;
    };
    ProductDetailComponent.prototype.createFormGroup = function () {
        this.productForm = this.fb.group({
            title: '',
            description: '',
            price: '',
            store_id: '',
            selectedReferences: new __WEBPACK_IMPORTED_MODULE_7__angular_forms__["c" /* FormControl */]([]),
            selectedCategories: new __WEBPACK_IMPORTED_MODULE_7__angular_forms__["c" /* FormControl */]([]),
            manufacturer_id: ''
        });
    };
    ProductDetailComponent.prototype.setFormGroup = function () {
        this.productForm.controls['title'].setValue(this.product.title);
        this.productForm.controls['description'].setValue(this.product.description);
        this.productForm.controls['price'].setValue(this.product.price);
        this.productForm.controls['store_id'].setValue(this.product.store_id);
        this.productForm.controls['manufacturer_id'].setValue(this.product.manufacturer_id);
        this.productForm.controls['selectedCategories'].setValue(this.getCategoryId());
        this.productForm.controls['selectedReferences'].setValue(this.getReferenceId());
    };
    ProductDetailComponent.prototype.getCategoryId = function () {
        if (this.myCategories) {
            var categoryIds = [];
            for (var i = 0; i < this.myCategories.length; i++) {
                categoryIds.push(this.myCategories[i].id);
            }
            return categoryIds;
        }
    };
    ProductDetailComponent.prototype.getReferenceId = function () {
        if (this.myReferences) {
            var referenceIds = [];
            for (var i = 0; i < this.myReferences.length; i++) {
                referenceIds.push(this.myReferences[i].id);
            }
            return referenceIds;
        }
    };
    ProductDetailComponent.prototype.changeListener = function ($event) {
        this.readThis($event.target);
    };
    ProductDetailComponent.prototype.readThis = function (inputValue) {
        var _this = this;
        var file = inputValue.files[0];
        var myReader = new FileReader();
        if (!inputValue.files || inputValue.files.length === 0) {
            return;
        }
        myReader.onloadend = function (e) {
            _this.newImages.push(myReader.result);
            _this.dirty = true;
        };
        myReader.readAsDataURL(file);
    };
    ProductDetailComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_1__angular_core__["Component"])({
            selector: 'app-product-detail',
            template: __webpack_require__(773)
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_5__service_api_service__["a" /* ApiService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_5__service_api_service__["a" /* ApiService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_2__service_api_reference_service__["a" /* ApiReferenceService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2__service_api_reference_service__["a" /* ApiReferenceService */]) === 'function' && _b) || Object, (typeof (_c = typeof __WEBPACK_IMPORTED_MODULE_4__service_api_product_service__["a" /* ApiProductService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_4__service_api_product_service__["a" /* ApiProductService */]) === 'function' && _c) || Object, (typeof (_d = typeof __WEBPACK_IMPORTED_MODULE_3__service_api_store_service__["a" /* ApiStoreService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_3__service_api_store_service__["a" /* ApiStoreService */]) === 'function' && _d) || Object, (typeof (_e = typeof __WEBPACK_IMPORTED_MODULE_6__angular_router__["a" /* Router */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_6__angular_router__["a" /* Router */]) === 'function' && _e) || Object, (typeof (_f = typeof __WEBPACK_IMPORTED_MODULE_6__angular_router__["c" /* ActivatedRoute */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_6__angular_router__["c" /* ActivatedRoute */]) === 'function' && _f) || Object, (typeof (_g = typeof __WEBPACK_IMPORTED_MODULE_7__angular_forms__["d" /* FormBuilder */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_7__angular_forms__["d" /* FormBuilder */]) === 'function' && _g) || Object, (typeof (_h = typeof __WEBPACK_IMPORTED_MODULE_8_angular2_toaster__["b" /* ToasterService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_8_angular2_toaster__["b" /* ToasterService */]) === 'function' && _h) || Object])
    ], ProductDetailComponent);
    return ProductDetailComponent;
    var _a, _b, _c, _d, _e, _f, _g, _h;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/product-detail.component.js.map

/***/ }),

/***/ 587:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__service_api_product_service__ = __webpack_require__(184);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__ = __webpack_require__(9);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ProductsComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};



var ProductsComponent = (function () {
    function ProductsComponent(apiProductService, toasterService) {
        this.apiProductService = apiProductService;
        this.toasterService = toasterService;
    }
    ProductsComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.apiProductService
            .getAll()
            .subscribe(function (products) { return _this.products = products; }, function (error) { _this.errorMessage = error; _this.toasterService.pop('error', 'Error', 'Error with loading products'); });
    };
    ProductsComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'app-products',
            template: __webpack_require__(774)
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1__service_api_product_service__["a" /* ApiProductService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_1__service_api_product_service__["a" /* ApiProductService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__["b" /* ToasterService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__["b" /* ToasterService */]) === 'function' && _b) || Object])
    ], ProductsComponent);
    return ProductsComponent;
    var _a, _b;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/products.component.js.map

/***/ }),

/***/ 588:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_rxjs_Rx__ = __webpack_require__(31);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_rxjs_Rx___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_rxjs_Rx__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__service_api_reference_service__ = __webpack_require__(132);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__service_api_store_service__ = __webpack_require__(86);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__service_api_product_service__ = __webpack_require__(184);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__service_api_service__ = __webpack_require__(12);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__angular_router__ = __webpack_require__(17);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7__angular_forms__ = __webpack_require__(27);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_8_angular2_toaster__ = __webpack_require__(9);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ReferenceDetailComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};









var ReferenceDetailComponent = (function () {
    function ReferenceDetailComponent(apiService, apiReferenceService, apiProductService, apiStoreService, router, route, fb, toasterService) {
        this.apiService = apiService;
        this.apiReferenceService = apiReferenceService;
        this.apiProductService = apiProductService;
        this.apiStoreService = apiStoreService;
        this.router = router;
        this.route = route;
        this.fb = fb;
        this.toasterService = toasterService;
        this.disabled = false;
        this.newImages = [];
        this.dirty = false;
    }
    ReferenceDetailComponent.prototype.ngOnInit = function () {
        this.id = this.route.snapshot.params['id'];
        this.createFormGroup();
        if (this.id != -1) {
            this.populateReference();
        }
        else {
            this.initializeReference();
        }
    };
    ReferenceDetailComponent.prototype.onSubmit = function () {
        this.disabled = true;
        if (this.id != -1) {
            this.updateReference(this.id);
        }
        else {
            this.createReference();
        }
    };
    ReferenceDetailComponent.prototype.createReference = function () {
        var _this = this;
        var reference = this.createDataObject();
        this.apiReferenceService
            .create(reference)
            .subscribe(function (reference) {
            _this.reference = reference;
            _this.toasterService.pop('success', 'Success', 'Reference created!');
            _this.disabled = false;
            _this.router.navigate(['/references']);
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with creating reference!');
            _this.disabled = false;
            _this.router.navigate(['/references']);
        });
    };
    ReferenceDetailComponent.prototype.updateReference = function (id) {
        var _this = this;
        var reference = this.createDataObject();
        this.apiReferenceService
            .update(this.id, reference)
            .subscribe(function (reference) {
            _this.reference = reference;
            _this.toasterService.pop('success', 'Success', 'Reference updated!');
            _this.router.navigate(['/references']);
            _this.disabled = false;
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with updating reference!');
            _this.disabled = false;
            _this.router.navigate(['/references']);
        });
    };
    ReferenceDetailComponent.prototype.deleteReference = function (id) {
        var _this = this;
        this.disabled = true;
        this.apiReferenceService
            .delete(this.id)
            .subscribe(function () {
            _this.toasterService.pop('success', 'Success', 'Reference deleted!');
            _this.disabled = false;
            _this.router.navigate(['/references']);
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with deleting reference!');
            _this.disabled = false;
            _this.router.navigate(['/references']);
        });
    };
    ReferenceDetailComponent.prototype.deleteImage = function (id, index) {
        var _this = this;
        this.disabled = true;
        var ref = {
            'referenceId': this.id
        };
        this.apiReferenceService
            .deleteImage(id, ref)
            .subscribe(function (image) {
            _this.toasterService.pop('success', 'Success', 'Image deleted!');
            _this.disabled = false;
            _this.myImages.splice(index, 1);
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with deleting reference!');
        });
    };
    ReferenceDetailComponent.prototype.populateReference = function () {
        var _this = this;
        __WEBPACK_IMPORTED_MODULE_0_rxjs_Rx__["Observable"].forkJoin(this.apiReferenceService.get(this.id), this.apiStoreService.getAll(), this.apiReferenceService.getProducts(this.id), this.apiProductService.getAll(), this.apiReferenceService.getManufacturers(this.id), this.apiService.getAll('manufacturers/all'), this.apiReferenceService.getImages(this.id)).subscribe(function (result) {
            _this.reference = result[0];
            _this.stores = result[1];
            _this.myProducts = result[2];
            _this.allProducts = result[3];
            _this.myManufacturers = result[4];
            _this.allManufacturers = result[5];
            _this.myImages = result[6];
            _this.setFormGroup();
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Something went wrong with loading reference!');
            _this.router.navigate(['/references']);
        });
    };
    ReferenceDetailComponent.prototype.initializeReference = function () {
        var _this = this;
        this.reference = {
            id: null,
            title: '',
            status: '',
            description: '',
            video: '',
            store_id: '',
            views: '',
            html: '',
            store: null
        };
        __WEBPACK_IMPORTED_MODULE_0_rxjs_Rx__["Observable"].forkJoin(this.apiStoreService.getAll(), this.apiProductService.getAll(), this.apiService.getAll('manufacturers/all')).subscribe(function (result) {
            _this.stores = result[0];
            _this.allProducts = result[1];
            _this.allManufacturers = result[2];
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Something went wrong!');
            _this.router.navigate(['/references']);
        });
    };
    ReferenceDetailComponent.prototype.createFormGroup = function () {
        this.referenceForm = this.fb.group({
            title: '',
            description: '',
            video: '',
            store_id: '',
            selectedProducts: new __WEBPACK_IMPORTED_MODULE_7__angular_forms__["c" /* FormControl */]([]),
            selectedManufacturers: new __WEBPACK_IMPORTED_MODULE_7__angular_forms__["c" /* FormControl */]([])
        });
    };
    ReferenceDetailComponent.prototype.createDataObject = function () {
        var reference = {
            'title': this.referenceForm.value.title,
            'description': this.referenceForm.value.description,
            'video': this.referenceForm.value.video,
            'store_id': this.referenceForm.value.store_id,
            'products': this.referenceForm.value.selectedProducts,
            'manufacturers': this.referenceForm.value.selectedManufacturers,
        };
        if (this.dirty) {
            reference['newImages'] = this.newImages;
        }
        return reference;
    };
    ReferenceDetailComponent.prototype.setFormGroup = function () {
        this.referenceForm.controls['title'].setValue(this.reference.title);
        this.referenceForm.controls['description'].setValue(this.reference.description);
        this.referenceForm.controls['video'].setValue(this.reference.video);
        this.referenceForm.controls['store_id'].setValue(this.reference.store_id);
        this.referenceForm.controls['selectedManufacturers'].setValue(this.getManufacturerId());
        this.referenceForm.controls['selectedProducts'].setValue(this.getProductId());
    };
    ReferenceDetailComponent.prototype.getProductId = function () {
        if (this.myProducts) {
            var productIds = [];
            for (var i = 0; i < this.myProducts.length; i++) {
                productIds.push(this.myProducts[i].id);
            }
            return productIds;
        }
    };
    ReferenceDetailComponent.prototype.getManufacturerId = function () {
        if (this.myManufacturers) {
            var manufacturerIds = [];
            for (var i = 0; i < this.myManufacturers.length; i++) {
                manufacturerIds.push(this.myManufacturers[i].id);
            }
            return manufacturerIds;
        }
    };
    ReferenceDetailComponent.prototype.changeListener = function ($event) {
        this.readThis($event.target);
    };
    ReferenceDetailComponent.prototype.readThis = function (inputValue) {
        var _this = this;
        var file = inputValue.files[0];
        var myReader = new FileReader();
        if (!inputValue.files || inputValue.files.length === 0) {
            return;
        }
        myReader.onloadend = function (e) {
            _this.newImages.push(myReader.result);
            _this.dirty = true;
        };
        myReader.readAsDataURL(file);
    };
    ReferenceDetailComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_1__angular_core__["Component"])({
            selector: 'app-reference-detail',
            template: __webpack_require__(775)
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_5__service_api_service__["a" /* ApiService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_5__service_api_service__["a" /* ApiService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_2__service_api_reference_service__["a" /* ApiReferenceService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2__service_api_reference_service__["a" /* ApiReferenceService */]) === 'function' && _b) || Object, (typeof (_c = typeof __WEBPACK_IMPORTED_MODULE_4__service_api_product_service__["a" /* ApiProductService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_4__service_api_product_service__["a" /* ApiProductService */]) === 'function' && _c) || Object, (typeof (_d = typeof __WEBPACK_IMPORTED_MODULE_3__service_api_store_service__["a" /* ApiStoreService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_3__service_api_store_service__["a" /* ApiStoreService */]) === 'function' && _d) || Object, (typeof (_e = typeof __WEBPACK_IMPORTED_MODULE_6__angular_router__["a" /* Router */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_6__angular_router__["a" /* Router */]) === 'function' && _e) || Object, (typeof (_f = typeof __WEBPACK_IMPORTED_MODULE_6__angular_router__["c" /* ActivatedRoute */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_6__angular_router__["c" /* ActivatedRoute */]) === 'function' && _f) || Object, (typeof (_g = typeof __WEBPACK_IMPORTED_MODULE_7__angular_forms__["d" /* FormBuilder */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_7__angular_forms__["d" /* FormBuilder */]) === 'function' && _g) || Object, (typeof (_h = typeof __WEBPACK_IMPORTED_MODULE_8_angular2_toaster__["b" /* ToasterService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_8_angular2_toaster__["b" /* ToasterService */]) === 'function' && _h) || Object])
    ], ReferenceDetailComponent);
    return ReferenceDetailComponent;
    var _a, _b, _c, _d, _e, _f, _g, _h;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/reference-detail.component.js.map

/***/ }),

/***/ 589:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__service_api_reference_service__ = __webpack_require__(132);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__ = __webpack_require__(9);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ReferencesComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};



var ReferencesComponent = (function () {
    function ReferencesComponent(apiReferenceService, toasterService) {
        this.apiReferenceService = apiReferenceService;
        this.toasterService = toasterService;
    }
    ReferencesComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.apiReferenceService
            .getAll()
            .subscribe(function (references) { return _this.references = references; }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with loading references');
        });
    };
    ReferencesComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'app-references',
            template: __webpack_require__(776)
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1__service_api_reference_service__["a" /* ApiReferenceService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_1__service_api_reference_service__["a" /* ApiReferenceService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__["b" /* ToasterService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__["b" /* ToasterService */]) === 'function' && _b) || Object])
    ], ReferencesComponent);
    return ReferencesComponent;
    var _a, _b;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/references.component.js.map

/***/ }),

/***/ 590:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__service_api_service__ = __webpack_require__(12);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__angular_router__ = __webpack_require__(17);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__angular_forms__ = __webpack_require__(27);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4_angular2_toaster__ = __webpack_require__(9);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return RegisterfieldDetailComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};





var RegisterfieldDetailComponent = (function () {
    function RegisterfieldDetailComponent(apiService, router, route, fb, toasterService) {
        this.apiService = apiService;
        this.router = router;
        this.route = route;
        this.fb = fb;
        this.toasterService = toasterService;
        this.entity = 'registerfields';
        this.disabled = false;
    }
    RegisterfieldDetailComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.id = this.route.snapshot.params['id'];
        if (this.id != -1) {
            this.apiService.get(this.entity, this.id)
                .subscribe(function (registerfield) {
                _this.registerfield = registerfield;
                _this.createFormGroup();
            }, function (error) {
                _this.errorMessage = error;
                _this.toasterService.pop('error', 'Error', 'Registration field with given ID doesn`t exist!');
                _this.router.navigate(['/registerfields']);
            });
        }
        else {
            this.registerfield = {
                id: null,
                key: '',
                name: '',
                values: '',
                fieldlocation: '',
                order: ''
            };
            this.createFormGroup();
        }
    };
    RegisterfieldDetailComponent.prototype.onSubmit = function () {
        this.disabled = true;
        if (this.id != -1) {
            this.updateRegisterfield(this.id);
        }
        else {
            this.createRegisterfield();
        }
    };
    RegisterfieldDetailComponent.prototype.createRegisterfield = function () {
        var _this = this;
        var registerfield = this.createDataObject();
        this.apiService.create(this.entity, registerfield)
            .subscribe(function (registerfield) {
            _this.registerfield = registerfield;
            _this.toasterService.pop('success', 'Success', 'Registerfield created!');
            _this.disabled = false;
            _this.router.navigate(['/registerfield', _this.registerfield.id]);
            _this.id = _this.registerfield.id;
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with creating registerfield!');
            _this.disabled = false;
            _this.router.navigate(['/registerfields']);
        });
    };
    RegisterfieldDetailComponent.prototype.updateRegisterfield = function (id) {
        var _this = this;
        var registerfield = this.createDataObject();
        this.apiService.update(this.entity, this.id, registerfield)
            .subscribe(function (registerfield) {
            _this.registerfield = registerfield;
            _this.toasterService.pop('success', 'Success', 'Registerfield updated!');
            _this.disabled = false;
            _this.router.navigate(['/registerfields']);
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with updating registerfield!');
            _this.disabled = false;
            _this.router.navigate(['/registerfields']);
        });
    };
    RegisterfieldDetailComponent.prototype.deleteRegisterfield = function (id) {
        var _this = this;
        this.disabled = true;
        this.apiService.delete(this.entity, this.id)
            .subscribe(function () {
            _this.toasterService.pop('success', 'Success', 'Registerfield deleted!');
            _this.disabled = false;
            _this.router.navigate(['/registerfields']);
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with deleting registerfield!');
            _this.disabled = false;
            _this.router.navigate(['/registerfields']);
        });
    };
    RegisterfieldDetailComponent.prototype.createFormGroup = function () {
        this.registerfieldForm = this.fb.group({
            key: this.registerfield.key,
            name: this.registerfield.name,
            location: this.registerfield.fieldlocation,
        });
    };
    RegisterfieldDetailComponent.prototype.createDataObject = function () {
        var registerfield = {
            'key': this.registerfieldForm.value.key,
            'name': this.registerfieldForm.value.name,
            'fieldlocation': this.registerfieldForm.value.location,
        };
        return registerfield;
    };
    RegisterfieldDetailComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'app-registerfield-detail',
            template: __webpack_require__(777)
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1__service_api_service__["a" /* ApiService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_1__service_api_service__["a" /* ApiService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_2__angular_router__["a" /* Router */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2__angular_router__["a" /* Router */]) === 'function' && _b) || Object, (typeof (_c = typeof __WEBPACK_IMPORTED_MODULE_2__angular_router__["c" /* ActivatedRoute */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2__angular_router__["c" /* ActivatedRoute */]) === 'function' && _c) || Object, (typeof (_d = typeof __WEBPACK_IMPORTED_MODULE_3__angular_forms__["d" /* FormBuilder */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_3__angular_forms__["d" /* FormBuilder */]) === 'function' && _d) || Object, (typeof (_e = typeof __WEBPACK_IMPORTED_MODULE_4_angular2_toaster__["b" /* ToasterService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_4_angular2_toaster__["b" /* ToasterService */]) === 'function' && _e) || Object])
    ], RegisterfieldDetailComponent);
    return RegisterfieldDetailComponent;
    var _a, _b, _c, _d, _e;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/registerfield-detail.component.js.map

/***/ }),

/***/ 591:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__service_api_service__ = __webpack_require__(12);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__ = __webpack_require__(9);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return RegisterfieldsComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};



var RegisterfieldsComponent = (function () {
    function RegisterfieldsComponent(apiService, toasterService) {
        this.apiService = apiService;
        this.toasterService = toasterService;
        this.entity_url = 'registerfields/all';
    }
    RegisterfieldsComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.apiService.getAll(this.entity_url)
            .subscribe(function (registerfields) { return _this.registerfields = registerfields; }, function (error) { _this.errorMessage = error; _this.toasterService.pop('error', 'Error', 'Error with loading registerfields'); });
    };
    RegisterfieldsComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'app-registerfields',
            template: __webpack_require__(778)
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1__service_api_service__["a" /* ApiService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_1__service_api_service__["a" /* ApiService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__["b" /* ToasterService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__["b" /* ToasterService */]) === 'function' && _b) || Object])
    ], RegisterfieldsComponent);
    return RegisterfieldsComponent;
    var _a, _b;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/registerfields.component.js.map

/***/ }),

/***/ 592:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__extended_http_service__ = __webpack_require__(73);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__angular_http__ = __webpack_require__(37);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__ = __webpack_require__(31);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__environments_environment__ = __webpack_require__(42);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5_rxjs_add_operator_map__ = __webpack_require__(63);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5_rxjs_add_operator_map___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_5_rxjs_add_operator_map__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6_rxjs_add_operator_catch__ = __webpack_require__(62);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6_rxjs_add_operator_catch___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_6_rxjs_add_operator_catch__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ApiEnService; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};







var ApiEnService = (function () {
    function ApiEnService(http) {
        this.http = http;
        this.apiUrl = __WEBPACK_IMPORTED_MODULE_4__environments_environment__["a" /* environment */].domain_url + "en/api/";
    }
    ApiEnService.prototype.getAll = function (entity) {
        return this.http.get(this.apiUrl + entity)
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiEnService.prototype.get = function (entity, id) {
        return this.http.get(this.apiUrl + entity + '/' + id)
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiEnService.prototype.create = function (entity, data) {
        var headers = new __WEBPACK_IMPORTED_MODULE_2__angular_http__["Headers"]({ 'Content-Type': 'application/json' });
        var options = new __WEBPACK_IMPORTED_MODULE_2__angular_http__["RequestOptions"]({ headers: headers });
        return this.http.post(this.apiUrl + entity + '/', data, options)
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiEnService.prototype.update = function (entity, id, data) {
        var headers = new __WEBPACK_IMPORTED_MODULE_2__angular_http__["Headers"]({ 'Content-Type': 'application/json' });
        var options = new __WEBPACK_IMPORTED_MODULE_2__angular_http__["RequestOptions"]({ headers: headers });
        return this.http.post(this.apiUrl + entity + '/' + id, data, options)
            .map(function (res) { res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiEnService.prototype.delete = function (entity, id) {
        return this.http.delete(this.apiUrl + entity + '/delete/' + id)
            .map(function (res) { })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiEnService = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_1__angular_core__["Injectable"])(), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_0__extended_http_service__["a" /* ExtendedHttpService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_0__extended_http_service__["a" /* ExtendedHttpService */]) === 'function' && _a) || Object])
    ], ApiEnService);
    return ApiEnService;
    var _a;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/api.en.service.js.map

/***/ }),

/***/ 593:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__service_api_store_service__ = __webpack_require__(86);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__service_api_service__ = __webpack_require__(12);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__angular_router__ = __webpack_require__(17);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__angular_forms__ = __webpack_require__(27);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5_angular2_toaster__ = __webpack_require__(9);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return SlideDetailComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};






var SlideDetailComponent = (function () {
    function SlideDetailComponent(apiService, router, route, fb, toasterService, apiStoreService) {
        this.apiService = apiService;
        this.router = router;
        this.route = route;
        this.fb = fb;
        this.toasterService = toasterService;
        this.apiStoreService = apiStoreService;
        this.entity = 'slides';
        this.disabled = false;
        this.base64 = null;
    }
    SlideDetailComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.id = this.route.snapshot.params['id'];
        if (this.id != -1) {
            this.apiService
                .get(this.entity, this.id)
                .subscribe(function (slide) {
                _this.slide = slide;
                _this.createFormGroup();
            }, function (error) {
                _this.errorMessage = error;
                _this.toasterService.pop('error', 'Error', 'Slide with given ID doesn`t exist!');
                _this.router.navigate(['/slides']);
            });
        }
        else {
            this.createNewSlide();
            this.createFormGroup();
        }
        this.apiStoreService
            .getAllActive()
            .subscribe(function (stores) { _this.stores = stores; }, function (error) { return _this.errorMessage = error; });
        this.base64 = null;
    };
    SlideDetailComponent.prototype.onSubmit = function () {
        this.disabled = true;
        if (this.id != -1) {
            this.updateSlide(this.id);
        }
        else {
            this.createSlide();
        }
    };
    SlideDetailComponent.prototype.createSlide = function () {
        var _this = this;
        var slide = this.createDataObject();
        this.apiService
            .create(this.entity, slide)
            .subscribe(function (slide) {
            _this.slide = slide;
            _this.toasterService.pop('success', 'Success', 'Slide created!');
            _this.disabled = false;
            _this.router.navigate(['/slide', _this.slide.id]);
            _this.id = _this.slide.id;
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with creating slide!');
            _this.disabled = false;
            _this.router.navigate(['/slides']);
        });
    };
    SlideDetailComponent.prototype.updateSlide = function (id) {
        var _this = this;
        var slide = this.createDataObject();
        this.apiService
            .update(this.entity, this.id, slide)
            .subscribe(function (slide) {
            _this.slide = slide;
            _this.toasterService.pop('success', 'Success', 'Slide updated!');
            _this.router.navigate(['/slides']);
            _this.disabled = false;
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with updating slides!');
            _this.disabled = false;
            _this.router.navigate(['/slides']);
        });
    };
    SlideDetailComponent.prototype.deleteSlide = function (id) {
        var _this = this;
        this.disabled = true;
        this.apiService
            .delete(this.entity, id)
            .subscribe(function () {
            _this.toasterService.pop('success', 'Success', 'Slide deleted!');
            _this.disabled = false;
            _this.router.navigate(['/slides']);
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with deleting slide!');
            _this.disabled = false;
            _this.router.navigate(['/slides']);
        });
    };
    SlideDetailComponent.prototype.changeListener = function ($event) {
        this.readThis($event.target);
    };
    SlideDetailComponent.prototype.readThis = function (inputValue) {
        var _this = this;
        var file = inputValue.files[0];
        var myReader = new FileReader();
        if (!inputValue.files || inputValue.files.length === 0) {
            return;
        }
        myReader.onloadend = function (e) {
            _this.base64 = myReader.result;
            _this.slide.image_url = myReader.result;
        };
        myReader.readAsDataURL(file);
    };
    SlideDetailComponent.prototype.createNewSlide = function () {
        this.slide = {
            id: null,
            title: '',
            image_url: '',
            slot1_store_id: '',
            slot1_width: '',
            slot1_valid_until: '',
            slot2_store_id: '',
            slot2_width: '',
            slot2_valid_until: '',
            slot3_store_id: '',
            slot3_width: '',
            slot3_valid_until: '',
            slot4_store_id: '',
            slot4_width: '',
            slot4_valid_until: '',
            slot5_store_id: '',
            slot5_width: '',
            slot5_valid_until: ''
        };
    };
    SlideDetailComponent.prototype.createFormGroup = function () {
        this.slideForm = this.fb.group({
            id: null,
            title: this.slide.title,
            slot1_store_id: this.slide.slot1_store_id,
            slot1_width: this.slide.slot1_width,
            slot1_valid_until: this.slide.slot1_valid_until,
            slot2_store_id: this.slide.slot2_store_id,
            slot2_width: this.slide.slot2_width,
            slot2_valid_until: this.slide.slot2_valid_until,
            slot3_store_id: this.slide.slot3_store_id,
            slot3_width: this.slide.slot3_width,
            slot3_valid_until: this.slide.slot3_valid_until,
            slot4_store_id: this.slide.slot4_store_id,
            slot4_width: this.slide.slot4_width,
            slot4_valid_until: this.slide.slot4_valid_until,
            slot5_store_id: this.slide.slot5_store_id,
            slot5_width: this.slide.slot5_width,
            slot5_valid_until: this.slide.slot5_valid_until
        });
    };
    SlideDetailComponent.prototype.createDataObject = function () {
        var slide = {
            'title': this.slideForm.value.title,
            'slot1_store_id': this.slideForm.value.slot1_store_id,
            'slot1_width': this.slideForm.value.slot1_width,
            'slot1_valid_until': this.slideForm.value.slot1_valid_until,
            'slot2_store_id': this.slideForm.value.slot2_store_id,
            'slot2_width': this.slideForm.value.slot2_width,
            'slot2_valid_until': this.slideForm.value.slot2_valid_until,
            'slot3_store_id': this.slideForm.value.slot3_store_id,
            'slot3_width': this.slideForm.value.slot3_width,
            'slot3_valid_until': this.slideForm.value.slot3_valid_until,
            'slot4_store_id': this.slideForm.value.slot4_store_id,
            'slot4_width': this.slideForm.value.slot4_width,
            'slot4_valid_until': this.slideForm.value.slot4_valid_until,
            'slot5_store_id': this.slideForm.value.slot5_store_id,
            'slot5_width': this.slideForm.value.slot5_width,
            'slot5_valid_until': this.slideForm.value.slot5_valid_until
        };
        if (this.base64 != null) {
            slide['base64'] = this.base64;
        }
        ;
        return slide;
    };
    SlideDetailComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_1__angular_core__["Component"])({
            selector: 'app-slide-detail',
            template: __webpack_require__(779)
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_2__service_api_service__["a" /* ApiService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2__service_api_service__["a" /* ApiService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_3__angular_router__["a" /* Router */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_3__angular_router__["a" /* Router */]) === 'function' && _b) || Object, (typeof (_c = typeof __WEBPACK_IMPORTED_MODULE_3__angular_router__["c" /* ActivatedRoute */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_3__angular_router__["c" /* ActivatedRoute */]) === 'function' && _c) || Object, (typeof (_d = typeof __WEBPACK_IMPORTED_MODULE_4__angular_forms__["d" /* FormBuilder */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_4__angular_forms__["d" /* FormBuilder */]) === 'function' && _d) || Object, (typeof (_e = typeof __WEBPACK_IMPORTED_MODULE_5_angular2_toaster__["b" /* ToasterService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_5_angular2_toaster__["b" /* ToasterService */]) === 'function' && _e) || Object, (typeof (_f = typeof __WEBPACK_IMPORTED_MODULE_0__service_api_store_service__["a" /* ApiStoreService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_0__service_api_store_service__["a" /* ApiStoreService */]) === 'function' && _f) || Object])
    ], SlideDetailComponent);
    return SlideDetailComponent;
    var _a, _b, _c, _d, _e, _f;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/slide-detail.component.js.map

/***/ }),

/***/ 594:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__service_api_service__ = __webpack_require__(12);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__ = __webpack_require__(9);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return SlidesComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};



var SlidesComponent = (function () {
    function SlidesComponent(apiService, toasterService) {
        this.apiService = apiService;
        this.toasterService = toasterService;
        this.entity_url = 'slides/all';
    }
    SlidesComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.apiService
            .getAll(this.entity_url)
            .subscribe(function (slides) { return _this.slides = slides; }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with loading slides');
        });
    };
    SlidesComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'app-slides',
            template: __webpack_require__(780)
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1__service_api_service__["a" /* ApiService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_1__service_api_service__["a" /* ApiService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__["b" /* ToasterService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__["b" /* ToasterService */]) === 'function' && _b) || Object])
    ], SlidesComponent);
    return SlidesComponent;
    var _a, _b;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/slides.component.js.map

/***/ }),

/***/ 595:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__service_api_store_service__ = __webpack_require__(86);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__service_api_location_service__ = __webpack_require__(131);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__angular_router__ = __webpack_require__(17);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__angular_forms__ = __webpack_require__(27);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5_angular2_toaster__ = __webpack_require__(9);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6_rxjs_Observable__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6_rxjs_Observable___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_6_rxjs_Observable__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7__service_api_service__ = __webpack_require__(12);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return StoreCreateComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};








var StoreCreateComponent = (function () {
    function StoreCreateComponent(apiService, storeService, apiLocationService, router, route, fb, toasterService) {
        this.apiService = apiService;
        this.storeService = storeService;
        this.apiLocationService = apiLocationService;
        this.router = router;
        this.route = route;
        this.fb = fb;
        this.toasterService = toasterService;
        this.disabled = false;
    }
    StoreCreateComponent.prototype.ngOnInit = function () {
        this.populationStore();
    };
    StoreCreateComponent.prototype.populationStore = function () {
        var _this = this;
        __WEBPACK_IMPORTED_MODULE_6_rxjs_Observable__["Observable"].forkJoin(this.apiLocationService.getAll(), this.apiService.getAll('packages/all')).subscribe(function (result) {
            _this.locations = result[0];
            _this.packages = result[1];
            _this.createFormGroup();
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Something went wrong');
            //this.router.navigate(['/stores']);
        });
    };
    StoreCreateComponent.prototype.onSubmit = function () {
        var _this = this;
        var newStore = this.createDataObject();
        this.disabled = true;
        this.storeService.create(newStore)
            .subscribe(function (store) {
            _this.toasterService.pop('success', 'Success', 'Store created!');
            _this.disabled = false;
            _this.router.navigate(['/stores']);
        }, function (error) {
            _this.errorMessage = _this.getErrorMessage(error);
            _this.toasterService.pop('error', 'Error', _this.errorMessage);
            _this.disabled = false;
        });
    };
    StoreCreateComponent.prototype.createFormGroup = function () {
        this.storeForm = this.fb.group({
            email: '',
            company: '',
            location_id: this.locations[0],
            package_id: this.packages[0],
        });
    };
    StoreCreateComponent.prototype.createDataObject = function () {
        return {
            'email': this.storeForm.value.email,
            'company': this.storeForm.value.company,
            'package_id': parseInt(this.storeForm.value.package_id, 10),
            'location_id': parseInt(this.storeForm.value.location_id, 10),
        };
    };
    StoreCreateComponent.prototype.getErrorMessage = function (err) {
        var message = '';
        for (var key in err) {
            if (err.hasOwnProperty(key)) {
                message += err[key] + ' ';
            }
        }
        return message;
    };
    StoreCreateComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'app-store-create',
            template: __webpack_require__(781)
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_7__service_api_service__["a" /* ApiService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_7__service_api_service__["a" /* ApiService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_1__service_api_store_service__["a" /* ApiStoreService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_1__service_api_store_service__["a" /* ApiStoreService */]) === 'function' && _b) || Object, (typeof (_c = typeof __WEBPACK_IMPORTED_MODULE_2__service_api_location_service__["a" /* ApiLocationService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2__service_api_location_service__["a" /* ApiLocationService */]) === 'function' && _c) || Object, (typeof (_d = typeof __WEBPACK_IMPORTED_MODULE_3__angular_router__["a" /* Router */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_3__angular_router__["a" /* Router */]) === 'function' && _d) || Object, (typeof (_e = typeof __WEBPACK_IMPORTED_MODULE_3__angular_router__["c" /* ActivatedRoute */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_3__angular_router__["c" /* ActivatedRoute */]) === 'function' && _e) || Object, (typeof (_f = typeof __WEBPACK_IMPORTED_MODULE_4__angular_forms__["d" /* FormBuilder */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_4__angular_forms__["d" /* FormBuilder */]) === 'function' && _f) || Object, (typeof (_g = typeof __WEBPACK_IMPORTED_MODULE_5_angular2_toaster__["b" /* ToasterService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_5_angular2_toaster__["b" /* ToasterService */]) === 'function' && _g) || Object])
    ], StoreCreateComponent);
    return StoreCreateComponent;
    var _a, _b, _c, _d, _e, _f, _g;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/store-create.component.js.map

/***/ }),

/***/ 596:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_rxjs_Rx__ = __webpack_require__(31);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_rxjs_Rx___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_rxjs_Rx__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__service_api_store_service__ = __webpack_require__(86);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__service_api_location_service__ = __webpack_require__(131);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__angular_router__ = __webpack_require__(17);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__angular_forms__ = __webpack_require__(27);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6_angular2_toaster__ = __webpack_require__(9);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7__packages_Packages__ = __webpack_require__(581);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return StoreDetailComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};








var StoreDetailComponent = (function () {
    function StoreDetailComponent(apiStoreService, apiLocationService, router, route, fb, toasterService) {
        this.apiStoreService = apiStoreService;
        this.apiLocationService = apiLocationService;
        this.router = router;
        this.route = route;
        this.fb = fb;
        this.toasterService = toasterService;
        this.disabled = false;
        this.dirty = false;
        this.upgrading = false;
        this.paidPackages = __WEBPACK_IMPORTED_MODULE_7__packages_Packages__["a" /* Packages */].paid();
        this.packages = new __WEBPACK_IMPORTED_MODULE_7__packages_Packages__["a" /* Packages */]();
        this.upgradedPackageName = null;
    }
    StoreDetailComponent.prototype.ngOnInit = function () {
        this.id = this.route.snapshot.params['id'];
        this.populationStore();
    };
    StoreDetailComponent.prototype.onSubmit = function () {
        this.disabled = true;
        this.updateStore(this.id);
    };
    StoreDetailComponent.prototype.upgrade = function (packageName) {
        var _this = this;
        this.upgrading = true;
        this.apiStoreService.upgrade(this.id, packageName)
            .subscribe(function () {
            _this.upgradedPackageName = packageName;
            _this.toasterService.pop('success', 'Upgraded package');
        }, function () {
            _this.toasterService.pop('error', 'Failed to upgrade package');
        }, function () {
            _this.upgrading = false;
        });
    };
    StoreDetailComponent.prototype.updateStore = function (id) {
        var _this = this;
        var store = this.createDataObject();
        this.apiStoreService
            .activateStore(this.id, store)
            .subscribe(function (store) {
            _this.store = store;
            _this.toasterService.pop('success', 'Success', 'Store updated!');
            _this.disabled = false;
            _this.router.navigate(['/stores']);
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with updating store!');
            _this.disabled = false;
            _this.router.navigate(['/stores']);
        });
    };
    StoreDetailComponent.prototype.deleteStore = function (id) {
        var _this = this;
        this.disabled = true;
        this.apiStoreService
            .delete(this.id)
            .subscribe(function () {
            _this.toasterService.pop('success', 'Success', 'Store deleted!');
            _this.disabled = false;
            _this.router.navigate(['/stores']);
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with deleting store!');
            _this.disabled = false;
            _this.router.navigate(['/stores']);
        });
    };
    StoreDetailComponent.prototype.populationStore = function () {
        var _this = this;
        __WEBPACK_IMPORTED_MODULE_0_rxjs_Rx__["Observable"].forkJoin(this.apiStoreService.get(this.id), this.apiLocationService.getAll()).subscribe(function (result) {
            _this.store = result[0];
            _this.locations = result[1];
            _this.createFormGroup();
        }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Something went wrong');
            _this.router.navigate(['/stores']);
        });
    };
    StoreDetailComponent.prototype.createFormGroup = function () {
        this.storeForm = this.fb.group({
            email: this.store.user_email,
            store: this.store.store_name,
            status: this.store.status,
            location: this.store.location_id,
        });
    };
    StoreDetailComponent.prototype.createDataObject = function () {
        var store = {
            'user_email': this.storeForm.value.email,
            'store_name': this.storeForm.value.store,
            'status': this.storeForm.value.status,
            'location_id': this.storeForm.value.location,
        };
        if (this.dirty) {
            store['base64'] = this.base64;
            this.dirty = false;
        }
        return store;
    };
    StoreDetailComponent.prototype.changeListener = function ($event) {
        this.readThis($event.target);
    };
    StoreDetailComponent.prototype.readThis = function (inputValue) {
        var _this = this;
        var file = inputValue.files[0];
        var myReader = new FileReader();
        if (!inputValue.files || inputValue.files.length === 0) {
            return;
        }
        myReader.onloadend = function (e) {
            _this.base64 = myReader.result;
            _this.store.cover_url = myReader.result;
            _this.dirty = true;
        };
        myReader.readAsDataURL(file);
    };
    StoreDetailComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_1__angular_core__["Component"])({
            selector: 'app-store-detail',
            template: __webpack_require__(782)
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_2__service_api_store_service__["a" /* ApiStoreService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2__service_api_store_service__["a" /* ApiStoreService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_3__service_api_location_service__["a" /* ApiLocationService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_3__service_api_location_service__["a" /* ApiLocationService */]) === 'function' && _b) || Object, (typeof (_c = typeof __WEBPACK_IMPORTED_MODULE_4__angular_router__["a" /* Router */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_4__angular_router__["a" /* Router */]) === 'function' && _c) || Object, (typeof (_d = typeof __WEBPACK_IMPORTED_MODULE_4__angular_router__["c" /* ActivatedRoute */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_4__angular_router__["c" /* ActivatedRoute */]) === 'function' && _d) || Object, (typeof (_e = typeof __WEBPACK_IMPORTED_MODULE_5__angular_forms__["d" /* FormBuilder */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_5__angular_forms__["d" /* FormBuilder */]) === 'function' && _e) || Object, (typeof (_f = typeof __WEBPACK_IMPORTED_MODULE_6_angular2_toaster__["b" /* ToasterService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_6_angular2_toaster__["b" /* ToasterService */]) === 'function' && _f) || Object])
    ], StoreDetailComponent);
    return StoreDetailComponent;
    var _a, _b, _c, _d, _e, _f;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/store-detail.component.js.map

/***/ }),

/***/ 597:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__service_api_store_service__ = __webpack_require__(86);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__ = __webpack_require__(9);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return StoresComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};



var StoresComponent = (function () {
    function StoresComponent(apiStoreService, toasterService) {
        this.apiStoreService = apiStoreService;
        this.toasterService = toasterService;
    }
    StoresComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.apiStoreService
            .getAll()
            .subscribe(function (stores) { return _this.stores = stores; }, function (error) {
            _this.errorMessage = error;
            _this.toasterService.pop('error', 'Error', 'Error with loading stores');
        });
    };
    StoresComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'app-stores',
            template: __webpack_require__(783)
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1__service_api_store_service__["a" /* ApiStoreService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_1__service_api_store_service__["a" /* ApiStoreService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__["b" /* ToasterService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2_angular2_toaster__["b" /* ToasterService */]) === 'function' && _b) || Object])
    ], StoresComponent);
    return StoresComponent;
    var _a, _b;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/stores.component.js.map

/***/ }),

/***/ 598:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_core_js_es6_symbol__ = __webpack_require__(613);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_core_js_es6_symbol___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_core_js_es6_symbol__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_core_js_es6_object__ = __webpack_require__(606);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_core_js_es6_object___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1_core_js_es6_object__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_core_js_es6_function__ = __webpack_require__(602);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_core_js_es6_function___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2_core_js_es6_function__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_core_js_es6_parse_int__ = __webpack_require__(608);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_core_js_es6_parse_int___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_3_core_js_es6_parse_int__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4_core_js_es6_parse_float__ = __webpack_require__(607);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4_core_js_es6_parse_float___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_4_core_js_es6_parse_float__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5_core_js_es6_number__ = __webpack_require__(605);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5_core_js_es6_number___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_5_core_js_es6_number__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6_core_js_es6_math__ = __webpack_require__(604);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6_core_js_es6_math___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_6_core_js_es6_math__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7_core_js_es6_string__ = __webpack_require__(612);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7_core_js_es6_string___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_7_core_js_es6_string__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_8_core_js_es6_date__ = __webpack_require__(601);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_8_core_js_es6_date___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_8_core_js_es6_date__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_9_core_js_es6_array__ = __webpack_require__(600);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_9_core_js_es6_array___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_9_core_js_es6_array__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_10_core_js_es6_regexp__ = __webpack_require__(610);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_10_core_js_es6_regexp___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_10_core_js_es6_regexp__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_11_core_js_es6_map__ = __webpack_require__(603);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_11_core_js_es6_map___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_11_core_js_es6_map__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_12_core_js_es6_set__ = __webpack_require__(611);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_12_core_js_es6_set___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_12_core_js_es6_set__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_13_core_js_es6_reflect__ = __webpack_require__(609);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_13_core_js_es6_reflect___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_13_core_js_es6_reflect__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_14_core_js_es7_reflect__ = __webpack_require__(614);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_14_core_js_es7_reflect___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_14_core_js_es7_reflect__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_15_zone_js_dist_zone__ = __webpack_require__(1048);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_15_zone_js_dist_zone___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_15_zone_js_dist_zone__);
















//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/polyfills.js.map

/***/ }),

/***/ 73:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__authentication_service__ = __webpack_require__(87);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_angular2_jwt__ = __webpack_require__(256);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_angular2_jwt___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2_angular2_jwt__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__angular_http__ = __webpack_require__(37);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4_rxjs_Observable__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4_rxjs_Observable___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_4_rxjs_Observable__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__angular_router__ = __webpack_require__(17);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6_rxjs_add_operator_catch__ = __webpack_require__(62);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6_rxjs_add_operator_catch___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_6_rxjs_add_operator_catch__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7_rxjs_add_observable_throw__ = __webpack_require__(420);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7_rxjs_add_observable_throw___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_7_rxjs_add_observable_throw__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ExtendedHttpService; });
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};








var ExtendedHttpService = (function (_super) {
    __extends(ExtendedHttpService, _super);
    function ExtendedHttpService(options, http, router, authenticationService, defOpts) {
        _super.call(this, options, http, defOpts);
        this.router = router;
        this.authenticationService = authenticationService;
    }
    ExtendedHttpService.prototype.request = function (url, options) {
        return _super.prototype.request.call(this, url, options).catch(this.catchErrors());
    };
    ExtendedHttpService.prototype.catchErrors = function () {
        var _this = this;
        return function (res) {
            if (res.status === 401) {
                _this.authenticationService.logout();
            }
            return __WEBPACK_IMPORTED_MODULE_4_rxjs_Observable__["Observable"].throw(res);
        };
    };
    ExtendedHttpService = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_1__angular_core__["Injectable"])(), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_2_angular2_jwt__["AuthConfig"] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2_angular2_jwt__["AuthConfig"]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_3__angular_http__["Http"] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_3__angular_http__["Http"]) === 'function' && _b) || Object, (typeof (_c = typeof __WEBPACK_IMPORTED_MODULE_5__angular_router__["a" /* Router */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_5__angular_router__["a" /* Router */]) === 'function' && _c) || Object, (typeof (_d = typeof __WEBPACK_IMPORTED_MODULE_0__authentication_service__["a" /* AuthenticationService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_0__authentication_service__["a" /* AuthenticationService */]) === 'function' && _d) || Object, (typeof (_e = typeof __WEBPACK_IMPORTED_MODULE_3__angular_http__["RequestOptions"] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_3__angular_http__["RequestOptions"]) === 'function' && _e) || Object])
    ], ExtendedHttpService);
    return ExtendedHttpService;
    var _a, _b, _c, _d, _e;
}(__WEBPACK_IMPORTED_MODULE_2_angular2_jwt__["AuthHttp"]));
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/extended-http.service.js.map

/***/ }),

/***/ 751:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(277)();
// imports


// module
exports.push([module.i, "", ""]);

// exports


/*** EXPORTS FROM exports-loader ***/
module.exports = module.exports.toString();

/***/ }),

/***/ 753:
/***/ (function(module, exports) {

module.exports = "<h4 class=\"text-center\" *ngIf=\"!advert\">\n    <span class=\"glyphicon glyphicon-refresh spin\"></span> Loading Advertisement\n</h4>\n\n<label *ngIf=\"advert\">{{ id === '-1' ? 'New' : 'Edit' }} Advertisement Entry</label>\n\n<form class=\"form-horizontal\" [formGroup]=\"advertForm\" (ngSubmit)=\"onSubmit($event)\" *ngIf=\"advert\">\n    <div class=\"panel panel-primary\">\n        <div class=\"panel-heading\">\n            Advertisement Details\n        </div>\n        <div class=\"panel-body\">\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Name</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"text\" class=\"form-control col-8\" formControlName=\"name\" value=\"{{ advert.name }}\">\n                </div>\n                <a *ngIf=\"id != -1\" href=\"{{domain}}/front/stores/ad/{{id}}\" target=\"_blank\">Ad Preview</a>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Brand</label>\n                <div class=\"col-xs-6\">\n                    <select class=\"form-control col-8\" formControlName=\"manufacturer_id\" [value]=\"advert.manufacturer_id\" required>\n                       <option *ngFor=\"let brand of brands\" [value]=\"brand.id\">{{brand.name}}</option>\n                    </select>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Product Image URL</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"text\" class=\"form-control col-8\" id=\"scanned_image_url\" value=\"{{ advert.scanned_image_url }}\" disabled>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Select Image</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"file\" placeholder=\"Choose File\" accept=\"image/*\" id=\"filename_scanned_image_url\" (change)=\"changeListener($event)\"\n                    />\n                </div>\n                <div class=\"col-xs-6\">\n                    <img class=\"img img-responsive\" [src]='advert.scanned_image_url'>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Brand Logo URL</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"text\" class=\"form-control col-8\" id=\"brand_logo_url\" value=\"{{ advert.brand_logo_url }}\" disabled>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Select Image</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"file\" placeholder=\"Choose File\" accept=\"image/*\" id=\"filename_brand_logo_url\" (change)=\"changeListener($event)\"\n                    />\n                </div>\n                <div class=\"col-xs-6\">\n                    <img class=\"img img-responsive\" [src]='advert.brand_logo_url'>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Reference Image URL</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"text\" class=\"form-control col-8\" id=\"reference_image_url\" value=\"{{ advert.reference_image_url }}\" disabled>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Select Image</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"file\" placeholder=\"Choose File\" accept=\"image/*\" id=\"filename_reference_image_url\" (change)=\"changeListener($event)\"\n                    />\n                </div>\n                <div class=\"col-xs-6\">\n                    <img class=\"img img-responsive\" [src]='advert.reference_image_url'>\n                </div>\n            </div>\n        </div>\n        <div class=\"panel-footer\">\n            <a class=\"btn btn-default\" routerLink=\"/advertisements\"><span class=\"glyphicon glyphicon-chevron-left\"></span>back</a>\n            <div class=\"pull-right\">\n                <span class=\"glyphicon glyphicon-refresh spin\" *ngIf=\"disabled\"></span>\n                <button type=\"submit\" class=\"btn btn-primary\" [disabled]='disabled'> <span class=\"glyphicon glyphicon-ok\"></span> save</button>\n                <button type=\"button\" class=\"btn btn-danger\" (click)=\"deleteAdvert(advert.id)\" *ngIf=\"id != -1\" [disabled]='disabled'><span class=\"glyphicon glyphicon-remove\"></span> delete</button>\n            </div>\n        </div>\n    </div>\n</form>"

/***/ }),

/***/ 754:
/***/ (function(module, exports) {

module.exports = "<h4 class=\"text-center\" *ngIf=\"!adverts\">\n  <span class=\"glyphicon glyphicon-refresh spin\"></span> Loading Advertisements\n</h4>\n\n<div class=\"panel panel-primary\">\n  <div class=\"panel-heading\">\n    Advertisement Dashboard\n  </div>\n  <div class=\"panel-body\" *ngIf=\"adverts && adverts.length\">\n    <div class=\"table-responsive\">\n      <table class=\"table table-condensed table-hover table-striped\">\n        <thead>\n          <tr>\n            <th>ID</th>\n            <th>Name</th>\n            <th>Manufacturer ID</th>\n            <th>Created</th>\n            <th>Updated</th>\n            <th></th>\n          </tr>\n        </thead>\n        <tbody>\n          <tr *ngFor=\"let advert of adverts\">\n            <td>{{ advert.id }}</td>\n            <td>{{ advert.name }}</td>\n            <td>{{ advert.manufacturer_id }}</td>\n            <td>{{ advert.created_at | date:'medium' }}</td>\n            <td>{{ advert.updated_at | date:'medium' }}</td>\n            <td><a class=\"btn btn-link\" [routerLink]=\"['/advertisement', advert.id]\"><span class=\"glyphicon glyphicon-pencil\"></span> edit</a></td>\n          </tr>\n        </tbody>\n      </table>\n    </div>\n  </div>\n  <div class=\"panel-footer\">\n    <a type=\"button\" class=\"btn btn-sm btn-primary\" [routerLink]=\"['/advertisement', -1]\"><span class=\"glyphicon glyphicon-plus\"></span> add new</a>\n  </div>\n</div>"

/***/ }),

/***/ 755:
/***/ (function(module, exports) {

module.exports = "<div class=\"container\">\n  <nav class=\"navbar navbar-default\" *ngIf=\"isLoggedIn\" >\n    <div class=\"container-fluid\">\n      <!-- Brand and toggle get grouped for better mobile display -->\n      <div class=\"navbar-header\">\n        <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\"\n          aria-expanded=\"false\">\n          <span class=\"sr-only\">Toggle navigation</span>\n          <span class=\"icon-bar\"></span>\n          <span class=\"icon-bar\"></span>\n          <span class=\"icon-bar\"></span>\n          </button>\n          <div class=\"navbar-header\">\n            <a class=\"navbar-brand\" routerLink=\"/advertisements\">Top<span class=\"di\">Di</span>Top Admin</a>\n          </div>\n      </div>\n\n      <!-- Collect the nav links, forms, and other content for toggling -->\n      <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">\n        <ul class=\"nav navbar-nav\">\n          <li><a routerLink=\"/advertisements\">Advertisements</a></li>\n          <li><a routerLink=\"/stores\">Stores</a></li>\n          <li class=\"dropdown\">\n            <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Manage<span class=\"caret\"></span></a>\n            <ul class=\"dropdown-menu\">\n              <li><a routerLink=\"/slides\">Slides</a></li>\n              <li><a routerLink=\"/manufacturers\">Manufacturers</a></li>\n              <li><a routerLink=\"/categories\">Categories</a></li>\n              <li><a routerLink=\"/locations\">Locations</a></li>\n              <li><a routerLink=\"/registerfields\">Registration Fields</a></li>\n              <li><a routerLink=\"/references\">References</a></li>\n              <li><a routerLink=\"/products\">Products</a></li>\n            </ul>\n          </li>\n          <li class=\"dropdown\">\n            <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Package Manager<span class=\"caret\"></span></a>\n            <ul class=\"dropdown-menu\">\n              <li><a routerLink=\"/fieldtypes\">Fieldtypes</a></li>\n              <li><a routerLink=\"/fields\">Fields</a></li>\n              <li><a routerLink=\"/fieldgroups\">Fieldgroups</a></li>\n              <li><a routerLink=\"/panels\">Panels</a></li>\n              <li><a routerLink=\"/packages\">Packages</a></li>\n            </ul>\n          </li>\n        </ul>\n        <ul class=\"nav navbar-nav navbar-right\">\n          <li><a routerLink=\"/logout\"><span class=\"glyphicon glyphicon-log-out\"></span> Logout</a></li>\n        </ul>\n      </div>\n      <!-- /.navbar-collapse -->\n    </div>\n    <!-- /.container-fluid -->\n  </nav>\n  <toaster-container></toaster-container>\n  <router-outlet></router-outlet>\n</div>"

/***/ }),

/***/ 756:
/***/ (function(module, exports) {

module.exports = "<h4 class=\"text-center\" *ngIf=\"!categories\">\n  <span class=\"glyphicon glyphicon-refresh spin\"></span> Loading Categories\n</h4>\n\n<div class=\"panel panel-primary\">\n  <div class=\"panel-heading\">\n    Categories Managment\n  </div>\n  <div class=\"panel-body\" *ngIf=\"categories && categories.length\">\n    <div class=\"table-responsive\">\n      <table class=\"table table-condensed table-hover table-striped\">\n        <thead>\n          <tr>\n            <th>ID</th>\n            <th>Created</th>\n            <th>Updated</th>\n            <th>Category Name</th>\n            <th></th>\n          </tr>\n        </thead>\n        <tbody>\n          <tr *ngFor=\"let category of categories\">\n            <td>{{ category.id }}</td>\n            <td>{{ category.created_at | date:'medium' }}</td>\n            <td>{{ category.updated_at | date:'medium' }}</td>\n            <td>{{ category.name }}</td>\n            <td><a class=\"btn btn-link\" [routerLink]=\"['/category', category.id]\"><span class=\"glyphicon glyphicon-pencil\"></span> edit</a></td>\n          </tr>\n        </tbody>\n      </table>\n    </div>\n  </div>\n  <div class=\"panel-footer\">\n    <a type=\"button\" class=\"btn btn-sm btn-primary\" [routerLink]=\"['/category', '-1']\"><span class=\"glyphicon glyphicon-plus\"></span> add new</a>\n  </div>\n</div>"

/***/ }),

/***/ 757:
/***/ (function(module, exports) {

module.exports = "<h4 class=\"text-center\" *ngIf=\"!category\">\n    <span class=\"glyphicon glyphicon-refresh spin\"></span> Loading Category Details\n</h4>\n\n<label *ngIf=\"category\">{{ id === '-1' ? 'New' : 'Edit' }} Category Entry</label>\n\n<form class=\"form-horizontal\" [formGroup]=\"categoryForm\" (ngSubmit)=\"onSubmit($event)\" *ngIf=\"category\">\n    <div class=\"panel panel-primary\">\n        <div class=\"panel-heading\">\n            Category Details\n        </div>\n        <div class=\"panel-body\">\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Name</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"text\" class=\"form-control\" formControlName=\"name\" value=\"{{ category.name }}\" required>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Description</label>\n                <div class=\"col-xs-6\">\n                    <textarea class=\"form-control\" rows=\"5\" formControlName=\"description\" value=\"{{ category.description }}\" required></textarea>\n                </div>\n            </div>\n        </div>\n        <div class=\"panel-footer\">\n            <a class=\"btn btn-default\" routerLink=\"/categories\"><span class=\"glyphicon glyphicon-chevron-left\"></span>back</a>\n            <div class=\"pull-right\">\n                <span class=\"glyphicon glyphicon-refresh spin\" *ngIf=\"disabled\"></span>\n                <button type=\"submit\" class=\"btn btn-primary\" [disabled]='disabled'> <span class=\"glyphicon glyphicon-ok\"></span> save</button>\n                <button type=\"button\" class=\"btn btn-danger\" (click)=\"deleteCategory(category.id)\" *ngIf=\"id != -1\" [disabled]='disabled'><span class=\"glyphicon glyphicon-remove\"></span> delete</button>\n            </div>\n        </div>\n    </div>\n</form>"

/***/ }),

/***/ 758:
/***/ (function(module, exports) {

module.exports = "<h4 class=\"text-center\" *ngIf=\"!fieldgroup || !fields\">\n    <span class=\"glyphicon glyphicon-refresh spin\"></span> Loading Fieldgroup Details\n</h4>\n\n<label *ngIf=\"fieldgroup && fields\">{{ id === '-1' ? 'New' : 'Edit' }} Fieldgroup Entry</label>\n\n<form class=\"form-horizontal\" [formGroup]=\"fieldgroupForm\" (ngSubmit)=\"onSubmit($event)\" *ngIf=\"fieldgroup && fields\">\n    <div class=\"panel panel-primary\">\n        <div class=\"panel-heading\">\n            Fieldgroup Details\n        </div>\n        <div class=\"panel-body\">\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Name</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"text\" class=\"form-control col-8\" formControlName=\"name\" value=\"{{ fieldgroup.name }}\">\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">CSS Class</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"text\" class=\"form-control col-8\" formControlName=\"cssclass\" value=\"{{ fieldgroup.cssclass }}\" required>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Fields</label>\n                <div class=\"col-xs-6\">\n                    <select multiple class=\"form-control col-8\" formControlName=\"selectedFields\" size=\"8\" required>\n                            <option *ngFor=\"let field of fields\" [value]=\"field.id\">{{ field.name }}</option>\n                    </select>\n                </div>\n            </div>\n        </div>\n        <div class=\"panel-footer\">\n            <a class=\"btn btn-default\" routerLink=\"/fieldgroups\"><span class=\"glyphicon glyphicon-chevron-left\"></span>back</a>\n            <div class=\"pull-right\">\n                <span class=\"glyphicon glyphicon-refresh spin\" *ngIf=\"disabled\"></span>\n                <button type=\"submit\" class=\"btn btn-primary\" [disabled]='disabled'> <span class=\"glyphicon glyphicon-ok\"></span> save</button>\n                <button type=\"button\" class=\"btn btn-danger\" (click)=\"deleteFieldgroup(fieldgroup.id)\" *ngIf=\"id != -1\" [disabled]='disabled'><span class=\"glyphicon glyphicon-remove\"></span> delete</button>\n            </div>\n        </div>\n    </div>\n</form>"

/***/ }),

/***/ 759:
/***/ (function(module, exports) {

module.exports = "<h4 class=\"text-center\" *ngIf=\"!fieldgroups\">\n  <span class=\"glyphicon glyphicon-refresh spin\"></span> Loading Fieldgroups\n</h4>\n\n<div class=\"panel panel-primary\">\n  <div class=\"panel-heading\">\n    Fieldgroups Managment\n  </div>\n  <div class=\"panel-body\" *ngIf=\"fieldgroups && fieldgroups.length\">\n    <div class=\"table-responsive\">\n      <table class=\"table table-condensed table-hover table-striped\">\n        <thead>\n          <tr>\n            <th>ID</th>\n            <th>Created</th>\n            <th>Updated</th>\n            <th>Name</th>\n            <th></th>\n          </tr>\n        </thead>\n        <tbody>\n          <tr *ngFor=\"let fieldgroup of fieldgroups\">\n            <td>{{ fieldgroup.id }}</td>\n            <td>{{ fieldgroup.created_at | date:'medium' }}</td>\n            <td>{{ fieldgroup.updated_at | date:'medium' }}</td>\n            <td>{{ fieldgroup.name }}</td>\n            <td><a class=\"btn btn-link\" [routerLink]=\"['/fieldgroup', fieldgroup.id]\"><span class=\"glyphicon glyphicon-pencil\"></span> edit</a></td>\n          </tr>\n        </tbody>\n      </table>\n    </div>\n  </div>\n  <div class=\"panel-footer\">\n    <a type=\"button\" class=\"btn btn-sm btn-primary\" [routerLink]=\"['/fieldgroup', '-1']\"><span class=\"glyphicon glyphicon-plus\"></span> add new</a>\n  </div>\n</div>"

/***/ }),

/***/ 760:
/***/ (function(module, exports) {

module.exports = "<h4 class=\"text-center\" *ngIf=\"!field\">\n    <span class=\"glyphicon glyphicon-refresh spin\"></span> Loading Field Details\n</h4>\n\n<label *ngIf=\"field\">{{ id === '-1' ? 'New' : 'Edit' }} Field Entry</label>\n\n<form class=\"form-horizontal\" [formGroup]=\"fieldForm\" (ngSubmit)=\"onSubmit($event)\" *ngIf=\"field\">\n    <div class=\"panel panel-primary\">\n        <div class=\"panel-heading\">\n            Field Details\n        </div>\n        <div class=\"panel-body\">\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Key</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"text\" class=\"form-control col-8\" formControlName=\"key\" value=\"{{ field.key }}\" required>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Name</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"text\" class=\"form-control col-8\" formControlName=\"name\" value=\"{{ field.name }}\" required>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">CSS Class</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"text\" class=\"form-control col-8\" formControlName=\"cssclass\" value=\"{{ field.cssclass }}\" required>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Field Type</label>\n                <div class=\"col-xs-6\">\n                    <select class=\"form-control col-8\" formControlName=\"fieldtype_id\" [value]=\"field.fieldtype_id\" required>\n                            <option *ngFor=\"let fieldtype of fieldtypes\" [value]=\"fieldtype.id\">{{fieldtype.name}}</option>\n                    </select>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Values (comma separated)</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"text\" class=\"form-control col-8\" formControlName=\"values\" value=\"{{ field.values }}\">\n                </div>\n            </div>\n        </div>\n        <div class=\"panel-footer\">\n            <a class=\"btn btn-default\" routerLink=\"/fields\"><span class=\"glyphicon glyphicon-chevron-left\"></span>back</a>\n            <div class=\"pull-right\">\n                <span class=\"glyphicon glyphicon-refresh spin\" *ngIf=\"disabled\"></span>\n                <button type=\"submit\" class=\"btn btn-primary\" [disabled]='disabled'> <span class=\"glyphicon glyphicon-ok\"></span> save</button>\n                <button type=\"button\" class=\"btn btn-danger\" (click)=\"deleteField(field.id)\" *ngIf=\"id != -1\" [disabled]='disabled'><span class=\"glyphicon glyphicon-remove\"></span> delete</button>\n            </div>\n        </div>\n    </div>\n</form>"

/***/ }),

/***/ 761:
/***/ (function(module, exports) {

module.exports = "<h4 class=\"text-center\" *ngIf=\"!fields\">\n  <span class=\"glyphicon glyphicon-refresh spin\"></span> Loading Fields\n</h4>\n\n<div class=\"panel panel-primary\">\n  <div class=\"panel-heading\">\n    Fields Managment\n  </div>\n  <div class=\"panel-body\" *ngIf=\"fields && fields.length\">\n    <div class=\"table-responsive\">\n      <table class=\"table table-condensed table-hover table-striped\">\n        <thead>\n          <tr>\n            <th>ID</th>\n            <th>Created</th>\n            <th>Updated</th>\n            <th>Name</th>\n            <th></th>\n          </tr>\n        </thead>\n        <tbody>\n          <tr *ngFor=\"let field of fields\">\n            <td>{{ field.id }}</td>\n            <td>{{ field.created_at | date:'medium' }}</td>\n            <td>{{ field.updated_at | date:'medium' }}</td>\n            <td>{{ field.name }}</td>\n            <td><a class=\"btn btn-link\" [routerLink]=\"['/field', field.id]\"><span class=\"glyphicon glyphicon-pencil\"></span> edit</a></td>\n          </tr>\n        </tbody>\n      </table>\n    </div>\n  </div>\n  <div class=\"panel-footer\">\n    <a type=\"button\" class=\"btn btn-sm btn-primary\" [routerLink]=\"['/field', '-1']\"><span class=\"glyphicon glyphicon-plus\"></span> add new</a>\n  </div>\n</div>"

/***/ }),

/***/ 762:
/***/ (function(module, exports) {

module.exports = "<h4 class=\"text-center\" *ngIf=\"!fieldtype\">\n    <span class=\"glyphicon glyphicon-refresh spin\"></span> Loading Fieldtype Details\n</h4>\n\n<label *ngIf=\"fieldtype\">{{ id === '-1' ? 'New' : 'Edit' }} Fieldtype Entry</label>\n\n<form class=\"form-horizontal\" [formGroup]=\"fieldtypeForm\" (ngSubmit)=\"onSubmit($event)\" *ngIf=\"fieldtype\">\n    <div class=\"panel panel-primary\">\n        <div class=\"panel-heading\">\n            Fieldtype Details\n        </div>\n        <div class=\"panel-body\">\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Name</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"text\" class=\"form-control col-8\" formControlName=\"name\" value=\"{{ fieldtype.name }}\" required>\n                </div>\n            </div>\n        </div>\n        <div class=\"panel-footer\">\n            <a class=\"btn btn-default\" routerLink=\"/fieldtypes\"><span class=\"glyphicon glyphicon-chevron-left\"></span>back</a>\n            <div class=\"pull-right\">\n                <span class=\"glyphicon glyphicon-refresh spin\" *ngIf=\"disabled\"></span>\n                <button type=\"submit\" class=\"btn btn-primary\" [disabled]='disabled'> <span class=\"glyphicon glyphicon-ok\"></span> save</button>\n                <button type=\"button\" class=\"btn btn-danger\" (click)=\"deleteFieldtype(fieldtype.id)\" *ngIf=\"id != -1\" [disabled]='disabled'><span class=\"glyphicon glyphicon-remove\"></span> delete</button>\n            </div>\n        </div>\n    </div>\n</form>"

/***/ }),

/***/ 763:
/***/ (function(module, exports) {

module.exports = "<h4 class=\"text-center\" *ngIf=\"!fieldtypes\">\n  <span class=\"glyphicon glyphicon-refresh spin\"></span> Loading Fieldtypes\n</h4>\n\n<div class=\"panel panel-primary\">\n  <div class=\"panel-heading\">\n    Fieldtypes Managment\n  </div>\n  <div class=\"panel-body\" *ngIf=\"fieldtypes && fieldtypes.length\">\n    <div class=\"table-responsive\">\n      <table class=\"table table-condensed table-hover table-striped\">\n        <thead>\n          <tr>\n            <th>ID</th>\n            <th>Created</th>\n            <th>Updated</th>\n            <th>Name</th>\n            <th></th>\n          </tr>\n        </thead>\n        <tbody>\n          <tr *ngFor=\"let fieldtype of fieldtypes\">\n            <td>{{ fieldtype.id }}</td>\n            <td>{{ fieldtype.created_at | date:'medium' }}</td>\n            <td>{{ fieldtype.updated_at | date:'medium' }}</td>\n            <td>{{ fieldtype.name }}</td>\n            <td><a class=\"btn btn-link\" [routerLink]=\"['/fieldtype', fieldtype.id]\"><span class=\"glyphicon glyphicon-pencil\"></span> edit</a></td>\n          </tr>\n        </tbody>\n      </table>\n    </div>\n  </div>\n  <div class=\"panel-footer\">\n    <a type=\"button\" class=\"btn btn-sm btn-primary\" [routerLink]=\"['/fieldtype', '-1']\"><span class=\"glyphicon glyphicon-plus\"></span> add new</a>\n  </div>\n</div>"

/***/ }),

/***/ 764:
/***/ (function(module, exports) {

module.exports = "<h4 class=\"text-center\" *ngIf=\"!location\">\n    <span class=\"glyphicon glyphicon-refresh spin\"></span> Loading Location Details\n</h4>\n\n<label *ngIf=\"location\">{{ id === '-1' ? 'New' : 'Edit' }} Location Entry</label>\n\n<form class=\"form-horizontal\" [formGroup]=\"locationForm\" (ngSubmit)=\"onSubmit($event)\" *ngIf=\"location\">\n    <div class=\"panel panel-primary\">\n        <div class=\"panel-heading\">\n            Location Details\n        </div>\n        <div class=\"panel-body\">\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Key</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"text\" class=\"form-control col-8\" formControlName=\"key\" value=\"{{ location.key }}\" disabled>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Name</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"text\" class=\"form-control col-8\" formControlName=\"name\" value=\"{{ location.name }}\" disabled>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Latitude</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"number\" step=\"0.00000001\" class=\"form-control col-8\" formControlName=\"latitude\" value=\"{{ location.latitude }}\" required>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Longitude</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"number\" step=\"0.00000001\" class=\"form-control col-8\" formControlName=\"longitude\" value=\"{{ location.longitude }}\" required>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Featured</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"checkbox\" formControlName=\"is_featured\" value=\"{{ location.is_featured }}\">\n                </div>\n            </div>\n        </div>\n        <div class=\"panel-footer\">\n            <a class=\"btn btn-default\" routerLink=\"/locations\"><span class=\"glyphicon glyphicon-chevron-left\"></span>back</a>\n            <div class=\"pull-right\">\n                <span class=\"glyphicon glyphicon-refresh spin\" *ngIf=\"disabled\"></span>\n                <button type=\"submit\" class=\"btn btn-primary\" [disabled]='disabled'> <span class=\"glyphicon glyphicon-ok\"></span> save</button>\n                <button type=\"button\" class=\"btn btn-danger\" (click)=\"deleteLocation(location.id)\" *ngIf=\"id != -1\" [disabled]='disabled'><span class=\"glyphicon glyphicon-remove\"></span> delete</button>\n            </div>\n        </div>\n    </div>\n</form>"

/***/ }),

/***/ 765:
/***/ (function(module, exports) {

module.exports = "<h4 class=\"text-center\" *ngIf=\"!locations\">\n  <span class=\"glyphicon glyphicon-refresh spin\"></span> Loading Locations\n</h4>\n\n<div class=\"panel panel-primary\">\n  <div class=\"panel-heading\">\n    Locations Managment\n  </div>\n  <div class=\"panel-body\" *ngIf=\"locations && locations.length\">\n    <div class=\"table-responsive\">\n      <table class=\"table table-condensed table-hover table-striped\">\n        <thead>\n          <tr>\n            <th>ID</th>\n            <th>Latitude</th>\n            <th>Longitutde</th>\n            <th>Location Name</th>\n            <th>Featured</th>\n            <th></th>\n          </tr>\n        </thead>\n        <tbody>\n          <tr *ngFor=\"let location of locations\">\n            <td>{{ location.id }}</td>\n            <td>{{ location.latitude }}</td>\n            <td>{{ location.longitude }}</td>\n            <td>{{ location.name }}</td>\n            <td *ngIf=\"location.is_featured\"><span class=\"glyphicon glyphicon-ok\"></span></td>\n            <td *ngIf=\"!location.is_featured\"></td>\n            <td><a class=\"btn btn-link\" [routerLink]=\"['/location', location.id]\"><span class=\"glyphicon glyphicon-pencil\"></span> edit</a></td>\n          </tr>\n        </tbody>\n      </table>\n    </div>\n  </div>\n  <div class=\"panel-footer\">\n    <a type=\"button\" class=\"btn btn-sm btn-primary\" [routerLink]=\"['/location', '-1']\"><span class=\"glyphicon glyphicon-plus\"></span> add new</a>\n  </div>\n</div>"

/***/ }),

/***/ 766:
/***/ (function(module, exports) {

module.exports = "<div class=\"col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3\">\n    <h2>TopDiTop Admin Login</h2>\n    <form name=\"form\" (ngSubmit)=\"f.form.valid && login()\" #f=\"ngForm\" novalidate>\n        <div class=\"form-group\" [ngClass]=\"{ 'has-error': f.submitted && !username.valid }\">\n            <label for=\"username\">Email</label>\n            <input type=\"text\" class=\"form-control\" name=\"username\" [(ngModel)]=\"model.username\" #username=\"ngModel\" required />\n            <div *ngIf=\"f.submitted && !username.valid\" class=\"help-block\">Email is required</div>\n        </div>\n        <div class=\"form-group\" [ngClass]=\"{ 'has-error': f.submitted && !password.valid }\">\n            <label for=\"password\">Password</label>\n            <input type=\"password\" class=\"form-control\" name=\"password\" [(ngModel)]=\"model.password\" #password=\"ngModel\" required />\n            <div *ngIf=\"f.submitted && !password.valid\" class=\"help-block\">Password is required</div>\n        </div>\n        <div class=\"form-group\">\n            <button [disabled]=\"loading\" class=\"btn btn-primary btn-block\">\n                <img *ngIf=\"loading\"  src=\"../../assets/loading.gif\"/>\n                Login <span class=\"glyphicon glyphicon-log-in\"></span></button>\n        </div>\n        <div *ngIf=\"error\" class=\"alert alert-danger\">{{error}}</div>\n    </form>\n</div>\n"

/***/ }),

/***/ 767:
/***/ (function(module, exports) {

module.exports = "<h4 class=\"text-center\" *ngIf=\"!manufacturer\">\n    <span class=\"glyphicon glyphicon-refresh spin\"></span> Loading Manufacturer Details\n</h4>\n\n<label *ngIf=\"manufacturer\">{{ id === '-1' ? 'New' : 'Edit' }} Manufacturer Entry</label>\n\n<form class=\"form-horizontal\" [formGroup]=\"manufacturerForm\" (ngSubmit)=\"onSubmit($event)\" *ngIf=\"manufacturer\">\n    <div class=\"panel panel-primary\">\n        <div class=\"panel-heading\">\n            Manufacturer Details\n        </div>\n        <div class=\"panel-body\">\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Name</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"text\" class=\"form-control\" formControlName=\"name\" value=\"{{ manufacturer.name }}\">\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Image URL</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"text\" class=\"form-control\" id=\"image_url\" value=\"{{ manufacturer.image_url }}\"\n                        disabled>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Featured</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"checkbox\" formControlName=\"featured\" value=\"{{ manufacturer.featured }}\">\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Select Image</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"file\" placeholder=\"Choose File\" accept=\"image/*\" id=\"image_url\"\n                        (change)=\"changeListener($event)\" />\n                </div>\n                <div class=\"col-xs-6\">\n                    <img class=\"img img-responsive\" [src]='manufacturer.image_url'>\n                </div>\n            </div>\n        </div>\n        <div class=\"panel-footer\">\n            <a class=\"btn btn-default\" routerLink=\"/manufacturers\"><span\n                    class=\"glyphicon glyphicon-chevron-left\"></span>back</a>\n            <div class=\"pull-right\">\n                <span class=\"glyphicon glyphicon-refresh spin\" *ngIf=\"disabled\"></span>\n                <button type=\"submit\" class=\"btn btn-primary\" [disabled]='disabled'> <span\n                        class=\"glyphicon glyphicon-ok\"></span> save</button>\n                <button type=\"button\" class=\"btn btn-danger\" (click)=\"deleteManufacturer(manufacturer.id)\"\n                    *ngIf=\"id != -1\" [disabled]='disabled'><span class=\"glyphicon glyphicon-remove\"></span>\n                    delete</button>\n            </div>\n        </div>\n    </div>\n</form>\n\n<div class=\"panel panel-primary\" *ngIf=\"manufacturer\">\n    <div class=\"panel-heading\">Manufacturer References ({{reverseBrandreferences.length}})</div>\n    <div class=\"panel-body\">\n        <div class=\"container\">\n            <div class=\"col-sm-6\">\n                <form action=\"\" class=\"form\" [formGroup]=\"brandreferenceForm\" autocomplete=\"off\"\n                    (ngSubmit)=\"onSubmitBrandReference($event)\">\n                    <div class=\"form-group\">\n                        <label for=\"title\">Title</label>\n                        <input type=\"text\" name=\"title\" class=\"form-control\" formControlName=\"title\">\n                    </div>\n                    <div class=\"form-group\">\n                        <label for=\"description\">Description</label>\n                        <input type=\"text\" name=\"description\" class=\"form-control\" formControlName=\"description\">\n                    </div>\n                    <div class=\"form-group\">\n                        <label for=\"category_id\">Category</label>\n                        <select name=\"category_id\" class=\"form-control\" formControlName=\"category_id\">\n                            <option [value]=\"null\">None</option>\n                            <option [value]=\"category.id\" *ngFor=\"let category of categories\">{{ category.name }}\n                            </option>\n                        </select>\n                    </div>\n                    <div class=\"form-group\">\n                        <label for=\"image\">Image</label>\n                        <input type=\"file\" name=\"image\" (change)=\"onFileChange($event)\" formControlName=\"image\">\n                    </div>\n                    <div class=\"form-group\">\n                        <button type=\"submit\" class=\"btn btn-primary\" [disabled]=\"progress.brandreference.creating\">\n                            <span class=\"glyphicon glyphicon-ok\"></span> save\n                        </button>\n                        <button type=\"reset\" class=\"btn btn-default\" [disabled]=\"progress.brandreference.creating\">\n                            <span class=\"glyphicon glyphicon-remove\"></span> reset</button>\n                    </div>\n                </form>\n            </div>\n            <div class=\"col-sm-6\">\n                <div *ngFor=\"let br of reverseBrandreferences\" class=\"brandreference-list-item\">\n                    <h3>{{br.title}}</h3>\n                    <p>{{br.description}}</p>\n                    <p>Category: {{br.category ? br.category.name : 'none'}}</p>\n                    <div>\n                        <img src=\"{{domain}}images{{br.thumbnail_small_url}}\" class=\"brandreference-list-item-image\">\n                    </div>\n                    <p>\n                        <a class=\"btn btn-default\" target=\"_blank\" href=\"{{domain}}images{{br.image_url}}\"><span\n                                class=\"glyphicon glyphicon-eye-open\"></span> view full\n                            size</a>\n                        <button class=\"btn btn-danger\" (click)=\"deleteBrandReference(br)\"\n                            [disabled]=\"progress.brandreference.deleteMap[br.id]\"><span\n                                class=\"glyphicon glyphicon-remove\"></span> delete</button>\n                    </p>\n                    <hr>\n                </div>\n            </div>\n        </div>\n    </div>\n</div>\n"

/***/ }),

/***/ 768:
/***/ (function(module, exports) {

module.exports = "<h4 class=\"text-center\" *ngIf=\"!manufacturers\">\n  <span class=\"glyphicon glyphicon-refresh spin\"></span> Loading Manufacturers\n</h4>\n\n<div class=\"panel panel-primary\">\n  <div class=\"panel-heading\">\n    Manufacturers Managment\n  </div>\n  <div class=\"panel-body\" *ngIf=\"manufacturers && manufacturers.length\">\n    <div class=\"table-responsive\">\n      <table class=\"table table-condensed table-hover table-striped\">\n        <thead>\n          <tr>\n            <th>ID</th>\n            <th>Created</th>\n            <th>Updated</th>\n            <th>Name</th>\n            <th>References</th>\n            <th></th>\n          </tr>\n        </thead>\n        <tbody>\n          <tr *ngFor=\"let manufacturer of manufacturers\">\n            <td>{{ manufacturer.id }}</td>\n            <td>{{ manufacturer.created_at | date:'medium' }}</td>\n            <td>{{ manufacturer.updated_at | date:'medium' }}</td>\n            <td>{{ manufacturer.name }}</td>\n            <td>{{ manufacturer.brandreferences_count }}</td>\n            <td><a class=\"btn btn-link\" [routerLink]=\"['/manufacturer', manufacturer.id]\"><span\n                  class=\"glyphicon glyphicon-pencil\"></span> edit</a></td>\n          </tr>\n        </tbody>\n      </table>\n    </div>\n  </div>\n  <div class=\"panel-footer\">\n    <a type=\"button\" class=\"btn btn-sm btn-primary\" [routerLink]=\"['/manufacturer', '-1']\"><span\n        class=\"glyphicon glyphicon-plus\"></span> add new</a>\n  </div>\n</div>\n"

/***/ }),

/***/ 769:
/***/ (function(module, exports) {

module.exports = "<h4 class=\"text-center\" *ngIf=\"!pack || !panels\">\n    <span class=\"glyphicon glyphicon-refresh spin\"></span> Loading Package Details\n</h4>\n\n<label *ngIf=\"pack && panels\">{{ id === '-1' ? 'New' : 'Edit' }} Package Entry</label>\n\n<form class=\"form-horizontal\" [formGroup]=\"packageForm\" (ngSubmit)=\"onSubmit($event)\" *ngIf=\"pack && panels\">\n    <div class=\"panel panel-primary\">\n        <div class=\"panel-heading\">\n            Package Details\n        </div>\n        <div class=\"panel-body\">\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Name</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"text\" class=\"form-control col-8\" formControlName=\"name\" value=\"{{ pack.name }}\" required>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Panels</label>\n                <div class=\"col-xs-6\">\n                    <select multiple class=\"form-control col-8\" formControlName=\"selectedPanels\" size=\"8\" required>\n                            <option *ngFor=\"let panel of panels\" [ngValue]=\"panel.id\">{{panel.key}}</option>\n                    </select>\n                </div>\n            </div>\n        </div>\n        <div class=\"panel-footer\">\n            <a class=\"btn btn-default\" routerLink=\"/packages\"><span class=\"glyphicon glyphicon-chevron-left\"></span>back</a>\n            <div class=\"pull-right\">\n                <span class=\"glyphicon glyphicon-refresh spin\" *ngIf=\"disabled\"></span>\n                <button type=\"submit\" class=\"btn btn-primary\" [disabled]='disabled'> <span class=\"glyphicon glyphicon-ok\"></span> save</button>\n                <button type=\"button\" class=\"btn btn-danger\" (click)=\"deletePackage(pack.id)\" *ngIf=\"id != -1\" [disabled]='disabled'><span class=\"glyphicon glyphicon-remove\"></span> delete</button>\n            </div>\n        </div>\n    </div>\n</form>"

/***/ }),

/***/ 770:
/***/ (function(module, exports) {

module.exports = "<h4 class=\"text-center\" *ngIf=\"!packages\">\n  <span class=\"glyphicon glyphicon-refresh spin\"></span> Loading Packages\n</h4>\n\n<div class=\"panel panel-primary\">\n  <div class=\"panel-heading\">\n    Packages Managment\n  </div>\n  <div class=\"panel-body\" *ngIf=\"packages && packages.length\">\n    <div class=\"table-responsive\">\n      <table class=\"table table-condensed table-hover table-striped\">\n        <thead>\n          <tr>\n            <th>ID</th>\n            <th>Created</th>\n            <th>Updated</th>\n            <th>Name</th>\n            <th></th>\n          </tr>\n        </thead>\n        <tbody>\n          <tr *ngFor=\"let package of packages\">\n            <td>{{ package.id }}</td>\n            <td>{{ package.created_at | date:'medium' }}</td>\n            <td>{{ package.updated_at | date:'medium' }}</td>\n            <td>{{ package.name }}</td>\n            <td><a class=\"btn btn-link\" [routerLink]=\"['/package', package.id]\"><span class=\"glyphicon glyphicon-pencil\"></span> edit</a></td>\n          </tr>\n        </tbody>\n      </table>\n    </div>\n  </div>\n  <div class=\"panel-footer\">\n    <a type=\"button\" class=\"btn btn-sm btn-primary\" [routerLink]=\"['/package', '-1']\"><span class=\"glyphicon glyphicon-plus\"></span> add new</a>\n  </div>\n</div>"

/***/ }),

/***/ 771:
/***/ (function(module, exports) {

module.exports = "<h4 class=\"text-center\" *ngIf=\"!panel\">\n    <span class=\"glyphicon glyphicon-refresh spin\"></span> Loading Panel Details\n</h4>\n\n<label *ngIf=\"panel\">{{ id === '-1' ? 'New' : 'Edit' }} Panel Entry</label>\n\n<form class=\"form-horizontal\" [formGroup]=\"panelForm\" (ngSubmit)=\"onSubmit($event)\" *ngIf=\"panel\">\n    <div class=\"panel panel-primary\">\n        <div class=\"panel-heading\">\n            Panel Details\n        </div>\n        <div class=\"panel-body\">\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Name</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"text\" class=\"form-control col-8\" formControlName=\"name\" value=\"{{ panel.name }}\" required>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Key</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"text\" class=\"form-control col-8\" formControlName=\"key\" value=\"{{ panel.key }}\" required>\n                </div>\n            </div>\n\n            <div class=\"form-group\" formArrayName=\"selectedFieldGroups\">\n                <div class=\"col-xs-3 control-label\">\n                    <button type=\"button\" class=\"btn btn-primary\" (click)=\"addNewFieldGroup()\"><span class=\"glyphicon glyphicon-plus\"></span> add</button>\n                </div>\n                <div class=\"col-xs-6\">\n                    <div *ngFor=\"let selectedFieldGroup of panelForm.controls.selectedFieldGroups.controls; let i = index;\"\n                        [formGroupName]=\"i\">\n                        <select class=\"form-control col-8\" formControlName=\"id\">\n                        <option *ngFor=\"let fg of allFieldGroups\" [value]=\"fg.id\" >{{fg.name}}</option>\n                    </select>\n                </div>\n            </div>\n        </div>\n    </div>\n    <div class=\"panel-footer\">\n        <a class=\"btn btn-default\" routerLink=\"/panels\"><span class=\"glyphicon glyphicon-chevron-left\"></span>back</a>\n        <div class=\"pull-right\">\n            <span class=\"glyphicon glyphicon-refresh spin\" *ngIf=\"disabled\"></span>\n            <button type=\"submit\" class=\"btn btn-primary\" [disabled]='disabled'> <span class=\"glyphicon glyphicon-ok\"></span> save</button>\n            <button type=\"button\" class=\"btn btn-danger\" (click)=\"deletePanel(panel.id)\" *ngIf=\"id != -1\" [disabled]='disabled'><span class=\"glyphicon glyphicon-remove\"></span> delete</button>\n        </div>\n    </div>\n    </div>\n</form>"

/***/ }),

/***/ 772:
/***/ (function(module, exports) {

module.exports = "<h4 class=\"text-center\" *ngIf=\"!panels\">\n  <span class=\"glyphicon glyphicon-refresh spin\"></span> Loading Panels\n</h4>\n\n<div class=\"panel panel-primary\">\n  <div class=\"panel-heading\">\n    Panels Managment\n  </div>\n  <div class=\"panel-body\" *ngIf=\"panels && panels.length\">\n    <div class=\"table-responsive\">\n      <table class=\"table table-condensed table-hover table-striped\">\n        <thead>\n          <tr>\n            <th>ID</th>\n            <th>Created</th>\n            <th>Updated</th>\n            <th>Key</th>\n            <th>Name</th>\n            <th></th>\n          </tr>\n        </thead>\n        <tbody>\n          <tr *ngFor=\"let panel of panels\">\n            <td>{{ panel.id }}</td>\n            <td>{{ panel.created_at | date:'medium' }}</td>\n            <td>{{ panel.updated_at | date:'medium' }}</td>\n            <td>{{ panel.key }}</td>\n            <td>{{ panel.name }}</td>\n            <td><a class=\"btn btn-link\" [routerLink]=\"['/panel', panel.id]\"><span class=\"glyphicon glyphicon-pencil\"></span> edit</a></td>\n          </tr>\n        </tbody>\n      </table>\n    </div>\n  </div>\n  <div class=\"panel-footer\">\n    <a type=\"button\" class=\"btn btn-sm btn-primary\" [routerLink]=\"['/panel', '-1']\"><span class=\"glyphicon glyphicon-plus\"></span> add new</a>\n  </div>\n</div>"

/***/ }),

/***/ 773:
/***/ (function(module, exports) {

module.exports = "<h4 class=\"text-center\" *ngIf=\"!product || !allCategories || !allReferences || !manufacturers\">\n    <span class=\"glyphicon glyphicon-refresh spin\"></span> Loading Product Details\n</h4>\n\n<label *ngIf=\"product && allCategories && allReferences && manufacturers\">{{ id === '-1' ? 'New' : 'Edit' }} product Entry</label>\n\n<form class=\"form-horizontal\" [formGroup]=\"productForm\" (ngSubmit)=\"onSubmit($event)\" *ngIf=\"product && allCategories && allReferences && manufacturers\">\n    <div class=\"panel panel-primary\">\n        <div class=\"panel-heading\">\n            Product Details\n        </div>\n        <div class=\"panel-body\">\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Title</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"text\" class=\"form-control col-8\" formControlName=\"title\" value=\"{{ product.title }}\" required>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Description</label>\n                <div class=\"col-xs-6\">\n                    <textarea class=\"form-control\" rows=\"8\" formControlName=\"description\" value=\"{{ product.description }}\" required></textarea>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Price</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"number\"  min=\"0\" class=\"form-control col-8\" formControlName=\"price\" value=\"{{ product.price }}\" required>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Store</label>\n                <div class=\"col-xs-6\">\n                    <select class=\"form-control col-8\" formControlName=\"store_id\" required>\n                            <option *ngFor=\"let store of stores\" [value]=\"store.id\">{{ store.store_name }}</option>\n                    </select>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">References</label>\n                <div class=\"col-xs-6\">\n                    <select multiple class=\"form-control col-8\" formControlName=\"selectedReferences\" size=\"8\" required>\n                            <option *ngFor=\"let reference of allReferences\" [ngValue]=\"reference.id\">{{ reference.title }}</option>\n                    </select>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Categories</label>\n                <div class=\"col-xs-6\">\n                    <select multiple class=\"form-control col-8\" formControlName=\"selectedCategories\" size=\"8\" required>\n                            <option *ngFor=\"let category of allCategories\" [ngValue]=\"category.id\">{{ category.name }}</option>\n                    </select>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Manufacturer</label>\n                <div class=\"col-xs-6\">\n                    <select class=\"form-control col-8\" formControlName=\"manufacturer_id\" required>\n                            <option *ngFor=\"let manufacturer of manufacturers\" [value]=\"manufacturer.id\">{{ manufacturer.name }}</option>\n                    </select>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Add Image +</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"file\" placeholder=\"Choose File\" accept=\"image/*\" id=\"image_url\" (change)=\"changeListener($event)\" />\n                </div>\n            </div>\n            <div class=\"col-xs-offset-3 col-xs-6\" *ngFor=\"let photo of newImages\">\n                <img class=\"img img-responsive\"  [src]='photo'>\n            </div>\n            <div class=\"form-group\">\n                <div class=\"col-xs-offset-3 col-xs-6\" *ngFor=\"let image of myImages; let i=index;\">\n                    <img class=\"img img-responsive\" [src]='image.url'>\n                    <button type=\"button\" class=\"btn btn-sm btn-danger\" (click)=\"deleteImage(image.id, i)\" [disabled]='disabled'><span class=\"glyphicon glyphicon-remove\"></span> remove</button>\n                </div>\n            </div>\n        </div>\n        <div class=\"panel-footer\">\n            <a class=\"btn btn-default\" routerLink=\"/products\"><span class=\"glyphicon glyphicon-chevron-left\"></span>back</a>\n            <div class=\"pull-right\">\n                <span class=\"glyphicon glyphicon-refresh spin\" *ngIf=\"disabled\"></span>\n                <button type=\"submit\" class=\"btn btn-primary\" [disabled]='disabled'> <span class=\"glyphicon glyphicon-ok\"></span> save</button>\n                <button type=\"button\" class=\"btn btn-danger\" (click)=\"deleteProduct(product.id)\" *ngIf=\"id != -1\" [disabled]='disabled'><span class=\"glyphicon glyphicon-remove\"></span> delete</button>\n            </div>\n        </div>\n    </div>\n</form>"

/***/ }),

/***/ 774:
/***/ (function(module, exports) {

module.exports = "<h4 class=\"text-center\" *ngIf=\"!products\">\n  <span class=\"glyphicon glyphicon-refresh spin\"></span> Loading Products\n</h4>\n\n<div class=\"panel panel-primary\">\n  <div class=\"panel-heading\">\n    Product Managment\n  </div>\n  <div class=\"panel-body\" *ngIf=\"products && products.length\">\n    <div class=\"table-responsive\">\n      <table class=\"table table-condensed table-hover table-striped\">\n        <thead>\n          <tr>\n            <th>ID</th>\n            <th>Store ID</th>\n            <th>Created</th>\n            <th>Updated</th>\n            <th>Title</th>\n            <th></th>\n          </tr>\n        </thead>\n        <tbody>\n          <tr *ngFor=\"let product of products\">\n            <td>{{ product.id }}</td>\n            <td>{{ product.store_id }}</td>\n            <td>{{ product.created_at | date:'medium' }}</td>\n            <td>{{ product.updated_at | date:'medium' }}</td>\n            <td>{{ product.title }}</td>\n            <td><a class=\"btn btn-link\" [routerLink]=\"['/product', product.id]\"><span class=\"glyphicon glyphicon-pencil\"></span> edit</a></td>\n          </tr>\n        </tbody>\n      </table>\n    </div>\n  </div>\n  <div class=\"panel-footer\">\n    <a type=\"button\" class=\"btn btn-sm btn-primary\" [routerLink]=\"['/product', '-1']\"><span class=\"glyphicon glyphicon-plus\"></span> add new</a>\n  </div>\n</div>\n"

/***/ }),

/***/ 775:
/***/ (function(module, exports) {

module.exports = "<h4 class=\"text-center\" *ngIf=\"!reference || !allProducts ||  !allManufacturers\">\n    <span class=\"glyphicon glyphicon-refresh spin\"></span> Loading Reference Details\n</h4>\n\n<label *ngIf=\"reference && allProducts && allManufacturers\">{{ id === '-1' ? 'New' : 'Edit' }} reference Entry</label>\n\n<form class=\"form-horizontal\" [formGroup]=\"referenceForm\" (ngSubmit)=\"onSubmit($event)\" *ngIf=\"reference && allProducts && allManufacturers\">\n    <div class=\"panel panel-primary\">\n        <div class=\"panel-heading\">\n            Reference Details\n        </div>\n        <div class=\"panel-body\">\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Title</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"text\" class=\"form-control col-8\" formControlName=\"title\" value=\"{{ reference.title }}\" required>\n                </div>\n            </div>\n           <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Description</label>\n                <div class=\"col-xs-6\">\n                    <textarea class=\"form-control\" rows=\"8\" formControlName=\"description\" value=\"{{ reference.description }}\" required></textarea>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Video</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"text\" class=\"form-control col-8\" formControlName=\"video\" value=\"{{ reference.video }}\" required>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Store</label>\n                <div class=\"col-xs-6\">\n                    <select class=\"form-control col-8\" formControlName=\"store_id\" required>\n                            <option *ngFor=\"let store of stores\" [value]=\"store.id\">{{ store.store_name }}</option>\n                    </select>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Products</label>\n                <div class=\"col-xs-6\">\n                    <select multiple class=\"form-control col-8\" formControlName=\"selectedProducts\" size=\"8\" required>\n                            <option *ngFor=\"let product of allProducts\" [ngValue]=\"product.id\">{{ product.title }}</option>\n                    </select>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Manufacturers</label>\n                <div class=\"col-xs-6\">\n                    <select multiple class=\"form-control col-8\" formControlName=\"selectedManufacturers\" size=\"8\" required>\n                            <option *ngFor=\"let manufacturer of allManufacturers\" [ngValue]=\"manufacturer.id\">{{ manufacturer.name }}</option>\n                    </select>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Add Image +</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"file\" placeholder=\"Choose File\" accept=\"image/*\" id=\"image_url\" (change)=\"changeListener($event)\"\n                    />\n                </div>\n            </div>\n            <div class=\"col-xs-offset-3 col-xs-6\" *ngFor=\"let photo of newImages\">\n                <img class=\"img img-responsive\"  [src]='photo'>\n            </div>\n            <div class=\"form-group\">\n                <div class=\"col-xs-offset-3 col-xs-6\" *ngFor=\"let image of myImages; let i=index;\">\n                    <img  class=\"img img-responsive\" [src]=\"image.url\">\n                    <button type=\"button\" class=\"btn btn-sm btn-danger\" (click)=\"deleteImage(image.id, i)\" [disabled]='disabled'><span class=\"glyphicon glyphicon-remove\"></span> remove</button>\n                </div>\n            </div>\n        </div>\n        <div class=\"panel-footer\">\n            <a class=\"btn btn-default\" routerLink=\"/references\"><span class=\"glyphicon glyphicon-chevron-left\"></span>back</a>\n            <div class=\"pull-right\">\n                <span class=\"glyphicon glyphicon-refresh spin\" *ngIf=\"disabled\"></span>\n                <button type=\"submit\" class=\"btn btn-primary\" [disabled]='disabled'> <span class=\"glyphicon glyphicon-ok\"></span> save</button>\n                <button type=\"button\" class=\"btn btn-danger\" (click)=\"deleteReference(reference.id)\" *ngIf=\"id != -1\" [disabled]='disabled'><span class=\"glyphicon glyphicon-remove\"></span> delete</button>\n            </div>\n        </div>\n    </div>\n</form>"

/***/ }),

/***/ 776:
/***/ (function(module, exports) {

module.exports = "<h4 class=\"text-center\" *ngIf=\"!references\">\n  <span class=\"glyphicon glyphicon-refresh spin\"></span> Loading References\n</h4>\n\n<div class=\"panel panel-primary\">\n  <div class=\"panel-heading\">\n    Reference Managment\n  </div>\n  <div class=\"panel-body\" *ngIf=\"references && references.length\">\n    <div class=\"table-responsive\">\n      <table class=\"table table-condensed table-hover table-striped\">\n        <thead>\n          <tr>\n            <th>ID</th>\n            <th>Store ID</th>\n            <th>Created</th>\n            <th>Updated</th>\n            <th>Title</th>\n            <th></th>\n          </tr>\n        </thead>\n        <tbody>\n          <tr *ngFor=\"let reference of references\">\n            <td>{{ reference.id }}</td>\n            <td>{{ reference.store_id }}</td>\n            <td>{{ reference.created_at | date:'medium' }}</td>\n            <td>{{ reference.updated_at | date:'medium' }}</td>\n            <td>{{ reference.title }}</td>\n            <td><a class=\"btn btn-link\" [routerLink]=\"['/reference', reference.id]\"><span class=\"glyphicon glyphicon-pencil\"></span> edit</a></td>\n          </tr>\n        </tbody>\n      </table>\n    </div>\n  </div>\n  <div class=\"panel-footer\">\n    <a type=\"button\" class=\"btn btn-sm btn-primary\" [routerLink]=\"['/reference', '-1']\"><span class=\"glyphicon glyphicon-plus\"></span> add new</a>\n  </div>\n</div>"

/***/ }),

/***/ 777:
/***/ (function(module, exports) {

module.exports = "<h4 class=\"text-center\" *ngIf=\"!registerfield\">\n    <span class=\"glyphicon glyphicon-refresh spin\"></span> Loading Registerfield Details\n</h4>\n\n<label *ngIf=\"registerfield\">{{ id === '-1' ? 'New' : 'Edit' }} Registerfield Entry</label>\n\n<form class=\"form-horizontal\" [formGroup]=\"registerfieldForm\" (ngSubmit)=\"onSubmit($event)\" *ngIf=\"registerfield\">\n    <div class=\"panel panel-primary\">\n        <div class=\"panel-heading\">\n            Registerfield Details\n        </div>\n        <div class=\"panel-body\">\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Key</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"text\" class=\"form-control col-8\" formControlName=\"key\" value=\"{{ registerfield.key }}\" required>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Name</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"text\" class=\"form-control col-8\" formControlName=\"name\" value=\"{{ registerfield.name }}\" required>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Location</label>\n                <div class=\"col-xs-6\">\n                    <select class=\"form-control col-8\" formControlName=\"location\" [value]=\"registerfield.fieldlocation\" required>\n                            <option>Firma</option>\n                            <option>Ansprechpartner</option>\n                            <option>Service</option>\n                            <option>Not selected</option>\n                    </select>\n                </div>\n            </div>\n        </div>\n        <div class=\"panel-footer\">\n            <a class=\"btn btn-default\" routerLink=\"/registerfields\"><span class=\"glyphicon glyphicon-chevron-left\"></span>back</a>\n            <div class=\"pull-right\">\n                <span class=\"glyphicon glyphicon-refresh spin\" *ngIf=\"disabled\"></span>\n                <button type=\"submit\" class=\"btn btn-primary\" [disabled]='disabled'> <span class=\"glyphicon glyphicon-ok\"></span> save</button>\n                <button type=\"button\" class=\"btn btn-danger\" (click)=\"deleteRegisterfield(registerfield.id)\" *ngIf=\"id != -1\" [disabled]='disabled'><span class=\"glyphicon glyphicon-remove\"></span> delete</button>\n            </div>\n        </div>\n    </div>\n</form>"

/***/ }),

/***/ 778:
/***/ (function(module, exports) {

module.exports = "<h4 class=\"text-center\" *ngIf=\"!registerfields\">\n  <span class=\"glyphicon glyphicon-refresh spin\"></span> Loading Registerfields\n</h4>\n\n<div class=\"panel panel-primary\">\n  <div class=\"panel-heading\">\n    Registerfields Managment\n  </div>\n  <div class=\"panel-body\" *ngIf=\"registerfields && registerfields.length\">\n    <div class=\"table-responsive\">\n      <table class=\"table table-condensed table-hover table-striped\">\n        <thead>\n          <tr>\n            <th>ID</th>\n            <th>Created</th>\n            <th>Updated</th>\n            <th>Name</th>\n            <th></th>\n          </tr>\n        </thead>\n        <tbody>\n          <tr *ngFor=\"let registerfield of registerfields\">\n            <td>{{ registerfield.id }}</td>\n            <td>{{ registerfield.created_at | date:'medium' }}</td>\n            <td>{{ registerfield.updated_at | date:'medium' }}</td>\n            <td>{{ registerfield.name }}</td>\n            <td><a class=\"btn btn-link\" [routerLink]=\"['/registerfield', registerfield.id]\"><span class=\"glyphicon glyphicon-pencil\"></span> edit</a></td>\n          </tr>\n        </tbody>\n      </table>\n    </div>\n  </div>\n  <div class=\"panel-footer\">\n    <a type=\"button\" class=\"btn btn-sm btn-primary\" [routerLink]=\"['/registerfield', '-1']\"><span class=\"glyphicon glyphicon-plus\"></span> add new</a>\n  </div>\n</div>"

/***/ }),

/***/ 779:
/***/ (function(module, exports) {

module.exports = "<h4 class=\"text-center\" *ngIf=\"!slide\">\n    <span class=\"glyphicon glyphicon-refresh spin\"></span> Loading Slide\n</h4>\n\n<label *ngIf=\"slide\">{{ id === '-1' ? 'New' : 'Edit' }} Slide Entry</label>\n\n<form class=\"form-horizontal\" [formGroup]=\"slideForm\" (ngSubmit)=\"onSubmit($event)\" *ngIf=\"slide\">\n    <div class=\"panel panel-primary\">\n        <div class=\"panel-heading\">\n            Slide Details\n        </div>\n        <div class=\"panel-body\">\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Title</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"text\" class=\"form-control\" formControlName=\"title\" value=\"{{ slide.title }}\">\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Image URL</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"text\" class=\"form-control\" value=\"{{ slide.image_url }}\" disabled>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Slot 1 Store ID</label>\n                <div class=\"col-xs-6\">\n                    <select class=\"form-control\" formControlName=\"slot1_store_id\" [value]=\"slide.slot1_store_id\">\n                        <option *ngFor=\"let store of stores\" [value]=\"store.id\">{{store.store_name}}</option>\n                    </select>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Slot 1 Width (%)</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"number\" min=\"0\" max=\"100\" class=\"form-control\" formControlName=\"slot1_width\" value=\"{{ slide.slot1_width }}\">\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Slot 1 Expiration Date</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"date\" class=\"form-control\" formControlName=\"slot1_valid_until\" value=\"{{ slide.slot1_valid_until }}\">\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Slot 2 Store ID</label>\n                <div class=\"col-xs-6\">\n                    <select class=\"form-control\" formControlName=\"slot2_store_id\" [value]=\"slide.slot2_store_id\">\n                        <option *ngFor=\"let store of stores\" [value]=\"store.id\">{{store.store_name}}</option>\n                    </select>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Slot 2 Width (%)</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"number\" min=\"0\" max=\"100\" class=\"form-control\" formControlName=\"slot2_width\" value=\"{{ slide.slot2_width }}\">\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Slot 2 Expiration Date</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"date\" class=\"form-control\" formControlName=\"slot2_valid_until\" value=\"{{ slide.slot2_valid_until }}\">\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Slot 3 Store ID</label>\n                <div class=\"col-xs-6\">\n                    <select class=\"form-control\" formControlName=\"slot3_store_id\" [value]=\"slide.slot3_store_id\">\n                        <option *ngFor=\"let store of stores\" [value]=\"store.id\">{{store.store_name}}</option>\n                    </select>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Slot 3 Width (%)</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"number\" min=\"0\" max=\"100\" class=\"form-control\" formControlName=\"slot3_width\" value=\"{{ slide.slot3_width }}\">\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Slot 3 Expiration Date</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"date\" class=\"form-control\" formControlName=\"slot3_valid_until\" value=\"{{ slide.slot3_valid_until }}\">\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Slot 4 Store ID</label>\n                <div class=\"col-xs-6\">\n                    <select class=\"form-control\" formControlName=\"slot4_store_id\" [value]=\"slide.slot4_store_id\">\n                        <option *ngFor=\"let store of stores\" [value]=\"store.id\">{{store.store_name}}</option>\n                    </select>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Slot 4 Width (%)</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"number\" min=\"0\" max=\"100\" class=\"form-control\" formControlName=\"slot4_width\" value=\"{{ slide.slot4_width }}\">\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Slot 4 Expiration Date</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"date\" class=\"form-control\" formControlName=\"slot4_valid_until\" value=\"{{ slide.slot4_valid_until }}\">\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Slot 5 Store ID</label>\n                <div class=\"col-xs-6\">\n                    <select class=\"form-control\" formControlName=\"slot5_store_id\" [value]=\"slide.slot5_store_id\">\n                        <option *ngFor=\"let store of stores\" [value]=\"store.id\">{{store.store_name}}</option>\n                    </select>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Slot 5 Width (%)</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"number\" min=\"0\" max=\"100\" class=\"form-control\" formControlName=\"slot5_width\" value=\"{{ slide.slot5_width }}\">\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Slot 5 Expiration Date</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"date\" class=\"form-control\" formControlName=\"slot5_valid_until\" value=\"{{ slide.slot5_valid_until }}\">\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Select Image</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"file\" placeholder=\"Choose File\" accept=\"image/*\" id=\"image_url\" (change)=\"changeListener($event)\" />\n                </div>\n            </div>\n            <div class=\"col-xs-offset-3 col-xs-6\">\n                <img class=\"img img-responsive\" [src]='slide.image_url'>\n            </div>\n        </div>\n        <div class=\"panel-footer\">\n            <a class=\"btn btn-default\" routerLink=\"/slides\"><span class=\"glyphicon glyphicon-chevron-left\"></span>back</a>\n            <div class=\"pull-right\">\n                <span class=\"glyphicon glyphicon-refresh spin\" *ngIf=\"disabled\"></span>\n                <button type=\"submit\" class=\"btn btn-primary\" [disabled]='disabled'> <span class=\"glyphicon glyphicon-ok\"></span> save</button>\n                <button type=\"button\" class=\"btn btn-danger\" (click)=\"deleteSlide(slide.id)\" *ngIf=\"id != -1\" [disabled]='disabled'><span class=\"glyphicon glyphicon-remove\"></span> delete</button>\n            </div>\n        </div>\n    </div>\n</form>"

/***/ }),

/***/ 780:
/***/ (function(module, exports) {

module.exports = "<h4 class=\"text-center\" *ngIf=\"!slides\">\n  <span class=\"glyphicon glyphicon-refresh spin\"></span> Loading Slides\n</h4>\n\n<div class=\"panel panel-primary\">\n  <div class=\"panel-heading\">\n    Slide Managment\n  </div>\n  <div class=\"panel-body\" *ngIf=\"slides && slides.length\">\n    <div class=\"table-responsive\">\n      <table class=\"table table-condensed table-hover table-striped\">\n        <thead>\n          <tr>\n            <th>ID</th>\n            <th>Created</th>\n            <th>Updated</th>\n            <th>Slide Title</th>\n            <th></th>\n          </tr>\n        </thead>\n        <tbody>\n          <tr *ngFor=\"let slide of slides\">\n            <td>{{ slide.id }}</td>\n            <td>{{ slide.created_at | date:'medium' }}</td>\n            <td>{{ slide.updated_at | date:'medium' }}</td>\n            <td>{{ slide.title }}</td>\n            <td><a class=\"btn btn-link\" [routerLink]=\"['/slide', slide.id]\"><span class=\"glyphicon glyphicon-pencil\"></span> edit</a></td>\n          </tr>\n        </tbody>\n      </table>\n    </div>\n  </div>\n  <div class=\"panel-footer\">\n    <a type=\"button\" class=\"btn btn-sm btn-primary\" [routerLink]=\"['/slide', '-1']\"><span class=\"glyphicon glyphicon-plus\"></span> add new</a>\n  </div>\n</div>"

/***/ }),

/***/ 781:
/***/ (function(module, exports) {

module.exports = "<h4 class=\"text-center\" *ngIf=\"!packages || !locations\">\n    <span class=\"glyphicon glyphicon-refresh spin\"></span> Loading Store Details\n</h4>\n\n<form class=\"form-horizontal\" [formGroup]=\"storeForm\" (ngSubmit)=\"onSubmit($event)\" *ngIf=\"storeForm && packages && locations\">\n    <div class=\"panel panel-primary\">\n        <div class=\"panel-heading\">\n            Store Details\n        </div>\n        <div class=\"panel-body\">\n\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">User Email</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"email\" class=\"form-control col-8\" formControlName=\"email\" value=\"{{ email }}\" required>\n                </div>\n            </div>\n\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Store Name</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"text\" class=\"form-control col-8\" formControlName=\"company\" value=\"{{ company }}\" required>\n                </div>\n            </div>\n\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Select Location</label>\n                <div class=\"col-xs-6\">\n                    <select class=\"form-control col-8\" formControlName=\"location_id\" required>\n                        <option *ngFor=\"let location of locations\" [value]=\"location.id\">{{ location.name }}</option>\n                    </select>\n                </div>\n            </div>\n\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Select Packages</label>\n                <div class=\"col-xs-6\">\n                    <select class=\"form-control col-8\" formControlName=\"package_id\" required>\n                        <option *ngFor=\"let package of packages\" [value]=\"package.id\">{{ package.name }}</option>\n                    </select>\n                </div>\n            </div>\n\n        </div>\n        <div class=\"panel-footer\">\n            <a class=\"btn btn-default\" routerLink=\"/stores\"><span class=\"glyphicon glyphicon-chevron-left\"></span>back</a>\n            <div class=\"pull-right\">\n                <span class=\"glyphicon glyphicon-refresh spin\" *ngIf=\"disabled\"></span>\n                <button type=\"submit\" class=\"btn btn-primary\" [disabled]='disabled'> <span class=\"glyphicon glyphicon-ok\"></span> save</button>\n            </div>\n        </div>\n    </div>\n</form>"

/***/ }),

/***/ 782:
/***/ (function(module, exports) {

module.exports = "<h4 class=\"text-center\" *ngIf=\"!store || !locations\">\n    <span class=\"glyphicon glyphicon-refresh spin\"></span> Loading Store Details\n</h4>\n\n<label *ngIf=\"store\">Edit Store Entry</label>\n\n<form class=\"form-horizontal\" [formGroup]=\"storeForm\" (ngSubmit)=\"onSubmit($event)\" *ngIf=\"store && locations\">\n    <div class=\"panel panel-primary\">\n        <div class=\"panel-heading\">\n            Store Details\n        </div>\n        <div class=\"panel-body\">\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">User ID</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"text\" class=\"form-control col-8\"  value=\"{{ store.user_id }}\" disabled>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">User Email</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"email\" class=\"form-control col-8\" formControlName=\"email\" value=\"{{ store.user_email }}\" required>\n                </div>\n            </div>\n            <div class=\"form-group\" *ngIf=\"!upgradedPackageName && store.package_name === 'Light Store'\">\n                <label class=\"col-xs-3 control-label\">Package Upgrade</label>\n                <div class=\"col-xs-6 package-buttons\">\n                    <div class=\"alert alert-warning\">\n                        This is Light Store. Clicking on a package to upgrade it <strong>instantly</strong>.\n                    </div>\n                    <button class=\"btn\" type=\"button\"\n                       *ngFor=\"let package of paidPackages\"\n                       (click)=\"upgrade(package)\"\n                       [disabled]=\"upgrading\"\n                       [ngClass]=\"package === store.package_name ? 'btn-default' : 'btn-primary'\">\n                        {{package}}\n                        <span *ngIf=\"package === 'Light Store'\">(current)</span>\n                    </button>\n                </div>\n            </div>\n            <div class=\"form-group\" *ngIf=\"upgradedPackageName || store.package_name !== 'Light Store'\">\n                <label class=\"col-xs-3 control-label\">Package</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"text\" class=\"form-control col-8\" value=\"{{ upgradedPackageName || store.package_name }}\" disabled>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Store Name</label>\n                <div class=\"col-xs-6\">\n                    <input type=\"text\" class=\"form-control col-8\" formControlName=\"store\" value=\"{{ store.store_name }}\" required>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Status</label>\n                <div class=\"col-xs-6\">\n                    <select class=\"form-control col-8\" formControlName=\"status\" [value]=\"store.status\" required>                \n                            <option [value]=\"1\">Yes</option>\n                            <option [value]=\"0\">No</option>\n                    </select>\n                </div>\n            </div>\n            <!--<div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Select Category</label>\n                <div class=\"col-xs-6\">\n                    <select class=\"form-control col-8\" required>\n                            <option  [value]=\"0\">Default Category</option>\n                            <option  [value]=\"1\">Living room furniture</option>\n                            <option  [value]=\"2\">Bedroom furniture</option>\n                            <option  [value]=\"3\">Another Category</option>\n                    </select>\n                </div>\n            </div>-->\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\">Select Location</label>\n                <div class=\"col-xs-6\">\n                    <select class=\"form-control col-8\" formControlName=\"location\" required>\n                            <option *ngFor=\"let location of locations\" [value]=\"location.id\">{{ location.name }}</option>\n                    </select>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\"> Fields and values</label>\n                <div class=\"col-xs-6\">\n                    <select multiple class=\"form-control col-8\" size=\"8\">\n                            <option *ngFor=\"let registerfield of store.user.registerfields\" [ngValue]=\"registerfield.id\">{{ registerfield.name }} = {{ registerfield.pivot.valueEntered }}</option>\n                    </select>\n                </div>\n            </div>\n            <div class=\"form-group\">\n                <label class=\"col-xs-3 control-label\"> Select Image</label>\n                <input class=\"col-xs-6\" type=\"file\" placeholder=\"Choose File\" accept=\"image/*\" id=\"filename_reference_image_url\" (change)=\"changeListener($event)\"\n                />\n            </div>\n            <div class=\"col-xs-offset-3 col-xs-6\">\n                <img class=\"img img-responsive\" [src]='store.cover_url'>\n            </div>\n        </div>\n        <div class=\"panel-footer\">\n            <a class=\"btn btn-default\" routerLink=\"/stores\"><span class=\"glyphicon glyphicon-chevron-left\"></span>back</a>\n            <div class=\"pull-right\">\n                <span class=\"glyphicon glyphicon-refresh spin\" *ngIf=\"disabled\"></span>\n                <button type=\"submit\" class=\"btn btn-primary\" [disabled]='disabled'> <span class=\"glyphicon glyphicon-ok\"></span> save</button>\n                <button type=\"button\" class=\"btn btn-danger\" (click)=\"deleteStore(store.id)\" *ngIf=\"id != -1\" [disabled]='disabled'><span class=\"glyphicon glyphicon-remove\"></span> delete</button>\n            </div>\n        </div>\n    </div>\n</form>"

/***/ }),

/***/ 783:
/***/ (function(module, exports) {

module.exports = "<h4 class=\"text-center\" *ngIf=\"!stores\">\n  <span class=\"glyphicon glyphicon-refresh spin\"></span> Loading Stores\n</h4>\n\n<div class=\"panel panel-primary\">\n  <div class=\"panel-heading\">\n    Activate Stores\n  </div>\n  <div class=\"panel-body\" *ngIf=\"stores && stores.length\">\n    <div class=\"table-responsive\">\n      <table class=\"table table-condensed table-hover table-striped \">\n        <thead>\n          <tr>\n            <th>ID</th>\n            <th>Created</th>\n            <th>Updated</th>\n            <th>User Email</th>\n            <th>Package</th>\n            <th>Status</th>\n            <th></th>\n          </tr>\n        </thead>\n        <tbody>\n          <tr *ngFor=\"let store of stores\">\n            <td>{{ store.id }}</td>\n            <td>{{ store.created_at | date:'medium' }}</td>\n            <td>{{ store.updated_at | date:'medium' }}</td>\n            <td>{{ store.user_email }}</td>\n            <td>{{ store.package_name }}</td>\n            <td>{{ store.status ? 'Confirmed' : 'Not confirmed'}}</td>\n            <td><a class=\"btn btn-link\" [routerLink]=\"['/store', store.id]\"><span class=\"glyphicon glyphicon-pencil\"></span> edit</a></td>\n          </tr>\n        </tbody>\n      </table>\n    </div>\n  </div>\n  <div class=\"panel-footer\">\n    <a type=\"button\" class=\"btn btn-sm btn-primary\" [routerLink]=\"['/store/create']\"><span class=\"glyphicon glyphicon-plus\"></span> add new</a>\n  </div>\n</div>"

/***/ }),

/***/ 86:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__extended_http_service__ = __webpack_require__(73);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__angular_http__ = __webpack_require__(37);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__ = __webpack_require__(31);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__environments_environment__ = __webpack_require__(42);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5_rxjs_add_operator_map__ = __webpack_require__(63);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5_rxjs_add_operator_map___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_5_rxjs_add_operator_map__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6_rxjs_add_operator_catch__ = __webpack_require__(62);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6_rxjs_add_operator_catch___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_6_rxjs_add_operator_catch__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ApiStoreService; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};







var ApiStoreService = (function () {
    function ApiStoreService(http) {
        this.http = http;
        this.apiUrl = __WEBPACK_IMPORTED_MODULE_4__environments_environment__["a" /* environment */].domain_url + "api/stores/";
    }
    ApiStoreService.prototype.getAll = function () {
        return this.http.get(this.apiUrl + 'all')
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiStoreService.prototype.getAllActive = function () {
        return this.http.get(this.apiUrl + 'list/active')
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiStoreService.prototype.get = function (id) {
        return this.http.get(this.apiUrl + id)
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiStoreService.prototype.upgrade = function (id, packageName) {
        return this.http.post(this.apiUrl + id + '/upgrade', { package_name: packageName })
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiStoreService.prototype.create = function (data) {
        var headers = new __WEBPACK_IMPORTED_MODULE_2__angular_http__["Headers"]({ 'Content-Type': 'application/json' });
        var options = new __WEBPACK_IMPORTED_MODULE_2__angular_http__["RequestOptions"]({ headers: headers });
        return this.http.post(this.apiUrl, data, options)
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json() || 'Server error'); });
    };
    ApiStoreService.prototype.activateStore = function (id, data) {
        var headers = new __WEBPACK_IMPORTED_MODULE_2__angular_http__["Headers"]({ 'Content-Type': 'application/json' });
        var options = new __WEBPACK_IMPORTED_MODULE_2__angular_http__["RequestOptions"]({ headers: headers });
        return this.http.post(this.apiUrl + 'activate/' + id, data, options)
            .map(function (res) { res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiStoreService.prototype.delete = function (id) {
        return this.http.delete(this.apiUrl + 'delete/' + id)
            .map(function (res) { })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_3_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    ApiStoreService = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_1__angular_core__["Injectable"])(), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_0__extended_http_service__["a" /* ExtendedHttpService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_0__extended_http_service__["a" /* ExtendedHttpService */]) === 'function' && _a) || Object])
    ], ApiStoreService);
    return ApiStoreService;
    var _a;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/api.store.service.js.map

/***/ }),

/***/ 87:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_angular2_jwt__ = __webpack_require__(256);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_angular2_jwt___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_angular2_jwt__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_router__ = __webpack_require__(17);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__angular_core__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__angular_http__ = __webpack_require__(37);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4_rxjs__ = __webpack_require__(31);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4_rxjs___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_4_rxjs__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__environments_environment__ = __webpack_require__(42);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6_rxjs_add_operator_map__ = __webpack_require__(63);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6_rxjs_add_operator_map___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_6_rxjs_add_operator_map__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return AuthenticationService; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};







var AuthenticationService = (function () {
    function AuthenticationService(http, router) {
        this.http = http;
        this.router = router;
        this.loggedIn = new __WEBPACK_IMPORTED_MODULE_4_rxjs__["BehaviorSubject"](false);
        this.redirectUrl = '';
        // set token if saved in local storage
        this.user = JSON.parse(localStorage.getItem('user'));
        this.token = localStorage.getItem('token');
    }
    AuthenticationService.prototype.login = function (username, password) {
        var _this = this;
        return this.http.post(__WEBPACK_IMPORTED_MODULE_5__environments_environment__["a" /* environment */].domain_url + "api/auth/login", { email: username, password: password })
            .map(function (response) {
            _this.user = response.json().user;
            _this.token = response.json().token;
            _this.loggedIn.next(true);
            localStorage.setItem('user', JSON.stringify({ Object: _this.user }));
            localStorage.setItem('token', _this.token);
        })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_4_rxjs__["Observable"].throw(error || 'Server error'); });
    };
    AuthenticationService.prototype.logout = function () {
        // clear token remove user from local storage to log user out
        this.token = null;
        this.user = null;
        this.loggedIn.next(false);
        localStorage.removeItem('token');
        localStorage.removeItem('user');
        this.router.navigate(['/login']);
    };
    AuthenticationService.prototype.check = function () {
        var _this = this;
        var headers = new __WEBPACK_IMPORTED_MODULE_3__angular_http__["Headers"]({ 'Content-Type': 'application/json' });
        headers.append('Authorization', "Bearer " + this.token);
        headers.append('Accept', 'application/json');
        var options = new __WEBPACK_IMPORTED_MODULE_3__angular_http__["RequestOptions"]({ headers: headers });
        return this.http.get(__WEBPACK_IMPORTED_MODULE_5__environments_environment__["a" /* environment */].domain_url + "api/auth/check", options)
            .map(function (response) {
            _this.user = response.json().user;
            _this.token = response.json().token;
            _this.loggedIn.next(true);
            localStorage.setItem('user', JSON.stringify({ Object: _this.user }));
            localStorage.setItem('token', _this.token);
        })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_4_rxjs__["Observable"].throw(error || 'Server error'); });
    };
    AuthenticationService.prototype.isLoggedIn = function () {
        return this.loggedIn.asObservable();
    };
    AuthenticationService.prototype.tokenStillActive = function () {
        return __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0_angular2_jwt__["tokenNotExpired"])('token');
    };
    AuthenticationService.prototype.tokenExpired = function () {
        return !this.tokenStillActive();
    };
    AuthenticationService = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_2__angular_core__["Injectable"])(), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_3__angular_http__["Http"] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_3__angular_http__["Http"]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_1__angular_router__["a" /* Router */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_1__angular_router__["a" /* Router */]) === 'function' && _b) || Object])
    ], AuthenticationService);
    return AuthenticationService;
    var _a, _b;
}());
//# sourceMappingURL=/Users/shone/Projects/topditop/topditop/admin/src/authentication.service.js.map

/***/ })

},[1049]);
//# sourceMappingURL=main.bundle.js.map