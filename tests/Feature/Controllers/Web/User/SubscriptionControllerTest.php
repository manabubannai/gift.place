<?php
namespace Tests\Feature\Controllers\Web\User;

use Tests\TestCase;

class SubscriptionControllerTest extends TestCase
{
    private const SUCCESS_PAYMENT_METHOD                      = 'pm_card_visa';
    private const SUCCESS_PAYMENT_METHOD_カード情報不正              = 'pm_card_cvcCheckFail';
    private const SUCCESS_PAYMENT_METHOD_決済失敗                 = 'pm_card_chargeDeclined';
    private const SUCCESS_PAYMENT_METHOD_カード情報正常_決済失敗         = 'pm_card_chargeCustomerFail';

    public function setUp(): void
    {
        parent::setUp();
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    public function testStoreSuccess_初回登録()
    {
        $user  = factory(\App\Models\User::class)->create();
        $data  = [
          'payment_method' => self::SUCCESS_PAYMENT_METHOD,
        ];

        $response = $this->actingAs($user)->post('/subscriptions', $data);

        $response
            // ->assertStatus(200)
            ->assertRedirect('/dashboard')
            ->assertSessionHasAll([
                'toast' => [
                    'status'  => 'success',
                    'message' => '入村手続きが完了しました',
                ],
            ]);
    }

    public function testStoreFail_初回登録_カード情報不正()
    {
        $user  = factory(\App\Models\User::class)->create();
        $data  = [
          'payment_method' => self::SUCCESS_PAYMENT_METHOD_カード情報不正,
        ];

        $response = $this->actingAs($user)->post('/subscriptions', $data);

        $response->assertStatus(200);
        $this->assertSame("Your card's security code is incorrect.", $response->getContent());
    }

    // public function testStoreFail_初回登録_カード情報正常_決済失敗()
    // {}

    // public function testStoreSuccess_再入会()
    // {}

    // public function testStoreSuccess_再入会_カード変更()
    // {}
}
