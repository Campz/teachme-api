<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAulaAPIRequest;
use App\Http\Requests\API\UpdateAulaAPIRequest;
use App\Models\Aula;
use App\Repositories\AulaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class AulaController
 * @package App\Http\Controllers\API
 */

class AulaAPIController extends AppBaseController
{
    /** @var  AulaRepository */
    private $aulaRepository;

    public function __construct(AulaRepository $aulaRepo)
    {
        $this->aulaRepository = $aulaRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/aulas",
     *      summary="Get a listing of the Aulas.",
     *      tags={"Aula"},
     *      description="Get all Aulas",
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
     *                  @SWG\Items(ref="#/definitions/Aula")
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
        $aulas = $this->aulaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($aulas->toArray(), 'Aulas retrieved successfully');
    }

    /**
     * @param CreateAulaAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/aulas",
     *      summary="Store a newly created Aula in storage",
     *      tags={"Aula"},
     *      description="Store Aula",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Aula that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Aula")
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
     *                  ref="#/definitions/Aula"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAulaAPIRequest $request)
    {
        $input = $request->all();

        $aula = $this->aulaRepository->create($input);

        return $this->sendResponse($aula->toArray(), 'Aula saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/aulas/{id}",
     *      summary="Display the specified Aula",
     *      tags={"Aula"},
     *      description="Get Aula",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Aula",
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
     *                  ref="#/definitions/Aula"
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
        /** @var Aula $aula */
        $aula = $this->aulaRepository->find($id);

        if (empty($aula)) {
            return $this->sendError('Aula not found');
        }

        return $this->sendResponse($aula->toArray(), 'Aula retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateAulaAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/aulas/{id}",
     *      summary="Update the specified Aula in storage",
     *      tags={"Aula"},
     *      description="Update Aula",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Aula",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Aula that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Aula")
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
     *                  ref="#/definitions/Aula"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAulaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Aula $aula */
        $aula = $this->aulaRepository->find($id);

        if (empty($aula)) {
            return $this->sendError('Aula not found');
        }

        $aula = $this->aulaRepository->update($input, $id);

        return $this->sendResponse($aula->toArray(), 'Aula updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/aulas/{id}",
     *      summary="Remove the specified Aula from storage",
     *      tags={"Aula"},
     *      description="Delete Aula",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Aula",
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
        /** @var Aula $aula */
        $aula = $this->aulaRepository->find($id);

        if (empty($aula)) {
            return $this->sendError('Aula not found');
        }

        $aula->delete();

        return $this->sendSuccess('Aula deleted successfully');
    }
}
