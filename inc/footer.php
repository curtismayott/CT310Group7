		</div> <!-- end content-->
		</main>
		<footer>
			<hr>
			<p>2015 © Copyright Group 7</p>
			<?php
			if(isset($_SESSION['user_name']) && $dbh->isUserLoggedIn($_SESSION['user_id'])){
				?><p>Logged in for: <?php echo (time() - $_SESSION['starttime']); ?> seconds.</p><?php
			}
			?>
			
		</footer>
		<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://www.cs.colostate.edu/~ct310/yr2015sp/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>