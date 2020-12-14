<?php
// core configuration
include_once 'config/core.php';
//include_once 'config/database.php';
include_once 'objects/q2.php';
include_once 'config/Foes.php';
if(debug){
    var_dump($_POST);
}
if (!empty($_POST)) {
    if(!fast_debug) {
        include_once 'config/database.php';
        $database = new Database();
        $db = $database->getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       // $user = new User($db);
        $q2 = new Q2($db,$_SESSION['user-id']);

        $q2->game1 = test_input($_POST["game1"]);
        $q2->game2 = test_input($_POST["game2"]);
        $q2->violence1 = check_int($_POST["violence1"],0,5);
        $q2->violence2 = check_int($_POST["violence2"],0,5);
        $q2->gens = $_POST["type"];
        $q2->realism11 = check_int($_POST["realism11"],0,5);
        $q2->realism12 = check_int($_POST["realism12"],0,5);
        $q2->realism21 = check_int($_POST["realism21"],0,5);
        $q2->realism22 = check_int($_POST["realism22"],0,5);
        $q2->sexism1 = check_int($_POST["sexism1"],0,5);
        $q2->sexism2 = check_int($_POST["sexism2"],0,5);
        $q2->playtime = check_int($_POST["playtime"],0,4);
        if (!$q2->create()) {
            die("Errore del server");
        }
    }
    header("Location: ".home_url."Q1.php?action=goto");
}
if(debug) {
    echo "<p> DEBUG: ";
    print_r($_SESSION['at']);
    echo "</p>";
    echo "<p> DEBUG: ";
    print_r($_SESSION['Q'][$_SESSION['at']]);
    echo "</p>";
}
include_once "layout_head.php";

