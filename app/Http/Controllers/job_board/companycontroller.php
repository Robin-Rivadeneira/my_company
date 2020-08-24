<?php

namespace App\Http\controllers\job_board;

use App\Company;
use app\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Exception;
use Error;


class CompanyController extends Controller
{
    public function show($id)
    {
        try {
            $company = Company::where('user_id', $id)->first();
            return response()->json(['company' => $company], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json($e, 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json($e, 405);
        } catch (QueryException  $e) {
            return response()->json($e, 405);
        } catch (Exception $e) {
            return response()->json($e, 500);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }
    public function update(Request $request)
    {
        try {
            $data = $request->json()->all();
            $dataCompany = $data['company'];
            $company = Company::findOrFail($dataCompany['id']);
            $company->update([
                'identity' => trim($dataCompany['identity']),
                'email' => strtolower(trim($dataCompany['email'])),
                'nature' => $dataCompany['nature'],
                'trade_name' => strtoupper(trim($dataCompany['trade_name'])),
                'comercial_activity' => strtoupper(trim($dataCompany['comercial_activity'])),
                'phone' => trim($dataCompany['phone']),
                'cell_phone' => trim($dataCompany['cell_phone']),
                'web_page' => strtolower(trim($dataCompany['web_page'])),
                'address' => strtoupper(trim($dataCompany['address'])),
            ]);
            $company->user()->update(['email' => strtolower(trim($dataCompany['email']))]);
            return response()->json($company, 201);
        } catch (ModelNotFoundException $e) {
            return response()->json($e, 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json($e, 405);
        } catch (QueryException  $e) {
            return response()->json($e, 405);
        } catch (Exception $e) {
            return response()->json($e, 500);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }
    
    function destroy(Request $request)
    {
        try {
            $offer = Offer::findOrFail($request->id)->delete();
            return response()->json($offer, 201);
        } catch (ModelNotFoundException $e) {
            return response()->json($e, 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json($e, 405);
        } catch (QueryException  $e) {
            return response()->json($e, 405);
        } catch (Exception $e) {
            return response()->json($e, 500);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }
}
