<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Career;
use App\Models\ContactMessage;
use App\Models\Member;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $startOfLastMonth = $now->copy()->subMonthNoOverflow()->startOfMonth();
        $endOfLastMonth = $startOfLastMonth->copy()->endOfMonth();

        $usersTotal = User::count();
        $usersThisMonth = User::where('created_at', '>=', $startOfMonth)->count();

        $messagesTotal = ContactMessage::count();
        $messagesUnread = ContactMessage::where('status', true)->count();
        $messagesRead = ContactMessage::where('status', false)->count();
        $messagesThisMonth = ContactMessage::where('created_at', '>=', $startOfMonth)->count();
        $messagesLastMonth = ContactMessage::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->count();

        $servicesTotal = Service::count();
        $servicesActive = Service::where(function ($query) {
            $query->where('status', true)->orWhere('status', 1);
        })->count();

        $blogsTotal = Blog::count();
        $productsTotal = Product::count();
        $membersTotal = Member::count();
        $careersOpen = Career::where(function ($query) {
            $query->where('status', true)->orWhere('status', 1);
        })->whereDate('deadline', '>=', $now->toDateString())->count();

        $recentUnreadMessages = ContactMessage::with('service')
            ->where('status', true)
            ->latest('updated_at')
            ->take(5)
            ->get();

        $messageGrowthPercent = 0;
        if ($messagesLastMonth > 0) {
            $messageGrowthPercent = round((($messagesThisMonth - $messagesLastMonth) / $messagesLastMonth) * 100, 1);
        } elseif ($messagesThisMonth > 0) {
            $messageGrowthPercent = 100;
        }

        return view('admin.dashboard', [
            'usersTotal' => $usersTotal,
            'usersThisMonth' => $usersThisMonth,
            'messagesTotal' => $messagesTotal,
            'messagesUnread' => $messagesUnread,
            'messagesRead' => $messagesRead,
            'messagesThisMonth' => $messagesThisMonth,
            'messagesLastMonth' => $messagesLastMonth,
            'messageGrowthPercent' => $messageGrowthPercent,
            'servicesTotal' => $servicesTotal,
            'servicesActive' => $servicesActive,
            'blogsTotal' => $blogsTotal,
            'productsTotal' => $productsTotal,
            'membersTotal' => $membersTotal,
            'careersOpen' => $careersOpen,
            'recentUnreadMessages' => $recentUnreadMessages,
        ]);
    }
}
