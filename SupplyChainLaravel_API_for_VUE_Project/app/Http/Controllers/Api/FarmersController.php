<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Farmer;
use App\Models\Stakeholder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FarmersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $farmers = Farmer::with('stakeholder')->get();

        return response()->json(compact('farmers'), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return response()->json(['success' => $request->all()], 200);
        try {
            $stackH = new Stakeholder;

            $stackH->name = $request->farmer['name'];
            $stackH->phone = $request->farmer['phone'];
            $imgname = '';

            if ($request->hasFile('photo')) {

                $name = Str::slug($request->farmer['name']);
                // Tanvirjfrewuy → tanvirjfrewuy

                $extension = $request->file('photo')->getClientOriginalExtension();

                $imgname = $name.'.'.$extension;

                $request->file('photo')->storeAs(
                    'photo/stakeholders',
                    $imgname,
                    'public'
                );

                $stackH->photo = $imgname;
            }

            $stackH->save();
            $farmer = new Farmer;
            $farmer->stakeholder_id = $stackH->id;
            $farmer->crop_history = $request->farmer['crop_history'];
            $farmer->land_area = $request->farmer['land_area'];
            $farmer->farmer_card_no = $request->farmer['farmer_card_no'];
            $farmer->save();

            return response()->json(['success' => $stackH], 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $farmer = Farmer::with('stakeholder')->find($id);
        if (! $farmer) {
            return response()->json(['error' => 'Farmer not found'], 200);
        }

        return response()->json(['farmer' => $farmer], 200);
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, string $id)
{
    try {
        $farmer = Farmer::with('stakeholder')->find($id);

        if (! $farmer) {
            return response()->json(['error' => 'Farmer not found'], 200);
        }

        // Stakeholder update
        $farmer->stakeholder->name = $request->farmer['name'];
        $farmer->stakeholder->phone = $request->farmer['phone'];

        if ($request->hasFile('photo')) {

            $name = Str::slug($request->farmer['name']);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $imgname = $name.'.'.$extension;

            $request->file('photo')->storeAs(
                'photo/stakeholders',
                $imgname,
                'public'
            );

            $farmer->stakeholder->photo = $imgname;
        }

        $farmer->stakeholder->save();

        // Farmer update
        $farmer->crop_history = $request->farmer['crop_history'];
        $farmer->land_area = $request->farmer['land_area'];
        $farmer->farmer_card_no = $request->farmer['farmer_card_no'];
        $farmer->save();

        return response()->json(['success' => 'Farmer updated successfully'], 200);

    } catch (\Throwable $th) {
        return response()->json(['error' => $th->getMessage()], 200);
    }
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $farmer = Farmer::find($id);
        $farmer->delete();

        $stackH = Stakeholder::find($farmer->stakeholder_id);
        if ($stackH) {
            $stackH->delete();
        }

        return response()->json(['success' => 'Farmer deleted successfully'], 200);
    }
}
