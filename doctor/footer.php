<div class="container-fluid bg-white mt-5">
  <div class="row">
    
    
   
<h6 class="bg-dark text-center text-white p-2 pt-3 mb-0"><p>copyright © 2021 Rakshak | All rights reserved.</p>
  </h6>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script>
      
      var swiper = new Swiper(".mySwiper", {
        spaceBetween: 30,
        effect: "fade",
        loop :true,
        autoplay:
        {
         delay:2000,
         displayOnInteraction:false
        }
      });
    </script>
     <script>
      var swiper = new Swiper(".mySwiper-testimonials", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "3",
        loop: true,
        coverflowEffect: {
          rotate: 50,
          stretch: 0,
          depth: 100,
          modifier: 1,
          slideShadows: false,
        },
        
        autoplay:
        {
         delay:1000,
         displayOnInteraction:false
        },
        //for mobile devices
        breakpoints:{
          320:
        {
          slidesPerView:1,
        },
        768:
        {
          slidesPerView:2,
        },
        640:
        {
          slidesPerView:1,
        }
      },
        pagination: {
          el: ".swiper-pagination",
        },
      });
      let register_form =document.getElementById('register-form');
      register_form.addEventListener('submit',(e)=>{
        e.preventDefault();
        let data = new FormData();
        data.append('name',register_form.elements['name'].value);
        data.append('email',register_form.elements['email'].value);
        data.append('phonenum',register_form.elements['phonenum'].value);
        data.append('pincode',register_form.elements['pincode'].value);
        data.append('dob',register_form.elements['dob'].value);
        data.append('pass',register_form.elements['pass'].value);
        data.append('cpass',register_form.elements['cpass'].value);
        data.append('profile',register_form.elements['profile'].files(0));
        data.append('register','');
        var myModal = document.getElementById('edit-room');
        var modal = boostrap.Modal.getInstance(myModal);
        modal.hide();
        let xhr = new XMLHttRequest();
        xhr.open("POST", "ajax/login_register.php",true);
        xhr.onload = function()
        {
          
        }

        })

      setActive();
    </script>