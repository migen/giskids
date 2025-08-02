<?php

require_file('library/Controller.php');

class WebsiteController extends Controller
{
    public function home()
    {
        return $this->renderView('website.home', [
            'title' => 'Welcome to giskids - AI Solutions',
            'layout' => 'app'
        ]);
    }

    public function index()
    {
        return $this->home();
    }

    public function about()
    {
        return $this->renderView('website.about', [
            'title' => 'About Us',
            'layout' => 'app'
        ]);
    }

    public function services()
    {
        return $this->renderView('website.services', [
            'title' => 'Our Services',
            'layout' => 'app'
        ]);
    }

    public function products()
    {
        return $this->renderView('website.products', [
            'title' => 'Our Products',
            'layout' => 'app'
        ]);
    }

    public function contact()
    {
        return $this->renderView('website.contact', [
            'title' => 'Contact Us',
            'layout' => 'app'
        ]);
    }

    public function features()
    {
        return $this->renderView('website.features', [
            'title' => 'Features - giskids',
            'layout' => 'app'
        ]);
    }

    public function documentation()
    {
        return $this->renderView('website.documentation', [
            'title' => 'Documentation - giskids',
            'layout' => 'app'
        ]);
    }

    public function help()
    {
        return $this->renderView('website.help', [
            'title' => 'Help Center - giskids',
            'layout' => 'app'
        ]);
    }

    public function privacy()
    {
        return $this->renderView('website.privacy', [
            'title' => 'Data Privacy Policy - giskids',
            'layout' => 'app'
        ]);
    }

    public function terms()
    {
        return $this->renderView('website.terms', [
            'title' => 'Terms of Service - giskids',
            'layout' => 'app'
        ]);
    }

    public function giskidstandards()
    {
        return $this->renderView('website.gold-standards', [
            'title' => 'Gold Standards - giskids',
            'layout' => 'app'
        ]);
    }

    public function team()
    {
        return $this->renderView('website.team', [
            'title' => 'Our Team',
            'layout' => 'app'
        ]);
    }
}