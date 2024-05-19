$(function() {

     // Hide Message After Couple Seconds 

     setTimeout(function() {
      $('.msg').fadeOut("slow")
    },"5000")

    // Check If Element Has Active Show Its Elements
    $('.show-skills .toggles span.clicked').each(function() {
        
        let datatype = $(this).data('type');

        if(datatype == 'all') {

          $('.skills-box .skill').show();

        }else {

          $('.skills-box .skill').hide();
          $('.skills-box .skill[data-type="' + datatype + '"]').show();

        }

    })
        
    // Show Element That Belongs to this section when click on
    $('.show-skills .toggles span').click(function() {
        
        $(this).addClass("clicked").siblings().removeClass("clicked")

        let datatype = $(this).data('type');

        if(datatype == 'all') {

          $('.skills-box .skill').show();

        }else {

          $('.skills-box .skill').hide();
          $('.skills-box .skill[data-type="' + datatype + '"]').show();

        }
    })

    // Get Page Name From Href

    
    let linkName = window.location.pathname;
    let link = linkName.split('/')[linkName.split('/').length - 1]
    let pagename = link.split('.')[0];

    $('.paths .link-1').attr("href", window.location.href).css("color", "#0093E9").text(pagename.toUpperCase())

     // Add active class on nav item
      $('.navbar-nav .nav-link').each(function() {
        last = this.href.substring(this.href.lastIndexOf("/") + 1)
        if(last == link) {
          $(this).addClass('active');
        }
     })

  
    // Auto type
    if(link == 'index.php' || link == '') {
      var typed = new Typed('.typing', {
        strings: ['مطور واجهات أمامية.', 'مطور واجهات خلفية.'],
        typeSpeed: 100,
        loop: true,
        showCursor: false,
      });
    }
    
    document.body.onclick = function (e) {

      let navBtn = $("#navbarNavDropdown");

      let navbar = $(".navbar")[0];

      if(e.target != navbar) {
        navBtn.removeClass('show')
      }
    }

    // Setup Swiper  
    var swiper = new Swiper(".mySwiper", {
        autoplay: {
            delay: 3000, // Delay between slides in milliseconds
            disableOnInteraction: false // Autoplay continues even when user interacts with the slider
          },
        pagination: {
          el: ".swiper-pagination",
          dynamicBullets: true,
        },
      });
})


// Review Stars

// Star Ratings code 
let starRatings = document.querySelectorAll('.star_review i');
let ratingValue = document.getElementById('ratingValue')

starRatings.forEach((star, index) => {
  star.addEventListener('click', (e) => {
      // Retrieve the index of the clicked star
      starRatings.forEach(e => {
        e.classList.replace('fa-solid', 'fa-regular')
        if(e.dataset.rating == index || e.dataset.rating < index) {
          e.classList.replace('fa-regular', 'fa-solid')
          ratingValue.value = index + 1;
        }
      })
  });
});