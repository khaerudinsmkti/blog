@extends('template_blog.content')
@section('isi')
    @foreach ($data as $isi_post)
    <div class="section-row">
        <img src="{{ asset($isi_post->gambar)  }}" alt="" class="img-fluid">
        {!! $isi_post->content !!}
    </div>
    @endforeach
@endsection