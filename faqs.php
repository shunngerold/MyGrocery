<?php
// check if session is set
if (isset($_SESSION)) {
  session_write_close();
} else {
  session_start();
}

// entering admin side
if (!isset($_SESSION['user_id'])) {
  if (isset($_GET['admin'])) {
    header('location: ./admin_side/signin.php');
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <!-- title tag -->
  <title>FAQs | MyGrocery</title>
  <!-- Custom styles for this template -->
  <link href="./assets/css/home.css" rel="stylesheet">
  <!-- include head link tags -->
  <?php include "./head.php"; ?>
</head>

<body class="body-animate">
  <!-- header tag -->
  <?php include_once "./header.php";  ?>
  <br><br>
  <main class="mb-5">
    <div class="rich-text__heading--large text-center">
      <h2 id="welcome-title">FREQUENTLY ASKED QUESTIONS</h2>
    </div><br>
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="nav nav-pills faq-nav" id="faq-tabs" role="tablist" aria-orientation="vertical">
            <a href="#tab1" class="nav-link active" data-toggle="pill" role="tab" aria-controls="tab1" aria-selected="true">
              <i class="bi bi-question-circle"></i> Frequently Asked Questions
            </a>
            <a href="#tab2" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab2" aria-selected="false">
              <i class="bi bi-person-bounding-box"></i> Profile/Account
            </a>
            <a href="#tab3" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab3" aria-selected="false">
              <i class="bi bi-cart3"></i> Add to Cart
            </a>
            <a href="#tab4" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab4" aria-selected="false">
              <i class="bi bi-cash-coin"></i> Transactions
            </a>
            <a href="#tab5" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab5" aria-selected="false">
              <i class="bi bi-question-lg"></i> General Help
            </a>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="tab-content" id="faq-tab-content">
            <div class="tab-pane show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
              <div class="accordion" id="accordion-tab-1">
                <div class="card">
                  <div class="card-header" id="accordion-tab-1-heading-1">
                    <h5>
                      <button id="btn-link" class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-1-content-1" aria-expanded="false" aria-controls="accordion-tab-1-content-1">How to order?</button>
                    </h5>
                  </div>
                  <div class="collapse show" id="accordion-tab-1-content-1" aria-labelledby="accordion-tab-1-heading-1" data-parent="#accordion-tab-1">
                    <div class="card-body">
                      <p>You can order through browsing on our Online Shopping Website. <strong><a style="color: #59981A; text-decoration: none;" href="">MyGrocery.com</a></strong> You can choose on the various choices that are currently avialable on the site. You aslo need these following information to complete your order.</p>
                      <ul style="color: #616161;">
                        <li>Full Name:</li>
                        <li>Current Available Address:</li>
                        <li>Contact Information:</li>
                      </ul>
                      <p><strong>Example: </strong>
                      <ul style="color: #616161;">
                        <li>Mark Angelo De Guzman</li>
                        <li>Angat Bulacan</li>
                        <li>09123456789</li>
                      </ul>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="accordion-tab-1-heading-2">
                    <h5>
                      <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-1-content-2" aria-expanded="false" aria-controls="accordion-tab-1-content-2">Is there a minimum and maximum limitaion upon ordering?</button>
                    </h5>
                  </div>
                  <div class="collapse" id="accordion-tab-1-content-2" aria-labelledby="accordion-tab-1-heading-2" data-parent="#accordion-tab-1">
                    <div class="card-body">
                      <p>We're gladly to say that there are <strong style="color: #59981A; text-decoration: none;">NO</strong> limitations on order but, if the stocks are not available at the moment then it will have a limition on ordering.</p>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="accordion-tab-1-heading-3">
                    <h5>
                      <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-1-content-3" aria-expanded="false" aria-controls="accordion-tab-1-content-3">How long will my items will be deliver to me?</button>
                    </h5>
                  </div>
                  <div class="collapse" id="accordion-tab-1-content-3" aria-labelledby="accordion-tab-1-heading-3" data-parent="#accordion-tab-1">
                    <div class="card-body">
                      <p>The orders that we received until <strong style="color: #59981A; text-decoration: none;">10 PM</strong> as the day the order has been placed. The items then will be delivered to the customer upon the next day. The Delivery hours is 11am- 6pm. <strong style="color: #59981A; text-decoration: none;">(No deliveries on weekends)</strong></p>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="accordion-tab-1-heading-4">
                    <h5>
                      <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-1-content-4" aria-expanded="false" aria-controls="accordion-tab-1-content-4">How much will the delivery fee will take?</button>
                    </h5>
                  </div>
                  <div class="collapse" id="accordion-tab-1-content-4" aria-labelledby="accordion-tab-1-heading-4" data-parent="#accordion-tab-1">
                    <div class="card-body">
                      <p>The delivery fees are based on the kilometers of the distance between the recievers home and the local station:</p>
                      <p><strong>Fees listed below: </strong>
                      <ul style="color: #616161;">
                        <li>Less than 1km = 10php</li>
                        <li>10km - 19km = 25php</li>
                        <li>20km - 29km = 35php</li>
                        <li>30km - 39km = 45php</li>
                        <li>40km higher = 55php</li>
                      </ul>
                      </p>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="accordion-tab-1-heading-5">
                    <h5>
                      <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-1-content-5" aria-expanded="false" aria-controls="accordion-tab-1-content-5">Is the site easy to use?</button>
                    </h5>
                  </div>
                  <div class="collapse" id="accordion-tab-1-content-5" aria-labelledby="accordion-tab-1-heading-5" data-parent="#accordion-tab-1">
                    <div class="card-body">
                      <p>Generally speaking, our application is directed to the point and easy to navigate even if you are new to the application.</p>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="accordion-tab-1-heading-6">
                    <h5>
                      <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-1-content-6" aria-expanded="false" aria-controls="accordion-tab-1-content-6">Why is registration necessary for every customer?</button>
                    </h5>
                  </div>
                  <div class="collapse" id="accordion-tab-1-content-6" aria-labelledby="accordion-tab-1-heading-6" data-parent="#accordion-tab-1">
                    <div class="card-body">
                      <p>Registration is very important for online shopping because i helps to know who and where would the products will be delivered onto you.</p>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="accordion-tab-1-heading-7">
                    <h5>
                      <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-1-content-7" aria-expanded="false" aria-controls="accordion-tab-1-content-7">Are you mobile friendly?</button>
                    </h5>
                  </div>
                  <div class="collapse" id="accordion-tab-1-content-7" aria-labelledby="accordion-tab-1-heading-7" data-parent="#accordion-tab-1">
                    <div class="card-body">
                      <p>Were safe to say that, Yes we are mobile friendly but we are still fixing most of the bugs and issues that are or will be experienced on mobile.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab2" role="tabpanel" aria-labelledby="tab2">
              <div class="accordion" id="accordion-tab-2">
                <div class="card">
                  <div class="card-header" id="accordion-tab-2-heading-1">
                    <h5>
                      <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-2-content-1" aria-expanded="false" aria-controls="accordion-tab-2-content-1">How can i have an account?</button>
                    </h5>
                  </div>
                  <div class="collapse show" id="accordion-tab-2-content-1" aria-labelledby="accordion-tab-2-heading-1" data-parent="#accordion-tab-2">
                    <div class="card-body">
                      <p>You can create you own account or profile by selecting the person <strong style="color: #59981A; text-decoration: none;"><i class="bi-person-check-fill" id="navicons"></i> </strong> icon at the navigation bar. <strong style="color: #59981A; text-decoration: none;">(If have not created an account the icon will redirect you to the sign up page then after completing it yu now be redirected to the profile edit page.)</strong> Upon clicking the icon it wll direct you the profile interface which you can edit your account information.</p>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="accordion-tab-2-heading-2">
                    <h5>
                      <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-2-content-2" aria-expanded="false" aria-controls="accordion-tab-2-content-2">How can i check my delivery information?</button>
                    </h5>
                  </div>
                  <div class="collapse" id="accordion-tab-2-content-2" aria-labelledby="accordion-tab-2-heading-2" data-parent="#accordion-tab-2">
                    <div class="card-body">
                      <p>You can check your delivery information at the person <strong style="color: #59981A; text-decoration: none;"><i class="bi-person-check-fill" id="navicons"></i> </strong> icon, then selecting through the navigation the <strong style="color: #59981A; text-decoration: none;">Delivery</strong>. You will aslo need to complete the information that are needed for the delivery details because it is a requiremnt upon placing your order for delivery.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab3" role="tabpanel" aria-labelledby="tab3">
              <div class="accordion" id="accordion-tab-3">
                <div class="card">
                  <div class="card-header" id="accordion-tab-3-heading-1">
                    <h5>
                      <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-3-content-1" aria-expanded="false" aria-controls="accordion-tab-3-content-1">What is add to cart?</button>
                    </h5>
                  </div>
                  <div class="collapse show" id="accordion-tab-3-content-1" aria-labelledby="accordion-tab-3-heading-1" data-parent="#accordion-tab-3">
                    <div class="card-body">
                      <p>By adding to cart, you can save the products that you want to purchase after you are done browsing to the site. Having this functionality will greatly help the user to look back what are the products you want to purchase it can also help for canvassing your items and know the total amount you will pay.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab4" role="tabpanel" aria-labelledby="tab4">
              <div class="accordion" id="accordion-tab-4">
                <div class="card">
                  <div class="card-header" id="accordion-tab-4-heading-1">
                    <h5>
                      <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-4-content-1" aria-expanded="false" aria-controls="accordion-tab-4-content-1">What are the modes of payment?</button>
                    </h5>
                  </div>
                  <div class="collapse show" id="accordion-tab-4-content-1" aria-labelledby="accordion-tab-4-heading-1" data-parent="#accordion-tab-4">
                    <div class="card-body">
                      <p>The modes of payment are currently focused on the <strong style="color: #59981A; text-decoration: none;">Cash on Delivery</strong> option only. The other modes are being discussed and will be further implemented if needed.</p>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="accordion-tab-4-heading-2">
                    <h5>
                      <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-4-content-2" aria-expanded="false" aria-controls="accordion-tab-4-content-2">What is Cash on Delivery?</button>
                    </h5>
                  </div>
                  <div class="collapse" id="accordion-tab-4-content-2" aria-labelledby="accordion-tab-4-heading-2" data-parent="#accordion-tab-4">
                    <div class="card-body">
                      <p><strong style="color: #59981A; text-decoration: none;">Cash on Delivery</strong> is the system of paying for the items you purchased online upon delivery at your door. This can ensure the safeness and legitness of the online shop. Also you can ensure first if the items are complete upon delivery.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab5" role="tabpanel" aria-labelledby="tab5">
              <div class="accordion" id="accordion-tab-5">
                <div class="card">
                  <div class="card-header" id="accordion-tab-5-heading-1">
                    <h5>
                      <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-5-content-1" aria-expanded="false" aria-controls="accordion-tab-5-content-1">How can i navigate through the site?</button>
                    </h5>
                  </div>
                  <div class="collapse show" id="accordion-tab-5-content-1" aria-labelledby="accordion-tab-5-heading-1" data-parent="#accordion-tab-5">
                    <div class="card-body">
                      <p>You can use the <strong style="color: #59981A; text-decoration: none;">Navigation Bar</strong> at the top of the system, it shows all of the contents available for navigation. <strong style="color: #59981A; text-decoration: none;">Home</strong> is the main page or the welcome page that greets you with the information you will need on browsing the site. <strong style="color: #59981A; text-decoration: none;">Products</strong> tab contains the selection of products available at the store. <strong style="color: #59981A; text-decoration: none;">FAQs</strong> are the questions that are most asked by the users. It can also help you understand how the site works and how to order the products. <strong style="color: #59981A; text-decoration: none;">About Us</strong> tells you about us the team of developers behind the system and reason why this is built. And lastly <strong style="color: #59981A; text-decoration: none;">Contact Us</strong> on this you can view our contacts so you can inform us of your need and feedback about the system.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </main>

  <!-- Include Footer -->
  <?php include_once "./footer.php"; ?>
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="//code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>