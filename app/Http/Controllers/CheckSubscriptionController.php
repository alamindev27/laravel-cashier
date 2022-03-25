<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Subscription;

class CheckSubscriptionController extends Controller
{
    protected $stripe;


    public function create(Request $request, Plan $plan)
    {
        $plan = Plan::findOrFail($request->get('plan'));

        $user = $request->user();
        $paymentMethod = $request->paymentMethod;

        $user->createOrGetStripeCustomer();
        $user->updateDefaultPaymentMethod($paymentMethod);
        $user->newSubscription('default', $plan->stripe_plan)
            ->create($paymentMethod, [
                'email' => $user->email,
            ]);

        return redirect()->route('home')->with('success', 'Your plan subscribed successfully');
    }


    public function createPlan()
    {
        return view('plans.create');
    }

    public function storePlan(Request $request)
    {
        $data = $request->except('_token');

        $data['slug'] = strtolower($data['name']);
        $price = $data['cost'] *100;

        //create stripe product
        $stripeProduct = $this->stripe->products->create([
            'name' => $data['name'],
        ]);

        //Stripe Plan Creation
        $stripePlanCreation = $this->stripe->plans->create([
            'amount' => $price,
            'currency' => 'usd',
            'interval' => 'day', //  it can be day,week,month or year
            'product' => $stripeProduct->id,
        ]);

        $data['stripe_plan'] = $stripePlanCreation->id;

        Plan::create($data);

        echo 'plan has been created';

    }

    public function shwoData()
    {

        











        // cancel subscribtion

        $subscription = Subscription::where('name', 'default')->where('user_id', auth()->id())->first();
        $subscription->cancel();








        // change subscribe

        // $subscription = Subscription::where('name', 'default')->where('user_id', auth()->id())->first();
        // $subscription->swap('plan_LNg4Q10rtVP2wA');

    }

    public function resume()
    {
        $subscription = Subscription::where('name', 'default')->where('user_id', auth()->id())->first();
        $subscription->resume();

    }

    public function subscription()
    {
        return 'this user is subscriped.';
    }








}
