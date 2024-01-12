<?php

include("singledeck.php");

function deal_cards_for_3cardpoker()
{
    $cards = generate_a_deck_of_cards();
    $player_cards = array();
    $dealer_cards = array();

    for ($i = 1; $i <= 3; $i++) {
        array_push($player_cards, $cards[0]);
        array_shift($cards);
        array_push($dealer_cards, $cards[0]);
        array_shift($cards);
    }

    // $player_cards[0] = ["img" => "7_of_hearts.png", "value" => 7, "suit" => "hearts"];
    // $player_cards[1] = ["img" => "king_of_hearts.png", "value" => 13, "suit" => "hearts"];
    // $player_cards[2] = ["img" => "ace_of_hearts.png", "value" => 14, "suit" => "hearts"];

    // $dealer_cards[0] = ["img" => "2_of_spades.png", "value" => 2, "suit" => "spades"];
    // $dealer_cards[1] = ["img" => "king_of_spades.png", "value" => 13, "suit" => "spades"];
    // $dealer_cards[2] = ["img" => "ace_of_spades.png", "value" => 14, "suit" => "spades"];

    $player_points = validate_cards($player_cards);
    $dealer_points = validate_cards($dealer_cards);

    $player = ["cards" => $player_cards, "points" => $player_points["hand_points"], "name" => $player_points["hand_name"], "values" => $player_points["values"]];
    $dealer = ["cards" => $dealer_cards, "points" => $dealer_points["hand_points"], "name" => $dealer_points["hand_name"], "values" => $dealer_points["values"]];

    if ($player["points"] > $dealer["points"]) {
        $game_result = "Player Win!";
    } elseif ($player["points"] < $dealer["points"]) {
        $game_result = "Dealer Win!";
    } else {
        if ($player["points"] == 5) {
            if ($player['values'][2] > $dealer['values'][2]) {
                $game_result = "Player Win! (Higher hand)";
            } elseif ($player['values'][2] < $dealer['values'][2]) {
                $game_result = "Dealer Win! (Higher hand)";
            } else {
                $game_result = "Tie!";
            }
        } elseif ($player["points"] == 2) {
            if ($player['values'][1] > $dealer['values'][1]) {
                $game_result = "Player Win! (Higher Pair)";
            } elseif ($player['values'][1] < $dealer['values'][1]) {
                $game_result = "Dealer Win! (Higher Pair)";
            } else {
                ($player['values'][1] == $player['values'][0]) ? $player_3rdcard = $player['values'][2] : $player_3rdcard = $player['values'][0];
                ($dealer['values'][1] == $dealer['values'][0]) ? $dealer_3rdcard = $dealer['values'][2] : $dealer_3rdcard = $dealer['values'][0];
                if ($player_3rdcard > $dealer_3rdcard) {
                    $game_result = "Player Win! (Higher Kicker Card)";
                } elseif ($player_3rdcard < $dealer_3rdcard) {
                    $game_result = "Dealer Win! (Higher Kicker Card)";
                } else {
                    $game_result = "Tie!";
                }
            }
        } elseif ($player["points"] == 3 || $player["points"] == 1) {
            if ($player['values'][2] > $dealer['values'][2]) {
                $game_result = "Player Win! (Higher Card)";
            } elseif ($player['values'][2] < $dealer['values'][2]) {
                $game_result = "Dealer Win! (Higher Card)";
            } else {
                if ($player['values'][1] > $dealer['values'][1]) {
                    $game_result = "Player Win! (Higher Second Kicker Card)";
                } elseif ($player['values'][1] < $dealer['values'][1]) {
                    $game_result = "Dealer Win! (Higher Second Kicker Card)";
                } else {
                    if ($player['values'][0] > $dealer['values'][0]) {
                        $game_result = "Player Win! (Higher Third Kicker Card)";
                    } elseif ($player['values'][0] < $dealer['values'][0]) {
                        $game_result = "Dealer Win! (Higher Third Kicker Card)";
                    } else {
                        $game_result = "Tie!";
                    }
                }
            }
        } elseif ($player["points"] == 6 || $player["points"] == 4) {
            if (in_array(14, $player['values']) & in_array(14, $dealer['values'])) {
                if ($player['values'][1] > $dealer['values'[1]]) {
                    $game_result = "Player Win!";
                } elseif ($player['values'][1] < $dealer['values'[1]]) {
                    $game_result = "Dealer Win!";
                } else {
                    $game_result = "Tie!";
                }
            } else {
                if ($player['values'][2] > $dealer['values'[2]]) {
                    $game_result = "Player Win!";
                } elseif ($player['values'][2] < $dealer['values'[2]]) {
                    $game_result = "Dealer Win!";
                } else {
                    $game_result = "Tie!";
                }
            }
        } else {
            $game_result = "Tie!";
        }
    }
    return ["player" => $player, "dealer" => $dealer, "game_result" => $game_result];
}

function validate_cards($cards)
{
    $card_values[0] = $cards[0]['value'];
    $card_values[1] = $cards[1]['value'];
    $card_values[2] = $cards[2]['value'];
    sort($card_values);

    if ($cards[0]['suit'] == $cards[1]['suit'] && $cards[0]['suit'] == $cards[2]['suit']) {
        if (check_straight($card_values)) {
            $hand_name = "Straight Flush";
            $hand_points = 6;
        } else {
            $hand_name = "Flush";
            $hand_points = 3;
        }
    } elseif ($card_values[0] == $card_values[1] & $card_values[0] == $card_values[2]) {
        $hand_name = "3 Of A Kind";
        $hand_points = 5;
    } elseif (check_straight($card_values)) {
        $hand_name = "Straight";
        $hand_points = 4;
    } elseif ($card_values[0] == $card_values[1] || $card_values[0] == $card_values[2] || $card_values[1] == $card_values[2]) {
        $hand_name = "Pair";
        $hand_points = 2;
    } else {
        $hand_name = "High Card";
        $hand_points = 1;
    }

    return ["hand_points" => $hand_points, "hand_name" => $hand_name, "values" => $card_values];
}

function check_straight($values)
{

    if (in_array(14, $values)) {
        if ((in_array(2, $values) & in_array(3, $values)) || (in_array(12, $values) & in_array(13, $values))) {
            $hand_straight = true;
        } else {
            $hand_straight = false;
        }
    } elseif (($values[2] - $values[1] == 1) & ($values[1] - $values[0] == 1)) {
        $hand_straight = true;
    } else {
        $hand_straight = false;
    }

    return $hand_straight;
}
