module.exports = {
    data: function() {
        return {
            form: new QuillForm('/api/validate-register-form')
        };
    },

    methods: {
        handleRegisterFormSubmission: function(event) {
            event.preventDefault();

            // Process the form to check the validation.
            this.form.process().then(function() {
                // If the validation is successful, submit the form like normal.
                // Otherwise, the form will display error mesages to the user.
                if (this.form.successful) event.target.submit();
            }.bind(this));
        }
    }
};