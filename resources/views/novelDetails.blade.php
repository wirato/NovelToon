@extends('layouts.app')

@section('content')

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

      function openEp(id) {
        window.location = '/noveldetails/episode/'+id;
      }

</script>

@endsection
