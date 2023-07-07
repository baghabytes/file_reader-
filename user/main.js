$(window).on('scroll', function() {
    $('.fade-in').each(function() {
      var scrollTop = $(window).scrollTop();
      var elementOffset = $(this).offset().top;
      var distance = (elementOffset - scrollTop);
      var windowHeight = $(window).height();
      var triggerPoint = 0.9 * windowHeight;
  
      if (distance < triggerPoint) {
        $(this).addClass('active');
      }
    });
  });
  

  
  