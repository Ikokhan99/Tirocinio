<?php
// core configuration
include_once 'config/core.php';

include_once 'objects/q2.php';
include_once 'config/Foes.php';
if(debug){
    var_dump($_POST);
}
$page_index = 'q2';

if (!empty($_POST)) {
    if(!fast_debug) {
        include_once 'config/Database.php';
        $database = new Database();
        $db = $database->getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       // $user = new User($db);
        $q2 = new Q2($db,$_SESSION['user-id']);
        $q2->game1->title = test_input($_POST["game1"]);
        $q2->game1->violence = check_int($_POST["violence1"],0,5);
        $q2->gens = $_POST["type"];
        $q2->game1->realism1 = check_int($_POST["realism11"],0,5);
        $q2->game1->realism2 = check_int($_POST["realism12"],0,5);
        $q2->game1->sexism = check_int($_POST["sexism1"],0,5);
        $q2->playtime = check_int($_POST["playtime"],0,4);
        if($_POST["game2"] === '')
        {
            $q2->game2 = null;
        }
        else
        {
            $q2->game2->title = test_input($_POST["game2"]);
            $q2->game2->violence = check_int($_POST["violence2"],0,5);
            $q2->game2->realism1 = check_int($_POST["realism21"],0,5);
            $q2->game2->realism2 = check_int($_POST["realism22"],0,5);
            $q2->game2->sexism = check_int($_POST["sexism2"],0,5);
        }
        if(debug)
        {
            echo "<p>";
            var_dump($q2);
            echo "</p>";
        }
        if (!$q2->create()) {
            die("Server error");
        }
    }
    header("Location: ".home_url."Q1.php?action=goto");
}else
{
    include_once 'q_common.php';
    $_SESSION['visited_pages']['q2'] = true;
}
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
                <div style="grid-row: 2 ;padding: 5px;">
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
                <div class="Q2">
                    <strong>
                    Enter the type of videogames you prefer (you can enter a maximum of 10 preferences)</strong>
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
                        Action RPG (Role-Playing Game)
                    </label>


                    <label style="grid-column: 1; grid-row: 5">
                        <input type='checkbox' name='type[]' value='TacticalRPG'>
                        Tactical RPG (Role-Playing Game)
                    </label>
                    <label style="grid-column: 2; grid-row: 5">
                        <input type='checkbox' name='type[]' value='JRPG'>
                        JRPG(Japanese Role-Playing Game)
                    </label>
                    <label style="grid-column: 3; grid-row: 5">
                        <input type='checkbox' name='type[]' value='FPPBRPG'>
                        FPPBRPG(First-person Party-based Role-Playing Game)
                    </label>
                    <label style="grid-column: 4; grid-row: 5">
                        <input type='checkbox' name='type[]' value='MonsterTamer'>
                        Monster tamer (like Pokemon)
                    </label>
                    <label style="grid-column: 5; grid-row: 5">
                        <input type='checkbox' name='type[]' value='SandboxRPG'>
                        Sandbox RPG (Role-Playing Game)
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
                    <label style="grid-column: 4; grid-row: 7">
                        <input type='checkbox' name='type[]' value='4x'>
                        4X (eXplore, eXpand, eXploit, and eXterminate)
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
                        <input type='checkbox' name='type[]' value='Arcade'>
                        Arcade
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
                        <input type='checkbox' name='type[]' value='Puzzle'>
                        Puzzle game
                    </label>
                    <label style="grid-column: 5; grid-row: 10">
                        <input type='checkbox' name='type[]' value='Other'>
                        Other
                    </label>
                </div>
                <div class="part2"  style="grid-row: 6">
                    <div style="grid-row: 1">
                        <b>Enter one or two of your current favourite video games and indicate for each game the degree to which it contains each of the following characteristics (from 0=absent to 5=very much present):</b>
                    </div>
                    <div style="grid-row: 2">
                        <div class="games">
                         <label style="grid-row: 1;grid-column: 1">
                            Game 1:
                            <input type='text' name='game1' required>
                        </label>
                        <label style="grid-row: 1;grid-column: 2 ;">
                            Gender disparities
                        </label>
                         <label style="grid-row: 1; grid-column: 3">
                              0
                             <input type='range' name='sexism1' min=0 max=5 required>
                             5
                         </label>

                        <label style="grid-row: 2;grid-column: 2 ;">
                            Violence
                        </label>
                        <label style="grid-row: 2; grid-column: 3">
                            0
                            <input type='range' name='violence1' min=0 max=5 required>
                            5
                        </label>

                        <label style="grid-row: 3;grid-column: 2 ;">
                            Game graphics realism
                        </label>
                        <label style="grid-row: 3; grid-column: 3">
                            0
                            <input type='range' name='realism11' min=0 max=5 required>
                            5
                        </label>

                        <label style="grid-row: 4;grid-column: 2 ;">
                            Game mechanics realism
                        </label>
                        <label style="grid-row: 4; grid-column: 3">
                            0
                            <input type='range' name='realism12' min=0 max=5 required>
                            5
                        </label>

                    </div>

                </div>
                <div style="grid-row: 3">
                    <div class="games">
                        <label style="grid-row: 1;grid-column: 1">
                            Game 2:
                            <input type='text' name='game2'>
                        </label>
                        <label style="grid-row: 1;grid-column: 2 ;">
                            Gender disparities
                        </label>
                        <label style="grid-row: 1; grid-column: 3">
                            0
                            <input type='range' name='sexism2' min=0 max=5 required>
                            5
                        </label>
                        <label style="grid-row: 2;grid-column: 2 ;">
                            Violence
                        </label>
                        <label style="grid-row: 2; grid-column: 3">
                            0
                            <input type='range' name='violence2' min=0 max=5 required>
                            5
                        </label>

                        <label style="grid-row: 3;grid-column: 2 ;">
                            Game graphics realism
                        </label>
                        <label style="grid-row: 3; grid-column: 3">
                            0
                            <input type='range' name='realism21' min=0 max=5 required>
                            5
                        </label>

                        <label style="grid-row: 4;grid-column: 2 ;">
                            Game mechanics realism
                        </label>
                        <label style="grid-row: 4; grid-column: 3">
                            0
                            <input type='range' name='realism22' min=0 max=5 required>
                            5
                        </label>
                    </div>
                </div>
            <div class="footer" style="grid-row: 4; justify-items: center">
                <input style=" grid-column: 2;" type="submit" name="action" id="action-q2" tabindex="4" class="form-control btn btn-register" value="Continue">
            </div>
            </div>
        </div>
    </form>

<script>
    $('.options :checkbox').change(function () {
        let $cs = $(this).closest('.options').find(':checkbox:checked');
        if ($cs.length > 10) {
            this.checked = false;
        }
    });
</script>
    <script type="text/javascript">
        loadCSS("libs/CSS/Q2.css");
    </script>

<?php

// footer HTML and JavaScript codes
include_once "layout_foot.php";
