<?php 
/*Template Name: Form-vue*/
get_header();
$theme_path = get_template_directory_uri();
?>
<div id="app">
	<router-view></router-view>	
</div>

<section class="Form-vue">
	<template id="post-list-template">
		<div style="text-align: center;">
		
			<!-- Rendering data to DOM -->
			<h1 style="color: seagreen;">{{title}}</h1>
			<h2>Title : {{name}}</h2>

			<!-- Calling function in methods -->
			<button @click="show()">Click me</button>
			<h2 id="view"></h2>
		</div>
	</template>
</section>