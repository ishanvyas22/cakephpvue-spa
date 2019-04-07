export default class Errors {
    constructor() {
        this.errors = {};
    }

    add(errors) {
        this.errors = errors;
    }

    get(field) {
        if (this.errors[field]) {
            return this.errors[field];
        }
    }

    has(field) {
        if (this.errors[field]) {
            return true;
        }

        return false;
    }

    clear(field) {
        delete this.errors[field];
    }

    any() {
        return Object.keys(this.errors).length > 0;
    }
};
