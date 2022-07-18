$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});



$('#sub-button').on('click', () => {
    $('#write-form').submit();
});



$(document).ready(function () {
    $('#summernote').summernote({
        placeholder: '내용을 입력해주세요',
        height: 600,
        lang: 'ko-KR',
        callbacks: {
            onImageUpload: function (files) {
                sendFile(files[0], this)
            }
        },
        toolbar: [
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['style', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
            ['color', ['forecolor', 'color']],
            ['table', ['table']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['insert', ['picture']],
            ['view', ['fullscreen', 'help']]
        ],
        fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', '맑은 고딕', '궁서', '굴림체', '굴림', '돋움체', '바탕체'],
        fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '22', '24', '28', '30', '36', '50', '72']
    });
});



function sendFile(file, editor) {
    data = new FormData()
    data.append("img", file)

    $.ajax({
        data: data,
        type: "POST",
        url: "/board/upload/img",
        cache: false,
        contentType: false,
       // enctype: "multipart/form-data", //multer-s3를 활용하므로 multipart/form-data형태
        processData: false,
        success: function (res) {
          console.log(res);
           var imgurl = $('<img>').attr({
                'src': res, // res의 값은 write/img 의 imgurl.
                'crossorigin': 'anonymous',
                // crossorigin attr을 삽입하지 않으면 CORS에러가 난다! (?)
            });
         $("#summernote").summernote("insertNode", imgurl[0]);
            // insertNode는 html tag를 summernote 내부에 삽입해주는 기능.
        }
    })
}
