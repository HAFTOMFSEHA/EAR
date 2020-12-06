(function ($) {
    $(document).ready(function () {

        // Magnific popup
        //-----------------------------------------------
        if (($(".popup-img").length > 0) || ($(".popup-iframe").length > 0) || ($(".popup-img-single").length > 0)) {
            $(".popup-img").magnificPopup({
                type: "image",
                gallery: {
                    enabled: true,
                }
            });
            $(".popup-img-single").magnificPopup({
                type: "image",
                gallery: {
                    enabled: false,
                }
            });
            $('.popup-iframe').magnificPopup({
                disableOn: 700,
                type: 'iframe',
                preloader: false,
                fixedContentPos: false
            });
        }
        ;

        //Scroll totop
        //-----------------------------------------------
        $(window).scroll(function () {
            if ($(this).scrollTop() != 0) {
                $(".scrollToTop").fadeIn();
            } else {
                $(".scrollToTop").fadeOut();
            }
        });

        $(".scrollToTop").click(function () {
            $("body,html").animate({scrollTop: 0}, 800);
        });

        //Owl carousel
        //-----------------------------------------------
        if ($('.owl-carousel').length > 0) {
            $(".owl-carousel.productImg").owlCarousel({
                singleItem: true,
                items: 1,
                autoPlay: true,
                pagination: true
            });


            $(".owl-carousel.homeProduct").owlCarousel({
                items: 4,
                //pagination: false,
                nav: true,
                dots: false,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                loop: true,
                margin: 10,
                autoplay: true,
                autoplayTimeout: 3000,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: true,

                    },
                    600: {
                        items: 2,
                        nav: true,
                    },
                    1000: {
                        items: 4,
                        nav: true,
                        loop: true
                    }
                }
            });
        }
        ;
        $('.liCategoryList').on('click', function (e) {
            e.preventDefault();
            $('#postad').css('display', 'none');
            $('#divCategoryForm').css('display', 'block');
        });
        $('#btnClose').on('click', function (e) {
            e.preventDefault();
            $('#postad').css('display', 'block');
            $('#divCategoryForm').css('display', 'none');
        });
        $('#ulMenu').on('click', function () {
            $('#postad').removeAttr('style');
            $('#divCategoryForm').removeAttr('style');
        });


    }); // End document ready
})(this.jQuery);

// the following to the end is whats needed for the thumbnails.
jQuery(document).ready(function () {

    $('#viewGrid').on('click', function (e) {
        e.preventDefault();
        $('.product_listing').fadeOut();
        $('.product_grid').fadeIn();
    });
    $('#viewList').on('click', function (e) {
        e.preventDefault();
        $('.product_listing').fadeIn();
        $('.product_grid').fadeOut();
    });

    // 1) ASSIGN EACH 'DOT' A NUMBER
    dotcount = 1;

    $('.productImg').find('.owl-dot').each(function () {
        jQuery(this).addClass('dotnumber' + dotcount);
        jQuery(this).attr('data-info', dotcount);
        dotcount = dotcount + 1;
    });

    // 2) ASSIGN EACH 'SLIDE' A NUMBER
    slidecount = 1;

    jQuery('.owl-item').not('.cloned').each(function () {
        jQuery(this).addClass('slidenumber' + slidecount);
        slidecount = slidecount + 1;
    });

    // SYNC THE SLIDE NUMBER IMG TO ITS DOT COUNTERPART (E.G SLIDE 1 IMG TO DOT 1 BACKGROUND-IMAGE)
    jQuery('.owl-dot').each(function () {

        grab = jQuery(this).data('info');

        slidegrab = jQuery('.slidenumber' + grab + ' img').attr('src');
        console.log(slidegrab);

        jQuery(this).css("background-image", "url(" + slidegrab + ")");

    });

    // THIS FINAL BIT CAN BE REMOVED AND OVERRIDEN WITH YOUR OWN CSS OR FUNCTION, I JUST HAVE IT
    // TO MAKE IT ALL NEAT
    amount = jQuery('.owl-dot').length;
    gotowidth = 100 / amount;

    jQuery('.owl-dot').css("width", gotowidth + "%");
    newwidth = jQuery('.owl-dot').width();
    jQuery('.owl-dot').css("height", newwidth + "px");


});

jQuery(document).on('click', '.mega-dropdown', function (e) {
    e.stopPropagation()
});

