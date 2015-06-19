$("select.selectpicker").focus(function(){
  $(this).next(".bootstrap-select").find('.selectpicker').focus();
});

//CALLING FROM NOD.JS
var Validator = nod();

//SETTINGS
Validator.configure({
    //delay: 1,
    jQuery: $,
    submit: '.submit',
    disableSubmit: true
});

//SET FUNCTIONS
function mustBeEven(callback, value) {
    var result = +value % 2 === 0;

    callback(result);
}


//START OF VALIDATOR
Validator.add([{
    selector: '.required',
    validate: 'presence',
    errorMessage: 'Don\'t leave me empty please.',
    defaultStatus: 'invalid'
}, {
    selector: '.email',
    validate: 'email',
    errorMessage: 'Duh? That is not an valid email format.',
    defaultStatus: 'invalid'
}, {
    selector: '.admin-name',
    validate: 'between-length:5:30',
    errorMessage: 'Username should be at least 6-15 characters long!',
    defaultStatus: 'invalid'
}, {
    selector: '.admin-password',
    validate: 'between-length:5:30',
    errorMessage: 'Password should be at least 6-15 characters long!',
    defaultStatus: 'invalid'
}, {
    selector: '.username',
    validate: 'between-length:8:30',
    errorMessage: 'Username should be at least 8-15 characters long!',
    defaultStatus: 'invalid'
}, {
    selector: '.password',
    validate: 'between-length:8:20',
    errorMessage: 'Password should be at least 8-20 characters long!',
    defaultStatus: 'invalid'
}, {
    selector: '.password-repeat',
    validate: 'same-as:.password',
    errorMessage: 'Password does not match!',
    defaultStatus: 'invalid'
}]);