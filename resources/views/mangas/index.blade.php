@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">

            <h3><b class="text-primary">My Mangas</b>
            <a href="{{ route('mangas.create') }}" class="btn btn-primary " style="float: right">
              <i class='fa fa-plus'></i><span>  Create Manga </span>
            </a></h3>

            <hr>

            <div class="row row-cols-1 row-cols-md-3">
            @foreach($mangas as $manga)
              @if( Auth::user()->id == $manga->user_id)

                <div class="card mb-3" style="height:200px;">
                    <a class="text-decoration-none" href="{{ route('mangaDetails', $manga->id) }}">
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
                        <div class="col-md-12 overflow-hidden float-right">
                          <?php
                              {{$str = $manga->resume;}}
                              $cutstr = substr($str,0,500);
                              echo $cutstr;
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

        </div>
    </div>
</div>
<script>
  $('span').css('font-size', 14);
</script>

@endsection
