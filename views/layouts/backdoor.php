<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>BackDoor</title>

<style>
html, body {
    height: 100%;
    margin: 0;
    background: #050505;
    font-family: "Courier New", monospace;
    color: #6f6f6f;
}

body {
    display: flex;
    align-items: center;
    justify-content: center;
}

form {
    width: 290px;
    padding: 25px;
    background: #080808;
    border: 1px solid #111;
    box-shadow: 0 0 60px rgba(0,0,0,.95);
}

input {
    width: 93%;
    background: #030303;
    border: 1px solid #111;
    color: #8a8a8a;
    padding: 9px;
    margin-bottom: 14px;
    font-size: 13px;
}

input::placeholder {
    color: #333;
}

input:focus {
    outline: none;
    background: #000;
    border-color: #222;
}

button {
    width: 100%;
    background: #000;
    border: 1px solid #1a1a1a;
    color: #5a5a5a;
    padding: 8px;
    font-size: 12px;
    cursor: pointer;
    letter-spacing: 1px;
    text-transform: lowercase;
}

button:hover {
    background: #050505;
    color: #aa2222;
    border-color: #333;
}

/* subtle scanline */
body::after {
    content: "";
    position: fixed;
    inset: 0;
    background: repeating-linear-gradient(
        to bottom,
        rgba(255,255,255,0.015),
        rgba(255,255,255,0.015) 1px,
        transparent 1px,
        transparent 3px
    );
    pointer-events: none;
}

/* occasional flicker */
form {
    animation: flicker 8s infinite;
}

@keyframes flicker {
    0%, 100% { opacity: 1; }
    97% { opacity: 1; }
    98% { opacity: .85; }
    99% { opacity: 1; }
}
</style>
</head>

<body>

<form method="post">
    <input type="text" name="u" placeholder="identity">
    <input type="password" name="p" placeholder="credential">
    <button type="submit">access</button>
</form>

</body>
</html>
