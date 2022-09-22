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

        /**
         * Validator for manual quantity input
         */
        watchInput: function () {
            /**
             *  Initialization setup
             */
            this.inputElement = document.getElementById(this.inputElementId);
            this.inputFocusedListener = inputFocused.bind(this);
            this.inputElement.addEventListener('focusin', this.inputFocusedListener);

            /**
             *  Called on focusin event
             */
            function inputFocused () {
                const currentQty = parseInt(this.inputElement.value); // Could be taken directly from observable this.qty() -> need to think about this (upon quick testing seemed like some bug happens, quantity jumps/skips)
                this.validateRangeListener = validateRange.bind(this, currentQty)
                this.inputElement.addEventListener("focusout", this.validateRangeListener);
                this.inputElement.removeEventListener('focusin', this.inputFocusedListener);
            }

            /**
             * Called on focusout event
             *
             * @param oldQty
             */
            function validateRange (oldQty) {
                const currentQty = parseInt(this.inputElement.value);

                if (currentQty < 1 || currentQty > this.maxQty || !currentQty) {
                    this.qty(oldQty);
                } else {
                    this.qty(currentQty);
                }

                this.inputElement.addEventListener('focusin', this.inputFocusedListener)
                this.inputElement.removeEventListener('focusout', this.validateRangeListener)
            }
        },
    })
})
