define(['uiComponent', 'jquery', 'mage/url', 'ko'], function (Component, $, urlBuilder, ko) {
    var mixin = {
        handleSearch: function(searchSku) {
            this.searchSkuLength = 5;
            this._super();
        },
    };

    return function (target) {
        return target.extend(mixin);
    };
});

