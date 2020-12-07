
class RandomNumberGenerator {

    userMin: number;
    userMax: number;

    constructor(randomParams: randomLimits) {
        this.userMin = randomParams.min;
        this.userMax = randomParams.max;
    }
    randomNumber(paramMin: number = this.userMin, paramMax: number = this.userMax) {
        return Math.floor(Math.random() * paramMax + paramMin);
    }
    newMin(newMin: number = 1) {
        this.userMin = newMin;
    }
    newMax(newMax: number = 11) {
        this.userMax = newMax;
    }
    getMin() {
        return this.userMin;
    }
    getMax() {
        return this.userMax;
    }
    testRange(input: number) {
        if (input < this.userMin ||
            input > this.userMax
        ) return false;
        return true;
    }
}

interface randomLimits {
    min: number;
    max: number;
}

let randomParams = { min: 1, max: 10 };

const rng = new RandomNumberGenerator(randomParams);