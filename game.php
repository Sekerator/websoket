<div id="container" style="position: relative">
    <form id="form" method="post" action="server.php">
        <input id="login" type="hidden" name="login" value="ss">
        <input id="top" type="hidden" name="top">
        <input id="left" type="hidden" name="left">
    </form>

    <div id="myPlayer" style="background-color: black; height: 30px; width: 30px; position: absolute"></div>
</div>
<script>
    let login = document.cookie.split('=')[1];

    var topMargin = 0;
    var leftMargin = 0;

    document.addEventListener('keydown', function(event) {
        if (event.code == 'ArrowDown') {
            topMargin += 5;
            document.getElementById('myPlayer').style.marginTop = topMargin;
            sendAjax();
        }
        if (event.code == 'ArrowUp') {
            topMargin -= 5;
            document.getElementById('myPlayer').style.marginTop = topMargin;
            sendAjax();
        }
        if (event.code == 'ArrowLeft') {
            leftMargin -= 5;
            document.getElementById('myPlayer').style.marginLeft = leftMargin;
            sendAjax();
        }
        if (event.code == 'ArrowRight') {
            leftMargin += 5;
            document.getElementById('myPlayer').style.marginLeft = leftMargin;
            sendAjax();
        }
    });

    function sendAjax()
    {
        let data = {
            'login': login,
            'top': topMargin,
            'left': leftMargin
        };

        fetch('http://test/server.php?data='+JSON.stringify(data), {method: "GET",});
    }

    ws = new WebSocket("ws://127.0.0.1:8000?user="+login);
    ws.onmessage = function(evt) {
        let data = JSON.parse(JSON.parse(evt.data).data);

        if(data.login != login && !document.getElementById(data.login))
        {
            console.log("sSS");
            let anyFigure = document.createElement('div');
            anyFigure.id = data.login;
            anyFigure.style.position = 'absolute';
            anyFigure.style.backgroundColor = 'red';
            anyFigure.style.height = 30;
            anyFigure.style.width = 30;
            anyFigure.style.marginTop = data.top;
            anyFigure.style.marginLeft = data.left;
            document.body.insertBefore(anyFigure,  document.getElementById('container'));
        }
        else if(data.login != login)
        {
            document.getElementById(data.login).style.marginTop = data.top;
            document.getElementById(data.login).style.marginLeft = data.left;
        }
    };
    ws.onclose = function(evt) {
        alert("DISCONNECT");
    };
    ws.onerror = function(evt) {
        alert("ERROR");
        console.log(evt)
    };


</script>