  <body>
  <div id="wrapper">
<header>
 <div id="head_logo"></div>
    <div id="welcome"><p>Welcome, <?php if($_SESSION['admin'] != "yes"){echo $_SESSION['firstName'];} else {echo "signed in as admin";}?></p></div>
  <div id="searchbox">
  <form action="search.php" method="post">
  <input type="text" name="search" id="search" value="Search keyword...">
  <input type="submit" id="submit_search" value="Go">
  </form>
  </div>
  <div id="header_nav">
  
 <?php if($_SESSION['admin'] == "yes"){echo "<a href='add.php'>Add Item</a>";}?>
  <a href="cart.php">View Cart</a>
  <?php if($_SESSION['admin'] != "yes"){echo "<a href='updateAccount.php'>My Account</a>";}?>
  <a href="logout.php" class="logout">Log Out</a>
  
  
  </div>
  </header>
  <nav>
  <ul>
  <li><a href="index.php">Home</a></li>
  <li><a href="shop.php">Shop Cigars</a></li>
 <li><a href="purchases.php">Past Purchases</a></li>
 <li><a href="location.php">Location</a></li>
  </ul>
  </nav>
  <main>