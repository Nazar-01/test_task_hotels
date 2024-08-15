<?php

namespace App\Services;

use App\Models\Rule;
use App\Models\Hotel;
use Illuminate\Support\Facades\DB;

class RuleService
{
    public function checkHotelAgainstRules(Hotel $hotel)
    {
        $rules = Rule::where('is_active', 1)->get();
        $matchedRules = [];

        foreach ($rules as $rule) {
            $conditions = $rule->conditions;
            $allConditionsMatched = true;

            foreach ($conditions as $condition) {
                $property = $condition['data-property'];
                $value = $condition['data-value'];
                $operator = $condition['data-select'];

                $hotelValue = $this->getHotelProperty($hotel->id, $property);

                if (!$this->evaluateCondition($hotelValue, $value, $operator)) {
                    $allConditionsMatched = false;
                    break;
                }
            }

            if ($allConditionsMatched) {
                $matchedRules[] = [
                    'name' => $rule->name,
                    'text' => $rule->manager_text,
                    'agency_name' => $rule->agency ? $rule->agency->name : 'Не указано'
                ];
            }
        }

        return $matchedRules;
    }

    private function getHotelProperty($hotelId, $property)
    {
        switch ($property) {
            case 'country':
                return $this->getCountryIdByHotel($hotelId);
            case 'city_id':
                return $this->getCityIdByHotel($hotelId);
            case 'stars':
                return $this->getHotelStars($hotelId);
            case 'discount':
                return $this->getHotelDiscount($hotelId);
            case 'contract':
                return $this->getHotelContract($hotelId);
            case 'company-contract':
                return $this->getHotelCompanyContract($hotelId);
            case 'blacklist':
                return $this->isHotelBlacklisted($hotelId);
            case 'recommended-hotel':
                return $this->isHotelRecommended($hotelId);
            case 'whitelist':
                return $this->isHotelWhitelisted($hotelId);
            default:
                return null;
        }
    }

    private function getCountryIdByHotel($hotelId)
    {
        return DB::table('cities')
            ->join('countries', 'cities.country_id', '=', 'countries.id')
            ->join('hotels', 'cities.id', '=', 'hotels.city_id')
            ->where('hotels.id', $hotelId)
            ->value('countries.id');
    }

    private function getCityIdByHotel($hotelId)
    {
        return DB::table('hotels')->where('id', $hotelId)->value('city_id');
    }

    private function getHotelStars($hotelId)
    {
        return DB::table('hotels')->where('id', $hotelId)->value('stars');
    }

    private function getHotelDiscount($hotelId)
    {
        return DB::table('hotel_agreements')->where('hotel_id', $hotelId)->value('discount_percent');
    }

    private function getHotelContract($hotelId)
    {
        return DB::table('hotel_agreements')->where('hotel_id', $hotelId)->value('is_default');
    }

    private function getHotelCompanyContract($hotelId)
    {
        return DB::table('hotel_agreements')->where('hotel_id', $hotelId)->value('company_id');
    }

    private function isHotelBlacklisted($hotelId)
    {
        return DB::table('agency_hotel_options')
            ->where('hotel_id', $hotelId)
            ->value('is_black');
    }

    private function isHotelRecommended($hotelId)
    {
        return DB::table('agency_hotel_options')
            ->where('hotel_id', $hotelId)
            ->value('is_recomend');
    }

    private function isHotelWhitelisted($hotelId)
    {
        return DB::table('agency_hotel_options')
            ->where('hotel_id', $hotelId)
            ->value('is_white');
    }

    private function evaluateCondition($hotelValue, $value, $operator)
    {
        switch ($operator) {
            case '=':
                return $hotelValue == $value;
            case '!=':
                return $hotelValue != $value;
            case '>':
                return $hotelValue > $value;
            case '<':
                return $hotelValue < $value;
            default:
                return false;
        }
    }
}
