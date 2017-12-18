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
                                    List of News
                                    <div class="pull-right">
                                        <button class="btn btn-primary" id="btnAddModal">
                                            <i class="fa fa-fw fa-plus-circle"></i> Add News 
                                        </button>
                                    </div>
                                </h3>

                                <hr/>
                                <div class="table-responsive" id="newsTableDiv">

                                </div>
                            </div>
                        </div>               
                    </div>


                </div>
            </div>
        </div>

        <!-- Add Modal Start -->
        <div class="modal fade" id="news_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                        <h3 class="modal-title"><i class="fa fa-newspaper-o"></i> News Information</h3>
                    </div>
                    <div class="modal-body">

                        <!-- content goes here -->
                        <form class="form-horizontal" id="newsForm">

                            <input type="hidden" id="modal_id"/>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="textinput">Title</label>  
                                <div class="col-md-8">
                                    <input id="title" type="text" placeholder="Enter the title of news" class="form-control input-md" required maxlength="100">

                                </div>
                            </div>

                            <!-- Select Basic -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="selectbasic">Category</label>
                                <div class="col-md-8">
                                    <select id="category" name="selectbasic" class="form-control">

                                    </select>
                                </div>
                            </div>

                            <!-- Password input-->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="passwordinput">Upload content</label>
                                <div class="col-md-8">
                                    <input id="uploadFile"  type="file" class="form-control input-md" accept=".txt" />
                                </div>
                            </div>

                            <!-- Password input-->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="passwordinput">Content</label>
                                <div class="col-md-12">
                                    <textarea id="content" placeholder="Write the news content" class="form-control input-md" required rows="25" cols="6"></textarea>
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
        <script type="text/javascript" src="/Korpus/assets/js/jquery.check-file.js"></script>
        <script>
                                    $(function () {
                                        loadTable();
                                        loadCategoryOption();
                                    });

                                    function loadCategoryOption() {
                                        $.ajax({
                                            type: 'POST',
                                            timeout: 5000,
                                            url: "control/getCategory.php",
                                            success: function (data, textStatus, jqXHR) {
                                                $('#category').html(data);
                                            },
                                            error: function (err, status, errorThrown) {
                                                alert(errorThrown);
                                                console.log("error");
                                            }
                                        });
                                    }

                                    function loadTable() {
                                        $.ajax({
                                            type: 'POST',
                                            timeout: 5000,
                                            url: "getTable.php",
                                            success: function (data, textStatus, jqXHR) {
                                                $('#newsTableDiv').html(data);
                                            },
                                            error: function (err, status, errorThrown) {
                                                alert(errorThrown);
                                                console.log("error");
                                            }
                                        });
                                    }

                                    //------------- upload file process -----------------------------------------

                                    $('#uploadFile').checkFileType({
                                        allowedExtensions: ['txt'],
                                        success: function () {
                                            loadFileAsText();
                                        },
                                        error: function () {
                                            alert('Incompatible file type');
                                            $('#uploadFile').val("");
                                        }
                                    });

                                    function loadFileAsText()
                                    {

                                        var iSize = 0;

                                        iSize = ($("#uploadFile")[0].files[0].size / 1024);

                                        var sizeSmall = false;

                                        if (iSize / 1024 > 1) {
                                            sizeSmall = false;

                                        } else {

                                            iSize = (Math.round(iSize * 100) / 100);

                                            sizeSmall = iSize <= 80;

                                        }

                                        if (sizeSmall) {
                                            var filesSelected = document.getElementById("uploadFile").files;
                                            if (filesSelected.length > 0)
                                            {
                                                var fileToLoad = filesSelected[0];

                                                var fileReader = new FileReader();

                                                fileReader.onload = function (fileLoadedEvent)
                                                {
                                                    var content = fileLoadedEvent.target.result;
                                                    $('#content').val(content);

                                                };

                                                fileReader.readAsText(fileToLoad, 'ISO-8859-1');
                                            }

                                        } else {

                                            alert("File size must not exceed 80kb");
                                            $('#uploadFile').val("");

                                        }


                                    }

                                    $('#btnAddModal').on('click', function () {
                                        $('#news_modal').modal('show');
                                        clear();
                                        $('.update_save_btn').hide();
                                        $('.divAdd').show();
                                    });

                                    $('#btnAdd').on('click', function () {
                                        if (!$('#newsForm')[0].checkValidity()) {
                                            $('<input type="submit">').hide().appendTo('#newsForm').click().remove();
                                        } else {

                                            var data = {
                                                title: $('#title').val(),
                                                category: $('#category').val(),
                                                content: $('#content').val()
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
                                                        $('#news_modal').modal('hide');
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

                                    $('#newsTableDiv').on('click', '#btnUpdateModal', function () {

                                        var strObj = $(this).closest('td').find('#b_obj').val();
                                        var obj = JSON.parse(strObj);

                                        $('#title').val(obj.title);
                                        $('#category').val(obj.category);
                                        $('#modal_id').val(obj.id);
                                        $('#uploadFile').val();

                                        var post = {
                                            id: obj.id
                                        };

                                        $.ajax({
                                            type: 'POST',
                                            timeout: 5000,
                                            data: post,
                                            url: "control/getContent.php",
                                            success: function (data, textStatus, jqXHR) {
                                                $('#content').val(data);
                                                $('#news_modal').modal('show');
                                                $('.update_save_btn').hide();
                                                $('.divUpdate').show();
                                            },
                                            error: function (err, status, errorThrown) {
                                                alert(errorThrown);
                                                console.log("error");
                                            }
                                        });


                                    });

                                    $('#btnUpdate').on('click', function () {

                                        if (!$('#newsForm')[0].checkValidity()) {
                                            $('<input type="submit">').hide().appendTo('#newsForm').click().remove();
                                        } else {
                                            var data = {
                                                title: $('#title').val(),
                                                category: $('#category').val(),
                                                content: $('#content').val(),
                                                id: $('#modal_id').val()
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
                                                        $('#news_modal').modal('hide');
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


                                    $('#newsTableDiv').on('click', '#btnDelete', function () {

                                        var strObj = $(this).closest('td').find('#b_obj').val();
                                        var obj = JSON.parse(strObj);

                                        var yes = confirm("Are yoou sure you want to delete news " + obj.title + " ?");

                                        if (yes) {
                                            var data = {
                                                id: obj.id
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
                                        $('#newsForm')[0].reset();
                                    }
        </script>
    </body>
</html>