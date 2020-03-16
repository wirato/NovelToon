@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header bg-primary"><h5 class="text-light">{{$novel->title}}่</h5></div>

                <div class="card-body">
                  <h4><strong>เพิ่มตอนใหม่</strong></h4><br>
                  <form method="post" action="{{ route('episodes.store' ) }}">
                      @csrf
                      <div class="form-group">
                          <input type="hidden" name="novel_id" value="{{ $novel->id }}" />
                          <label class="label">ตอนที่: </label>
                          <input type="number" name="ep" class="form-control" required/>
                          <label class="label">ชื่อตอน: </label>
                          <input type="text" name="title" class="form-control" required/>
                          <label class="label">เนื้อหา: </label>
                          <textarea name="detail" rows="10" class="form-control" style="font-size:25px"  required></textarea>

                      </div>
                      <div class="form-group">
                          <input type="submit" class="btn btn-primary" value="เพิ่มตอนใหม่"/>
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
