<?php

function generate_a_deck_of_cards()
{
    $cards_faces = array(
        ["face" => "ace", "value" => 14],
        ["face" => "2", "value" => 2],
        ["face" => "3", "value" => 3],
        ["face" => "4", "value" => 4],
        ["face" => "5", "value" => 5],
        ["face" => "6", "value" => 6],
        ["face" => "7", "value" => 7],
        ["face" => "8", "value" => 8],
        ["face" => "9", "value" => 9],
        ["face" => "10", "value" => 10],
        ["face" => "jack", "value" => 11],
        ["face" => "queen", "value" => 12],
        ["face" => "king", "value" => 13],
    );
    $suits = [
        "spades", "hearts", "clubs", "diamonds"
    ];
    $deck = array();
    $cards = array();
    foreach ($cards_faces as $card_face) {
        foreach ($suits as $suit) {
            $card = ["img" => $card_face["face"] . "_of_" . $suit . ".png", "value" => $card_face["value"], "suit" => $suit];
            array_push($deck, $card);
        }
    }
    shuffle($deck);
    return $deck;
}
