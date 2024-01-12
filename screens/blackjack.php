<?php
include("head.inc.php");
include("../controllers/deckofcards.php");
$_SESSION['navbar_option'] = "blackjack";
?>

<!doctype html>
<html lang="en">

<head>
    <title>Rum's Casino</title>
    <script src="controllers/blackjack.js"></script>
</head>
<?php include("../components/navbar.php"); ?>

<body style="background-color: green;">
    <div class="container border" style="margin-top:70px;border-radius: 10px;">
        <h4 class="text-white mt-3">Dealer's Hand :</h4>
        <hr style="background-color: white;">
        <h4 class="text-white my-3">Player's Hand :</h4>
        <hr style="background-color: white;">
        <Button id="bj_hit" class="btn btn-light mb-3">Hit</Button>
        <Button id="bj_2x" class="btn btn-light mb-3">2x Down</Button>
        <Button id="bj_stand" class="btn btn-light mb-3">Stand</Button>
        <Button id="bj_split" class="btn btn-light mb-3">Split</Button>
        <?php $test = [1, 2, 3, 4]; ?>
    </div>
    <script type="text/javascript">
        var j = new Array(<?php echo json_encode($_SESSION); ?>);;
        console.log(j);
    </script>
</body>