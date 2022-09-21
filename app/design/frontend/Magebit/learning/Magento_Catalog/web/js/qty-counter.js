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
            this.maxQty = config.maxQty;
            this.dataValidate = config.dataValidate;
            return this._super();
        },

        increaseQty: function() {
            const currentQty = this.qty();
            if(currentQty < this.maxQty){
                this.qty(currentQty + 1);
            }
        },

        decreaseQty: function() {
            const currentQty = this.qty();
            if(currentQty > 1){
                this.qty(currentQty - 1);
            }
        },
    })
})
