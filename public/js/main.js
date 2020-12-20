var url = 'http://localhost/Instagram-laravel/public/';


window.addEventListener("load", function(){

    $('.btn-like').css('cursor','pointer');
    $('.btn-dislike').css('cursor','pointer');

    //Boton de like
    function like(){
        $('.btn-like') .unbind('click').click(function(){

            console.log('like');


            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src',url+'img/red-heart.png');

            // ahora hago la peticion ajax para guardar en la base de datos
            $.ajax({
				url: url+'like/'+$(this).data('id'),
				type: 'GET',
				success: function(response){
					if(response.like){
						console.log('Has dado like a la publicacion');
					}else{
						console.log('Error al dar like');
					}
				}
			});


            dislike();
        });
    }
    like();

    // boton de dislike
    function dislike(){
            $('.btn-dislike').unbind('click') .click(function(){
            
            console.log('dislike');


            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src',url+'img/black-heart.png');

            // ahora uso el ajax para dislike
            $.ajax({
				url: url+'dislike/'+$(this).data('id'),
				type: 'GET',
				success: function(response){
					if(response.like){
						console.log('Has dado dislike a la publicacion');
					}else{
						console.log('Error al dar dislike');
					}
				}
            });
            
            like();
        });
    }
    dislike();

    // buscador
// BUSCADOR
	$('#buscador').submit(function(e){
		$(this).attr('action',url+'user/people/'+$('#buscador #search').val());
	});
});