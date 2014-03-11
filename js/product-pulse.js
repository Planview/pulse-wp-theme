/**
 * Created by scrockett on 2/4/14.
 */
jQuery.webshims.polyfill();
jQuery.ajax({
    url: '//munchkin.marketo.net/munchkin.js',
    dataType: 'script',
    cache: true,
    success: function() {
    Munchkin.init('587-QLI-337');
    }
});
