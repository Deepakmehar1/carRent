<?php

// Clear the persistent cookie on logout
setcookie('user_data', '', time() - 3600, "/"); // Set expiration time to the past to delete the cookie

header("Location: /");
exit();
