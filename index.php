
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="initial-scale=1, width=device-width" user-scalable=no />
  <title>BRR Trading | Home</title>
  <link rel="stylesheet" href="./css/global.css" />
  <link rel="stylesheet" href="./css/index.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Tenor Sans:wght@400&display=swap" />

</head>
<body>
  <?php include 'nav.php'; ?>
  <div class="brr-index">

  <div class="home">
    <div class="logo">
      <img class="logo-icon1" alt="" src="./public/logo@2x.png" />
      <?php
// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user value is in session
if (isset($_SESSION['Username'])) {
    // If user is in session, show this
    echo '<div class="slogan" id="modify">
            <p>Wear better, Look smarter</p>
          </div>';
} else {
    // If user is not in session, show this
    echo '<div class="slogan" >
            <p>Wear better, Look smarter</p>
          </div>';
}
?>

    </div>
    <div class="home-txt">
      <a href="shop.php" id="btn-anker">
        <div class="button" id="btn-hov">
          <a href="./user/register.php" id="btn-anker">
            <div class="submit" id="reg">Register</div>
          </a>
        </div>
      </a>
      <div class="intro1">&nbsp;
        <p class="introText">
          Whether you're a seasoned online shopper or a brick-and-mortar enthusiast,
          <br>BRR Trading is your ultimate destination
          <br>for discovering & expressing your unique style.
        </p>
      </div>
      <img class="main-pic-icon" alt="" src="./public/main-pic@2x.png" />
    </div>
  </div>
  <div class="featured">
    <div class="products">
      <div class="product-3">
        <div class="main-rect"></div>
        <img class="tshirt-icon" alt="" src="./public/tshirt@2x.png" />

        <a href="searchCategory.php?item=Jackets" id="btn-anker">
          <div class="button2">
            <div class="button21">
              <div class="button2-child" id="btn-hov">
                <div class="explore-now-parent">
                  <div class="explore-now">Explore Now</div>

                </div>
              </div>
            </div>
          </div>
        </a>
        <div class="label-product">
          <div class="wears">Wears</div>
          <div class="heading">Heavy Jackets</div>
          <img class="stars-icon" alt="" src="./public/stars.svg" />
        </div>
        <img class="sweater-icon" alt="" src="./public/sweater@2x.png" />

        <img class="jacket-icon" alt="" src="./public/jacket@2x.png" />
      </div>
      <div class="product-2">
        <div class="main-rect"></div>
        <a href="searchCategory.php?item=Sweatshirts" id="btn-anker">
          <div class="button22">
            <div class="button21">
              <div class="button2-child" id="btn-hov">
                <div class="explore-now-parent">
                  <div class="explore-now">Explore Now</div>
                </div>
              </div>
            </div>
          </div>
        </a>
        <div class="label-product1">
          <div class="wears1">Wears</div>
          <div class="heading">Winter Sweatshirts</div>
          <img class="stars-icon1" alt="" src="./public/stars.svg" />
        </div>
        <img class="sweater-icon1" alt="" src="./public/sweater@2x.png" />
      </div>
      <div class="product-1">
        <div class="main-rect"></div>

        <a href="searchCategory.php?item=T-shirts" id="btn-anker">
          <div class="button24">
            <div class="button21">
              <div class="button2-child" id="btn-hov">
                <div class="explore-now-parent">
                  <div class="explore-now">Explore Now</div>
                </div>
              </div>
            </div>
          </div>
        </a>
        <div class="label-product2">
          <div class="heading">Classic T-shirt</div>
          <div class="wears">Wears</div>
          <img class="stars-icon2" alt="" src="./public/stars.svg" />
        </div>
        <img class="tshirt-icon1" alt="" src="./public/tshirt@2x.png" />
      </div>
    </div>
    <div class="label2">FEATURED PRODUCTS</div>
  </div>
  <div class="about-us1">
    <div class="about-us-child"></div>
    <div class="label1">ABOUT US</div>
    <div class="intro">
      <p class="vintage-treasures-galore">
        A Gent’s clothing store been keeping men looking bold with various
        selection of jackets, sweaters, shirts with trendy street wears
        since 2080 B.S.
        We are located in Mahabouddha, Kathmandu. We cater to
        style-conscious individuals who seek lasting value and the highest
        quality in the city with our diverse curated collections.
        &nbsp;-Jaykishan Shah Teli (Founder)</p>
    </div>
  </div>
  <div class="reviews1">
    <div class="description">
      <div class="review-3">
        <div class="card">
          <div class="customer">Customer</div>
          <div class="name">Safal Kapali</div>
          <img class="starts-icon" alt="" src="./public/starts.svg" />

          <div class="paragraphe">
            <p class="vintage-treasures-galore">
              Vintage treasures galore! 
            </p>
            <p class="vintage-treasures-galore">That silk tie? </p>
            <p class="vintage-treasures-galore">Instant head-turner. </p>
            <p class="vintage-treasures-galore">
              History buff's fashion heaven.
            </p>
            <p class="vintage-treasures-galore">&nbsp;</p>
          </div>
          <img class="dp-icon" alt="" src="./public/pic1.png" />
        </div>
      </div>
      <div class="review-2">
        <div class="card">
          <div class="customer">Customer</div>
          <div class="name">Angela Waston</div>
          <img class="starts-icon" alt="" src="./public/starts.svg" />

          <div class="paragraphe">
            <p class="vintage-treasures-galore">
              Found cashmere dreams without wallet nightmares. Friendly
              staff with good shopping experience.
            </p>
            <p class="vintage-treasures-galore">&nbsp;</p>
          </div>
          <img class="dp-icon1" alt="" src="./public/pic2.png" />
        </div>
      </div>
      <div class="review-1">
        <div class="card">
          <div class="customer">Customer</div>
          <div class="name">Aakash Shahi</div>
          <img class="starts-icon" alt="" src="./public/starts.svg" />

          <div class="paragraphe">
            <p class="vintage-treasures-galore">
              The shop rocks with styles
            </p>
            <p class="vintage-treasures-galore">
              for every dude. Friendly pros
            </p>
            <p class="vintage-treasures-galore">
              help you look fly, no sweat. 
            </p>
            <p class="vintage-treasures-galore">My new fave spot!</p>
            <p class="vintage-treasures-galore">&nbsp;</p>
          </div>
          <img class="dp-icon2" alt="" src="./public/pic3.png" />
        </div>
      </div>
    </div>
    <div class="label">Testimonials</div>
  </div>
  <div class="mail-us">
    <div class="mail-button">
      <div class="mail-button-child"></div>
      <div class="mail-us-at">Mail us At: brr.trading2023@gmail.com</div>
    </div>
    <div class="subscribe">
      <div class="subscribe-child"></div>
      <div class="subscribe-for-newsletter">Subscribe for Newsletter</div>
    </div>
  </div>
</div>
  <?php include 'footer.php'; ?>
</body>

</html>
<script>
if (window.location.search.includes("error=invalid_credentials")) {
    alert("Invalid email or password. Please try again.");
    // to stop repeatedly alert on refresh
    window.history.pushState({}, "", window.location.pathname);
}
if (window.location.search.includes("pw_change=successful")) {
    alert("Password Changed Sucessfull \nLogin with updated password");
    // to stop repeatedly alert on refresh
    window.history.pushState({}, "", window.location.pathname);
}
</script>