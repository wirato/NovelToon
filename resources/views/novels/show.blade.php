@extends('layouts.app')

@section('content')
@if( Auth::user()->id == $novel->user_id )

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header bg-primary"><h5 class="text-light">{{$novel->title}}</h5></div>
                <div class="row no-gutters bg-light position-relative  card-body">
                    <div class="col-md-3 mb-md-0 p-md-3">
                        <img src="/uploads/novelimage/{{ $novel->novelimage }}" class="w-100 h-100" alt="..." style="height:300px;">
                    </div>
                    <div class="col-md-9 position-static p-4 pl-md-0">
                        <h5 class="mt-0">
                        Data

                        <a href=""  class="float-right" data-toggle="modal" data-target="#exampleModal">
                            &nbsp;&nbsp;<i class='fa fa-minus-circle text-danger'></i>
                        </a>
                        <a href="{{ route('edit' , $novel->id) }}"  class="float-right">
                            <i class='far fa-edit'></i>
                        </a>
                      <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ $novel->title }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        คุณต้องการลบตอนนี้ออกไปหรือไม่
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>

                                        <form class="" action="{{ route('novels.update', $novel->id) }}" method="post">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-xs btn-danger">ลบ</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </h5>
                        <p>ผู้แต่ง : {{ $novel->author }}</p>
                        <p>parent : {{ $novel->user->name }}</p>

                    </div>

                    <div class="">
                      <hr>
                      <h4><strong>บทนำ</strong></h4><br>
                        <div class="row">
                          <?php
                              $TEXT = $novel->srsume;
                              $TEXT = str_replace("\n", "<br>\n", "$TEXT");
                              echo $TEXT;
                          ?>
                        </div>
                    </div>

                  </div>
                </div>
              <br>
              <div class="card">
                  <div class="card-header bg-primary">
                    <div class="row">
                          <div class="col-8">
                                <h5 class="header text-light">สารบัญ</h5>
                          </div>
                          <div class="col-4">
                                <a href="{{ route('novelep', $novel->id) }}"  class="float-right">
                                  <h6 class="text-light"> <i class='fa fa-plus'> เพิ่มตอนใหม่</i> </h6>
                                </a>
                          </div>
                      </div>
                  </div>
                  @foreach($episodes as $episode)
                    @if($episode->novel_id == $novel->id)

                        <div class="card card-body btn-light" onclick="openEp({{$episode->id}})">
                            <div class="row">
                                  <div class="col-9">
                                    <p class="card-text">ตอนที่ {{ $episode->ep }} {{ $episode->title }}</p>
                                  </div>
                                  <div class="col-3">

                                      <a href="{{ route('mynovelep',$episode->id ) }}"  class="btn btn-sm btn-primary"> อ่าน </a>
                                      <a href="{{ route('editEp' , $episode->id) }}"  class="btn btn-sm btn-info ">แก้ไข</a>
                                      <!-- Button trigger modal -->
                                      <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal{{$episode->id}}">
                                          ลบ
                                      </button>
                                    <!-- Modal -->
                                      <div class="modal fade" id="exampleModal{{$episode->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <h5 class="modal-title" id="exampleModalLabel">ตอนที่ {{ $episode->ep }} {{ $episode->title }}</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                      </button>
                                                  </div>
                                                  <div class="modal-body">
                                                      คุณต้องการลบตอนนี้ออกไปหรือไม่
                                                  </div>
                                                  <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>

                                                      <form class="" action="{{ route('episodes.update', $episode->id) }}" method="post">
                                                          @csrf
                                                          {{ method_field('DELETE') }}
                                                          <button type="submit" class="btn btn-xs btn-danger">ลบ</button>
                                                      </form>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                        </div>

                      @endif
                    @endforeach
              </div>
        </div>
    </div>
</div>
<script>
    $('span').css('font-size', 20);
    console.log( $('span'));

      // function openEp(id) {
      //   window.location = '/mangadetails/episode/'+id;
      // }

</script>
@endif
@endsection
