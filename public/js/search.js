$('.post-box').on('click', function(){
    let post_number = $(this).children('.post-id').text();
    window.location.href = '/board/post/'+ post_number;
});


$('#search-button').on('click', () => {
    window.location.href = '/board/search/post?&page=1&smt=' + $('#search-option option:selected').val() +'&stx='+ $('#search-input').val();
})

$.urlParam = function(name){
    var results = new RegExp('[\?&amp;]' + name + '=([^&amp;#]*)').exec(window.location.href);

    if(results == null) return "";

    return results[1] || 0;
 }

var viewCount = 5;
var pageCount = 5;

var curPage = $.urlParam('page');
var searchText = $.urlParam('stx');
var method = $.urlParam('smt');

var limitPage = Math.ceil(totalCount / viewCount) ;
var startPage = Math.ceil(curPage / pageCount) ;

if(totalCount > 0) {

    if(curPage <= pageCount){
       $('#paging-box').append(`<a href="/board/search/post?page=1&smt=${ method }&stx=${ searchText }">&#10094;</a>`);
    }else{
       $('#paging-box').append(`<a href="/board/search/post?page=${(1 + (((Math.floor( curPage / pageCount ) - 1) * pageCount)) )}&smt=${ method }&stx=${ searchText }">&#10094;</a>`);
    }

    for(var i = ((startPage - 1) * pageCount) + 1; i <= ( startPage * pageCount )&& i <= limitPage; ++i){
          if(curPage == i){
            $('#paging-box').append(`<a style="background-color:silver" href="/board/search/post?page=${i}&smt=${ method }&stx=${ searchText }">${i}</a>`);
          }else{
            $('#paging-box').append(`<a href="/board/search/post?page=${i}&smt=${ method }&stx=${ searchText }">${i}</a>`);
          }
    }

    if(curPage == limitPage){
        $('#paging-box').append(`<a href="/board/search/post?page=${( limitPage )}&smt=${ method }&stx=${ searchText }">&#10095;</a>`);
    }else{
       $('#paging-box').append(`<a href="/board/search/post?page=${( (1 + (Math.ceil( curPage / pageCount ) * pageCount ) ) )}&smt=${ method }&stx=${ searchText }">&#10095;</a>`);
    }



}else{
    //검색결과가 없다는걸 띄워주면됨.
}


