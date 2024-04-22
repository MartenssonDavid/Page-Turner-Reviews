$(document).ready(function(){
    var rating = -1;
    // Make stars grey
    resetColor();   

    // Remember index
    $('.fa-star').on('click',function(){
        rating = parseInt($(this).data('index'))
        $('#ratingInput').val(rating + 1);
    });
    // Change color on mouseover
    $('.fa-star').mouseover(function(){
        resetColor();  
        // Find index to know where mouse is
        var currentIndex =parseInt($(this).data('index'));
        for(var i=0; i <=currentIndex; i++)
            $('.fa-star:eq('+i+')').css('color','yellow')
    });
    // Change color when mouse leaves
    $('.fa-star').mouseleave(function(){
        resetColor();  
        for(var i=0; i <=rating; i++)
         $('.fa-star:eq('+i+')').css('color','yellow')
    });

    $("#submitReview").on('click',function(event){
        console.log("clicked");
        event.preventDefault();
        console.log("prevented");

        var userId = $('#user_id').val();
        var bookId = $('#book_id').val();
        var rating = $('#ratingInput').val();
        var review = $('#ReviewInput').val();
        $.ajax({
            url: "includes/reviewFunction.php",
            type: "POST",
            data: {
                userId : userId,
                bookId : bookId,
                rating : rating,
                review : review
            },
            success: function(response){
                    console.log(response);
            }
        })

    });

    // Make stars grey
    function resetColor(){
        $('.fa-star').css('color','grey');
    }


});