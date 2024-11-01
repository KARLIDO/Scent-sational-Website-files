<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap');

        :root {
            --primary-color: #4CAF50;
            --secondary-color: #45a049;
            --text-color: #333;
            --bg-color: #f0f0f0;
        }

        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-color);
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .container {
            text-align: center;
            padding: 2rem;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        h1 {
            font-size: 4rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        a {
            display: inline-block;
            margin-top: 1rem;
            padding: 0.75rem 1.5rem;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-weight: bold;
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }

        a:hover {
            background-color: var(--secondary-color);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: #f2d74e;
            position: absolute;
            top: -10px;
            left: 50%;
            animation: confetti 5s ease-in-out infinite;
        }

        .confetti:nth-child(2n) {
            background-color: #95c3de;
        }

        .confetti:nth-child(3n) {
            background-color: #ff9a91;
        }

        .confetti:nth-child(4n) {
            background-color: #f2d74e;
        }

        @keyframes confetti {
            0% { transform: translateY(0) rotateZ(0); opacity: 1; }
            100% { transform: translateY(1000px) rotateZ(720deg); opacity: 0; }
        }

        @media (max-width: 600px) {
            h1 {
                font-size: 3rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>THANK YOU</h1>
        <a href="index.html">Go to Homepage</a>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
    </div>

    <script>
        // Create more confetti dynamically
        for (let i = 0; i < 50; i++) {
            const confetti = document.createElement('div');
            confetti.classList.add('confetti');
            confetti.style.left = Math.random() * 100 + 'vw';
            confetti.style.animationDuration = (Math.random() * 3 + 2) + 's';
            confetti.style.animationDelay = Math.random() * 5 + 's';
            document.body.appendChild(confetti);
        }
    </script>
</body>
</html>
