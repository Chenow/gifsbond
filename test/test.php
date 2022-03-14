<!DOCTYPE php>
<html>

<head>
    <!-- jquery import -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <meta charset='utf-8' />
    <link rel="stylesheet" href="test.css">

</head>

<body>
    <!-- image slider start -->
    <div class="slider">
        <div class="slides">
            <!-- radio buttons start -->
            <input type="radio" name="radio-btn" id="radio1">
            <input type="radio" name="radio-btn" id="radio2">
            <input type="radio" name="radio-btn" id="radio3">
            <input type="radio" name="radio-btn" id="radio4">
            <!-- radio buttons end -->
            <!-- slides images start -->
            <div class="slide first">
                <img src="http://placehold.it/800x500" alt="">
            </div>
            <div class="slide">
                <img src="http://placehold.it/800x500" alt="">
            </div>
            <div class="slide">
                <img src="http://placehold.it/800x500" alt="">
            </div>
            <div class="slide">
                <img src="http://placehold.it/800x500" alt="">
            </div>
            <!-- slides images end -->
            <!-- automatic naviagtion start -->
            <div class="navigation-auto">
                <div class="auto-btn1"></div>
                <div class="auto-btn2"></div>
                <div class="auto-btn3"></div>
                <div class="auto-btn4"></div>

            </div>
            <!-- automatic navigation end -->
        </div>
        <!-- manual navigation start -->
        <div class="navigation-manual">
            <label for="radio1" class=manual-btn></label>
            <label for="radio2" class=manual-btn></label>
            <label for="radio3" class=manual-btn></label>
            <label for="radio4" class=manual-btn></label>
        </div>
        <!-- manual navigation end -->

    </div>

    <!-- image slider end -->


    <script type="text/javascript">
        var counter = 1;
        setInterval(function() {
            document.getElementById("radio" + counter).checked = true;
            counter++;
            if (counter > 4) {
                counter = 1;
            }
        }, 5000);
    </script>
</body>

</html>