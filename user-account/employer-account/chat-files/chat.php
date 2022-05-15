<?php
session_start();
include_once "php/config.php";
if (!isset($_SESSION['unique_id'])) {
  header("location: login.php");
}
?>
<?php include_once "header.php"; ?>

<body class="header-white sidebar-dark">
  <div class="header">
    <div class="header-left">
      <div class="menu-icon dw dw-menu"></div>
    </div>
    <div class="header-right">
      <div class="user-info-dropdown">
        <div class="dropdown">
          <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
            <span class="user-icon">
              <img src="../../<?php echo $_SESSION['p_p']; ?>" alt="">
            </span>
            <span class="user-name"><?php echo $_SESSION['name']; ?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
            <!-- <a class="dropdown-item" href="profile.html"><i class="dw dw-user1"></i> Profile</a>
						<a class="dropdown-item" href="profile.html"><i class="dw dw-settings2"></i> Setting</a>
						<a class="dropdown-item" href="faq.html"><i class="dw dw-help"></i> Help</a> -->
            <a class="dropdown-item" href="../logout.php"><i class="dw dw-logout"></i> Log Out</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="left-side-bar">
    <div class="brand-logo">
      <a href="#">
        Home
      </a>
      <div class="close-sidebar" data-toggle="left-sidebar-close">
        <i class="ion-close-round"></i>
      </div>
    </div>
    <div class="menu-block customscroll mCustomScrollbar _mCS_3">
      <div id="mCSB_3" class="mCustomScrollBox mCS-dark-2 mCSB_vertical mCSB_inside" tabindex="0" style="max-height: none;">
        <div id="mCSB_3_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="ltr">
          <div class="sidebar-menu icon-style-1 icon-list-style-1">
            <ul id="accordion-menu">
              <li class="dropdown">
                <a href="../userProfile.php" class="dropdown-toggle no-arrow" data-option="off">
                  <span class="micon dw dw-user-1"></span><span class="mtext">Profile</span>
                </a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle no-arrow" data-option="off">
                  <span class="micon dw dw-message"></span><span class="mtext">Chat</span>
                </a>
              </li>
              <li class="dropdown">
                <a href="../userJobOffers.php" class="dropdown-toggle no-arrow" data-option="off">
                  <span class="micon dw dw-briefcase"></span><span class="mtext">Jobs</span>
                </a>
              </li>
              <li class="dropdown">
                <a href="../userFeedback.php" class="dropdown-toggle no-arrow" data-option="off">
                  <span class="micon dw dw-chat"></span><span class="mtext">Feedback</span>
                </a>
              </li>
              <li>
                <a href="../update.php" class="dropdown-toggle no-arrow">
                  <span class="micon dw dw-calendar1"></span><span class="mtext">Update</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="mobile-menu-overlay"></div>
  <div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
      <div class="min-height-200px">
        <div class="page-header">
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Chat</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 mb-30">
            <div class="wrapper">
              <section class="users">
                <div class="search">
                  <span class="text">Select a user to start chat</span>
                  <input type="text" placeholder="Enter name to search...">
                  <button><i class="fas fa-search"></i></button>
                </div>
                <div class="users-list">

                </div>
              </section>
            </div>
          </div>
          <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 mb-30 border-radius-0">
            <div class="wrapper">
              <section class="chat-area">
                <?php if ($_GET['user_id'] != "522287705") : ?>
                  <header>
                    <?php
                    $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
                    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
                    if (mysqli_num_rows($sql) > 0) {
                      $row = mysqli_fetch_assoc($sql);
                    }
                    ?>
                    <img src="../../<?php echo $row['p_p']; ?>" alt="">
                    <div class="details">
                      <span><?php echo $row['name'] ?></span>
                      <p><?php echo $row['status']; ?></p>
                    </div>
                  </header>
                <?php endif; ?>
                <?php if ($_GET['user_id'] == "522287705") : ?>
                  <header>
                    <?php
                    $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
                    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
                    if (mysqli_num_rows($sql) > 0) {
                      $row = mysqli_fetch_assoc($sql);
                    }
                    ?>
                    <img src="../../<?php echo $row['p_p']; ?>" alt="">
                    <div class="details">
                    </div>
                  </header>
                <?php endif; ?>
                <?php if ($_GET['user_id'] != "522287705") : ?>
                  <div class="chat-box">

                  </div>
                  <form action="#" class="typing-area">
                    <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                    <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
                    <button><i class="fab fa-telegram-plane"></i></button>
                  </form>
                <?php endif; ?>
                <?php if ($_GET['user_id'] == "522287705") : ?>
                  <div class="chat-box">
                    <div class="text">No messages are available. Start chatting now.</div>
                  </div>
                <?php endif; ?>
              </section>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  <script src="javascript/chat.js"></script>
  <script src="javascript/users.js"></script>

  <!-- js -->
  <script src="template-files/vendors/scripts/core.js"></script>
  <script src="template-files/vendors/scripts/script.min.js"></script>
  <script src="template-files/vendors/scripts/process.js"></script>
  <script src="template-files/vendors/scripts/layout-settings.js"></script>
  <script src="template-files/src/plugins/cropperjs/dist/cropper.js"></script>
  <script src="template-files/sweetalert/sweetalert2.min.js"></script>
</body>

</html>