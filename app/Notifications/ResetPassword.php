<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends ResetPasswordNotification
{
    public function toMail($notifiable): MailMessage
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Reset Password - Presensi')
            ->greeting('Halo!')
            ->line('Anda menerima email ini karena ada permintaan untuk mengatur ulang password akun Presensi Anda.')
            ->action('Atur Ulang Password', $url)
            ->line('Link ini berlaku selama 60 menit.')
            ->line('Jika Anda tidak meminta reset password, abaikan email ini.')
            ->salutation('Salam, Tim Presensi FK Universitas Riau');
    }
}
