<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>

<h2>User login</h2>

<?php if ($form_error) : ?>
	<p><em>Utilizator sau parola gresita. Reincercati.</em></p>
<?php endif ?>

<form action="<?php echo APP_URL; ?>admin/login" method="post">
	<label>Email
		<input type="email" name="email" value="email" />
	</label>
	<br />
	<label>Password
		<input type="password" name="password" value="passowrd" />
	</label>
	<br />
	<input type="submit" name="submit" value="Login" />
</form>

<?php @include APP_PATH . 'view/snippets/footer.tpl.php'; ?>