<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function foods() {
        return view('foods');
    }

    public function components() {
        return view('components');
    }

    public function reminders() {
        return view('reminders');
    }

    public function reminders_user($id) {
        return view('reminders_user', compact('id'));
    }

    public function bookings() {
        return view('bookings');
    }

    public function booking_id($id, $userId) {
        return view('booking_id', compact('id', 'userId'));
    }

    public function engineers() {
        return view('engineers');
    }
}
