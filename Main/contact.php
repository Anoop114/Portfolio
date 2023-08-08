<!-- Header -->
<header class="header-area">
    <div class="container">
        <div class="gx-row d-flex align-items-center justify-content-between">
            <a href="https://anoop114.github.io/Portfolio/" class="logo">
                <img src="./Asset/images/logo.jpeg" alt="Logo">
            </a>

            <nav class="navbar">
                <ul class="menu">
                    <li><a href="https://anoop114.github.io/Portfolio/">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="?p=work">Works</a></li>
                    <li class="active"><a href="?p=cont">Contact</a></li>
                </ul>
                <a href="?p=cont" class="theme-btn">Let's talk</a>
            </nav>

            <a href="?p=cont" class="theme-btn">Let's talk</a>

            <div class="show-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
</header>

<!-- Contact -->
<section class="contact-area">
    <div class="container">
        <div class="gx-row d-flex justify-content-between gap-24">
            <div class="contact-infos">
                <h3 data-aos="fade-up">Contact Info</h3>
                <ul class="contact-details">
                    <li class="d-flex align-items-center" data-aos="zoom-in">
                        <div class="icon-box shadow-box">
                            <i class="iconoir-mail"></i>
                        </div>
                        <div class="right">
                            <span>MAIL me</span>
                            <h4>anoopkrsh22@gmail.com</h4>
                            <!-- <h4>info@bluebase2.com</h4> -->
                        </div>
                    </li>

                    <!-- <li class="d-flex align-items-center" data-aos="zoom-in">
                        <div class="icon-box shadow-box">
                            <i class="iconoir-phone"></i>
                        </div>
                        <div class="right">
                            <span>Contact Us</span>
                            <h4>+1 504-899-8221</h4>
                            <h4>+1 504-749-5456</h4>
                        </div>
                    </li> -->

                    <li class="d-flex align-items-center" data-aos="zoom-in">
                        <div class="icon-box shadow-box">
                            <i class="iconoir-pin-alt"></i>
                        </div>
                        <div class="right">
                            <span>Location</span>
                            <h4>Delhi <br>India</h4>
                        </div>
                    </li>
                </ul>

                <h3 data-aos="fade-up">Social Info</h3>
                <ul class="social-links d-flex align-center" data-aos="zoom-in">
                    <li>
                        <a class="shadow-box" href="https://github.com/Anoop114"><i class="iconoir-github"></i></a></li>
                    <li><a class="shadow-box" href="https://www.linkedin.com/in/anoop-kumar-sharma-716906226/"><i
                                class="iconoir-linkedin"></i></a></li>
                </ul>
            </div>

            <div data-aos="zoom-in" class="contact-form">
                <div class="shadow-box">
                    <img src="./Asset/images/bg1.png" alt="BG" class="bg-img">
                    <img src="./Asset/images/icon3.png" alt="Icon">
                    <h1>Let’s work <span>together.</span></h1>
                    <form name="Contact" action="">
                        <div class="alert alert-primary messenger-box-contact__msg" id="wait" style="display: none"
                            role="alert">
                            Wait a while you message is on the way 😊.
                        </div>
                        <div class="alert alert-success messenger-box-contact__msg" id="success" style="display: none"
                            role="alert">
                            Your message was sent successfully.
                        </div>
                        <div class="alert alert-danger messenger-box-contact__msg" id="fail" style="display: none"
                            role="alert">
                            Your message was sent Failed, Please Send again.
                        </div>
                        <div class="input-group">
                            <input type="text" name="full-name" id="full_name" placeholder="Name *" required>
                        </div>
                        <div class="input-group">
                            <input type="email" name="email" id="email" placeholder="email *" required>
                        </div>
                        <div class="input-group">
                            <input type="text" name="subject" id="subject" placeholder="Your Subject *" required>
                        </div>
                        <div class="input-group">
                            <textarea name="message" id="message" placeholder="Your Message *" required></textarea>
                        </div>
                        <div class="input-group">
                            <button class="theme-btn submit-btn" id="submit_btn" name="submit" type="submit">Send
                                Message</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    $(function () {
        $('form').on('submit', function (e) {
            e.preventDefault();
            4
            $('#wait').show();
            $("#submit_btn").prop('disabled', true);
            var name = $("#full_name").val();
            var eml = $("#email").val();
            var sub = $("#subject").val();
            var msg = $("#message").val();
            $.ajax({
                type: 'POST',
                url: './Main/mailSend.php',
                data: {
                    'submit': true,
                    'name': name,
                    'email': eml,
                    'subject': sub,
                    'message': msg,
                },
                success: function (data) {
                    $('#wait').hide();
                    if (data != "") {
                        $('#success').show();
                        $("#full_name").val("");
                        $("#email").val("");
                        $("#subject").val("");
                        $("#message").val("");
                    } else {
                        $('#fail').show();
                    }
                    $("#submit_btn").prop('disabled', false);
                }
            });
        });
    })
    // $(document).ready(function () {
    //     $('.msgSend').click(function (e) {
    //         e.preventDefault();
    //         var form = $("#formId");
    //         var url = form.attr('action');
    //         $.ajax({
    //             type: "POST",
    //             url: "./Main/mailSend.php",
    //             data: {
    //                 'checkView_btn': true,
    //                 'f_id': floder_id,
    //             },
    //             success: function (respond) {
    //                 if(respond == "pass"){
    //                     $('#success').show();
    //                 }else{

    //                 }
    //             }
    //         });
    //     });
    // });
</script>