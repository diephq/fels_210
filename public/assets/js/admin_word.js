$(document).ready(function () {
    var maxFields = 6; //maximum input answers
    var wrapper = $(".input_fields_wrap"); //Fields wrapper
    var addButton = $(".add_field_button"); //Add button ID
    var numAnswer = $(".answers").length;

    $(addButton).click(function (e) {
        e.preventDefault();
        if (numAnswer++ < maxFields) { //max input box allowed
            var html = '<div class="form-group">';
            html += '<label for="answer" class="col-md-4 control-label">Answer</label>';
            html += '<div class="col-md-6">';
            html += '<input class="form-control" name="answer[]" type="text">';
            html += '</div>';
            html += '<input type="radio" name="true_answer" value="' + numAnswer + '">';
            html += '</div>';

            $(wrapper).append(html);
        } else {
            $(".add_field_button").remove();
        }
    });
});
