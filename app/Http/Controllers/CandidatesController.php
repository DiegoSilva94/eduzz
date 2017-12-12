<?php

namespace App\Http\Controllers;

use App\Candidate;
use Illuminate\Http\Request;

class CandidatesController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        return Candidate::paginate();
    }

    /**
     * @param $id
     * @return Candidate
     */
    public function show($id)
    {
        return Candidate::findOrFail($id);
    }
    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        return Candidate::create($request->all());
    }

    /**
     * @param Request $request
     * @param $id
     * @return bool
     */
    public function update(Request $request, $id)
    {
        $candidate = $this->show($id);
        return $candidate->update($request->all());
    }

    /**
     * @param $id
     * @return bool|null
     * @throws \Exception
     */
    public function destroy($id)
    {
        $candidate = $this->show($id);
        return $candidate->delete();
    }
}
