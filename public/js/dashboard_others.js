function Poster_function_others(event) {
    event.preventDefault();
    var x = document.getElementById("poster_url_others").value;
    if (document.getElementById('poster_url_others').value !== "") {
        document.getElementById('poster_frame_others').src = x;
        //////////////////////////////////////////////////////////////////////////
        document.getElementById('poster_frame_others').style.visibility = 'visible';
        document.getElementById('poster_frame_others').style.display = 'inline';
        //////////////////////////////////////////////////////////////////////////
        document.getElementById('poster_url_value_others').value = x;
    }
}


function check_soft_type(event) {
    var e = document.getElementById("type_others");
    var strtype = e.options[e.selectedIndex].value;
    if (strtype == 'softwares') {
        document.getElementById('software_type').style.display = 'block';
        document.getElementById('intro').style.display = 'block';
    } else {
        document.getElementById('software_type').style.display = 'none';
        document.getElementById('intro').style.display = 'none';
    }
}


$(document).ready(function() {
    var max_fields = 10; //maximum input boxes allowed
    var wrapper = $(".input_fields_wrap_others"); //Fields wrapper
    var add_button = $("#add_more_links_others"); //Add button ID
    var x = 1; //initlal text box count
    $(add_button).click(function(e) { //on add input button click
        e.preventDefault();
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input type="text" name="download_links_others[]" placeholder="Enter download link" required autofocus/><button class="remove_field btn btn-danger mb-2 float-right">Delete <i class="fa fa-close"></i></button></div>'); //add input box
        }
    });
    $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
});