<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMealRequest;
use App\Http\Requests\UpdateMealRequest;
use App\Http\Resources\MealResource;
use App\Models\Meal;

class MealsController extends Controller
{
    public function index(){
        $meals = Meal::paginate(2);
        return MealResource::collection($meals);
    }
    public function store(StoreMealRequest $request){
        $meal = Meal::create($request->validated());
        return new MealResource($meal);
    }
    public function update(UpdateMealRequest $request , Meal $meal){
        $meal->update($request->validated());
        return new MealResource($meal);
    }
    public function show(Meal $meal){
        return new MealResource($meal);
    }
    public function destroy(Meal $meal){
        $meal->delete();
        return response()->noContent();
    }
}
