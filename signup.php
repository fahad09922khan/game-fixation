<?php include_once 'partial/_header.php'; ?>

<title>Game Fixation - Sign Up</title>

<body class="account">
    <header class="account__header">
        <a href="index.php">
            <h5>Game Fixation</h5>
        </a>
        <p>Have an account? <a href="login.php">Sign in</a></p>
    </header>
    <main class="account__main">
        <div class="account__image">
            <img src="assets/images/accountimg2.jpg" alt="Gaming Image">
        </div>
        <div class="account__form">
            <div data-aos="fade-up">
                <h1 class="account__title" data-aos="fade-up">Sign up</h1>
                <p class="account__text" data-aos="fade-up">Registeration to access your account.</p>
                <form class="account__fields" method="POST" id="signup">

                    <div class="input-wrapper">
                        <label class="account__label" for="usernameInput">Username</label>
                        <input class="__input" type="text" id="usernameInput" name="usernameInput" required>
                    </div>
                    <div class="input-wrapper">
                        <label class="account__label" for="emailInput">Email Address</label>
                        <input class="__input" type="email" id="emailInput" name="emailInput" required>
                    </div>
                    <div class="input-wrapper">
                        <label class="account__label" for="passwrdInput">Password</label>
                        <input class="__input" type="password" id="passwrdInput" name="passwrdInput" required>
                    </div>
                    <button class="account__button" type="submit">Register</button>
                </form>
            </div>
        </div>
    </main>
    <footer class="account__footer">
        <p>Copyright &copy; 2023. All rights reserved.</p>
    </footer>

    <?php include_once 'partial/_footer.php'; ?>
    <script>
    const validator = new window.JustValidate('#signup', {
        validateBeforeSubmitting: true,
    });

    validator.addField('#usernameInput', [{
            rule: 'required',
            errorMessage: 'Username is required',
        },
        {
            rule: 'minLength',
            value: 3,
        },
        {
            rule: 'maxLength',
            value: 15,
        },
    ]).addField('#emailInput', [{
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
            errorMessage: 'Strong Passwor 8+ chars, 1 uppercase, 1 lowercase, 1 number, 1 special (!, @, &, $, %, *, ?)',
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
    $sql = "insert into tbl_account (email, paswwrd, username, role, status) values('$emailInput','$PASS','$usernameInput',0,0)";
    $res = mysqli_query($con, $sql);
    if ($res) {
        $insertedId = mysqli_insert_id($con);
        $sql1 = "select * from tbl_account where id=$insertedId";
        $res1 = mysqli_query($con, $sql1);
        if (mysqli_num_rows($res1) > 0) {
            $row = mysqli_fetch_assoc($res1);
            $_SESSION['logined'] = true;
            $_SESSION['userid'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            if (isset($_GET['return'])) {
                echo "<script>window.location.href='" . $_GET['return'] . "'</script>";
            } else {
                echo "<script>window.location.href='index.php'</script>";
            }
            // echo "<script>window.location.href='index.php'</script>";
        }
    } else {
        session_destroy();
    }
}
?>