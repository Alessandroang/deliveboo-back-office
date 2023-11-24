<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(to bottom right, #67b26f, #4ca2cd);
        }
    </style>
</head>

<body>
    <h1>Il piatto {{ $plate->name }} ora è {{ $plate->visibility ? 'Visibile' : 'Oscurato' }}</h1>
</body>

</html>
