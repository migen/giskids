<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Server Error</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-md w-full text-center">
            <h1 class="text-9xl font-bold text-red-200">500</h1>
            <h2 class="text-3xl font-bold text-gray-800 mt-4">Server Error</h2>
            <p class="text-gray-600 mt-4 mb-8">
                <?= isset($message) ? htmlspecialchars($message) : "Something went wrong on our end. Please try again later." ?>
            </p>
            <a href="/" class="inline-block bg-blue-600 text-white font-medium px-6 py-3 rounded-md hover:bg-blue-700 transition duration-200">
                Go Back Home
            </a>
            <div class="mt-8 text-sm text-gray-500">
                <p>If this problem persists, please contact support.</p>
                <?php if (isset($debug) && $debug && $_ENV['APP_DEBUG'] ?? false): ?>
                <p class="mt-4 text-red-600">Debug: <?= htmlspecialchars($debug) ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>