<?php

namespace App\Helpers;

use App\Mail\ErrorNotification;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class MailHelper
{
    /**
     * Send error notification email
     * 
     * @param string $errorMessage
     * @param string $context
     * @return void
     */
    public static function sendErrorNotification($errorMessage, $context = 'System Error')
    {
        try {
            // Get the first Admin user's email (role_id = 1)
            $adminRole = Role::find(1);
            if (!$adminRole) {
                throw new \Exception('Admin role not found');
            }
            
            $adminUser = User::where('role_id', 1)->first();
            if (!$adminUser) {
                throw new \Exception('No Admin user found');
            }
            
            $adminEmail = $adminUser->email;
            
            // Send email from and to the admin
            Mail::to($adminEmail)
                ->send(new ErrorNotification($errorMessage, $context));
            
            // Also log the error for backup
            Log::error("Error notification sent to {$adminEmail}: {$errorMessage}", ['context' => $context]);
            
        } catch (\Exception $e) {
            // If email fails, at least log the original error
            Log::error("Failed to send error notification: {$e->getMessage()}");
            Log::error("Original error: {$errorMessage}", ['context' => $context]);
        }
    }
}