<?php

namespace App\Http\Controllers;

use App\Candidate;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
     * @return Candidate|array
     */
    public function show($id)
    {
        try{
            return Candidate::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return [
                'error' => true,
                'message' => 'Candidato não encontrado'
            ];
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:candidates'
            ]);
        } catch (ValidationException $exception) {
            return [
                'error' => true,
                'message' => $exception->errors()
            ];
        }

        if($candidate = Candidate::create($request->all()))
            return [
                'error' => false,
                'message' => $candidate
            ];
        return [
            'error' => true,
            'message' => [
                'all' => 'Não foi possivel criar um candidato'
            ]
        ];
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:candidates'
            ]);
        } catch (ValidationException $exception) {
            return [
                'error' => true,
                'message' => $exception->errors()
            ];
        }

        $candidate = $this->show($id);
        if(is_array($candidate) && $candidate['error'])
            return $candidate;

        if($candidate->update($request->all()))
            return [
                'error' => false,
                'message' => 'Candidato atualizado com sucesso
                '
            ];
        return [
            'error' => true,
            'message' => [
                'all' => 'Não foi possivel atualizar o candidato'
            ]
        ];
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function destroy($id)
    {
        $candidate = $this->show($id);
        if(is_array($candidate) && $candidate['error'])
            return $candidate;
        if($candidate->delete())
            return [
                'error' => false,
                'message' => 'Candidato removido com sucesso
                '
            ];
        return [
            'error' => true,
            'message' => 'Não foi possivel remover o candidato'
        ];
    }
}
