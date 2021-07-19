<?php

namespace App\Contracts;

interface BackgroundImageService {
    public function random($filters = []);
}
