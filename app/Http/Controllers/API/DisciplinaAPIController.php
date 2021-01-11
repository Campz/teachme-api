<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDisciplinaAPIRequest;
use App\Http\Requests\API\UpdateDisciplinaAPIRequest;
use App\Models\Disciplina;
use App\Repositories\DisciplinaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class DisciplinaController
 * @package App\Http\Controllers\API
 */

class DisciplinaAPIController extends AppBaseController
{
    /** @var  DisciplinaRepository */
    private $disciplinaRepository;

    public function __construct(DisciplinaRepository $disciplinaRepo)
    {
        $this->disciplinaRepository = $disciplinaRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/disciplinas",
     *      summary="Get a listing of the Disciplinas.",
     *      tags={"Disciplina"},
     *      description="Get all Disciplinas",
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
     *                  @SWG\Items(ref="#/definitions/Disciplina")
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
        $disciplinas = $this->disciplinaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($disciplinas->toArray(), 'Disciplinas retrieved successfully');
    }

    /**
     * @param CreateDisciplinaAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/disciplinas",
     *      summary="Store a newly created Disciplina in storage",
     *      tags={"Disciplina"},
     *      description="Store Disciplina",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Disciplina that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Disciplina")
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
     *                  ref="#/definitions/Disciplina"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateDisciplinaAPIRequest $request)
    {
        $input = $request->all();

        $disciplina = $this->disciplinaRepository->create($input);

        return $this->sendResponse($disciplina->toArray(), 'Disciplina saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/disciplinas/{id}",
     *      summary="Display the specified Disciplina",
     *      tags={"Disciplina"},
     *      description="Get Disciplina",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Disciplina",
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
     *                  ref="#/definitions/Disciplina"
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
        /** @var Disciplina $disciplina */
        $disciplina = $this->disciplinaRepository->find($id);

        if (empty($disciplina)) {
            return $this->sendError('Disciplina not found');
        }

        return $this->sendResponse($disciplina->toArray(), 'Disciplina retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateDisciplinaAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/disciplinas/{id}",
     *      summary="Update the specified Disciplina in storage",
     *      tags={"Disciplina"},
     *      description="Update Disciplina",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Disciplina",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Disciplina that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Disciplina")
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
     *                  ref="#/definitions/Disciplina"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateDisciplinaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Disciplina $disciplina */
        $disciplina = $this->disciplinaRepository->find($id);

        if (empty($disciplina)) {
            return $this->sendError('Disciplina not found');
        }

        $disciplina = $this->disciplinaRepository->update($input, $id);

        return $this->sendResponse($disciplina->toArray(), 'Disciplina updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/disciplinas/{id}",
     *      summary="Remove the specified Disciplina from storage",
     *      tags={"Disciplina"},
     *      description="Delete Disciplina",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Disciplina",
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
        /** @var Disciplina $disciplina */
        $disciplina = $this->disciplinaRepository->find($id);

        if (empty($disciplina)) {
            return $this->sendError('Disciplina not found');
        }

        $disciplina->delete();

        return $this->sendSuccess('Disciplina deleted successfully');
    }
}
