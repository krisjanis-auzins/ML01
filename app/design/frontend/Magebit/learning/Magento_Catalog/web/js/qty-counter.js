define([
    'uiComponent',
    'ko'
], function(Component, ko){
    console.log('The javascript works!')

    const component = Component.extend({
        defaults: {
            template: 'Magento_Catalog/input-counter'
        },
        initialize: function (config) {
            this._super();
            console.log(config);
        }
    });

    return component;
})
