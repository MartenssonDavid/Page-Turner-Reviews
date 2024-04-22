$(document).ready(function(){

    // If there is input from search bar
    function searchBooks(input){
        $.ajax({
            url:"includes/searchFunction.php",
            method:"POST",
            data:{input: input},
            // On success call function and place data in div with id
            success: function(data){
                $("#searchResult").html(data);
            }
        })
    }
    // If there is no input, data is null, get all books
    function getBooks(){
        $.ajax({
            url:"includes/searchFunction.php",
            method:"POST",
            data:{},
            success: function(data){
                $("#searchResult").html(data);
            }
        })
    }
    // Check if input field has changed
    $("#searchInput").keyup(function(){
        // When a value is set in search field, set as input
        var input = $(this).val();
        // If there is input, get books via searchBooks
        if(input!= ""){
            searchBooks(input);
        }else{
        // If there is no input, get all books
            getBooks();
        }

    });

    // On start of page, get all books
    getBooks();


});