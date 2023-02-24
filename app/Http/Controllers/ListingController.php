<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    public function __construct(){
        $this->authorizeResource(Listing::class, 'listing');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia(
            'Listing/Index',
            [
                'listings' => Listing::all()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       // $this->authorize('create', Listing::class);
        return inertia('Listing/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->user()->listings()->create(
             $request->validate([
                 'beds' => 'required|integer|min:0|max:20',
                 'baths' => 'required|integer|min:0|max:20',
                 'area' => 'required|integer|min:15|max:9999',
                 'city' => 'required',
                 'code' => 'required',
                 'street' => 'required',
                 'street_num' => 'required|min:1|max:9999',
                 'price' => 'required|integer|min:1|max:40000000',
            ])
        );
        return redirect()->route('listing.index')
            ->with('success', 'Listing was created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
//        if(Auth::user()->cannot('view', $listing)){
//            abort(403);
//        }
      //  $this->authorize('view', $listing);
        return inertia(
            'Listing/Show',
            [
                'listing' => $listing
            ]
        );
    }

    public function edit(Listing $listing)
    {
        return inertia(
            'Listing/Edit',
            [
                'listing' => $listing
            ]
        );
    }

    public function update(Request $request, Listing $listing): RedirectResponse
    {
        $listing->update(
            $request->validate([
                'beds' => 'required|integer|min:0|max:20',
                'baths' => 'required|integer|min:0|max:20',
                'area' => 'required|integer|min:15|max:9999',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_num' => 'required|min:1|max:9999',
                'price' => 'required|integer|min:1|max:40000000',
            ])
        );
        return redirect()->route('listing.index')
            ->with('success', 'Listing was updated!');
    }

    public function destroy(Listing $listing): RedirectResponse
    {
        $listing->delete();

        return redirect()->back()
            ->with('success', 'Listing was Deleted!');
    }
}
