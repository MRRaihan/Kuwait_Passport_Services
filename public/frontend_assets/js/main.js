

    var header = document.getElementById("navbarSupportedContent");
    var btns = header.getElementsByClassName("btn1");
    for (var i = 0; i < btns.length; i++) {
      btns[i].addEventListener("click", function() {
      var current = document.getElementsByClassName("active");
      current[0].className = current[0].className.replace(" active", "");
      this.className += " active";
      });
    }

// card1 js file
//     function showMoreLess() {

//     let value = document.querySelector(".show_more").getAttribute("loop_id");
// console.log(value)
//       var dots = document.getElementById("dots"+value);
//       var moreText = document.getElementById("more"+value);
//       var btnText = document.getElementById("myBtn"+value);

//       if (dots.style.display === "none") {
//         dots.style.display = "inline";
//         btnText.innerHTML = "Read more";
//         moreText.style.display = "none";
//       } else {
//         dots.style.display = "none";
//         btnText.innerHTML = "See less";
//         moreText.style.display = "inline";
//       }
//     }
$(document).ready(function () {
    $('.more_text').css('display','none')
    // moreText.style.display = "none";
})
$(document).on('click', '.show_more', function () {
    let value = $(this).attr('loop_id')
    // alert(value)
    var dots = document.getElementById("dots"+value);
    var moreText = document.getElementById("more"+value);
    var btnText = document.getElementById("myBtn"+value);

    if (dots.style.display === "none") {
      dots.style.display = "inline";
      btnText.innerHTML = "Read more";
      moreText.style.display = "none";
    } else {
      dots.style.display = "none";
      btnText.innerHTML = "See less";
      moreText.style.display = "inline";
    }
});


//     $('.navbar-nav>li>a').on('click', function(){
//     $('.navbar-collapse').collapse('hide');
// });

