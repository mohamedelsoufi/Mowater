@extends('organization.layouts.app')
@section('title','Mawatery | coverage types')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.create_coverage_type')}}</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.coverage_types')}}</li>
                    </ol>
                </div>
                @include('organization.includes.alerts.success')
                @include('organization.includes.alerts.errors')
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        {{-- create modal start --}}
                        <div class="card-header">
                            
                        </div>

                        <div class="card-body">
                          <form action="{{route('organization.coverage_type.store')}}" method = "POST">
                              @csrf
                              
                              {{--Main Data --}}
                              <div class="row">

                                <div class="form-group col-md-6">
                                    <label>{{__('words.name_en')}}</label>
                                    <input type="text" name = "name_en" value = "{{old('name_en')}}" class="form-control @error('name_en') is-invalid @enderror">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>{{__('words.name_ar')}}</label>
                                    <input type="text" name = "name_ar" value = "{{old('name_ar')}}" class="form-control @error('name_ar') is-invalid @enderror">
                                </div>
                              </div>

                              <h3>{{__('words.features')}}</h3>
                              <br>

                              <button type = "button" style = "color: white;" class = "btn bg-success add_feature">{{__('words.add_feature')}} <i class="fas fa-plus"></i></button>
                              <br><br>
                              <div class="row features_container">
                               
                                @if(old('features_name_en') )
                                    @for($i = 0; $i<count( old('features_name_en') );   $i++)
                                    <div class="feature row">
                                        <div class="form-group col-md-3">
                                            <label for="">{{__('words.name_en')}}</label>
                                            <input type="text" name = "features_name_en[{{$i}}]" value = "{{ array_key_exists($i , old('features_name_en')) ? old('features_name_en')[$i] : ''  }} " class = "form-control">
                                        </div>
            
                                        <div class="form-group col-md-3">
                                            <label for="">{{__('words.name_ar')}}</label>
                                            <input type="text" name = "features_name_ar[{{$i}}]" value = "{{ array_key_exists($i , old('features_name_ar')) ? old('features_name_ar')[$i] : ''  }} " class = "form-control">
                                        </div>
            
                                        <div class="form-group col-md-3">
                                            <label for="">{{__('words.price')}}</label>
                                            <input type="number" name = "features_price[{{$i}}]" value = "{{ array_key_exists($i , old('features_price')) ? old('features_price')[$i] : ''  }} " class = "form-control">
                                        </div>
            
                                        <div class="form-group col-md-1">
                                            <button style = "position: relative; top: 27px;" type="button" class = "btn btn-outline-danger remove_feature"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                    @endfor
                                @endif

                      
                              </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-outline-primary">{{__('words.create')}}</button>
                                </div>

                          </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('styles')
<style>

</style>
@endsection


@section('scripts')
  <script>
      $(".add_feature").click(function(e){

          var feature_count = $(".feature").length; //3
        
          var new_div = `
                        <div class="feature row">
                            <div class="form-group col-md-3">
                                <label for="">{{__('words.name_en')}}</label>
                                <input type="text" name = "features_name_en[${feature_count}]" class = "form-control">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="">{{__('words.name_ar')}}</label>
                                <input type="text" name = "features_name_ar[${feature_count}]" class = "form-control">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="">{{__('words.price')}}</label>
                                <input type="number" name = "features_price[${feature_count}]" class = "form-control">
                            </div>

                            <div class="form-group col-md-1">
                                <button style = "position: relative; top: 27px;" type="button" class = "btn btn-outline-danger remove_feature"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                        `;

            $(".features_container").append(new_div);
      });



      $(document).ready(function(){
        $(document).on("click", "button.remove_feature" , function() {
                $(this).parent().parent().remove();
        });
      });
    
    
  </script>
@endsection

