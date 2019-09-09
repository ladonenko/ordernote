define([
    'uiComponent',
], function (Component) {
    'use strict';

    return Component.extend({
        initialize: function () {
            this._super();
            return this;
        },
        defaults: {
            template: 'Ladonenko_OrderNote/checkout/order-note-block'
        },
        getDefaultNote: function () {
            if(window.checkoutConfig.quoteData.delivery_comment) {
                return window.checkoutConfig.quoteData.order_note;
            } else {
                return window.checkoutConfig.shipping.orderNote;
            }
        }
    });
});