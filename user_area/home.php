<?php include '../include/header.php';?>
<link rel="stylesheet" href="home.css">
<!-- Additional styles specific to home.php -->
<style>
    ::selection{
        background-color:yellow;
        color:red;

    }
    .outer-grid {
        border: 2px red none;
        border-radius:30px;
        background-image: url('/project/projectpictures/converse.png'); /* Adjust the path as needed */
        background-size: contain;
        background-repeat: no-repeat;
        background-position: right;
        background-color:#009999 ;
        height: 400px;
        width: 100%;
        margin-top:2px;
    }
    .grid-content{
    border: 3px red none;
    height:fit-content;
   width:fit-content;
   padding: 100px 0px 100px 30px;/*(top,right,bottom,left) */
    
    }
    .h3-text{
        font-family: 'Montserrat', sans-serif;
        font-size: 44px;
        color:#f2f2f2;
        text-shadow: 10px 10px 10px rgba(0.4, 0.4, 07, 0.32);
    }
    .inner-text{
        font-size:20px;
        color:#f2f2f2;
        text-shadow: 10px 10px 10px rgba(0.4, 0.4, 07, 0.32);
    }
    .btn{
        margin:5px;
        padding:15px;
        font-weight: bold;
        color:white;
        width:200px;
    }
    .btn1{
    background-color:orange;
    
    }
    .btn1:hover{
        transform:scale(1.1);
        background-color:orange;
    }
    .btn2{
        background:#00e600;
    }
    .btn2:hover{
        transform:scale(1.1);
        background-color:#00e600;
    }
    .next-grid {
    position: relative;
    border: 2px red none;
    border-radius: 30px;
    background: rgb(237, 229, 223);
    height: fit-content;
    width: 100%;
    margin: 2px;
    padding: 30px 50px;
    box-sizing: border-box;
    
}

    .text {
        display: flex;
        align-items: center;
        margin-left:43%;
        margin-top:-50px;      
        text-shadow: 10px 10px 10px rgba(0.4, 0.4, 07, 0.32);

    }

    .h4-text {
        font-family:'Geneva', sans-serif;
        font-size: 40px;
        font-weight: bold;
        color: #000000;
        margin-right: 10px; /* Adjust the margin as needed */
    }

    .small-text {
        font-family: 'Montserrat', sans-serif;
        font-size: 20px;
        margin-top: 60px;
        margin-left:-130px;
    }
    .box-content{
      margin-top:-30px;
    }
    .content-column{
        border:3px red #cdcdb1;
        height:fit-content;
        width:fit-content;
        margin:20px;
        border-radius:10px;
        background:#cdcdb1;
        box-shadow: 0 0 10px rgba(1.6, 2.5, 3.4, 1.5);

    }
    .content-column p{
        font-weight:bold;
        font-style:oblique;
    }
    .content-column:hover{
        transform:scale(1.05);
    }
   
    .col img{
  width:100%;
  padding:3px 3px 2px 3px;
   border-radius:10px;
    }
    .checked {
  color: orange;
}
.third-grid {
    border: 2px red none;
    height: 1220px;
    border-radius: 30px;
    position: absolute;
    background:#eaeafa;
}

