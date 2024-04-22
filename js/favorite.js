$(document).ready(function(){

        $("#heart").on('click',function(event){
        // Stop form action from happening
        event.preventDefault();
        // Get values from form via ID
        $(this).find('.fa-heart').css('color', 'red');
        var bookId = $("#book_id_favorite").val();
        var userId = $("#user_id_favorite").val();
        $.ajax({
            url: "includes/favoriteFunction.php",
            type: "POST",
            data: {
                bookId : bookId,
                userId : userId
            },
            success: function(response){
                console.log(response);
            }
        })
        });

        
});