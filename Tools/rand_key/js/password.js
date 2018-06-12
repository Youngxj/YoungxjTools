
$includeNumber = document.getElementById("include_number"),
$includeLowercaseletters = document.getElementById("include_lowercaseletters"),
$includeUppercaseletters = document.getElementById("include_uppercaseletters"),
$includePunctuation = document.getElementById("include_punctuation"),
$passwordUnique = document.getElementById("password_unique"),
$passwordLength = document.getElementById("password_length"),
$passwordQuantity = document.getElementById("password_quantity"),
$generate = document.getElementById("generate"),
$output = document.getElementById("output");

function rand(max) {
    return Math.floor(Math.random() * max);
};

$generate.onclick = function() {
    var chars = "";

    if ($includeNumber.checked) chars += "0123456789";
    if ($includeLowercaseletters.checked) chars += "abcdefghijklmnopqrstuvwxyz";
    if ($includeUppercaseletters.checked) chars += "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    if ($includePunctuation.checked) chars += "`~!@#$%^&*()-_=+[{]}\|;:'\",<.>/?";

    var passwords = [],
    passwordUnique = $passwordUnique.checked;
    for (var i = 0,
    l = $passwordQuantity.value; i < l; i++) {
        var _chars = chars.split(""),
        password = "";
        for (var j = 0,
        k = $passwordLength.value; j < k; j++) {
            if (_chars.length < 1) break;
            var index = rand(_chars.length);
            password += _chars[index];
            if (passwordUnique) _chars.splice(index, 1);
        };
        passwords.push(password);
    };
    $output.value = passwords.join("\n");
};

$output.onfocus = function() {
    this.select();
}