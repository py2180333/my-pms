<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Project Managment System</title>
    <style>
        body {
            font-family: Figtree, sans-serif;
            margin: 0;
            line-height: 1.5;
            background-color: #f3f4f6; /* Background color from bg-gray-100 Tailwind class */
        }

        h1 {
            text-align: center;
            font-size: 1.5rem; /* Font size from text-4xl Tailwind class */
            font-weight: bold;
            margin-bottom: 1rem; /* Margin from mb-8 Tailwind class */
        }

        .flex {
            display: flex;
        }

        .flex-col {
            flex-direction: column;
        }

        .items-center {
            align-items: center;
        }

        .justify-center {
            justify-content: center;
        }

        .h-screen {
            height: 100vh; /* Height from h-screen Tailwind class */
        }

        .text-white {
            color: white;
        }

        .font-bold {
            font-weight: bold;
        }

        .rounded {
            border-radius: 0.5rem; /* Border radius from rounded Tailwind class */
        }

        .space-x-4 {
            gap: 1rem; /* Spacing from space-x-4 Tailwind class */
        }

        .button {
            padding: 0.5rem 1rem; /* Padding from px-4 py-2 Tailwind class */
            background-color: #38bdf8; /* Background color from bg-blue-500 Tailwind class */
            border: none;
            cursor: pointer;
            border-radius: 0.5rem; /* Border radius from rounded Tailwind class */
            transition: background-color 0.2s ease-in-out;
        }

        .button:hover {
            background-color: #209cee; /* Hover background color from hover:bg-blue-700 Tailwind class */
        }

        .button.green {
            background-color: #4CAF50; /* Background color from bg-green-500 Tailwind class */
        }

        .button.green:hover {
            background-color: #388E3C; /* Hover background color from hover:bg-green-700 Tailwind class */
        }
    </style>
</head>
<body class="antialiased">
    <section class="flex flex-col items-center justify-center h-screen">
        <h1 class="text-4xl font-bold mb-8">
            Project Management System <!-- pranav git testing -->
        </h1>
        <div class="space-x-4">
            <button onclick="location.href='{{route('admin.login')}}'" class="button text-white rounded">Admin Login</button>
            <button onclick="location.href='{{route('login')}}'" class="button green text-white rounded">Other Login</button>
        </div>
    </section>
</body>
</html>