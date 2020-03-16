@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
              <div class="card-header bg-primary">
                  <div class="row">
                        <div class="col-sm-7">
                            <a class="text-decoration-none" href="{{ route('noveldetails', $novel_one->id) }}">
                                <h8 class="text-light">{{ $novel_one->title }}</h8>
                            </a>
                        </div>
                        <div class="col-sm-5">
                              <table width="100%">
                                  <tbody>
                                      <tr>
                                          <td width="20%">
                                            @if($back == 0)
                                                <a class="btn btn-light float-right disabled"  style="border-radius: 50px;">
                                                       <i class='fas fa-arrow-left'></i>
                                                </a>
                                            @else
                                                <a href="{{ route('readEp',$back ) }}" class="btn btn-light float-right"  style="border-radius: 50px;">
                                                       <i class='fas fa-arrow-left'></i>
                                                </a>
                                            @endif
                                          </td>
                                          <td width="60%">
                                            <select id="idSelect" class="form-control form-control-sm">
                                              @foreach($eps as $ep)
                                                  @if($ep->novel_id == $episode->novel_id)
                                                    @if($ep->ep == $episode->ep)
                                                      <option  selected>ตอนที่ {{ $ep->ep }} : {{ $ep->title }}</option>
                                                    @else
                                                      <option value="{{ $ep->id }}" type="submit">ตอนที่ {{ $ep->ep }} : {{ $ep->title }}</option>
                                                    @endif
                                                  @endif
                                              @endforeach
                                            </select>
                                          </td>
                                          <td width="20%">
                                            @if($next == 0)
                                            <a class="btn btn-light float-left disabled" style="border-radius: 50px;">
                                                 <i class='fas fa-arrow-right'></i>
                                            </a>
                                            @else
                                            <a href="{{ route('readEp',$next ) }}" class="btn btn-light float-left" style="border-radius: 50px;">
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
                        <strong style="font-size:25px">ตอนที่ {{ $episode->ep }} {{ $episode->title }}</strong><br/><br/><br/>
                    </div>
                    <div class="" align="right">
                      <b>
                        ปรับขนาดตัวอัดษร&nbsp&nbsp
                        <a id="a2" class="fa btn btn-primary text-light"> &#xf031;- </a>&nbsp
                        <i id="a1" class="fa btn btn-primary">&#xf021;</i></i>&nbsp
                        <a id="a3" class="fa btn btn-primary text-light"> &#xf031;+ </a> <br/><br/>
                      </b>
                    </div>
                    <div>
                      <div>

                          <?php
                              $TEXT = $episode->detail;
                              $TEXT = str_replace("<br/>", "<br>\n", "$TEXT");
                              echo $TEXT;

                          ?>
                        <br/>
                      </div>
                      <hr />
                </div>
                <div class="col-sm-5 container">
                  <table width="100%">
                      <tbody>
                          <tr>
                              <td width="20%">
                                @if($back == 0)
                                    <a class="btn btn-primary float-right disabled"  style="border-radius: 50px;">
                                           <i class='fas fa-arrow-left'></i>
                                    </a>
                                @else
                                    <a href="{{ route('readEp',$back ) }}" class="btn btn-primary float-right"  style="border-radius: 50px;">
                                           <i class='fas fa-arrow-left'></i>
                                    </a>
                                @endif
                              </td>
                              <td width="60%">
                                <select id="idSelect2" class="form-control form-control-sm">
                                  @foreach($eps as $ep)
                                      @if($ep->novel_id == $episode->novel_id)
                                        @if($ep->ep == $episode->ep)
                                          <option  selected>ตอนที่ {{ $ep->ep }} : {{ $ep->title }}</option>
                                        @else
                                          <option value="{{ $ep->id }}" type="submit">ตอนที่ {{ $ep->ep }} : {{ $ep->title }}</option>
                                        @endif
                                      @endif
                                  @endforeach
                                </select>
                              </td>
                              <td width="20%">
                                @if($next == 0)
                                <a class="btn btn-light float-primary disabled" style="border-radius: 50px;">
                                     <i class='fas fa-arrow-right'></i>
                                </a>
                                @else
                                <a href="{{ route('readEp',$next ) }}" class="btn btn-primary float-left" style="border-radius: 50px;">
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
          window.location = '/noveldetails/episode/'+$(this).val();
      });
      $('#idSelect2').bind("change keyup",function()
      {
            console.log($(this).val());
          window.location = '/noveldetails/episode/'+$(this).val();
      });

</script>
<script>
      var Size = 20;
      $('span').css('font-size', 20);

      $(function(){
        $("#a1").click(function(){
            Size = 20;
            $('span').css('font-size', Size);
        });

        $("#a2").click(function(){
          Size -= 1;
          $('span').css('font-size', Size);
        });

        $("#a3").click(function(){
          Size += 1;
          $('span').css('font-size', Size);
        })

      });
</script>

@endsection
