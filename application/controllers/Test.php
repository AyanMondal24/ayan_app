<?php
class Test extends CI_Controller {
    public function index() {
        echo $_ENV['STRIPE_SECRET'] ?? 'ENV NOT LOADED';
    }
}
