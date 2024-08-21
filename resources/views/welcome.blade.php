<!DOCTYPE html>
<html>
<head>
    <title>Money Detail Form</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Optional: Include your CSS -->
</head>
<body>
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('money.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="money">Money (Integer)</label>
                <input type="number" name="money" id="money" class="form-control" value="{{ old('money') }}" required>
                @error('money')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="detail">Detail (String)</label>
                <input type="text" name="detail" id="detail" class="form-control" value="{{ old('detail') }}" required>
                @error('detail')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <div class="container mt-4">
        <h1>Stored Data</h1>
        @if(is_array($data) && count($data) > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Money</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                        <tr>
                            <td>{{ $item['money'] }}</td>
                            <td>{{ $item['detail'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No data available.</p>
        @endif
    </div>
</body>
</html>