.inner-box1 {
    border: 2px black none;
    height: fit-content;
    margin: 15px;
    position: absolute;
    top: 15px;
    border-radius:30px;
    background-color:#b3b3ff;
    width: fit-content; 
   padding:50px 20px 20px 20px;
   animation: floatAnimation 2s infinite;
}
@keyframes floatAnimation {
  0% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-10px);
  }
  100% {
    transform: translateY(0);
  }
}
.inner-box1 h3{
    font-size:30px;
    font-weight:bold;
    color:#f2f2f2;
    margin:-30px auto auto 35%;
        text-shadow: 10px 10px 10px rgba(0.4, 0.4, 07, 0.32);
}
.inner-box2 {
    border: 2px black none;
   
        background-color:transparent;
        border-radius:30px;
    height:552px ;
    margin: 15px;
    width: 550px; /* Adjust the width as needed */
    position: absolute;
    right: 0px; /* Adjust the right margin as needed */
    top: 15px; /* Adjust the top margin as needed */
    
}
.img-content1{
    background-image: url('/project/projectpictures/shoesmodel.png'); /* Adjust the path as needed */
        background-size: contain;
        background-repeat: no-repeat;
        background-color:#ff9900;
    border:2px red none;
    height:300px;
    width:60px;
    position:relative;
    padding:10px;
   
}
.img-content2{
    background-image: url('/project/projectpictures/model4.jpg'); /* Adjust the path as needed */
        background-size: cover;
        background-repeat: no-repeat;
    border:2px red none;
    height:200px;
    width:60px;
    position:relative;
    padding:10px;
    
}
.img-content3{
    background-image: url('/project/projectpictures/model2.jpg'); /* Adjust the path as needed */
        background-size: cover;
        background-repeat: no-repeat;
    border:2px red none;
    height:250px;
    width:100px;
    position:relative;
    padding:10px;
    
    transform:translateY(0.1%);
}
.img-content4{
    background-image: url('/project/projectpictures/model3.jpg'); /* Adjust the path as needed */
        background-size: cover;
        background-repeat: no-repeat;
    border:2px red none;
    height:300px;
    width:60px;
    position:relative;
    padding:10px;
    transform:translateY(-33.5%);
    
}
/* .img-content5{
    border:2px red solid;
    height:300px;
    width:60px;
    position:relative;
    padding:10px;
    border-bottom-right-radius:30px;
} */
.box {
    border: 2px red none;
    border-radius:20px;
    height: 200px;
    margin: 10px;
    width: 300px;
    padding: 20px;
    background:#eaeae1;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    box-shadow:0 0 0px rgba(0, 0, 0, 1.5);
}

.box i {
    font-size: 24px;
    margin-bottom: 10px;
}

.box p {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
}

.box small {
    font-size: 16px;
    color: #000;
}
.second-content{
    border:2px black none;
    height:fit-content;
    margin-top:600px;
}
.next-box{
    border:2px black none;
    background:#4d4d4d;
    height:fit-content;
    border-radius: 30px;
    margin-top:10px;
    padding:60px 80px 80px 80px;
}
.contact1{
    border:1px red none;
    height:fit-content;
    margin:15px;
}
 h4{
    font-family: 'Georgia', serif;
    font-weight:bold;
    margin-bottom:30px;
    color:white;
}
ul
    {
    list-style-type: none;
    margin-left:-30px;
}

li {
    font-weight: bold;
    font-size: 18px; /* Adjust the font size as needed */
    margin-top:20px;
    font-family: 'Georgia', serif;
    color:white;
}

.contact2{
    border:1px red none;
    height:fit-content;
    margin:15px;
}
.signup{
    border:1px red none;
    height:fit-content;
    margin:15px;
}
.inner-content{

    border: 2px red none;
    border-radius:20px;
    height: 200px;
    margin: 10px;
    width: 300px;
    padding: 20px;
    background:#cccccc;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    box-shadow:0 0 0px rgba(0, 0, 0, 1.5);
}
.inner-content p{
    font-size:15px;
    font-weight:bold;
}
.contact2 a {
    text-decoration: none;
    padding:20px;


}
.social-icons a i {
    font-size: 30px; /* Adjust the size as needed */
    background-color: #333; /* Set your desired background color */
    color: white; 
    margin-left:-20px;/* Set the icon color to contrast with the background */
    padding: 10px; /* Add padding to provide space around the icon */
    border-radius: 50%; /* Optional: Add border-radius for a circular shape */
}
.sign{
    background:red;
    padding:10px;
}
.log{
    background:blue;
    padding:10px;
}

</style>
    <div class="outer-grid">
        <div class="grid-content">
            <h3 class="h3-text">
                <b> Better quality <br>comfortable shoes </br></b>
            </h3>
            <p class="inner-text"><b>Striding with Confidence, Unleash Your Unique Style</b></p>
            <div class="container mt-3">
                <button type="button" name=" btn1" id="btn1" class="btn  btn1 rounded-pill">shop now</button>
                <button type="button" name=" btn2" id="btn2" class="btn  btn2 rounded-pill">Explore</button>
            </div>
        </div>
    </div>
    <div class="container-fluid next-grid">
        <div class="text">
        <h4 class="h4-text">Featured </h4>
        <p class="small-text">products</p>
</div>
        <div class="row justify-content-center align-items-center g-2 box-content">
        <div class="col content-column">
       <img src="/project/projectpictures/blackjorden.png" alt="picture">
       <p> High Black Timbs</p>
       <p><b> ratings:</b>
       <span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star"></span>
