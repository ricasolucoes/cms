    $(document).ready(
    function () {
        $("ul.layouts li.wide-layout").addClass("active");
        if ($.cookie('boxed') == "yes") {
            $("body").addClass("boxed");
            $("ul.layouts li.boxed-layout").addClass("active");
            $("ul.layouts li.wide-layout").removeClass("active");
        }
        
        if ($.cookie('boxed') == "no") {
            $("ul.layouts li.wide-layout").addClass("active");
        }
        if ($.cookie('BGPATTERN') != null) {
            StoredBgPattern = $.cookie('BGPATTERN');
            $("body").css("background-image","url('"+StoredBgPattern+"')");
            $("body").css("background-repeat","repeat");
            $("body").css("background-size","auto");
        }
        if ($.cookie('ColorScheme') != null) {
            StoredColorScheme = $.cookie('ColorScheme');
            $('link.alt').attr('href',StoredColorScheme);
        }
    }
);
    $(document).ready(
        function () {
            $(".color-scheme a").click(
                function () {
                    SCHEME = $(this).attr('data-rel');
                    $('link.alt').attr('href', $(this).attr('data-rel'));
                     $.cookie('ColorScheme',SCHEME);
                    return false;
                }
            );
            imgPathStart = "img/patterns/";
            imgPathEnd = new Array("pattern-01.jpg","pattern-02.jpg","pattern-03.jpg","pattern-04.jpg","pattern-05.jpg","pattern-06.jpg","pattern-07.gif","pattern-08.jpg","pattern-09.jpg","pattern-10.jpg","pattern-11.jpg","pattern-12.jpg","pattern-13.jpg","pattern-14.jpg","pattern-15.jpg");
            $(".background-selector li img").click(
                function () {
                    backgroundNumber = $(this).attr("data-nr");
                    bgPattern = imgPathStart+imgPathEnd[backgroundNumber]
                    $("body").css("background-image","url('"+bgPattern+"')");
                    $("body").css("background-repeat","repeat");
                    $("body").css("background-size","auto");
                     $.cookie('BGPATTERN',bgPattern);
                    $.removeCookie('BGIMAGE');
                }
            );
            $("ul.layouts li.wide-layout").click(
                function () {
                    $("body").removeClass("boxed");
                    $("body").css("background-image","none");
                    $("ul.layouts li").removeClass("active");
                     $.cookie('boxed','no',  {expires: 7, path: '/'});
                     $("body").removeClass("boxed");
                    $(this).addClass("active");
                    $("body").css("background-image","none");
                    $.removeCookie('BGPATTERN');
                    return false;
                }
            );
            $("ul.layouts li.boxed-layout").click(
                function () {
                    $("body").addClass("boxed");
                    $("ul.layouts li").removeClass("active");
                     $.cookie('boxed','yes', {expires: 7, path: '/'});
                     $("body").addClass("boxed");
                    $(this).addClass("active");
                     $.cookie('wide','no',  {expires: 7, path: '/'});
                    return false;
                }
            );
        }
    );    
