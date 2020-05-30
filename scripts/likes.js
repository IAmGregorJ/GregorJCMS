function likeButton(id) {
    $.ajax({
        url: "../../likes/" + id, 
        type: "post", 
        data: {
            id: id},
        success: function(likes) {
            $(`#post${id} .likes`).text(`${likes} ${likes == 1 ? `like ` : `likes `}`);
            $('#thumb').attr('src', '/images/liked.png');
            $('#thumb').attr('title', 'Thanks for liking!');
    }}); 
}