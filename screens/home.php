<?php
include("head.inc.php");
?>

<!doctype html>
<html lang="en">

<head>
  <title>Rum's Casino</title>
</head>
<?php include("../components/navbar.php"); ?>

<body>

  <script>
    const sections = document.querySelectorAll("section.section");
    const navLi = document.querySelectorAll("ul#trg li");

    console.log(sections);
    window.onscroll = () => {
      var current = "";

      sections.forEach((section) => {
        const sectionTop = section.offsetTop;
        if (pageYOffset >= sectionTop - 120) {
          current = section.getAttribute("id");
        }
      });



      navLi.forEach((li) => {
        li.classList.remove("active");
        if (li.classList.contains(current)) {
          li.classList.add("active");
        }
      });
    };
  </script>
</body>

</html>