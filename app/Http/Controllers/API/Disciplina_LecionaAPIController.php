<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDisciplina_LecionaAPIRequest;
use App\Http\Requests\API\UpdateDisciplina_LecionaAPIRequest;
use App\Models\Disciplina_Leciona;
use App\Repositories\Disciplina_LecionaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class Disciplina_LecionaController
 * @package App\Http\Controllers\API
 */

class Disciplina_LecionaAPIController extends AppBaseController
{
    /** @var  Disciplina_LecionaRepository */
    private $disciplinaLecionaRepository;

    public function __construct(Disciplina_LecionaRepository $disciplinaLecionaRepo)
    {
        $this->disciplinaLecionaRepository = $disciplinaLecionaRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/disciplinaLecionas",
     *      summary="Get a listing of the Disciplina_Lecionas.",
     *      tags={"Disciplina_Leciona"},
     *      description="Get all Disciplina_Lecionas",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Disciplina_Leciona")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $disciplinaLecionas = $this->disciplinaLecionaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($disciplinaLecionas->toArray(), 'Disciplina  Lecionas retrieved successfully');
    }

    /**
     * @param CreateDisciplina_LecionaAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/disciplinaLecionas",
     *      summary="Store a newly created Disciplina_Leciona in storage",
     *      tags={"Disciplina_Leciona"},
     *      description="Store Disciplina_Leciona",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Disciplina_Leciona that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Disciplina_Leciona")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Disciplina_Leciona"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateDisciplina_LecionaAPIRequest $request)
    {
        $input = $request->all();

        $disciplinaLeciona = $this->disciplinaLecionaRepository->create($input);

        return $this->sendResponse($disciplinaLeciona->toArray(), 'Disciplina  Leciona saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/disciplinaLecionas/{id}",
     *      summary="Display the specified Disciplina_Leciona",
     *      tags={"Disciplina_Leciona"},
     *      description="Get Disciplina_Leciona",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Disciplina_Leciona",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Disciplina_Leciona"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Disciplina_Leciona $disciplinaLeciona */
        $disciplinaLeciona = $this->disciplinaLecionaRepository->find($id);

        if (empty($disciplinaLeciona)) {
            return $this->sendError('Disciplina  Leciona not found');
        }

        return $this->sendResponse($disciplinaLeciona->toArray(), 'Disciplina  Leciona retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateDisciplina_LecionaAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/disciplinaLecionas/{id}",
     *      summary="Update the specified Disciplina_Leciona in storage",
     *      tags={"Disciplina_Leciona"},
     *      description="Update Disciplina_Leciona",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Disciplina_Leciona",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Disciplina_Leciona that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Disciplina_Leciona")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Disciplina_Leciona"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateDisciplina_LecionaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Disciplina_Leciona $disciplinaLeciona */
        $disciplinaLeciona = $this->disciplinaLecionaRepository->find($id);

        if (empty($disciplinaLeciona)) {
            return $this->sendError('Disciplina  Leciona not found');
        }

        $disciplinaLeciona = $this->disciplinaLecionaRepository->update($input, $id);

        return $this->sendResponse($disciplinaLeciona->toArray(), 'Disciplina_Leciona updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/disciplinaLecionas/{id}",
     *      summary="Remove the specified Disciplina_Leciona from storage",
     *      tags={"Disciplina_Leciona"},
     *      description="Delete Disciplina_Leciona",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Disciplina_Leciona",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Disciplina_Leciona $disciplinaLeciona */
        $disciplinaLeciona = $this->disciplinaLecionaRepository->find($id);

        if (empty($disciplinaLeciona)) {
            return $this->sendError('Disciplina  Leciona not found');
        }

        $disciplinaLeciona->delete();

        return $this->sendSuccess('Disciplina  Leciona deleted successfully');
    }
}
