$(document).ready(function () {

    //check all
    $("#checkAll").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });
    $.each($(".btnStatus"), function (i, v) {

        $(v).on("click", function (e) {

            e.preventDefault();

            var Status = $(this).data('status');
            var Id = $(this).data('id');
            var Url = $(this).data('url');

            $.ajax({

                type: "GET",
                url: Url,
                data: {status: Status, id: Id},
                success: function (dt) {

                    if (dt) {
                        $(v).html(dt.tgle);
                    }

                },
                error: function (err) {

                    swal('Error', "Oops something went wrong! " + err);

                }

            });// Ajax

        });// Status
    });


});

function confirmAndSubmit(Url) {

    swal({

        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'

    }).then((isConfirm) => {
        if (isConfirm) {
            window.location = Url;
        }
    });

}

function confirmAndSubmitWithTitleMessage(Url, title, message) {

    swal({

        title: title,
        text: message,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'

    }).then((isConfirm) => {
        if (isConfirm) {
            window.location = Url;
        }
    });

}


function confirmAndSubmitForm() {
    swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $("#formDelete").submit();
        }
    });
}


/*
 |----------------------------------------------------------------------
 | Filemanager popup box
 |----------------------------------------------------------------------
 |
 */

$('.standAloneFacnyBox').fancybox({
    'width': 900,
    'height': 600,
    'type': 'iframe',
    'autoScale': true,
    'padding': 0,
    'openEffect': 'elastic',//fade
    'closeEffect': 'elastic',
    'openSpeed': 'fast',
    'closeSpeed': 'fast'//slow
});

function responsive_filemanager_callback(field_id) {

    var image = $('#' + field_id).val();
    $('#' + field_id).attr('src', image);
    $('#h' + field_id).val(image);
}

function clearImg(field_id) {

    var noImg = '../../../lib/filemanager/no_img.png';
    $('#' + field_id).attr('src', noImg);
    $('#h' + field_id).val('');
}

function confirmFirst(field_id) {
    swal({

        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete !'

    }).then((isConfirm) => {
        if (isConfirm) {
            clearImg(field_id);
        }
    });
}



/*
 |----------------------------------------------------------------------
 | Select 2
 |----------------------------------------------------------------------
 |
 */
$(".select2").select2();

/*
 |----------------------------------------------------------------------
 | Flash Message Auto Close.
 |----------------------------------------------------------------------
 |
 */
// $('div.alert').not('.alert-important').delay(3000).fadeOut(350);

$('#flash-overlay-modal').modal();
