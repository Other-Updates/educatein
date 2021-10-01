// Sign-in Close function
//Set button id on click to hide first modal
$("#signin").on( "click", function() {
    $('#exampleModal1').modal('hide');  
});
//trigger next modal
$("#signin").on( "click", function() {
    $('#exampleModal2').modal('show');  
});

// Sign-Out Close function
//set button id on click to hide first modal
$("#signout").on( "click", function() {
    $('#exampleModal2').modal('hide');  
});
//trigger next modal
$("#signout").on( "click", function() {
    $('#exampleModal1').modal('show');  
});

$(document).ready(function(){
//    $('.sticky-sidebar').stickit();
});

//$(document).ready(function() {
//    $('.timer').startTimer();
//});

// Profile-pic Upload
$(document).ready(function() {
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".file-upload").on('change', function(){
        readURL(this);
    });
    
    $(".upload-button").on('click', function() {
       $(".file-upload").click();
    });
});

// Offcanvas Menu
$(document).ready(function() {
    // executes when HTML-Document is loaded and DOM is ready
//    console.log("document is ready");
        $('[data-toggle="offcanvas"], #navToggle').on('click', function () {
        $('.offcanvas-collapse').toggleClass('open')
    })
});

// Dropdown Animation
$(document).ready(function() {
    $('.dropdown').on('show.bs.dropdown', function(e){
      $(this).find('.dropdown-menu').first().stop(true, true).slideDown(300);
    });

    $('.dropdown').on('hide.bs.dropdown', function(e){
      $(this).find('.dropdown-menu').first().stop(true, true).slideUp(200);
    });
});



// Only images file input
//$(document).ready(function() {
//    var input = document.getElementById( 'file-upload' );
//    var infoArea = document.getElementById( 'file-upload-filename' );
//
//    input.addEventListener( 'change', showFileName );
//
//    function showFileName( event ) {
//      
//      // the change event gives us the input it occurred in 
//      var input = event.srcElement;
//      
//      // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
//      var fileName = input.files[0].name;
//      
//      // use fileName however fits your app best, i.e. add it into a div
//      infoArea.textContent = 'File name: ' + fileName;
//    }
//});

// Custom Input File name
$('.custom-file input').change(function (e) {
    var files = [];
    for (var i = 0; i < $(this)[0].files.length; i++) {
        files.push($(this)[0].files[i].name);
    }
    $(this).next('.custom-file-label').html(files.join(', '));
});


// Add More Fields - Dynamic(Gallery Images)
$(document).ready(function() {
    var max_fields      = 50; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            // $(wrapper).append('<div><div class="input-group mb-2"><div class="custom-file"><input type="file" class="custom-file-input" id="" aria-describedby="" accept="image/x-png,image/gif,image/jpeg" name="mytext[]"><label class="custom-file-label" for="">Choose file</label></div><div class="input-group-append remove_field"><button class="btn btn-danger" style="color:#fff!important;" type="button" id="">Remove</button></div></div></div>');

            $(wrapper).append('<div><div class="form-row mb-2"><div class="col-lg-4 col-sm-6"><div class="input-group mb-3"><input type="file" accept="image/x-png,image/gif,image/jpeg" name="mytext[]"/></div></div><div class="col-lg-4 col-sm-6 remove_field"><a href="#" class="btn btn-danger" style="color:#fff!important;">Remove</a></div></div></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});

// Add More Fields - Dynamic(Activity Group)
// $(document).ready(function() {
//     var max_fields      = 8; //maximum input boxes allowed
//     var wrapper         = $(".input_fields_wrap1"); //Fields wrapper
//     var add_button      = $(".add_field_button1"); //Add button ID
    
//     var x = 1; //initlal text box count
//     $(add_button).click(function(e){ //on add input button click
//         e.preventDefault();
//         if(x < max_fields){ //max input box allowed
//             x++; //text box increment
//             $(wrapper).append('<div><div class="form-row"><div class="col-lg-3 col-sm-6"><div class="form-group"><label for="">Activity Name</label><input type="text" class="form-control" id="" placeholder="Sports"></div></div><div class="col-lg-7 col-sm-6"><label for="">Activity Name</label><div class="input-group mb-3"><div class="custom-file"><input type="file" class="custom-file-input" id="" aria-describedby=""><label class="custom-file-label" for="">Choose file</label></div></div></div><div class="col-lg-2 col-sm-6"><a href="#" class="remove_field" style="color:red!important;">Remove</a></div></div></div>'); //add input box
//         }
//     });
    
//     $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
//         e.preventDefault(); $(this).parent('div').remove(); x--;
//     })
// });