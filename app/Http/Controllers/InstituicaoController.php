<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInstituicaoRequest;
use App\Http\Requests\UpdateInstituicaoRequest;
use App\Repositories\InstituicaoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class InstituicaoController extends AppBaseController
{
    /** @var  InstituicaoRepository */
    private $instituicaoRepository;

    public function __construct(InstituicaoRepository $instituicaoRepo)
    {
        $this->instituicaoRepository = $instituicaoRepo;
    }

    /**
     * Display a listing of the Instituicao.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $instituicaos = $this->instituicaoRepository->all();

        return view('instituicaos.index')
            ->with('instituicaos', $instituicaos);
    }

    /**
     * Show the form for creating a new Instituicao.
     *
     * @return Response
     */
    public function create()
    {
        return view('instituicaos.create');
    }

    /**
     * Store a newly created Instituicao in storage.
     *
     * @param CreateInstituicaoRequest $request
     *
     * @return Response
     */
    public function store(CreateInstituicaoRequest $request)
    {
        $input = $request->all();

        $instituicao = $this->instituicaoRepository->create($input);

        Flash::success('Instituicao saved successfully.');

        return redirect(route('instituicaos.index'));
    }

    /**
     * Display the specified Instituicao.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $instituicao = $this->instituicaoRepository->find($id);

        if (empty($instituicao)) {
            Flash::error('Instituicao not found');

            return redirect(route('instituicaos.index'));
        }

        return view('instituicaos.show')->with('instituicao', $instituicao);
    }

    /**
     * Show the form for editing the specified Instituicao.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $instituicao = $this->instituicaoRepository->find($id);

        if (empty($instituicao)) {
            Flash::error('Instituicao not found');

            return redirect(route('instituicaos.index'));
        }

        return view('instituicaos.edit')->with('instituicao', $instituicao);
    }

    /**
     * Update the specified Instituicao in storage.
     *
     * @param int $id
     * @param UpdateInstituicaoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInstituicaoRequest $request)
    {
        $instituicao = $this->instituicaoRepository->find($id);

        if (empty($instituicao)) {
            Flash::error('Instituicao not found');

            return redirect(route('instituicaos.index'));
        }

        $instituicao = $this->instituicaoRepository->update($request->all(), $id);

        Flash::success('Instituicao updated successfully.');

        return redirect(route('instituicaos.index'));
    }

    /**
     * Remove the specified Instituicao from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $instituicao = $this->instituicaoRepository->find($id);

        if (empty($instituicao)) {
            Flash::error('Instituicao not found');

            return redirect(route('instituicaos.index'));
        }

        $this->instituicaoRepository->delete($id);

        Flash::success('Instituicao deleted successfully.');

        return redirect(route('instituicaos.index'));
    }
}
