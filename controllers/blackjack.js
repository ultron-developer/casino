var dealer_sum = 0;
const player_sum_array = [];
const player_card_values = [];
player_sum_array[0] = 0;
player_sum_array[1] = 0;

var dealer_ace_count = 0;
const player_ace_counts = [];
player_ace_counts[0] = 0;
player_ace_counts[1] = 0;

var deck;
var hidden;
var splited = false;
var playing_secong_hand = false;
var can_hit = true;
var can_deal = true;
var can_double_down = true;
var result = "";
var i = 1;

window.onload = function () {
  build_deck();
  shuffle_deck();
  btn_deal_show_rest_hide();
  document.getElementById("bj_deal").addEventListener("click", deal);
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
}

function deal() {
  document.getElementById("player-sum2").style.display = "none";
  btn_deal_hide_rest_show();
  if (!can_deal) {
    return;
  }
  if (deck.length < 15) {
    build_deck();
    shuffle_deck();
  }
  i = 1;
  player_card_values.splice(0, player_card_values.length);
  can_hit = true;
  can_double_down = true;
  player_ace_counts[0] = 0;
  player_ace_counts[1] = 0;
  dealer_ace_count = 0;
  player_sum_array[0] = 0;
  player_sum_array[1] = 0;
  dealer_sum = 0;
  result = "";
  document.getElementById("player-cards").replaceChildren();
  document.getElementById("dealer-cards").replaceChildren();
  document.getElementById("player-cards2").replaceChildren();
  document.getElementById("bj-result").innerText = "Result : " + result;
  can_deal = false;
  console.log(player_sum_array);
  console.log(player_card_values);
  start_game();
}

