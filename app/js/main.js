$(document).ready(function() 
{
	/* Fade in the body. */
	$('body').fadeIn(800);

	/* Function to animate body fadeout when link is clicked. */
	$('a').click(function(e) 
    {
        e.preventDefault();
        newLocation = this.href;
        $('body').fadeOut(500, newpage);
    });

	/* Function to load to new page. */
    function newpage() 
    {
        window.location = newLocation;
    }

    /* Dynamic Forms */
    $('#form').submit(function(e) 
    {  
        var form = this;
        e.preventDefault();

        setTimeout(function () {
            form.submit();
        }, 3000);

        $('form').addClass('zoomOut');
        $('form').hide(500);
        $("form").after("<div class='spinner animate fadeIn'><div class='bounce1'></div><div class='bounce2'></div><div class='bounce3'></div></div>");

        setTimeout(function () 
        {
            $('body').fadeOut(500);
        }, 2500);
    })

    $(".btn-post").append("<div class='lds-dual-ring'></div>");
    $('.lds-dual-ring').hide();

    $('#form-post').submit(function(e) 
    {  
        var form = this;
        e.preventDefault();

        $('.btn-post span').fadeOut(350);

        setTimeout(function () 
        {
            $('.lds-dual-ring').fadeIn(350);
        }, 350);

        var caption = $('#caption').val();

        var file_data = $('#file-input').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('caption', caption);
        $.ajax({
            type: 'POST',
            url: '/posts/create', 
            dataType: 'text', 
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            success: function (response) {
                if(response == 1)
                {
                    swal("Success!", "Your post has been created.", "success");
                    setTimeout( 
                      function() {
                        window.location.reload(true);
                      }, 2000);
                    $('textarea').val('');
                }
                else
                {
                    swal("Whoops!", "Something went wrong... Try again.", "error");
                }

                setTimeout(function () 
                {
                    $('.lds-dual-ring').fadeOut(400);
                    setTimeout(function () 
                    {
                        $('.btn-post span').fadeIn(350);
                    }, 500);
                }, 800);
            }
        });

    })






    $('.dropdown-menu').addClass('invisible'); 
    $('#post').addClass('bounceInDown'); 

  	$('.dropdown').on('show.bs.dropdown', function(e){
    	$('.dropdown-menu').removeClass('invisible');
    	$(this).find('.dropdown-menu').first().stop(true, true).slideDown();
  	});

  	$('.dropdown').on('hide.bs.dropdown', function(e){
    	$(this).find('.dropdown-menu').first().stop(true, true).slideUp();
  	});
});