function onlyNumbers(evt) {
    var e = event || evt; // For trans-browser compatibility
    var charCode = e.which || e.keyCode;

    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function NumToWord(inputNumber, outputControl) {
    var str = new String(inputNumber)
    var splt = str.split("");
    var rev = splt.reverse();
    var once = ['Zero', ' One', ' Two', ' Three', ' Four', ' Five', ' Six', ' Seven', ' Eight', ' Nine'];
    var twos = ['Ten', ' Eleven', ' Twelve', ' Thirteen', ' Fourteen', ' Fifteen', ' Sixteen', ' Seventeen', ' Eighteen', ' Nineteen'];
    var tens = ['', 'Ten', ' Twenty', ' Thirty', ' Forty', ' Fifty', ' Sixty', ' Seventy', ' Eighty', ' Ninety'];

    numLength = rev.length;
    var word = new Array();
    var j = 0;

    for (i = 0; i < numLength; i++) {
        switch (i) {

            case 0:
                if ((rev[i] == 0) || (rev[i + 1] == 1)) {
                    word[j] = '';
                }
                else {
                    word[j] = '' + once[rev[i]];
                }
                word[j] = word[j];
                break;

            case 1:
                aboveTens();
                break;

            case 2:
                if (rev[i] == 0) {
                    word[j] = '';
                }
                else if ((rev[i - 1] == 0) || (rev[i - 2] == 0)) {
                    word[j] = once[rev[i]] + " Hundred ";
                }
                else {
                    word[j] = once[rev[i]] + " Hundred and";
                }
                break;

            case 3:
                if (rev[i] == 0 || rev[i + 1] == 1) {
                    word[j] = '';
                }
                else {
                    word[j] = once[rev[i]];
                }
                if ((rev[i + 1] != 0) || (rev[i] > 0)) {
                    word[j] = word[j] + " Thousand";
                }
                break;


            case 4:
                aboveTens();
                break;

            case 5:
                if ((rev[i] == 0) || (rev[i + 1] == 1)) {
                    word[j] = '';
                }
                else {
                    word[j] = once[rev[i]];
                }
                if (rev[i + 1] !== '0' || rev[i] > '0') {
                    word[j] = word[j] + " Lakh";
                }

                break;

            case 6:
                aboveTens();
                break;

            case 7:
                if ((rev[i] == 0) || (rev[i + 1] == 1)) {
                    word[j] = '';
                }
                else {
                    word[j] = once[rev[i]];
                }
                if (rev[i + 1] !== '0' || rev[i] > '0') {
                    word[j] = word[j] + " Crore";
                }
                break;

            case 8:
                aboveTens();
                break;


            case 9:
                if ((rev[i] == 0) || (rev[i + 1] == 1)) {
                    word[j] = '';
                }
                else {
                    word[j] = once[rev[i]];
                }
                if (rev[i + 1] !== '0' || rev[i] > '0') {
                    word[j] = word[j] + " Arab";
                }
                break;

            case 10:
                aboveTens();
                break;

            default:
                break;
        }
        j++;
    }

    function aboveTens() {
        if (rev[i] == 0) {
            word[j] = '';
        }
        else if (rev[i] == 1) {
            word[j] = twos[rev[i - 1]];
        }
        else {
            word[j] = tens[rev[i]];
        }
    }

    word.reverse();
    var finalOutput = '';
    for (i = 0; i < numLength; i++) {
        finalOutput = finalOutput + word[i];
    }
    document.getElementById(outputControl).innerHTML = finalOutput;
}

class AutoComplete {

    show(selector, route, form = null) {

        let options = {

            url: function () {
                return route;
            },

            getValue: function (element) {
                return element.title;
            },

            ajaxSettings: {
                dataType: "json",
                method: "GET",
                data: {
                    dataType: "json"
                }
            },

            preparePostData: function (data) {
                data.title = $(selector).val();
                return data;
            },
            requestDelay: 250,
            list: {
                showAnimation: {
                    type: "fade", //normal|slide|fade
                    time: 250,
                    callback: function () {
                    }
                },

                hideAnimation: {
                    type: "slide", //normal|slide|fade
                    time: 250,
                    callback: function () {
                    }
                },
                sort: {
                    enabled: true
                },
                maxNumberOfElements: 12,
                onClickEvent: function () {
                    if (form) {
                        $(form).submit();
                    }
                }
            },
            theme: 'blue-light',
            template: {
                type: "custom",
                method: function (value, item) {
                    return "<div style=\" padding: 5px;letter-spacing: 2px;color:darkblue;\">" + value + "</div>";
                }
            },
            placeholder: "What are you looking for ?"
        };

        $(selector).easyAutocomplete(options);

    }

}

//Redirect to detail page
function viewDetail(link) {
    if (link) {
        location.href = link;
    }
}
