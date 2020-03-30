<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .content{
            border: outset 6px purple;
            max-height: 300vh;
            overflow: auto;
        }
    </style>
    <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
</head>
<br>
<br/>
<body>
    Email
    <input type='text' class='email' onchange="$(this).attr('readonly', true); ">
    RSS
    <input type='text' class='rss'>
    <br>
    <br/>
    <br/>
    
    <div  class='content'>

    </div>
    Links:
    <div  class='links'>

    </div>
    <br/>
    <button type="button" onclick='save()'>save</button>
    <button type="button" onclick='send()'>send</button>
</body>

<script>
    $( document ).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        getLinks();
    });
    function save(){
        $.ajax({
            method: "POST",
            url: "/saveLink",
            data: { 'link': $(".rss").val()}
        })
        .done(function( message ) {
            alert( "RSS Saved");
            getLinks();
        });
    }
    function send(){
        $.ajax({
            method: "POST",
            url: "/sendData",
            data: { 'email': $(".email").val()}
        })
        .done(function( message ) {
            $('.content').empty();
            $('.content').append(message);
        });
    }
    function getLinks(){
        $.ajax({
            method: "GET",
            url: "/loadLinks",
        })
        .done(function( message ) {
            var links = '';
            message = JSON.parse(message);
            message.forEach(rozloz);
            function rozloz(item){
                links += '<p>' + item.link + '</p> <button onclick="deleteLink('+ item.id +')">Delete</button>';
                links += '</br>';
            }
            $('.links').empty();
            $('.links').append(links);
        });
    }
    function deleteLink(id){
        $.ajax({
            method: "POST",
            url: "/deleteLink",
            data: { 'id': id}
        })
        .done(function( message ) {
            alert('RSS Deleted');
            getLinks();
        });
    }
</script>