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
					<a class="pull-left" href="#"><img id="logo" height="50px" width="50px" src="/phpw3/upload_image/images/NewLogo.png"></a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li class="active"><a href="admin.php">Home<span class="sr-only">(current)</span></a></li>
					</ul> 
					<?php
                        if(isset($_SESSION['user_id'])) {
                        ?>
							<ul class="nav navbar-nav navbar-right">
	                            <li><a href="">Hello, <?php echo $_SESSION['fname']; ?></a></li>
	                            <li><div><a class="btn btn-primary btn-small navbar-btn" href="<?php echo PROJ_ROOT;?>/admin/logout.php">Logout</a></div></li>
    	                    </ul>
    	            <?php
                        } else {
                    ?>
							<ul class="nav navbar-nav navbar-right">
								<li><a href="<?php echo PROJ_ROOT;?>/login.php">login</a></li>
		            		</ul>
            		<?php
                        }
                    ?>
				</div>
			</div>
		</nav>