$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$('#comment-button').on('click', () => {
        $.ajax({
            type:'POST',
            url: "/board/post/write/comment",
            data: {
                post_id: curPost,
                content: $('#comment-input').val()
            }
        }).done(function (res) {
            alert("댓글을 등록하였습니다.");

            console.log(res);

            location.reload();
        }).fail(function (error) {
            alert("댓글 등록을 실패하였습니다.");
        })

})

var url = window.location.pathname;

var viewCount = 5;
var pageCount = 5;
var curPost = url.substring(url.lastIndexOf('/') + 1);
var curPage = 1;
var postPage;

var limitPage = Math.ceil(totalComment / viewCount);
var startPage = Math.floor(curPage / pageCount);


if(totalComment > 0){
$('#paging-box').append(`<a id="prev">&#10094;</a>`);

for (let i = (startPage * pageCount) + 1; i <= ((startPage + 1) * pageCount) && i <= limitPage; ++i) {
    if(curPage == i){
        $('#paging-box').append(`<a class="page-a page-active">${i}</a>`);
    }else{
        $('#paging-box').append(`<a class="page-a">${i}</a>`);
    }
}

$('#paging-box').append(`<a id="next">&#10095;</a>`);
}


$('.page-a').on('click', function () {
    postPage = $(this).text();
    $('.page-active').removeClass();
    $(this).addClass('page-active');
    $.ajax({
        type: "GET",
        url: "/board/post/comment/get/"+ curPost +"/"+$(this).text(),
    }).done(function (res) {
        $('.comment').remove();
        for (var i = 0; i < res.length; ++i) {
            $('#comment-box').children('#h3-comment').append(`
                   <div class="comment">
                    <div class="comment-user">
                    <span>${res[i].user} ${res[i].created_at}</span>
                   </div>
                   <div class="comment-content">
                    <span>${res[i].content}</span>
                   </div>
                   </div>
                   `)
        }

    }).fail(function (error) {

    })
})


