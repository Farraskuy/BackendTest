<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\MembersInterface;

class MembersController extends Controller
{
    protected $memberRepository;

    public function __construct(MembersInterface $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    /**
     * @OA\Get(
     *     path="/api/members",
     *     operationId="getMembers",
     *     tags={"Members"},
     *     summary="Show Members",
     *     description="Showing members list",
     *     @OA\Response(
     *       response=200,
     *       description="Success show members list",
     *       @OA\JsonContent(
     *         type="array",
     *         @OA\Items(ref="#/components/schemas/Members")
     *       )
     *     )
     * )
     */

    public function index()
    {
        $member = $this->memberRepository->getMembers();
        return response()->json($member);
    }
}