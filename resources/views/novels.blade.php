@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
          <h3>Novels All</h3>
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
            <hr>
        </div>

    </div>
</div>
<script>
  $('span').css('font-size', 14);
</script>

@endsection
