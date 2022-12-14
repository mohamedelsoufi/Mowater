<?php

namespace App\Http\Controllers\API\Organizations;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ShowAgencyRequest;
use App\Http\Resources\Agencies\GetAgenciesResource;
use App\Http\Resources\Agencies\ShowAgencyResource;
use App\Http\Resources\Products\GetProductsResource;
use App\Http\Resources\Services\GetServicesResource;
use App\Models\Agency;
use App\Models\Branch;
use App\Models\Category;
use App\Models\DiscountCard;
use App\Models\Product;
use App\Models\Service;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use function PHPUnit\Framework\isEmpty;

class AgencyController extends Controller
{
    public function index()
    {
        try {
            $agencies = Agency::active()->available()
                ->search()->latest('id')->paginate(PAGINATION_COUNT);

            $agencies->makeHidden('car_models');
            if (empty($agencies))
                return responseJson(0,__('message.no_result'));
            return responseJson(1, 'success', GetAgenciesResource::collection($agencies)->response()->getData(true));
        }catch (\Exception $e){
            return responseJson(0,'error',$e->getMessage());
        }
    }

    public function show(ShowAgencyRequest $request)
    {
        $agency = Agency::active()->find($request->id);
        if (empty($agency))
            return responseJson(0,__('message.no_result'));
        //update number of views start
        updateNumberOfViews($agency);
        //update number of views end

        return responseJson(1, 'success', new ShowAgencyResource($agency));

    }

    public function products(ShowAgencyRequest $request)
    {
        try {
            $agency = Agency::active()->find($request->id);
            if (!$agency) {
                return responseJson(0, 'Agency is not available now');
            }
            $products = $agency->products()->search()->active()->latest('id')->paginate(PAGINATION_COUNT);
            if (empty($products))
                return responseJson(0,__('message.no_result'));
            return responseJson(1, 'success', GetProductsResource::collection($products)->response()->getData(true));
        } catch (\Exception $e) {
            return responseJson(0, 'error', $e->getMessage());
        }
    }

    public function services(ShowAgencyRequest $request)
    {
        try {
            $agency = Agency::active()->find($request->id);
            if (!$agency) {
                return responseJson(0, 'Agency is not available now');
            }

            $services = $agency->services()->active()->latest('id')->paginate(PAGINATION_COUNT);
            if (empty($services))
                return responseJson(0,__('message.no_result'));
            return responseJson(1, 'success', GetServicesResource::collection($services)->response()->getData(true));
        } catch (\Exception $e) {
            return responseJson(0, 'error', $e->getMessage());
        }
    }

    public function categories()
    {
        //agnecy 3 categories
        $categories = Category::whereHas('section', function (Builder $query) {

            $query->where('ref_name', 'Agency');

        })->latest('id')->get();
        if (empty($categories))
            return responseJson(0,__('message.no_result'));
        return responseJson(1, 'success', $categories);
    }

    public function getDiscountCardOffers(ShowAgencyRequest $request)
    {
        $agency = Agency::selection()->active()->find($request->id);

        $discount_cards = $agency->discount_cards()->where('status', 'started')->get();

        if (!$discount_cards->isEmpty()) {
            $products = $agency->products()->wherehas('offers')->get();

            $services = $agency->services()->wherehas('offers')->get();

            $vehicles = $agency->vehicles()->with(['brand', 'car_model', 'car_class', 'files' => function ($query) {
                $query->with('color');
            }])->overView()->wherehas('offers')->get();

            foreach ($products as $product) {
                $product->kind = 'product';
                foreach ($product->offers as $offer) {
                    $discount_type = $offer->discount_type;
                    $percentage_value = ((100 - $offer->discount_value) / 100);
                    if ($discount_type == 'percentage') {
                        $price_after_discount = $product->price * $percentage_value;
                        $product->card_discount_value = $offer->discount_value . '%';
                        $product->card_price_after_discount = $price_after_discount . ' BHD';
                        $product->card_number_of_uses_times = $offer->number_of_uses_times == 'endless' ? __('words.endless') : $offer->specific_number;
                    } else {
                        $price_after_discount = $product->price - $offer->discount_value;
                        $product->card_discount_value = $offer->discount_value . ' BHD';
                        $product->card_price_after_discount = $price_after_discount . ' BHD';
                        $product->card_number_of_uses_times = $offer->number_of_uses_times == 'endless' ? __('words.endless') : $offer->specific_number;
                    }
                    $product->notes = $offer->notes;
                    $product->makeHidden('offers');
                }
            }

            foreach ($services as $service) {
                $service->kind = 'service';
                foreach ($service->offers as $offer) {
                    $discount_type = $offer->discount_type;
                    $percentage_value = ((100 - $offer->discount_value) / 100);
                    if ($discount_type == 'percentage') {
                        $price_after_discount = $service->price * $percentage_value;
                        $service->card_discount_value = $offer->discount_value . '%';
                        $service->card_price_after_discount = $price_after_discount . ' BHD';
                        $service->card_number_of_uses_times = $offer->number_of_uses_times == 'endless' ? __('words.endless') : $offer->specific_number;
                    } else {
                        $price_after_discount = $service->price - $offer->discount_value;
                        $service->card_discount_value = $offer->discount_value . ' BHD';
                        $service->card_price_after_discount = $price_after_discount . ' BHD';
                        $service->card_number_of_uses_times = $offer->number_of_uses_times == 'endless' ? __('words.endless') : $offer->specific_number;
                    }
                    $service->notes = $offer->notes;
                    $service->makeHidden('offers');
                }
            }

            foreach ($vehicles as $vehicle) {
                $vehicle->kind = 'vehicle';
                foreach ($vehicle->offers as $offer) {
                    $discount_type = $offer->discount_type;
                    $percentage_value = ((100 - $offer->discount_value) / 100);
                    if ($discount_type == 'percentage') {
                        $price_after_discount = $vehicle->price * $percentage_value;
                        $vehicle->card_discount_value = $offer->discount_value . '%';
                        $vehicle->card_price_after_discount = $price_after_discount . ' BHD';
                        $vehicle->card_number_of_uses_times = $offer->number_of_uses_times == 'endless' ? __('words.endless') : $offer->specific_number;
                    } else {
                        $price_after_discount = $vehicle->price - $offer->discount_value;
                        $vehicle->card_discount_value = $offer->discount_value . ' BHD';
                        $vehicle->card_price_after_discount = $price_after_discount . ' BHD';
                        $vehicle->card_number_of_uses_times = $offer->number_of_uses_times == 'endless' ? __('words.endless') : $offer->specific_number;
                    }
                    $vehicle->notes = $offer->notes;
                    $vehicle->features = $vehicle->vehicleProperties();
                    $vehicle->makeHidden('offers');
                }
            }
            $merged = collect($vehicles)->merge($products)->merge($services)->paginate(PAGINATION_COUNT);
            return responseJson(1, 'success', $merged);
//            return responseJson(1, 'success', ['vehicles' => $vehicles, 'products' => $products, 'services' => $services]);

        } else {
            return responseJson(0, 'error', __('message.something_wrong'));
        }

    }


}
