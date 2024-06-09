$(document).ready(function (e) {
    // $('li').css('display', 'flex');
    // $('li.more').html('');
    $(".emailspecialvalidation, .sizespecialvalidation, .specialvalidationdot, .specialvalidation, .addressspecialvalidation, .letters, .numeric, .headeremailspecialvalidation, .artwork_name, .specialcharacter, .allownumeric, .textareavalidation").bind("paste", function (e) {
        e.preventDefault();
    });

    //$().UItoTop({easingType: 'easeOutQuart'});

    $(document).on('keypress',".alphaspecialvalidation",function (e) {
        //allowed charters alpha characters only;
        var keyCode = e.which;
        //alert(keyCode);
        if (!((keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122))  && keyCode != 8 && keyCode != 32) {
            return false;
        }
    });
    $(document).on('keypress',".number",function (e) {
        //allowed charters Numeric characters only;
        var keyCode = e.which;
        // alert(keyCode);
        if (!((keyCode >= 48 && keyCode <= 57))  && keyCode != 8) {
            return false;
        }
    });
    $(document).on('keypress',".specialvalidation",function (e) {
    	//allowed charters alph and Numeric characters;
        var keyCode = e.which;
        if (!((keyCode >= 48 && keyCode <= 57)  || (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122))  && keyCode != 8 && keyCode != 32) {
            return false;
        }
    });
    $(document).on('keypress',".dashspecialvalidation",function (e) {
        //allowed charters alph Numeric and - characters ;
        var keyCode = e.which;
        if (!((keyCode >= 48 && keyCode <= 57)  || (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122)) && keyCode!=45  && keyCode != 8 && keyCode == 32) {
            return false;
            if(keyCode == 32){
                return false;
            }
        }
    });
    $(document).on('keypress',".dashspecialnamevalidation",function (e) {
        //allowed charters alph Numeric and - characters ;
        var keyCode = e.which;
        if (!((keyCode >= 48 && keyCode <= 57)  || (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122)) && keyCode!=45  && keyCode != 8 && keyCode != 32) {
            return false;
        }
    });
    $(document).on('keypress',".descriptionvalidation",function (e) {
        //allowed charters alph Numeric - / and . characters ;
        var keyCode = e.which;
        var keyCode = e.which;
        // alert(keyCode);
        if (!((keyCode >= 46 && keyCode <= 57)  || (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122)) && keyCode!=45  && keyCode != 8 && keyCode != 32) {
            return false;
        }
    });
    
    
    $(".addressspecialvalidation, .sizespecialvalidation").keypress(function (e) {
        var keyCode = e.which;
        if (keyCode == 46 || keyCode == 35) {
            return true;
        } else if (!((keyCode >= 48 && keyCode <= 57)
            || (keyCode >= 65 && keyCode <= 90)
            || (keyCode >= 97 && keyCode <= 122))
            && keyCode != 8 && keyCode != 32) {
            return false;
        }
    });
    $(document).on('keypress',".twodecimel",function (e) {
          if ((event.which != 46 || $(this).val().indexOf('.') != -1) &&
            ((event.which < 48 || event.which > 57) &&
              (event.which != 0 && event.which != 8))) {
            event.preventDefault();
          }

          var text = $(this).val();

          if ((text.indexOf('.') != -1) &&
            (text.substring(text.indexOf('.')).length > 2) &&
            (event.which != 0 && event.which != 8) &&
            ($(this)[0].selectionStart >= text.length - 2)) {
            event.preventDefault();
          }
    });
}); 
$(document).on("keypress", ".emailspecialvalidation", function (e) {
    var keyCode = e.which;
    if (keyCode == 46 || keyCode == 64 || keyCode == 95 || keyCode == 45) {
        return true;
    } else if (!((keyCode >= 48 && keyCode <= 57)
        || (keyCode >= 65 && keyCode <= 90)
        || (keyCode >= 97 && keyCode <= 122))
        && keyCode != 8 && keyCode != 32) {
        return false;
    }
});

$(document).on("keypress", ".specialvalidationdot", function (e) {
    var keyCode = e.which;
    if (((keyCode < 48 || keyCode > 57)) && keyCode != 46) {
        event.preventDefault();
    }
});

$(document).on("keypress keyup blur", ".numeric", function (e) {
    $(this).val($(this).val().replace(/[^\d].+/, ""));
    if ((event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }
});

$(document).on('focusin','input', function(){
    $(this).removeClass('is-invalid');
});

$(document).on('focusin','textarea', function(){
    $(this).removeClass('is-invalid');
});

$(document).on('select2:open','select', function() {
     $(this).siblings(".select2-container").find("span .select2-selection").css('border-color','#ccc');
});

$(document).on('focusin','select', function() {
    $(this).removeClass('is-invalid');
});

//Capitlaize first letter
$(document).on("change", ".capital", function (e) {
    var value = $(this).val();
    if(value!=""){
        const finalSentence = value.replace(/(^\w{1})|(\s+\w{1})/g, letter => letter.toUpperCase());
        $(this).val(finalSentence);
    }
});
// Uppercase All letters
$(document).on("change", ".uppercase", function (e) {
    var value = $(this).val();
    if(value!=""){
        $(this).val(value.toUpperCase());
    }
});

$(function () {
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
});

function checkValidation(el) {
    console.log('in');
    var check = true;
    var fields = $(el).find('.validate-input');
    for (var i = 0; i < fields.length; i++) {
        var field = $(fields[i]);
        var field_parent = field.closest('div');
        var value = field.val();
        var type = field.attr('type');

        if (field.is(':visible')) {
            if (type == "text" || type == "email" || type == "number" || type == "textarea" || type == 'password' 
                || type == 'date' || type == 'file' || field.hasClass("select")) {
                if (value == '') {
                    field.addClass('is-invalid');
                    check = false;
                } else {
                    field.removeClass('is-invalid');
                    if (type == 'email' && null == value.trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/)) {
                        field.addClass('is-invalid');
                        swal(
                          'Alert..!',
                          'Please Enter Valid Email Address',
                          'error'
                        )
                        // new PNotify({ title: 'Alert..!', text: 'Please Enter Valid Email Address!', type: 'error' });  
                        check = false;
                    }
                    if (field.hasClass("phone_no")) {
                        length = value.length;
                        if(length == 11) {
                            field.removeClass('is-invalid');
                        } else {
                            check = false;
                            field.addClass('is-invalid');
                        }
                    }

                }
            } else if(field.hasClass("select2")) {
                if (value == '') {
                    // field.siblings(".select2-container").find("span .select2-selection").css('border-color','red');
                    field.siblings(".select2-container").find("span .select2-selection").addClass('is-invalid');
                    check = false;
                } else {
                    // field.siblings(".select2-container").find("span .select2-selection").css('border-color','#ccc');
                    field.siblings(".select2-container").find("span .select2-selection").removeClass('is-invalid');
                }
            }

            if (i == 0) {
                // field.focus();
            }
        }
    }


    return check;
}