function start_game() {
  let player_card_1 = document.createElement("img");
  let card = deck.pop();
  //card = "ace_of_spades";
  player_sum_array[0] += get_value(card);
  player_card_values[0] = get_value(card);
  player_ace_counts[0] += check_ace(card);
  player_card_1.src = "./images/cards/" + card + ".png";
  document.getElementById("player-cards").appendChild(player_card_1);

  let dealer_card_1 = document.createElement("img");
  dealer_card_1.id = "hidden";
  card = deck.pop();
  hidden = card;
  dealer_sum += get_value(card);
  dealer_ace_count += check_ace(card);
  dealer_card_1.src = "./images/cards/" + "back" + ".png";
  document.getElementById("dealer-cards").appendChild(dealer_card_1);

  let player_card_2 = document.createElement("img");
  card = deck.pop();
  //card = "ace_of_hearts";
  player_sum_array[0] += get_value(card);
  player_card_values[1] = get_value(card);
  player_ace_counts[0] += check_ace(card);
  player_card_2.src = "./images/cards/" + card + ".png";
  document.getElementById("player-cards").appendChild(player_card_2);

  let dealer_card_2 = document.createElement("img");
  card = deck.pop();
  //card = "ace_of_spades";
  dealer_sum += get_value(card);
  dealer_ace_count += check_ace(card);
  dealer_card_2.src = "./images/cards/" + card + ".png";
  document.getElementById("dealer-cards").appendChild(dealer_card_2);

  document.getElementById("bj_hit").addEventListener("click", hit);
  document.getElementById("bj_stay").addEventListener("click", stay);
  document.getElementById("bj_2x").addEventListener("click", double_down);
  document.getElementById("bj_split").addEventListener("click", split);

  document.getElementById("player-sum").innerText =
    "Player's Total : " + player_sum_array[0];
  document.getElementById("dealer-sum").innerText = "Dealer's Total : ?";

  if (dealer_sum == 21) {
    dealer_bj();
  }
  if (player_sum_array[0] == 21) {
    player_bj();
  }
  if (player_sum_array[0] == 22) {
    document.getElementById("player-sum").innerText =
      "Player's Total : " + "12";
  }

  check_split_available();
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

function hit() {
  document.getElementById("bj_split").style.display = "none";
  document.getElementById("bj_2x").style.display = "none";
  if (!can_hit) {
    return;
  } else {
    let player_card = document.createElement("img");
    let card = deck.pop();
    player_card_values.push(get_value(card));
    if (playing_secong_hand) {
      player_ace_counts[1] += check_ace(card);
      player_sum_array[1] += get_value(card);
      while (player_sum_array[1] > 21 && player_ace_counts[1] > 0) {
        player_sum_array[1] -= 10;
        player_ace_counts[1] -= 1;
      }
      player_card.src = "./images/cards/" + card + ".png";
      document.getElementById("player-cards2").appendChild(player_card);
    } else {
      player_ace_counts[0] += check_ace(card);
      player_sum_array[0] += get_value(card);
      while (player_sum_array[0] > 21 && player_ace_counts[0] > 0) {
        player_sum_array[0] -= 10;
        player_ace_counts[0] -= 1;
      }
      player_card.src = "./images/cards/" + card + ".png";
      document.getElementById("player-cards").appendChild(player_card);
    }
  }
  if (player_sum_array[0] >= 21) {
    if (splited) {
      trigger_split_btns2();
    } else {
      stay();
    }
  }
  if (player_sum_array[1] >= 21) {
    stay();
  }
  document.getElementById("player-sum").innerText =
    "Player's Total : " + player_sum_array[0];
  document.getElementById("player-sum2").innerText =
    "Player's Total : " + player_sum_array[1];
}

function reduce_ace(sum, ace_count) {
  while (sum > 21 && ace_count > 0) {
    sum -= 10;
    ace_count -= 1;
  }
  return sum;
}

function player_bj() {
  can_hit = false;
  can_deal = true;
  btn_deal_show_rest_hide();
  document.getElementById("hidden").src = "./images/cards/" + hidden + ".png";
  if (dealer_sum == 21) {
    result = "Its a Push!";
  } else {
    result = "BlackJack for Player !!";
  }
  document.getElementById("dealer-sum").innerText =
    "Dealer's Total : " + dealer_sum;
  document.getElementById("bj-result").style.display = "block";
  document.getElementById("bj-result").innerText = "Result : " + result;
}

function dealer_bj() {
  can_hit = false;
  can_deal = true;
  btn_deal_show_rest_hide();
  document.getElementById("hidden").src = "./images/cards/" + hidden + ".png";
  if (player_sum_array[0] == 21) {
    result = "Its a Push!";
  } else {
    result = "BlackJack for Dealer !!";
  }
  document.getElementById("dealer-sum").innerText =
    "Dealer's Total : " + dealer_sum;
  document.getElementById("bj-result").style.display = "block";
  document.getElementById("bj-result").innerText = "Result : " + result;
}

function double_down() {
  if (!can_double_down) {
    return;
  }
  can_double_down = false;
  let player_card = document.createElement("img");
  let card = deck.pop();
  player_ace_counts[0] += check_ace(card);
  player_sum_array[0] += get_value(card);
  while (player_sum_array[0] > 21 && player_ace_counts[0] > 0) {
    player_sum_array[0] -= 10;
    player_ace_counts[0] -= 1;
  }
  player_card.src = "./images/cards/" + card + ".png";
  document.getElementById("player-cards").appendChild(player_card);
  document.getElementById("player-sum").innerText =
    "Player's Total : " + player_sum_array[0];
  stay();
}

function stay() {
  can_hit = false;
  can_double_down = false;
  playing_secong_hand = false;
  btn_deal_show_rest_hide();
  can_deal = true;
  document.getElementById("hidden").src = "./images/cards/" + hidden + ".png";
  i = 1;
  if (player_card_values.length == 2 && player_sum_array[0] == 22) {
    player_sum_array[0] = 12;
  }
  while (dealer_sum < 17 && player_sum_array[0] < 22) {
    let dealer_card_2 = document.createElement("img");
    card = deck.pop();
    dealer_sum += get_value(card);
    dealer_ace_count += check_ace(card);
    if (dealer_sum > 21 && dealer_ace_count > 0) {
      dealer_sum -= 10;
      dealer_ace_count -= 1;
    }
    dealer_card_2.src = "./images/cards/" + card + ".png";
    document.getElementById("dealer-cards").appendChild(dealer_card_2);
    i++;
  }
  get_result1();
  document.getElementById("bj-result").style.display = "block";
  if (splited) {
    get_result2();
    splited = false;
    document.getElementById("bj-result2").style.display = "block";
  }
  document.getElementById("dealer-sum").innerText =
    "Dealer's Total : " + dealer_sum;
}

function get_result1() {
  if (player_sum_array[0] > 21) {
    result = "Player Bust1! Dealer Win.";
  } else if (dealer_sum > 21) {
    result = "Dealer Bust! Player Win.";
  } else if (player_sum_array[0] == dealer_sum) {
    result = "Its a Push!";
  } else if (player_sum_array[0] > dealer_sum) {
    result = "Player Win!";
  } else {
    result = "Dealer Win!";
  }
  document.getElementById("bj-result").innerText = "Result : " + result;
}
function get_result2() {
  if (player_sum_array[1] > 21) {
    result = "Player Bust2! Dealer Win.";
  } else if (dealer_sum > 21) {
    result = "Dealer Bust! Player Win.";
  } else if (player_sum_array[1] == dealer_sum) {
    result = "Its a Push!";
  } else if (player_sum_array[1] > dealer_sum) {
    result = "Player Win!";
  } else {
    result = "Dealer Win!";
  }
  document.getElementById("bj-result2").innerText = "Result : " + result;
}

function btn_deal_show_rest_hide() {
  document.getElementById("bj_deal").style.display = "inline-block";
  document.getElementById("bj_hit").style.display = "none";
  document.getElementById("bj_stay").style.display = "none";
  document.getElementById("bj_2x").style.display = "none";
  document.getElementById("bj_split").style.display = "none";
  document.getElementById("split-btns1").style.display = "none";
  document.getElementById("split-btns2").style.display = "none";
  document.getElementById("original-btns").style.display = "block";
}

function btn_deal_hide_rest_show() {
  document.getElementById("bj_deal").style.display = "none";
  document.getElementById("bj_hit").style.display = "inline-block";
  document.getElementById("bj_stay").style.display = "inline-block";
  document.getElementById("bj_2x").style.display = "inline-block";
  document.getElementById("bj_split").style.display = "none";
  document.getElementById("bj-result").style.display = "none";
  document.getElementById("bj-result2").style.display = "none";
  document.getElementById("split-btns1").style.display = "none";
  document.getElementById("split-btns2").style.display = "none";
}

function check_split_available() {
  if (
    player_card_values[player_card_values.length - 1] ==
      player_card_values[player_card_values.length - 2] &&
    dealer_sum != 21
  ) {
    document.getElementById("bj_split").style.display = "inline-block";
  }
}

function split() {
  splited = true;
  player_sum_array[0] -= player_card_values[0];
  document.getElementById("player-sum").innerText =
    "Player's Total : " + player_sum_array[0];
  player_sum_array[1] = player_card_values[0];
  document.getElementById("player-sum2").style.display = "block";
  document.getElementById("player-sum2").innerText =
    "Player's Total : " + player_sum_array[1];
  document.getElementById("split-btns1").style.display = "block";
  document.getElementById("original-btns").style.display = "none";

  if (player_card_values[0] == 11) {
    player_ace_counts[0] = 1;
    player_ace_counts[1] = 1;
  }

  document.getElementById("split_hit1").addEventListener("click", hit);
  document.getElementById("split_hit2").addEventListener("click", hit);
  document.getElementById("split_stay2").addEventListener("click", stay);
  document
    .getElementById("split_stay1")
    .addEventListener("click", trigger_split_btns2);

  console.log(player_ace_counts);
  const list = document.getElementById("player-cards");
  document.getElementById("player-cards2").appendChild(list.children[1]);
}

function trigger_split_btns2() {
  playing_secong_hand = true;
  document.getElementById("split-btns1").style.display = "none";
  document.getElementById("split-btns2").style.display = "block";
}
