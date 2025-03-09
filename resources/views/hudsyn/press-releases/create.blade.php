@extends('hudsyn::hudsyn.layouts.app')

@section('content')
    <h1>Create New Press Release</h1>

    @if($errors->any())
        <div style="color:red;">
            <ul>
                @foreach($errors->all() as $error)
                   <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('hudsyn.press-releases.store') }}">
        @csrf
        <div>
            <label>Title:</label>
            <input type="text" name="title" value="{{ old('title') }}" required>
        </div>
        <div>
            <label>Slug:</label>
            <input type="text" name="slug" value="{{ old('slug') }}" required>
        </div>
        <div>
            <label>Content:</label>
            <textarea name="content" id="content" rows="10" required>{{ old('content') }}</textarea>
        </div>
        <div>
            <label>Status:</label>
            <select name="status" required>
                <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
            </select>
        </div>
        <div>
            <label>Author:</label>
            <select name="author_id" required>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                        {{ $author->name }} ({{ $author->email }})
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit">Create Press Release</button>
    </form>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content', {
            allowedContent: true,
            contentsCss: {!! json_encode(config('hudsyn.editor.contentsCss')) !!},
            filebrowserImageBrowseUrl: '{{ url("hudsyn/files/gallery") }}',
            filebrowserImageUploadUrl: '{{ url("hudsyn/files/upload-image") }}?_token={{ csrf_token() }}',
            on: {
                instanceReady: function(evt) {
                    var docHead = evt.editor.document.getHead();
                    // Loop over any custom scripts defined in config and inject them
                    var scripts = {!! json_encode(config('hudsyn.editor.scripts')) !!};
                    scripts.forEach(function(src) {
                        var script = evt.editor.document.createElement('script');
                        script.setAttribute('type', 'text/javascript');
                        script.setAttribute('src', src);
                        docHead.append(script);
                    });
                }
            }
        });
    </script>
@endsection