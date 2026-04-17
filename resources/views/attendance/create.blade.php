<!DOCTYPE html>
<html lang="ur" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>حاضری نظام</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>

<body class="container mt-4">

<h2 class="text-center mb-4">حاضری درج کریں</h2>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="/attendance/store">
    @csrf

    <div class="mb-3">
        <label>طالب علم کا نام</label>
        <input type="text" name="student_name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>جماعت</label>
        <input type="text" name="class" class="form-control" required>
    </div>

    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>دن</th>
                <th>حاضری</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 1; $i <= 31; $i++)
            <tr>
                <td>{{ $i }}</td>
                <td>
                    <select name="days[{{ $i }}]" class="form-control">
                        <option value="1">حاضر</option>
                        <option value="0">غیر حاضر</option>
                    </select>
                </td>
            </tr>
            @endfor
        </tbody>
    </table>

    <button type="submit" class="btn btn-success w-100">محفوظ کریں</button>
</form>

</body>
</html>