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
    errorMessage: 'This field is required so don\'t leave me empty.',
    defaultStatus: 'invalid'
}, {
    selector: '.email',
    validate: ['presence', 'email'],
    errorMessage: ['Email was empty', 'Duh? That is not an valid email format.'],
    defaultStatus: 'invalid'
}, {
    selector: '.admin-name',
    validate: ['presence', 'between-length:5:30', 'username'],
    errorMessage: ['Username was empty.', 'Username should be at least 6-15 characters long!', 'OOPS! Invalid Username!'],
    defaultStatus: 'invalid'
}, {
    selector: '.admin-password',
    validate: ['presence', 'between-length:5:30'],
    errorMessage: ['Password was empty.', 'Password should be at least 6-15 characters long!'],
    defaultStatus: 'invalid'
}, {
    selector: '.username',
    validate: ['presence', 'between-length:8:30', 'username'],
    errorMessage: ['Username was empty.', 'Username should be at least 8-15 characters long!', 'OOPS! Invalid Username!'],
    defaultStatus: 'invalid'
}, {
    selector: '.password',
    validate: ['presence', 'between-length:8:20'],
    errorMessage: ['Password was empty.', 'Password should be at least 8-20 characters long!'],
    defaultStatus: 'invalid'
}, {
    selector: '.password-repeat',
    validate: 'same-as:.password',
    errorMessage: 'Password does not match!',
    defaultStatus: 'invalid'
}]);