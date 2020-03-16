@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">

                <div class="card-header bg-primary"><h5 class="text-light">{{$manga->title}}</h5></div>
                <div class="row no-gutters bg-light position-relative">
                    <div class="col-md-3 mb-md-0 p-md-3">
                        <img src="/uploads/mangaimage/{{ $manga->mangaimage }}" class="w-100 h-100" alt="...">
                    </div>
                    <div class="col-md-9 position-static p-4 pl-md-0">
                        <h5 class="mt-0">
                        Data
                        </h5>
                        <p>ผู้แต่ง : {{ $manga->author }}</p>
                        <p>parent : {{ $manga->user->name }}</p>
                        <p>เรื่องย่อ : </p>

                        <?php
                            $TEXT = $manga->resume;
                            $TEXT = str_replace("\n", "<br>\n", "$TEXT");
                            echo $TEXT;
                        ?>
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
                    @if($episode->manga_id == $manga->id)

                        <div class="card card-body btn-light" onclick="openEp({{$episode->id}})">
                            <div class="row">
                                  <div class="col-10">
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
      $('span').css('font-size', 15);

      function openEp(id) {
        window.location = '/mangaDetail/episode/'+id;
      }

</script>

@endsection