?>
    <form action='Q2.php' method='post'>
    <!-- fixed order for this one -->
    <div class="wrap">
        <div class='main-container'>
                <div class="Q1" >
                    <strong>
                    Time dedicated to videogames (smartphone, PC, console) on average in a day:
                    </strong>
                </div>
                <div style="column-count: 2;grid-row: 2 ;padding: 5px;">
                    <label>
                        <input type='radio' name='playtime' value='0'>
                    </label> Never
                    <label>
                        <input type='radio' name='playtime' value='1'>
                    </label> Less than 1 hour
                    <label>
                        <input type='radio' name='playtime' value='2'>
                    </label> Between 1 and 2 hours
                    <label>
                        <input type='radio' name='playtime' value='3'>
                    </label> Between 2 and 4 hours
                    <label>
                        <input type='radio' name='playtime' value='4' required>
                    </label> More than 4 hours
                </div>

                <!-- Todo: parte grafica-->
                <div class="Q2">
                    <strong>
                    Enter the type of videogames you prefer (you can enter a maximum of three preferences)</strong>
                </div>
                <div class="ans2 options">

                    <label style="grid-column: 1; grid-row: 1">
                        <input type='checkbox' name='type[]' value='Platform'>
                        Platform
                    </label>
                    <label style="grid-column: 2; grid-row: 1">
                        <input type='checkbox' name='type[]' value='FPS'>
                        FPS(First Person Shooter)
                    </label>
                    <label style="grid-column: 3; grid-row:1">
                        <input type='checkbox' name='type[]' value='TPS'>
                        TPS(Third Person Shooter)
                    </label>
                    <label style="grid-column: 4; grid-row: 1">
                        <input type='checkbox' name='type[]' value='Danmaku'>
                        Bullet hell
                    </label>
                    <label style="grid-column: 5; grid-row: 1">
                        <input type='checkbox' name='type[]' value='BattleRoyale'>
                        Battle Royale
                    </label>


                    <label style="grid-column: 1; grid-row: 2">
                        <input type='checkbox' name='type[]' value='Fighting'>
                        Fighting games
                    </label>
                    <label style="grid-column: 2; grid-row: 2">
                        <input type='checkbox' name='type[]' value='Brawlers'>
                        Beat'em up (Brawlers)
                    </label>
                    <label style="grid-column: 3; grid-row: 2">
                        <input type='checkbox' name='type[]' value='Stealth'>
                        Stealth
                    </label>
                    <label style="grid-column: 4; grid-row: 2">
                        <input type='checkbox' name='type[]' value='Survival'>
                        Survival
                    </label>
                    <label style="grid-column: 5; grid-row: 2">
                        <input type='checkbox' name='type[]' value='SurvivalHorror'>
                        Survival horror
                    </label>



                    <label style="grid-column: 1; grid-row: 3">
                        <input type='checkbox' name='type[]' value='Metroidvania'>
                        Metroidvania
                    </label>
                    <label style="grid-column: 2; grid-row: 3">
                        <input type='checkbox' name='type[]' value='TextAdv'>
                        Text adventure
                    </label>
                    <label style="grid-column: 3; grid-row: 3">
                        <input type='checkbox' name='type[]' value='GraphicAdv'>
                        Graphic adventure
                    </label>
                    <label style="grid-column: 4; grid-row: 3">
                        <input type='checkbox' name='type[]' value='VisualNovel'>
                        Visual Novel
                    </label>
                    <label style="grid-column: 5; grid-row: 3">
                        <input type='checkbox' name='type[]' value='InteractiveMovie'>
                        Interactive movie
                    </label>


                    <label style="grid-column: 1; grid-row: 4">
                        <input type='checkbox' name='type[]' value='RealTime3DAdventure'>
                        Real Time 3D adventure
                    </label>
                    <label style="grid-column: 2; grid-row: 4">
                        <input type='checkbox' name='type[]' value='Roguelike'>
                        Roguelike
                    </label>
                    <label style="grid-column: 3; grid-row: 4">
                        <input type='checkbox' name='type[]' value='MMO'>
                        MMO(Massively Multiplayer Online)
                    </label>
                    <label style="grid-column: 4; grid-row: 4">
                        <input type='checkbox' name='type[]' value='MMORPG'>
                        MMORPG(Massively Multiplayer Online role-playing games)
                    </label>
                    <label style="grid-column: 5; grid-row: 4">
                        <input type='checkbox' name='type[]' value='ActionRPG'>
                        Action RPG
                    </label>


                    <label style="grid-column: 1; grid-row: 5">
                        <input type='checkbox' name='type[]' value='TacticalRPG'>
                        Tactical RPG
                    </label>
                    <label style="grid-column: 2; grid-row: 5">
                        <input type='checkbox' name='type[]' value='JRPG'>
                        JRPG(Japanese RPG)
                    </label>
                    <label style="grid-column: 3; grid-row: 5">
                        <input type='checkbox' name='type[]' value='FPPBRPG'>
                        FPPBRPG(First-person Party-based RPG)
                    </label>
                    <label style="grid-column: 4; grid-row: 5">
                        <input type='checkbox' name='type[]' value='MonsterTamer'>
                        Monster tamer (like Pokemon)
                    </label>
                    <label style="grid-column: 5; grid-row: 5">
                        <input type='checkbox' name='type[]' value='SandboxRPG'>
                        Sandbox RPG
                    </label>



                    <label style="grid-column: 1; grid-row: 6">
                        <input type='checkbox' name='type[]' value='Sandbox'>
                        Sandbox
                    </label>
                    <label style="grid-column: 2; grid-row: 6">
                        <input type='checkbox' name='type[]' value='OpenWorld'>
                        Open world
                    </label>
                    <label style="grid-column: 3; grid-row: 6">
                        <input type='checkbox' name='type[]' value='ConstructionSim'>
                        Construction and management simulation
                    </label>
                    <label style="grid-column: 4; grid-row: 6">
                        <input type='checkbox' name='type[]' value='LifeSim'>
                        Life simulation
                    </label>
                    <label style="grid-column: 5; grid-row: 6">
                        <input type='checkbox' name='type[]' value='VehicleSim'>
                        Vehicle simulation
                    </label>


                    <label style="grid-column: 1; grid-row: 7">
                        <input type='checkbox' name='type[]' value='DatingSim'>
                        Dating simulation
                    </label>
                    <label style="grid-column: 2; grid-row: 7">
                        <input type='checkbox' name='type[]' value='Eroge'>
                        Eroge(Japanese style Erotic games)
                    </label>
                    <label style="grid-column: 3; grid-row: 7">
                        <input type='checkbox' name='type[]' value='Eroge'>
                        Eroge(Japanese style Erotic games)
                    </label>
                    <label style="grid-column: 4; grid-row: 7">
                        <input type='checkbox' name='type[]' value='4x'>
                        4X( eXplore, eXpand, eXploit, and eXterminate)
                    </label>
                    <label style="grid-column: 5; grid-row: 7">
                        <input type='checkbox' name='type[]' value='Artillery'>
                        Artillery
                    </label>

                    <label style="grid-column: 1; grid-row: 8">
                        <input type='checkbox' name='type[]' value='AutoBattler'>
                        Auto Battler
                    </label>
                    <label style="grid-column: 2; grid-row: 8">
                        <input type='checkbox' name='type[]' value='MOBA'>
                        MOBA (Multiplayer Online Battle Arena)
                    </label>
                    <label style="grid-column: 3; grid-row: 8">
                        <input type='checkbox' name='type[]' value='RTS'>
                        RTS(Real Time Strategy)
                    </label>
                    <label style="grid-column: 4; grid-row: 8">
                        <input type='checkbox' name='type[]' value='RTT'>
                        RTT(Real Time Tactics)
                    </label>
                    <label style="grid-column: 5; grid-row: 8">
                        <input type='checkbox' name='type[]' value='TBS'>
                        TBS(Turn-based Strategy)
                    </label>

                    <label style="grid-column: 1; grid-row: 9">
                        <input type='checkbox' name='type[]' value='TBT'>
                        TBT(Turn-based Tactics)
                    </label>
                    <label style="grid-column: 2; grid-row: 9">
                        <input type='checkbox' name='type[]' value='TowerDefense'>
                        Tower defense
                    </label>
                    <label style="grid-column: 3; grid-row: 9">
                        <input type='checkbox' name='type[]' value='Sport'>
                        Sport
                    </label>
                    <label style="grid-column: 4; grid-row: 9">
                        <input type='checkbox' name='type[]' value='Card'>
                        Card game
                    </label>
                    <label style="grid-column: 5; grid-row: 9">
                        <input type='checkbox' name='type[]' value='Horror'>
                        Horror game
                    </label>

                    <label style="grid-column: 1; grid-row: 10">
                        <input type='checkbox' name='type[]' value='Party'>
                        Party game
                    </label>
                    <label style="grid-column: 2; grid-row: 10">
                        <input type='checkbox' name='type[]' value='Typing'>
                        Typing Game
                    </label>
                    <label style="grid-column: 3; grid-row: 10">
                        <input type='checkbox' name='type[]' value='Logic'>
                        Logic game
                    </label>
                    <label style="grid-column: 4; grid-row: 10">
                        <input type='checkbox' name='type[]' value='Multi'>
                        Multi-Genre
                    </label>
                    <label style="grid-column: 5; grid-row: 10">
                        <input type='checkbox' name='type[]' value='Other'>
                        Other
                    </label>
                </div>
                <div style="grid-row: 6">
                    <b>Enter one or two of your current favorite video games and indicate for each one the degree of the perceived characteristics (from 0 to 5):</b>
                </div>
            <div style="grid-row: 7">
                <div class="games">
                     <label style="grid-row: 1;grid-column: 1">
                        Game 1:
                        <input type='text' name='game1' required>
                    </label>
                    <label style="grid-row: 1;grid-column: 2 ;">
                        Gender disparities
                    </label>
                     <label style="grid-row: 1; grid-column: 3">
                         Absent (0)
                         <input type='range' name='sexism1' min=0 max=5 required>
                         (5) Very present
                     </label>

                    <label style="grid-row: 2;grid-column: 2 ;">
                        Violence
                    </label>
                    <label style="grid-row: 2; grid-column: 3">
                        Absent (0)
                        <input type='range' name='violence1' min=0 max=5 required>
                        (5) Very present
                    </label>

                    <label style="grid-row: 3;grid-column: 2 ;">
                        Game graphics realism
                    </label>
                    <label style="grid-row: 3; grid-column: 3">
                        Absent (0)
                        <input type='range' name='realism11' min=0 max=5 required>
                        (5) Very realistic
                    </label>

                    <label style="grid-row: 4;grid-column: 2 ;">
                        Game mechanics realism
                    </label>
                    <label style="grid-row: 4; grid-column: 3">
                        Absent (0)
                        <input type='range' name='realism12' min=0 max=5 required>
                        (5) Very realistic
                    </label>

                </div>

            </div>
            <div style="grid-row: 8">
                <div class="games">
                    <label style="grid-row: 1;grid-column: 1">
                        Game 2:
                        <input type='text' name='game2' required>
                    </label>
                    <label style="grid-row: 1;grid-column: 2 ;">
                        Gender disparities
                    </label>
                    <label style="grid-row: 1; grid-column: 3">
                        Absent (0)
                        <input type='range' name='sexism2' min=0 max=5 required>
                        (5) Very present
                    </label>

                    <label style="grid-row: 2;grid-column: 2 ;">
                        Violence
                    </label>
                    <label style="grid-row: 2; grid-column: 3">
                        Absent (0)
                        <input type='range' name='violence2' min=0 max=5 required>
                        (5) Very present
                    </label>

                    <label style="grid-row: 3;grid-column: 2 ;">
                        Game graphics realism
                    </label>
                    <label style="grid-row: 3; grid-column: 3">
                        Absent (0)
                        <input type='range' name='realism21' min=0 max=5 required>
                        (5) Very realistic
                    </label>

                    <label style="grid-row: 4;grid-column: 2 ;">
                        Game mechanics realism
                    </label>
                    <label style="grid-row: 4; grid-column: 3">
                        Absent (0)
                        <input type='range' name='realism22' min=0 max=5 required>
                        (5) Very realistic
                    </label>
                </div>
            </div>
            <div style="grid-row: 9; justify-items: center">
                <input type="submit" name="action" id="action-q2" tabindex="4" class="form-control btn" value="Continue">
            </div>
    </div>
    </form>

