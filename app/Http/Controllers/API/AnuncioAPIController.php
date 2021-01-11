<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAnuncioAPIRequest;
use App\Http\Requests\API\UpdateAnuncioAPIRequest;
use App\Models\Anuncio;
use App\Repositories\AnuncioRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class AnuncioController
 * @package App\Http\Controllers\API
 */

class AnuncioAPIController extends AppBaseController
{
    /** @var  AnuncioRepository */
    private $anuncioRepository;

    public function __construct(AnuncioRepository $anuncioRepo)
    {
        $this->anuncioRepository = $anuncioRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/anuncios",
     *      summary="Get a listing of the Anuncios.",
     *      tags={"Anuncio"},
     *      description="Get all Anuncios",
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
     *                  @SWG\Items(ref="#/definitions/Anuncio")
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
        $anuncios = $this->anuncioRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($anuncios->toArray(), 'Anuncios retrieved successfully');
    }

    /**
     * @param CreateAnuncioAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/anuncios",
     *      summary="Store a newly created Anuncio in storage",
     *      tags={"Anuncio"},
     *      description="Store Anuncio",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Anuncio that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Anuncio")
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
     *                  ref="#/definitions/Anuncio"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAnuncioAPIRequest $request)
    {
        $input = $request->all();

        $anuncio = $this->anuncioRepository->create($input);

        return $this->sendResponse($anuncio->toArray(), 'Anuncio saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/anuncios/{id}",
     *      summary="Display the specified Anuncio",
     *      tags={"Anuncio"},
     *      description="Get Anuncio",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Anuncio",
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
     *                  ref="#/definitions/Anuncio"
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
        /** @var Anuncio $anuncio */
        $anuncio = $this->anuncioRepository->find($id);

        if (empty($anuncio)) {
            return $this->sendError('Anuncio not found');
        }

        return $this->sendResponse($anuncio->toArray(), 'Anuncio retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateAnuncioAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/anuncios/{id}",
     *      summary="Update the specified Anuncio in storage",
     *      tags={"Anuncio"},
     *      description="Update Anuncio",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Anuncio",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Anuncio that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Anuncio")
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
     *                  ref="#/definitions/Anuncio"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAnuncioAPIRequest $request)
    {
        $input = $request->all();

        /** @var Anuncio $anuncio */
        $anuncio = $this->anuncioRepository->find($id);

        if (empty($anuncio)) {
            return $this->sendError('Anuncio not found');
        }

        $anuncio = $this->anuncioRepository->update($input, $id);

        return $this->sendResponse($anuncio->toArray(), 'Anuncio updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/anuncios/{id}",
     *      summary="Remove the specified Anuncio from storage",
     *      tags={"Anuncio"},
     *      description="Delete Anuncio",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Anuncio",
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
        /** @var Anuncio $anuncio */
        $anuncio = $this->anuncioRepository->find($id);

        if (empty($anuncio)) {
            return $this->sendError('Anuncio not found');
        }

        $anuncio->delete();

        return $this->sendSuccess('Anuncio deleted successfully');
    }
}