</p>
</div>


<div class="col content-column">
        <img src="/project/projectpictures/whiteshoes.png" alt="picture">
        <p>Workout Plus Shoes - White </p>
<p><b> ratings:</b>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star"></span>
</p>
</div>
        <div class="col content-column">
       
<img src="/project/projectpictures/anime.png" alt="picture">
<p> OP-printed sneakers</p>
<p><b> ratings:</b>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star"></span>
</p>
</div>
        <div class="col content-column">
       <img src="/project/projectpictures/converse2.png" alt="picture" style="height:242px; object-fit:contain;">
       <p> Converse Chuck -Brown</p>
<p><b> ratings:</b>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star"></span>
</p>
</div>
        </div>
</div> 
<div class="container-fluid third-grid">
    <div class="row outer-box">
        <div class="col inner-box1" >
        <h3> Why Choose Us</h3>
         <div class="row">
            <div class="col box">
                <i class="fa fa-truck" aria-hidden="true"></i>
                <p>Fast Delivery</p>
                                <small>We offer fast delivery services inside Kathmandu Valley, ensuring your orders reach you promptly.</small>
</div>
            <div class="col box">
            <i class="fa fa-shopping-bag" aria-hidden="true"></i>
            <p>Easy-to-Shopping</p>
                                <small>Enjoy a seamless shopping experience with our user-friendly platform, making it easy for you to find and purchase what you need.</small>
</div>
</div>
         <div class="row">
            <div class="col box">
              <i class="fa fa-exchange" aria-hidden="true"></i>  
              <p>Easy Exchange</p>
                                <small>Our hassle-free exchange policy allows you to exchange products effortlessly, ensuring your satisfaction.</small>
</div>
            <div class="col box">
              <i class="fa fa-headphones" aria-hidden="true"></i>  
              <p>Quality Support</p>
                                <small>Our dedicated customer service team is committed to providing quality support to address your inquiries and concerns.</small>
</div>
</div>
</div>
        <div class="col inner-box2" >
     <div class="row">
        <div class="col img-content1">
</div>
        <div class="col img-content2">
</div>
</div>
     <div class="row">
        <div class="col img-content3">
</div>
        <div class="col img-content4">
</div>
        
</div>
</div>

    </div>
    <div class="row second-content" id="about">
        
        <div class="col inner-content" >
            
        <h2>About Us</h2>
            <p>Welcome to Your Shoe Hub, where passion for footwear meets unparalleled quality and style. We are not just a shoe store; we are a destination for individuals who seek comfort, trendsetting designs, and top-notch craftsmanship.</p>
            <p>At Your Shoe Hub, our mission is to provide you with a curated collection of footwear that transcends mere functionality and becomes an expression of your unique personality. Every pair we offer is a testament to our commitment to delivering comfort without compromising on style.</p>
        </div>
</div>
    <div class="row next-box">
        
        <div class="col  contact1">
       <h4>Customer Services:</h4>
      <ul>
        <li> FAQ</li>
       <li> Contact Us</li>
      <li> sizing chats</li>
</ul>
</div>
        <div class="col  contact2">
         <h4>Follow Us:</h4> 
         <div class="social-icons">
        <a href="https://www.facebook.com/yourpage" target="_blank">
            <i class="fab fa-facebook-square"></i>
        </a>
        <a href="https://www.instagram.com/yourpage" target="_blank">
            <i class="fab fa-instagram"></i>
        </a>
        <a href="https://www.twitter.com/yourpage" target="_blank">
            <i class="fab fa-twitter"></i>
        </a>
        <a href="https://wa.me/1234567890" target="_blank">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div> 
         
</div>
<div class="col signup" style="width:200px">
    <h4>Are you new? </h4> 
    <div class="container d-flex justify-content-between align-items-center">
        <button type="button" name="sign" id="sign" class="btn sign rounded-pill">Sign Up</button>
        <button type="button" name="log" id="log" class="btn log rounded-pill">Log In</button>
    </div>
    
</div>
<footer >
    <div class="container1">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 text-center" style="height:20px; background-color:#4d4d4d; color:white;">
                <p>&copy; shoeshub 2024. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>

</div>

</div>
<?php include '../include/footer.php'; ?>
<script>
  //prevent from resubmisson of form
  if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
        </script>
