// @TODO Use ES6 classes?
window.QuillForm = function (url) {
    var form = this;

    this.url = url;
    this.processing = false;
    this.successful = false;
    this.errors = {};

    this.process = function() {
        this.processing = true;

        return Vue.http.post(this.url, this).then(function(response) {
            form.processing = false;

            if (response.data.successful) {
                form.successful = true;
                form.errors = {};
            } else {
                form.successful = false;
                form.errors = response.data.errors;
            }
        }, function(response) {
            alert('Something went wrong. Please contact the site developer.');

            console.log(response);
        });
    },

    this.hasError = function(field) {
        return this.errors && this.errors.hasOwnProperty(field);
    }
};