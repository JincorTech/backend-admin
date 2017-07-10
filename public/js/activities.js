/**
 * Created by artem on 07.07.17.
 */
$(document).ready(function () {
    $('.tree_node').click(function (e) {
        e.preventDefault();
        e.stopPropagation();
        var childrenClass = '.child' + this.id;
        $(childrenClass).toggleClass('hide');
    })
});
