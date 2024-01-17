<?php
include("head.inc.php");
include("../controllers/3cardpoker_backend.php");
$_SESSION['navbar_option'] = "3cardpoker";
?>

<!doctype html>
<html lang="en">

<head>
    <title>Rum's Casino</title>
</head>
<?php include("../components/navbar.php"); ?>

<body style="background-color: green;">
    <div class="container border" style="margin-top:70px;border-radius: 10px;">
        <?php
        if (isset($_SESSION['3cardpoker_deal'])) {
            if ($_SESSION['3cardpoker_deal'] == "true") {
                $result = deal_cards_for_3cardpoker();
                $_SESSION['3cardpoker_deal'] = "false";
            }
            //echo '<pre>' . var_export($result, true) . '</pre>';
        }
        ?>
        <h4 class="text-white mt-3">Dealer's Hand : <?php echo isset($result["dealer"]) ? $result["dealer"]["name"] : '' ?></h4>
        <?php
        //echo $result["dealer"]["values"][0] . "," . $result["dealer"]["values"][1] . "," . $result["dealer"]["values"][2] . "-";
        //echo $result["dealer"]["cards"][0]['value'] . "," . $result["dealer"]["cards"][1]['value'] . "," . $result["dealer"]["cards"][2]['value'];
        if (isset($result["dealer"]["cards"])) {
            foreach ($result["dealer"]["cards"] as $card) {
        ?>
                <img class="card_for_flip_1" src="images/cards/<?php echo $card['img'] ?>">
        <?php
            }
        }
        ?>
        <hr style="background-color: white;">
        <h4 class="text-white my-3">Player's Hand : <?php echo isset($result["player"]) ? $result["player"]["name"] : '' ?></h4>
        <?php
        //var_dump($result["player"]["values"]);
        if (isset($result["player"]["cards"])) {
            foreach ($result["player"]["cards"] as $card) {
        ?>
                <img class="card_for_flip_1" src="images/cards/<?php echo $card['img'] ?>">
        <?php
            }
        }
        ?>
        <hr style="background-color: white;">
        <?php
        if (isset($result['game_result'])) {
        ?>
            <h3 class="text-white my-3"><?php echo $result['game_result'] ?></h3>
        <?php
        }
        ?>
        <form action="controllers/redirecting_controller.php" method="post">
            <Button id="2" class="btn btn-light mb-3" type="submit" name="action" value="3cardpoker">Deal</Button>
        </form>
    </div>
</body>