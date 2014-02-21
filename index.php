<?php session_start();

require_once 'dbconfig.php';
require_once 'settings.php';
require_once 'src/facebook.php';

try {
	$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $pe){
	die("Could not connect to the database $dbname: " . $pe->getMessage());
}

$facebook = new Facebook(array(
  'appId'  => '407908079353620',
  'secret' => $app_secret,
  'fileUpload' => false, // optional
  'allowSignedRequest' => false, // optional, but should be set to false for non-canvas apps
));

// See if there is a user from a cookie
// $user = $facebook->getUser();

// if ($user) {
//   try {
//     // Proceed knowing you have a logged in user who's authenticated.
//     $user_profile = $facebook->api('/me');
//     $logoutUrl = $facebook->getLogoutUrl();
//   } catch (FacebookApiException $e) {
//     $user = null;
//   }
// } else {
//     $loginUrl = $facebook->getLoginUrl();
// }

getHeader();

?>

<div class="row">
	<h1>Register</h1>
	<form action="register.php" role="form" method="post">
		<div class="form-group">
			<div class="row">
				<div class="col-md-4">
					<label for="f_name">First Name:</label>
					<input type="text" class="form-control" name="first_name" placeholder="Please enter your first name">
				</div>
				<div class="col-md-4">
					<label for="l_name">Last Name:</label>
					<input type="text" class="form-control" name="last_name" placeholder="Please enter your last name">
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<label for="password">Password:</label>
					<input type="password" class="form-control" name="password" placeholder="Please enter a password">
				</div>
				<div class="col-md-4">
					<label for="email">Email:</label>
					<input type="text" class="form-control" name="email" placeholder="Please enter an email">
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-default">Submit</button>
	</form>
</div>

<div class="row">
	<h1>Login</h1>
	<form action="main.php" role="form" method="post" class="form-inline">
		<div class="form-group">
			<input type="text" class="form-control" name="username" placeholder="Username">
		</div>
		<div class="form-group">
			<input type="password" class="form-control" name="password" placeholder="Password">
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-default">Login</button>
		</div>
	</form>
</div>
<div class="row">
	<div id="loginArea">
		<h1>Or Use Facebook</h1>
		<button id="fbLogin" class="btn">Facebook Login</button>
	</div>
	<div id="likesArea">
		<h1>Get Likes</h1>
		<button id="getLikes" class="btn">Get likes</button>
	</div>
</div>



<?php

getFooter();

?>

<script>
var firstName = "", lastName =  "", _email = "", _id = 0;

window.fbAsyncInit = function() {
	FB.init({
		appId      : '407908079353620',
		status     : true,
		xfbml      : true
	});

	FB.Event.subscribe('auth.authResponseChange', function(response) {
		// Here we specify what we do with the response anytime this event occurs. 
		if (response.status === 'connected') {
			console.log("Connected");
			// The response object is returned with a status field that lets the app know the current
			// login status of the person. In this case, we're handling the situation where they 
			// have logged in to the app.
			$('#getLikes').css("display", "block");
			$('#loginArea').css('display', 'none');
			FB.api('/me', function(res) {
				_id = res.id;
			})
		} else {
			// The user isn't auth'd
			console.log("Not auth'd");
			$('#getLikes').css("display", "none");
			$('#loginArea').css('display', 'block');
		}
	});
}

$('#fbLogin').on('click', 
	function () { FB.login( 
		function (response) {
			if (response.status=="connected") {
				// using jQuery to perform AJAX POST.
				FB.api('/me', function(person) {
					var _city = null, _state = null, _country = null;
					FB.api({
							method: 'fql.query',
							query: 'SELECT current_location FROM user WHERE uid='+person.id,
							return_ssl_resources: 1
						}, function (loc) {
							_city = loc[0].current_location.city;
							_state = loc[0].current_location.state;
							_country = loc[0].current_location.country;
							console.log(_city + " " + _state + " " + _country);
							$.post('register.php',
									{ fb_id: person.id, first_name: person.first_name, last_name: person.last_name, email: person.email, city: _city, state: _state, country: _country },
									function(resp) {
								// POST callback
								console.log("POST callback arrived:");
								console.log(resp);
							});
						}
					);
				});
				$('#getLikes').css("visibility", "visible");
			} else {
				console.log(response.status);
				$('#getLikes').css("visibility", "hidden");
			}
		},
		{scope: 'email,user_likes'}
	)
});

var likes = [];
var page = 0;

$('#getLikes').on('click', function() {
	// Print out each "like"
	FB.api('me/likes', function(res) {
		iteratePages(res);
	}); 
});

function iteratePages(res) {
	page++;

	for(var i = 0; i < res.data.length; i++ ) {
		likes.push(res.data[i]);
	}

	next = res.paging.next;

	if(next == undefined)
		storeLikes();

	$.get(next, iteratePages, 'json');
}

function storeLikes() {
	console.log(likes.length);
	console.log("Storing likes");

	var stringy = JSON.stringify(likes);
	$.post(
		'store_likes.php',
		{ arr: stringy, fb_id: _id },
		function(resp) {
			console.log("Store Likes response:");
			console.log(resp);
		}

	);
}

// Here we run a very simple test of the Graph API after login is successful. 
// This testAPI() function is only called in those cases. 
function testAPI() {
  console.log('Welcome!  Fetching your information.... ');
  FB.api('/me', function(response) {
    console.log('Good to see you, ' + response.name + '.');
    console.log('User ID: ' + response.id);
  });

  FB.api('/me/permissions', function (response) {
    console.log("Permissions");
    console.log(response);
  });
};

(function(d, s, id){
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) {return;}
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/all.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

</body>
</html>