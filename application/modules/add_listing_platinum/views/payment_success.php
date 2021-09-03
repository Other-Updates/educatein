<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
  </head>
    <style>
      body {
        text-align: center;
        padding: 40px 0;
        background: #EBF0F5;
      }
        h1 {
          color: #88B04B;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
        }
        p {
          color: #404F5E;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-size:20px;
          margin: 0;
        }
      i {
        color: #9ABC66;
        font-size: 100px;
        line-height: 200px;
        margin-left:-15px;
      }
      .card {
        background: white;
        padding: 30px 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
      }
      header {
        display: none;
      }
    </style>
    <body>
      <div class="card">
        <div><img src="https://edugatein.com/assets/front/images/logo.png" width="180" alt=""></div><br>
        <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
          <i class="checkmark">✓</i>
        </div>
        <h1>Success</h1> 
        <p>We received your request<br/> we'll be in touch shortly!</p>
        <a href="<?php echo base_url() ?>plan-details?id=<?php echo base64_encode($userid[0]['user_id']); ?>"><button class="btn btn-success">Go to Home</button></a>
      </div>
    </body>
    <script>
    $(document).ready(function() {
    setTimeout(function() {
      window.history.pushState(null, "", window.location.href);        
        window.onpopstate = function() {
            window.history.pushState(null, "", window.location.href);
        }
    }, 500);
        ;
    });
    </script>
</html>