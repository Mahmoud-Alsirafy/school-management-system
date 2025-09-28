<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>توليد QR للرقم القومي</title>
</head>
<body>
    <h2>توليد QR للرقم القومي</h2>

    <form action="{{ route('generate') }}" method="POST">
        @csrf
        <div>
            <label for="nid">الرقم القومي:</label>
            <input type="number" id="nid" name="nationality_id" placeholder="اكتب الرقم القومي" required>
        </div>

        <div>
            <button type="submit">توليد QR</button>
        </div>
    </form>
</body>
</html>
