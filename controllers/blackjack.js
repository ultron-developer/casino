var dealer_sum = 0;
var player_sum = 0;

var dealer_ace_count = 0;
var player_ace_count = 0;

var deck;
var hidden;
var can_hit = true;

window.onload = function () {
  build_deck();
  shuffle_deck();
  start_game();
};

function build_deck() {
  let values = [
    "ace",
    "2",
    "3",
    "4",
    "5",
    "6",
    "7",
    "8",
    "9",
    "10",
    "jack",
    "queen",
    "king",
  ];
  let types = ["hearts", "spades", "diamonds", "clubs"];
  deck = [];
  for (let i = 0; i < types.length; i++) {
    for (let j = 0; j < values.length; j++) {
      deck.push(values[j] + "_of_" + types[i]);
    }
  }
}

function shuffle_deck() {
  for (let i = 0; i < deck.length; i++) {
    let j = Math.floor(Math.random() * deck.length);
    let temp = deck[i];
    deck[i] = deck[j];
    deck[j] = temp;
  }
  // console.log(deck);
}

function start_game() {
  let player_card_1 = document.createElement("img");
  let card = deck.pop();
  player_sum += get_value(card);
  player_ace_count += check_ace(card);
  player_card_1.src = "./images/cards/" + card + ".png";
  document.getElementById("player-cards").appendChild(player_card_1);

  let dealer_card_1 = document.createElement("img");
  card = deck.pop();
  let hidden = card;
  dealer_sum += get_value(card);
  dealer_ace_count += check_ace(hidden);
  dealer_card_1.src = "./images/cards/" + "back" + ".png";
  document.getElementById("dealer-cards").appendChild(dealer_card_1);

  let player_card_2 = document.createElement("img");
  card = deck.pop();
  player_sum += get_value(card);
  player_ace_count += check_ace(card);
  player_card_2.src = "./images/cards/" + card + ".png";
  document.getElementById("player-cards").appendChild(player_card_2);

  let dealer_card_2 = document.createElement("img");
  card = deck.pop();
  dealer_sum += get_value(card);
  dealer_ace_count += check_ace(hidden);
  dealer_card_2.src = "./images/cards/" + card + ".png";
  document.getElementById("dealer-cards").appendChild(dealer_card_2);

  document.getElementById("player-sum").innerText =
    "Player's Total : " + player_sum;
  document.getElementById("dealer-sum").innerText =
    "Dealer's Total : " + dealer_sum;
}

function get_value(card) {
  let data = card.split("_of_");
  let value = data[0];
  if (isNaN(value)) {
    if (value == "ace") {
      return 11;
    }
    return 10;
  }
  return parseInt(value);
}

function check_ace(card) {
  let data = card.split("_of_");
  if (data[0] == "ace") {
    return 1;
  }
  return 0;
}
