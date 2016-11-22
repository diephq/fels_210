$(document).ready(function() {
    var max_fields      = 7; //maximum input answers
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

    var x = 3; //initlal text box count
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) { //max input box allowed
            var html = '<div class="form-group">';
            html += '<label for="answer" class="col-md-4 control-label">Answer</label>';
            html += '<div class="col-md-6">';
            html += '<input class="form-control" name="answer[]" type="text">';
            html += '</div>';
            html += '<input type="radio" name="true_answer" value="' + x + '">';
            html += '</div>';

            x++; //text box increment
            $(wrapper).append(html);
        } else {
            $(".add_field_button").remove();
        }
    });
});
