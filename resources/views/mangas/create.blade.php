@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header bg-primary"><h5 class="text-light">Create Manga</h5></div>
                <div class="card-body">
                    <form enctype="multipart/form-data" method="post" action="{{ route('mangas.store') }}">
                        <div class="form-group">
                            @csrf
                            <div class="col-md-12 mb-2">
                                <label>Manga Image</label><br>
                                <img id="image_preview_container" src="/uploads/mangaimage/mangaimagedefault.jpg" alt="preview image" style="height: 311px;">
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">

                                  <input type="file" name="mangaimage" id="image">
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}" class="btn btn-success"><br/>
                                </div>
                            </div>

                            <label class="label">ชื่อเรื่อง: </label>
                            <input type="text" name="title" class="form-control" required/>
                            <label class="label">ผู้แต่ง: </label>
                            <input type="text" name="author" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label class="label">เรื่องย่อ: </label>
                            <!-- <textarea name="asa" rows="9" style="font-size:25px" class="form-control" required></textarea> -->
                            <textarea name="resume" rows="20" required></textarea>

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
    CKEDITOR.replace( 'resume' );
</script>
<script type="text/javascript">

    $(document).ready(function (e) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#image').change(function(){

            let reader = new FileReader();
            reader.onload = (e) => {
              $('#image_preview_container').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);

        });

    });

</script>
@endsection
