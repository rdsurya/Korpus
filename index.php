<?php
session_start();

$id = "";
$username = "";
$name = "";
$login = false;

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $username = $_SESSION['username'];
    $name = $_SESSION['name'];
    $login = true;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>KORPUS Faryhun</title>
        <link rel="stylesheet" href="/Korpus/assets/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="/Korpus/assets/font-awesome-4.7.0/css/font-awesome.min.css"/>
        <link rel="stylesheet" href="/Korpus/assets/css/sidenav.css"/>

        <style type="text/css">

            .style1 {color: #FFFFFF}
            .style2 {color: #FFFFFF; font-weight: bold; }
            .style7 {	color: #000066;
                      font-family: Georgia, "Georgia", Times, serif;
                      font-size: x-large;
            }
            .style8 {
                color: #FFFFFF;
                font-weight: bold;
                font-size: 24px;
                font-family: "Monotype Corsiva";
            }
            .style10 {
                font-family: "Monotype Corsiva";
                font-size: 24px;
            }
            .style11 {font-size: 24px}

        </style>
    </head>

    <body>
        <?php include 'menu/sidenav.php'; ?>
        <div id="wrapper">
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row" style="background: #333366; margin: 10px;">
                        <div class="col-md-6">
                            <div class="text-center" style="width: 100%; display: table; height: 150px; overflow: hidden;">
                                <h3 class="pull-left style1" onclick="openNav()" style="cursor: pointer;"><i class="fa fa-chevron-right"></i></h3>
                                <div style="display: table-cell; vertical-align: middle;">
                                    <h1>
                                        <span class="style1"><strong>WORD CONCORDANCE SYSTEM</strong></span>
                                    </h1>
                                </div>
                            </div>


                        </div>
                        <div class="col-md-6">
                            <img src="/Korpus/assets/img/banner.jpg" alt="banner" width="100%" height="150px" />
                        </div>

                    </div>
                    <?php
                    if ($login) {
                        echo '<h3 class="text-center style1" style="background: #333366; padding:20px; margin:0;">Welcome ' . $name . '!</h3>';
                    }
                    ?>
                    <div class="row">

                        <table width="99%" border="1" align="center">
                            <thead>
                                <tr>
                                    <td colspan="5">
                                        <div class="form-group pull-left" style="width: 40%; padding: 15px;">
                                            <label class="col-md-2 control-label" for="appendedtext">Search word:</label>
                                            <div class="col-md-5">
                                                <div class="input-group">
                                                    <input name="appendedtext" class="form-control" placeholder="word?" type="text" id="searchKey"/>
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-default" id="btnSearch"><i class="fa fa-search"></i> Search</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr  style="background: #333366; color: white;">
                                    <td width="5%"><center>DATE</center></td>
                                    <td width="20%"><center>TITLE</center></td>
                                    <td width="10%"><center>CATEGORY</center></td>
                                    <td width="5%"><center>FREQUENCY</center></td>
                                    <td><center>CONTEXT</center></td>
                                </tr>
                            </thead>
                            <tbody id="theContent">

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>

        <!-- Add Modal Start -->
        <div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                        <h3 class="modal-title">Login</h3>
                    </div>
                    <div class="modal-body">

                        <!-- content goes here -->
                        <form class="form-horizontal" id="loginForm">
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Username</label>  
                                <div class="col-md-4">
                                    <input id="name" name="name" type="text" placeholder="Enter your username" class="form-control input-md" required>

                                </div>
                            </div>

                            <!-- Password input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="passwordinput">Password</label>
                                <div class="col-md-4">
                                    <input id="password" name="password" type="password" placeholder="Enter your password" class="form-control input-md" required>
                                </div>
                            </div>

                        </form>
                        <div class="text-center">
                            <span>
                                <button id="btnLogin" type="button" class="btn btn-success"><i class="fa fa-sign-in"></i> Login</button>
                            </span>
                            &nbsp;
                            <span>
                                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="clear()"><i class="fa fa-times"></i> Close</button>
                            </span>

                        </div>

                        <!-- content goes here -->
                    </div>

                </div>
            </div>
        </div>
        <!-- Add Modal End -->  


        <script src="/Korpus/assets/js/jquery.min.js"></script>
        <script src="/Korpus/assets/js/bootstrap.min.js"></script>
        <script>
                                    function showLoginModal() {
                                        $('#login_modal').modal('show');
                                    }

                                    $('#btnLogin').on('click', function () {

                                        if (!$('#loginForm')[0].checkValidity()) {
                                            $('<input type="submit">').hide().appendTo('#loginForm').click().remove();
                                        } else {
                                            var name = document.getElementById('name');
                                            var password = document.getElementById('password');

                                            var data = {
                                                username: name.value,
                                                password: password.value
                                            };
                                            $.ajax({
                                                type: 'POST',
                                                data: data,
                                                timeout: 5000,
                                                dataType: 'json',
                                                url: "entrance/login_process.php",
                                                success: function (data, textStatus, jqXHR) {
                                                    if (data.valid) {
                                                        location.reload();
                                                    } else {
                                                        alert(data.msg);
                                                    }
                                                },
                                                error: function (err, status, errorThrown) {
                                                    alert(errorThrown);
                                                    console.log("error");
                                                }
                                            });
                                        }


                                    });

                                    function clear() {
                                        $('#loginForm')[0].reset();
                                    }
                                    
                                    //search word on click
                                    $('#btnSearch').on('click', function(){
                                        var key = $('#searchKey').val();
                                        if(key === "" || key.trim().split(" ").length > 1){
                                            alert("Please enter a word!");
                                        }
                                        else{
                                            $.ajax({
                                                type: 'POST',
                                                data: {key:key},
                                                timeout: 5000,
                                                url: "word/process.php",
                                                success: function (data, textStatus, jqXHR) {
                                                    $('#theContent').html(data);
                                                },
                                                error: function (err, status, errorThrown) {
                                                    alert(errorThrown);
                                                    console.log("error");
                                                }
                                            });
                                        }
                                    });
        </script>
    </body>
</html>