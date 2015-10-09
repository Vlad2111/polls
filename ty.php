<html>
    <head>
        <title>hi</title>
        <meta charset="UTF-8">
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script src="js/jquery-2.1.3.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
        <script src="js/jquery.countdown.js"></script>

    </head>
    <body>
        <script>
//            $(function(){
//                $(".demo").countdown({
//                    image: "img/digits.png",
//                    startTime: "10:10",
//                    format: "dd:hh:mm:ss",
//                });
//            });
            $(function(){
                $(".demo").countdown({
                    stepTime: 60,
                    // startTime and format MUST follow the same format.
                    // also you cannot specify a format unordered (e.g. hh:ss:mm is wrong)
                    image: "img/digits.png",
                    format: "hh:mm:ss",
                    startTime: "00:01:00",
                    //  endTime: new Date('12/25/13 00:00:00')
                    digitImages: 6,
                    digitWidth: 67,
                    digitHeight: 90,
                    timerEnd: function(){ alert("end");},
                    continuous: false
                });
            });
        </script>  
        <div class="demo"></div>

        

    </body>
</html>
