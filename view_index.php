
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Portal</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./cssproj/navbar.css">
    <link rel="stylesheet" href="./cssproj/home.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <style>
@import url("https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700");
@import url("https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Quicksand:300,400,500,700");


.event_container {
  display: flex;
  width: 100%;
  height: 450px;
  background: #FFF;
  max-width: 1000px;
  border-radius: 2px;
  box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.25), 0 8px 8px 0 rgba(0, 0, 0, 0.15);
  margin: 90px auto;
}
.event_bg {
  width: 50%;
  height: 100%;
  background: #333;
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  border-top-left-radius: 3px;
  border-bottom-left-radius: 3px;
}
.event_info {
  width: 50%;
  height: 100%;
  padding: 10px 20px;
}
.event_title {
  display: flex;
  width: 100%;
  height: 50px;
  align-items: center;
}
.event_title h4 {
  font-size: 26px;
  font-family: "Quicksand", sans-serif;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  font-weight: 600;
}
.event_desc {
  display: flex;
  width: 100%;
  /* height: calc(100% - 100px); */


}
.list{
    height: 265px;
}
.lilist{
  font-size: 20px; 
  font-weight:600;
}
.ullist{
  font-size: 18px;
}
.event_desc p {
  font-size: 16px;
  font-weight: 500;
  color: #565861;
  overflow: hidden;
  text-overflow: ellipsis;
}
.event_footer {
    /* margin-top: 170px; */
  display: flex;
  width: 100%;
  height: 50px;
  align-items: center;
  justify-content: space-between;

}
.event_date p {
  font-size: 15px;
  font-weight: 600;
  color: #333;
}
.event_more {
  display: flex;
  width: auto;
  height: 100%;
  align-items: center;
}
.event_container .event_info .event_footer .event_more a.btn_more {
  display: flex;
  width: auto;
  height: 40px;
  align-items: center;
  padding: 0 15px;
  text-decoration: none;
  color: #ffffff;
  font-size: 16px;
  font-weight: 600;
  border-radius: 2px;
    background: #5F5FFC;
}


@media screen and (max-width: 575px) {
  .event_container {
    width: 100%;
    height: 480px;
    background: #FFF;
    flex-direction: column;
  }
  .event_container .event_bg {
    width: 100%;
    height: 250px;
    min-height: 250px;
    border-top-right-radius: 3px;
    border-bottom-left-radius: 0;
  }
  .event_container .event_info {
    width: 100%;
    height: 330px;
  }
}
    </style>
</head>

<body style="overflow-y: hidden;">

   <!-- NAVBAR -->
   <nav class="navbar sticky-top navbar-expand-lg bg-dark">
        <div class="logo">
            <img src="./img/logo.png" alt="" width="200px">
        </div>
        <div class="container">
            <a style="opacity: 0; cursor: default; ">Lhenewin Party Solution</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
        
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto w-100 justify-content-end">
                    <li class="nav-item active">
                        <a class="nav-link active" href="index.php">Home <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Products</a>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Services</a>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Contact</a>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="event_container">
        <div class="event_bg" style="background-image: url('./img/A.jpg')"></div>
        <div class="event_info">
          <div class="event_title">
            <h2>PACKAGE A</h2>
          </div>
          <div class="event_desc">
            <p>a litle description of the event, before you make me this way, you make me this way.</p>
          </div>
       
          <div class="list">
            
            <ul>
                <li class="lilist">Included: </li>
                <ul class="ullist">
                    <li>2 Clowns</li>
                    <li>Game Handling</li>
                    <li>Hosting</li>
                    <li>Magic Show</li>    
                </ul>     
                <li class="lilist">Freebies: </li>
                <ul class="ullist">
                    <li>10pcs Toypack</li>
                </ul>
            </ul>

          </div>

          <div class="event_footer">
            <div class="event_date">
              <h4><span style="font-weight:600;">₱ </span>1800</h4>
            </div>
            <div class="event_more" >
              <a href="login.php" class="btn_more">
                BOOK NOW
              </a>
            </div>
          </div>
        </div>
    </div> 


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>
