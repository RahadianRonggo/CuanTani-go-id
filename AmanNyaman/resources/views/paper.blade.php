<div class="storage-deposit">
    <h3>STORAGE_DEPOSIT</h3>
    <form action="{{ route('paper.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="file_label" placeholder="FILE_LABEL" class="input-cyber">
        <input type="file" name="document" class="file-chosen">
        <button type="submit" class="btn-binary">STORE_AS_BINARY</button>
    </form>
</div>