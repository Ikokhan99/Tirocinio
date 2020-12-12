<?php
// core configuration
include_once 'config/core.php';
//include_once 'config/database.php';
include_once 'objects/q2.php';
include_once 'config/Foes.php';

if (!empty($_POST)) {
    if(!fast_debug) {
        //TODO
        $q2 = new Q2($_SESSION['db'],$_SESSION['uid']);
        $q2->playtime = $_POST['playtime'];
        $q2->sexor = $_POST['user-sexor'];
        $q2->sex = $_POST['user-sex'];
        $q2->age = $_POST['user-age'];
        if ($_SESSION['Q_ORDERED'])
            $q2->q_order = 0;
        else
            $q2->q_order = 1;
        if (!$q2->create()) {
            $q2->showError();
            die();
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
//TODO: tipologia, realismo di ambientazione?, realismo grafico?, livello violenza?

?>

    <!-- fixed order for this one -->
    <div>
        <form action='Q2.php' method='post'>
            <div class='center'>
                <div >
                    <b>Time dedicated to videogames (smartphone, PC, console) on average in a day:</b><br><br><br>
                    <label>
                        <input type='radio' name='playtime' value='never'>
                    </label> Never <br>
                    <br>
                    <label>
                        <input type='radio' name='playtime' value='low'>
                    </label> Less than 1 hour <br><br>
                    <label>
                        <input type='radio' name='playtime' value='mid'>
                    </label> Between 1 and 2 hours <br><br>
                    <label>
                        <input type='radio' name='playtime' value='high'>
                    </label> Between 2 and 4 hours <br><br>
                    <label>
                        <input type='radio' name='playtime' value='veryhigh' required>
                    </label> More than 4 hours <br><br>
                </div>

                <!-- Todo: parte grafica-->
                <div>
                    <strong>
                    Enter the type of videogames you prefer (you can enter a maximum of three preferences)</strong>
                    <br><br>

                    <label class="type-label">
                        <input type='checkbox' name='type' value='Platform'>
                        Platform
                    </label><br>
                    <label class="type-label">
                        <input type='checkbox' name='type' value='FPS'>
                        FPS(First Person Shooter)
                    </label><br>
                    <label class="type-label">
                        <input type='checkbox' name='type' value='TPS'>
                        TPS(Third Person Shooter)
                    </label><br>
                    <label class="type-label">
                        <input type='checkbox' name='type' value='Danmaku'>
                        Bullet hell
                    </label><br>
                    <label class="type-label">
                        <input type='checkbox' name='type' value='BattleRoyale'>
                        Battle Royale
                    </label><br>


                    <label class="type-label">
                        <input type='checkbox' name='type' value='Fighting'>
                        Fighting games
                    </label><br>
                    <label class="type-label">
                        <input type='checkbox' name='type' value='Brawlers'>
                        Beat'em up (Brawlers)
                    </label><br>
                    <label class="type-label">
                        <input type='checkbox' name='type' value='Stealth'>
                        Stealth
                    </label><br>
                    <label class="type-label">
                        <input type='checkbox' name='type' value='Survival'>
                        Survival
                    </label><br>
                    <label class="type-label">
                        <input type='checkbox' name='type' value='SurvivalHorror'>
                        Survival horror
                    </label><br>


                    <label class="type-label">
                        <input type='checkbox' name='type' value='Metroidvania'>
                        Metroidvania
                    </label><br>
                    <label class="type-label">
                        <input type='checkbox' name='type' value='TextAdv'>
                        Text adventure
                    </label><br>
                    <label class="type-label">
                        <input type='checkbox' name='type' value='GraphicAdv'>
                        Graphic adventure
                    </label><br>
                    <label class="type-label">
                        <input type='checkbox' name='type' value='VisualNovel'>
                        Visual Novel
                    </label><br>
                    <label class="type-label">
                        <input type='checkbox' name='type' value='InteractiveMovie'>
                        Interactive movie
                    </label><br>


                    <label class="type-label">
                        <input type='checkbox' name='type' value='RealTime3DAdventure'>
                        Real Time 3D adventure
                    </label><br>
                    <label class="type-label">
                        <input type='checkbox' name='type' value='Roguelike'>
                        Roguelike
                    </label><br>
                    <label class="type-label">
                        <input type='checkbox' name='type' value='MMO'>
                        MMO(Massively Multiplayer Online)
                    </label><br>
                    <label class="type-label">
                        <input type='checkbox' name='type' value='MMORPG'>
                        MMORPG(Massively Multiplayer Online role-playing games)
                    </label><br>
                    <label class="type-label">
                        <input type='checkbox' name='type' value='ActionRPG'>
                        Action RPG
                    </label><br>


                    <label class="type-label">
                        <input type='checkbox' name='type' value='TacticalRPG'>
                        Tactical RPG
                    </label><br>
                    <label class="type-label">
                        <input type='checkbox' name='type' value='JRPG'>
                        JRPG(Japanese RPG)
                    </label><br>
                    <label class="type-label">
                        <input type='checkbox' name='type' value='FPPBRPG'>
                        FPPBRPG(First-person Party-based RPG)
                    </label><br>
                    <label class="type-label">
                        <input type='checkbox' name='type' value='MonsterTamer'>
                        Monster tamer (like Pokemon)
                    </label><br>
                    <label class="type-label">
                        <input type='checkbox' name='type' value='SandboxRPG'>
                        Sandbox RPG
                    </label><br>


                    <label class="type-label">
                        <input type='checkbox' name='type' value='Sandbox'>
                        Sandbox
                    </label><br>
                    <label class="type-label">
                        <input type='checkbox' name='type' value='OpenWorld'>
                        Open world
                    </label><br>
                    <label class="type-label">
                        <input type='checkbox' name='type' value='ConstructionSim'>
                        Construction and management simulation
                    </label><br>
                    <label class="type-label">
                        <input type='checkbox' name='type' value='LifeSim'>
                        Life simulation
                    </label><br>
                    <label class="type-label">
                        <input type='checkbox' name='type' value='VehicleSim'>
                        Vehicle simulation
                    </label><br>


                    <label class="type-label">
                        <input type='checkbox' name='type' value='DatingSim'>
                        Dating simulation
                    </label><br>
                    <label class="type-label">
                        <input type='checkbox' name='type' value='Eroge'>
                        Eroge(Japanese style Erotic games)
                    </label><br>
                    <label class="type-label">
                        <input type='checkbox' name='type' value='Eroge'>
                        Eroge(Japanese style Erotic games)
                    </label><br>


                    <!--whicht is the level of violence you perceive in this game? (insert a number from 0 to 5 where 0 correspond to "no perceived violence" and 5 correspond to "much perceived violence")
                       how realistic do you think this game is? (from a graphical point of view). Enter a number from 1 to 5 where 1 correspond to "not very real" and 5 correspond to "very real")
                        how realistic do you think this game is? (in terms of game mechanics). Enter a number from 1 to 5 where 1 corresponds to "not very real" and 5 corresponds to "very real"

                    -->


                </div>
                <div >
                    <b>Enter one or two of your current favorite video games (if you have any) and indicate for each one the degree of perceived sexism (from 0 to 5):</b><br>
                    <br>
                    1. <label>
                        <input type='text' name='game1'>
                    </label>

                    Absent sexism <label>
                        <input type='range' name='sexism1' min=1 max=5>
                    </label>
                    Very present sexism


                    2. <label>
                        <input type='text' name='game2'>
                    </label>

                    Absent sexism <label>
                        <input type='range' name='sexism2' min=1 max=5>
                    </label>
                    Very present sexism
                </div><br><br>

                <div style='text-align: center;'>
                    <input type='submit' name='action' Value='Continue'>
                </div>
            </div>
        </form>
    </div>
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
.container {
    display: grid;
    grid-template-columns: 50px 50px 50px 50px 50px;
    grid-template-rows: auto;
    grid-template-areas:
    "header header header header header"
    "main main main main main"
    "main main main main main"
    "main main main main main"
    "main main main main main";
}



    </style>
<?php

// footer HTML and JavaScript codes
include_once "layout_foot.php";
