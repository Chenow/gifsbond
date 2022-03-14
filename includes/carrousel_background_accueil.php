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
                <img src="images/cohez1.png" alt="">
            </div>
            <div class="slide">
                <img src="images/cohez2.png" alt="">
            </div>
            <div class="slide">
                <img src="images/cohez3.png" alt="">
            </div>
            <div class="slide">
                <img src="images/cohez4 .png" alt="">
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
        <section class="banderole_accueil">

            <div id="transition_accueil_landing1">
            </div>

            <div id="transition_accueil_landing2">
            </div>

            <div id="transition_accueil_landing3">
            </div>
        </section>
    </div>

    <!-- image slider end -->

    <style>
        .slider {
            width: 100vw;
            height: 100vh;
            overflow: hidden;
        }

        .slides {
            width: 500%;
            height: 100vh;
            display: flex;
        }

        .slides input {
            display: none;
        }

        .slide {
            width: 20%;
            height: 100vh;
            transition: all 2s;
        }

        .slide img {
            min-width: 100%;
            min-height: 100%;
        }

        .slide::after {
            content: " ";
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            background-color: rgba(9, 25, 37, 0.25);
        }

        /* css for manual slide navigation */

        .navigation-manual {
            position: absolute;
            width: 800px;
            margin-top: -40px;
            display: flex;
            justify-content: center;
            z-index: -1;
        }

        .manual-btn {
            border: 2px solid #40d3dc;
            padding: 5px;
            border-radius: 10px;
            cursor: pointer;
            transition: 1s;
        }

        .manual-btn:not(:last-child) {
            margin-right: 40px;
        }

        .manual-btn:hover {
            background: #40d3dc;
        }

        #radio1:checked~.first {
            margin-left: 0;
        }

        #radio2:checked~.first {
            margin-left: -20%;
        }

        #radio3:checked~.first {
            margin-left: -40%;
        }

        #radio4:checked~.first {
            margin-left: -60%;
        }

        /* css for automatic navigation */

        .navigation-auto {
            position: absolute;
            display: flex;
            width: 800px;
            justify-content: center;
            margin-top: 460px;
        }

        .navigation-auto div {
            border: 2px solid #40d3dc;
            padding: 5px;
            transition: 1s;
            z-index: -1;
            position: relative;
        }

        .navigation-auto div:not(:last-child) {
            margin-right: 40px;
        }

        #radio1:checked~.navigation-auto .auto-btn1 {
            background: #40d3dc;
        }

        #radio2:checked~.navigation-auto .auto-btn2 {
            background: #40d3dc;
        }

        #radio3:checked~.navigation-auto .auto-btn3 {
            background: #40d3dc;
        }

        #radio4:checked~.navigation-auto .auto-btn4 {
            background: #40d3dc;
        }


        /* trois traits*/
        .banderole_accueil {
            height: 20vh;
            width: 100%;
            position: absolute;
        }

        #transition_accueil_landing1 {
            position: absolute;
            width: 150%;
            height: 10vh;
            background-color: rgb(104, 175, 241);
            opacity: 0.5;
            bottom: 19vh;
            transform: rotate(-2.5deg);
            z-index: 1;
            overflow: hidden;
        }

        #transition_accueil_landing2 {
            position: absolute;
            width: 150%;
            height: 10vh;
            background-color: rgb(38, 88, 134);
            opacity: 0.7;
            bottom: 16.2vh;
            transform: rotate(-2.2deg);
            z-index: 1;
        }

        #transition_accueil_landing3 {
            position: absolute;
            width: 150%;
            height: 8vh;
            background-color: rgb(24, 50, 75);
            opacity: 0.9;
            bottom: 15vh;
            transform: rotate(-1deg);
            z-index: 1;
        }
    </style>

    <script type="text/javascript">
        var counter = 1;
        var first_time_slider = 0;

        (function foo() {
            document.getElementById("radio" + counter).checked = true;
            counter++;
            if (counter > 4) {
                counter = 1;
            }
            if (first_time_slider === 0) {
                setTimeout(foo, 3000);
                first_time_slider++;
            } else {
                setTimeout(foo, 5000);
            }
        })();
    </script>