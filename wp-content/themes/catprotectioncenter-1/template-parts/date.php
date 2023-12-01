<?php 
/*Template name: Date*/

get_header();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Highlight Current Day of the Week</title>
    <style src="https://npmcdn.com/flickity@2/dist/flickity.css"></style>
    <style type="text/css">
      * { box-sizing: border-box; }
      .carousel {
        background: #EEE;
      }
      .carousel.flickity-enabled.is-draggable:focus-visible {
        outline: none;
      }
      .carousel-cell {
        width: 66%;
        height: 200px;
        margin-right: 10px;
        background: #8C8;
        border-radius: 5px;
        counter-increment: gallery-cell;
        transition: opacity 1.5s ease-in-out;
      }

      /* cell number */
      .carousel-cell:before {
        display: block;
        text-align: center;
        content: counter(gallery-cell);
        line-height: 200px;
        font-size: 80px;
        color: white;
      }
      table.date-wise {
        margin-bottom: 50px;
      }
    </style>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="https://npmcdn.com/flickity@2/dist/flickity.pkgd.js"></script>
</head>
<body>
    <div id="currentDayOfWeek"></div>
    <script>
        $(document).ready(function() {
            // Function to highlight the current day of the week
            function highlightCurrentDay() {
                var currentDate = new Date();
                var daysOfWeek = ['Zo', 'Ma', 'di', 'Wo', 'Do', 'vr', 'Za'];
                var currentDayOfWeek = daysOfWeek[currentDate.getDay()];
                // Remove highlight from all days first
                $('tr').removeClass('highlight');
                // Highlight the current day of the week
                $('tr:contains(' + currentDayOfWeek + ')').addClass('highlight');
            }
            // Call the highlightCurrentDay function initially and set an interval to update it every second
            highlightCurrentDay();
            setInterval(highlightCurrentDay, 1000);
        });
    </script>
    <table class="date-wise">
        <tr>
          <td>Ma, di, vr</td>
          <td>9u30 – 18u00</td>
        </tr>
        <tr>
          <td>Wo</td>
          <td>9u30 – 19u00</td>
        </tr>
        <tr>
         <td>Do</td>
          <td>9u30 – 14u00</td>
        </tr>
        <tr>
          <td>Zo</td>
          <td>Gesloten</td>
        </tr>
        <tr>
          <td>Za</td>
          <td>9u00 – 18u00</td>
        </tr>
    </table>

<!-- Flickity HTML init -->
  <div class="carousel js-slideshow">
    <div class="carousel-cell"></div>
    <div class="carousel-cell"></div>
    <div class="carousel-cell"></div>
    <div class="carousel-cell"></div>
    <div class="carousel-cell"></div>
  </div>
</body>
</html>
<script>
    $(document).ready(function(){
// Play with this value to change the speed
let tickerSpeed = 0.5;

let flickity = null;
let isPaused = false;
const slideshowEl = document.querySelector('.js-slideshow');


//
//   Functions
//
//////////////////////////////////////////////////////////////////////

const update = () => {
  if (isPaused) return;
  if (flickity.slides) {
    flickity.x = (flickity.x - tickerSpeed) % flickity.slideableWidth;
    flickity.selectedIndex = flickity.dragEndRestingSelect();
    flickity.updateSelectedSlide();
    flickity.settle(flickity.x);
  }
  window.requestAnimationFrame(update);
};

const pause = () => {
  isPaused = true;
};

const play = () => {
  if (isPaused) {
    isPaused = false;
    window.requestAnimationFrame(update);
  }
};


//
//   Create Flickity
//
//////////////////////////////////////////////////////////////////////

flickity = new Flickity(slideshowEl, {
  autoPlay: false,
  prevNextButtons: false,
  pageDots: false,
  draggable: true,
  wrapAround: true,
  selectedAttraction: 0.015,
  friction: 0.25 });
// flickity.x = 0;


//
//   Add Event Listeners
//
//////////////////////////////////////////////////////////////////////

slideshowEl.addEventListener('mouseenter', pause, false);
slideshowEl.addEventListener('focusin', pause, false);
slideshowEl.addEventListener('mouseleave', play, false);
slideshowEl.addEventListener('focusout', play, false);

flickity.on('dragStart', () => {
  isPaused = true;
});


//
//   Start Ticker
//
//////////////////////////////////////////////////////////////////////

update();
    });
</script>
<?php 
get_footer();
?>