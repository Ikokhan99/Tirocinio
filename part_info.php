<?php
// core configuration
include_once "config/core.php";

include_once 'config/database.php';
include_once 'objects/user.php';

// page title
$page_title = "Survey - part 1";
include_once "layout_head.php";


if (isset($_POST['action']) && $_POST['action'] == 'register') {
    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);

    $user->sex = $_POST['Register_sex'];
    $user->age = $_POST['Register_age'];
    $user->sexor = $_POST['Register_sexor'];

    $db->exec('DECLARE `_rollback` BOOL DEFAULT 0;');
    $db->exec('DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET `_rollback` = 1;');
    // create the user and start transaction
    if($db->beginTransaction())
    {
        $db->exec('SAVEPOINT begin;'); //serve in caso di fallimnento di domande di controllo
        if($user->create())
        {
            $db->exec('SAVEPOINT uinfo;');
            $_POST=array();
        }
        //echo "<script> location.replace(\".php?action=success\"); </script>"; //replace ad Avatar TODO: settare
    } else {
        echo "<div class='alert alert-danger' role='alert'>Something went wrong.</div>";
    }
}

?>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form>
                <!-- TODO: range di età al posto di età in numero?-->
                <div class="form-group">
                    <label for="age">Please, insert exact age</label>
                    <input type="number" id="age" size="6" name="Register_age" min="6" max="99" value="" required="required" tabindex="1" class="form-control">
                </div>
                <div class="form-group">
                    <div style="overflow-x:auto; align-items: flex-start">
                        <table>
                            <thead>
                            <tr>
                                <th>
                                    <label for="Register_sex" class="required"><span class="label-text">Biological sex:</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <input type="radio" required="required" name="Register_sex" value="0" id = "male" tabindex="2">
                                    <label for="male">
                                        Male
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="radio"  required="required"  name="Register_sex" value="1" id = "female" tabindex="2">
                                    <label for="female">
                                        Female
                                    </label>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- TODO:fix css -->
                <div class="form-group">
                    <div style="overflow-x:auto; align-items: flex-start">
                        <table>
                            <thead>
                            <tr>
                                <th>
                                    <label for="Register_sexor" class="required"><span class="label-text">Sexual orientation:</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <input type="radio" required="required" name="Register_sexor" value="0" id = "no" tabindex="3">
                                    <label for="no">
                                        I don't want to specify my sexual orientation
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="radio"  required="required" name="Register_sexor" value="1" id = "heterosexual" tabindex="3">
                                    <label for="heterosexual">
                                        Heterosexual
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="radio"  required="required" name="Register_sexor" value="2" id = "homosexual" tabindex="3">
                                    <label for="homosexual">
                                        Homosexual
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="radio" required="required" name="Register_sexor" value="3" id = "bisexual" tabindex="3">
                                    <label for="bisexual">
                                        Bisexual
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="radio" required="required" name="Register_sexor" value="4" id = "other" tabindex="3">
                                    <label for="other">
                                        Other
                                    </label>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <input type="submit" name="action" id="action-r" tabindex="4" class="form-control btn btn-register" value="Next">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    body {
        padding-top: 90px;
    }


    .btn-register {
        background-color: #1CB94E;
        outline: none;
        color: #fff;
        font-size: 14px;
        height: auto;
        font-weight: normal;
        padding: 14px 0;
        text-transform: uppercase;
        border-color: #1CB94A;
    }
    .btn-register:hover,
    .btn-register:focus {
        color: #fff;
        background-color: #1CA347;
        border-color: #1CA347;
    }
</style>

<?php
// footer HTML and JavaScript codes
include_once "layout_foot.php";
