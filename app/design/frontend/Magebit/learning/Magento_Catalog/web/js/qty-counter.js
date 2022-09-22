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
                // Console logs
                console.log("input is focused");
                console.log(this);
                // Console logs end

                const currentQty = parseInt(this.inputElement.value);
                const validateRangeListener = validateRange.bind(this, currentQty)
                this.inputElement.addEventListener("focusout", validateRangeListener);
                this.inputElement.removeEventListener('focusin', inputFocusedListener);
            }

            function validateRange (oldQty) {
                // Console logs
                console.log("validating input");
                console.log(this);
                console.log('Old qty: ' + oldQty + ", qty: " + parseInt(this.qty()));
                // Console logs end

                const currentQty = parseInt(this.inputElement.value);
                if (currentQty < 1 || currentQty > this.maxQty) {
                    this.qty(oldQty);
                } else {
                    this.qty(currentQty);
                }
                ;
                this.inputElement.removeEventListener('focusout', validateRangeListener);
            }

            console.log("watching input");
            console.log(this);

            this.inputElement = document.getElementById(this.inputElementId);
            const inputFocusedListener = inputFocused.bind(this);
            const validateRangeListener = validateRange.bind(this);
            this.inputElement.addEventListener('focusin', inputFocusedListener);
            this.inputElement.addEventListener('focusout', validateRangeListener);
        },
    })
})
