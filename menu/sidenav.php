<?php ?>
<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <?php
    if ($login) {
        ?>
        <a href="/Korpus/index.php"><i class="fa fa-home"></i> Home</a>
        <a href="/Korpus/admin/index.php"><i class="fa fa-user-circle-o"></i> Manage admin</a>
        <a href="#"><i class="fa fa-newspaper-o"></i> Manage news</a>
        <a href="javascript:void(0)" onclick="logout()"><i class="fa fa-power-off"></i> Logout</a>
        <?php
    } else {
        ?>
        <a href="javascript:void(0)" onclick="showLoginModal()">Login</a>
        <?php
    }
    ?>            
</div>
<script>
    /* Set the width of the side navigation to 250px */
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    /* Set the width of the side navigation to 0 */
    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }

    function logout() {
        var yes = confirm("Are you sure you want to logout?");

        if (!yes) {
            return false;
        }
        $.ajax({
            type: 'POST',
            timeout: 5000,
            url: "/Korpus/entrance/logout_process.php",
            success: function (data, textStatus, jqXHR) {
                location.reload();
            },
            error: function (err, status, errorThrown) {
                alert(errorThrown);
                console.log("error");
            }
        });
    }
</script>