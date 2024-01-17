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
        <h4 id="dealer-sum" class="text-white mt-3">Dealer's Total :</h4>
        <div class="bj_card_div" id="dealer-cards"></div>
        <hr style="background-color: white;">
        <h4 id="player-sum" class="text-white my-3">Player's Total :</h4>
        <div class="bj_card_div" id="player-cards"></div>
        <h4 id="bj-result" class="text-white my-3" style="display: none;">Result :</h4>
        <div class="mt-2" id="split-btns1" style="display: none;">
            <Button id="split_hit1" class="btn btn-light">Hit</Button>
            <Button id="split_stay1" class="btn btn-light">Stay</Button>
        </div>
        <h4 id="player-sum2" class="text-white my-3" style="display: none;">Player's Total :</h4>
        <div class="bj_card_div mt-2" id="player-cards2"></div>
        <h4 id="bj-result2" class="text-white my-3" style="display: none;">Result :</h4>
        <div class="mt-2" id="split-btns2" style="display: none;">
            <Button id="split_hit2" class="btn btn-light mb-3">Hit</Button>
            <Button id="split_stay2" class="btn btn-light mb-3">Stay</Button>
        </div>
        <hr style="background-color: white;">
        <div id="original-btns">
            <Button id="bj_deal" class="btn btn-light mb-3">Deal</Button>
            <Button id="bj_hit" style="display: none;" class="btn btn-light mb-3">Hit</Button>
            <Button id="bj_2x" style="display: none;" class="btn btn-light mb-3">2x Down</Button>
            <Button id="bj_stay" style="display: none;" class="btn btn-light mb-3">Stay</Button>
            <Button id="bj_split" style="display: none;" class="btn btn-light mb-3">Split</Button>
        </div>
        <?php $test = [1, 2, 3, 4]; ?>
    </div>
    <script type="text/javascript">
        var j = new Array(<?php echo json_encode($_SESSION); ?>);
    </script>
</body>