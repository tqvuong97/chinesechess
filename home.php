<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>iBanking</title>
  <style>
    .button {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }
  </style>
</head>

<body style="font-size:125%;">
	<?php date_default_timezone_set('Asia/Ho_Chi_Minh'); ?>

  <h1>Log in</h1>

  <div id="InputForm">
    <form id="signInForm" method="post">
      <p>
        Username : <input type="text" name="username" required />
      </p>

      <p>
        Password : <input type="password" name="password" required />
      </p>

      <button id="submitBtn" type="submit" class="button">Submit</button>
    </form>
	</div>

	<?php
		if (isset($_POST['username']) && isset($_POST['password']))
		{
			// Send username/password to Tomcat server for authenticating
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/Chese/rest/services/sign-in-secure-v2/");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)

      $data = array('username'=>$_POST['username'],'password'=>$_POST['password']);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

      $output = curl_exec($ch);
      $info = curl_getinfo($ch);
      curl_close($ch);

			//If the server returns TRUE, then print something
      if($output == "true")
      {
        echo "OK";
      }
      else
      {
        echo "NO";
      }
		}
	?>
</body>
