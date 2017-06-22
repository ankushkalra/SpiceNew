<?php
	require_once('config.php');
?>
<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
					data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only"></span>
					
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="pull-left" href="#"><img id="logo" height="50px" width="50px" src="<?php echo HTML_IMAGES; ?>NewLogo.png"></a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li class="active"><a href="index.php">Home<span class="sr-only">(current)</span></a></li>
						<li><a href="about.php">About</a>
					</ul>

					<?php
                        if(isset($_SESSION['user_id'])) {
                        ?>
							<ul class="nav navbar-nav navbar-right">
	                            <li><a href="">Hello, <?php echo $_SESSION['fname']; ?></a></li>
	                            <li><div><a class="btn btn-primary btn-small navbar-btn" href="<?php echo PROJ_ROOT;?>/logout.php">Logout</a></div></li>
    	                    </ul>
    	            <?php
                        } else {
                    ?>
							<ul class="nav navbar-nav navbar-right">
								<li><a href="<?php echo PROJ_ROOT;?>/login.php">login</a></li>
		            			<li><div><a class="btn btn-primary btn-small navbar-btn" href="<?php echo PROJ_ROOT;?>/register.php">Sign up!</a></div></li>
		            		</ul>
            		<?php
                        }
                    ?>

                    <form class="navbar-form navbar-right" role="search" method="GET" action="search.php">
						<div class="form-group">
							<input type="text" name="sq" class="form-control" placeholder="Search">
						</div>
						<button type="submit" class="btn btn-default">Submit</button>
					</form>
				</div>
			</div>
		</nav>