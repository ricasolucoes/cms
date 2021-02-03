/**
 * Created by sierra on 04/06/17.
 */
function isElementInViewport(el)
{
    if (!el) {
        return false;
    }
    var rect = el.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}
function loadItemsInView()
{
    //Select elements by the row id.
    $("#row [data-src]").each(
        function () {
            var isVisible = isElementInViewport(this);
            if (isVisible) {
                if ($(this).attr("src") == undefined) {
                    $(this).attr("src", $(this).data("src"));
                }
            }
        }
    );
}

//Example of calling loadItemsInView() from within window.onscroll()
$(window).on(
    "scroll", function () {
        loadItemsInView();
    }
);
loadItemsInView();