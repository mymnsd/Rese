<?php

if (!function_exists('ratingStars')) {
    function ratingStars($rating)
    {
        $fullStars = floor($rating);
        $emptyStars = 5 - $fullStars;
        $stars = '';

        for ($i = 0; $i < $fullStars; $i++) {
            $stars .= '<i class="fas fa-star star-filled"></i>';
        }

        for ($i = 0; $i < $emptyStars; $i++) {
            $stars .= '<i class="far fa-star star-empty"></i>';
        }

        return $stars;
    }
}