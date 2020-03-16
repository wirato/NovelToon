@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary"><h6 class="text-light">{{$manga->title}}่</h6></div>

                <div class="card-body">
                    <h5><strong>เพิ่มตอนใหม่</strong></h5><br>
                    <form method="post" enctype="multipart/form-data" action="{{ route('createMangaEpisode.store' ) }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="hidden" name="manga_id" value="{{ $manga->id }}" />
                            <input type="hidden" name="manga_title" value="{{ $manga->title }}" />
                            <label class="label">ตอนที่: </label>
                            <input type="number" name="ep" class="form-control" required/>
                            <label class="label">ชื่อตอน: </label>
                            <input type="text" name="title" class="form-control" value="-"/>
                        </div>

                        <div class="form-group">
                            <label for="title">Image/file</label>

                            <input type="file" name="images[]" class="form-control" multiple="">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" class="btn btn-success"><br/>
                        </div>



                        <div class="text-group">
                            <input type="submit" class="btn btn-primary" value="เพิ่มตอนใหม่"/>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
