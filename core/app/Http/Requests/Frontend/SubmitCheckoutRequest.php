<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Xgenious\Paymentgateway\Base\PaymentGatewayHelpers;

class SubmitCheckoutRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $paymentGateways = [...(new PaymentGatewayHelpers)->all_payment_gateway_list()];
        return [
            "coupon" => "nullable",
            "tax_amount" => "nullable",
            "ship_to_another_address" => "nullable",
            "selected_shipping_option" => "nullable",
            "payment_gateway" => [
                "required",
                Rule::in(
                    array_merge($paymentGateways, [
                        'cash_on_delivery',
                        'manual_payment',
                        'Wallet',
                    ])
                )
            ],
            "agree" => "required",
            "name" => "required",
            "address" => "nullable",
            "country_id" => "required",
            "state_id" => "nullable",
            "city" => "nullable",
            "zipcode" => "required",
            "phone" => "nullable",
            "email" => "required|email",
            "message" => "nullable",
            "shipping_cost" => "nullable",
            "cart_items" => "sometimes",
            "transaction_attachment" => "sometimes|mimes:pdf,jpeg,jpg,png,gif,docx",
            "note" => "nullable",
            "create_account" => "nullable",
            "password" => "nullable|confirmed",
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge([
            'name' => $this->full_name  ?? "",
            'payment_gateway' => $this->selected_payment_gateway,
            'zipcode' => $this->zip_code,
        ]);
    }
}
