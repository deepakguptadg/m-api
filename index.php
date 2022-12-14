<?php

if (isset($_POST['submit'])) {
	
}


?>



<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="UTF-8" />

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<meta http-equiv="X-UA-Compatible" content="ie=edge" />

	<title>Mobile API</title>

	<link rel="stylesheet" href="styles.css" />

	<link href="favicon.png" rel="shortcut icon" type="image/x-icon" />

	<style>
		@import url('https://fonts.googleapis.com/css?family=Roboto+Mono');



		:root {

			--bg: #5f4b8b;

			--fg: #ffffff;

			--secondaryFg: #b3b3b3;

			--containerBg: #272727;

			--searchBg: var(--containerBg);

			--scrollbarColor: #3f3f3f;

			--fontFamily: 'Roboto Mono', monospace;

		}



		body {

			background-color: var(--bg);

			margin: 0px;

			overflow-x: hidden;

		}



		.container {

			width: 100%;

			height: 100vh;

			display: flex;

			align-items: center;

			justify-content: center;

			flex-direction: column;

		}

		.logo {
			height: 100px;
			width: 100px;
			border-radius: 50%;
		}

		#clock {

			font-family: sans-serif;

			font-size: 3.5rem;

			font-weight: 600;

			font-family: var(--fontFamily);

			color: var(--fg);

			margin-bottom: 0.25em;

		}



		#search {

			width: 100%;

			height: 100vh;

			background-color: var(--searchBg);

			display: none;

			position: absolute;

			box-sizing: border-box;

			flex-direction: column;

			align-items: center;

			justify-content: center;

		}



		#search-field {

			width: 90%;

			padding: 0.75em 1em;

			box-sizing: border-box;

			background-color: var(--searchBg);

			border: solid 0px var(--searchBg);

			font-family: var(--fontFamily);

			font-size: 4rem;

			color: var(--fg);

			outline: none;

			border-radius: 3px;

			margin-bottom: 1em;

			text-align: center;

		}



		.weather-container {

			width: 30%;

			background-color: var(--containerBg);

			padding: 1em;

			border-radius: 3px;

			font-family: var(--fontFamily);

			color: var(--fg);

			text-align: center;

		}



		.inline {

			display: inline-block;

		}



		#bookmark-container {

			display: flex;

			flex-direction: row;

			justify-content: center;

			width: 50%;

			margin: 1em 0em;

		}



		@media only screen and (max-width: 960px) {

			.container {

				height: auto;

			}



			#clock {

				margin-top: 1em;

			}



			.container>.bookmark-container {

				flex-direction: column;

				width: 60%;

			}



			.bookmark-container>.bookmark-set {

				width: auto;

				margin: 1em 0em;

			}



			#bookmark-container {

				flex-direction: column;

				width: 100%;



			}

		}



		.bookmark-set {

			padding: 1em;

			text-align: center;

			background-color: var(--containerBg);

			border-radius: 3px;

			font-family: var(--fontFamily);

			font-size: 0.85rem;

			width: 100%;

			height: 12em;

			margin: 0em 1em;

			box-sizing: border-box;

		}



		.bookmark-inner-container {

			overflow-y: scroll;

			height: 80%;

			vertical-align: top;

			padding-right: 6px;

			box-sizing: border-box;

			scrollbar-width: thin;

			scrollbar-color: var(--scrollbarColor) #ffffff00;

		}



		.bookmark-inner-container::-webkit-scrollbar {

			width: 6px;

		}



		.bookmark-inner-container::-webkit-scrollbar-track {

			background: #ffffff00;

		}



		.bookmark-inner-container::-webkit-scrollbar-thumb {

			background-color: var(--scrollbarColor);

			border-radius: 6px;

			border: 3px solid #ffffff00;

		}

		.bookmark-title {

			font-size: 1.1rem;

			font-weight: 600;

			color: var(--fg);

			margin: 0em 0em 0.35em 0em;

			padding-bottom: 6px;

			border-bottom: 1px solid #fff;

		}



		.bookmark {

			text-decoration: none;

			color: var(--secondaryFg);

			display: block;

			margin: 0.5em 0em;

		}



		.bookmark:hover {

			color: var(--fg);

		}

		#message-box {
			position: relative;
			background-color: #272727;
			width: 47%;
			padding: 14px;
		}

		#message-box .name {
			width: 100%;
			display: flex;
			justify-content: space-between;
		}

		#message-box .name div {
			width: 50%;
			padding: 0px 10px;
		}

		#message-box .name div select {
			width: 100%;
			padding: 6px 10px;
		}

		#message-box .text-box {
			width: 100%;
			margin-top: 10px;
			position: relative;
			padding-left: 10px;
		}

		#message-box .text-box textarea {
			width: 97%;
			position: relative;
		}

		#message-box button {
			margin-left: 10px;
			margin-top: 6px;
		}
	</style>

