define([
    'uiComponent',
    'ko'
], function(Component, ko){
    return Component.extend({
        defaults: {
            template: "Magento_Catalog/input-counter"
        },

        initialize: function (config) {
            this.qty = ko.observable(parseInt(config.productDefaultQty));
            this.maxQty = parseInt(config.maxQty);
            this.dataValidate = config.dataValidate;
            this.inputElementId = config.inputElementId;
            this._super();
        },

        increaseQty: function () {
            const currentQty = parseInt(this.qty());
            if (currentQty < this.maxQty) {
                this.qty(currentQty + 1);
            }
        },

        decreaseQty: function () {
            const currentQty = parseInt(this.qty());
            if (currentQty > 1) {
                this.qty(currentQty - 1);
            }
        },

        watchInput: function () {
            function inputFocused () {

                console.log("input is focused");
                console.log(this);

                const currentQty = parseInt(this.inputElement.value);

                console.log('current qty:' + currentQty + ', this.qty: ' + this.qty());

                this.validateRangeListener = validateRange.bind(this, currentQty)

                this.inputElement.addEventListener("focusout", this.validateRangeListener);
                this.inputElement.removeEventListener('focusin', this.inputFocusedListener);
            }

            function validateRange (oldQty) {

                console.log("validating input");
                console.log(this);
                console.log('Old qty: ' + oldQty + ", qty: " + parseInt(this.qty()));

                const currentQty = parseInt(this.inputElement.value);

                if (currentQty < 1 || currentQty > this.maxQty) {
                    this.qty(oldQty);
                } else {
                    this.qty(currentQty);
                }

                this.inputElement.addEventListener('focusin', this.inputFocusedListener)
                this.inputElement.removeEventListener('focusout', this.validateRangeListener)
            }

            console.log("watching input");
            console.log(this);

            this.inputElement = document.getElementById(this.inputElementId);
            this.inputFocusedListener = inputFocused.bind(this);
            this.inputElement.addEventListener('focusin', this.inputFocusedListener);
        },
    })
})
