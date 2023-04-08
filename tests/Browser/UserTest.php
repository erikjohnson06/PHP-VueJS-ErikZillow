<?php

namespace Tests\Browser;

use App\Models\User;
//use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UserTest extends DuskTestCase {

    use DatabaseTruncation;

    /**
     * @group authenticate
     * @return void
     */
    public function test_login_page_loads_successfully(): void {

        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee('Login');
        });
    }

    /**
     * @group authenticate
     * @return void
     */
    public function test_user_can_authenticate_successfully(): void {

        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                ->type('@email', $user->email)
                ->type('@password', 'password')
                ->click('@login-button');

            $browser->waitForLocation("/listings")
                ->assertSee($user->name);
        });
    }

    /**
     * @group authenticate
     * @return void
     */
    public function test_user_can_logout_successfully(): void {

        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                ->type('@email', $user->email)
                ->type('@password', 'password')
                ->click('@login-button');

            $browser->waitForLocation("/listings")
                ->assertSee($user->name)
                ->click('@logout');

            $browser->waitForText("Sign In")
                ->assertSee("Sign In"); //After logging out, user is redirected back to listings page, where Sign In is displayed
        });
    }

    /**
     * @group register
     * @return void
     */
    public function test_register_page_loads_successfully(): void
    {

        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->assertSee('Register');
        });
    }

    /**
     * @group register
     * @return void
     */
    public function test_user_can_register_successfully(): void
    {

        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('@name', 'Tester')
                    ->type('@email', 'email@testing.com')
                    ->type('@password', 'Password123')
                    ->type('@password_confirmation', 'Password123')
                    ->click('@create-button');

            $browser->waitForLocation("/listings")
                  ->assertSee("Your account has been created")
                ->assertPathIs('/listings');
        });
    }
}
