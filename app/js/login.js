$(document).ready(function() 
{
    $('body').fadeIn(800);

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

    $('form').submit(function(e) 
    { 
        var form = this;
        e.preventDefault();

        setTimeout(function () {
            form.submit();
        }, 3000);

        $('form').addClass('zoomOut');
        $('form').hide(500);
        $('.spinner').show(600);

        setTimeout(function () 
        {
            $('body').fadeOut(500);
        }, 2500);
    })

    $('.dropdown-menu').addClass('invisible'); //FIRST TIME INVISIBLE

// ADD SLIDEDOWN ANIMATION TO DROPDOWN-MENU 
  $('.dropdown').on('show.bs.dropdown', function(e){
    $('.dropdown-menu').removeClass('invisible');
    $(this).find('.dropdown-menu').first().stop(true, true).slideDown();
  });

  // ADD SLIDEUP ANIMATION TO DROPDOWN-MENU 
  $('.dropdown').on('hide.bs.dropdown', function(e){
    $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
  });

});



   