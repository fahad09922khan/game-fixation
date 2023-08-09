<?php

function emptyMsg()
{
    echo "<script>setTimeout(function() {
        var notyf = new Notyf({
            duration: 4000,
            position: {
                x: 'center',
                y: 'top',
            },
        });
        notyf.error('Please enter your input details');
    }, 1000)</script>";
}

function successMsg($text)
{
    echo "<script>setTimeout(function() {
        var notyf = new Notyf({
            duration: 4000,
            ripple: false,
            position: {
                x: 'right',
                y: 'top',
            },
        });
        notyf.success('$text');
    }, 1000)</script>";
}

function invalidMsg($text)
{
    echo "<script>setTimeout(function() {
        var notyf = new Notyf({
            duration: 4000,
            position: {
                x: 'center',
                y: 'top',
            },
        });
        notyf.error('{$text}');
    }, 1000)</script>";
}
function nopreloader()
{
    echo "<style>.preloader{display:none;}</style>";
}