<script>
    $('.options :checkbox').change(function () {
        let $cs = $(this).closest('.options').find(':checkbox:checked');
        if ($cs.length > 3) {
            this.checked = false;
        }
    });
</script>
    <style>

/*
        .type-label {
            display: block;
            padding-left: 15px;
            text-indent: -15px;
            position: relative;


        }
        input[type=checkbox] {
            width: 13px;
            height: 13px;
            padding: 0;
            margin:0;
            vertical-align: bottom;
            position: relative;
            top: -1px;
            *overflow: hidden;
        }
*/
/*TODO:css */

    .wrap {
        max-width: 100%;
        text-align: left;
        margin: 0 auto;
    }
    .main-container {
        margin: 0 auto;
        padding: 1em;
        /* display: flex;*/
        /*align-items: center;*/
        display: grid;
        grid-gap: 2px;
        grid-auto-rows: 66px;
        grid-template-columns: 100%;
        grid-template-rows: 2.5% 2.5% 20px 2.5% 500px 20px 24% 24% 2% ;
        grid-auto-flow: row;

    }
    .options{
        margin: 0;
        padding: 1em;
        /* display: flex;*/
        /*align-items: center;*/
        align-content: stretch;
        display: grid;
        grid-gap: 2px;
        grid-auto-columns: 1fr;
        grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
        grid-template-rows: 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr;
        grid-auto-flow: row;
    }
.games{
    margin: 0;
    padding: 1em;
    align-content: stretch;
    display: grid;
    grid-gap: 2px;
    grid-auto-columns: 1fr;
    grid-template-columns: 1fr 0.7fr 4fr;
    grid-template-rows: 1fr 1fr 1fr 1fr 1fr ;
    grid-auto-flow: row;
}

.Q1{
    grid-column: 1 / 1;
    grid-row: 1 ;
    justify-self: stretch;
}
.Q2{
    grid-column: 1 / 1;
    grid-row: 4;
    justify-self: stretch;
}

.Q4{
    grid-column: 1 / 1;
    grid-row: 8;
    justify-self: stretch;
}
.ans1{

    grid-column: 1 / 1;
    grid-row: 2;
    justify-self: stretch;
}
.ans2{
    grid-column: 1 / 1;
    grid-row: 5;
    justify-self: stretch;
}
.footer{
    grid-column: 1 / 1;
    grid-row: 9;
    text-align: center;
}



    </style>
<?php

// footer HTML and JavaScript codes
include_once "layout_foot.php";
