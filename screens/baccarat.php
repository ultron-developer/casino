<?php
include("head.inc.php");
include("../controllers/deckofcards.php");
include("../controllers/baccarat_backend.php");
$_SESSION['navbar_option'] = "baccarat";
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
        if (isset($_SESSION['deck_baccarat'])) {
            $cards = $_SESSION['deck_baccarat'];
        }
        if (!isset($cards)) {
            $cards = generate_set_of_cards(4);
        } else {
            if (count($cards) < 6) {
                $cards = generate_set_of_cards(4);
            }
        }
        if (isset($_SESSION['baccarat_deal'])) {
            if ($_SESSION['baccarat_deal'] == "true") {
                $returned_array = deal_cards_for_baccarat($cards);
                $_SESSION['baccarat_deal'] = "false";
            }
        }
        ?>
        <!-- <p class="text-white mt-3">Cards left in the set : <?php echo isset($returned_array["cards"]) ? count($returned_array["cards"]) : count($cards) ?></p>
        <hr style="background-color: white;"> -->
        <h4 class="text-white my-3">Player's Total : <?php echo isset($returned_array["player_total"]) ? $returned_array["player_total"] : '' ?></h4>
        <?php
        if (isset($returned_array["player_cards"])) {
            $flag = 0;
            foreach ($returned_array["player_cards"] as $card) {
                $flag++;
        ?>
                <img class="card_for_flip_1" style="height: 100px;<?php echo $flag == 3 ? "transform: rotate(90deg);margin-left:16px;" : ""; ?>" src="images/cards/<?php echo $card['img'] ?>">
        <?php
            }
        }
        ?>
        <hr style="background-color: white;">
        <h4 class="text-white my-3">Banker's Total : <?php echo isset($returned_array["banker_total"]) ? $returned_array["banker_total"] : '' ?></h4>
        <?php
        if (isset($returned_array["banker_cards"])) {
            $flag = 0;
            foreach ($returned_array["banker_cards"] as $card) {
                $flag++;
        ?>
                <img class="card_for_flip_1" style="height: 100px;<?php echo $flag == 3 ? "transform: rotate(90deg);margin-left:16px;" : ""; ?>" src="images/cards/<?php echo $card['img'] ?>">
        <?php
            }
        }
        ?>
        <hr style="background-color: white;">
        <?php
        if (isset($returned_array['result'])) {
        ?>
            <h3 class="text-white my-3"><?php echo $returned_array['result'] ?></h3>
        <?php
        }
        ?>
        <form action="controllers/redirecting_controller.php" method="post">
            <input type="hidden" name="deal_baccarat" value="true">
            <?php if (isset($returned_array["cards"])) {
                $_SESSION['deck_baccarat'] = $returned_array["cards"];
            }
            ?>
            <Button id="2" class="btn btn-light mb-3" type="submit" name="action" value="baccarat">Deal</Button>
        </form>
    </div>
    <div class="container bg-white baccarat_per_show text-center">
        <div>
            <?php if (isset($_SESSION['baccarat_history'])) {
                $values = array_count_values($_SESSION['baccarat_history']);
                $P_percentage = round($values["P"] / count($_SESSION['baccarat_history']) * 100, 2);
                $T_percentage = round($values["T"] / count($_SESSION['baccarat_history']) * 100, 2);
                $B_percentage = round($values["B"] / count($_SESSION['baccarat_history']) * 100, 2);
            } ?>
            <p class="result_baccarat_p">P: <?php echo $P_percentage ?>%</p>
            <p class="result_baccarat_t">T: <?php echo $T_percentage ?>%</p>
            <p class="result_baccarat_b">B: <?php echo $B_percentage ?>%</p>
        </div>
        <hr>
        <h5>Previous Results:</h5>
        <?php
        if (isset($_SESSION['baccarat_history'])) {
            $results = $_SESSION['baccarat_history'];
            $results = array_reverse($results);
            foreach ($results as $pre_result) {
                if ($pre_result == "P") {
                    echo "<p class='result_baccarat_p'>" . $pre_result . "</p>";
                } elseif ($pre_result == "B") {
                    echo "<p class='result_baccarat_b'>" . $pre_result . "</p>";
                } else {
                    echo "<p class='result_baccarat_t'>" . $pre_result . "</p>";
                }
            }
        }
        ?>
    </div>
</body>