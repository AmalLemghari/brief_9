<?php
require_once('../controller/usercontroller.php');

$user = new usercontroller();
$m = $user->login();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdn.tailwindcss.com"></script>
	<title>DataWare</title>
	<style>
        .button:hover {
            background-image: linear-gradient(to right, #6366F1, #68D391);
            /
        }
    </style>
</head>

<body>
	<section>

		<!-- component -->
		<div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
			<div class="relative py-3 sm:max-w-xl sm:mx-auto">
				<div class="absolute inset-0 bg-gradient-to-r from-indigo-400 to-green-400 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-5xl">
				</div>
				<div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-5xl sm:p-20">
					<div class="max-w-md mx-auto">
						<div>
							<h1 class="text-2xl font-semibold"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Login Form</span></h1>
						</div>
						<form action="" method="post">
						<?php if (!empty($m)) : ?>
                                <div class="text-xl font-semibold text-red-500">
                                    <?php echo $m; ?>
                                </div>
                            <?php endif; ?>
							<div class="divide-y divide-gray-200">
								<div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
									<div class="relative">
										<input autocomplete="off" id="email" name="email" type="text" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Email address" />
										<label for="email" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Email Address</label>
									</div>
									<div class="relative">
										<input autocomplete="off" id="password" name="pass" type="password" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Password" />
										<label for="password" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Password</label>
									</div>
									<div class="relative">
                                   		 <button name="submit" type="submit" class="button bg-gradient-to-r from-indigo-400 to-green-400 text-white px-2 py-1">Submit</button>
									</div>
									<p class="text-sm font-light text-gray-500 dark:text-gray-400">
										Don't have an account yet?<a href="register.php" class="font-medium text-blue-600  hover:underline">Sign up an account </a>
									</p>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

	</section>

</body>

</html>