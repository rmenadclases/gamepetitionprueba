var langs = ['en', 'es'];
var langCode = '';
var langJS = null;
$.ajaxSetup({ cache: false });

$("#selLanguage").change(function() {
    langCode = $("#selLanguage").val()
    changLanguage()
});

$(".selLanguage").click(function() {
    langCode = $(this).attr('lang')
    var txtLang = ''
    switch (langCode) {
        case 'es':
            txtLang = 'Español'
            break;
        case 'en':
            txtLang = 'English'
        default:
            break;
    }
    $("#txtLangHead").attr('tkey', langCode);
    $("#txtLangHead").text(txtLang);
    $("#imgLangHead").attr('src', 'images/lang/' + langCode + '.png');
    changLanguage();
});

var translate = function(jsdata) {
    /* console.log(jsdata) */
    $("[tkey]").each(function(index) {
        var strTr = jsdata[$(this).attr('tkey')];
        $(this).html(strTr);
    });
}

/* langCode = navigator.language.substr(0, 2); */
if (langCode == '') {
    langCode = 'es'
    $.getJSON('language/' + langCode + '.json', translate);
}

function changLanguage() {
    /* console.log(langCode + ' SI') */
    $.getJSON('language/' + langCode + '.json', translate);

    switch (langCode) {
        case 'es':
            txtLang = 'Español'
            break;
        case 'en':
            txtLang = 'English'
        default:
            break;
    }

    localStorage.setItem("lang", langCode);
    localStorage.setItem("txtLang", txtLang);
}

function getLanguage() {
    var lang = localStorage.getItem("lang");

    if (!lang) {
        localStorage.setItem("lang", "es");
        localStorage.setItem("txtLang", "Español");
    }

    return [localStorage.getItem("lang"), localStorage.getItem("txtLang")];
}

function setLanguage() {
    var selLanguage = getLanguage();
    
    $.getJSON('language/' + selLanguage[0] + '.json', translate);

    $("#txtLangHead").attr('tkey', selLanguage[0]);
    $("#txtLangHead").text(selLanguage[1]);
    $("#imgLangHead").attr('src', 'images/lang/' + selLanguage[0] + '.png');
}

setLanguage();