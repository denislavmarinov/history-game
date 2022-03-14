@extends('layouts.app')

@section('content')
<div class="container">
    <audio src="{{ asset('storage/game_start.mp3') }}" autoplay></audio>
    <div>
        <p style="fotn-size: 1.2rem;">За да прпуснете натиснете <span style="font-size: 87.5%;color: #212529;margin-top: 0;margin-bottom: 1rem;font-family: SFMono-Regular, Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace; border: #f00 solid 1px; border-radius: 50% 25%;">Space</span></p>
    </div>
    <div class="row" style="margin-top: 25%">
        <div class="col-4">
            <img src="{{ asset('images/avatar.jpg') }}" alt="Avatar" width="300px">
        </div>
        <div class="col-8" id="text">

        </div>
    </div>
</div>
<script>
    let text = "Здравейте! Добре дошли в нашата игра, която се нарича „Из дебрите на историята“. Идеята на тази игра е да научите много интересни и по-слабо известни факти от нашата българска история, с която всички ние трябва да се гордеем. В момента вие ще бъдете един от войниците, от генералите, на цар Иван Асен II, който прогонен несправедливо от своя чичо Борил се завръща и иска да седне на бащиния си престол - престолът на Иван Асен I. Надявам се, че ще помогнете на младият български принц да си възвърне престолът на баща си, като ще участвате в 24 битки, в които щще има въпроси от различно ниво на трудност. Пожелаваме ви причтна игра, но преди да започнете вашата игра, иска ми се да ви кажа, че тя е плод на съвместните усилия на един екип съствен от мен - Данаил Димитров, учител по история и цивилизации, от Цветелина Стоянова - учител по информатика и от Денислав Маринов, ученик в профил „Електрнна търговия“. А сега Ви пожелавам приятно забавление и приятна игра. Успех!",
        parsedText = text.split(" "),
        num = 0;

    for (number in parsedText)
    {
        let str = "<span id='text" + number + "' style='possiotion: fixed;'>" + parsedText[number] + " </span>";
        
        $("#text").append(str);
    }
    
    $("#text").children().hide();
    setInterval(() => {
        if (typeof parsedText[num] !== 'undefined')
        {
            $("#text"+num).animate({
                display: 'inline-block',
                fontSize: '0.9rem',
                opacity: '0.2'
            }, 80);
            $("#text"+num).animate({
                fontSize: '1.0rem',
                opacity: '0.4'
            }, 80);
            $("#text"+num).animate({
                fontSize: '1.1rem',
                opacity: '0.6'
            }, 80);
            $("#text"+num).animate({
                fontSize: '1.0rem',
                opacity: '0.8'
            }, 80);
            $("#text"+num).animate({
                opacity: '1.0',
                fontSize: '0.9rem'
            }, 80);
            $("#text"+num).show();
            num++;
        }
        else
        {
            window.location.href = "{{ route('game.start') }}";
        }
    }, 403);

    $(document).on("keypress", function(e){
        if (e.key == " ")
        {
            window.location.href = "{{ route('game.start') }}";
        }
    })
    
</script>
@endsection
