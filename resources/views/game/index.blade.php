@extends('layouts.app')

@section('content') 
<style>
    tr {
        margin: 2%;
        padding: 2%;
    }
    #question_box{
        font-size: medium;
    }
    .log{
        overflow: scroll;
        height: 350px;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-8">
            <img src="{{ asset('images/map.jpg') }}" alt="Game map" usemap="#map">

        </div>
        <div class="col-3 offset-1">
            <div class="row">
                <div class="col-4 offset-4">
                    Time: <span id="time" class="font-weight-bold text-danger">00:00</span>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    Points: <span id="points" class="font-weight-bold text-success">0</span>
                </div>
                <div class="col-8">
                    Remaining lives: <span id="lives" class="font-weight-bold text-success">3</span>
                </div>
            </div>
            
            <br>
            <p class="text-center">Game log:</p>
            <hr>
            <div class="log"></div>
        </div>
    </div>

    <map name="map">
        <area shape="circle" coords="225, 391, 12" alt="question_1" id="question_1" class="question">
        <area shape="circle" coords="194, 369, 12" alt="question_2" id="question_2" class="question">
        <area shape="circle" coords="189, 318, 5" alt="question_3" id="question_3" class="question">
        <area shape="circle" coords="162, 303, 12" alt="question_4" id="question_4" class="question">
        <area shape="circle" coords="157, 251, 6" alt="question_5" id="question_5" class="question">
        <area shape="circle" coords="186, 227, 12" alt="question_6" id="question_6" class="question">
        <area shape="circle" coords="257, 203, 7" alt="question_7" id="question_7" class="question">
        <area shape="circle" coords="266, 244, 12" alt="question_8" id="question_8" class="question">
        <area shape="circle" coords="218, 274, 12" alt="question_9" id="question_9" class="question">
        <area shape="circle" coords="219, 298, 6" alt="question_10" id="question_10" class="question">
        <area shape="circle" coords="275, 290, 12" alt="question_11" id="question_11" class="question">
        <area shape="circle" coords="348, 286, 12" alt="question_12" id="question_12" class="question">
        <area shape="circle" coords="395, 280, 6" alt="question_13" id="question_13" class="question">
        <area shape="circle" coords="474, 281, 12" alt="question_14" id="question_14" class="question">
        <area shape="circle" coords="518, 284, 6" alt="question_15" id="question_15" class="question">
        <area shape="circle" coords="554, 258, 12" alt="question_16" id="question_16" class="question">
        <area shape="circle" coords="576, 211, 6" alt="question_17" id="question_17" class="question">
        <area shape="circle" coords="560, 173, 12" alt="question_18" id="question_18" class="question">
        <area shape="circle" coords="525, 137, 12" alt="question_19" id="question_19" class="question">
        <area shape="circle" coords="467, 110, 6" alt="question_20" id="question_20" class="question">
        <area shape="circle" coords="431, 123, 12" alt="question_21" id="question_21" class="question">
        <area shape="circle" coords="396, 152, 6" alt="question_22" id="question_22" class="question">
        <area shape="circle" coords="389, 195, 12" alt="question_23" id="question_23" class="question">
        <area shape="circle" coords="391, 213, 6" alt="question_24" id="question_24" class="question">
    </map>
    
    <div id="question_box">
        <br><hr><br><br>
        <div class="row">
        
            <div class="col-6 offset-3">
                <h1 class="text-center" id="question"></h1>
                <table class="table">
                    <tr>
                        <td id="answer_1" class="answer"></td>
                        <td id="answer_2" class="answer"></td>
                    </tr>
                    <tr>
                        <td id="answer_3" class="answer"></td>
                        <td id="answer_4" class="answer"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $("#question_box").hide();

    sessionStorage.setItem('points', 0);
    sessionStorage.setItem('question_number', 1);

    addEvent("1");
    moveAvatar("#question_1");
    // DAta for db
    sessionStorage.setItem("started_at", (new Date()).toISOString());
    sessionStorage.setItem("minutes", "00")
    sessionStorage.setItem("seconds", "00")

    // Timer
    setInterval(() => {
        let seconds = parseInt(sessionStorage.getItem("seconds"))+1;
        seconds = seconds < 10 ? "0"+seconds : seconds;
        sessionStorage.setItem("seconds", seconds);
        if (sessionStorage.getItem("seconds") == 60)
        {
            sessionStorage.setItem("seconds", "00");
            let minutes = parseInt(sessionStorage.getItem("minutes"))+1;
            minutes = minutes < 10 ? "0"+minutes : minutes;
            sessionStorage.setItem("minutes", minutes);
        }
        $("#time").text(sessionStorage.getItem("minutes")+":"+sessionStorage.getItem("seconds"))
    }, 1000);

    function addEvent(question_number)
    {
        $("#question_"+question_number).one("click", eventFunction);
    }

    function eventFunction()
    {
        let id = $(this).attr("id").split("_")[1];
        sessionStorage.setItem("question_id", $(this).attr("id"));
        
        if (id/5 <= 1)
        {
            //  easy questions
            receiveAQuestion("1");
        }
        else if (id/5 <= 2 && id/5 > 1)
        {
            //  medium questions
            receiveAQuestion("2");
        }
        else if (id/5 <= 3 && id/5 > 2)
        {
            // hard questions
            receiveAQuestion("3");
        }
        else if (id/5 <= 4 && id/5 > 3)
        {
            // expert questions
            receiveAQuestion("4");
        }
        else if (id/5 <= 5 && id/5 > 4)
        {
            // Insane qiestions
            receiveAQuestion("5");
        }
        else
        {
            alert("Something went wrong")
        }
    }

    function receiveAQuestion(difficulty)
    {
        $.ajax({
            type: "get",
            url: "{{ route('game.get_a_question') }}",
            data: "difficulty="+difficulty,
            dataType: "json",
            success: function (response) {
                askQuestion(response);
            },
        });
    }

    function askQuestion(question)
    {
        $("#question_box").show("slow");
        sessionStorage.setItem("question", JSON.stringify(question));
        $("#question").text(question.question);
        $("#answer_1").text("A: " + question.answer_1);
        $("#answer_2").text("B: " + question.answer_2);
        $("#answer_3").text("C: " + question.answer_3);
        $("#answer_4").text("D: " + question.answer_4);
    }


    $(".answer").each(function(){
        $(this).on("click", function(){

            
            let answer = $(this).attr("id").split("_")[1];
            
            answer = answer == 1 ? "A" : answer == 2 ? "B" : answer == 3 ? "C" : "D";

            question = JSON.parse(sessionStorage.getItem("question"));

            
            if (answer == question.correct_answer)
            {
                sessionStorage.setItem("points", parseInt(question.points) + parseInt(sessionStorage.getItem("points")));
                $("#points").text(sessionStorage.getItem("points"));
                $(".log").prepend("<p class='text-success'>Correct answer - Question № "+sessionStorage.getItem("question_number")+" <span style='color: #ccc;'>"+new Date().getHours()+":"+new Date().getMinutes()+"</span></p>");

                sessionStorage.setItem("question_number", parseInt(sessionStorage.getItem("question_number")) + 1);
                
                let next_question = "#question_"+parseInt(sessionStorage.getItem("question_number"));
                if (sessionStorage.getItem("question_number") == 25)
                {
                    gameOver(sessionStorage.getItem("minutes")+":"+sessionStorage.getItem("seconds"), sessionStorage.getItem("points"), sessionStorage.getItem("started_at"), 1);
                }
                moveAvatar(next_question);
                addEvent(parseInt(sessionStorage.getItem("question_number")));

                

            }
            else
            {
                $(".log").prepend("<p class='text-danger'>Wrong answer - Question № "+sessionStorage.getItem("question_number")+" <span style='color: #ccc;'>"+new Date().getHours()+":"+new Date().getMinutes()+"</span></p>");
                $("#lives").text(parseInt($("#lives").text())-1);
                if ($("#lives").text() == "0")
                {
                    gameOver(sessionStorage.getItem("minutes")+":"+sessionStorage.getItem("seconds"), sessionStorage.getItem("points"), sessionStorage.getItem("started_at"), 0);
                }
                addEvent(parseInt(sessionStorage.getItem("question_number")));

            }

            $("#question_box").hide("slow");
            
        });
    });

    function moveAvatar(toQuestion)
    {
        // To be done in future
    }

    function gameOver(time, points, started_at, status)
    {
        finished_at = (new Date()).toISOString();
        $.ajax({
            type: "get",
            url: "{{ route('game.over_ajax') }}",
            data: "time=00:"+time+"&points="+points+"&started_at="+started_at+"&finished_at="+finished_at+"&status="+status,
            dataType: "json",
            success: function (response) {
                window.location.href = "{{ route('game.over') }}";
            },
        });
    }

   
</script>
@endsection
