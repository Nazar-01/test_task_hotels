<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRuleRequest;
use App\Models\Hotel;
use App\Models\Agency;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Rule;
use App\Services\RuleService;

class RuleController extends Controller
{

    protected $ruleService;

    public function __construct(RuleService $ruleService)
    {
        $this->ruleService = $ruleService;
    }

    public function checkHotel($hotelId)
    {
        $hotel = Hotel::findOrFail($hotelId);

        $matchedRules = $this->ruleService->checkHotelAgainstRules($hotel);

        return view('pages.hotel.check_hotel', [
            'hotel' => $hotel,
            'matchedRules' => $matchedRules,
        ]);
    }

    public function create()
    {
        $data = $this->getFormData();
        return view('pages.rule.add', $data);
    }

    public function edit($id)
    {
        $data = $this->getFormData();
        $data['rule'] = Rule::findOrFail($id);
        return view('pages.rule.edit', $data);
    }

    public function update(StoreRuleRequest $request, $id)
    {

        $validatedData = $request->validated();

        $rule = Rule::findOrFail($id);

        $rule->name = $validatedData['rule_name'];
        $rule->agency_id = $validatedData['agency'];
        $rule->conditions = $validatedData['conditions'];
        $rule->manager_text = $validatedData['manager_text'];
        $rule->is_active = $validatedData['is_active'];

        $rule->save();

        Session::flash('message', 'Запись успешно обновлена!');

        return response()->json(['redirect' => route('rule.edit', ['id' => $id])]);
    }

    public function store(StoreRuleRequest $request)
    {

        $validatedData = $request->validated();

        Rule::create([
            'name' => $validatedData['rule_name'],
            'agency_id' => $validatedData['agency'],
            'conditions' => $validatedData['conditions'],
            'manager_text' => $validatedData['manager_text'],
            'is_active' => $validatedData['is_active'],
        ]);

        Session::flash('message', 'Запись успешно создана!');

        return response()->json(['redirect' => route('rule.create')]);
    }

    public function destroy($id)
    {
        $rule = Rule::findOrFail($id);

        $rule->delete();

        return redirect()->route('agencies')->with('message', 'Запись успешно удалена.');
    }

    public function getFormData()
    {
        $agencies = Agency::all();
        $hotels = Hotel::all();
        $cities = DB::table('cities')
            ->select('cities.id', 'cities.name')
            ->get();
        $companies = DB::table('companies')
            ->select('companies.id', 'companies.name')
            ->get();
        $countries = DB::table('countries')
            ->select('countries.id', 'countries.name')
            ->get();

        return [
            'cities' => $cities,
            'countries' => $countries,
            'hotels' => $hotels,
            'agencies' => $agencies,
            'companies' => $companies
        ];
    }
}
