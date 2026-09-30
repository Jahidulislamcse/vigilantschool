<?php

namespace Tests\Feature;

use App\Models\Setting;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PhaseOneTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_loads_dynamic_hero_slider_and_branding(): void
    {
        Setting::set('site_title', 'Vigilant International School', 'general');
        
        Slider::create([
            'title' => 'Inspiring Early Minds',
            'subtitle' => 'Welcome To Our School',
            'description' => 'A wonderful kindergarten learning environment.',
            'image' => 'kider/img/carousel-1.jpg',
            'btn_text_1' => 'Learn More',
            'btn_url_1' => '#',
            'is_active' => true,
            'order' => 1,
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Vigilant International School');
        $response->assertSee('Inspiring Early Minds');
        $response->assertSee('Welcome To Our School');
    }

    public function test_admin_login_page_renders_successfully(): void
    {
        $response = $this->get('/admin/login');

        $response->assertStatus(200);
        $response->assertSee('Sign in to access your administrative control panel');
    }

    public function test_admin_can_authenticate_and_access_dashboard_and_sliders(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@vigilantschool.com',
            'password' => bcrypt('password123'),
        ]);

        $loginResponse = $this->post('/admin/login', [
            'email' => 'admin@vigilantschool.com',
            'password' => 'password123',
        ]);

        $loginResponse->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($user);

        // Test Sliders CRUD access
        $slidersResponse = $this->actingAs($user)->get('/admin/sliders');
        $slidersResponse->assertStatus(200);
        $slidersResponse->assertSee('Homepage Hero Carousel Sliders');

        // Test Settings page access
        $settingsResponse = $this->actingAs($user)->get('/admin/settings');
        $settingsResponse->assertStatus(200);
        $settingsResponse->assertSee('Dynamic School Configuration');
    }
}