</head>



<body>

	<div id="search">

		<input id="search-field" type="text" name="search-field" onkeypress="return search(event)" />

	</div>

	<div class="container">
		<img src="img/fox.png" class="logo" alt="logo">
		<div id="clock"></div>

		<div class="weather-container">

			<div class="row">

				<div id="weather-description" class="inline"></div>

				<div class="inline">-</div>

				<div id="temp" class="inline"></div>

			</div>

		</div>

		<div id="bookmark-container"></div>

		<!-- <div id="message-box">
			<form action="" method="post">
				<div class="name">
					<div>
						<select id="" name="stu_number">
							<option value="">Select Student</option>
							<option value="9588801469">Praveen</option>
						</select>
					</div>
					<div>
						<select id="" name="all_stu_number">
							<option value="">Select Class</option>
							<option value="">8th</option>
							<option value="">9th</option>
							<option value="">10th</option>
						</select>
					</div>
				</div>
				<div class="text-box">
					<textarea id="" cols="" rows="5" placeholder="Message" name="msg"></textarea>
				</div>
				<button type="submit" name="submit">Send Message</button>
			</form>
		</div> -->

	</div>

	<script>
		const searchUrl = "https://google.com/search?q=";

		// Search on enter key event

		function search(e) {

			if (e.keyCode == 13) {

				var val = document.getElementById("search-field").value;

				window.open(searchUrl + val);

			}

		}

		// Get current time and format

		function getTime() {

			let date = new Date(),

				min = date.getMinutes(),

				sec = date.getSeconds(),

				hour = date.getHours();



			return (

				"" +

				(hour < 10 ? "0" + hour : hour) +

				":" +

				(min < 10 ? "0" + min : min) +

				":" +

				(sec < 10 ? "0" + sec : sec)

			);

		}

		// Handle Weather request

		function getWeather() {

			let xhr = new XMLHttpRequest();

			// Request to open weather map

			xhr.open(

				"GET",

				"http://api.openweathermap.org/data/2.5/weather?id=4737316&units=imperial&appid=e5b292ae2f9dae5f29e11499c2d82ece"

			);

			xhr.onload = () => {

				if (xhr.readyState === 4) {

					if (xhr.status === 200) {

						let json = JSON.parse(xhr.responseText);

						document.getElementById("temp").innerHTML =

							json.main.temp.toFixed(0) + " F";

						document.getElementById("weather-description").innerHTML =

							json.weather[0].description;

					} else {

						console.log("error msg: " + xhr.status);

					}

				}

			};

			xhr.send();

		}

		// Handle writing out Bookmarks

		function setupBookmarks() {

			const bookmarkContainer = document.getElementById("bookmark-container");

			bookmarkContainer.innerHTML = bookmarks

				.map((b) => {

					const html = ["<div class='bookmark-set'>"];

					html.push(`<div class="bookmark-title">${b.title}</div>`);

					html.push('<div class="bookmark-inner-container">');

					html.push(

						...b.links.map(

							(l) =>

							`<a class="bookmark" href="${l.url}" target="_blank">${l.name}</a>`

						)

					);

					html.push("</div></div>");

					return html.join("");

				})

				.join("");

		}



		window.onload = () => {

			setupBookmarks();

			getWeather();

			// Set up the clock

			document.getElementById("clock").innerHTML = getTime();

			// Set clock interval to tick clock

			setInterval(() => {

				document.getElementById("clock").innerHTML = getTime();

			}, 100);

		};



		document.addEventListener("keyup", (event) => {

			if (event.keyCode == 32) {

				// Spacebar code to open search

				document.getElementById("search").style.display = "flex";

				document.getElementById("search-field").focus();

			} else if (event.keyCode == 27) {

				// Esc to close search

				document.getElementById("search-field").value = "";

				document.getElementById("search-field").blur();

				document.getElementById("search").style.display = "none";

			}

		});





		// Note: having length != 4 will mess with layout based on how the site is styled

		const bookmarks = [{

				title: "Daily",

				links: [{

						name: "Inbox",

						url: "https://inbox.google.com"

					},

					{

						name: "GitHub",

						url: "https://github.com"

					},

					{

						name: "Drive",

						url: "https://drive.google.com"

					},

				],

			},

			{

				title: "Media",

				links: [{

						name: "Youtube",

						url: "https://youtube.com"

					},

					{

						name: "Flipkart",

						url: "https://www.flipkart.com/",

					},

					{

						name: "Arustu Tech.",

						url: "https://arustu.com",

					},

				],

			},



			{

				title: "Social",

				links: [{

						name: "Twitter",

						url: "https://twitter.com"

					},

					{

						name: "Facebook",

						url: "https://facebook.com"

					},

				],

			},

		];
	</script>

</body>

</html>