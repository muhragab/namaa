<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', 'Image:') !!}
    <p>{{ $blog->image }}</p>
</div>

<!-- title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'title:') !!}
    <p>{{ $blog->title }}</p>
</div>

<!-- title Field -->
<div class="col-sm-12">
    {!! Form::label('content', 'content:') !!}
    <p>{{ $blog->content }}</p>
</div>

<!-- Publish Date Field -->
<div class="col-sm-12">
    {!! Form::label('publish_date', 'Publish Date:') !!}
    <p>{{ $blog->publish_date }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $blog->status }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $blog->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $blog->updated_at }}</p>
</div>

