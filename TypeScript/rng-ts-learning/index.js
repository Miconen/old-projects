"use strict";
var RandomNumberGenerator = /** @class */ (function () {
    function RandomNumberGenerator(randomParams) {
        this.userMin = randomParams.min;
        this.userMax = randomParams.max;
    }
    RandomNumberGenerator.prototype.randomNumber = function (paramMin, paramMax) {
        if (paramMin === void 0) { paramMin = this.userMin; }
        if (paramMax === void 0) { paramMax = this.userMax; }
        return Math.floor(Math.random() * paramMax + paramMin);
    };
    RandomNumberGenerator.prototype.newMin = function (newMin) {
        if (newMin === void 0) { newMin = 1; }
        this.userMin = newMin;
    };
    RandomNumberGenerator.prototype.newMax = function (newMax) {
        if (newMax === void 0) { newMax = 11; }
        this.userMax = newMax;
    };
    RandomNumberGenerator.prototype.getMin = function () {
        return this.userMin;
    };
    RandomNumberGenerator.prototype.getMax = function () {
        return this.userMax;
    };
    RandomNumberGenerator.prototype.testRange = function (input) {
        if (input < this.userMin ||
            input > this.userMax)
            return false;
        return true;
    };
    return RandomNumberGenerator;
}());
var randomParams = { min: 1, max: 10 };
var rng = new RandomNumberGenerator(randomParams);
