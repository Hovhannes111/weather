const FControl = {
    appendSelectOptions: function ($el, options) {
        $el.html(this.getSelectOptionsHTML(options));
    },
    getSelectOptionsHTML: function (options) {
         let html = '<option value="0" data-id="0">Please select your state</option>'
         options.forEach( value =>
            html += `<option value=${value.id} data-location='{"latitude":${value.latitude}, "longitude":${value.longitude}}'>${value.name}</option>`
         )
         return html;
    },
    hide: function ($el) {
        $el.parent('div').hide()
    },
    show: function ($el) {
        $el.parent('div').show()
    }
}

export default FControl;
