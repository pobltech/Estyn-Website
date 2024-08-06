<h1>Old Files Management</h1>
<p>Here are all {{ $totalFiles }} files: </p>
<ul>
    @foreach($filenames as $filename)
        <li>
            {{ $filename }}
        </li>
    @endforeach
</ul>