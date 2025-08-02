<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-md w-full text-center">
            <h1 class="text-9xl font-bold text-gray-200">404</h1>
            <h2 class="text-3xl font-bold text-gray-800 mt-4">Page Not Found</h2>
            <p class="text-gray-600 mt-4 mb-8">
                <?= isset($message) ? htmlspecialchars($message) : "The page you're looking for doesn't exist." ?>
            </p>
            <a href="/" class="inline-block bg-blue-600 text-white font-medium px-6 py-3 rounded-md hover:bg-blue-700 transition duration-200">
                Go Back Home
            </a>
            <div class="mt-8 text-sm text-gray-500">
                <?php if (isset($debug) && $debug): ?>
                <p class="mt-4">Debug: <?= htmlspecialchars($debug) ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>