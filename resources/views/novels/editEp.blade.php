@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
              @foreach($novels as $novel)
                @if($episode->novel_id == $novel->id)
                  <div class="card-header bg-primary"><h5 class="text-light">{{$novel->title}}่</h5></div>
                @endif
              @endforeach
                <div class="card-body">
                  <h5><strong>แก้ไข</strong></h5><br>
                  <form method="post" action="{{ route('episodes.update', $episode->id) }}">
                      @csrf
                      {{ method_field('PUT') }}

                      <div class="form-group">

                          <label class="label">ตอนที่: </label>
                          <input type="number" name="ep" class="form-control" required/ value="{{ $episode->ep }}">
                          <label class="label">ชื่อตอน: </label>
                          <input type="text" name="title" class="form-control" required/ value="{{ $episode->title }}">
                          <label class="label">เนื้อหา: </label>
                          <textarea name="detail" rows="10" class="form-control" style="font-size:25px"  required>
                            {{ $episode->detail }}
                          </textarea>

                      </div>
                      <div class="form-group">
                          <input type="submit" class="btn btn-primary" value="บันทึก"/>
                      </div>

                  </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace( 'detail' );
</script>
@endsection
