<?php

include_once 'partial/_header.php';


if (isset($_SESSION['logined'])) {
    if ($_SESSION['role'] == 1) {
        echo "<script>window.location.href='admin/index.php'</script>";
    } else {
        echo "<script>window.location.href='index.php'</script>";
    }
}

?>

<title>Game Fixation - Login</title>

<body class="account">
    <header class="account__header">
        <a href="index.php">
            <h5>Game Fixation</h5>
        </a>
        <p>Don't have an account? <a href="signup.php">Sign up</a></p>
    </header>
    <main class="account__main">
        <div class="account__image">
            <img src="assets/images/accountimg1.png" alt="Gaming Image">
        </div>
        <div class="account__form">
            <div data-aos="fade-up">
                <h1 class="account__title" data-aos="fade-up">Sign In</h1>
                <p class="account__text" data-aos="fade-up">Login to access your account.</p>
                <form class="account__fields" id="signin" method="POST" data-aos="fade-up">
                    <div class="input-wrapper">
                        <label class="account__label" for="userName">Email Address</label>
                        <input class="__input" type="email" id="userName" name="userName" required>
                    </div>
                    <div class="input-wrapper">
                        <label class="account__label" for="passwrdInput">Password</label>
                        <input class="__input" type="password" id="passwrdInput" name="passwrdInput" required>
                    </div>

                    <button class="account__button" type="submit">Login</button>
                </form>
            </div>
        </div>
    </main>
    <footer class="account__footer">
        <p>Copyright &copy; 2023. All rights reserved.</p>
    </footer>

    <?php include_once 'partial/_footer.php'; ?>

    <script>
    const validator = new window.JustValidate('#signin', {
        validateBeforeSubmitting: true,
    });

    validator.addField('#userName', [{
            rule: 'required',
            errorMessage: 'Email is required',
        },
        {
            rule: 'email',
        },
    ]).addField('#passwrdInput', [{
            rule: 'required',
            errorMessage: 'Password is required',
        },
        {
            rule: 'strongPassword',
            errorMessage: 'Strong Password 8+ chars, 1 uppercase, 1 lowercase, 1 number, 1 special (!, @, &, $, %, *, ?)',
        }
    ]).onSuccess((event) => {
        event.currentTarget.submit();
    })
    </script>


    <?php

include_once 'php_request/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_REQUEST);
    $PASS = MD5($passwrdInput);
    $sql = "select * from tbl_account where email='$userName' and paswwrd='$PASS'";
    $res = mysqli_query($con, $sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $_SESSION['logined'] = true;
        $_SESSION['userid'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];
        if ($_SESSION['role'] == 1) {
            echo "<script>window.location.href='admin/index.php'</script>";
        } else {
            if (isset($_GET['return'])) {
                echo "<script>window.location.href='" . $_GET['return'] . "'</script>";
            } else {
                echo "<script>window.location.href='index.php'</script>";
            }
        }
    } else {
        session_destroy();
        echo "<script>alert('Incorrect Credentials Try Again!');</script>";
    }
}

?>