<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateInstituicaoAPIRequest;
use App\Http\Requests\API\UpdateInstituicaoAPIRequest;
use App\Models\Instituicao;
use App\Repositories\InstituicaoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class InstituicaoController
 * @package App\Http\Controllers\API
 */

class InstituicaoAPIController extends AppBaseController
{
    /** @var  InstituicaoRepository */
    private $instituicaoRepository;

    public function __construct(InstituicaoRepository $instituicaoRepo)
    {
        $this->instituicaoRepository = $instituicaoRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/instituicaos",
     *      summary="Get a listing of the Instituicaos.",
     *      tags={"Instituicao"},
     *      description="Get all Instituicaos",
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
     *                  @SWG\Items(ref="#/definitions/Instituicao")
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
        $instituicaos = $this->instituicaoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($instituicaos->toArray(), 'Instituicaos retrieved successfully');
    }

    /**
     * @param CreateInstituicaoAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/instituicaos",
     *      summary="Store a newly created Instituicao in storage",
     *      tags={"Instituicao"},
     *      description="Store Instituicao",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Instituicao that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Instituicao")
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
     *                  ref="#/definitions/Instituicao"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateInstituicaoAPIRequest $request)
    {
        $input = $request->all();

        $instituicao = $this->instituicaoRepository->create($input);

        return $this->sendResponse($instituicao->toArray(), 'Instituicao saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/instituicaos/{id}",
     *      summary="Display the specified Instituicao",
     *      tags={"Instituicao"},
     *      description="Get Instituicao",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Instituicao",
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
     *                  ref="#/definitions/Instituicao"
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
        /** @var Instituicao $instituicao */
        $instituicao = $this->instituicaoRepository->find($id);

        if (empty($instituicao)) {
            return $this->sendError('Instituicao not found');
        }

        return $this->sendResponse($instituicao->toArray(), 'Instituicao retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateInstituicaoAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/instituicaos/{id}",
     *      summary="Update the specified Instituicao in storage",
     *      tags={"Instituicao"},
     *      description="Update Instituicao",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Instituicao",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Instituicao that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Instituicao")
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
     *                  ref="#/definitions/Instituicao"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateInstituicaoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Instituicao $instituicao */
        $instituicao = $this->instituicaoRepository->find($id);

        if (empty($instituicao)) {
            return $this->sendError('Instituicao not found');
        }

        $instituicao = $this->instituicaoRepository->update($input, $id);

        return $this->sendResponse($instituicao->toArray(), 'Instituicao updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/instituicaos/{id}",
     *      summary="Remove the specified Instituicao from storage",
     *      tags={"Instituicao"},
     *      description="Delete Instituicao",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Instituicao",
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
        /** @var Instituicao $instituicao */
        $instituicao = $this->instituicaoRepository->find($id);

        if (empty($instituicao)) {
            return $this->sendError('Instituicao not found');
        }

        $instituicao->delete();

        return $this->sendSuccess('Instituicao deleted successfully');
    }
}
