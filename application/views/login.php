<div class="m-auto card shadow-sm">
	<div class="p-5 m-3">
		<h1 class="text-center">Login</h1>
        <hr class="border-primary">
		<form method="POST" action="<?php echo site_url('process/login') ?>">
			<div class="form-group">
				<label for="Username">Username</label>
				<input type="text" class="form-control" placeholder="username" name="username" id="Username">
			</div>
			<div class="form-group">
				<label for="Password">Password</label>
				<input type="password" class="form-control" placeholder="password" name="password" id="Password">
			</div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg">Login</button>
            </div>
		</form>
	</div>
</div>