@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class=" col-md-11">

          @if(isset($novels))
            <div class="card">
                <div class="card-header bg-primary"><h5 class="text-light">ระบบกำลังค้นหา : <i><b>{{ $q }}</b></i></h5></div>
                <div class="row no-gutters bg-light position-relative">
                </div>
              </div>
            <br>
            <h3>Novel</h3>
            <hr>
            <div class="row row-cols-1 row-cols-md-3">
                @foreach($novels as $novel)
                <div class="card mb-3 " style="height:200px;">
                    <a class="text-decoration-none" href="{{ route('noveldetails', $novel->id) }}">
                  <div class="row no-gutters">
                    <div class="col-md-4 overflow-hidden" style="height:200px;">
                        <img src="/uploads/novelimage/{{ $novel->novelimage }}" class="card-img" alt="..." style="height:200px;">
                    </div>
                    <div class="col-md-8 ">
                      <div class="overflow-hidden" style="height:200px;">
                        <div class="col-md-12 card overflow-hidden float-right" style="height:40px;">
                          <h6 class="text-left text-primary"><strong>
                            <?php
                                {{$str = $novel->title;}}
                                $cutstr = substr($str,0,125);
                                echo $cutstr.'...';

                            ?>
                          </strong></h6>
                        </div>
                        <div class="col-md-12 overflow-hidden float-right" style="height:140px;">
                          <?php
                              {{$str = $novel->srsume;}}

                              echo '<br>'.$str;
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  </a>
                </div>
                @endforeach
            </div>
            @else
            <div class="card">
                <div class="card-header bg-primary"><h5 class="text-light">ระบบกำลังค้นหา : <i><b>{{ $query }}</b></i></h5></div>
                <div class="row no-gutters bg-light position-relative">
                </div>
              </div>
              <br>
              <h3>Novel</h3>
              <hr>
              <h3 class="text-left text-primary"> 'ไม่พบข้อมูลที่ตรงกับเงื่อนไขการค้นหา' </h3>
            @endif
            @if(isset($mangas))
            <br>

            <h3>Manga</h3>
            <hr>
            <div class="row row-cols-1 row-cols-md-3">
              @foreach($mangas as $manga)

                  <div class="card mb-3" style="height:200px;">
                      <a class="text-decoration-none" href="{{ route('mangaDetail', $manga->id) }}">
                    <div class="row no-gutters">
                      <div class="col-md-4 overflow-hidden" style="height:200px;">
                        <img src="/uploads/mangaimage/{{ $manga->mangaimage }}" class="card-img" alt="..." style="height:200px;">
                      </div>
                      <div class="col-md-8 ">
                        <div class="overflow-hidden" style="height:200px;">
                          <div class="col-md-12 card overflow-hidden float-right" style="height:40px;">
                            <h6 class="text-left text-primary"><strong>
                              <?php
                                  {{$str = $manga->title;}}
                                  $cutstr = substr($str,0,125);
                                  echo $cutstr.'...';
                              ?>
                            </strong></h6>
                          </div>
                          <div class="col-md-12 overflow-hidden float-right" style="height:140px;">
                            <?php
                                {{$str = $manga->resume;}}
                                echo '<br>'.$str;

                            ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    </a>
                  </div>

              @endforeach
            </div>
            @else

              <br>
              <h3>Manga</h3>
              <hr>
              <h3 class="text-left text-primary"> 'ไม่พบข้อมูลที่ตรงกับเงื่อนไขการค้นหา' </h3>
            @endif
        </div>
    </div>
</div>
<script>
  $('span').css('font-size', 14);
</script>
@endsection
