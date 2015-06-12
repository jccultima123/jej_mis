$(document).ready(function () {
    $.validator.setDefaults({
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: "email.php",
                data: {'val': $(".myfirstform").serializeJSON()}
            }).done(function (data) {
                alert(data);
            });
        }
    });
    $(".form_w_validation").validate(
            {rules:
                        {name: "required",
                            email: {required: true, email: true},
                            website: {required: false, url: true},
                            cate: "required",
                            msg: {required: true, maxlength: 300
                            }},
                errorClass: "error",
                highlight: function (label) {
                    $(label).closest('.form-group').removeClass('has-success').addClass('has-error');
                },
                success: function (label) {
                    label
                            .text('Seems Perfect!').addClass('valid')
                            .closest('.form-group').addClass('has-success');
                }
            });
});

function checkForm(form)
  {
    if(form.username.value === "") {
      alert("Error: Username cannot be blank!");
      form.username.focus();
      return false;
    }
    re = /^\w+$/;
    if(!re.test(form.username.value)) {
      alert("Error: Username must contain only letters, numbers and underscores!");
      form.username.focus();
      return false;
    }

    if(form.reset_input_password.value !== "" && form.reset_input_password.value === form.reset_input_password_repeat.value) {
      if(form.reset_input_password.value.length < 6) {
        alert("Error: Password must contain at least six characters!");
        form.reset_input_password.focus();
        return false;
      }
      if(form.reset_input_password.value === form.username.value) {
        alert("Error: Password must be different from Username!");
        form.reset_input_password.focus();
        return false;
      }
      re = /[0-9]/;
      if(!re.test(form.reset_input_password.value)) {
        alert("Error: password must contain at least one number (0-9)!");
        form.reset_input_password.focus();
        return false;
      }
      re = /[a-z]/;
      if(!re.test(form.reset_input_password.value)) {
        alert("Error: password must contain at least one lowercase letter (a-z)!");
        form.reset_input_password.focus();
        return false;
      }
      re = /[A-Z]/;
      if(!re.test(form.reset_input_password.value)) {
        alert("Error: password must contain at least one uppercase letter (A-Z)!");
        form.reset_input_password.focus();
        return false;
      }
    } else {
      alert("Error: Please check that you've entered and confirmed your password!");
      form.reset_input_password.focus();
      return false;
    }
    return true;
  }