<?php

namespace App\Http\Controllers\Dashboard;

use App\Events\HintAdded;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tasks\Hints\HintRequest;
use App\Models\Hint;

class HintController extends Controller
{
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HintRequest $request)
    {
        $hint = Hint::create($request->validated());

        event(new HintAdded($hint));

        return [
            "success" => true,
            "hint" => $hint
        ];

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hint  $hint
     * @return \Illuminate\Http\Response
     */
    public function update(HintRequest $request, Hint $hint)
    {
        $hint = $hint->update($request->validated());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hint  $hint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hint $hint)
    {
        return [
            "is_deleted" => $hint->delete()
        ];
    }
}
