@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
          <h3>Novel</h3>
          <hr>
            <div class="row row-cols-1 row-cols-md-3">

            @foreach($novels as $novel)
            @if($count < 9)
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
                            $count++;
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
                </a>
              </div>
              @endif
            @endforeach
            </div>
            <div class="col-sm-2 container">
              <a href="{{ url('/allnovels') }}" class="btn btn-primary">แสดงทั้งหมด</a>
            </div>

        </div>

        <div class="col-md-11">
          <br><br><br>
          <h3>Manga</h3>
          <hr>
          <div class="row row-cols-1 row-cols-md-3">
          @foreach($mangas as $manga)
            @if($count2 < 9)
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
                            $count2++;
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
                </a>
              </div>
              @endif
          @endforeach
          </div>
          <div class="col-sm-2 container">
            <a href="{{ url('/mangasall') }}" class="btn btn-primary">แสดงทั้งหมด</a>
            <br><br><br><br><br><br><br>
          </div>
        </div>

    </div>
</div>
<script>
  $('span').css('font-size', 14);
</script>

@endsection
