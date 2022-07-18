$('.post-box').on('click', function(){
    let post_number = $(this).children('.post-id').text();
    window.location.href = '/board/post/'+ post_number;
});


$('#search-button').on('click', () => {
    window.location.href = '/board/search/post?&page=1&smt=' + $('#search-option option:selected').val() +'&stx='+ $('#search-input').val();
})

var viewCount = 5;
var pageCount = 5;

var url = window.location.pathname;

var curPage = url.substring(url.lastIndexOf('/') + 1);

if(curPage == 'board') curPage = 1;

console.log(curPage);

var limitPage = Math.ceil(totalCount / viewCount) ;
var startPage = Math.ceil(curPage / pageCount) ;

if(curPage <= 5){
    $('#paging-box').append(`<a href="/board">&#10094;</a>`);
}else{
    $('#paging-box').append(`<a class="paging-a" href="/board/${  (1 + (((Math.floor( curPage / pageCount ) - 1) * pageCount)) )}">&#10094;</a>`);
}

for(var i = ((startPage - 1) * pageCount) + 1; i <= ( startPage * pageCount )&& i <= limitPage; ++i){
    if(curPage == i){
        $('#paging-box').append(`<a style="background-color:silver;" href="/board/${i}">${i}</a>`);
    }else{
        $('#paging-box').append(`<a href="/board/${i}">${i}</a>`);
    }
}

if(curPage == limitPage){
 $('#paging-box').append(`<a href="/board/${limitPage}">&#10095;</a>`);
}else{
 $('#paging-box').append(`<a href="/board/${ (1 + (Math.ceil( curPage / pageCount ) * pageCount ) ) }">&#10095;</a>`);
}

