$(".burger, .overlay").click(function () {
  $(".burger").toggleClass("clicked");
  $(".overlay").toggleClass("show");
  $("nav").toggleClass("show");
  $("body").toggleClass("overflow");
});

var counter = 1;
setInterval(function () {
  document.getElementById("radio" + counter).checked = true;
  counter++;
  if (counter > 4) {
    counter = 1;
  }
}, 5000);
