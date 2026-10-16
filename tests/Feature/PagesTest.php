<?php

namespace Tests\Feature;

use Tests\TestCase;

class PagesTest extends TestCase
{
    public function test_all_required_pages_are_available(): void
    {
        $this->get('/')->assertOk()->assertSee('Style that feels like you.');
        $this->get('/about')->assertOk()->assertSee('Getting dressed should feel simple.');
        $this->get('/customers')->assertOk()->assertSee('Customer Accounts')->assertSee('Mika Santos');
        $this->get('/users')->assertOk()->assertSee('User Accounts')->assertSee('Angel Tolentino');
    }

    public function test_account_pages_render_all_static_records(): void
    {
        $this->get('/customers')->assertSee('C-1001')->assertSee('C-1006');
        $this->get('/users')->assertSee('U-001')->assertSee('U-006');
    }
}
