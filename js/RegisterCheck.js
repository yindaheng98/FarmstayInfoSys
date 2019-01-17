const username_group = document.getElementById("username-group");
const username_status = document.getElementById("username-status");
const password_group = document.getElementById("password-group");
const password_status = document.getElementById("password-status");
const confirm_group = document.getElementById("confirm-group");
const confirm_status = document.getElementById("confirm-status");


const submit_btn = document.getElementById("submit");
submit_btn.disabled = true;

function check_username(str)
{
    let xmlhttp;
    if (window.XMLHttpRequest)
    {
        xmlhttp = new XMLHttpRequest();
    }
    else
    {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function ()
    {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200)
        {
            if (!xmlhttp.responseText)
            {
                username_group.classList.remove("has-error");
                username_group.classList.add("has-success");
                username_status.classList.remove("glyphicon-remove");
                username_status.classList.add("glyphicon-ok");
                submit_btn.disabled = false;
            }
            else
            {
                username_group.classList.remove("has-success");
                username_group.classList.add("has-error");
                username_status.classList.remove("glyphicon-ok");
                username_status.classList.add("glyphicon-remove");
                submit_btn.disabled = true;
            }
        }
    };

    let username = document.getElementById("username").value;
    if (username.length <= 6 || !(/^[0-9a-zA-Z]+$/).test(username))
    {
        username_group.classList.remove("has-success");
        username_group.classList.add("has-error");
        username_status.classList.remove("glyphicon-ok");
        username_status.classList.add("glyphicon-remove");
        submit_btn.disabled = true;
    }
    else
    {
        xmlhttp.open("POST", "ajax/RegisterCheck.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("username=" + username + "&" + "type=" + str);
    }
}

function check_password()
{
    let password = document.getElementById("password").value;
    if (password.length <= 6 || !(/^[0-9a-zA-Z]+$/).test(password))
    {
        password_group.classList.remove("has-success");
        password_group.classList.add("has-error");
        password_status.classList.remove("glyphicon-ok");
        password_status.classList.add("glyphicon-remove");
        submit_btn.disabled = true;
    }
    else
    {
        password_group.classList.remove("has-error");
        password_group.classList.add("has-success");
        password_status.classList.remove("glyphicon-remove");
        password_status.classList.add("glyphicon-ok");
        submit_btn.disabled = false;
    }
}

function check_confirmpassword()
{
    let password = document.getElementById("password").value;
    let confirm = document.getElementById("confirm").value;
    if (password !== confirm)
    {
        confirm_group.classList.remove("has-success");
        confirm_group.classList.add("has-error");
        confirm_status.classList.remove("glyphicon-ok");
        confirm_status.classList.add("glyphicon-remove");
        submit_btn.disabled = true;
    }
    else
    {
        confirm_group.classList.remove("has-error");
        confirm_group.classList.add("has-success");
        confirm_status.classList.remove("glyphicon-remove");
        confirm_status.classList.add("glyphicon-ok");
        submit_btn.disabled = false;
    }
}