<?php

namespace App\Http\Controllers\Orders;

use App\Exceptions\DatabaseErrorException;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Orders\StoreRequest;
use App\Models\domains\Orders\OrderEntity;
use App\Models\Product;
use App\Models\Order;
use App\Models\Deliver;
use App\Enums\Orders\OrdersProgress;
use App\Enums\Orders\OrdersSettlementState;
use App\Models\Address;
use App\Models\Demand;
use App\Models\domains\Delivers\DeliverEntity;
use App\Models\domains\Addresses\FullNameEntity;
use App\Models\domains\Addresses\AddressContentEntity;
use App\Models\domains\Demands\DemandEntity;
use App\Models\Stripe\StripeSubscription;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class Store extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param StoreRequest $request
     * @return JsonResponse
     * @throws DatabaseErrorException
     */
    public function __invoke(StoreRequest $request)
    {
        $input = new Collection($request->input());
        $stripe = new StripeSubscription();
        $stripe->setMyCustomerId();
        $product = Product::find($input->get('product_id'));
        $user = Auth::user();
        $stripeSubscriptionResult = $stripe->createSubscription(
            $product->stripe_plan_id,
            $input->get('stripe_card_id')
        );
        $orderResult = (new Order)->create(new OrderEntity(
            $input->get('product_id'),
            $user->id,
            OrdersProgress::YET,
            '',
            '',
            OrdersSettlementState::PROCESSING,
            $stripeSubscriptionResult->id,
        ));
        $deliverAddress = Address::find($input->get('deliver_address_id'));
        $deliverResult = (new Deliver)->create(new DeliverEntity(
            $orderResult->id,
            $input->get('deliver_time_id'),
            new FullNameEntity(
                $deliverAddress->last_name,
                $deliverAddress->last_name_kana,
                $deliverAddress->first_name,
                $deliverAddress->first_name_kana,
            ),
            new AddressContentEntity(
                $deliverAddress->post_number,
                $deliverAddress->prefecture_name,
                $deliverAddress->city,
                $deliverAddress->block,
                $deliverAddress->building,
            ),
            $deliverAddress->phone_number,
            $user->email,
        ));
        $demandAddress = Address::find($input->get('deliver_address_id'));
        $demandResult = (new Demand)->create(new DemandEntity(
            $orderResult->id,
            new FullNameEntity(
                $deliverAddress->last_name,
                $deliverAddress->last_name_kana,
                $deliverAddress->first_name,
                $deliverAddress->first_name_kana,
            ),
            new AddressContentEntity(
                $deliverAddress->post_number,
                $deliverAddress->prefecture_name,
                $deliverAddress->city,
                $deliverAddress->block,
                $deliverAddress->building,
            ),
            $deliverAddress->phone_number,
            $user->email,
        ));

        return ResponseUtils::success([
            'order' => $orderResult,
            'deliver' => $deliverResult,
            'demand' => $demandResult
        ]);
    }
}
