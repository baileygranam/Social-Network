$(document).ready(function() 
{
    $('body').fadeIn(700);

    $("form").after("<div class='spinner'><div class='bounce1'></div><div class='bounce2'></div><div class='bounce3'></div></div>");
    
    $('.spinner').hide();

    $('a').click(function(e) 
    {
        e.preventDefault();
        newLocation = this.href;

        $('body').fadeOut(500, newpage);
    });

    function newpage() 
    {
        window.location = newLocation;
    }

});

function login()
{
    $('form').submit(function(e) 
    { 
        e.preventDefault();
        var form = this;
        $('form').hide(500);
        $('.spinner').show(600);

        $.ajax({
            type: "POST",
            url: "login/authenticate",
            data: {
                email:    $('#email').val(),
                password: $('#password').val(),
                remember: $('#remember').val()
            },
            success: function (response) {
                if(response)
                {
                    setTimeout(function () 
                    {
                       $('body').fadeOut(500);

                        setTimeout(function () 
                        {
                            window.location.href = "/home/";
                        }, 500);

                    }, 2000);
                }
                else
                {
                    setTimeout(function () 
                    {
                        $( "#alert p" ).text("Email or password incorrect!");
                        $('#alert').show();
                        $('form').show(500);
                        $('.spinner').hide(500);
                    }, 2000);
                }
            }
        });
    });
}
