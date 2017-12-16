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
} else {
    header('Location: /Korpus/index.php');
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>KORPUS Faryhun</title>
        <link rel="stylesheet" href="/Korpus/assets/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="/Korpus/assets/css/dataTables.bootstrap.min.css"/>
        <link rel="stylesheet" href="/Korpus/assets/css/buttons.bootstrap.min.css"/>
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
        <?php include '../menu/sidenav.php'; ?>

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
                        <div class="col-lg-12">
                            <div class="thumbnail">
                                <h3>
                                    List of Admin
                                    <div class="pull-right">
                                        <button class="btn btn-primary" id="btnAddModal">
                                            <i class="fa fa-fw fa-plus-circle"></i> New Admin 
                                        </button>
                                    </div>
                                </h3>

                                <hr/>
                                <div class="table-responsive" id="adminTableDiv">

                                </div>
                            </div>
                        </div>               
                    </div>


                </div>
            </div>
        </div>

        <!-- Add Modal Start -->
        <div class="modal fade" id="admin_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                        <h3 class="modal-title">Admin Information</h3>
                    </div>
                    <div class="modal-body">

                        <!-- content goes here -->
                        <form class="form-horizontal" id="adminForm">
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Name</label>  
                                <div class="col-md-4">
                                    <input id="name" name="name" type="text" placeholder="Enter admin name" class="form-control input-md" required maxlength="100">

                                </div>
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Username</label>  
                                <div class="col-md-4">
                                    <input id="username" name="name" type="text" placeholder="Enter admin username" class="form-control input-md" required maxlength="30">

                                </div>
                            </div>

                            <!-- Password input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="passwordinput">Password</label>
                                <div class="col-md-4">
                                    <input id="password" name="password" type="password" placeholder="Enter password" class="form-control input-md" required minlength="5" maxlength="100">
                                </div>
                            </div>

                            <!-- Password input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="passwordinput">Retype Password</label>
                                <div class="col-md-4">
                                    <input id="password2" name="password" type="password" placeholder="Confirm password" class="form-control input-md" required minlength="5" maxlength="100">
                                </div>
                            </div>

                        </form>
                        <div class="text-center">
                            <span class="update_save_btn divAdd" >
                                <button id="btnAdd" type="button" class="btn btn-success"><i class="fa fa-check"></i> Submit</button>
                            </span>
                            <span class="update_save_btn divUpdate" style="display: none;">
                                <button id="btnUpdate" type="button" class="btn btn-success"><i class="fa fa-pencil-square-o"></i> Update</button>
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
        <script type="text/javascript" src="/Korpus/assets/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="/Korpus/assets/js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript" src="/Korpus/assets/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="/Korpus/assets/js/buttons.bootstrap.min.js"></script>
        <script type="text/javascript" src="/Korpus/assets/js/buttons.colVis.min.js"></script>
        <script type="text/javascript" src="/Korpus/assets/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="/Korpus/assets/js/buttons.print.min.js"></script>
        <script type="text/javascript" src="/Korpus/assets/js/jszip.min.js"></script>
        <script type="text/javascript" src="/Korpus/assets/js/pdfmake.min.js"></script>
        <script type="text/javascript" src="/Korpus/assets/js/vfs_fonts.js"></script>
        <script>
                                    $(function () {
                                        loadTable();
                                    });

                                    function loadTable() {
                                        $.ajax({
                                            type: 'POST',
                                            timeout: 5000,
                                            url: "getTable.php",
                                            success: function (data, textStatus, jqXHR) {
                                                $('#adminTableDiv').html(data);
                                            },
                                            error: function (err, status, errorThrown) {
                                                alert(errorThrown);
                                                console.log("error");
                                            }
                                        });
                                    }

                                    $('#btnAddModal').on('click', function () {
                                        $('#admin_modal').modal('show');
                                        clear();
                                        $('#username').prop('readonly', false);
                                        $('.update_save_btn').hide();
                                        $('.divAdd').show();
                                    });

                                    $('#btnAdd').on('click', function () {
                                        var pwd = $('#password').val();
                                        var pwd2 = $('#password2').val();

                                        if (!$('#adminForm')[0].checkValidity()) {
                                            $('<input type="submit">').hide().appendTo('#adminForm').click().remove();
                                        } else if (pwd !== pwd2) {
                                            alert("Password do not match!");
                                            $('#password').val('');
                                            $('#password2').val('');
                                        } else {

                                            var data = {
                                                username: $('#username').val(),
                                                name: $('#name').val(),
                                                password: pwd
                                            };

                                            $.ajax({
                                                type: 'POST',
                                                data: data,
                                                timeout: 5000,
                                                dataType: 'json',
                                                url: "insert.php",
                                                success: function (data, textStatus, jqXHR) {
                                                    if (data.valid) {
                                                        alert(data.msg);
                                                        $('#admin_modal').modal('hide');
                                                        loadTable();
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

                                    $('#adminTableDiv').on('click', '#btnUpdateModal', function () {

                                        var strObj = $(this).closest('td').find('#b_obj').val();
                                        var obj = JSON.parse(strObj);

                                        $('#username').val(obj.username);
                                        $('#username').prop('readonly', true);
                                        $('#name').val(obj.name);
                                        $('#password').val(obj.password);
                                        $('#password2').val(obj.password);

                                        $('#admin_modal').modal('show');
                                        $('.update_save_btn').hide();
                                        $('.divUpdate').show();
                                    });

                                    $('#btnUpdate').on('click', function () {
                                        var pwd = $('#password').val();
                                        var pwd2 = $('#password2').val();

                                        if (!$('#adminForm')[0].checkValidity()) {
                                            $('<input type="submit">').hide().appendTo('#adminForm').click().remove();
                                        } else if (pwd !== pwd2) {
                                            alert("Password do not match!");
                                            $('#password').val('');
                                            $('#password2').val('');
                                        } else {

                                            var data = {
                                                username: $('#username').val(),
                                                name: $('#name').val(),
                                                password: pwd
                                            };

                                            $.ajax({
                                                type: 'POST',
                                                data: data,
                                                timeout: 5000,
                                                dataType: 'json',
                                                url: "update.php",
                                                success: function (data, textStatus, jqXHR) {
                                                    if (data.valid) {
                                                        alert(data.msg);
                                                        $('#admin_modal').modal('hide');
                                                        loadTable();
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


                                    $('#adminTableDiv').on('click', '#btnDelete', function () {

                                        var strObj = $(this).closest('td').find('#b_obj').val();
                                        var obj = JSON.parse(strObj);

                                        var yes = confirm("Are yoou sure you want to delete admin " + obj.name + " ?");

                                        if (yes) {
                                            var data = {
                                                username: obj.username
                                            };

                                            $.ajax({
                                                type: 'POST',
                                                data: data,
                                                timeout: 5000,
                                                dataType: 'json',
                                                url: "delete.php",
                                                success: function (data, textStatus, jqXHR) {
                                                    if (data.valid) {
                                                        alert(data.msg);
                                                        loadTable();
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
                                        $('#adminForm')[0].reset();
                                    }
        </script>
    </body>
</html>