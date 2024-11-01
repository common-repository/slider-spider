<?php 
//echo json_encode($images=[1,1,1,1,]);?>
<div class="swiper-container gallery-top">
  <div class="swiper-wrapper">
    <?php foreach($images as $image ): ?> 
      <div class="swiper-slide">            
        <img class="slider-image" src="<?php echo $image?>" alt="no img">
      </div>
    <?php endforeach; ?>
  </div>
  <!-- Add Arrows -->
  <div class="swiper-button-next swiper-button-white"></div>
  <div class="swiper-button-prev swiper-button-white"></div>
</div>
<div class="swiper-container gallery-thumbs">
  <div class="swiper-wrapper">
    <?php foreach( $images as $image ): ?>  
      <div class="swiper-slide">            
        <img class="slider-image" src="<?php echo $image?>" alt="no img">
      </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- Swiper JS -->
<script src="../dist/js/swiper.min.js"></script>

<!-- Initialize Swiper -->
<script>
  var galleryTop = new Swiper('.gallery-top', {
    spaceBetween: 10,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });
  var galleryThumbs = new Swiper('.gallery-thumbs', {
    spaceBetween: 10,
    centeredSlides: true,
    slidesPerView: 'auto',
    touchRatio: 0.2,
    slideToClickedSlide: true,
  });
  galleryTop.controller.control = galleryThumbs;
  galleryThumbs.controller.control = galleryTop;
</script>
