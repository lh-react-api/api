<?php

namespace App\Http\Controllers\Orders;

use App\Exceptions\DatabaseErrorException;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Orders\StoreRequest;
use App\Models\domains\Orders\OrderEntity;
use App\Models\Product;
use App\Models\Order;
use App\Models\Deliver;
use App\Models\Stripe;
use App\Enums\Orders\OrdersProgress;
use App\Enums\Orders\OrdersSettlementState;
use App\Models\Demand;
use App\Models\domains\Delivers\DeliverEntity;
use App\Models\domains\Commons\VersatilityUserEntity;
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
        $stripeSubscriptionResult = $stripe->createSubscription(
            $product->stripe_plan_id,
            $input->get('stripe_card_id')
        );
        $orderResult = (new Order)->create(new OrderEntity(
            $input->get('product_id'),
            Auth::id(),
            OrdersProgress::YET,
            '',
            '',
            OrdersSettlementState::PROCESSING,
            $stripeSubscriptionResult->id,
        ));
        $deliverResult = (new Deliver)->create(new DeliverEntity(
            $orderResult->id,
            $input->get('deliver_info')['deliver_time_id'],
            new VersatilityUserEntity(
                $input->get('deliver_info')['name'],
                $input->get('deliver_info')['name_kana'],
                $input->get('deliver_info')['phone_number'],
                $input->get('deliver_info')['email'],
            ),
            new AddressContentEntity(
                $input->get('deliver_info')['post_number'],
                $input->get('deliver_info')['prefecture_name'],
                $input->get('deliver_info')['city'],
                $input->get('deliver_info')['block'],
                $input->get('deliver_info')['building'],
            ),
        ));
        $demandResult = (new Demand)->create(new DemandEntity(
            $orderResult->id,
            new VersatilityUserEntity(
                $input->get('deliver_info')['name'],
                $input->get('deliver_info')['name_kana'],
                $input->get('deliver_info')['phone_number'],
                $input->get('deliver_info')['email'],
            ),
            new AddressContentEntity(
                $input->get('deliver_info')['post_number'],
                $input->get('deliver_info')['prefecture_name'],
                $input->get('deliver_info')['city'],
                $input->get('deliver_info')['block'],
                $input->get('deliver_info')['building'],
            ),
        ));

        return ResponseUtils::success([
            'order' => $orderResult,
            'deliver' => $deliverResult,
            'demand' => $demandResult
        ]);
    }
}
