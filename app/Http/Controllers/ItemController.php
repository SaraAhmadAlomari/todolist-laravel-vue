<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Exception;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Item::count() == 0) {
            // The table is empty
            return response()->json(['message' => 'No tasks found'], 200);
        } else {
            // The table is not empty
            $items = Item::orderBy('created_at', 'DESC')->get();
            return response()->json($items, 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $item = new Item();
            $item->name = $request->item['name'];
            // $item->completed=$request->item['completed'];
            $item->save();
            return response()->json(['message' => 'Item created successfully!'], 201);
            // return $item;
        }
        catch
        (Exception $e){
            // Handle the exception and return an error response
            return response()->json([
                'message' => 'An error occurred while creating the user.',
                'error' => $e->getMessage()
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $item=Item::findOrfail($id);
        $item->completed=$request->completed;
        $item->save();
        return response()->json(['message' => 'Item updated successfully!'], 201,);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = new Item();
        $item = Item::findOrfail($id);
        $item->delete();
        return response()->json(['message' => 'Item deleted successfully!!!'], 201);


    }
}
