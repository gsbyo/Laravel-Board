# Laravel ( PHP ) / Mysql 로 만든 게시판 입니다.

구조
<br>
<br>Http-Controllers
 - BoardController
 - CustomAuthController
 
<br>Models
 - Commnent
 - Post 
 - User

<br>Middleware
 - AuthCheck
 - AlreadyLoggediIn
 
<br>public
 - img (게시판의 이미지 저장)
 - js 
 - css
 
<br>views
 - *.blade.php ( 웹페이지)
 
------------------------------------------------------------------------------------------------------------------
<br>회원가입
 - 회원가입은 간단하게 아이디와 비밀번호를 입력하게 되면 가입을 할 수 있게 설정되어 있으며, Hash을 사용하여 비밀번호가 저장 될 때 Bcrypt 방식으로 암호화 됨.<br>
 
 ![register](https://user-images.githubusercontent.com/82531576/179512720-80fcbe20-89e8-4cd3-b912-976b8e35cc8f.PNG)

<br>로그인(user)
 - 로그인은 Session을 사용하여 구현하였으며 DB에서 유저의 아이디와 비밀번호가 일치 할 경우 loginId와 loginUserName을 저장하여 해당 세션이 있을 경우 로그인 상태로 봄.<br>
 - 로그인 상태에서 로그인 페이지에 접근을 하지 못하게 하거나 로그인 상태를 체크 하기 위해서 미들웨어 AuthCheck(isLoggedIn)과 AlreadyLoggedIn을 구현함.
 - 네이버 로그인의 경우 로그인 성공 시에 받아온 유저 정보을 가지고 일반 로그인와 마찬가지로 로그인 세션을 생성함.
 
 ![login](https://user-images.githubusercontent.com/82531576/179512880-9fc1e43f-e4fb-400e-a44f-8ff3c36c6046.PNG)
 
 ![naverlogin](https://user-images.githubusercontent.com/82531576/179513172-5917bfff-36da-4e27-a894-de35547c34fb.PNG)

<br>게시판
 - 페이징은 전체 게시글의 갯수와 limit와 skip을 활용하여 구현함.
 
 ![board](https://user-images.githubusercontent.com/82531576/179512916-0c1f44eb-1776-4edb-9f87-94d206a0170b.PNG)

 ![boardpage](https://user-images.githubusercontent.com/82531576/179512962-5e035909-c0fc-4d2d-8aa3-a2317d263985.PNG)

<br>게시글(post)
 - 게시글의 조회수를 확인하기 위해서 Session(postId)에 배열의 형태로 게시글의 번호를 저장하여 클릭한 게시글의 번호가 postId에 없을 경우 post 테이블의 view를 +1을 함.
 - 게시글 작성은 summereditor를 사용하였으며, 이미지가 업로드가 되었을때 해당 이미지를 저장하고 저장한 경로와 이미지 이름을 return 함.
 
 ![showpost](https://user-images.githubusercontent.com/82531576/179513243-3d4cd181-41ec-4ee6-a78d-1535c43e2db2.PNG)
 
 ![upload](https://user-images.githubusercontent.com/82531576/179513276-fac058bc-e2e7-4d5f-b09a-a7c485f51e44.PNG)

<br>댓글(comment)
 - 게시판의 페이징과 달리 페이지 번호를 클릭 시에 ajax를 사용하여 댓글을 불러오고 있음.
 
 ![comments](https://user-images.githubusercontent.com/82531576/179513424-6e3d172d-71cc-42f5-87ac-c58800ce06f5.PNG)
 
 ![returncomment](https://user-images.githubusercontent.com/82531576/179513520-a331599d-aab9-4c42-994c-7a963b960f69.PNG)

<br>검색
 - 게시판과 같이 limit와 skip을 활용하여 페이징 함.
 - 제목 / 내용 / 제목+내용에 따라서 검색 결과를 확인 할 수 있음.

![search](https://user-images.githubusercontent.com/82531576/179513772-6e119004-44ca-48fb-a0d3-77e75ff30bc8.PNG)

------------------------------------------------------------------------------------------------------------------------
<br>개선사항
 - 검색 시 쿼리가 2번 사용되기 때문에 처리속도 높일 필요가 있어보임.
 - laravel 보안강화 필요함.
