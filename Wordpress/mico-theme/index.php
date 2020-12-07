<?php
get_header();
?>
<div class="content-container">
	<section id="primary" class="content-area">
		<main id="main" class="site-main post-listing">
			<div id="searchResult" class="worker-search-results">
				<h3 id="workerName"></h3>
				<p id="workerPhone"></p>
				<p id="workerEmail"></p>
				<p id="workerPosition"></p>
			</div>
				<form id="formi">
					<div class="float-two">
						<input list="names" class="worker-search" type="text" placeholder="Employee name...">
						<datalist id="names">
							<?php
							$searchQuery = wp_remote_get('http://localhost/wp-dev/wp-json/wp/v2/employee');
							$searchParsed = json_decode($searchQuery['body']);
							foreach ($searchParsed as $employee) {
								echo '<option value="' . $employee->title->rendered . '">';
							}
							?>
						</datalist>
					</div>
					<div class="float-two">
						<input type="submit" class="load-more unselectable" value="Search">
					</div>
				</form>
			<div class="clearboth"></div>
			<div id="posts">

			</div>
		<div id="load-morer" class="loader load-more unselectable">Click here to load earlier stories</div>
		</main>
	</section>
</div>
<?php
get_footer();
