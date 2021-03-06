var FormValidator = function () {
    "use strict";


    // function to initiate Validation Sample 1
    var runValidator1 = function () {
        var form1 = $('#frmUpcomingProduct');
        var errorHandler1 = $('.errorHandler', form1);
        var successHandler1 = $('.successHandler', form1);

        $('#frmUpcomingProduct').validate({
            errorElement: "span", // contain the error msg in a span tag
            errorClass: 'help-block',
            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
                    error.insertAfter($(element).closest('.form-group').children('div').children().last());
                } else if (element.attr("name") == "dd" || element.attr("name") == "mm" || element.attr("name") == "yyyy") {
                    error.insertAfter($(element).closest('.form-group').children('div'));
                } else {
                    error.insertAfter(element);
                    // for other inputs, just perform default behavior
                }
            },
            ignore: "",
            rules: {
                pc_title1: {
                    required: true
                },
                p_title: {
                    required: true
                }
            },
            messages: {
                pc_title1: "Please select product category",
                p_title: "Please specify title for product "
            },
            invalidHandler: function (event, validator) { //display error alert on form submit
                successHandler1.hide();
                errorHandler1.show();
            },
            highlight: function (element) {
                $(element).closest('.help-block').removeClass('valid');
                // display OK icon
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
                // add the Bootstrap error class to the control group
            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element).closest('.form-group').removeClass('has-error');
                // set error class to the control group
            },
            success: function (label, element) {
                label.addClass('help-block valid');
                // mark the current input as valid and display OK icon
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
            },
            submitHandler: function (form) {
                successHandler1.show();
                errorHandler1.hide();
                // submit form
                //$('#form').submit();
                // alert($('.fileinput-filename').text());
                saveForm();

            }
        });
    };


    var saveForm = function(){



        var p_pc_id = encodeURIComponent($("#pc_id1").val());
        var psubc_id = encodeURIComponent($("#psubc_id1").val());

        var p_title = encodeURIComponent($("#p_title").val());
        var p_alias = encodeURIComponent($("#p_alias").val());

        var p_imageName = encodeURIComponent($("#p_imageName").val());

        var p_upcoming ="Y";


        var p_introEditor = encodeURIComponent($("#p_intro").val());
       // p_introEditor = encodeURIComponent( he.encode(p_introEditor.value()));

        var p_descEditor = encodeURIComponent($("#p_desc").val());
       // p_descEditor = encodeURIComponent( he.encode(p_descEditor.value()));




        //var dataString = 'p_pc_id='+p_pc_id +'&psubc_id='+psubc_id  +'&p_title='+ p_title +'&p_alias='+ p_alias
        //    +'&p_imageName='+ p_imageName +'&p_catalogName='+ p_catalogName
        //    +'&p_intro='+ p_introEditor +'&p_desc='+ p_descEditor +  "&p_upcoming="
        //    + p_upcoming + "&p_pitch=" + p_pitch + "&p_current=" + p_current + "&p_voltage=" + p_voltage + "&ai_id=" + ai_id;

        $.ajax({

            type:'POST',

            data: {
                p_pc_id: p_pc_id,
                psubc_id: psubc_id,
                p_title: p_title,
                p_alias: p_alias,
                p_imageName: p_imageName,
                p_intro: p_introEditor,
                p_desc: p_descEditor,
                p_upcoming: p_upcoming
            },

            url:'../../api/product/save.php',

            success:function(data) {
                if(data == 'Duplicate Entry!')

                {
                    swal("Duplicate Entry", "This entry already exist:)", "error");
                }
                else {
                    swal({
                        title: "Upcoming Product",
                        text: "Saved Successfully!",
                        type: "success",
                        confirmButtonColor: "#007AFF"
                    });
                }


                //reset form
                $("#frmUpcomingProduct").trigger('reset');
                // Set the editor data.
                $( 'textarea.ckeditor' ).val( '' );
                $('#p_image').fileinput('reset');

            }

        });

    };

    return {
        //main function to initiate template pages
        init: function () {
            runValidator1();

        }
    };
}();