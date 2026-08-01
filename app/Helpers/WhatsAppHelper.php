<?php

if (!function_exists('formatWhatsApp')) {
    /**
     * Format phone number untuk WhatsApp link
     * 
     * @param string $phone Nomor telepon (bisa dengan format apapun)
     * @return string WhatsApp link (https://wa.me/628123456789)
     */
    function formatWhatsApp($phone, $message = '')
    {
        if (empty($phone)) {
            return '#';
        }
        
        // Hapus semua karakter non-numerik
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // Jika dimulai dengan 0, ganti dengan 62 (kode negara Indonesia)
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }
        
        // Jika tidak dimulai dengan 62, tambahkan 62
        if (substr($phone, 0, 2) !== '62') {
            $phone = '62' . $phone;
        }
        
        $url = 'https://wa.me/' . $phone;
        
        // Add message if provided
        if (!empty($message)) {
            $url .= '?text=' . urlencode($message);
        }
        
        return $url;
    }
}

