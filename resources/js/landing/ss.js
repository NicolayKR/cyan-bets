i = jQuery, page.initBind = function() {
    i("[data-bind-radio]").each(function() {
        var e = i(this),
            n = e.data("bind-radio"),
            t = i('input[name="' + n + '"]:checked').val();
        if(e.attr('id') == 'cost-1' || e.attr('id') == 'cost-2'){
            e.html(e.dataAttr(t, e.text())+"<span class='month-cost'>/мес.</span>")
        }else{
            e.html(e.dataAttr(t, e.text()))
        }
        i('input[name="' + n + '"]').on("change", function() {
        var t = i('input[name="' + n + '"]:checked').val();
        i('[data-bind-radio="' + n + '"]').each(function() {
            var e = i(this);
            if(e.attr('id') == 'cost-1' || e.attr('id') == 'cost-2'){
                e.html(e.dataAttr(t, e.text())+"<span class='month-cost'>/мес.</span>")
            }else{
                e.html(e.dataAttr(t, e.text()))
            }
        })
        })
    }), i("[data-bind-href]").each(function() {
        var e = i(this),
            n = e.data("bind-href"),
            t = i('input[name="' + n + '"]:checked').val();
        e.attr("href", e.dataAttr(t)), i('input[name="' + n + '"]').on("change", function() {
            var t = i('input[name="' + n + '"]:checked').val();
            i('[data-bind-href="' + n + '"]').each(function() {
                var e = i(this);
                e.attr("href", e.dataAttr(t))
            })
        })
    })
}
