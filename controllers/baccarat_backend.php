<?php

function minus_10($value)
{
    while ($value >= 10) {
        $value -= 10;
    }
    return $value;
}

function deal_cards_for_baccarat($cards)
{
    $banker_cards = array();
    $banker_total = 0;
    $player_cards = array();
    $player_total = 0;
    array_push($player_cards, $cards[0]);
    $player_total += $cards[0]['value'];
    array_shift($cards);
    array_push($banker_cards, $cards[0]);
    $banker_total += $cards[0]['value'];
    array_shift($cards);
    array_push($player_cards, $cards[0]);
    $player_total += $cards[0]['value'];
    array_shift($cards);
    array_push($banker_cards, $cards[0]);
    $banker_total += $cards[0]['value'];
    array_shift($cards);

    $player_total = minus_10($player_total);
    $banker_total = minus_10($banker_total);

    if ($player_total < 8 & $banker_total < 8) {
        if ($player_total <= 5) {
            array_push($player_cards, $cards[0]);
            $player_total += $cards[0]['value'];
            $player_third_card = $cards[0]['value'];
            array_shift($cards);

            if ($banker_total <= 6) {
                if ($banker_total <= 2) {
                    array_push($banker_cards, $cards[0]);
                    $banker_total += $cards[0]['value'];
                    array_shift($cards);
                } elseif ($banker_total == 3 & $player_third_card != 8) {
                    array_push($banker_cards, $cards[0]);
                    $banker_total += $cards[0]['value'];
                    array_shift($cards);
                } elseif ($banker_total == 4 & ($player_third_card >= 2 & $player_third_card <= 7)) {
                    array_push($banker_cards, $cards[0]);
                    $banker_total += $cards[0]['value'];
                    array_shift($cards);
                } elseif ($banker_total == 5 & ($player_third_card >= 4 & $player_third_card <= 7)) {
                    array_push($banker_cards, $cards[0]);
                    $banker_total += $cards[0]['value'];
                    array_shift($cards);
                } elseif ($banker_total == 6 & ($player_third_card == 6 || $player_third_card == 7)) {
                    array_push($banker_cards, $cards[0]);
                    $banker_total += $cards[0]['value'];
                    array_shift($cards);
                }
            }
        }

        $player_total = minus_10($player_total);

        if ($player_total >= 6 & $banker_total <= 5 & count($banker_cards) < 3) {
            array_push($banker_cards, $cards[0]);
            $banker_total += $cards[0]['value'];
            array_shift($cards);
        }
    }

    $player_total = minus_10($player_total);
    $banker_total = minus_10($banker_total);

    if ($player_total > $banker_total) {
        if ($player_total >= 8 & count($player_cards) == 2) {
            $result = "Player Win (Natural Win)";
            array_push($_SESSION['baccarat_history'], "P");
        } else {
            $result = "Player Win";
            array_push($_SESSION['baccarat_history'], "P");
        }
    } elseif ($player_total < $banker_total) {
        if ($banker_total >= 8 & count($banker_cards) == 2) {
            $result = "Banker Win (Natural Win)";
            array_push($_SESSION['baccarat_history'], "B");
        } else {
            $result = "Banker Win";
            array_push($_SESSION['baccarat_history'], "B");
        }
    } else {
        $result = "Tie !";
        array_push($_SESSION['baccarat_history'], "T");
    }

    return ["cards" => $cards, "banker_cards" => $banker_cards, "banker_total" => $banker_total, "player_cards" => $player_cards, "player_total" => $player_total, "result" => $result];
}
