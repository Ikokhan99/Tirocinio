
<html>

<head>
    <title>
        test
    </title>
</head>
<body>


<div class="wrap">
    <div class="cards">
        <div class=" card1"><h3>Card 1</h3>Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition. Organically grow the holistic world view of disruptive innovation via workplace diversity and empowerment.</div>
        <div class=" card2"><h3>Card 2</h3>Bring to the table win-win survival strategies to ensure proactive domination. At the end of the day, going forward, a new normal that has evolved from generation X is on the runway heading towards a streamlined cloud solution.</div>
        <div class=" card3"><h3>Card 3</h3>At the end of the day, going forward, a new normal that has evolved from generation X is on the runway heading towards a streamlined cloud solution. User generated content in real-time will have multiple touchpoints for offshoring. Capitalize on low hanging fruit to identify a ballpark value added activity to beta test.</div>
        <div class=" card4"><h3>Card 4</h3>Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line. At the end of the day, going forward, a new normal that has evolved from generation X is on the runway heading towards a streamlined cloud solution.</div>
        <div class=" card5"><h3>Card 5</h3>Organically grow the holistic world view of disruptive innovation via workplace diversity and empowerment. Bring to the table win-win survival strategies to ensure proactive domination.</div>
    </div>
</div>

<style>

.wrap {
max-width: 100%;
text-align: left;
margin: 0 auto;
}
.main-container {
margin: 0;
padding: 1em;
display: grid;
grid-template-columns: repeat(5, 1fr);
grid-column-gap: 10px;
grid-template-rows: 3% 7% 3% 37% 20% 20% 10%;
grid-template-areas:
"Q1 "
"ans ans ans ans ans"
"q2 q2 q2 q2 q2"
"ans ans ans ans ans"
"q3 q3 q3 q3 q3"
"q4 q4 q4 q4 q4"
"footer footer footer footer footer";
}

body {
    text-align: center;
}

.wrap {
    max-width: 70em;
    text-align: left;
    margin: 0 auto;
}

.cards {
    margin: 0;
    padding: 1em;
   /* display: flex;*/
    /*align-items: center;*/
    display: grid;
    grid-gap: 20px;
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
    grid-template-areas:
    "a a a a a"
    "b b b b b"
    "c c c c c"
    "d d d d d"
    "e e e e e";

}

.card {
    background-color: #1E88E5;
    padding: 2em;
    color: #FFFFFF;
    line-height: 1.4;
    border-radius: 4px;

h3 {
    margin-top: 0;
}
}

.card1 { grid-area: a; }
.card2 { grid-area: b; background-color: #4CAF50; }
.card3 { grid-area: c; background-color: #FFCA28; }
.card4 { grid-area: d; background-color: #F06292; }
.card5 { grid-area: e; background-color: #FF8A80; }

@media only screen and (max-width: 50em) {
    .cards {
        grid-template-columns: 1fr 1fr;

        grid-template-areas:
      "a a"
      "c e"
      "c e"
      "c b"
      "d b";
    }
}

<?php
$_SESSION['visited_pages']['error'] = true;
include_once "layout_foot.php";