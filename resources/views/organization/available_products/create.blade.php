@extends('organization.layouts.app')
@section('title','Mawatery | available_products')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.create_available_products')}}</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.available_products')}}</li>
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
                          <form action="{{route('organization.available_product.store')}}" method = "POST">
                              @csrf

                            
                                {{-- products --}}
                                <h3>{{__('words.available_products')}}</h3>
                                <div class="table-responsive">
                                    <table class="table primary-table-bordered">
                                        <thead class="thead-primary">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">{{__('words.image')}}</th>
                                                <th scope="col">{{__('words.name')}}</th>
                                                <th scope="col">{{__('words.product_status')}}</th>
                                                <th scope="col">{{__('words.price')}}</th>
                                                <th scope="col">{{__('words.type')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($products as $product)
                                            <tr>
                                                <td> 
                                                    <input type="checkbox" name = "products[]" id = "product_{{$product->id}}" value = "{{$product->id}}" {{in_array($product->id , $available_products) ? 'checked' : ''}}  >
                                                </td>
                                                <td>
                                                    @if(!$product->one_image)
                                                        <a href="{{asset('uploads/default_image.png')}}" data-toggle="lightbox">
                                                            <img class="slider_image" src="{{asset('uploads/default_image.png')}}" alt="">
                                                        </a>
                                                    @else
                                                        <a href="{{$product->one_image}}" data-toggle="lightbox">
                                                            <img class="slider_image" src="{{$product->one_image}}" onerror="this.src='{{asset('uploads/default_image.png')}}'" alt="">
                                                        </a>
                                                    @endif
                                                </td>
                                                <td><label for="product_{{$product->id}}">{{$product->name}}</label></td>
                                                <td><label for="product_{{$product->id}}">{{$product->status}}</label></td>
                                                <td><label for="product_{{$product->id}}">{{$product->price}}</label></td>
                                                <td>{{__('words.' . $product->type)}}</td>
                                                
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                               
                                

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-outline-primary">{{__('words.edit')}}</button>
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
.select2-container--default .select2-selection--multiple .select2-selection__choice
{
    background-color: #343957;
}
</style>
@endsection

@section('scripts')
  <script>
      $(".select2").select2();
  </script>
@endsection

