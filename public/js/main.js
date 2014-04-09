/**
 * Created by harvey on 4/9/14.
 */

$(document).ready(function () {
    /*
     * #modal functions
     */
    // make sure to remove data from modals when closed
    $(document).on('hidden.bs.modal', function (e) {
        console.log('clearing modal data');
        $(e.target).removeData('bs.modal');
    });
    // ignore keypress of 'enter' key from forms in modals. needs to only accept clicking proper buttons
    $('#modalTarget').on('keydown', 'form', function(e){
        if(e.keyCode == 13) {
            e.preventDefault();
            return false;
        }
    });

    // open the modal
    $('.actions').on("click", ".modalToggle", function(e) {
        // setup URL
        $url = $(this).data('url');
        console.log($url);
        // load modal
        $('#modalTarget').modal({
            remote : $url
        });
    });

    // respond to the modal button event
    $('.modal').on('click', 'button.post', function(e) {
        // debug
        console.log("button post clicked!");
        // init vars
        $button = $(this);
        $button.button('please wait...');
        $formData = $( $(this).data('target') ).serializeArray();
        $formURL = $( $(this).data('target') ).attr('action');

        // post the form
        $.post(
            $formURL,
            $formData,
            function(response) {
                console.log(response);
                if ( response.status == 1 ) {
                    $('#modalTarget').modal('hide');
                    // #TODO update the data on the page
                    switch ( response.data.action ) {
                        case "create":
                            console.log("response.data.action is add");
                            // show message
                            displayAlert('success', response.message);
                            break;
                        case "update":
                            console.log("response.data.action is update");
                            // show message
                            displayAlert('success', response.message);
                            break;
                        case "delete":
                            console.log("response.data.action is delete");
                            // show message
                            displayAlert('success', response.message);
                            break;
                        case "reload":
                            location.reload(true);
                            break;
                        case "redirect":
                            location.replace(response.data.url);
                            break;
                    }
                } else {
                    // show error message
                    displayAlert('danger', response.message, '.modal .modal-body');
                    $button.button('reset')
                }
            }, "json"	// END function
        );	// END $.post(
    });
}); // #END $(document).ready

function displayAlert($type,$message,$location) {
    $location = typeof $location !== 'undefined' ? $location : '.content';

    switch ( $type ) {
        case 'danger':
            $icon = '<span class="glyphicon glyphicon-warning-sign"></span>';
            break;
        case 'success':
            $icon = '<span class="glyphicon glyphicon-ok"></span>';
            break;
        case 'info':
            $icon = '<span class="glyphicon glyphicon-info-sign"></span>';
            break;
        default:
            $icon = '';
    }

    $string = '<div class="alert alert-' + $type + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + $icon + ' ' + $message + '</div>';

    $($location).prepend($string);
}