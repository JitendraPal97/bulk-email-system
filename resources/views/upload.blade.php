<form method="POST" action="/upload" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file">
    <button type="submit">Upload CSV</button>
</form>