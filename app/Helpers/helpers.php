<?php
function bcrypt($value, $options = [])
{
    return app('hash')->make($value, $options);
}

function matchPassword($dbPassword,$userPassword){
    return app('hash')->check($userPassword,$dbPassword);
}