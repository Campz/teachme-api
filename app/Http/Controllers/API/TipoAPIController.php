<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTipoAPIRequest;
use App\Http\Requests\API\UpdateTipoAPIRequest;
use App\Models\Tipo;
use App\Repositories\TipoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TipoController
 * @package App\Http\Controllers\API
 */

class TipoAPIController extends AppBaseController
{
    /** @var  TipoRepository */
    private $tipoRepository;

    public function __construct(TipoRepository $tipoRepo)
    {
        $this->tipoRepository = $tipoRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/tipos",
     *      summary="Get a listing of the Tipos.",
     *      tags={"Tipo"},
     *      description="Get all Tipos",
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
     *                  @SWG\Items(ref="#/definitions/Tipo")
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
        $tipos = $this->tipoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($tipos->toArray(), 'Tipos retrieved successfully');
    }

    /**
     * @param CreateTipoAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/tipos",
     *      summary="Store a newly created Tipo in storage",
     *      tags={"Tipo"},
     *      description="Store Tipo",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Tipo that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Tipo")
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
     *                  ref="#/definitions/Tipo"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTipoAPIRequest $request)
    {
        $input = $request->all();

        $tipo = $this->tipoRepository->create($input);

        return $this->sendResponse($tipo->toArray(), 'Tipo saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/tipos/{id}",
     *      summary="Display the specified Tipo",
     *      tags={"Tipo"},
     *      description="Get Tipo",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Tipo",
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
     *                  ref="#/definitions/Tipo"
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
        /** @var Tipo $tipo */
        $tipo = $this->tipoRepository->find($id);

        if (empty($tipo)) {
            return $this->sendError('Tipo not found');
        }

        return $this->sendResponse($tipo->toArray(), 'Tipo retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTipoAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/tipos/{id}",
     *      summary="Update the specified Tipo in storage",
     *      tags={"Tipo"},
     *      description="Update Tipo",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Tipo",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Tipo that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Tipo")
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
     *                  ref="#/definitions/Tipo"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTipoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Tipo $tipo */
        $tipo = $this->tipoRepository->find($id);

        if (empty($tipo)) {
            return $this->sendError('Tipo not found');
        }

        $tipo = $this->tipoRepository->update($input, $id);

        return $this->sendResponse($tipo->toArray(), 'Tipo updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/tipos/{id}",
     *      summary="Remove the specified Tipo from storage",
     *      tags={"Tipo"},
     *      description="Delete Tipo",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Tipo",
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
        /** @var Tipo $tipo */
        $tipo = $this->tipoRepository->find($id);

        if (empty($tipo)) {
            return $this->sendError('Tipo not found');
        }

        $tipo->delete();

        return $this->sendSuccess('Tipo deleted successfully');
    }
}
