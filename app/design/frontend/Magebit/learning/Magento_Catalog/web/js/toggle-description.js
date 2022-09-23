define([
    'uiComponent',
], function(Component){
    return Component.extend({
        initialize: function () {
            this._super();
            this.descriptionElement = document.getElementById('product-description-field')
            this.toggleButton = document.getElementById('toggle-description-button')
        },

        toggleDescription: function () {
            if (this.descriptionElement.classList.contains('show')) {
                this.descriptionElement.classList.remove('show')
                this.toggleButton.innerHTML = 'more'
            } else {
                this.descriptionElement.classList.add('show')
                this.toggleButton.innerHTML = 'less'
            }
        }
    })
})
