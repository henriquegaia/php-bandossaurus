<?php

class Premium {

    const FEE_FREQUENCY_DAYS = 30;
    const FEE_FREQUENCY = 'month';
    const FEE_US_DOLLARS = 1.9;

    public static function fee_to_string() {
        return self::FEE_US_DOLLARS . ' $/ ' . self::FEE_FREQUENCY;
    }

}
