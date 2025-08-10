<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortener</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="url"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .result {
            margin-top: 20px;
            padding: 15px;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
        }
        .error {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .short-url {
            font-weight: bold;
            color: #007bff;
            word-break: break-all;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔗 URL Shortener</h1>
        
        <!-- Show validation errors -->
        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        <!-- URL submission form -->
        <form method="POST" action="/shorten">
            @csrf
            <div class="form-group">
                <label for="original_url">Enter your long URL:</label>
                <input 
                    type="url" 
                    id="original_url" 
                    name="original_url" 
                    placeholder="https://www.example.com/some/very/long/path"
                    value="{{ old('original_url') }}"
                    required
                    autocomplete="off"
                >
            </div>
            <button type="submit">Shorten URL</button>
        </form>

        <!-- Show result if URL was shortened -->
        @if (isset($shortUrl))
            <div class="result">
                <h3>✅ Your URL has been shortened!</h3>
                <p><strong>Original URL:</strong><br>{{ $originalUrl }}</p>
                <p><strong>Short URL:</strong><br>
                    <a href="{{ $shortUrl }}" target="_blank" class="short-url">{{ $shortUrl }}</a>
                </p>
                <p><em>Click the short URL to test it!</em></p>
            </div>
        @endif
    </div>
</body>
</html>
