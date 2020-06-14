$(function() {
    $("form[name='myForm']").validate({
        rules: {
            title: {
                required: true,
                maxlength: 30,
                minlength: 5,

            },
            about: {
                required: true,
                maxlength: 100,
                minlength: 10,

            },
            content:{
                required: true,
            },
            photo:{
                required: true,
            },
            category:{
                required: true,
            }
        },
        messages: {
            title: {
                required: "Naslov ne smije biti prazan.",
                minlength: "Naslov mora biti najmanje 5 znakova",
                maxlength: "Naslov mora biti najvise 12 znakova",
            },
            about: {
                required: "Opis ne smije biti prazan",
                minlength: "Opis nesmije biti kraći od 10 znakova",
                maxlength: "Opis nesmije biti duži od 100 znakova",
            },
            content: {
                required: "Tekst nesmije biti prazan"
            },
            photo: {
                required: "Morate odabrati sliku",
            },
            category: {
                required: "Kategorija mora biti odabrana"
            }
        },

        submitHandler: function(form) {
            form.submit();
        }
    });

    $("form[name='registracija']").validate({
        rules:{
            ime:{
                required: true
            },
            prezime:{
              required: true
            },
            username:{
                required: true
            },
            password:{
                required: true
            }
        },
        messages:{
            ime:{
                required: "Ime ne smije biti prazno. Unesite ime."
            },
            prezime:{
                required: "Prezime ne smije biti prazno. Unesite prezime."
            },
            username: {
                required: "Username ne smije biti prazan. Unesite username."
            },
            password: {
                required: "Password ne smije biti prazan. Unesite password."
            }
        },

        submitHandler: function (form) {
            form.submit();
        }
        });
});