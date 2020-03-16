@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
              <div class="card-header bg-primary">
                  <div class="row">
                        <div class="col-sm-7">
                            <a class="text-decoration-none" href="{{ route('mangaDetails', $episode->manga_id) }}">
                                <h8 class="text-light">{{ $episode->manga_title }}</h8>
                            </a>
                        </div>
                        <div class="col-sm-5">
                              <table width="100%">
                                  <tbody>
                                      <tr>
                                          <td width="20%">
                                            @if($back == 0)
                                                <a href="{{ route('readManga',$back ) }}" class="btn btn-light float-right disabled"  style="border-radius: 50px;">
                                                       <i class='fas fa-arrow-left'></i>
                                                </a>
                                            @else
                                                <a href="{{ route('readManga',$back ) }}" class="btn btn-light float-right"  style="border-radius: 50px;">
                                                       <i class='fas fa-arrow-left'></i>
                                                </a>
                                            @endif
                                          </td>
                                          <td width="60%">
                                            <select id="idSelect" class="form-control form-control-sm">
                                              @foreach($eplists as $eplist)
                                                  @if($eplist->manga_id == $m_id)
                                                    @if($eplist->ep == $episode->ep)
                                                      <option value="{{ $eplist->id }}" selected>ตอนที่ {{ $eplist->ep }} : {{ $eplist->title }}</option>
                                                    @else
                                                      <option value="{{ $eplist->id }}" type="submit">ตอนที่ {{ $eplist->ep }} : {{ $eplist->title }}</option>
                                                    @endif
                                                  @endif
                                              @endforeach
                                            </select>
                                          </td>
                                          <td width="20%">
                                            @if($next == 0)
                                            <a href="{{ route('readManga',$next ) }}" class="btn btn-light float-left disabled" style="border-radius: 50px;">
                                                 <i class='fas fa-arrow-right'></i>
                                            </a>
                                            @else
                                            <a href="{{ route('readManga',$next ) }}" class="btn btn-light float-left" style="border-radius: 50px;">
                                                 <i class='fas fa-arrow-right'></i>
                                            </a>
                                            @endif

                                          </td>
                                      </tr>
                                   </tbody>
                              </table>
                        </div>
                    </div>

              </div>

                <div class="card-body">
                    <div>
                      @foreach($images as $image)
                        @if($episode->id == $image->post_episodemangas_id)
                        <img class="card-img-top card-img-left" id="page{{$image->page}}" src="/uploads/mangaimage/epimage/{{ $image->image }}" width="180">
                        <br><br>
                        <h5 class="text-center text-primary">
                          <b>Page No.{{$image->page}} / {{ $count }}</b>
                        </h5><br>
                        @endif
                      @endforeach
                    </div>
                </div>
                <div class="col-sm-5 container">
                      <table width="100%">
                          <tbody>
                              <tr>
                                  <td width="20%">
                                    @if($back == 0)
                                        <a href="{{ route('readManga',$back ) }}" class="btn btn-primary float-right disabled"  style="border-radius: 50px;">
                                               <i class='fas fa-arrow-left'></i>
                                        </a>
                                    @else
                                        <a href="{{ route('readManga',$back ) }}" class="btn btn-primary float-right"  style="border-radius: 50px;">
                                               <i class='fas fa-arrow-left'></i>
                                        </a>
                                    @endif
                                  </td>
                                  <td width="60%">
                                    <select id="idSelect2" class="form-control form-control-sm">
                                      @foreach($eplists as $eplist)
                                          @if($eplist->manga_id == $m_id)
                                            @if($eplist->ep == $episode->ep)
                                              <option value="{{ $eplist->id }}" selected>ตอนที่ {{ $eplist->ep }} : {{ $eplist->title }}</option>
                                            @else
                                              <option value="{{ $eplist->id }}" type="submit">ตอนที่ {{ $eplist->ep }} : {{ $eplist->title }}</option>
                                            @endif
                                          @endif
                                      @endforeach
                                    </select>
                                  </td>
                                  <td width="20%">
                                    @if($next == 0)
                                    <a href="{{ route('readManga',$next ) }}" class="btn btn-primary float-left disabled" style="border-radius: 50px;">
                                         <i class='fas fa-arrow-right'></i>
                                    </a>
                                    @else
                                    <a href="{{ route('readManga',$next ) }}" class="btn btn-primary float-left" style="border-radius: 50px;">
                                         <i class='fas fa-arrow-right'></i>
                                    </a>
                                    @endif

                                  </td>
                              </tr>
                           </tbody>
                      </table>
                </div><br>

            </div>
        </div>
    </div>
</div>

<script>
      $('#idSelect').bind("change keyup",function()
      {
            console.log($(this).val());
          window.location = '/mangadetails/episode/'+$(this).val();
      });
      $('#idSelect2').bind("change keyup",function()
      {
            console.log($(this).val());
          window.location = '/mangadetails/episode/'+$(this).val();
      });

</script>

@endsection
