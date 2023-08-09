<?php
include_once 'partial/_header.php';

?>

<title>Game Fixation</title>

<body>
    <?php include_once 'partial/_menu.php'; ?>

    <main class="contactmain" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1>How can Game Fixation assistants help you?</h1>
                    <p>We'd love talk about how we can help you.</p>
                </div>
                <div class="col-md-5">
                    <figure>
                        <img src="assets/images/contact.png" class="img-fluid" alt="">
                    </figure>
                </div>
            </div>
        </div>
    </main>

    <section class="py-5">
        <div class="container">
            <div class="col-lg-9 col-md-10 mx-auto">
                <div class="contactform account__form">
                    <div>
                        <h1 class="account__title" data-aos="fade-up">Tell us about <strong>yourself</strong></h1>
                        <p class="account__text" data-aos="fade-up">whether you have questions or you would just like to
                            say hello, contact
                            us.</p>
                        <form class="account__fields" method="POST" id="signup" data-aos="fade-up">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-wrapper">
                                        <label class="account__label" for="usernameInput">Username</label>
                                        <input class="__input" type="text" id="usernameInput" name="usernameInput"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-wrapper">
                                        <label class="account__label" for="emailInput">Email Address</label>
                                        <input class="__input" type="email" id="emailInput" name="emailInput" required>
                                    </div>
                                </div>
                            </div>

                            <div class="input-wrapper">
                                <label class="account__label" for="subInput">Subject</label>
                                <input class="__input" type="text" id="subInput" name="subInput" required>
                            </div>
                            <div class="input-wrapper">
                                <label class="account__label" for="messageInput">Message</label>
                                <textarea class="__input" id="messageInput" name="messageInput" rows="5"
                                    required></textarea>
                            </div>
                            <button class="account__button" type="submit">Send</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <?php include_once 'partial/_footer.php'; ?>

    <script>
    const validator = new window.JustValidate('#signup', {
        validateBeforeSubmitting: true,
    });

    validator.addField('#usernameInput', [{
            rule: 'required',
            errorMessage: 'Name is required',
        },
        {
            rule: 'minLength',
            value: 3,
            errorMessage: 'Minimum 3 Chars.',
        }
    ]).addField('#emailInput', [{
            rule: 'required',
            errorMessage: 'Email is required',
        },
        {
            rule: 'email',
            errorMessage: 'Invalid Email',
        },
    ]).addField('#subInput', [{
            rule: 'required',
            errorMessage: 'Message Title is required',
        },
        {
            rule: 'minLength',
            value: 6,
            errorMessage: 'Minimum 6 Chars.',
        },
    ]).addField('#messageInput', [{
            rule: 'required',
            errorMessage: 'Message is required',
        },
        {
            rule: 'minLength',
            value: 12,
            errorMessage: 'Minimum 12 Chars.',
        },
    ]).onSuccess((event) => {
        event.currentTarget.submit();
    })
    </script>


    <?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_REQUEST);
    $sql = "insert into tbl_contact values(null,'$usernameInput','$emailInput','$subInput','$messageInput',0)";
    $res = mysqli_query($con, $sql);
    if ($res) {

        echo "<script>window.location.href='thanks.php';</script>";
    }
}
?>