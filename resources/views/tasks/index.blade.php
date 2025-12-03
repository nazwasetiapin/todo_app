<!DOCTYPE html>
<html>

<head>
    <title>Daftar Tugas</title>

    <style>
    body {
        font-family: Arial, sans-serif;
        background: #f3f4f6;
        margin: 0;
        padding: 30px;
    }

    h1 {
        margin-bottom: 20px;
        color: #333;
    }

    .card {
        background: white;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 25px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 6px;
        color: #555;
    }

    input,
    select {
        width: 100%;
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 14px;
    }

    button {
        background: #2563eb;
        color: white;
        padding: 10px 20px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        font-size: 15px;
    }

    button:hover {
        background: #1d4ed8;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 12px;
        overflow: hidden;
        background: white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
    }

    th {
        background: #2563eb;
        color: white;
        padding: 12px;
        font-size: 14px;
    }

    td {
        padding: 12px;
        border-bottom: 1px solid #eee;
        font-size: 14px;
    }

    tr:hover {
        background: #f1f5f9;
    }

    .badge {
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 12px;
        color: white;
        display: inline-block;
    }

    .badge-high {
        background: #dc2626;
    }

    .badge-medium {
        background: #f59e0b;
    }

    .badge-low {
        background: #6b7280;
    }

    .badge-done {
        background: #16a34a;
    }

    .badge-pending {
        background: #3b82f6;
    }

    .success-message {
        padding: 12px;
        background: #d1fae5;
        color: #065f46;
        border-left: 4px solid #10b981;
        margin-bottom: 20px;
        border-radius: 6px;
    }
    </style>

</head>

<body>

    <h1>📌 Daftar Tugas</h1>

    {{-- Pesan sukses --}}
    @if (session('success'))
    <div class="success-message">
        {{ session('success') }}
    </div>
    @endif

    {{-- Form Tambah Tugas --}}
    <div class="card">
        <h2 style="margin-top:0;margin-bottom:15px;">Tambah Tugas Baru</h2>

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama Tugas:</label>
                <input type="text" name="name" required placeholder="Contoh: Belajar Laravel">
            </div>

            <div class="form-group">
                <label>Prioritas:</label>
                <select name="priority">
                    <option value="1">High</option>
                    <option value="2">Medium</option>
                    <option value="3" selected>Low</option>
                </select>
            </div>

            <div class="form-group">
                <label>Deadline:</label>
                <input type="date" name="due_date">
            </div>

            <button type="submit">Tambah Tugas</button>
        </form>
    </div>

    {{-- Tabel Daftar Tugas --}}
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Tugas</th>
                <th>Prioritas</th>
                <th>Deadline</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($tasks as $task)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $task->name }}</td>

                <td>
                    @if ($task->priority == 1)
                    <span class="badge badge-high">Tinggi</span>
                    @elseif ($task->priority == 2)
                    <span class="badge badge-medium">Sedang</span>
                    @else
                    <span class="badge badge-low">Rendah</span>
                    @endif
                </td>

                <td>{{ $task->due_date ? $task->due_date->format('d-m-Y') : '-' }}</td>

                <td>
                    @if ($task->status)
                    <span class="badge badge-done">Selesai</span>
                    @else
                    <span class="badge badge-pending">Belum</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center; padding:20px;">
                    Tidak ada tugas.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>