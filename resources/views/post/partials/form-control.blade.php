<div class="form-group">
    <input type="file" name="thumbnail" id="thumbnail" class="form-control-file">
    @error('thumbnail')
        <div class="text-danger mt-2">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="form-group">
    <label for="title">Title</label>
    <input
        type="text"
        name="title"
        id="title"
        class="form-control @error('title') is-invalid @enderror"
        value="{{ old('name') ?? $post->title }}"
    />
    @error('title')
    <div class="mt-2 text-danger">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label for="category">Category</label>
    <select name="category" id="category" class="form-control">
        <option disabled selected>Choose One</option>
        @foreach ($categories as $category)
            <option {{ $category->id == $post->category_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    @error('category')
    <div class="mt-2 text-danger">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label for="tags">Tags</label>
    <select name="tags[]" id="tags" class="form-control select2" multiple>
        @foreach ($post->tags as $tag)
            <option selected value="{{ $tag->id }}">{{ $tag->name }}</option>
        @endforeach
        @foreach ($tags as $tag)
            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
        @endforeach
    </select>
    @error('tag')
    <div class="mt-2 text-danger">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label for="body">Body</label>
    <textarea
        name="body"
        id="body"
        class="form-control @error('body') is-invalid @enderror"
        >{{ old('body') ?? $post->body }}</textarea
    >
    @error('body')
    <div class="mt-2 text-danger">
        {{ $message }}
    </div>
    @enderror
</div>
