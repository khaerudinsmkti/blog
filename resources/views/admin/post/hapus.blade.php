@extends('template_backend.home')
@section('sub-judul','Post Trashed')   
@section('content')

    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session('success')}}
        </div>
    @endif

    <table class="table table-striped table-hover table-sm table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Post</th>
                <th>Kategori</th>
                <th>Tags</th>
                <th>Gambar</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($post as $result => $hasil)
            <tr>
                <td>{{ $result + $post->firstitem() }}</td>
                <td>{{ $hasil->judul}}</td>
                <td>{{ $hasil->category->name }}</td>
                <td>
                    @foreach($hasil->tags as $tag)
                    <ul>
                        <li>{{ $tag->name }}</li>
                    </ul>
                    @endforeach
                </td>

                <td><img src="{{ asset($hasil->gambar) }}" alt="" class="img-fluid" style="width:100px"></td>
                <td>
                <form action="{{ route('post.kill', $hasil->id)}}" method="POST">
                    @csrf
                    @method('delete')
                    <a href="{{ route('post.restore', $hasil->id )}}" class="btn btn-primary btn-sm">Restore</a>
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $post->links() }}

@endsection