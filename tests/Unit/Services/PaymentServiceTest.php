<?php
namespace Tests\Unit\Services;

use App\Repositories\User\UserRepository;
use Mockery;
use Tests\TestCase;

class PaymentServiceTest extends TestCase
{
    private const SUCCESS_PAYMENT_METHOD_VISA         = 'pm_card_visa';
    private const SUCCESS_PAYMENT_METHOD_MASTER       = 'pm_card_mastercard';
    private const PAYMENT_METHOD_カード情報不正              = 'pm_card_cvcCheckFail';
    private const PAYMENT_METHOD_決済失敗                 = 'pm_card_chargeDeclined';
    private const PAYMENT_METHOD_カード情報正常_決済失敗         = 'pm_card_chargeCustomerFail';

    public function setUp(): void
    {
        parent::setUp();
        $this->userRepository = Mockery::mock(UserRepository::class);
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    public function testUserCreateNewSubscription_成功()
    {
        $user           = factory(\App\Models\User::class)->create();
        $stripeCustomer = $user->createOrGetStripeCustomer();
        $user->fill([
            'stripe_id' => $stripeCustomer->id,
        ])->save();

        app()->singleton(
            'PaymentService',
            'App\Services\Payment\PaymentServiceInterface'
        );

        $response = app('PaymentService')->userCreateNewSubscription($user, self::SUCCESS_PAYMENT_METHOD_VISA);

        $this->assertInstanceOf(\Laravel\Cashier\Subscription::class, $response);
    }

    public function testUserCreateNewSubscription_決済失敗()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('fail create subscription');

        $user           = factory(\App\Models\User::class)->create();
        $stripeCustomer = $user->createOrGetStripeCustomer();
        $user->fill([
            'stripe_id' => $stripeCustomer->id,
        ])->save();

        app()->singleton(
            'PaymentService',
            'App\Services\Payment\PaymentServiceInterface'
        );

        $response = app('PaymentService')->userCreateNewSubscription($user, self::PAYMENT_METHOD_決済失敗);
    }
}
